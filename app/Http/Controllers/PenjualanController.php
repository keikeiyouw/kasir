<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\DetailPenjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    public function index(Request $request)
    {
        $penjualans = Penjualan::with('pelanggan')
            ->when($request->search, function ($q) use ($request) {
                $q->whereHas('pelanggan', function ($q2) use ($request) {
                    $q2->where('NamaPelanggan', 'like', "%{$request->search}%");
                });
            })
            ->latest()
            ->paginate(10);

        return view('penjualan.index', compact('penjualans'));
    }

    public function create()
    {
        $pelanggans = Pelanggan::orderBy('NamaPelanggan')->get();
        $produks    = Produk::where('Stok', '>', 0)->orderBy('NamaProduk')->get();
        return view('penjualan.create', compact('pelanggans', 'produks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'PelangganID'      => 'required|exists:pelanggan,PelangganID',
            'TanggalPenjualan' => 'required|date',
            'produk'           => 'required|array|min:1',
            'produk.*'         => 'required|exists:produk,ProdukID',
            'jumlah.*'         => 'required|integer|min:1',
        ]);

        // ── Validasi stok sebelum transaksi dimulai ──
        foreach ($request->produk as $i => $produkId) {
            $produk = Produk::findOrFail($produkId);
            $jumlah = (int) $request->jumlah[$i];

            if ($jumlah > $produk->Stok) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', "Stok \"{$produk->NamaProduk}\" tidak cukup. Stok tersedia: {$produk->Stok}, diminta: {$jumlah}.");
            }
        }

        // ── Proses transaksi ──
        DB::transaction(function () use ($request) {
            $totalHarga = 0;
            $items = [];

            foreach ($request->produk as $i => $produkId) {
                $produk   = Produk::findOrFail($produkId);
                $jumlah   = $request->jumlah[$i];
                $subtotal = $produk->Harga * $jumlah;
                $totalHarga += $subtotal;
                $items[] = [
                    'produk'   => $produk,
                    'jumlah'   => $jumlah,
                    'subtotal' => $subtotal,
                ];
            }

            $penjualan = Penjualan::create([
                'PelangganID'      => $request->PelangganID,
                'TanggalPenjualan' => $request->TanggalPenjualan,
                'TotalHarga'       => $totalHarga,
            ]);

            foreach ($items as $item) {
                DetailPenjualan::create([
                    'PenjualanID'  => $penjualan->PenjualanID,
                    'ProdukID'     => $item['produk']->ProdukID,
                    'JumlahProduk' => $item['jumlah'],
                    'Subtotal'     => $item['subtotal'],
                ]);
                $item['produk']->decrement('Stok', $item['jumlah']);
            }
        });

        return redirect()->route('penjualan.index')
            ->with('success', 'Transaksi berhasil disimpan!');
    }

    public function show(Penjualan $penjualan)
    {
        $penjualan->load(['pelanggan', 'details.produk']);
        return view('penjualan.show', compact('penjualan'));
    }

    public function edit(Penjualan $penjualan)
    {
        $pelanggans = Pelanggan::orderBy('NamaPelanggan')->get();
        return view('penjualan.edit', compact('penjualan', 'pelanggans'));
    }

    public function update(Request $request, Penjualan $penjualan)
    {
        $request->validate([
            'PelangganID'      => 'required|exists:pelanggan,PelangganID',
            'TanggalPenjualan' => 'required|date',
        ]);

        $penjualan->update($request->only('PelangganID', 'TanggalPenjualan'));

        return redirect()->route('penjualan.index')
            ->with('success', 'Penjualan berhasil diperbarui!');
    }

    public function destroy(Penjualan $penjualan)
    {
        $penjualan->details()->delete();
        $penjualan->delete();

        return redirect()->route('penjualan.index')
            ->with('success', 'Transaksi berhasil dihapus!');
    }
}