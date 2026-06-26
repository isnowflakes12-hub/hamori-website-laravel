@extends('layouts.app')
@section('title', 'Profil Rumah Sakit')

@section('content')

@push('styles')
<style>
    .sec { padding: 30px 0; }
</style>
@endpush

{{-- ── PAGE HEADER ── --}}
<div class="page-header">
    <div class="container">
        <h1 class="page-title">Profil RS Hamori</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Profil RS</li>
            </ol>
        </nav>
    </div>
</div>

{{-- ── TENTANG KAMI ── --}}
<section class="pr-section sec">
    <div class="container">
        <div class="row g-5 align-items-center">

            {{-- Teks --}}
            <div class="col-lg-6">
                <span class="eyebrow">Tentang Kami</span>
                <div class="d-flex align-items-center gap-3 mt-1 mb-4">
                    <h2 class="sec-h2 mb-0">Rumah Sakit Hamori</h2>
                    @if($profil->kars_logo)
                        <img src="{{ asset('storage/'.$profil->kars_logo) }}" alt="Logo KARS" style="height:45px;object-fit:contain;">
                    @endif
                </div>
                <p class="pr-desc">
                    {!! nl2br(e($profil->deskripsi)) !!}
                </p>

                {{-- Stats --}}
                <div class="pr-stats">
                    <div class="pr-stat">
                        <span class="pr-stat-n">{{ $profil->total_dokter }}</span>
                        <span class="pr-stat-l">Dokter Spesialis</span>
                    </div>
                    <div class="pr-stat">
                        <span class="pr-stat-n">{{ $profil->total_bed }}</span>
                        <span class="pr-stat-l">Tempat Tidur</span>
                    </div>
                    <div class="pr-stat">
                        <span class="pr-stat-n">24/7</span>
                        <span class="pr-stat-l">Layanan IGD</span>
                    </div>
                    <div class="pr-stat">
                        <span class="pr-stat-n">{{ $profil->pusat_unggulan }}</span>
                        <span class="pr-stat-l">Pusat Unggulan</span>
                    </div>
                </div>

                {{-- Trust badges --}}
                <div class="pr-trust">
                    <span class="pr-trust-item">
                        <i class="fas fa-check-circle"></i> Terakreditasi Paripurna KARS
                    </span>
                    <span class="pr-trust-item">
                        <i class="fas fa-check-circle"></i> Bisa menggunakan BPJS
                    </span>
                    
                </div>
            </div>

            {{-- Galeri / Foto --}}
            <div class="col-lg-6">
                <div class="pr-gallery">
                    {{-- Foto utama --}}
                    @php $imgUtama = $profil->gambar_utama ? asset('storage/'.$profil->gambar_utama) : asset('assets/images/hamoripf.jpeg'); @endphp
                    <a href="{{ $imgUtama }}"
                       class="glightbox pr-img-main"
                       data-gallery="rs-gallery"
                       data-title="Rumah Sakit Hamori – Subang | &copy; {{ date('Y') }} RS HAMORI">
                        <img src="{{ $imgUtama }}"
                             alt="Rumah Sakit Hamori" loading="eager">
                        <span class="pr-img-overlay">
                            <i class="fas fa-expand-alt"></i>
                            <span>Lihat Foto</span>
                        </span>
                    </a>

                    {{-- Foto tambahan (hidden, untuk galeri) --}}
                    <a href="{{ asset('assets/images/hamoripf2.jpeg') }}"
                       class="glightbox d-none"
                       data-gallery="rs-gallery"
                       data-title="Rumah Sakit Hamori – Subang | &copy; {{ date('Y') }} RS HAMORI">
                    </a>

                    {{-- Badge lokasi --}}
                    <div class="pr-location-badge">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Subang, Jawa Barat</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ── VISI & MISI ── --}}
<section class="pr-vm-section sec bg-light">
    <div class="container">

        <div class="sec-head justify-content-center text-center mb-5">
            <div>
                <span class="eyebrow">Landasan Kami</span>
                <h2 class="sec-h2 mt-1">Visi & Misi</h2>
            </div>
        </div>

        <div class="row g-4 align-items-start">

            {{-- VISI --}}
            <div class="col-lg-4">
                <div class="pr-vm-card pr-vm-card--visi">
                    {{--<div class="pr-vm-icon">
                        <i class="fas fa-eye"></i>
                    </div> --}}
                    <h4 class="pr-vm-label">Visi</h4>
                    <p class="pr-vm-text">
                        {!! nl2br(e($profil->visi)) !!}
                    </p>
                    <div class="pr-vm-accent"></div>
                </div>
            </div>

            {{-- MISI --}}
            <div class="col-lg-8">
                <div class="pr-vm-card pr-vm-card--misi">
                     {{-- <div class="pr-vm-icon pr-vm-icon--accent">
                        <i class="fas fa-bullseye"></i>
                    </div>--}}
                    <h4 class="pr-vm-label">Misi</h4>
                    <ul class="pr-misi-list">
                        @php $misiList = array_filter(array_map('trim', explode("\n", $profil->misi))); @endphp
                        @foreach($misiList as $i => $m)
                        <li class="pr-misi-item">
                            <span class="pr-misi-num">{{ str_pad($i+1, 2, '0', STR_PAD_LEFT) }}</span>
                            <p class="pr-misi-text">
                                {{ $m }}
                            </p>
                        </li>
                        @endforeach
                    </ul>
                    <div class="pr-vm-accent pr-vm-accent--right"></div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ── MILESTONE ── --}}
