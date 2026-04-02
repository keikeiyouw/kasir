<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Releaf — Keranjang</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }
        :root {
            --sidebar-bg: #111111;
            --bg:         #f2ede8;
            --surface:    #ffffff;
            --border:     #e8e3dd;
            --text:       #1a1a1a;
            --muted:      #9a9a9a;
        }
        body { font-family:'Inter',sans-serif; background:var(--bg); color:var(--text); min-height:100vh; font-size:13px; }

        nav {
            background:var(--sidebar-bg); padding:0 32px; height:54px;
            display:flex; align-items:center; justify-content:space-between;
            position:sticky; top:0; z-index:50;
        }
        .brand { font-size:17px; font-weight:700; color:#fff; letter-spacing:-0.4px; }
        .nav-right { display:flex; align-items:center; gap:22px; }
        .nav-right a { font-size:13px; color:rgba(255,255,255,0.45); text-decoration:none; font-weight:500; transition:color 0.15s; }
        .nav-right a:hover, .nav-right a.active { color:#fff; }
        .btn-logout {
            font-size:11px; color:rgba(255,255,255,0.35); background:transparent;
            border:1px solid rgba(255,255,255,0.12); border-radius:6px; padding:5px 12px;
            cursor:pointer; font-family:'Inter',sans-serif; transition:all 0.15s;
        }
        .btn-logout:hover { background:rgba(255,255,255,0.07); color:rgba(255,255,255,0.7); }

        .page-header { background:var(--sidebar-bg); padding:26px 32px; }
        .page-header h1 { font-size:20px; font-weight:700; color:#fff; letter-spacing:-0.4px; }
        .page-header p { font-size:12px; color:rgba(255,255,255,0.35); margin-top:3px; }

        .content { max-width:680px; margin:26px auto; padding:0 32px; }

        .alert-success { padding:10px 14px; border-radius:8px; font-size:13px; margin-bottom:16px; background:#f0fdf4; border:1px solid #bbf7d0; color:#15803d; }
        .alert-error   { padding:10px 14px; border-radius:8px; font-size:13px; margin-bottom:16px; background:#fef2f2; border:1px solid #fecaca; color:#dc2626; }

        .card { background:var(--surface); border:1px solid var(--border); border-radius:10px; overflow:hidden; margin-bottom:14px; }
        .card-head { padding:13px 20px; border-bottom:1px solid var(--border); font-size:13px; font-weight:600; color:var(--text); }

        .item { display:flex; align-items:center; gap:14px; padding:14px 20px; border-bottom:1px solid #f2ede8; }
        .item:last-child { border-bottom:none; }
        .item-img {
            width:50px; height:50px; border-radius:8px; background:var(--bg);
            border:1px solid var(--border); display:flex; align-items:center;
            justify-content:center; font-size:24px; flex-shrink:0; overflow:hidden;
        }
        .item-img img { width:100%; height:100%; object-fit:cover; }
        .item-info { flex:1; }
        .item-name { font-weight:500; font-size:13px; margin-bottom:2px; }
        .item-price { font-size:12px; color:var(--muted); }

        .item-qty { display:flex; align-items:center; gap:5px; }
        .qty-btn {
            width:26px; height:26px; border:1px solid var(--border); border-radius:5px;
            background:var(--bg); cursor:pointer; font-size:14px;
            display:flex; align-items:center; justify-content:center;
            font-family:'Inter',sans-serif; transition:background 0.15s;
        }
        .qty-btn:hover { background:var(--border); }
        .qty-num { width:30px; text-align:center; font-size:13px; font-weight:500; }

        .item-subtotal { font-size:13px; font-weight:600; min-width:90px; text-align:right; }
        .btn-hapus { background:none; border:none; color:var(--muted); font-size:16px; cursor:pointer; padding:4px; transition:color 0.15s; }
        .btn-hapus:hover { color:#dc2626; }

        .checkout-box { background:var(--surface); border:1px solid var(--border); border-radius:10px; padding:18px 20px; }
        .total-row { display:flex; justify-content:space-between; align-items:center; margin-bottom:14px; }
        .total-label { font-size:13px; color:var(--muted); font-weight:500; }
        .total-val { font-size:22px; font-weight:700; color:var(--text); letter-spacing:-0.5px; }
        .btn-checkout {
            width:100%; background:var(--text); color:#fff; border:none;
            border-radius:8px; padding:12px; font-size:13px; font-weight:600;
            cursor:pointer; font-family:'Inter',sans-serif; transition:background 0.15s;
        }
        .btn-checkout:hover { background:#333; }

        .empty { text-align:center; padding:50px 20px; color:var(--muted); }
        .empty p { font-size:13px; margin-top:8px; }
        .btn-shop {
            display:inline-block; margin-top:14px; background:var(--text); color:#fff;
            padding:9px 22px; border-radius:8px; text-decoration:none; font-size:13px; font-weight:500;
        }

        /* MODAL */
        .modal-overlay { display:none; position:fixed; inset:0; background:rgba(0,0,0,0.4); z-index:200; align-items:center; justify-content:center; }
        .modal-overlay.show { display:flex; }
        .modal { background:#fff; border-radius:12px; padding:28px 24px; max-width:320px; width:90%; text-align:center; }
        .modal-icon { font-size:30px; margin-bottom:10px; }
        .modal h3 { font-size:15px; font-weight:700; color:var(--text); margin-bottom:6px; }
        .modal p { font-size:13px; color:var(--muted); margin-bottom:20px; }
        .modal-btns { display:flex; gap:8px; }
        .modal-btns button { flex:1; padding:9px; border-radius:7px; font-size:13px; font-weight:500; cursor:pointer; font-family:'Inter',sans-serif; border:none; }
        .btn-mcancel  { background:#f4f4f5; color:var(--muted); }
        .btn-mconfirm { background:var(--text); color:#fff; }
        .btn-mconfirm-red { background:#dc2626; color:#fff; }

        footer { border-top:1px solid var(--border); padding:18px 32px; text-align:center; font-size:12px; color:var(--muted); margin-top:40px; }
    </style>
</head>
<body>

<nav>
    <div class="brand">Releaf</div>
    <div class="nav-right">
        <a href="{{ route('user.dashboard') }}">Beranda</a>
        <a href="{{ route('user.keranjang') }}" class="active">Keranjang @if($items->count() > 0)({{ $items->count() }})@endif</a>
        <a href="{{ route('user.riwayat') }}">Riwayat</a>
        <a href="{{ route('user.profil') }}">Profil</a>
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn-logout">Logout →</button>
        </form>
    </div>
</nav>

<div class="page-header">
    <h1>Keranjang Belanja</h1>
    <p>{{ $items->count() }} produk di keranjang</p>
</div>

<div class="content">
    @if(session('success'))<div class="alert-success">✓ {{ session('success') }}</div>@endif
    @if(session('error'))<div class="alert-error">✕ {{ session('error') }}</div>@endif

    @if($items->count() > 0)
    <div class="card">
        <div class="card-head">Item Produk</div>
        @foreach($items as $item)
        <div class="item">
            <div class="item-img">
                @if($item->produk->foto)
                    <img src="{{ asset('storage/'.$item->produk->foto) }}">
                @else 📦 @endif
            </div>
            <div class="item-info">
                <div class="item-name">{{ $item->produk->NamaProduk }}</div>
                <div class="item-price">Rp {{ number_format($item->produk->Harga, 0, ',', '.') }}</div>
            </div>
            <div class="item-qty">
                <form action="{{ route('user.keranjang.update', $item) }}" method="POST">
                    @csrf
                    <input type="hidden" name="jumlah" value="{{ max(1, $item->jumlah - 1) }}">
                    <button type="submit" class="qty-btn">−</button>
                </form>
                <span class="qty-num">{{ $item->jumlah }}</span>
                <form action="{{ route('user.keranjang.update', $item) }}" method="POST">
                    @csrf
                    <input type="hidden" name="jumlah" value="{{ $item->jumlah + 1 }}">
                    <button type="submit" class="qty-btn">+</button>
                </form>
            </div>
            <div class="item-subtotal">Rp {{ number_format($item->produk->Harga * $item->jumlah, 0, ',', '.') }}</div>
            <form action="{{ route('user.keranjang.hapus', $item) }}" method="POST" id="hapus-{{ $item->id }}">
                @csrf
                <button type="button" class="btn-hapus" onclick="showHapus({{ $item->id }})">✕</button>
            </form>
        </div>
        @endforeach
    </div>

    <div class="checkout-box">
        <div class="total-row">
            <span class="total-label">Total Belanja</span>
            <span class="total-val">Rp {{ number_format($total, 0, ',', '.') }}</span>
        </div>
        <form action="{{ route('user.keranjang.checkout') }}" method="POST" id="form-checkout">
            @csrf
            <button type="button" class="btn-checkout" onclick="showCheckout()">Checkout Sekarang →</button>
        </form>
    </div>

    @else
    <div class="empty">
        <div style="font-size:40px;">📦</div>
        <p>Keranjang kamu masih kosong.</p>
        <a href="{{ route('user.dashboard') }}" class="btn-shop">Belanja Sekarang</a>
    </div>
    @endif
</div>

{{-- Modal Checkout --}}
<div class="modal-overlay" id="modal-checkout">
    <div class="modal">
        <div class="modal-icon">🛍️</div>
        <h3>Konfirmasi Checkout</h3>
        <p>Yakin ingin melanjutkan pembelian?</p>
        <div class="modal-btns">
            <button class="btn-mcancel" onclick="closeModal('modal-checkout')">Batal</button>
            <button class="btn-mconfirm" onclick="document.getElementById('form-checkout').submit()">Ya, Checkout</button>
        </div>
    </div>
</div>

{{-- Modal Hapus --}}
<div class="modal-overlay" id="modal-hapus">
    <div class="modal">
        <div class="modal-icon">🗑️</div>
        <h3>Hapus Produk</h3>
        <p>Yakin ingin menghapus produk ini dari keranjang?</p>
        <div class="modal-btns">
            <button class="btn-mcancel" onclick="closeModal('modal-hapus')">Batal</button>
            <button class="btn-mconfirm-red" id="btn-confirm-hapus">Ya, Hapus</button>
        </div>
    </div>
</div>

<footer>© {{ date('Y') }} Releaf</footer>
<script>
function showCheckout() { document.getElementById('modal-checkout').classList.add('show'); }
function showHapus(id) {
    document.getElementById('modal-hapus').classList.add('show');
    document.getElementById('btn-confirm-hapus').onclick = function () {
        document.getElementById('hapus-' + id).submit();
    };
}
function closeModal(id) { document.getElementById(id).classList.remove('show'); }
</script>
</body>
</html>