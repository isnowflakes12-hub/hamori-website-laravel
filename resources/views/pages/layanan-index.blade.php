@extends('layouts.app')
@section('title', 'Layanan Unggulan')

@section('content')

{{-- ── PAGE HEADER ── --}}
<div class="page-header">
    <div class="container">
        <h1 class="page-title">Layanan Unggulan</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Layanan Unggulan</li>
            </ol>
        </nav>
    </div>
</div>

{{-- ── INTRO HERO STRIP ── --}}
<div class="li-intro">
    <div class="li-intro-glow li-intro-glow--left"></div>
    <div class="li-intro-glow li-intro-glow--right"></div>
    <div class="container position-relative">
        <div class="li-intro-inner">
            <div class="li-intro-text">
                <span class="eyebrow">Pusat Layanan Terpadu</span>
                <h2 class="sec-h2">Layanan Unggulan<br>RS Hamori</h2>
                <p class="sec-sub mt-2">
                    RS Hamori menghadirkan pusat layanan terpadu dengan dokter spesialis berpengalaman
                    dan peralatan medis berstandar internasional untuk memenuhi kebutuhan kesehatan Anda.
                </p>
            </div>
            <div class="li-intro-stats">
                <div class="li-stat">
                    <span class="li-stat-n">32+</span>
                    <span class="li-stat-l">Dokter Spesialis</span>
                </div>
                <div class="li-stat-div"></div>
                <div class="li-stat">
                    <span class="li-stat-n">24/7</span>
                    <span class="li-stat-l">Siap Melayani</span>
                </div>
                <div class="li-stat-div"></div>
                <div class="li-stat">
                    <span class="li-stat-n">{{ $layanans->count() }}+</span>
                    <span class="li-stat-l">Layanan Unggulan</span>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ── LAYANAN GRID ── --}}
<section class="li-section sec">
    <div class="container">

        @if($layanans->isEmpty())
        <div class="li-empty">
            <div class="li-empty-icon"><i class="fas fa-hospital-alt"></i></div>
            <h4 class="li-empty-title">Belum Ada Layanan</h4>
            <p class="li-empty-desc">Layanan sedang dalam proses pembaruan. Silakan kunjungi kembali.</p>
        </div>

        @else
        <div class="row g-4">
            @foreach($layanans as $layanan)
            <div class="col-md-6 col-lg-4">
                <a href="{{ route('layanan.show', $layanan->slug) }}" class="li-card">

                    {{-- Logo / Icon area ── ukuran konsisten --}}
                    <div class="li-card-media">
                        @if($layanan->logo)
                            <img src="{{ asset('storage/' . $layanan->logo) }}"
                                 alt="{{ $layanan->nama }}"
                                 class="li-card-logo">
                        @else
                            <div class="li-card-icon-fallback">
                                <i class="fas fa-stethoscope"></i>
                            </div>
                        @endif
                    </div>

                    {{-- Body --}}
                    <div class="li-card-body">
                        <h5 class="li-card-title">{{ $layanan->nama }}</h5>
                        <p class="li-card-desc">{{ Str::words($layanan->deskripsi, 18, '...') }}</p>
                    </div>

                    {{-- Footer --}}
                    <div class="li-card-footer">
                        <span class="li-read-more">
                            Selengkapnya
                            <span class="li-read-more-arrow">
                                <i class="fas fa-arrow-right"></i>
                            </span>
                        </span>
                    </div>

                    {{-- Hover accent bar --}}
                    <div class="li-card-bar"></div>

                </a>
            </div>
            @endforeach
        </div>
        @endif

    </div>
</section>

{{-- ── CTA BANNER ── --}}
<section class="li-cta-wrap">
    <div class="container">
        <div class="li-cta-inner">
            <div class="li-cta-glow"></div>
            <div class="li-cta-text">
                <span class="eyebrow" style="color:rgba(255,255,255,.6)">Konsultasikan Kesehatan Anda</span>
                <h3 class="li-cta-title">Tidak Menemukan Layanan yang Anda Cari?</h3>
                <p class="li-cta-desc">Tim medis kami siap membantu mengarahkan Anda ke layanan yang paling sesuai dengan kondisi kesehatan Anda.</p>
            </div>
            <div class="li-cta-actions">
                <a href="https://wa.me/{{ \App\Models\SiteSetting::get('phone_whatsapp', '6281111121705') }}" target="_blank" class="li-cta-wa">
                    <i class="fab fa-whatsapp"></i>
                    Chat via WhatsApp
                </a>
                <a href="{{ route('appointment') }}" class="li-cta-tel">
                    <i class="fas fa-calendar-check"></i>
                    Buat Appoitment
                </a>
            </div>
        </div>
    </div>
</section>




@endsection
