<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Releaf — Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        :root { --black:#0a0a0f; --dark:#111118; --blue:#3b82f6; --blue-s:#60a5fa; --cream:#f8f7f4; --border:#e5e4de; --text:#1a1a2e; --muted:#6b7280; }
        body { font-family:'Plus Jakarta Sans',sans-serif; min-height:100vh; display:flex; background:var(--cream); }

        .left {
            width:45%; background:var(--black);
            display:flex; flex-direction:column; justify-content:center;
            padding:56px 48px; position:relative; overflow:hidden;
        }
        .left::before { content:''; position:absolute; top:-100px; right:-100px; width:400px; height:400px; border-radius:50%; background:radial-gradient(circle, rgba(59,130,246,0.15) 0%, transparent 70%); }
        .left::after { content:''; position:absolute; bottom:-80px; left:-80px; width:300px; height:300px; border-radius:50%; background:radial-gradient(circle, rgba(59,130,246,0.08) 0%, transparent 70%); }
        .left-content { position:relative; z-index:1; }
        .logo { font-size:40px; font-weight:700; color:#fff; letter-spacing:-1px; }
        .logo span { color:var(--blue-s); }
        .motto { font-size:14px; color:rgba(255,255,255,0.4); margin-top:5px; margin-bottom:36px; font-style:italic; }
        .divider { width:36px; height:2px; background:rgba(59,130,246,0.4); margin-bottom:24px; }
        .left-desc { font-size:13px; color:rgba(255,255,255,0.35); line-height:1.8; max-width:280px; }

        .pills { display:flex; gap:8px; margin-top:32px; }
        .pill { padding:5px 12px; border-radius:20px; font-size:12px; font-weight:500; cursor:pointer; border:1px solid rgba(255,255,255,0.15); color:rgba(255,255,255,0.4); transition:all 0.15s; }
        .pill.active { background:var(--blue); color:#fff; border-color:var(--blue); }

        .right { flex:1; display:flex; align-items:center; justify-content:center; padding:48px 40px; position:relative; }
        .right::before { content:''; position:absolute; inset:0; background-image:radial-gradient(circle, #c5c3bb 1px, transparent 1px); background-size:28px 28px; opacity:0.25; pointer-events:none; }

        .form-wrap { width:100%; max-width:360px; position:relative; z-index:1; }
        .form-head { margin-bottom:24px; }
        .form-head h2 { font-size:24px; font-weight:700; color:var(--text); margin-bottom:4px; }
        .form-head p { font-size:13px; color:var(--muted); }

        .form-group { margin-bottom:14px; }
        .form-label { display:block; font-size:11px; font-weight:600; text-transform:uppercase; letter-spacing:0.5px; color:var(--muted); margin-bottom:5px; }
        .form-control { width:100%; border:1px solid var(--border); border-radius:7px; padding:10px 12px; font-size:13px; font-family:'Plus Jakarta Sans',sans-serif; color:var(--text); background:#fff; outline:none; transition:border 0.15s; }
        .form-control:focus { border-color:var(--blue); box-shadow:0 0 0 3px rgba(59,130,246,0.1); }

        .form-row { display:flex; justify-content:space-between; align-items:center; margin-bottom:18px; }
        .remember { display:flex; align-items:center; gap:6px; font-size:12px; color:var(--muted); cursor:pointer; }
        .remember input { accent-color:var(--blue); }
        .forgot { font-size:12px; color:var(--blue); text-decoration:none; font-weight:500; }
        .forgot:hover { text-decoration:underline; }

        .btn-submit { width:100%; background:var(--blue); color:#fff; border:none; border-radius:8px; padding:11px; font-size:14px; font-weight:600; cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif; transition:background 0.15s; }
        .btn-submit:hover { background:var(--blue-s); }

        .footer-link { text-align:center; font-size:12px; color:var(--muted); margin-top:20px; }
        .footer-link a { color:var(--blue); text-decoration:none; font-weight:500; }
        .footer-link a:hover { text-decoration:underline; }

        .alert { padding:9px 12px; border-radius:7px; font-size:12px; margin-bottom:14px; background:#fef2f2; border:1px solid #fecaca; color:#dc2626; }

        @media(max-width:680px) { .left { display:none; } }
    </style>
</head>
<body>
<div class="left">
    <div class="left-content">
        <div class="logo">Re<span>leaf</span></div>
        <div class="motto">Grow Your Calm 🌿</div>
        <div class="divider"></div>
    </div>
</div>
<div class="right">
    <div class="form-wrap">
        <div class="form-head">
            <h2>Masuk</h2>
            <p>Selamat datang kembali di Releaf</p>
        </div>
        @if($errors->any())<div class="alert">{{ $errors->first() }}</div>@endif
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group"><label class="form-label">Email</label><input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="contoh@gmail.com" required autofocus></div>
            <div class="form-group"><label class="form-label">Password</label><input type="password" name="password" class="form-control" placeholder="Password" required></div>
            <div class="form-row">
                <label class="remember"><input type="checkbox" name="remember"> Ingat saya</label>
            </div>
            <button type="submit" class="btn-submit">Masuk</button>
        </form>
        <div class="footer-link">Belum punya akun? <a href="{{ route('register') }}">Daftar</a></div>
    </div>
</div>
<script>
function setRole(r){
    document.getElementById('pill-admin').classList.toggle('active',r==='admin');
    document.getElementById('pill-user').classList.toggle('active',r==='user');
}
</script>
</body>
</html>