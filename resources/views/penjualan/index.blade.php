@extends('admin.layout')
@section('title', 'Penjualan')
@section('content')

<div class="card">
    <div class="card-head">
        <div class="card-title">Daftar Penjualan</div>
        <form method="GET" style="display:flex; gap:6px;">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pelanggan..." class="form-control" style="width:200px;">
            <button class="btn btn-outline">Cari</button>
        </form>
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>Pelanggan</th>
                <th>Tanggal</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($penjualans as $i => $p)
            <tr>
                <td style="color:var(--muted); font-size:12px;">{{ $penjualans->firstItem() + $i }}</td>
                <td style="color:var(--muted); font-size:12px;">#PJL-{{ str_pad($p->PenjualanID, 3, '0', STR_PAD_LEFT) }}</td>
                <td style="font-weight:500;">{{ $p->pelanggan->NamaPelanggan ?? '-' }}</td>
                <td style="color:var(--muted);">{{ \Carbon\Carbon::parse($p->TanggalPenjualan)->isoFormat('D MMM Y') }}</td>
                <td style="font-weight:600;">Rp {{ number_format($p->TotalHarga, 0, ',', '.') }}</td>
                <td>
                    <div style="display:flex; gap:5px; align-items:center;">
                        <a href="{{ route('penjualan.show', $p) }}" class="btn btn-outline">Detail</a>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="empty">Belum ada penjualan.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="pagi">{{ $penjualans->links() }}</div>
</div>

@endsection