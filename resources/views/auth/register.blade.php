<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Releaf — Daftar</title>
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
        .left-desc { font-size:13px; color:rgba(255,255,255,0.35); line-height:1.8; max-width:280px; margin-bottom:32px; }
        .steps { display:flex; flex-direction:column; gap:12px; }
        .step { display:flex; align-items:center; gap:10px; }
        .step-num { width:24px; height:24px; border-radius:50%; background:rgba(59,130,246,0.2); border:1px solid rgba(59,130,246,0.3); display:flex; align-items:center; justify-content:center; font-size:10px; font-weight:700; color:var(--blue-s); flex-shrink:0; }
        .step-text { font-size:12px; color:rgba(255,255,255,0.4); }

        .right { flex:1; display:flex; align-items:center; justify-content:center; padding:48px 40px; position:relative; overflow-y:auto; }
        .right::before { content:''; position:absolute; inset:0; background-image:radial-gradient(circle, #c5c3bb 1px, transparent 1px); background-size:28px 28px; opacity:0.25; pointer-events:none; }

        .form-wrap { width:100%; max-width:360px; position:relative; z-index:1; }
        .form-head { margin-bottom:20px; }
        .form-head h2 { font-size:24px; font-weight:700; color:var(--text); margin-bottom:4px; }
        .form-head p { font-size:13px; color:var(--muted); }

        .form-group { margin-bottom:13px; }
        .form-label { display:block; font-size:11px; font-weight:600; text-transform:uppercase; letter-spacing:0.5px; color:var(--muted); margin-bottom:5px; }
        .form-control { width:100%; border:1px solid var(--border); border-radius:7px; padding:10px 12px; font-size:13px; font-family:'Plus Jakarta Sans',sans-serif; color:var(--text); background:#fff; outline:none; transition:border 0.15s; }
        .form-control:focus { border-color:var(--blue); box-shadow:0 0 0 3px rgba(59,130,246,0.1); }
        .form-control.err { border-color:#dc2626; }
        .field-err { font-size:11px; color:#dc2626; margin-top:3px; }

        .strength { margin-top:6px; }
        .strength-bar { display:flex; gap:3px; }
        .strength-bar span { height:3px; flex:1; border-radius:3px; background:var(--border); transition:background 0.2s; }
        .strength-label { font-size:11px; color:var(--muted); margin-top:4px; }

        .btn-submit { width:100%; background:var(--blue); color:#fff; border:none; border-radius:8px; padding:11px; font-size:14px; font-weight:600; cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif; transition:background 0.15s; margin-top:4px; }
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
        <div class="left-desc">Buat akun dan mulai temukan tanaman favoritmu. Gratis dan mudah.</div>
        <div class="steps">
            <div class="step"><div class="step-num">1</div><div class="step-text">Buat akun</div></div>
            <div class="step"><div class="step-num">2</div><div class="step-text">Jelajahi katalog tanaman</div></div>
            <div class="step"><div class="step-num">3</div><div class="step-text">Beli & nikmati tanamanmu</div></div>
        </div>
    </div>
</div>
<div class="right">
    <div class="form-wrap">
        <div class="form-head">
            <h2>Daftar</h2>
            <p>Buat akun baru di Releaf</p>
        </div>

        @if($errors->any())
        <div class="alert">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label class="form-label">Nama</label>
                <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'err' : '' }}" value="{{ old('name') }}" placeholder="Nama lengkap" required autofocus>
                @error('name')<div class="field-err">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'err' : '' }}" value="{{ old('email') }}" placeholder="email@contoh.com" required>
                @error('email')<div class="field-err">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" id="pw" class="form-control {{ $errors->has('password') ? 'err' : '' }}" placeholder="Minimal 8 karakter" required oninput="cekKuat(this.value)">
                <div class="strength">
                    <div class="strength-bar"><span id="s1"></span><span id="s2"></span><span id="s3"></span><span id="s4"></span></div>
                    <div class="strength-label" id="slabel"></div>
                </div>
                @error('password')<div class="field-err">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
            </div>
            <button type="submit" class="btn-submit">Daftar Sekarang</button>
        </form>
        <div class="footer-link">Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></div>
    </div>
</div>
<script>
function cekKuat(v){
    const bars=['s1','s2','s3','s4'].map(id=>document.getElementById(id));
    const label=document.getElementById('slabel');
    const w=['#ef4444','#f97316','#eab308','#22c55e'];
    const t=['Lemah','Cukup','Sedang','Kuat'];
    let s=0;
    if(v.length>=8)s++;if(/[A-Z]/.test(v))s++;if(/[0-9]/.test(v))s++;if(/[^A-Za-z0-9]/.test(v))s++;
    bars.forEach((b,i)=>b.style.background=i<s?w[s-1]:'var(--border)');
    label.textContent=v.length?(t[s-1]||''):'';
}
</script>
</body>
</html>