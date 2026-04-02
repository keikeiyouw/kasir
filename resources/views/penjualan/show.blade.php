@extends('admin.layout')
@section('title', 'Detail Penjualan')
@section('content')

<div style="display:grid; grid-template-columns:1fr 300px; gap:16px; align-items:start;">

    {{-- KIRI: Item Pembelian --}}
    <div class="card">
        <div class="card-head">
            <div class="card-title">Item Pembelian</div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Harga Satuan</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($penjualan->details as $d)
                <tr>
                    <td style="font-weight:500;">{{ $d->produk->NamaProduk ?? '-' }}</td>
                    <td>{{ $d->JumlahProduk }}</td>
                    <td style="color:var(--muted);">Rp {{ number_format($d->produk->Harga ?? 0, 0, ',', '.') }}</td>
                    <td style="font-weight:600;">Rp {{ number_format($d->Subtotal, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- KANAN: Info Transaksi --}}
    <div style="display:flex; flex-direction:column; gap:14px;">
        <div class="card">
            <div class="card-head">
                <div class="card-title">Info Transaksi</div>
            </div>
            <div style="padding:16px 20px;">
                <div style="margin-bottom:12px;">
                    <div style="font-size:10px; font-weight:600; text-transform:uppercase; letter-spacing:0.8px; color:var(--muted); margin-bottom:3px;">ID</div>
                    <div style="font-weight:600; font-size:13px;">#PJL-{{ str_pad($penjualan->PenjualanID, 3, '0', STR_PAD_LEFT) }}</div>
                </div>
                <div style="margin-bottom:12px;">
                    <div style="font-size:10px; font-weight:600; text-transform:uppercase; letter-spacing:0.8px; color:var(--muted); margin-bottom:3px;">Tanggal</div>
                    <div style="font-weight:500; font-size:13px;">{{ \Carbon\Carbon::parse($penjualan->TanggalPenjualan)->isoFormat('D MMM Y') }}</div>
                </div>
                <div style="margin-bottom:16px;">
                    <div style="font-size:10px; font-weight:600; text-transform:uppercase; letter-spacing:0.8px; color:var(--muted); margin-bottom:3px;">Pelanggan</div>
                    <div style="font-weight:500; font-size:13px;">{{ $penjualan->pelanggan->NamaPelanggan ?? '-' }}</div>
                </div>
                <div style="border-top:1px solid var(--border); padding-top:12px; display:flex; justify-content:space-between; align-items:center;">
                    <div style="font-size:12px; color:var(--muted); font-weight:500;">Total</div>
                    <div style="font-size:18px; font-weight:700; color:var(--text); letter-spacing:-0.5px;">
                        Rp {{ number_format($penjualan->TotalHarga, 0, ',', '.') }}
                    </div>
                </div>
            </div>
        </div>

        <a href="{{ route('penjualan.index') }}" class="btn btn-outline" style="justify-content:center;">← Kembali</a>
    </div>

</div>

@endsection