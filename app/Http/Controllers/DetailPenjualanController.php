<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;

class DetailPenjualanController extends Controller
{
    public function index()
    {
        $details = DetailPenjualan::with(['penjualan.pelanggan', 'produk'])
            ->latest()
            ->paginate(15);

        return view('detailpenjualan.index', compact('details'));
    }
}