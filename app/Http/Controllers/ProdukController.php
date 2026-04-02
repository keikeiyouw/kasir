<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $produks = Produk::when($request->search, function ($q) use ($request) {
            $q->where('NamaProduk', 'like', "%{$request->search}%");
        })->latest()->paginate(10);

        return view('produk.index', compact('produks'));
    }

    public function create()
    {
        return view('produk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'NamaProduk' => 'required|string|max:255',
            'Harga'      => 'required|numeric|min:0',
            'Stok'       => 'required|integer|min:0',
            'foto'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only('NamaProduk', 'Harga', 'Stok');

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('produk', 'public');
        }

        Produk::create($data);

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Produk $produk)
    {
        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'NamaProduk' => 'required|string|max:255',
            'Harga'      => 'required|numeric|min:0',
            'Stok'       => 'required|integer|min:0',
            'foto'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only('NamaProduk', 'Harga', 'Stok');

        if ($request->hasFile('foto')) {
            if ($produk->foto) {
                Storage::disk('public')->delete($produk->foto);
            }
            $data['foto'] = $request->file('foto')->store('produk', 'public');
        }

        $produk->update($data);

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Produk $produk)
    {

    // Hapus detail penjualan yang terkait dulu
    $produk->detailPenjualan()->delete();

    if ($produk->foto) {
        Storage::disk('public')->delete($produk->foto);
    }

    $produk->delete();

    return redirect()->route('produk.index')
        ->with('success', 'Produk berhasil dihapus!');
}

}