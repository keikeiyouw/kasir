<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Releaf — Profil</title>
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

        .content { max-width:460px; margin:26px auto; padding:0 32px; }

        .alert-success { padding:10px 14px; border-radius:8px; font-size:13px; margin-bottom:16px; background:#f0fdf4; border:1px solid #bbf7d0; color:#15803d; }
        .alert-error   { padding:10px 14px; border-radius:8px; font-size:13px; margin-bottom:16px; background:#fef2f2; border:1px solid #fecaca; color:#dc2626; }

        .card { background:var(--surface); border:1px solid var(--border); border-radius:10px; overflow:hidden; }
        .card-head { padding:13px 20px; border-bottom:1px solid var(--border); font-size:13px; font-weight:600; color:var(--text); }
        .card-body { padding:20px; }

        .form-group { margin-bottom:14px; }
        .form-label { display:block; font-size:10px; font-weight:600; text-transform:uppercase; letter-spacing:0.8px; color:var(--muted); margin-bottom:5px; }
        .form-control {
            width:100%; border:1px solid var(--border); border-radius:7px;
            padding:9px 12px; font-size:13px; font-family:'Inter',sans-serif;
            color:var(--text); background:#fff; outline:none; transition:border 0.15s;
        }
        .form-control:focus { border-color:#aaa; box-shadow:0 0 0 3px rgba(0,0,0,0.05); }
        .form-control:disabled { background:var(--bg); color:var(--muted); cursor:not-allowed; }

        textarea.form-control { resize:vertical; }

        .btn-submit {
            background:var(--text); color:#fff; border:none; border-radius:7px;
            padding:9px 20px; font-size:13px; font-weight:500; cursor:pointer;
            font-family:'Inter',sans-serif; transition:background 0.15s;
        }
        .btn-submit:hover { background:#333; }

        footer { border-top:1px solid var(--border); padding:18px 32px; text-align:center; font-size:12px; color:var(--muted); margin-top:40px; }
    </style>
</head>
<body>

<nav>
    <div class="brand">Releaf</div>
    <div class="nav-right">
        <a href="<?php echo e(route('user.dashboard')); ?>">Beranda</a>
        <a href="<?php echo e(route('user.keranjang')); ?>">Keranjang</a>
        <a href="<?php echo e(route('user.riwayat')); ?>">Riwayat</a>
        <a href="<?php echo e(route('user.profil')); ?>" class="active">Profil</a>
        <form action="<?php echo e(route('logout')); ?>" method="POST" style="display:inline;">
            <?php echo csrf_field(); ?>
            <button type="submit" class="btn-logout">Logout →</button>
        </form>
    </div>
</nav>

<div class="page-header">
    <h1>Profil Saya</h1>
    <p>Lengkapi data diri kamu</p>
</div>

<div class="content">
    <?php if(session('success')): ?><div class="alert-success">✓ <?php echo e(session('success')); ?></div><?php endif; ?>
    <?php if(session('error')): ?><div class="alert-error">✕ <?php echo e(session('error')); ?></div><?php endif; ?>

    <div class="card">
        <div class="card-head">Data Diri</div>
        <div class="card-body">
            <form action="<?php echo e(route('user.profil.update')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control" value="<?php echo e(Auth::user()->name); ?>" disabled>
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="text" class="form-control" value="<?php echo e(Auth::user()->email); ?>" disabled>
                </div>
                <div class="form-group">
                    <label class="form-label">Nomor Telepon</label>
                    <input type="text" name="NomorTelepon" class="form-control"
                        value="<?php echo e($pelanggan && $pelanggan->NomorTelepon != '-' ? $pelanggan->NomorTelepon : ''); ?>"
                        placeholder="08xxxxxxxxxx">
                </div>
                <div class="form-group">
                    <label class="form-label">Alamat</label>
                    <textarea name="Alamat" class="form-control" rows="3" placeholder="Alamat lengkap..."><?php echo e($pelanggan && $pelanggan->Alamat != '-' ? $pelanggan->Alamat : ''); ?></textarea>
                </div>
                <button type="submit" class="btn-submit">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>

<footer>© <?php echo e(date('Y')); ?> Releaf</footer>
</body>
</html><?php /**PATH C:\laragon\www\kasir\resources\views/user/profil.blade.php ENDPATH**/ ?>