@if($milestones->isNotEmpty())
<section class="pr-milestone-section sec">
    <div class="container">
        <div class="text-center mb-5">
            <span class="eyebrow">Perjalanan Kami</span>
            <h2 class="sec-h2 mt-1">Milestone RS Hamori</h2>
        </div>
        
        <div class="ms-timeline">
            @foreach($milestones as $i => $ms)
            <div class="ms-item {{ $i % 2 == 0 ? 'ms-left' : 'ms-right' }}">
                <div class="ms-content">
                    <h3 class="ms-year">{{ $ms->tahun }}</h3>
                    <h4 class="ms-title">{{ $ms->judul }}</h4>
                    <p class="ms-desc">{{ $ms->deskripsi }}</p>
                    @if($ms->gambar)
                        <img src="{{ asset('storage/'.$ms->gambar) }}" alt="{{ $ms->judul }}" class="ms-img">
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ── NILAI / VALUE ── --}}
<section class="pr-values-section sec">
    <div class="container">

        <div class="text-center mb-5">
            <span class="eyebrow">Komitmen Kami</span>
            <h2 class="sec-h2 mt-1">Nilai-Nilai yang Kami Junjung</h2>
        </div>

        <div class="row g-4">
            <div class="col-md-3 col-6">
                <div class="pr-val-card">
                    <div class="pr-val-ic"><i class="fas fa-heart-pulse"></i></div>
                    <h6 class="pr-val-title">Keselamatan Pasien</h6>
                    <p class="pr-val-desc">Prioritas utama dalam setiap tindakan medis.</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="pr-val-card">
                    <div class="pr-val-ic pr-val-ic--accent"><i class="fas fa-hand-holding-medical"></i></div>
                    <h6 class="pr-val-title">Pelayanan Prima</h6>
                    <p class="pr-val-desc">Standar layanan tertinggi untuk setiap pasien.</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="pr-val-card">
                    <div class="pr-val-ic pr-val-ic--green"><i class="fas fa-leaf"></i></div>
                    <h6 class="pr-val-title">Ramah Lingkungan</h6>
                    <p class="pr-val-desc">Operasional berkelanjutan demi lingkungan sehat.</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="pr-val-card">
                    <div class="pr-val-ic pr-val-ic--amber"><i class="fas fa-shield-halved"></i></div>
                    <h6 class="pr-val-title">Integritas</h6>
                    <p class="pr-val-desc">Profesional, jujur, dan dapat dipercaya.</p>
                </div>
            </div>
        </div>

    </div>
</section>

{{-- ── CTA BANNER ── --}}
<section class="pr-cta-section">
    <div class="container">
        <div class="pr-cta-inner">
            <div class="pr-cta-glow"></div>
            <div class="pr-cta-text">
                <span class="eyebrow" style="color:rgba(255,255,255,.6)">Rumah Sakit Hamori</span>
                <h3 class="pr-cta-title">Mitra Kesehatan Terpercaya Anda !</h3>
                <p class="pr-cta-desc">
                    memberikan pelayanan terbaik secara cepat, tanggap, dan bermutu. Kami hadir lebih dekat untuk memastikan seluruh lapisan masyarakat Subang mendapatkan akses kesehatan yang setara, nyaman, dan terjangkau, baik untuk penanganan darurat maupun perawatan rutin.
                </p>
            </div>
            <div class="pr-cta-actions">
                <a href="https://wa.me/{{ \App\Models\SiteSetting::get('phone_whatsapp', '6281111121705') }}" target="_blank" class="pr-cta-wa">
                    <i class="fab fa-whatsapp"></i> Chat via WhatsApp
                </a>
                <a href="{{ route('layanan.index') }}" class="pr-cta-layanan">
                    <i class="fas fa-star-of-life"></i> Layanan Unggulan
                </a>
            </div>
        </div>
    </div>
</section>




@endsection
