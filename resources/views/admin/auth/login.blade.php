<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
@php
    $favicon = \App\Models\SiteSetting::get('favicon');
    $faviconUrl = $favicon ? asset('storage/' . $favicon) : asset('assets/images/logosq.png');
@endphp
<title>Masuk — Panel Rumah Sakit HAMORI</title>
<link rel="icon" type="image/png" href="{{ $faviconUrl }}">
<link href="https://fonts.cdnfonts.com/css/metropolis-2" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<style>
/* CSS Reset and Base */
* { box-sizing: border-box; margin: 0; padding: 0; }
body {
    font-family: 'Metropolis', sans-serif;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(-45deg, #003d7a, #0055a5, #1baa9e, #0055a5);
    background-size: 400% 400%;
    animation: gradientBG 15s ease infinite;
    padding: 24px;
}
@keyframes gradientBG {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* Glassmorphism Card */
.login-container {
    display: flex;
    width: 100%;
    max-width: 1080px;
    background: rgba(255, 255, 255, 0.95);
    border-radius: 32px;
    box-shadow: 0 30px 60px rgba(0, 0, 0, 0.3);
    overflow: hidden;
    backdrop-filter: blur(10px);
}

/* Left Panel */
.brand-panel {
    width: 45%;
    padding: 56px;
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    position: relative;
    border-right: 1px solid rgba(0,0,0,0.05);
}
.brand-panel::before {
    content: '';
    position: absolute;
    top: -50%; left: -50%;
    width: 200%; height: 200%;
    background: radial-gradient(circle, rgba(0,85,165,0.03) 0%, transparent 60%);
    animation: rotateDeco 30s linear infinite;
    pointer-events: none;
}
@keyframes rotateDeco {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.bp-header { display: flex; align-items: center; gap: 16px; position: relative; z-index: 2; }
.bp-logo {
    width: 56px; height: 56px;
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 10px 20px rgba(0,0,0,0.05);
    padding: 8px;
}
.bp-logo img { width: 100%; height: 100%; object-fit: contain; border-radius: 8px; }
.bp-title { font-weight: 800; font-size: 20px; color: #1a1a2e; line-height: 1.2; font-family: 'Metropolis', sans-serif; }
.bp-subtitle { font-size: 12px; color: #64748b; font-weight: 500; }

.bp-content { position: relative; z-index: 2; margin-top: 60px; }
.bp-headline {
    font-size: clamp(2rem, 3vw, 2.5rem);
    font-weight: 800;
    color: #1a1a2e;
    line-height: 1.15;
    margin-bottom: 24px;
    font-family: 'Metropolis', sans-serif;
}
.bp-headline span {
    color: #0055a5;
    position: relative;
    display: inline-block;
}
.bp-headline span::after {
    content: '';
    position: absolute;
    bottom: 4px; left: 0; width: 100%; height: 8px;
    background: rgba(0, 168, 89, 0.2);
    z-index: -1;
}
.bp-desc {
    font-size: 15px;
    color: #475569;
    line-height: 1.8;
}

/* Right Panel (Form) */
.form-panel {
    width: 55%;
    padding: 72px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    position: relative;
}
.form-wrapper {
    max-width: 400px;
    margin: 0 auto;
    width: 100%;
}
.fw-greeting {
    font-size: 13px;
    font-weight: 700;
    color: #0055a5;
    text-transform: uppercase;
    letter-spacing: 2px;
    margin-bottom: 32px;
    display: block;
}

/* Alerts */
.alert {
    border-radius: 14px;
    padding: 14px 18px;
    font-size: 13px;
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 24px;
    font-weight: 500;
}
.alert-danger { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }
.alert-success { background: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; }

/* Inputs */
.form-group { margin-bottom: 24px; position: relative; }
.form-label {
    display: block;
    font-size: 12px;
    font-weight: 700;
    color: #374151;
    margin-bottom: 8px;
}
.input-icon-wrap { position: relative; }
.input-icon-wrap i.bi-icon {
    position: absolute;
    left: 16px;
    top: 50%;
    transform: translateY(-50%);
    color: #94a3b8;
    font-size: 18px;
    transition: color 0.3s;
}
.form-control {
    width: 100%;
    padding: 16px 16px 16px 48px;
    background: #f8fafc;
    border: 2px solid transparent;
    border-radius: 16px;
    font-size: 14px;
    font-weight: 500;
    color: #1e293b;
    font-family: 'Metropolis', sans-serif;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    outline: none;
}
.form-control:focus {
    background: #ffffff;
    border-color: #0055a5;
    box-shadow: 0 8px 20px rgba(0, 85, 165, 0.08);
}
.form-control:focus + i.bi-icon {
    color: #0055a5;
}
.form-control.is-invalid { border-color: #ef4444; background: #fff; }

.toggle-pwd {
    position: absolute;
    right: 16px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: #94a3b8;
    cursor: pointer;
    font-size: 18px;
    padding: 4px;
}
.toggle-pwd:hover { color: #475569; }

/* Button */
.btn-submit {
    width: 100%;
    padding: 18px;
    background: linear-gradient(135deg, #0055a5, #003d7a);
    color: #fff;
    border: none;
    border-radius: 16px;
    font-size: 15px;
    font-family: 'Metropolis', sans-serif;
    font-weight: 700;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    transition: all 0.3s;
    box-shadow: 0 10px 25px rgba(0, 85, 165, 0.3);
    margin-top: 10px;
}
.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 15px 35px rgba(0, 85, 165, 0.4);
}
.btn-submit:active { transform: translateY(0); box-shadow: 0 5px 15px rgba(0, 85, 165, 0.3); }

/* Loading Spinner */
.spinner {
    display: none;
    width: 20px; height: 20px;
    border: 2.5px solid rgba(255,255,255,0.3);
    border-top-color: #fff;
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
}
.btn-submit.loading .spinner { display: block; }
.btn-submit.loading .btn-text, .btn-submit.loading .bi-arrow-right { display: none; }
@keyframes spin { to { transform: rotate(360deg); } }

/* Back link */
.back-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-top: 32px;
    font-size: 14px;
    color: #64748b;
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s;
    justify-content: center;
    width: 100%;
}
.back-link:hover { color: #0055a5; }

/* Responsive */
@media(max-width: 900px) {
    .login-container { flex-direction: column; max-width: 480px; }
    .brand-panel { width: 100%; padding: 40px; border-right: none; border-bottom: 1px solid rgba(0,0,0,0.05); }
    .form-panel { width: 100%; padding: 40px; }
    .bp-headline { font-size: 2rem; margin-top: 30px; }
    .bp-content { margin-top: 20px; }
}
@media(max-width: 480px) {
    .brand-panel, .form-panel { padding: 32px 24px; }
}
</style>
</head>
<body>

<div class="login-container">
    
    <div class="brand-panel">
        <div class="bp-header">
            <div class="bp-logo">
                <img src="{{ $faviconUrl }}" alt="Logo">
            </div>
            <div>
                <div class="bp-title">Rumah Sakit HAMORI</div>
                <div class="bp-subtitle">Subang, Jawa Barat</div>
            </div>
        </div>

        <div class="bp-content">
            <h1 class="bp-headline">
                LOGIN<br>
                <span>Panel Website</span>
            </h1>
            <p class="bp-desc">
                Platform terpadu untuk mengelola konten website, rekrutmen, dan operasional Rumah Sakit Hamori secara efisien dan terstruktur.
            </p>
        </div>
    </div>

    <div class="form-panel">
        <div class="form-wrapper">
            <span class="fw-greeting">Selamat Datang</span>

            @if(session('error'))
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-octagon-fill"></i>
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
                <i class="bi bi-exclamation-octagon-fill"></i>
                <span>{{ $errors->first() }}</span>
            </div>
            @endif

            <form method="POST" action="{{ route('admin.login.post') }}" id="loginForm">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="email">Email</label>
                    <div class="input-icon-wrap">
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
                        <i class="bi bi-envelope-fill bi-icon"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-icon-wrap">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control"
                            placeholder="••••••••"
                            required
                            autocomplete="current-password">
                        <i class="bi bi-lock-fill bi-icon"></i>
                        <button type="button" class="toggle-pwd" id="togglePwd" title="Tampilkan password">
                            <i class="bi bi-eye" id="pwdIcon"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-submit" id="submitBtn">
                    <div class="spinner"></div>
                    <span class="btn-text">Masuk ke Dashboard</span>
                    <i class="bi bi-arrow-right"></i>
                </button>
            </form>

            <a href="{{ url('/') }}" class="back-link">
                <i class="bi bi-arrow-left"></i> Kembali ke website
            </a>
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
