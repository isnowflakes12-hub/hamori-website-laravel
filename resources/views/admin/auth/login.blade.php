<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Masuk — Admin Panel RS Hamori</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Libre+Baskerville:wght@400;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<style>
*{box-sizing:border-box;margin:0;padding:0}
html,body{height:100%;font-family:'Plus Jakarta Sans',sans-serif}

/* ── Layout ── */
.login-page{
    min-height:100vh;
    display:grid;
    grid-template-columns:1fr 480px;
}

/* ── Left panel ── */
.login-left{
    background:linear-gradient(145deg,#06102b 0%,#0d2260 40%,#0055a5 100%);
    display:flex;
    flex-direction:column;
    justify-content:space-between;
    padding:48px 56px;
    position:relative;
    overflow:hidden;
}
.ll-deco{
    position:absolute;
    border-radius:50%;
    background:rgba(255,255,255,.04);
}
.ll-deco-1{width:500px;height:500px;top:-180px;right:-120px}
.ll-deco-2{width:320px;height:320px;bottom:-100px;left:-80px}
.ll-deco-3{width:160px;height:160px;top:50%;right:80px;transform:translateY(-50%);background:rgba(0,168,89,.08)}

.ll-brand{
    display:flex;
    align-items:center;
    gap:14px;
    position:relative;
    z-index:2;
}
.ll-brand-icon{
    width:48px;height:48px;
    background:rgba(255,255,255,.12);
    border:1px solid rgba(255,255,255,.2);
    border-radius:14px;
    display:flex;align-items:center;justify-content:center;
    font-size:22px;color:#fff;
    backdrop-filter:blur(8px);
}
.ll-brand-name{
    font-family:'Libre Baskerville',serif;
    font-size:18px;font-weight:700;color:#fff;
}
.ll-brand-sub{font-size:12px;color:rgba(255,255,255,.55);margin-top:1px}

.ll-main{position:relative;z-index:2}
.ll-tag{
    display:inline-flex;align-items:center;gap:8px;
    font-size:11px;font-weight:700;letter-spacing:3px;text-transform:uppercase;
    color:rgba(255,255,255,.55);margin-bottom:20px;
}
.ll-tag-dot{
    width:6px;height:6px;border-radius:50%;
    background:#00d97e;
    box-shadow:0 0 0 3px rgba(0,217,126,.25);
    animation:dotPulse 2s ease infinite;flex-shrink:0;
}
@keyframes dotPulse{0%,100%{box-shadow:0 0 0 3px rgba(0,217,126,.25)}50%{box-shadow:0 0 0 8px rgba(0,217,126,0)}}
.ll-headline{
    font-family:'Libre Baskerville',serif;
    font-size:clamp(2rem,3.5vw,2.8rem);
    font-weight:700;color:#fff;line-height:1.15;
    margin-bottom:18px;
}
.ll-headline span{color:#5bc8f5}
.ll-desc{font-size:15px;color:rgba(255,255,255,.62);line-height:1.75;max-width:400px;margin-bottom:40px}

.ll-stats{display:flex;gap:0}
.ll-stat{
    padding:16px 24px;
    border-left:1px solid rgba(255,255,255,.1);
}
.ll-stat:first-child{border-left:none;padding-left:0}
.ll-stat-n{
    font-family:'Libre Baskerville',serif;
    font-size:1.8rem;font-weight:700;color:#fff;line-height:1;
}
.ll-stat-l{font-size:11px;color:rgba(255,255,255,.5);margin-top:3px}

.ll-footer{position:relative;z-index:2}
.ll-footer p{font-size:12px;color:rgba(255,255,255,.35)}
.ll-footer a{color:rgba(255,255,255,.5);text-decoration:none}
.ll-footer a:hover{color:rgba(255,255,255,.8)}

/* ── Right panel ── */
.login-right{
    background:#fff;
    display:flex;
    flex-direction:column;
    justify-content:center;
    padding:48px 48px;
    position:relative;
    overflow:hidden;
}
.lr-deco{
    position:absolute;
    bottom:-60px;right:-60px;
    width:220px;height:220px;
    border-radius:50%;
    background:linear-gradient(135deg,rgba(0,85,165,.06),rgba(0,168,89,.04));
    pointer-events:none;
}

.lr-header{margin-bottom:36px}
.lr-welcome{
    font-size:11px;font-weight:700;letter-spacing:3px;
    text-transform:uppercase;color:#0055a5;
    display:block;margin-bottom:10px;
}
.lr-title{
    font-family:'Libre Baskerville',serif;
    font-size:1.8rem;font-weight:700;
    color:#1a1a2e;line-height:1.2;margin-bottom:8px;
}
.lr-sub{font-size:14px;color:#64748b;line-height:1.6}

/* Alert */
.alert{
    border-radius:12px;border:none;
    padding:12px 16px;font-size:13px;
    display:flex;align-items:center;gap:10px;
    margin-bottom:20px;
}
.alert-danger{background:#fef2f2;color:#dc2626}
.alert-success{background:#f0fdf4;color:#15803d}

/* Form */
.form-group{margin-bottom:20px}
.form-label{
    display:block;font-size:12px;font-weight:700;
    color:#374151;letter-spacing:.5px;text-transform:uppercase;
    margin-bottom:7px;
}
.input-wrap{position:relative}
.input-icon{
    position:absolute;left:14px;top:50%;transform:translateY(-50%);
    color:#9ca3af;font-size:16px;pointer-events:none;
}
.form-control{
    width:100%;
    padding:13px 14px 13px 42px;
    border:1.5px solid #e5eaf0;
    border-radius:12px;
    font-size:14px;
    font-family:'Plus Jakarta Sans',sans-serif;
    color:#1a1a2e;
    background:#fff;
    transition:border-color .2s,box-shadow .2s;
    outline:none;
}
.form-control:focus{
    border-color:#0055a5;
    box-shadow:0 0 0 4px rgba(0,85,165,.1);
}
.form-control.is-invalid{border-color:#dc2626}
.form-control.is-invalid:focus{box-shadow:0 0 0 4px rgba(220,38,38,.1)}

.input-suffix{
    position:absolute;right:14px;top:50%;transform:translateY(-50%);
    background:none;border:none;cursor:pointer;
    color:#9ca3af;font-size:16px;padding:4px;
    transition:color .2s;
}
.input-suffix:hover{color:#374151}

/* Checkbox */
.check-row{
    display:flex;align-items:center;
    justify-content:space-between;
    margin-bottom:24px;
}
.check-label{
    display:flex;align-items:center;gap:8px;
    font-size:13px;color:#64748b;cursor:pointer;
    user-select:none;
}
.check-label input[type=checkbox]{
    width:16px;height:16px;
    accent-color:#0055a5;
    cursor:pointer;
}
.forgot-link{
    font-size:13px;color:#0055a5;
    text-decoration:none;font-weight:600;
}
.forgot-link:hover{color:#003d7a;text-decoration:underline}

/* Submit button */
.btn-submit{
    width:100%;
    padding:15px;
    background:#0055a5;
    color:#fff;
    border:none;
    border-radius:12px;
    font-size:15px;
    font-weight:700;
    font-family:'Plus Jakarta Sans',sans-serif;
    cursor:pointer;
    display:flex;align-items:center;justify-content:center;gap:10px;
    transition:background .2s,transform .15s,box-shadow .2s;
    box-shadow:0 6px 20px rgba(0,85,165,.35);
}
.btn-submit:hover{
    background:#003d7a;
    transform:translateY(-1px);
    box-shadow:0 10px 28px rgba(0,85,165,.45);
}
.btn-submit:active{transform:translateY(0)}
.btn-submit .btn-icon{
    width:22px;height:22px;
    background:rgba(255,255,255,.15);
    border-radius:6px;
    display:flex;align-items:center;justify-content:center;
    font-size:13px;
}

/* Divider */
.divider{
    display:flex;align-items:center;gap:12px;
    margin:20px 0;color:#d1d5db;font-size:12px;
}
.divider::before,.divider::after{
    content:'';flex:1;height:1px;background:#f0f0f0;
}

/* Role badges */
.role-pills{display:flex;gap:8px;flex-wrap:wrap;margin-top:16px}
.role-pill{
    display:flex;align-items:center;gap:6px;
    padding:6px 12px;border-radius:100px;
    font-size:11px;font-weight:700;
    border:1.5px solid;cursor:pointer;
    transition:all .2s;
    background:transparent;
}
.role-pill:hover,.role-pill.active{color:#fff}
.role-pill-sa{color:#7c3aed;border-color:#7c3aed}
.role-pill-sa:hover,.role-pill-sa.active{background:#7c3aed;border-color:#7c3aed}
.role-pill-mk{color:#0055a5;border-color:#0055a5}
.role-pill-mk:hover,.role-pill-mk.active{background:#0055a5}
.role-pill-sdm{color:#00a859;border-color:#00a859}
.role-pill-sdm:hover,.role-pill-sdm.active{background:#00a859;border-color:#00a859}

.lr-back{
    text-align:center;margin-top:24px;
    font-size:13px;color:#9ca3af;
}
.lr-back a{color:#0055a5;text-decoration:none;font-weight:600}
.lr-back a:hover{text-decoration:underline}

/* Loading state */
.btn-submit.loading{pointer-events:none;opacity:.8}
.spinner{
    display:none;
    width:18px;height:18px;
    border:2px solid rgba(255,255,255,.3);
    border-top-color:#fff;
    border-radius:50%;
    animation:spin .7s linear infinite;
}
.btn-submit.loading .spinner{display:block}
.btn-submit.loading .btn-text,.btn-submit.loading .btn-icon{display:none}
@keyframes spin{to{transform:rotate(360deg)}}

/* Responsive */
@media(max-width:900px){
    .login-page{grid-template-columns:1fr}
    .login-left{display:none}
    .login-right{min-height:100vh;padding:40px 32px}
}
@media(max-width:480px){
    .login-right{padding:32px 24px}
}
</style>
</head>
<body>
<div class="login-page">

    {{-- ═══ LEFT PANEL ═══ --}}
    <div class="login-left">
        <div class="ll-deco ll-deco-1"></div>
        <div class="ll-deco ll-deco-2"></div>
        <div class="ll-deco ll-deco-3"></div>

        {{-- Brand --}}
        <div class="ll-brand">
            <div class="ll-brand-icon"><i class="bi bi-hospital-fill"></i></div>
            <div>
                <div class="ll-brand-name">RS Hamori</div>
                <div class="ll-brand-sub">Rumah Sakit Subang, Jawa Barat</div>
            </div>
        </div>

        {{-- Main copy --}}
        <div class="ll-main">
            <div class="ll-tag">
                <span class="ll-tag-dot"></span>
                Admin Panel
            </div>
            <h1 class="ll-headline">
                Sistem Manajemen<br>
                <span>RS Hamori</span>
            </h1>
            <p class="ll-desc">
                Platform terpadu untuk mengelola konten website, rekrutmen, dan operasional Rumah Sakit Hamori secara efisien dan terstruktur.
            </p>
            <div class="ll-stats">
                <div class="ll-stat">
                    <div class="ll-stat-n">3</div>
                    <div class="ll-stat-l">Level Akses</div>
                </div>
                <div class="ll-stat">
                    <div class="ll-stat-n">10+</div>
                    <div class="ll-stat-l">Modul</div>
                </div>
                <div class="ll-stat">
                    <div class="ll-stat-n">24/7</div>
                    <div class="ll-stat-l">Akses Online</div>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <div class="ll-footer">
            <p>&copy; {{ date('Y') }} RS Hamori. All rights reserved. &nbsp;·&nbsp; <a href="{{ url('/') }}">Lihat Website</a></p>
        </div>
    </div>

    {{-- ═══ RIGHT PANEL ═══ --}}
    <div class="login-right">
        <div class="lr-deco"></div>

        <div style="max-width:360px;width:100%;margin:0 auto">

            <div class="lr-header">
                <span class="lr-welcome">Selamat Datang</span>
                <h2 class="lr-title">Masuk ke<br>Admin Panel</h2>
                <p class="lr-sub">Masukkan kredensial Anda untuk mengakses dashboard pengelolaan RS Hamori.</p>
            </div>

            {{-- Alerts --}}
            @if(session('error'))
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-circle-fill"></i>
                <span>{{ session('error') }}</span>
            </div>
            @endif

            @if(session('success'))
            <div class="alert alert-success">
                <i class="bi bi-check-circle-fill"></i>
                <span>{{ session('success') }}</span>
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-circle-fill"></i>
                <span>{{ $errors->first() }}</span>
            </div>
            @endif

            {{-- Form --}}
            <form method="POST" action="{{ route('admin.login.post') }}" id="loginForm">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="email">Email</label>
                    <div class="input-wrap">
                        <i class="bi bi-envelope input-icon"></i>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                            value="{{ old('email') }}"
                            placeholder="admin@rshamori.co.id"
                            required
                            autofocus
                            autocomplete="email">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-wrap">
                        <i class="bi bi-lock input-icon"></i>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control"
                            placeholder="••••••••"
                            required
                            autocomplete="current-password">
                        <button type="button" class="input-suffix" id="togglePwd" title="Tampilkan password">
                            <i class="bi bi-eye" id="pwdIcon"></i>
                        </button>
                    </div>
                </div>

                <div class="check-row">
                    <label class="check-label">
                        <input type="checkbox" name="remember" id="remember">
                        Ingat saya selama 30 hari
                    </label>
                </div>

                <button type="submit" class="btn-submit" id="submitBtn">
                    <div class="spinner"></div>
                    <span class="btn-text">Masuk ke Dashboard</span>
                    <div class="btn-icon">
                        <i class="bi bi-arrow-right"></i>
                    </div>
                </button>

            </form>

            {{-- Demo accounts --}}
            <div class="divider">Akun Demo</div>
            <div style="font-size:12px;color:#9ca3af;margin-bottom:10px;text-align:center">Klik role untuk isi otomatis</div>
            <div class="role-pills">
                <button type="button" class="role-pill role-pill-sa"
                    onclick="fillCreds('superadmin@rshamori.co.id','admin123',this)">
                    <i class="bi bi-shield-fill-check"></i> Super Admin
                </button>
                <button type="button" class="role-pill role-pill-mk"
                    onclick="fillCreds('marketing@rshamori.co.id','marketing123',this)">
                    <i class="bi bi-megaphone-fill"></i> Marketing
                </button>
                <button type="button" class="role-pill role-pill-sdm"
                    onclick="fillCreds('sdm@rshamori.co.id','sdm123456',this)">
                    <i class="bi bi-people-fill"></i> SDM
                </button>
            </div>

            <div class="lr-back">
                <a href="{{ url('/') }}"><i class="bi bi-arrow-left me-1"></i>Kembali ke website</a>
            </div>

        </div>
    </div>

</div>

<script>
// Toggle password visibility
document.getElementById('togglePwd').addEventListener('click', function() {
    const inp  = document.getElementById('password');
    const icon = document.getElementById('pwdIcon');
    if (inp.type === 'password') {
        inp.type  = 'text';
        icon.className = 'bi bi-eye-slash';
    } else {
        inp.type  = 'password';
        icon.className = 'bi bi-eye';
    }
});

// Fill demo credentials
function fillCreds(email, pass, btn) {
    document.getElementById('email').value    = email;
    document.getElementById('password').value = pass;
    // Active state on pill
    document.querySelectorAll('.role-pill').forEach(p => p.classList.remove('active'));
    btn.classList.add('active');
    // Focus submit
    document.getElementById('submitBtn').focus();
}

// Loading state on submit
document.getElementById('loginForm').addEventListener('submit', function() {
    document.getElementById('submitBtn').classList.add('loading');
});

// Auto-dismiss alerts
setTimeout(() => {
    document.querySelectorAll('.alert').forEach(el => {
        el.style.transition = 'opacity .4s';
        el.style.opacity    = '0';
        setTimeout(() => el.remove(), 400);
    });
}, 4000);
</script>
</body>
</html>
