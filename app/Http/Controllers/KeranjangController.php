<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Produk;
use App\Models\Penjualan;
use App\Models\DetailPenjualan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KeranjangController extends Controller
{
    // Tampilkan keranjang
    public function index()
    {
        $items = Keranjang::with('produk')
            ->where('user_id', Auth::id())
            ->get();

        $total = $items->sum(fn($i) => $i->produk->Harga * $i->jumlah);

        return view('user.keranjang', compact('items', 'total'));
    }

    // Tambah ke keranjang
    public function tambah(Request $request)
    {
        $request->validate([
            'ProdukID' => 'required|exists:produk,ProdukID',
            'jumlah'   => 'required|integer|min:1',
        ]);

        $keranjang = Keranjang::where('user_id', Auth::id())
            ->where('ProdukID', $request->ProdukID)
            ->first();

        if ($keranjang) {
            $keranjang->increment('jumlah', $request->jumlah);
        } else {
            Keranjang::create([
                'user_id'  => Auth::id(),
                'ProdukID' => $request->ProdukID,
                'jumlah'   => $request->jumlah,
            ]);
        }

        return back()->with('success', 'Produk ditambahkan ke keranjang!');
    }

    // Update jumlah
    public function update(Request $request, Keranjang $keranjang)
    {
        $request->validate(['jumlah' => 'required|integer|min:1']);
        $keranjang->update(['jumlah' => $request->jumlah]);
        return back();
    }

    // Hapus item
    public function hapus(Keranjang $keranjang)
    {
        $keranjang->delete();
        return back()->with('success', 'Produk dihapus dari keranjang!');
    }

    // Checkout
    public function checkout()
    {
        $items = Keranjang::with('produk')
            ->where('user_id', Auth::id())
            ->get();

        if ($items->isEmpty()) {
            return back()->with('error', 'Keranjang masih kosong!');
        }

        // ── Validasi data diri ──
        $pelanggan = Pelanggan::where('NamaPelanggan', Auth::user()->name)->first();

        $belumLengkap = !$pelanggan
            || empty($pelanggan->NomorTelepon)
            || $pelanggan->NomorTelepon === '-'
            || empty($pelanggan->Alamat)
            || $pelanggan->Alamat === '-';

        if ($belumLengkap) {
            return redirect()->route('user.profil')
                ->with('error', 'Lengkapi nomor telepon dan alamat di profil terlebih dahulu sebelum checkout.');
        }

        // ── Validasi stok ──
        foreach ($items as $item) {
            if ($item->jumlah > $item->produk->Stok) {
                return back()->with('error', "Stok \"{$item->produk->NamaProduk}\" tidak cukup. Stok tersedia: {$item->produk->Stok}.");
            }
        }

        // ── Proses transaksi ──
        DB::transaction(function () use ($items, $pelanggan) {
            $total = $items->sum(fn($i) => $i->produk->Harga * $i->jumlah);

            $penjualan = Penjualan::create([
                'PelangganID'      => $pelanggan->PelangganID,
                'TanggalPenjualan' => now()->toDateString(),
                'TotalHarga'       => $total,
            ]);

            foreach ($items as $item) {
                DetailPenjualan::create([
                    'PenjualanID'  => $penjualan->PenjualanID,
                    'ProdukID'     => $item->ProdukID,
                    'JumlahProduk' => $item->jumlah,
                    'Subtotal'     => $item->produk->Harga * $item->jumlah,
                ]);
                $item->produk->decrement('Stok', $item->jumlah);
            }

            Keranjang::where('user_id', Auth::id())->delete();
        });

        return redirect()->route('user.riwayat')->with('success', 'Pesanan berhasil dibuat!');
    }
}