@extends('admin.layout')
@section('title', 'Detail Penjualan')
@section('content')

<div class="card">
    <div class="card-head">
        <div class="card-title">Laporan Detail Penjualan</div>
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID Transaksi</th>
                <th>Pelanggan</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($details as $i => $d)
            <tr>
                <td style="color:var(--muted); font-size:12px;">{{ $details->firstItem() + $i }}</td>
                <td>
                    <span class="badge badge-info">#PJL-{{ str_pad($d->PenjualanID, 3, '0', STR_PAD_LEFT) }}</span>
                </td>
                <td style="font-weight:500;">{{ $d->penjualan->pelanggan->NamaPelanggan ?? '-' }}</td>
                <td>{{ $d->produk->NamaProduk ?? '-' }}</td>
                <td>{{ $d->JumlahProduk }}</td>
                <td style="font-weight:600;">Rp {{ number_format($d->Subtotal, 0, ',', '.') }}</td>
                <td style="color:var(--muted);">{{ \Carbon\Carbon::parse($d->penjualan->TanggalPenjualan)->isoFormat('D MMM Y') }}</td>
            </tr>
            @empty
            <tr><td colspan="7" class="empty">Belum ada data.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="pagi">{{ $details->links() }}</div>
</div>

@endsection