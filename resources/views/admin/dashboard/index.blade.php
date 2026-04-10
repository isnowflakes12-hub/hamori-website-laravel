@extends('admin.layouts.app')
@section('title','Dashboard')
@section('page-title','Dashboard')

@section('content')
@php $user = auth()->user(); @endphp

<div class="row g-4 mb-4">
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
        <a href="{{ route('admin.dokter.index') }}" class="stat-card">
            <div class="stat-icon" style="background:#faf5ff;color:#7c3aed"><i class="bi bi-person-badge-fill"></i></div>
            <div class="stat-num">{{ $stats['dokters'] }}</div>
            <div class="stat-label">Total Dokter</div>
        </a>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#fff1f2;color:#e8333c"><i class="bi bi-envelope-fill"></i></div>
            <div class="stat-num">{{ $stats['kontaks'] ?? 0 }}</div>
            <div class="stat-label">Pesan Belum Dibaca</div>
        </div>
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
    @if($recentLamarans->count())
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
    @if($recentKontaks->count())
    <div class="col-lg-6">
        <div class="admin-table">
            <div class="d-flex align-items-center justify-content-between p-4 pb-0">
                <h6 class="fw-bold mb-0" style="font-size:15px">Pesan Terbaru</h6>
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
</div>
@endsection
