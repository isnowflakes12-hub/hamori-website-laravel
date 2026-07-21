@extends('layouts.app')

@section('title', $dokter->nama_lengkap . ' - Jadwal Dokter RS Hamori')

@section('content')

@php
    $waNumber = \App\Models\SiteSetting::get('phone_whatsapp', '6281111121705');
    $jadwalSorted = $dokter->jadwal->sortBy(function($j) {
        return ['Senin'=>1,'Selasa'=>2,'Rabu'=>3,'Kamis'=>4,'Jumat'=>5,'Sabtu'=>6,'Minggu'=>7][$j->hari] ?? 8;
    });

    $hariOrder = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'];
    $jadwalPerHari = [];
    foreach($hariOrder as $h) { $jadwalPerHari[$h] = []; }
    foreach($jadwalSorted as $j) {
        $jadwalPerHari[$j->hari][] = substr($j->jam_mulai,0,5).' – '.substr($j->jam_selesai,0,5);
    }
    $maxRows = max(1, max(array_map('count', $jadwalPerHari)));
@endphp

<div class="page-header">
    <div class="container">
        <h1 class="page-title">Profil Dokter</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dokter.index') }}">Jadwal Dokter</a></li>
                <li class="breadcrumb-item active">{{ $dokter->nama }}</li>
            </ol>
        </nav>
    </div>
</div>

<section class="dokter-detail-section">
    <div class="container">
        <div class="row g-4">
            
            {{-- KOLOM KIRI: Foto & CTA --}}
            <div class="col-lg-4">
                <div class="dokter-profile-card">
                    <div class="dokter-profile-photo-wrapper">
                        @if($dokter->foto)
                        <img src="{{ asset('storage/' . $dokter->foto) }}" alt="{{ $dokter->nama }}" class="dokter-profile-photo">
                        @else
                        <div class="dokter-profile-placeholder">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        @endif
                        <div class="dokter-profile-badge">
                            <i class="bi bi-check-circle-fill"></i> Tersedia
                        </div>
                    </div>
                    
                    <div class="dokter-profile-info text-center mt-4">
                        <h3 class="dokter-profile-name">{{ $dokter->nama_lengkap }}</h3>
                        <div class="dokter-profile-specialty">{{ strtoupper($dokter->poli->nama) }}</div>
                    </div>

                    <div class="dokter-profile-actions mt-4">
                        <a href="https://wa.me/{{ $waNumber }}?text={{ urlencode('Halo RS Hamori, saya ingin mendaftar untuk '.$dokter->nama_lengkap.' dari poli '.$dokter->poli->nama) }}" target="_blank" class="btn btn-buat-janji w-100">
                            <i class="bi bi-whatsapp me-2"></i> Buat Janji Temu
                        </a>
                        <a href="{{ route('dokter.index') }}" class="btn btn-outline-secondary w-100 mt-2">
                            <i class="bi bi-arrow-left me-2"></i> Kembali ke Jadwal
                        </a>
                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN: Detail & Jadwal --}}
            <div class="col-lg-8">
                <div class="dokter-detail-content">
                    
                    {{-- Nav Tabs --}}
                    <ul class="nav nav-tabs detail-tabs" id="dokterTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="jadwal-tab" data-bs-toggle="tab" data-bs-target="#jadwal" type="button" role="tab"><i class="bi bi-calendar3 me-2"></i>Jadwal Praktek</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profil-tab" data-bs-toggle="tab" data-bs-target="#profil" type="button" role="tab"><i class="bi bi-person-lines-fill me-2"></i>Profil Lengkap</button>
                        </li>
                    </ul>

                    <div class="tab-content" id="dokterTabsContent">
                        
                        {{-- TAB: JADWAL --}}
                        <div class="tab-pane fade show active" id="jadwal" role="tabpanel">
                            <div class="detail-section-box">
                                <h4 class="detail-section-title">Jadwal Praktek</h4>
                                <p class="text-muted mb-4">Berikut adalah jadwal praktek {{ $dokter->nama_lengkap }} di RS Hamori.</p>
                                
                                <div class="table-responsive">
                                    <table class="jadwal-week-table w-100">
                                        <thead>
                                            <tr>
                                                @foreach($hariOrder as $h)
                                                <th>{{ strtoupper(substr($h,0,3)) }}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @for($row = 0; $row < $maxRows; $row++)
                                            <tr>
                                                @foreach($hariOrder as $h)
                                                <td>{{ $jadwalPerHari[$h][$row] ?? '-' }}</td>
                                                @endforeach
                                            </tr>
                                            @endfor
                                        </tbody>
                                    </table>
                                </div>
                                @if($jadwalSorted->isEmpty())
                                <div class="alert alert-warning mt-3">
                                    <i class="bi bi-info-circle me-2"></i> Saat ini jadwal praktek belum tersedia.
                                </div>
                                @endif
                            </div>
                        </div>

                        {{-- TAB: PROFIL --}}
                        <div class="tab-pane fade" id="profil" role="tabpanel">
                            <div class="detail-section-box">
                                <h4 class="detail-section-title">Tentang Dokter</h4>
                                <div class="dokter-bio">
                                    @if($dokter->bio)
                                        {!! nl2br(e($dokter->bio)) !!}
                                    @else
                                        <p class="text-muted">Informasi biografi belum tersedia untuk dokter ini.</p>
                                    @endif
                                </div>

                                <hr class="my-4">

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <h5 class="info-title"><i class="bi bi-mortarboard-fill me-2 text-primary"></i>Riwayat Pendidikan</h5>
                                        <div class="info-content">
                                            @if($dokter->pendidikan)
                                                {!! nl2br(e($dokter->pendidikan)) !!}
                                            @else
                                                <span class="text-muted">Belum ada data</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <h5 class="info-title"><i class="bi bi-award-fill me-2 text-primary"></i>Spesialisasi Tambahan</h5>
                                        <div class="info-content">
                                            @if($dokter->spesialisasi)
                                                {!! nl2br(e($dokter->spesialisasi)) !!}
                                            @else
                                                <span class="text-muted">Belum ada data</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<style>
