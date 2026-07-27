@extends('admin.layouts.app')
@section('title','Dashboard')
@section('page-title','Dashboard')

@section('content')
@php $user = auth()->user(); @endphp

{{-- ════════════════════════════════════════
     GREETING BANNER — adaptif per-role
     ════════════════════════════════════════ --}}
@php
    $greeting = match(true) {
        now()->hour < 11  => 'Selamat Pagi',
        now()->hour < 15  => 'Selamat Siang',
        now()->hour < 18  => 'Selamat Sore',
        default           => 'Selamat Malam',
    };
    $roleTheme = match($user->role) {
        'super_admin'     => ['bg' => 'linear-gradient(135deg,#0055a5 0%,#003d7a 100%)', 'icon' => 'bi-shield-fill-check', 'badge' => 'Super Admin'],
        'admin_marketing' => ['bg' => 'linear-gradient(135deg,#0ea5e9 0%,#0055a5 100%)', 'icon' => 'bi-megaphone-fill',     'badge' => 'Admin Marketing'],
        'admin_sdm'       => ['bg' => 'linear-gradient(135deg,#059669 0%,#047857 100%)', 'icon' => 'bi-people-fill',        'badge' => 'Admin SDM'],
        default           => ['bg' => 'linear-gradient(135deg,#6366f1 0%,#4f46e5 100%)', 'icon' => 'bi-person-fill',        'badge' => 'Admin'],
    };
@endphp

<div class="mb-4 p-4 rounded-4 text-white position-relative overflow-hidden"
     style="background:{{ $roleTheme['bg'] }};min-height:120px;">
    <div class="position-absolute top-0 end-0 opacity-10" style="font-size:130px;line-height:1;margin-top:-10px;margin-right:-10px;">
        <i class="bi {{ $roleTheme['icon'] }}"></i>
    </div>
    <div class="d-flex align-items-center gap-3">
        <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"
             style="width:54px;height:54px;background:rgba(255,255,255,.18);font-size:24px;">
            <i class="bi {{ $roleTheme['icon'] }}"></i>
        </div>
        <div>
            <div style="font-size:20px;font-weight:800;">{{ $greeting }}, {{ Str::ucfirst(Str::before($user->name, ' ')) }}! 👋</div>
            <div style="font-size:13.5px;opacity:.8;margin-top:2px;">
                Anda masuk sebagai
                <span class="badge text-dark ms-1" style="background:rgba(255,255,255,.25);font-size:11px;">{{ $roleTheme['badge'] }}</span>
                &nbsp;·&nbsp; {{ now()->isoFormat('dddd, D MMMM Y') }}
            </div>
        </div>
    </div>

    {{-- Quick Actions per role --}}
    <div class="mt-3 d-flex flex-wrap gap-2">
        @if($user->isSuperAdmin() || $user->isAdminMarketing())
            <a href="{{ route('admin.artikel.create') }}" class="btn btn-sm" style="background:rgba(255,255,255,.2);color:#fff;border:1px solid rgba(255,255,255,.3);"><i class="bi bi-plus-circle me-1"></i>Tulis Artikel</a>
            <a href="{{ route('admin.promo.create') }}"   class="btn btn-sm" style="background:rgba(255,255,255,.2);color:#fff;border:1px solid rgba(255,255,255,.3);"><i class="bi bi-gift me-1"></i>Tambah Promo</a>
            <a href="{{ route('admin.kritik-saran.index') }}" class="btn btn-sm" style="background:rgba(255,255,255,.2);color:#fff;border:1px solid rgba(255,255,255,.3);">
                <i class="bi bi-envelope-paper me-1"></i>Kritik & Saran
                @if(isset($stats['kritiks']) && $stats['kritiks'] > 0)<span class="badge bg-warning text-dark ms-1">{{ $stats['kritiks'] }}</span>@endif
            </a>
        @endif
        @if($user->isSuperAdmin())
            <a href="{{ route('admin.kontak.index') }}" class="btn btn-sm" style="background:rgba(255,255,255,.2);color:#fff;border:1px solid rgba(255,255,255,.3);">
                <i class="bi bi-chat-text me-1"></i>Pesan Masuk
                @if(isset($stats['kontaks']) && $stats['kontaks'] > 0)<span class="badge bg-warning text-dark ms-1">{{ $stats['kontaks'] }}</span>@endif
            </a>
            <a href="{{ route('admin.users.index') }}" class="btn btn-sm" style="background:rgba(255,255,255,.2);color:#fff;border:1px solid rgba(255,255,255,.3);"><i class="bi bi-people me-1"></i>Kelola Admin</a>
        @endif
        @if($user->isAdminSdm() || $user->isSuperAdmin())
            <a href="{{ route('admin.karir.create') }}" class="btn btn-sm" style="background:rgba(255,255,255,.2);color:#fff;border:1px solid rgba(255,255,255,.3);"><i class="bi bi-briefcase me-1"></i>Buka Lowongan</a>
            <a href="{{ route('admin.lamaran.index') }}" class="btn btn-sm" style="background:rgba(255,255,255,.2);color:#fff;border:1px solid rgba(255,255,255,.3);">
                <i class="bi bi-person-lines-fill me-1"></i>Lamaran Masuk
                @if(isset($stats['lamarans']) && $stats['lamarans'] > 0)<span class="badge bg-warning text-dark ms-1">{{ $stats['lamarans'] }}</span>@endif
            </a>
        @endif
    </div>
