<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Pelanggan;
use App\Models\Produk;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPenjualan  = Penjualan::count();
        $totalPendapatan = Penjualan::sum('TotalHarga');
        $totalPelanggan  = Pelanggan::count();
        $totalProduk     = Produk::count();

        $penjualanTerbaru = Penjualan::with('pelanggan')
            ->latest()
            ->take(5)
            ->get();

        $produkStokRendah = Produk::where('Stok', '<=', 20)
            ->orderBy('Stok')
            ->take(8)
            ->get();

        return view('admin.dashboard', compact(
            'totalPenjualan',
            'totalPendapatan',
            'totalPelanggan',
            'totalProduk',
            'penjualanTerbaru',
            'produkStokRendah'
        ));
    }
}
