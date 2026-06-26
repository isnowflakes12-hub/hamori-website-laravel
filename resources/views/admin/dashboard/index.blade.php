@extends('admin.layouts.app')
@section('title','Dashboard')
@section('page-title','Dashboard')

@section('content')
@php $user = auth()->user(); @endphp

<div class="row g-4 mb-4">
    {{-- Stats untuk semua yang punya akses banner/marketing --}}
    @if(isset($stats['banners']))
    <div class="col-6 col-md-3">
        <a href="{{ route('admin.banner.index') }}" class="stat-card">
            <div class="stat-icon" style="background:#eff6ff;color:#0055a5"><i class="bi bi-image-fill"></i></div>
            <div class="stat-num">{{ $stats['banners'] }}</div>
            <div class="stat-label">Total Banner</div>
        </a>
    </div>
    @if(isset($stats['promos']))
    <div class="col-6 col-md-3">
        <a href="{{ route('admin.promo.index') }}" class="stat-card">
            <div class="stat-icon" style="background:#fff1f2;color:#d93025"><i class="bi bi-gift-fill"></i></div>
            <div class="stat-num">{{ $stats['promos'] }}</div>
            <div class="stat-label">Promo Aktif</div>
        </a>
    </div>
    @endif
    <div class="col-6 col-md-3">
        <a href="{{ route('admin.artikel.index') }}" class="stat-card">
            <div class="stat-icon" style="background:#f0fdf4;color:#00a859"><i class="bi bi-newspaper"></i></div>
            <div class="stat-num">{{ $stats['artikels'] }}</div>
            <div class="stat-label">Total Artikel</div>
        </a>
    </div>
    <div class="col-6 col-md-3">
        <a href="{{ route('admin.layanan.index') }}" class="stat-card">
            <div class="stat-icon" style="background:#e0f2fe;color:#0ea5e9"><i class="bi bi-award-fill"></i></div>
            <div class="stat-num">{{ $stats['layanans'] ?? 0 }}</div>
            <div class="stat-label">Layanan Unggulan</div>
        </a>
    </div>
    <div class="col-6 col-md-3">
        <a href="{{ route('admin.kritik-saran.index') }}" class="stat-card">
            <div class="stat-icon" style="background:#fef3c7;color:#d97706"><i class="bi bi-envelope-paper-fill"></i></div>
            <div class="stat-num">{{ $stats['kritiks'] ?? 0 }}</div>
            <div class="stat-label">Kritik & Saran Pending</div>
        </a>
    </div>
    {{-- Stat tambahan hanya untuk Super Admin --}}
    @if($user->isSuperAdmin())
    <div class="col-6 col-md-3">
        <a href="{{ route('admin.dokter.index') }}" class="stat-card">
            <div class="stat-icon" style="background:#faf5ff;color:#7c3aed"><i class="bi bi-person-badge-fill"></i></div>
            <div class="stat-num">{{ $stats['dokters'] }}</div>
            <div class="stat-label">Total Dokter</div>
        </a>
    </div>
    <div class="col-6 col-md-3">
        <a href="{{ route('admin.fasilitas.index') }}" class="stat-card">
            <div class="stat-icon" style="background:#f3e8ff;color:#a855f7"><i class="bi bi-building"></i></div>
            <div class="stat-num">{{ $stats['fasilitas'] ?? 0 }}</div>
            <div class="stat-label">Total Fasilitas</div>
        </a>
    </div>
    <div class="col-6 col-md-3">
        <a href="{{ route('admin.kontak.index') }}" class="stat-card">
            <div class="stat-icon" style="background:#fff1f2;color:#e8333c"><i class="bi bi-chat-text-fill"></i></div>
            <div class="stat-num">{{ $stats['kontaks'] ?? 0 }}</div>
            <div class="stat-label">Pesan Masuk Baru</div>
        </a>
    </div>
    @endif
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
    {{-- Lamaran Terbaru: hanya SDM/Super Admin --}}
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
    {{-- Pesan Masuk: hanya Super Admin --}}
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
    {{-- Kritik & Saran: tampil untuk Marketing dan Super Admin --}}
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
    <div class="d-flex align-items-center mb-4">
        <h5 class="fw-bold mb-0">Analisa Rating & Feedback Pasien</h5>
    </div>
    
    <!-- Baris 1: Rata-Rata Rating & Kategori Feedback -->
    <div class="row g-4 mb-4">
        <!-- Rata-Rata Keseluruhan -->
        <div class="col-lg-4">
            <div class="admin-table p-4 d-flex align-items-center justify-content-center h-100" style="background: linear-gradient(135deg, #0055a5 0%, #003d7a 100%); color: white; border: none; box-shadow: 0 10px 25px rgba(0,85,165,0.2);">
                <div class="text-center w-100">
                    <div class="stat-icon mx-auto mb-4" style="background: rgba(255,255,255,0.15); color: #f59e0b; width: 80px; height: 80px; font-size: 36px; display: flex; align-items: center; justify-content: center; border-radius: 50%; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                        <i class="bi bi-star-fill"></i>
                    </div>
                    <div class="text-white-50 fw-semibold mb-2" style="font-size: 15px; text-transform: uppercase; letter-spacing: 1px;">Rating Keseluruhan</div>
                    <div class="text-white fw-bold d-flex align-items-baseline justify-content-center gap-1 mb-3" style="font-size: 56px; line-height: 1; text-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                        {{ number_format($ratingAnalytics['avg_keseluruhan'], 1) }} <span class="text-white-50" style="font-size: 24px;">/ 5.0</span>
                    </div>
                    <div class="text-white-50 pt-3 border-top border-light border-opacity-10" style="font-size: 14px;">
                        <i class="bi bi-people-fill me-1"></i> Berdasarkan <strong>{{ $ratingAnalytics['total_responden'] }}</strong> Ulasan
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Kategori Feedback -->
        <div class="col-lg-8">
            <div class="admin-table p-4 h-100">
                <h6 class="fw-bold text-secondary mb-4" style="font-size: 15px; text-transform: uppercase; letter-spacing: 0.5px;">Distribusi Kategori Feedback</h6>
                <div style="position: relative; height: 280px; width: 100%; display: flex; align-items: center; justify-content: center;">
                    <canvas id="chartKategori"></canvas>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Baris 2: Trend Rating Sejajar (Hari, Bulan, Tahun) -->
    <div class="row g-4">
        <!-- Trend 7 Hari -->
        <div class="col-lg-4">
            <div class="admin-table p-4 h-100">
                <h6 class="fw-bold text-secondary mb-4" style="font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px;">Trend 7 Hari Terakhir</h6>
                <div style="position: relative; height: 250px; width: 100%;">
                    <canvas id="chartRatingHari"></canvas>
                </div>
            </div>
        </div>
        
        <!-- Trend Per Bulan -->
        <div class="col-lg-4">
            <div class="admin-table p-4 h-100">
                <h6 class="fw-bold text-secondary mb-4" style="font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px;">Trend Per Bulan</h6>
                <div style="position: relative; height: 250px; width: 100%;">
                    <canvas id="chartRatingBulan"></canvas>
                </div>
            </div>
        </div>
        
        <!-- Trend Per Tahun -->
        <div class="col-lg-4">
            <div class="admin-table p-4 h-100">
                <h6 class="fw-bold text-secondary mb-4" style="font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px;">Trend Per Tahun</h6>
                <div style="position: relative; height: 250px; width: 100%;">
                    <canvas id="chartRatingTahun"></canvas>
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
    Chart.defaults.font.family = "'Inter', system-ui, -apple-system, sans-serif";
    Chart.defaults.color = '#64748b';

    const commonOptions = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false },
            tooltip: {
                backgroundColor: 'rgba(15, 23, 42, 0.9)',
                titleFont: { size: 12 },
                bodyFont: { size: 14, weight: 'bold' },
                padding: 12,
                cornerRadius: 8,
                displayColors: false,
                callbacks: {
                    label: function(context) {
                        return 'Rating: ' + context.parsed.y.toFixed(1) + ' / 5.0';
                    }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                max: 5,
                ticks: { stepSize: 1, padding: 10 },
                grid: { color: '#f1f5f9', drawBorder: false }
            },
            x: {
                ticks: { padding: 10 },
                grid: { display: false, drawBorder: false }
            }
        },
        interaction: {
            intersect: false,
            mode: 'index',
        },
    };

    const dataHari = @json($ratingAnalytics['per_hari']);
    const dataBulan = @json($ratingAnalytics['per_bulan']);
    const dataTahun = @json($ratingAnalytics['per_tahun']);
    const dataKategori = @json($ratingAnalytics['per_kategori']);

    // 1. Chart Rating Per Hari (Line)
    const ctxHari = document.getElementById('chartRatingHari').getContext('2d');
    let gradientHari = ctxHari.createLinearGradient(0, 0, 0, 300);
    gradientHari.addColorStop(0, 'rgba(0, 85, 165, 0.2)');
    gradientHari.addColorStop(1, 'rgba(0, 85, 165, 0)');

    new Chart(ctxHari, {
        type: 'line',
        data: {
            labels: dataHari.map(item => {
                const date = new Date(item.tanggal);
                return date.toLocaleDateString('id-ID', { day: 'numeric', month: 'short' });
            }),
            datasets: [{
                label: 'Rata-rata Rating',
                data: dataHari.map(item => item.avg_rating),
                borderColor: '#0055a5',
                backgroundColor: gradientHari,
                borderWidth: 3,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#0055a5',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6,
                fill: true,
                tension: 0.4
            }]
        },
        options: commonOptions
    });

    // 2. Chart Rating Per Bulan (Bar)
    new Chart(document.getElementById('chartRatingBulan'), {
        type: 'bar',
        data: {
            labels: dataBulan.map(item => {
                const [year, month] = item.bulan.split('-');
                const date = new Date(year, month - 1);
                return date.toLocaleDateString('id-ID', { month: 'short', year: '2-digit' });
            }),
            datasets: [{
                label: 'Rata-rata Rating',
                data: dataBulan.map(item => item.avg_rating),
                backgroundColor: '#00a859',
                borderRadius: 4,
                barPercentage: 0.5,
                maxBarThickness: 40
            }]
        },
        options: commonOptions
    });

    // 3. Chart Rating Per Tahun (Bar)
    new Chart(document.getElementById('chartRatingTahun'), {
        type: 'bar',
        data: {
            labels: dataTahun.map(item => item.tahun),
            datasets: [{
                label: 'Rata-rata Rating',
                data: dataTahun.map(item => item.avg_rating),
                backgroundColor: '#003d7a',
                borderRadius: 4,
                barPercentage: 0.5,
                maxBarThickness: 40
            }]
        },
        options: commonOptions
    });

    // 4. Chart Kategori Feedback (Doughnut)
    new Chart(document.getElementById('chartKategori'), {
        type: 'doughnut',
        data: {
            labels: dataKategori.map(item => item.kategori.charAt(0).toUpperCase() + item.kategori.slice(1)),
            datasets: [{
                data: dataKategori.map(item => item.total),
                backgroundColor: ['#e8333c', '#0055a5', '#00a859', '#d97706'],
                borderWidth: 0,
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: {
                legend: { 
                    position: 'bottom',
                    labels: { padding: 20, usePointStyle: true, pointStyle: 'circle' }
                },
                tooltip: {
                    backgroundColor: 'rgba(15, 23, 42, 0.9)',
                    padding: 12,
                    cornerRadius: 8,
                    callbacks: {
                        label: function(context) {
                            let total = context.dataset.data.reduce((a, b) => a + b, 0);
                            let val = context.raw;
                            let pct = ((val / total) * 100).toFixed(1) + '%';
                            return ' ' + context.label + ': ' + val + ' (' + pct + ')';
                        }
                    }
                }
            }
        }
    });
});
</script>
@endif
@endpush