</div>

{{-- ════════════════════
     STATS CARDS
     ════════════════════ --}}
<div class="row g-4 mb-4">

    @if(isset($stats['banners']))
    <div class="col-6 col-md-3">
        <a href="{{ route('admin.banner.index') }}" class="stat-card">
            <div class="stat-icon" style="background:#eff6ff;color:#0055a5"><i class="bi bi-image-fill"></i></div>
            <div class="stat-num">{{ $stats['banners'] }}</div>
            <div class="stat-label">Total Banner</div>
        </a>
    </div>
    @endif

    @if(isset($stats['promos']))
    <div class="col-6 col-md-3">
        <a href="{{ route('admin.promo.index') }}" class="stat-card">
            <div class="stat-icon" style="background:#fff1f2;color:#d93025"><i class="bi bi-gift-fill"></i></div>
            <div class="stat-num">{{ $stats['promos'] }}</div>
            <div class="stat-label">Promo Aktif</div>
        </a>
    </div>
    @endif

    @if(isset($stats['artikels']))
    <div class="col-6 col-md-3">
        <a href="{{ route('admin.artikel.index') }}" class="stat-card">
            <div class="stat-icon" style="background:#f0fdf4;color:#00a859"><i class="bi bi-newspaper"></i></div>
            <div class="stat-num">{{ $stats['artikels'] }}</div>
            <div class="stat-label">Total Artikel</div>
        </a>
    </div>
    @endif

    @if(isset($stats['layanans']))
    <div class="col-6 col-md-3">
        <a href="{{ route('admin.layanan.index') }}" class="stat-card">
            <div class="stat-icon" style="background:#e0f2fe;color:#0ea5e9"><i class="bi bi-award-fill"></i></div>
            <div class="stat-num">{{ $stats['layanans'] }}</div>
            <div class="stat-label">Layanan Unggulan</div>
        </a>
    </div>
    @endif

    @if(isset($stats['kritiks']))
    <div class="col-6 col-md-3">
        <a href="{{ route('admin.kritik-saran.index') }}" class="stat-card">
            <div class="stat-icon" style="background:#fef3c7;color:#d97706"><i class="bi bi-envelope-paper-fill"></i></div>
            <div class="stat-num">{{ $stats['kritiks'] }}</div>
            <div class="stat-label">Kritik & Saran Pending</div>
        </a>
    </div>
    @endif

    @if(isset($stats['dokters']))
    <div class="col-6 col-md-3">
        <a href="{{ route('admin.dokter.index') }}" class="stat-card">
            <div class="stat-icon" style="background:#faf5ff;color:#7c3aed"><i class="bi bi-person-badge-fill"></i></div>
            <div class="stat-num">{{ $stats['dokters'] }}</div>
            <div class="stat-label">Total Dokter</div>
        </a>
    </div>
    @endif

    @if(isset($stats['fasilitas']))
    <div class="col-6 col-md-3">
        <a href="{{ route('admin.fasilitas.index') }}" class="stat-card">
            <div class="stat-icon" style="background:#f3e8ff;color:#a855f7"><i class="bi bi-building"></i></div>
            <div class="stat-num">{{ $stats['fasilitas'] }}</div>
            <div class="stat-label">Total Fasilitas</div>
        </a>
    </div>
    @endif

    @if(isset($stats['kontaks']))
    <div class="col-6 col-md-3">
        <a href="{{ route('admin.kontak.index') }}" class="stat-card">
            <div class="stat-icon" style="background:#fff1f2;color:#e8333c"><i class="bi bi-chat-text-fill"></i></div>
            <div class="stat-num">{{ $stats['kontaks'] }}</div>
            <div class="stat-label">Pesan Masuk Baru</div>
        </a>
    </div>
    @endif

    @if(isset($stats['karirs']))
    <div class="col-6 col-md-3">
        <a href="{{ route('admin.karir.index') }}" class="stat-card">
            <div class="stat-icon" style="background:#eff6ff;color:#0055a5"><i class="bi bi-briefcase-fill"></i></div>
            <div class="stat-num">{{ $stats['karirs'] }}</div>
            <div class="stat-label">Lowongan Aktif</div>
        </a>
    </div>
    <div class="col-6 col-md-3">
        <a href="{{ route('admin.lamaran.index') }}" class="stat-card">
            <div class="stat-icon" style="background:#fffbeb;color:#d97706"><i class="bi bi-person-lines-fill"></i></div>
            <div class="stat-num">{{ $stats['lamarans'] }}</div>
            <div class="stat-label">Lamaran Pending</div>
        </a>
    </div>
    @endif
    @if(isset($stats['users']))
    <div class="col-6 col-md-3">
        <a href="{{ route('admin.users.index') }}" class="stat-card">
            <div class="stat-icon" style="background:#faf5ff;color:#7c3aed"><i class="bi bi-people-fill"></i></div>
            <div class="stat-num">{{ $stats['users'] }}</div>
            <div class="stat-label">Total Admin</div>
        </a>
    </div>
    @endif
