<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title','Dashboard') — Admin RS Hamori</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<style>
:root{--sidebar-w:260px;--topbar-h:64px;--blue:#0055a5;--blue-dk:#003d7a;--green:#00a859;--red:#e8333c}
*{box-sizing:border-box}body{font-family:'Plus Jakarta Sans',sans-serif;background:#f0f4f8;min-height:100vh;margin:0}
.sidebar{position:fixed;left:0;top:0;width:var(--sidebar-w);height:100vh;background:#0d1b3e;display:flex;flex-direction:column;z-index:200;transition:transform .3s}
.sidebar-brand{padding:20px 24px;border-bottom:1px solid rgba(255,255,255,.08);display:flex;align-items:center;gap:12px;text-decoration:none}
.sidebar-brand-icon{width:38px;height:38px;background:var(--blue);border-radius:10px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:18px;flex-shrink:0}
.sidebar-brand-text{font-size:14px;font-weight:700;color:#fff;line-height:1.3}
.sidebar-brand-sub{font-size:10px;color:rgba(255,255,255,.5);font-weight:500}
.sidebar-nav{flex:1;overflow-y:auto;padding:16px 12px;scrollbar-width:none}
.sidebar-nav::-webkit-scrollbar{display:none}
.nav-section-label{font-size:10px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:rgba(255,255,255,.35);padding:16px 12px 6px;margin-top:4px}
.nav-item{display:flex;align-items:center;gap:10px;padding:10px 14px;border-radius:10px;color:rgba(255,255,255,.72);text-decoration:none;font-size:13.5px;font-weight:600;transition:background .2s,color .2s;margin-bottom:2px;border:none;background:transparent;width:100%;cursor:pointer;text-align:left}
.nav-item:hover{background:rgba(255,255,255,.08);color:#fff}
.nav-item.active{background:var(--blue);color:#fff;box-shadow:0 4px 14px rgba(0,85,165,.4)}
.nav-item i{font-size:17px;width:22px;flex-shrink:0}
.nav-item .nav-badge{margin-left:auto;font-size:10px;padding:2px 7px;border-radius:100px;background:#e8333c;color:#fff}
.sidebar-footer{padding:16px 12px;border-top:1px solid rgba(255,255,255,.08)}
.sidebar-user{display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:10px;background:rgba(255,255,255,.06)}
.su-avatar{width:34px;height:34px;border-radius:50%;background:var(--blue);display:flex;align-items:center;justify-content:center;color:#fff;font-size:15px;font-weight:700;flex-shrink:0;overflow:hidden}
.su-avatar img{width:100%;height:100%;object-fit:cover}
.su-name{font-size:13px;font-weight:700;color:#fff;line-height:1.2}
.su-role{font-size:10px;color:rgba(255,255,255,.5)}
.topbar{position:fixed;top:0;left:var(--sidebar-w);right:0;height:var(--topbar-h);background:#fff;border-bottom:1px solid #e5eaf0;display:flex;align-items:center;padding:0 28px;gap:16px;z-index:100;box-shadow:0 2px 8px rgba(0,0,0,.05)}
.topbar-title{font-size:16px;font-weight:700;color:#1a1a2e;flex:1}
.topbar-actions{display:flex;align-items:center;gap:10px}
.btn-topbar{width:38px;height:38px;border-radius:10px;border:1px solid #e5eaf0;background:#fff;display:flex;align-items:center;justify-content:center;color:#64748b;text-decoration:none;transition:all .2s;cursor:pointer}
.btn-topbar:hover{background:#f0f6ff;color:var(--blue);border-color:var(--blue)}
.main-wrap{margin-left:var(--sidebar-w);padding-top:var(--topbar-h)}
.main-content{padding:28px;min-height:calc(100vh - var(--topbar-h))}
.stat-card{background:#fff;border-radius:16px;padding:22px;border:1px solid #e5eaf0;transition:transform .2s,box-shadow .2s;text-decoration:none;color:inherit;display:block}
.stat-card:hover{transform:translateY(-2px);box-shadow:0 8px 24px rgba(0,0,0,.08)}
.stat-icon{width:52px;height:52px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:22px;margin-bottom:14px}
.stat-num{font-size:2rem;font-weight:800;line-height:1;margin-bottom:4px;color:#1a1a2e}
.stat-label{font-size:13px;color:#64748b;font-weight:500}
.admin-table{background:#fff;border-radius:16px;border:1px solid #e5eaf0;overflow:hidden}
.admin-table .table{margin:0}
.admin-table .table th{background:#f8fafc;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:#64748b;border:none;padding:12px 18px;white-space:nowrap}
.admin-table .table td{padding:13px 18px;border-color:#f0f4f8;vertical-align:middle;font-size:14px}
.admin-table .table tbody tr:hover{background:#fafbff}
.page-hd{display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:28px;flex-wrap:wrap;gap:12px}
.page-hd-title{font-size:22px;font-weight:800;color:#1a1a2e;margin:0;line-height:1.2}
.page-hd-sub{font-size:13px;color:#64748b;margin-top:4px}
.form-card{background:#fff;border-radius:16px;padding:28px;border:1px solid #e5eaf0}
.form-label{font-size:13px;font-weight:700;color:#374151;margin-bottom:5px}
.form-control,.form-select{border:1.5px solid #e5eaf0;border-radius:10px;padding:10px 14px;font-size:14px;transition:border-color .2s,box-shadow .2s}
.form-control:focus,.form-select:focus{border-color:var(--blue);box-shadow:0 0 0 3px rgba(0,85,165,.1);outline:none}
textarea.form-control{min-height:140px;resize:vertical}
.badge-super{background:#7c3aed!important;color:#fff!important}
.badge-marketing{background:#0055a5!important;color:#fff!important}
.badge-sdm{background:#00a859!important;color:#fff!important}
.alert{border-radius:12px;border:none;font-size:14px}
.alert-success{background:#f0fdf4;color:#15803d}
.alert-danger{background:#fef2f2;color:#dc2626}
.btn-primary{background:var(--blue)!important;border-color:var(--blue)!important;border-radius:10px;font-weight:700;font-size:14px}
.btn-primary:hover{background:var(--blue-dk)!important;border-color:var(--blue-dk)!important}
.btn-danger,.btn-success,.btn-warning,.btn-outline-secondary,.btn-outline-primary{border-radius:10px;font-weight:600;font-size:13px}
.img-prev{max-width:100%;max-height:180px;border-radius:12px;border:1px solid #e5eaf0;object-fit:cover}
.filter-bar{background:#fff;border-radius:14px;padding:16px 20px;border:1px solid #e5eaf0;margin-bottom:20px;display:flex;gap:12px;flex-wrap:wrap;align-items:center}
.sidebar-toggle{display:none;width:38px;height:38px;border-radius:10px;border:1px solid #e5eaf0;background:#fff;align-items:center;justify-content:center;cursor:pointer;color:#374151}
.sidebar-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:190}
@media(max-width:991px){
  .sidebar{transform:translateX(-100%)}.sidebar.open{transform:translateX(0)}
  .sidebar-toggle{display:flex}.sidebar-overlay.show{display:block}
  .main-wrap{margin-left:0}.topbar{left:0}
}
</style>
@stack('styles')
</head>
<body>
<aside class="sidebar" id="sidebar">
    <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
        <div class="sidebar-brand-icon"><i class="bi bi-hospital"></i></div>
        <div><div class="sidebar-brand-text">RS Hamori</div><div class="sidebar-brand-sub">Admin Panel</div></div>
    </a>
    <nav class="sidebar-nav">
        <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2-fill"></i> Dashboard
        </a>
        @if(auth()->user()->canAccess('banner'))
        <div class="nav-section-label">Marketing</div>
        <a href="{{ route('admin.banner.index') }}" class="nav-item {{ request()->routeIs('admin.banner.*') ? 'active' : '' }}">
            <i class="bi bi-image-fill"></i> Banner
        </a>
        <a href="{{ route('admin.promo.index') }}" class="nav-item {{ request()->routeIs('admin.promo.*') ? 'active' : '' }}">
            <i class="bi bi-gift-fill"></i> Promo & Penawaran
        </a>
        <a href="{{ route('admin.kritik-saran.index') }}" class="nav-item {{ request()->routeIs('admin.kritik-saran.*') ? 'active' : '' }}">
            <i class="bi bi-envelope-paper-fill"></i> Kritik & Saran
            @php $ksp = \App\Models\KritikSaran::pending()->count(); @endphp
            @if($ksp > 0)<span class="nav-badge">{{ $ksp }}</span>@endif
        </a>
        <a href="{{ route('admin.artikel.index') }}" class="nav-item {{ request()->routeIs('admin.artikel.*') ? 'active' : '' }}">
            <i class="bi bi-newspaper"></i> Artikel
        </a>
        <a href="{{ route('admin.kategori-artikel.index') }}" class="nav-item {{ request()->routeIs('admin.kategori-artikel.*') ? 'active' : '' }}">
            <i class="bi bi-folder-fill"></i> Kategori Artikel
        </a>
        <a href="{{ route('admin.layanan.index') }}" class="nav-item {{ request()->routeIs('admin.layanan.*') ? 'active' : '' }}">
            <i class="bi bi-award-fill"></i> Layanan Unggulan
        </a>
        @endif
        {{-- Menu berikut hanya untuk Super Admin --}}
        @if(auth()->user()->isSuperAdmin())
        <a href="{{ route('admin.kontak.index') }}" class="nav-item {{ request()->routeIs('admin.kontak.*') ? 'active' : '' }}">
            <i class="bi bi-chat-text-fill"></i> Pesan Masuk
            @php $unreadKontak = \App\Models\Kontak::where('is_read', false)->count(); @endphp
            @if($unreadKontak > 0)<span class="nav-badge">{{ $unreadKontak }}</span>@endif
        </a>
        <a href="{{ route('admin.fasilitas.index') }}" class="nav-item {{ request()->routeIs('admin.fasilitas.*') ? 'active' : '' }}">
            <i class="bi bi-building"></i> Fasilitas
        </a>
        <a href="{{ route('admin.kategori-fasilitas.index') }}" class="nav-item {{ request()->routeIs('admin.kategori-fasilitas.*') ? 'active' : '' }}">
            <i class="bi bi-folder-fill"></i> Kategori Fasilitas
        </a>
        <a href="{{ route('admin.dokter.index') }}" class="nav-item {{ request()->routeIs('admin.dokter.*') ? 'active' : '' }}">
            <i class="bi bi-person-badge-fill"></i> Dokter & Jadwal
        </a>
        @endif
        @if(auth()->user()->canAccess('karir'))
        <div class="nav-section-label">SDM & Rekrutmen</div>
        <a href="{{ route('admin.karir.index') }}" class="nav-item {{ request()->routeIs('admin.karir.*') ? 'active' : '' }}">
            <i class="bi bi-briefcase-fill"></i> Lowongan Kerja
        </a>
        <a href="{{ route('admin.lamaran.index') }}" class="nav-item {{ request()->routeIs('admin.lamaran.*') ? 'active' : '' }}">
            <i class="bi bi-person-lines-fill"></i> Lamaran Masuk
            @php $pc = \App\Models\LamaranKarir::where('status','pending')->count(); @endphp
            @if($pc > 0)<span class="nav-badge">{{ $pc }}</span>@endif
        </a>
        @endif
        @if(auth()->user()->canAccess('banner'))
        <div class="nav-section-label">Konten</div>
        <a href="{{ route('admin.faq.index') }}" class="nav-item {{ request()->routeIs('admin.faq.*') ? 'active' : '' }}">
            <i class="bi bi-question-circle-fill"></i> FAQ
        </a>
        <a href="{{ route('admin.privacy-policy.index') }}" class="nav-item {{ request()->routeIs('admin.privacy-policy.*') ? 'active' : '' }}">
            <i class="bi bi-shield-lock-fill"></i> Kebijakan Privasi
        </a>
        @endif
        @if(auth()->user()->isSuperAdmin())
        <div class="nav-section-label">Super Admin</div>
        <a href="{{ route('admin.users.index') }}" class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
            <i class="bi bi-people-fill"></i> Manajemen User
        </a>
        <a href="{{ route('admin.settings.edit') }}" class="nav-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
            <i class="bi bi-gear-fill"></i> Pengaturan Umum
        </a>
        <a href="{{ route('admin.profil-rs.edit') }}" class="nav-item {{ request()->routeIs('admin.profil-rs.*') ? 'active' : '' }}">
            <i class="bi bi-hospital-fill"></i> Profil RS
        </a>
        <a href="{{ route('admin.milestone.index') }}" class="nav-item {{ request()->routeIs('admin.milestone.*') ? 'active' : '' }}">
            <i class="bi bi-flag-fill"></i> Milestone
        </a>
        @endif
        <div class="nav-section-label">Akun</div>
        <a href="{{ route('admin.profile.edit') }}" class="nav-item {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
            <i class="bi bi-person-circle"></i> Profil Saya
        </a>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="nav-item" style="color:#f87171!important"><i class="bi bi-box-arrow-right"></i> Keluar</button>
        </form>
    </nav>
    <div class="sidebar-footer">
        <div class="sidebar-user">
            <div class="su-avatar">
                @if(auth()->user()->avatar)<img src="{{ asset('storage/'.auth()->user()->avatar) }}" alt="">@else{{ strtoupper(substr(auth()->user()->name,0,1)) }}@endif
            </div>
            <div><div class="su-name">{{ Str::limit(auth()->user()->name,18) }}</div><div class="su-role">{{ auth()->user()->getRoleLabel() }}</div></div>
        </div>
    </div>
</aside>
<div class="sidebar-overlay" id="sidebarOverlay"></div>
<header class="topbar">
    <button class="sidebar-toggle" id="sidebarToggle"><i class="bi bi-list" style="font-size:20px"></i></button>
    <div class="topbar-title">@yield('page-title','Dashboard')</div>
    <div class="topbar-actions">
        <a href="{{ url('/') }}" target="_blank" class="btn-topbar" title="Lihat Website"><i class="bi bi-box-arrow-up-right"></i></a>
        <div class="dropdown">
            <button class="btn-topbar dropdown-toggle" data-bs-toggle="dropdown" style="width:auto;gap:8px;padding:0 12px;font-size:13px;font-weight:700;color:#1a1a2e">
                <div class="su-avatar" style="width:28px;height:28px;font-size:12px">
                    @if(auth()->user()->avatar)<img src="{{ asset('storage/'.auth()->user()->avatar) }}" alt="">@else{{ strtoupper(substr(auth()->user()->name,0,1)) }}@endif
                </div>
                {{ Str::limit(auth()->user()->name,15) }}
            </button>
            <ul class="dropdown-menu dropdown-menu-end" style="border-radius:12px;box-shadow:0 8px 32px rgba(0,0,0,.12);border:1px solid #e5eaf0;padding:8px;min-width:160px">
                <li><a class="dropdown-item" href="{{ route('admin.profile.edit') }}" style="border-radius:8px;font-size:13px"><i class="bi bi-person me-2"></i>Profil</a></li>
                <li><hr class="dropdown-divider my-1"></li>
                <li><form method="POST" action="{{ route('admin.logout') }}">@csrf<button type="submit" class="dropdown-item text-danger" style="border-radius:8px;font-size:13px"><i class="bi bi-box-arrow-right me-2"></i>Keluar</button></form></li>
            </ul>
        </div>
    </div>
</header>
<div class="main-wrap">
    <div class="main-content">
        @if(session('success'))<div class="alert alert-success alert-dismissible fade show mb-4"><i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>@endif
        @if(session('error'))<div class="alert alert-danger alert-dismissible fade show mb-4"><i class="bi bi-exclamation-circle-fill me-2"></i>{{ session('error') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>@endif
        @if($errors->any())<div class="alert alert-danger alert-dismissible fade show mb-4"><i class="bi bi-exclamation-triangle-fill me-2"></i>@foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>@endif
        @yield('content')
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
const toggle=document.getElementById('sidebarToggle'),sidebar=document.getElementById('sidebar'),overlay=document.getElementById('sidebarOverlay');
toggle?.addEventListener('click',()=>{sidebar.classList.toggle('open');overlay.classList.toggle('show');});
overlay?.addEventListener('click',()=>{sidebar.classList.remove('open');overlay.classList.remove('show');});
document.querySelectorAll('.alert-dismissible').forEach(el=>{setTimeout(()=>{el.classList.remove('show');setTimeout(()=>el.remove(),300);},5000);});
</script>
@stack('scripts')
</body>
</html> 