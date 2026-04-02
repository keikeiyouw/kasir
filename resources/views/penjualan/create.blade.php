@extends('admin.layout')
@section('title', 'Tambah Penjualan')
@push('styles')
<style>
.item-row {
    display: grid;
    grid-template-columns: 1fr 70px 100px 28px;
    gap: 8px;
    align-items: center;
    margin-bottom: 8px;
}
.sub-text {
    font-size: 12px;
    font-weight: 600;
    color: var(--text);
}
.btn-remove {
    background: none;
    border: none;
    color: var(--muted);
    cursor: pointer;
    font-size: 16px;
    padding: 0;
    line-height: 1;
    transition: color 0.15s;
}
.btn-remove:hover { color: #dc2626; }
.total-box {
    background: var(--bg);
    border: 1px solid var(--border);
    border-radius: 8px;
    padding: 12px 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
}
</style>
@endpush
@section('content')

<div style="max-width:640px;">
    <div class="card">
        <div class="card-head">
            <div class="card-title">Tambah Penjualan</div>
            <a href="{{ route('penjualan.index') }}" class="btn btn-outline">← Kembali</a>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-error">{{ $errors->first() }}</div>
            @endif
            <form action="{{ route('penjualan.store') }}" method="POST">
                @csrf
                <div class="form-2col">
                    <div class="form-group">
                        <label class="form-label">Pelanggan</label>
                        <select name="PelangganID" class="form-control" required>
                            <option value="">-- Pilih Pelanggan --</option>
                            @foreach($pelanggans as $pl)
                            <option value="{{ $pl->PelangganID }}">{{ $pl->NamaPelanggan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tanggal</label>
                        <input type="date" name="TanggalPenjualan" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Item Produk</label>
                    <div id="items">
                        <div class="item-row">
                            <select name="produk[]" class="form-control produk-sel" onchange="hitung()">
                                <option value="">-- Pilih Produk --</option>
                                @foreach($produks as $p)
                                <option value="{{ $p->ProdukID }}" data-harga="{{ $p->Harga }}">{{ $p->NamaProduk }}</option>
                                @endforeach
                            </select>
                            <input type="number" name="jumlah[]" class="form-control jml" value="1" min="1" onchange="hitung()">
                            <div class="sub-text">Rp 0</div>
                            <button type="button" class="btn-remove" onclick="hapusItem(this)">✕</button>
                        </div>
                    </div>
                    <button type="button" onclick="tambahItem()" class="btn btn-outline" style="margin-top:8px;">+ Tambah Item</button>
                </div>

                <div class="total-box">
                    <span style="font-size:13px; color:var(--muted); font-weight:500;">Total Harga</span>
                    <span id="totalShow" style="font-size:20px; font-weight:700; color:var(--text); letter-spacing:-0.5px;">Rp 0</span>
                </div>

                <input type="hidden" name="TotalHarga" id="totalVal" value="0">
                <div style="display:flex; gap:8px;">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('penjualan.index') }}" class="btn btn-outline">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
function hitung() {
    let total = 0;
    document.querySelectorAll('.item-row').forEach(row => {
        const sel = row.querySelector('.produk-sel');
        const qty = parseInt(row.querySelector('.jml').value) || 0;
        const harga = parseInt(sel.options[sel.selectedIndex]?.dataset.harga || 0);
        const sub = harga * qty;
        row.querySelector('.sub-text').textContent = 'Rp ' + sub.toLocaleString('id-ID');
        total += sub;
    });
    document.getElementById('totalShow').textContent = 'Rp ' + total.toLocaleString('id-ID');
    document.getElementById('totalVal').value = total;
}

function tambahItem() {
    const template = document.querySelector('.item-row').cloneNode(true);
    template.querySelector('.produk-sel').value = '';
    template.querySelector('.jml').value = 1;
    template.querySelector('.sub-text').textContent = 'Rp 0';
    document.getElementById('items').appendChild(template);
}

function hapusItem(btn) {
    const rows = document.querySelectorAll('.item-row');
    if (rows.length > 1) {
        btn.closest('.item-row').remove();
        hitung();
    }
}
</script>
@endpush