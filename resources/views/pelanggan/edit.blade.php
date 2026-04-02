@extends('admin.layout')
@section('title', 'Edit Pelanggan')
@section('content')

<div style="max-width:540px;">
    <div class="card">
        <div class="card-head">
            <div class="card-title">Edit Pelanggan</div>
            <a href="{{ route('pelanggan.index') }}" class="btn btn-outline">← Kembali</a>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-error">{{ $errors->first() }}</div>
            @endif
            <form action="{{ route('pelanggan.update', $pelanggan) }}" method="POST">
                @csrf @method('PUT')
                <div class="form-group">
                    <label class="form-label">Nama</label>
                    <input type="text" name="NamaPelanggan" class="form-control" value="{{ old('NamaPelanggan', $pelanggan->NamaPelanggan) }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Nomor Telepon</label>
                    <input type="text" name="NomorTelepon" class="form-control" value="{{ old('NomorTelepon', $pelanggan->NomorTelepon) }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Alamat</label>
                    <textarea name="Alamat" class="form-control" rows="3">{{ old('Alamat', $pelanggan->Alamat) }}</textarea>
                </div>
                <div style="display:flex; gap:8px; margin-top:6px;">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('pelanggan.index') }}" class="btn btn-outline">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection