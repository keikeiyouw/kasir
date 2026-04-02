@extends('admin.layout')
@section('title', 'Detail Pelanggan')
@section('content')

<div style="max-width:720px;">

    {{-- Info Pelanggan --}}
    <div class="card" style="margin-bottom:16px;">
        <div class="card-head">
            <div class="card-title">Detail Pelanggan</div>
            <a href="{{ route('pelanggan.index') }}" class="btn btn-outline">← Kembali</a>
        </div>
        <div style="padding:16px 20px; display:grid; grid-template-columns:1fr 1fr 1fr; gap:16px;">
            <div>
                <div style="font-size:10px; font-weight:600; text-transform:uppercase; letter-spacing:0.8px; color:var(--muted); margin-bottom:4px;">Nama</div>
                <div style="font-weight:600;">{{ $pelanggan->NamaPelanggan }}</div>
            </div>
            <div>
                <div style="font-size:10px; font-weight:600; text-transform:uppercase; letter-spacing:0.8px; color:var(--muted); margin-bottom:4px;">Telepon</div>
                <div style="font-weight:500;">{{ $pelanggan->NomorTelepon ?? '-' }}</div>
            </div>
            <div>
                <div style="font-size:10px; font-weight:600; text-transform:uppercase; letter-spacing:0.8px; color:var(--muted); margin-bottom:4px;">Alamat</div>
                <div style="font-weight:500; color:var(--muted);">{{ $pelanggan->Alamat ?? '-' }}</div>
            </div>
        </div>
    </div>

    {{-- Riwayat Belanja --}}
    <div class="card">
        <div class="card-head">
            <div class="card-title">Riwayat Belanja</div>
            <div style="font-size:12px; color:var(--muted);">{{ $penjualans->count() }} transaksi</div>
        </div>

        @if($penjualans->count() > 0)
            @foreach($penjualans as $p)
            <div style="border-bottom:1px solid var(--border);">
                {{-- Header transaksi --}}
                <div style="padding:12px 20px; display:flex; justify-content:space-between; align-items:center; background:#faf8f5;">
                    <div>
                        <div style="font-size:12px; font-weight:600; color:var(--text);">#PJL-{{ str_pad($p->PenjualanID, 3, '0', STR_PAD_LEFT) }}</div>
                        <div style="font-size:11px; color:var(--muted); margin-top:2px;">{{ \Carbon\Carbon::parse($p->TanggalPenjualan)->isoFormat('D MMMM Y') }}</div>
                    </div>
                    <div style="font-size:15px; font-weight:700; color:var(--text);">
                        Rp {{ number_format($p->TotalHarga, 0, ',', '.') }}
                    </div>
                </div>
                {{-- Detail item --}}
                <table>
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Harga Satuan</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($p->details as $d)
                        <tr>
                            <td style="font-weight:500;">{{ $d->produk->NamaProduk ?? '-' }}</td>
                            <td style="color:var(--muted);">Rp {{ number_format($d->produk->Harga ?? 0, 0, ',', '.') }}</td>
                            <td>{{ $d->JumlahProduk }}</td>
                            <td style="font-weight:600;">Rp {{ number_format($d->Subtotal, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endforeach
        @else
            <div class="empty">Pelanggan ini belum pernah bertransaksi.</div>
        @endif
    </div>

</div>

@endsection