</div>

<div class="row g-4">
    @if($recentLamarans->count() && ($user->isSuperAdmin() || $user->isAdminSdm()))
    <div class="col-lg-6">
        <div class="admin-table">
            <div class="d-flex align-items-center justify-content-between p-4 pb-0">
                <h6 class="fw-bold mb-0" style="font-size:15px">Lamaran Terbaru</h6>
                <a href="{{ route('admin.lamaran.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
            </div>
            <div class="p-3">
                <table class="table table-hover">
                    <thead><tr><th>Nama</th><th>Posisi</th><th>Status</th><th>Tanggal</th></tr></thead>
                    <tbody>
                    @foreach($recentLamarans as $l)
                    <tr>
                        <td class="fw-semibold">{{ $l->nama }}</td>
                        <td style="font-size:12px;color:#64748b">{{ $l->karir->posisi ?? '-' }}</td>
                        <td><span class="badge bg-{{ $l->status_color }}">{{ $l->status_label }}</span></td>
                        <td style="font-size:12px;color:#64748b">{{ $l->created_at->format('d M Y') }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
    @if($recentKontaks->count() && $user->isSuperAdmin())
    <div class="col-lg-6">
        <div class="admin-table">
            <div class="d-flex align-items-center justify-content-between p-4 pb-0">
                <h6 class="fw-bold mb-0" style="font-size:15px">Pesan Terbaru</h6>
                <a href="{{ route('admin.kontak.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
            </div>
            <div class="p-3">
                <table class="table table-hover">
                    <thead><tr><th>Nama</th><th>Subjek</th><th>Tanggal</th></tr></thead>
                    <tbody>
                    @foreach($recentKontaks as $k)
                    <tr>
                        <td class="fw-semibold">{{ $k->nama }}</td>
                        <td style="font-size:12px;color:#64748b">{{ Str::limit($k->subjek ?? $k->pesan, 40) }}</td>
                        <td style="font-size:12px;color:#64748b">{{ $k->created_at->format('d M Y') }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
    @if(isset($recentKritikSarans) && $recentKritikSarans->count())
    <div class="col-lg-6">
        <div class="admin-table">
            <div class="d-flex align-items-center justify-content-between p-4 pb-0">
                <h6 class="fw-bold mb-0" style="font-size:15px">Kritik & Saran Terbaru</h6>
                <a href="{{ route('admin.kritik-saran.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
            </div>
            <div class="p-3">
                <table class="table table-hover">
                    <thead><tr><th>Nama</th><th>Kategori</th><th>Tanggal</th></tr></thead>
                    <tbody>
                    @foreach($recentKritikSarans as $ks)
                    <tr>
                        <td class="fw-semibold">{{ $ks->nama }}</td>
                        <td><span class="badge bg-secondary" style="font-size:10px;text-transform:uppercase">{{ $ks->kategori }}</span></td>
                        <td style="font-size:12px;color:#64748b">{{ $ks->created_at->format('d M Y') }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
</div>

@if(isset($ratingAnalytics))
<div class="mt-5">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h5 class="fw-bold mb-1">📊 Analisa Kepuasan Pasien — Per Indikator</h5>
            <p class="text-muted mb-0" style="font-size:13px">Rata-rata penilaian bintang (1–5) dari seluruh responden yang mengisi form kritik & saran.</p>
        </div>
        <a href="{{ route('admin.kritik-saran.index') }}" class="btn btn-sm btn-outline-primary">Lihat Data Lengkap</a>
    </div>

    {{-- Row 1: Overall Score + Radar Chart --}}
    <div class="row g-4 mb-4">

        {{-- Overall Score Card --}}
        <div class="col-lg-3">
            <div class="h-100 d-flex flex-column gap-3">
                {{-- Big Score --}}
                <div class="admin-table p-4 text-center flex-fill"
                     style="background:linear-gradient(135deg,#0055a5,#003d7a);color:#fff;border:none;">
                    <div style="font-size:13px;text-transform:uppercase;letter-spacing:1px;opacity:.7" class="mb-2">Rata-Rata Keseluruhan</div>
                    <div style="font-size:56px;font-weight:800;line-height:1">
                        {{ number_format($ratingAnalytics['avg_keseluruhan'], 1) }}
                    </div>
                    <div style="font-size:13px;opacity:.6">/&nbsp;5.0</div>
                    <div class="mt-2" style="color:#f59e0b;font-size:20px">
                        @for($s=1;$s<=5;$s++)<i class="{{ $s <= round($ratingAnalytics['avg_keseluruhan']) ? 'fas' : 'far' }} fa-star"></i>@endfor
                    </div>
                    <div class="mt-3 pt-3" style="border-top:1px solid rgba(255,255,255,.15);font-size:12px;opacity:.7">
                        <i class="bi bi-people-fill me-1"></i> {{ number_format($ratingAnalytics['total_responden']) }} Responden
                    </div>
                </div>

                {{-- Responden Stats --}}
                <div class="admin-table p-3">
                    <div class="fw-bold mb-2" style="font-size:12px;text-transform:uppercase;letter-spacing:.5px;color:#64748b">Jenis Responden</div>
                    @foreach($ratingAnalytics['responden_stats'] as $r)
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="badge {{ $r->responden === 'pasien' ? 'bg-info' : 'bg-secondary' }}" style="font-size:11px;text-transform:capitalize">
                            {{ $r->responden ?? 'Tidak diisi' }}
                        </span>
                        <strong>{{ $r->total }}</strong>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Per Indicator Horizontal Bar --}}
        <div class="col-lg-9">
            <div class="admin-table p-4 h-100">
                <h6 class="fw-bold text-secondary mb-4" style="font-size:13px;text-transform:uppercase;letter-spacing:.5px">
                    Rata-Rata Penilaian Per Indikator
                </h6>
                <div id="indikatorBars"></div>
            </div>
        </div>
    </div>

    {{-- Row 2: Kategori + Tren Bulanan --}}
    <div class="row g-4">
        {{-- Kategori Feedback --}}
        <div class="col-lg-4">
            <div class="admin-table p-4 h-100">
                <h6 class="fw-bold text-secondary mb-3" style="font-size:13px;text-transform:uppercase;letter-spacing:.5px">Distribusi Kategori</h6>
                <div style="position:relative;height:260px">
                    <canvas id="chartKategori"></canvas>
                </div>
            </div>
        </div>

        {{-- Tren Masukan Per Bulan --}}
        <div class="col-lg-8">
            <div class="admin-table p-4 h-100">
                <h6 class="fw-bold text-secondary mb-3" style="font-size:13px;text-transform:uppercase;letter-spacing:.5px">Tren Jumlah Masukan (12 Bulan)</h6>
                <div style="position:relative;height:260px">
                    <canvas id="chartTrenBulan"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

{{-- ════════════════════════════════════════
     PANEL KHUSUS ADMIN SDM
     Tampil hanya untuk admin_sdm
     ════════════════════════════════════════ --}}
@if($user->isAdminSdm() && !$user->isSuperAdmin())
<div class="mt-4">
    <h5 class="fw-bold mb-3">📋 Rekap SDM</h5>
    <div class="row g-4">
        <div class="col-lg-6">
            @if($recentLamarans->count())
            <div class="admin-table">
                <div class="d-flex align-items-center justify-content-between p-4 pb-0">
                    <h6 class="fw-bold mb-0" style="font-size:15px">Lamaran Terbaru</h6>
                    <a href="{{ route('admin.lamaran.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                </div>
                <div class="p-3">
                    <table class="table table-hover">
                        <thead><tr><th>Nama</th><th>Posisi</th><th>Status</th><th>Tanggal</th></tr></thead>
                        <tbody>
                        @foreach($recentLamarans as $l)
                        <tr>
                            <td class="fw-semibold">{{ $l->nama }}</td>
                            <td style="font-size:12px;color:#64748b">{{ $l->karir->posisi ?? '-' }}</td>
                            <td><span class="badge bg-{{ $l->status_color }}">{{ $l->status_label }}</span></td>
                            <td style="font-size:12px;color:#64748b">{{ $l->created_at->format('d M Y') }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @else
            <div class="admin-table p-4 text-center text-muted">
                <i class="bi bi-person-lines-fill fs-1 d-block mb-2 opacity-50"></i>
                Belum ada lamaran yang masuk.
            </div>
            @endif
        </div>
        <div class="col-lg-6">
            <div class="admin-table p-4">
                <h6 class="fw-bold mb-3">Lowongan Aktif</h6>
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="stat-icon" style="background:#d1fae5;color:#059669;width:48px;height:48px;font-size:22px;"><i class="bi bi-briefcase-fill"></i></div>
                    <div>
                        <div style="font-size:28px;font-weight:800;">{{ $stats['karirs'] ?? 0 }}</div>
                        <div class="text-muted small">Posisi dibuka</div>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon" style="background:#fef3c7;color:#d97706;width:48px;height:48px;font-size:22px;"><i class="bi bi-person-lines-fill"></i></div>
                    <div>
                        <div style="font-size:28px;font-weight:800;">{{ $stats['lamarans'] ?? 0 }}</div>
                        <div class="text-muted small">Lamaran pending</div>
                    </div>
                </div>
                <div class="mt-3 pt-3 border-top">
                    <a href="{{ route('admin.karir.create') }}" class="btn btn-primary btn-sm me-2"><i class="bi bi-plus me-1"></i>Buka Lowongan</a>
                    <a href="{{ route('admin.lamaran.index') }}" class="btn btn-outline-primary btn-sm">Semua Lamaran</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@endsection

@push('scripts')
@if(isset($ratingAnalytics))
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    Chart.defaults.font.family = "'Metropolis', system-ui, sans-serif";
    Chart.defaults.color = '#64748b';

    const indikatorData = @json($ratingAnalytics['avg_per_indikator']);
    const kategoriData  = @json($ratingAnalytics['per_kategori']);
    const bulanData     = @json($ratingAnalytics['masukan_per_bulan']);

    // ── 1. Per-Indicator Horizontal Bars (custom HTML) ──
    const container = document.getElementById('indikatorBars');
    const colors = [
        '#0055a5','#00a859','#e8333c','#d97706',
        '#7c3aed','#0ea5e9','#f43f5e','#10b981','#f59e0b','#6366f1'
    ];
    const maxScore = 5;

    indikatorData.forEach((item, i) => {
        const pct = (item.avg / maxScore * 100).toFixed(1);
        const stars = Math.round(item.avg);
        let starHtml = '';
        for(let s=1;s<=5;s++) starHtml += `<i class="${s<=stars?'fas':'far'} fa-star" style="color:#f59e0b;font-size:11px"></i>`;

        const row = document.createElement('div');
        row.className = 'mb-3';
        row.innerHTML = `
            <div class="d-flex justify-content-between align-items-center mb-1">
                <span style="font-size:13px;font-weight:600;color:#334155;min-width:160px">${item.label}</span>
                <span style="font-size:12px;color:#64748b">${starHtml} <strong style="color:#1e293b;margin-left:4px">${item.avg.toFixed(1)}</strong>/5.0
                <small class="text-muted ms-2">(${item.total} resp.)</small></span>
            </div>
            <div style="background:#f1f5f9;border-radius:99px;height:10px;overflow:hidden">
                <div style="width:${pct}%;background:${colors[i]};height:100%;border-radius:99px;transition:width .8s ease"></div>
            </div>`;
        container.appendChild(row);
    });

    // ── 2. Kategori Donut ──
    new Chart(document.getElementById('chartKategori'), {
        type: 'doughnut',
        data: {
            labels: kategoriData.map(d => d.kategori ? d.kategori.charAt(0).toUpperCase() + d.kategori.slice(1) : 'Lainnya'),
            datasets: [{
                data: kategoriData.map(d => d.total),
                backgroundColor: ['#e8333c','#0055a5','#00a859','#d97706'],
                borderWidth: 0,
                hoverOffset: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '65%',
            plugins: {
                legend: { position: 'bottom', labels: { padding: 16, usePointStyle: true, pointStyle: 'circle', font: { size: 12 } } },
                tooltip: {
                    backgroundColor: 'rgba(15,23,42,.9)',
                    padding: 12, cornerRadius: 8,
                    callbacks: {
                        label: function(c) {
                            let total = c.dataset.data.reduce((a,b)=>a+b,0);
                            return ` ${c.label}: ${c.raw} (${((c.raw/total)*100).toFixed(1)}%)`;
                        }
                    }
                }
            }
        }
    });

    // ── 3. Tren Masukan Bulanan (Bar) ──
    const ctx = document.getElementById('chartTrenBulan').getContext('2d');
    let grad = ctx.createLinearGradient(0, 0, 0, 280);
    grad.addColorStop(0, 'rgba(0,85,165,.3)');
    grad.addColorStop(1, 'rgba(0,85,165,0)');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: bulanData.map(d => {
                const [y, m] = d.bulan.split('-');
                return new Date(y, m-1).toLocaleDateString('id-ID', { month: 'short', year: '2-digit' });
            }),
            datasets: [{
                label: 'Masukan',
                data: bulanData.map(d => d.total),
                backgroundColor: 'rgba(0,85,165,.75)',
                borderRadius: 5,
                barPercentage: 0.6,
                maxBarThickness: 40
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(15,23,42,.9)',
                    padding: 10, cornerRadius: 8, displayColors: false,
                    callbacks: { label: c => ` ${c.raw} masukan` }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1, padding: 8 },
                    grid: { color: '#f1f5f9', drawBorder: false }
                },
                x: {
                    ticks: { padding: 8 },
                    grid: { display: false, drawBorder: false }
                }
            }
        }
    });
});
</script>
@endif
@endpush

