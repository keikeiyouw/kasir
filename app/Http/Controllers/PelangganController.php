<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Penjualan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index(Request $request)
    {
        $pelanggans = Pelanggan::when($request->search, function ($q) use ($request) {
            $q->where('NamaPelanggan', 'like', "%{$request->search}%");
        })->latest()->paginate(10);

        return view('pelanggan.index', compact('pelanggans'));
    }

    public function show(Pelanggan $pelanggan)
    {
        $penjualans = Penjualan::with('details.produk')
            ->where('PelangganID', $pelanggan->PelangganID)
            ->latest()
            ->get();

        return view('pelanggan.show', compact('pelanggan', 'penjualans'));
    }

    // Method lain tetap ada tapi tidak dipakai di UI
    public function create()
    {
        return view('pelanggan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'NamaPelanggan' => 'required|string|max:255',
            'NomorTelepon'  => 'nullable|string|max:20',
            'Alamat'        => 'nullable|string',
        ]);

        Pelanggan::create($request->only('NamaPelanggan', 'NomorTelepon', 'Alamat'));

        return redirect()->route('pelanggan.index')
            ->with('success', 'Pelanggan berhasil ditambahkan!');
    }

    public function edit(Pelanggan $pelanggan)
    {
        return view('pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        $request->validate([
            'NamaPelanggan' => 'required|string|max:255',
            'NomorTelepon'  => 'nullable|string|max:20',
            'Alamat'        => 'nullable|string',
        ]);

        $pelanggan->update($request->only('NamaPelanggan', 'NomorTelepon', 'Alamat'));

        return redirect()->route('pelanggan.index')
            ->with('success', 'Pelanggan berhasil diperbarui!');
    }

    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();

        return redirect()->route('pelanggan.index')
            ->with('success', 'Pelanggan berhasil dihapus!');
    }
}