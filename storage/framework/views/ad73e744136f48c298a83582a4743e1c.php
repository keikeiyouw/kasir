<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Releaf — Riwayat</title>
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

        .content { max-width:820px; margin:26px auto; padding:0 32px; }

        .alert-success { padding:10px 14px; border-radius:8px; font-size:13px; margin-bottom:16px; background:#f0fdf4; border:1px solid #bbf7d0; color:#15803d; }

        .trx-card { background:var(--surface); border:1px solid var(--border); border-radius:10px; overflow:hidden; margin-bottom:14px; }
        .trx-head {
            padding:13px 20px; display:flex; justify-content:space-between; align-items:center;
            border-bottom:1px solid var(--border); background:#faf8f5;
        }
        .trx-id { font-size:13px; font-weight:600; color:var(--text); }
        .trx-date { font-size:11px; color:var(--muted); margin-top:2px; }
        .trx-total { font-size:16px; font-weight:700; color:var(--text); letter-spacing:-0.3px; }

        table { width:100%; border-collapse:collapse; }
        thead th {
            padding:9px 20px; text-align:left; font-size:10px; font-weight:600;
            text-transform:uppercase; letter-spacing:0.8px; color:var(--muted);
            border-bottom:1px solid var(--border); background:#faf8f5;
        }
        tbody td { padding:11px 20px; border-bottom:1px solid #f2ede8; }
        tbody tr:last-child td { border-bottom:none; }
        tbody tr:hover td { background:#faf8f5; }

        .empty { text-align:center; padding:56px 20px; color:var(--muted); }
        .empty p { font-size:13px; margin-top:8px; }
        .btn-shop {
            display:inline-block; margin-top:14px; background:var(--text); color:#fff;
            padding:9px 22px; border-radius:8px; text-decoration:none; font-size:13px; font-weight:500;
        }

        footer { border-top:1px solid var(--border); padding:18px 32px; text-align:center; font-size:12px; color:var(--muted); margin-top:40px; }
    </style>
</head>
<body>

<nav>
    <div class="brand">Releaf</div>
    <div class="nav-right">
        <a href="<?php echo e(route('user.dashboard')); ?>">Beranda</a>
        <a href="<?php echo e(route('user.keranjang')); ?>">Keranjang</a>
        <a href="<?php echo e(route('user.riwayat')); ?>" class="active">Riwayat</a>
        <a href="<?php echo e(route('user.profil')); ?>">Profil</a>
        <form action="<?php echo e(route('logout')); ?>" method="POST" style="display:inline;">
            <?php echo csrf_field(); ?>
            <button type="submit" class="btn-logout">Logout →</button>
        </form>
    </div>
</nav>

<div class="page-header">
    <h1>Riwayat Pembelian</h1>
    <p>Semua transaksi pembelian kamu</p>
</div>

<div class="content">
    <?php if(session('success')): ?><div class="alert-success">✓ <?php echo e(session('success')); ?></div><?php endif; ?>

    <?php if($riwayat->count() > 0): ?>
        <?php $__currentLoopData = $riwayat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="trx-card">
            <div class="trx-head">
                <div>
                    <div class="trx-id">#PJL-<?php echo e(str_pad($r->PenjualanID, 3, '0', STR_PAD_LEFT)); ?></div>
                    <div class="trx-date"><?php echo e(\Carbon\Carbon::parse($r->TanggalPenjualan)->isoFormat('D MMMM Y')); ?></div>
                </div>
                <div class="trx-total">Rp <?php echo e(number_format($r->TotalHarga, 0, ',', '.')); ?></div>
            </div>
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
                    <?php $__currentLoopData = $r->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td style="font-weight:500;"><?php echo e($d->produk->NamaProduk ?? '-'); ?></td>
                        <td style="color:var(--muted);">Rp <?php echo e(number_format($d->produk->Harga ?? 0, 0, ',', '.')); ?></td>
                        <td><?php echo e($d->JumlahProduk); ?></td>
                        <td style="font-weight:600;">Rp <?php echo e(number_format($d->Subtotal, 0, ',', '.')); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
    <div class="empty">
        <div style="font-size:40px;">📦</div>
        <p>Belum ada riwayat pembelian.</p>
        <a href="<?php echo e(route('user.dashboard')); ?>" class="btn-shop">Belanja Sekarang</a>
    </div>
    <?php endif; ?>
</div>

<footer>© <?php echo e(date('Y')); ?> Releaf</footer>
</body>
</html><?php /**PATH C:\laragon\www\kasir\resources\views/user/riwayat.blade.php ENDPATH**/ ?>