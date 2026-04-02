@extends('admin.layout')
@section('title', 'Edit Penjualan')
@section('content')

<div style="max-width:540px;">
    <div class="card">
        <div class="card-head">
            <div class="card-title">Edit Penjualan</div>
            <a href="{{ route('penjualan.index') }}" class="btn btn-outline">← Kembali</a>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-error">{{ $errors->first() }}</div>
            @endif
            <form action="{{ route('penjualan.update', $penjualan) }}" method="POST">
                @csrf @method('PUT')
                <div class="form-group">
                    <label class="form-label">Pelanggan</label>
                    <select name="PelangganID" class="form-control" required>
                        @foreach($pelanggans as $p)
                        <option value="{{ $p->PelangganID }}" {{ $penjualan->PelangganID == $p->PelangganID ? 'selected' : '' }}>
                            {{ $p->NamaPelanggan }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="TanggalPenjualan" class="form-control" value="{{ $penjualan->TanggalPenjualan }}" required>
                </div>
                <div style="display:flex; gap:8px; margin-top:6px;">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('penjualan.index') }}" class="btn btn-outline">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection