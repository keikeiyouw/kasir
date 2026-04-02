@extends('admin.layout')
@section('title', 'Produk')
@section('content')

<div class="card">
    <div class="card-head">
        <div class="card-title">Daftar Produk</div>
        <div style="display:flex; gap:8px;">
            <form method="GET" style="display:flex; gap:6px;">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..." class="form-control" style="width:180px;">
                <button class="btn btn-outline">Cari</button>
            </form>
            <a href="{{ route('produk.create') }}" class="btn btn-primary">+ Tambah</a>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Foto</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($produks as $i => $p)
            <tr>
                <td style="color:var(--muted); font-size:12px;">{{ $produks->firstItem() + $i }}</td>
                <td>
                    @if($p->foto)
                        <img src="{{ asset('storage/'.$p->foto) }}" style="width:36px; height:36px; object-fit:cover; border-radius:6px; display:block;">
                    @else
                        <div style="width:36px; height:36px; border-radius:6px; background:var(--bg); border:1px solid var(--border); display:flex; align-items:center; justify-content:center; font-size:16px;">📦</div>
                    @endif
                </td>
                <td style="font-weight:500;">{{ $p->NamaProduk }}</td>
                <td>Rp {{ number_format($p->Harga, 0, ',', '.') }}</td>
                <td>
                    <span class="badge {{ $p->Stok <= 5 ? 'badge-danger' : ($p->Stok <= 20 ? 'badge-warning' : 'badge-success') }}">
                        {{ $p->Stok }}
                    </span>
                </td>
                <td>
                    <div style="display:flex; gap:5px;">
                        <a href="{{ route('produk.edit', $p) }}" class="btn btn-outline">Edit</a>
                        <form action="{{ route('produk.destroy', $p) }}" method="POST" id="hapus-{{ $p->ProdukID }}">
                            @csrf @method('DELETE')
                            <button type="button" class="btn btn-danger" onclick="showHapus({{ $p->ProdukID }}, '{{ $p->NamaProduk }}')">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="empty">Belum ada produk.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="pagi">{{ $produks->links() }}</div>
</div>

{{-- Modal Hapus --}}
<div class="modal-overlay" id="modal-hapus">
    <div class="modal">
        <div class="modal-icon">🗑️</div>
        <h3>Hapus Produk</h3>
        <p id="modal-text">Yakin ingin menghapus produk ini?</p>
        <div class="modal-btns">
            <button class="btn-mcancel" onclick="closeModal('modal-hapus')">Batal</button>
            <button class="btn-mconfirm" id="btn-confirm-hapus">Hapus</button>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
function showHapus(id, nama) {
    document.getElementById('modal-hapus').classList.add('show');
    document.getElementById('modal-text').textContent = 'Yakin hapus "' + nama + '"?';
    document.getElementById('btn-confirm-hapus').onclick = function () {
        document.getElementById('hapus-' + id).submit();
    };
}
function closeModal(id) {
    document.getElementById(id).classList.remove('show');
}
</script>
@endpush