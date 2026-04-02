@extends('admin.layout')
@section('title', 'Pelanggan')
@section('content')

<div class="card">
    <div class="card-head">
        <div class="card-title">Daftar Pelanggan</div>
        <form method="GET" style="display:flex; gap:6px;">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pelanggan..." class="form-control" style="width:200px;">
            <button class="btn btn-outline">Cari</button>
        </form>
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Telepon</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pelanggans as $i => $p)
            <tr>
                <td style="color:var(--muted); font-size:12px;">{{ $pelanggans->firstItem() + $i }}</td>
                <td style="font-weight:500;">{{ $p->NamaPelanggan }}</td>
                <td>{{ $p->NomorTelepon ?? '-' }}</td>
                <td style="color:var(--muted);">{{ $p->Alamat ?? '-' }}</td>
                <td>
                    <a href="{{ route('pelanggan.show', $p) }}" class="btn btn-outline">Detail</a>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="empty">Belum ada pelanggan.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="pagi">{{ $pelanggans->links() }}</div>
</div>

@endsection