<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Penjualan;
use App\Models\DetailPenjualan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserDashboardController extends Controller
{
    public function index(Request $request)
    {
        $produks = Produk::when($request->search, function ($q) use ($request) {
            $q->where('NamaProduk', 'like', "%{$request->search}%");
        })->where('Stok', '>', 0)->latest()->get();

        return view('user.dashboard', compact('produks'));
    }

    public function beli(Request $request)
    {
        $request->validate([
            'ProdukID'     => 'required|exists:produk,ProdukID',
            'JumlahProduk' => 'required|integer|min:1',
        ]);

        $produk = Produk::findOrFail($request->ProdukID);

        if ($produk->Stok < $request->JumlahProduk) {
            return back()->with('error', 'Stok tidak mencukupi!');
        }

        DB::transaction(function () use ($request, $produk) {
            $pelanggan = Pelanggan::firstOrCreate(
                ['NamaPelanggan' => Auth::user()->name],
                [
                    'NamaPelanggan' => Auth::user()->name,
                    'Alamat'        => '-',
                    'NomorTelepon'  => '-',
                ]
            );

            $subtotal = $produk->Harga * $request->JumlahProduk;

            $penjualan = Penjualan::create([
                'PelangganID'      => $pelanggan->PelangganID,
                'TanggalPenjualan' => now()->toDateString(),
                'TotalHarga'       => $subtotal,
            ]);

            DetailPenjualan::create([
                'PenjualanID'  => $penjualan->PenjualanID,
                'ProdukID'     => $produk->ProdukID,
                'JumlahProduk' => $request->JumlahProduk,
                'Subtotal'     => $subtotal,
            ]);

            $produk->decrement('Stok', $request->JumlahProduk);
        });

        return back()->with('success', "Berhasil membeli {$request->JumlahProduk} {$produk->NamaProduk}!");
    }

    public function riwayat()
    {
        $pelanggan = Pelanggan::where('NamaPelanggan', Auth::user()->name)->first();

        $riwayat = collect();
        if ($pelanggan) {
            $riwayat = Penjualan::with('details.produk')
                ->where('PelangganID', $pelanggan->PelangganID)
                ->latest()
                ->get();
        }

        return view('user.riwayat', compact('riwayat'));
    }

    public function profil()
    {
        $pelanggan = Pelanggan::where('NamaPelanggan', Auth::user()->name)->first();
        return view('user.profil', compact('pelanggan'));
    }

    public function updateProfil(Request $request)
    {
        $request->validate([
            'NomorTelepon' => 'nullable|string|max:20',
            'Alamat'       => 'nullable|string|max:500',
        ]);

        // Kalau belum ada record pelanggan → buat baru
        // Kalau sudah ada → update
        Pelanggan::updateOrCreate(
            ['NamaPelanggan' => Auth::user()->name],
            [
                'NomorTelepon' => $request->NomorTelepon ?? '-',
                'Alamat'       => $request->Alamat ?? '-',
            ]
        );

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}