/* Dokter Detail Page CSS */
.dokter-detail-section {
    padding: 60px 0 100px;
    background: #f8fbff;
    min-height: calc(100vh - 300px);
}

.dokter-profile-card {
    background: #fff;
    border-radius: 16px;
    padding: 30px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.03);
    border: 1px solid #eef1f6;
    position: sticky;
    top: 100px;
}

.dokter-profile-photo-wrapper {
    position: relative;
    width: 180px;
    height: 180px;
    margin: 0 auto;
    border-radius: 50%;
    border: 4px solid #fff;
    box-shadow: 0 8px 24px rgba(13,110,253,0.15);
    background: #e4e9f0;
}

.dokter-profile-photo {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: top center;
    border-radius: 50%;
}

.dokter-profile-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 80px;
    color: #9ba5b4;
    border-radius: 50%;
    background: linear-gradient(135deg, #eef1f6, #e4e9f0);
}

.dokter-profile-badge {
    position: absolute;
    bottom: 10px;
    right: 5px;
    background: #198754;
    color: #fff;
    font-size: 11px;
    font-weight: 700;
    padding: 4px 12px;
    border-radius: 20px;
    border: 2px solid #fff;
    display: flex;
    align-items: center;
    gap: 4px;
}

.dokter-profile-name {
    font-size: 20px;
    font-weight: 800;
    color: #1a202c;
    margin-bottom: 6px;
}

.dokter-profile-specialty {
    font-size: 13px;
    font-weight: 600;
    color: var(--primary, #0d6efd);
    letter-spacing: 0.5px;
}

.btn-buat-janji {
    background: #a91e41; /* Warna merah Hamori */
    color: #fff;
    border: none;
    padding: 12px;
    border-radius: 10px;
    font-weight: 600;
    transition: background 0.2s;
}

.btn-buat-janji:hover {
    background: #8b1835;
    color: #fff;
}

/* Kanan Content */
.dokter-detail-content {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.03);
    border: 1px solid #eef1f6;
    overflow: hidden;
}

.detail-tabs {
    background: #f1f5fa;
    border-bottom: none;
    padding: 10px 10px 0 10px;
}

.detail-tabs .nav-item {
    margin-bottom: 0;
}

.detail-tabs .nav-link {
    border: none;
    color: #6c757d;
    font-weight: 600;
    padding: 14px 24px;
    border-radius: 12px 12px 0 0;
    transition: all 0.2s;
}

.detail-tabs .nav-link:hover {
    color: var(--primary, #0d6efd);
}

.detail-tabs .nav-link.active {
    background: #fff;
    color: var(--primary, #0d6efd);
    box-shadow: 0 -4px 10px rgba(0,0,0,0.02);
}

.detail-section-box {
    padding: 30px;
}

.detail-section-title {
    font-size: 18px;
    font-weight: 700;
    color: #1a202c;
    margin-bottom: 8px;
}

/* Tabel Jadwal (reused from index) */
.jadwal-week-table {
    border-collapse: collapse;
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
}

.jadwal-week-table th {
    background: #f8fbff;
    color: #1a202c;
    font-size: 12px;
    font-weight: 700;
    text-align: center;
    padding: 12px;
    border: 1px solid #eef1f6;
}

.jadwal-week-table td {
    text-align: center;
    padding: 12px;
    font-size: 13px;
    color: #3f4756;
    border: 1px solid #eef1f6;
    font-weight: 500;
}

.info-title {
    font-size: 14px;
    font-weight: 700;
    color: #1a202c;
    margin-bottom: 10px;
}

.info-content {
    font-size: 14px;
    color: #4a5568;
    line-height: 1.6;
}

.dokter-bio {
    font-size: 14.5px;
    line-height: 1.7;
    color: #4a5568;
}
</style>

@endsection
