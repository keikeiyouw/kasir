@extends('admin.layout')
@section('title', 'Edit Produk')
@section('content')

<div style="max-width:540px;">
    <div class="card">
        <div class="card-head">
            <div class="card-title">Edit Produk</div>
            <a href="{{ route('produk.index') }}" class="btn btn-outline">← Kembali</a>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-error">{{ $errors->first() }}</div>
            @endif
            <form action="{{ route('produk.update', $produk) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="form-group">
                    <label class="form-label">Nama Produk</label>
                    <input type="text" name="NamaProduk" class="form-control" value="{{ old('NamaProduk', $produk->NamaProduk) }}" required>
                </div>
                <div class="form-2col">
                    <div class="form-group">
                        <label class="form-label">Harga (Rp)</label>
                        <input type="number" name="Harga" class="form-control" value="{{ old('Harga', $produk->Harga) }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Stok</label>
                        <input type="number" name="Stok" class="form-control" value="{{ old('Stok', $produk->Stok) }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Foto Produk</label>
                    @if($produk->foto)
                        <img src="{{ asset('storage/'.$produk->foto) }}"
                             style="width:64px; height:64px; object-fit:cover; border-radius:8px; display:block; margin-bottom:8px; border:1px solid var(--border);">
                    @endif
                    <label style="display:flex; align-items:center; gap:10px; cursor:pointer;">
                        <span id="foto-label" style="
                            display:inline-flex; align-items:center; gap:6px;
                            padding:7px 14px; border-radius:6px; font-size:12px; font-weight:500;
                            background:var(--bg); border:1px solid var(--border); color:var(--text);
                            cursor:pointer; transition:background 0.15s; white-space:nowrap;
                        ">📁 Pilih Foto</span>
                        <span id="foto-name" style="font-size:12px; color:var(--muted);">Belum ada file dipilih</span>
                        <input type="file" name="foto" accept="image/*" style="display:none;" id="foto-input"
                            onchange="document.getElementById('foto-name').textContent = this.files[0]?.name ?? 'Belum ada file dipilih'">
                    </label>
                    <div style="font-size:11px; color:var(--muted); margin-top:6px;">Kosongkan jika tidak ingin mengganti foto.</div>
                </div>
                <div style="display:flex; gap:8px; margin-top:6px;">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('produk.index') }}" class="btn btn-outline">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection