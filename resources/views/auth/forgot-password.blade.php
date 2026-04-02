<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Releaf — Lupa Password</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        :root { --black:#0a0a0f; --blue:#3b82f6; --blue-s:#60a5fa; --cream:#f8f7f4; --border:#e5e4de; --text:#1a1a2e; --muted:#6b7280; }
        body { font-family:'Plus Jakarta Sans',sans-serif; min-height:100vh; display:flex; background:var(--cream); }
        .left { width:45%; background:var(--black); display:flex; flex-direction:column; justify-content:center; padding:56px 48px; position:relative; overflow:hidden; }
        .left::before { content:''; position:absolute; top:-100px; right:-100px; width:400px; height:400px; border-radius:50%; background:radial-gradient(circle, rgba(59,130,246,0.15) 0%, transparent 70%); }
        .left-content { position:relative; z-index:1; }
        .logo { font-size:40px; font-weight:700; color:#fff; letter-spacing:-1px; }
        .logo span { color:var(--blue-s); }
        .motto { font-size:14px; color:rgba(255,255,255,0.4); margin-top:5px; margin-bottom:36px; font-style:italic; }
        .divider { width:36px; height:2px; background:rgba(59,130,246,0.4); margin-bottom:24px; }
        .left-desc { font-size:13px; color:rgba(255,255,255,0.35); line-height:1.8; max-width:280px; }
        .right { flex:1; display:flex; align-items:center; justify-content:center; padding:48px 40px; position:relative; }
        .right::before { content:''; position:absolute; inset:0; background-image:radial-gradient(circle, #c5c3bb 1px, transparent 1px); background-size:28px 28px; opacity:0.25; pointer-events:none; }
        .form-wrap { width:100%; max-width:360px; position:relative; z-index:1; }
        .form-head { margin-bottom:24px; }
        .form-head h2 { font-size:24px; font-weight:700; color:var(--text); margin-bottom:4px; }
        .form-head p { font-size:13px; color:var(--muted); line-height:1.6; }
        .form-group { margin-bottom:14px; }
        .form-label { display:block; font-size:11px; font-weight:600; text-transform:uppercase; letter-spacing:0.5px; color:var(--muted); margin-bottom:5px; }
        .form-control { width:100%; border:1px solid var(--border); border-radius:7px; padding:10px 12px; font-size:13px; font-family:'Plus Jakarta Sans',sans-serif; color:var(--text); background:#fff; outline:none; }
        .form-control:focus { border-color:var(--blue); box-shadow:0 0 0 3px rgba(59,130,246,0.1); }
        .btn-submit { width:100%; background:var(--blue); color:#fff; border:none; border-radius:8px; padding:11px; font-size:14px; font-weight:600; cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif; }
        .btn-submit:hover { background:var(--blue-s); }
        .footer-link { text-align:center; font-size:12px; color:var(--muted); margin-top:20px; }
        .footer-link a { color:var(--blue); text-decoration:none; font-weight:500; }
        .alert-success { padding:10px 12px; border-radius:7px; font-size:12px; margin-bottom:14px; background:#f0fdf4; border:1px solid #bbf7d0; color:#15803d; }
        .alert-error { padding:10px 12px; border-radius:7px; font-size:12px; margin-bottom:14px; background:#fef2f2; border:1px solid #fecaca; color:#dc2626; }
        @media(max-width:680px) { .left { display:none; } }
    </style>
</head>
<body>
<div class="left">
    <div class="left-content">
        <div class="logo">Re<span>leaf</span></div>
        <div class="motto">Grow Your Calm 🌿</div>
        <div class="divider"></div>
        <div class="left-desc">Tenang, kami akan bantu kamu reset password dengan mudah.</div>
    </div>
</div>
<div class="right">
    <div class="form-wrap">
        <div class="form-head"><h2>Lupa Password?</h2><p>Masukkan email kamu dan kami akan kirimkan link reset password.</p></div>
        @if(session('status'))<div class="alert-success">{{ session('status') }}</div>@endif
        @if($errors->any())<div class="alert-error">{{ $errors->first() }}</div>@endif
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group"><label class="form-label">Email</label><input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="email@contoh.com" required autofocus></div>
            <button type="submit" class="btn-submit">Kirim Link Reset</button>
        </form>
        <div class="footer-link"><a href="{{ route('login') }}">← Kembali login</a></div>
    </div>
</div>
</body>
</html>