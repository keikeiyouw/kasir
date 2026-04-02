<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title'); ?> — Releaf</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --sidebar-bg:   #111111;
            --sidebar-w:    220px;
            --bg:           #f2ede8;
            --surface:      #ffffff;
            --border:       #e8e3dd;
            --text:         #1a1a1a;
            --muted:        #9a9a9a;
            --accent-red:   #e05c3a;
            --accent-blue:  #3b7dd8;
            --accent-green: #3aaa6f;
            --accent-purple:#7c5cbf;
            --accent-orange:#e08f3a;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            display: flex;
            min-height: 100vh;
            font-size: 13px;
        }

        /* ─── SIDEBAR ─── */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--sidebar-bg);
            min-height: 100vh;
            position: fixed;
            top: 0; left: 0;
            display: flex;
            flex-direction: column;
            z-index: 100;
        }

        .brand {
            padding: 22px 20px 18px;
            border-bottom: 1px solid rgba(255,255,255,0.07);
        }
        .brand-name {
            font-size: 18px;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: -0.5px;
        }
        .brand-sub {
            font-size: 10px;
            color: rgba(255,255,255,0.28);
            text-transform: uppercase;
            letter-spacing: 1.8px;
            margin-top: 3px;
        }

        .nav { flex: 1; padding: 16px 0; }
        .nav-section {
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.22);
            padding: 10px 20px 5px;
        }
        .nav a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 20px;
            color: rgba(255,255,255,0.45);
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            transition: all 0.15s;
            border-left: 3px solid transparent;
        }
        .nav a:hover {
            background: rgba(255,255,255,0.05);
            color: rgba(255,255,255,0.8);
        }
        .nav a.active {
            background: rgba(255,255,255,0.07);
            color: #ffffff;
            border-left-color: #ffffff;
        }
        .nav a svg {
            width: 15px; height: 15px;
            flex-shrink: 0;
            opacity: 0.7;
        }
        .nav a.active svg { opacity: 1; }

        .sidebar-foot {
            padding: 14px 20px;
            border-top: 1px solid rgba(255,255,255,0.07);
        }
        .foot-user {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
        }
        .foot-avatar {
            width: 32px; height: 32px;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; font-weight: 700;
            color: rgba(255,255,255,0.8);
            flex-shrink: 0;
        }
        .foot-name { font-size: 12px; color: rgba(255,255,255,0.7); font-weight: 500; }
        .foot-role { font-size: 10px; color: rgba(255,255,255,0.28); margin-top: 1px; }
        .btn-logout {
            width: 100%;
            background: transparent;
            border: 1px solid rgba(255,255,255,0.12);
            color: rgba(255,255,255,0.35);
            border-radius: 6px;
            padding: 7px;
            font-size: 11px;
            font-weight: 500;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
            letter-spacing: 0.3px;
            transition: all 0.15s;
        }
        .btn-logout:hover {
            background: rgba(255,255,255,0.07);
            color: rgba(255,255,255,0.65);
        }

        /* ─── MAIN ─── */
        .main {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            background: var(--bg);
            padding: 18px 28px 0;
        }
        .topbar-inner {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            padding-bottom: 18px;
            border-bottom: 1px solid var(--border);
        }
        .topbar-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--text);
            letter-spacing: -0.4px;
        }
        .topbar-date {
            font-size: 12px;
            color: var(--muted);
        }

        .content { padding: 24px 28px; flex: 1; }

        /* ─── ALERTS ─── */
        .alert {
            padding: 11px 14px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .alert-success { background: #f0fdf4; border: 1px solid #bbf7d0; color: #15803d; }
        .alert-error   { background: #fef2f2; border: 1px solid #fecaca; color: #dc2626; }

        /* ─── STAT CARDS ─── */
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
            margin-bottom: 22px;
        }
        .stat-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 18px 20px 16px;
            position: relative;
            overflow: hidden;
        }
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
        }
        .stat-card:nth-child(1)::before { background: var(--accent-red); }
        .stat-card:nth-child(2)::before { background: var(--accent-blue); }
        .stat-card:nth-child(3)::before { background: var(--accent-green); }
        .stat-card:nth-child(4)::before { background: var(--accent-purple); }

        .stat-label {
            font-size: 10px;
            font-weight: 600;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 10px;
        }
        .stat-val {
            font-size: 28px;
            font-weight: 700;
            color: var(--text);
            letter-spacing: -1px;
            line-height: 1;
        }
        .stat-val.sm { font-size: 18px; letter-spacing: -0.5px; }
        .stat-sub {
            font-size: 11px;
            color: var(--muted);
            margin-top: 5px;
        }

        /* ─── CARD ─── */
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 20px;
        }
        .card-head {
            padding: 14px 20px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .card-title {
            font-size: 14px;
            font-weight: 600;
            color: var(--text);
        }
        .card-body { padding: 20px; }

        /* ─── TABLE ─── */
        table { width: 100%; border-collapse: collapse; }
        thead th {
            padding: 10px 20px;
            text-align: left;
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: var(--muted);
            background: #faf8f5;
            border-bottom: 1px solid var(--border);
        }
        tbody td {
            padding: 12px 20px;
            border-bottom: 1px solid #f2ede8;
            color: var(--text);
        }
        tbody tr:last-child td { border-bottom: none; }
        tbody tr:hover td { background: #faf8f5; }

        /* ─── BUTTONS ─── */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 7px 13px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            border: none;
            font-family: 'Inter', sans-serif;
            transition: all 0.15s;
        }
        .btn-primary { background: var(--text); color: #fff; }
        .btn-primary:hover { background: #333; }
        .btn-outline { background: transparent; color: var(--text); border: 1px solid var(--border); }
        .btn-outline:hover { background: var(--bg); }
        .btn-danger { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }
        .btn-danger:hover { background: #fee2e2; }
        .btn-link {
            background: none; border: none;
            color: var(--muted); font-size: 12px;
            font-weight: 500; cursor: pointer;
            text-decoration: none;
            font-family: 'Inter', sans-serif;
            transition: color 0.15s;
        }
        .btn-link:hover { color: var(--text); }

        /* ─── BADGE ─── */
        .badge {
            display: inline-block;
            padding: 3px 9px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.2px;
        }
        .badge-success  { background: #f0fdf4; color: #15803d; }
        .badge-warning  { background: #fff7ed; color: #c2410c; }
        .badge-danger   { background: #fef2f2; color: #dc2626; }
        .badge-info     { background: #eff6ff; color: #1d4ed8; }
        .badge-neutral  { background: #f4f4f5; color: #71717a; }

        /* ─── FORM ─── */
        .form-group { margin-bottom: 16px; }
        .form-label {
            display: block;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--muted);
            margin-bottom: 6px;
        }
        .form-control {
            width: 100%;
            border: 1px solid var(--border);
            border-radius: 7px;
            padding: 9px 12px;
            font-size: 13px;
            font-family: 'Inter', sans-serif;
            color: var(--text);
            background: #fff;
            outline: none;
            transition: border 0.15s;
        }
        .form-control:focus { border-color: #aaa; box-shadow: 0 0 0 3px rgba(0,0,0,0.05); }
        .form-2col { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }

        /* ─── PAGINATION ─── */
        .pagi {
            display: flex;
            gap: 4px;
            padding: 14px 20px;
            justify-content: flex-end;
            border-top: 1px solid var(--border);
        }
        .pagi a, .pagi span {
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
            text-decoration: none;
            color: var(--muted);
            border: 1px solid var(--border);
            background: var(--surface);
        }
        .pagi .active span {
            background: var(--text);
            color: #fff;
            border-color: var(--text);
        }

        /* ─── EMPTY STATE ─── */
        .empty {
            text-align: center;
            padding: 40px;
            color: var(--muted);
            font-size: 13px;
        }

        /* ─── MODAL ─── */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.4);
            z-index: 300;
            align-items: center;
            justify-content: center;
        }
        .modal-overlay.show { display: flex; }
        .modal {
            background: #fff;
            border-radius: 12px;
            padding: 28px 24px;
            max-width: 340px;
            width: 90%;
            text-align: center;
        }
        .modal-icon { font-size: 32px; margin-bottom: 10px; }
        .modal h3 { font-size: 15px; font-weight: 700; color: var(--text); margin-bottom: 6px; }
        .modal p { font-size: 13px; color: var(--muted); margin-bottom: 20px; }
        .modal-btns { display: flex; gap: 8px; }
        .modal-btns button {
            flex: 1; padding: 9px;
            border-radius: 7px; font-size: 13px;
            font-weight: 500; cursor: pointer;
            font-family: 'Inter', sans-serif; border: none;
        }
        .btn-mcancel { background: #f4f4f5; color: var(--muted); }
        .btn-mconfirm { background: #dc2626; color: #fff; }
    </style>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>

<aside class="sidebar">
    <div class="brand">
        <div class="brand-name">Releaf</div>
        <div class="brand-sub">Admin Panel</div>
    </div>

    <nav class="nav">
        <div class="nav-section">Menu</div>
        <a href="<?php echo e(route('dashboard')); ?>" class="<?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
            Dashboard
        </a>
        <a href="<?php echo e(route('produk.index')); ?>" class="<?php echo e(request()->routeIs('produk.*') ? 'active' : ''); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M20 7H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z"/><path d="M16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2"/></svg>
            Produk
        </a>
        <a href="<?php echo e(route('pelanggan.index')); ?>" class="<?php echo e(request()->routeIs('pelanggan.*') ? 'active' : ''); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
            Pelanggan
        </a>
        <a href="<?php echo e(route('penjualan.index')); ?>" class="<?php echo e(request()->routeIs('penjualan.*') ? 'active' : ''); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="1"/><path d="M9 12h6M9 16h4"/></svg>
            Penjualan
        </a>
        <a href="<?php echo e(route('detailpenjualan.index')); ?>" class="<?php echo e(request()->routeIs('detailpenjualan.*') ? 'active' : ''); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 10h16M4 14h10M4 18h6"/></svg>
            Detail Penjualan
        </a>
    </nav>

    <div class="sidebar-foot">
        <div class="foot-user">
            <div class="foot-avatar"><?php echo e(strtoupper(substr(Auth::user()->name, 0, 1))); ?></div>
            <div>
                <div class="foot-name"><?php echo e(Auth::user()->name); ?></div>
                <div class="foot-role">Administrator</div>
            </div>
        </div>
        <form action="<?php echo e(route('logout')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <button type="submit" class="btn-logout">Logout →</button>
        </form>
    </div>
</aside>

<div class="main">
    <div class="topbar">
        <div class="topbar-inner">
            <div class="topbar-title"><?php echo $__env->yieldContent('title'); ?></div>
            <div class="topbar-date"><?php echo e(now()->isoFormat('HH.mm.ss')); ?></div>
        </div>
    </div>
    <div class="content">
        <?php if(session('success')): ?>
        <div class="alert alert-success">✓ <?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session('error')): ?>
        <div class="alert alert-error">✕ <?php echo e(session('error')); ?></div>
        <?php endif; ?>
        <?php echo $__env->yieldContent('content'); ?>
    </div>
</div>

<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH C:\laragon\www\kasir\resources\views/admin/layout.blade.php ENDPATH**/ ?>