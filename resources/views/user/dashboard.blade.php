<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Releaf — Beranda</title>
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
            --accent:     #3b7dd8;
        }
        body { font-family:'Inter',sans-serif; background:var(--bg); color:var(--text); min-height:100vh; font-size:13px; }

        /* NAV */
        nav {
            background: var(--sidebar-bg);
            padding: 0 32px;
            height: 54px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky; top:0; z-index:50;
        }
        .brand { font-size:17px; font-weight:700; color:#fff; letter-spacing:-0.4px; }
        .nav-right { display:flex; align-items:center; gap:22px; }
        .nav-right a {
            font-size:13px; color:rgba(255,255,255,0.45);
            text-decoration:none; font-weight:500; transition:color 0.15s;
        }
        .nav-right a:hover, .nav-right a.active { color:#fff; }
        .btn-logout {
            font-size:11px; color:rgba(255,255,255,0.35);
            background:transparent; border:1px solid rgba(255,255,255,0.12);
            border-radius:6px; padding:5px 12px; cursor:pointer;
            font-family:'Inter',sans-serif; transition:all 0.15s;
        }
        .btn-logout:hover { background:rgba(255,255,255,0.07); color:rgba(255,255,255,0.7); }

        /* BANNER */
        .banner { background:var(--sidebar-bg); padding:36px 32px; }
        .banner h1 { font-size:24px; font-weight:700; color:#fff; letter-spacing:-0.5px; margin-bottom:5px; }
        .banner p { font-size:13px; color:rgba(255,255,255,0.38); margin-bottom:18px; }
        .search-bar { display:flex; gap:8px; max-width:380px; }
        .search-bar input {
            flex:1; border:1px solid rgba(255,255,255,0.1); border-radius:7px;
            padding:9px 14px; font-size:13px; font-family:'Inter',sans-serif;
            background:rgba(255,255,255,0.07); color:#fff; outline:none; transition:border 0.15s;
        }
        .search-bar input::placeholder { color:rgba(255,255,255,0.28); }
        .search-bar input:focus { border-color:rgba(255,255,255,0.3); }
        .search-bar button {
            background:#fff; color:var(--text); border:none; border-radius:7px;
            padding:9px 18px; font-size:13px; font-weight:600; cursor:pointer;
            font-family:'Inter',sans-serif; transition:opacity 0.15s;
        }
        .search-bar button:hover { opacity:0.85; }

        /* ALERTS */
        .alerts { max-width:1200px; margin:18px auto 0; padding:0 32px; }
        .alert-success { padding:10px 14px; border-radius:8px; font-size:13px; background:#f0fdf4; border:1px solid #bbf7d0; color:#15803d; }
        .alert-error   { padding:10px 14px; border-radius:8px; font-size:13px; background:#fef2f2; border:1px solid #fecaca; color:#dc2626; }

        /* PRODUCTS */
        .products { padding:24px 32px; max-width:1200px; margin:0 auto; }
        .section-head { display:flex; justify-content:space-between; align-items:flex-end; margin-bottom:18px; }
        .section-title { font-size:15px; font-weight:600; color:var(--text); }
        .section-sub { font-size:12px; color:var(--muted); margin-top:2px; }

        .grid { display:grid; grid-template-columns:repeat(auto-fill, minmax(210px,1fr)); gap:14px; }

        .prod-card {
            background:var(--surface); border:1px solid var(--border);
            border-radius:10px; overflow:hidden; transition:box-shadow 0.2s, transform 0.2s;
        }
        .prod-card:hover { box-shadow:0 4px 18px rgba(0,0,0,0.08); transform:translateY(-2px); }

        .prod-img {
            width:100%; height:160px; background:#f2ede8;
            display:flex; align-items:center; justify-content:center;
            font-size:52px; overflow:hidden;
        }
        .prod-img img { width:100%; height:100%; object-fit:cover; }

        .prod-body { padding:13px 14px 14px; }
        .prod-name { font-size:13px; font-weight:600; color:var(--text); margin-bottom:4px; }
        .prod-price { font-size:15px; font-weight:700; color:var(--text); letter-spacing:-0.3px; margin-bottom:2px; }
        .prod-stok { font-size:11px; color:var(--muted); margin-bottom:11px; }

        .buy-row { display:flex; gap:6px; align-items:center; }
        .qty {
            width:48px; border:1px solid var(--border); border-radius:6px;
            padding:7px 6px; font-size:13px; text-align:center;
            font-family:'Inter',sans-serif; color:var(--text); outline:none;
            background:#fff;
        }
        .qty:focus { border-color:#aaa; }
        .btn-buy {
            flex:1; background:var(--text); color:#fff; border:none;
            border-radius:6px; padding:8px; font-size:12px; font-weight:500;
            cursor:pointer; font-family:'Inter',sans-serif; transition:background 0.15s;
        }
        .btn-buy:hover { background:#333; }

        .empty { text-align:center; padding:60px 20px; color:var(--muted); }
        .empty p { font-size:13px; margin-top:8px; }

        footer {
            border-top:1px solid var(--border); padding:18px 32px;
            text-align:center; font-size:12px; color:var(--muted); margin-top:40px;
        }
    </style>
</head>
<body>

<nav>
    <div class="brand">Releaf</div>
    <div class="nav-right">
        <a href="{{ route('user.dashboard') }}" class="active">Beranda</a>
        <a href="{{ route('user.keranjang') }}">Keranjang</a>
        <a href="{{ route('user.riwayat') }}">Riwayat</a>
        <a href="{{ route('user.profil') }}">Profil</a>
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn-logout">Logout →</button>
        </form>
    </div>
</nav>

<div class="banner">
    <h1>Halo, {{ Auth::user()->name }}!</h1>
    <p>Temukan tanaman yang cocok untuk dirihmu.</p>
    <form method="GET" action="{{ route('user.dashboard') }}" class="search-bar">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari tanaman...">
        <button type="submit">Cari</button>
    </form>
</div>

@if(session('success') || session('error'))
<div class="alerts">
    @if(session('success'))<div class="alert-success">✓ {{ session('success') }}</div>@endif
    @if(session('error'))<div class="alert-error">✕ {{ session('error') }}</div>@endif
</div>
@endif

<div class="products">
    <div class="section-head">
        <div>
            <div class="section-title">Katalog Tanaman</div>
            <div class="section-sub">{{ $produks->count() }} tanaman tersedia</div>
        </div>
    </div>

    @if($produks->count() > 0)
    <div class="grid">
        @foreach($produks as $p)
        <div class="prod-card">
            <div class="prod-img">
                @if($p->foto)
                    <img src="{{ asset('storage/'.$p->foto) }}" alt="{{ $p->NamaProduk }}">
                @else
                    📦
                @endif
            </div>
            <div class="prod-body">
                <div class="prod-name">{{ $p->NamaProduk }}</div>
                <div class="prod-price">Rp {{ number_format($p->Harga, 0, ',', '.') }}</div>
                <div class="prod-stok">Stok: {{ $p->Stok }}</div>
                <form action="{{ route('user.keranjang.tambah') }}" method="POST" class="buy-row">
                    @csrf
                    <input type="hidden" name="ProdukID" value="{{ $p->ProdukID }}">
                    <input type="number" name="jumlah" class="qty" value="1" min="1" max="{{ $p->Stok }}">
                    <button type="submit" class="btn-buy">+ Keranjang</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="empty">
        <div style="font-size:40px;">📦</div>
        <p>Belum ada tanaman tersedia.</p>
    </div>
    @endif
</div>

<footer>© {{ date('Y') }} Releaf</footer>
</body>
</html>