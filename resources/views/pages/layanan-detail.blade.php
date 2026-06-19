@extends('layouts.app')
@section('title', $layanan->nama)

@section('content')


{{-- ── HERO ── --}}
<section class="ld-hero">
    <div class="ld-hero-bg-pattern"></div>
    <div class="ld-hero-glow"></div>
        
    <div class="container position-relative">
    
        <div class="ld-hero-inner">

            {{-- Teks --}}
            <div class="ld-hero-text">
                <span class="ld-hero-badge">
                    <i class="fas fa-star-of-life"></i>
                    Layanan Unggulan
                </span>
                <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('layanan.index') }}">Layanan Unggulan</a></li>
                <li class="breadcrumb-item active">{{ $layanan->nama }}</li>
            </ol>
        </nav>
        <h1></h1>
                <h1 class="ld-hero-title">{{ $layanan->nama }}</h1>
            </div>

            {{-- Media --}}
            <div class="ld-hero-media">
                <div class="ld-hero-media-ring ld-hero-media-ring--outer"></div>
                <div class="ld-hero-media-ring ld-hero-media-ring--inner"></div>
                {{--  <div class="ld-hero-media-card">
                    @if($layanan->logo)
                        <img src="{{ asset('storage/'.$layanan->logo) }}"
                             alt="{{ $layanan->nama }}"
                             class="ld-hero-img">
                    @else
                        <div class="ld-hero-placeholder">
                            <i class="fas fa-stethoscope"></i>
                        </div>
                    @endif
                </div>--}}
            </div>

        </div>
    </div>
</section>

{{-- ── MAIN CONTENT ── --}}
<section class="ld-body sec">
    <div class="container">
        <div class="row g-5">

            {{-- ── KOLOM UTAMA ── --}}
            <div class="col-lg-8">

                {{-- Tentang Layanan --}}
                <div class="ld-card">
                    <div class="ld-card-header">
                        <span class="ld-card-icon"><i class="fas fa-info-circle"></i></span>
                        <h3 class="ld-card-title">Tentang Layanan</h3>
                    </div>
                    <div class="ld-richtext">
                        {!! $layanan->konten ?? '<p>'.$layanan->deskripsi.'</p>' !!}
                    </div>
                </div>

                {{-- Keunggulan --}}
                {{-- <div class="ld-card mt-4">
                    <div class="ld-card-header">
                        <span class="ld-card-icon ld-card-icon--accent"><i class="fas fa-medal"></i></span>
                        <h3 class="ld-card-title">Keunggulan Layanan</h3>
                    </div>
                    <div class="ld-features-grid">
                        <div class="ld-feature-item">
                            <div class="ld-feature-ic"><i class="fas fa-user-md"></i></div>
                            <div>
                                <h6 class="ld-feature-title">Dokter Spesialis Berpengalaman</h6>
                                <p class="ld-feature-desc">Ditangani langsung oleh dokter spesialis dengan rekam jejak yang terverifikasi.</p>
                            </div>
                        </div>
                        <div class="ld-feature-item">
                            <div class="ld-feature-ic"><i class="fas fa-microscope"></i></div>
                            <div>
                                <h6 class="ld-feature-title">Peralatan Medis Modern</h6>
                                <p class="ld-feature-desc">Menggunakan teknologi diagnostik terkini berstandar internasional.</p>
                            </div>
                        </div>
                        <div class="ld-feature-item">
                            <div class="ld-feature-ic"><i class="fas fa-bolt"></i></div>
                            <div>
                                <h6 class="ld-feature-title">Pelayanan Cepat & Profesional</h6>
                                <p class="ld-feature-desc">Sistem antrian digital yang efisien dan waktu tunggu minimal.</p>
                            </div>
                        </div>
                        <div class="ld-feature-item">
                            <div class="ld-feature-ic"><i class="fas fa-shield-alt"></i></div>
                            <div>
                                <h6 class="ld-feature-title">Standar Keselamatan Tinggi</h6>
                                <p class="ld-feature-desc">Prosedur keselamatan pasien sesuai akreditasi rumah sakit kelas A.</p>
                            </div>
                        </div>
                    </div>
                </div>--}}

                {{-- Prosedur / Alur Layanan --}}
                <div class="ld-card mt-4">
                    <div class="ld-card-header">
                        <span class="ld-card-icon ld-card-icon--green"><i class="fas fa-route"></i></span>
                        <h3 class="ld-card-title">Alur Mendapatkan Layanan</h3>
                    </div>
                    <div class="ld-steps">
                        <div class="ld-step">
                            <div class="ld-step-num">1</div>
                            <div class="ld-step-body">
                                <h6 class="ld-step-title">Daftar / Buat Janji</h6>
                                <p class="ld-step-desc">Daftar online melalui website, aplikasi, atau hubungi call center kami.</p>
                            </div>
                        </div>
                        <div class="ld-step">
                            <div class="ld-step-num">2</div>
                            <div class="ld-step-body">
                                <h6 class="ld-step-title">Konfirmasi & Administrasi</h6>
                                <p class="ld-step-desc">Tim kami menghubungi Anda untuk konfirmasi jadwal dan kelengkapan berkas.</p>
                            </div>
                        </div>
                        <div class="ld-step">
                            <div class="ld-step-num">3</div>
                            <div class="ld-step-body">
                                <h6 class="ld-step-title">Konsultasi & Pemeriksaan</h6>
                                <p class="ld-step-desc">Jalani konsultasi dan pemeriksaan bersama dokter spesialis kami.</p>
                            </div>
                        </div>
                        <div class="ld-step">
                            <div class="ld-step-num">4</div>
                            <div class="ld-step-body">
                                <h6 class="ld-step-title">Tindak Lanjut</h6>
                                <p class="ld-step-desc">Terima hasil dan rekomendasi pengobatan secara komprehensif.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- ── SIDEBAR ── --}}
            <div class="col-lg-4">
                <div class="ld-sidebar">

                    {{-- Buat Janji --}}
                    <div class="ld-card ld-sidebar-cta">
                        <div class="ld-sidebar-cta-badge">
                            <i class="fas fa-headset"></i> Siap Membantu 24 Jam
                        </div>
                        <h5 class="ld-sidebar-cta-title">Butuh Bantuan?</h5>
                        <p class="ld-sidebar-cta-desc">Tim kami siap melayani Anda kapan saja, termasuk hari libur.</p>

                        
                        <a href="https://wa.me/6281111121705" class="ld-sidebar-btn-wa" target="_blank">
                            <i class="fab fa-whatsapp"></i>
                            Chat via WhatsApp
                        </a>
                        <a href="{{ route('appointment') }}" class="ld-sidebar-btn-primary">
                            <i class="fas fa-calendar-check"></i>
                            Buat Appointment
                        </a>
                        <a href="tel:+62604250888" class="ld-sidebar-btn-tel">
                            <i class="fas fa-phone"></i>
                            0260-4250 888
                        </a>
                    </div>

                    {{-- Jam Operasional --}}
                    {{--<div class="ld-card mt-4">
                        <div class="ld-card-header">
                            <span class="ld-card-icon ld-card-icon--amber"><i class="fas fa-clock"></i></span>
                            <h5 class="ld-card-title">Jam Operasional</h5>
                        </div>
                        <ul class="ld-schedule-list">
                            <li class="ld-schedule-item">
                                <span class="ld-schedule-day">Senin – Jumat</span>
                                <span class="ld-schedule-time">07.00 – 21.00</span>
                            </li>
                            <li class="ld-schedule-item">
                                <span class="ld-schedule-day">Sabtu</span>
                                <span class="ld-schedule-time">07.00 – 17.00</span>
                            </li>
                            <li class="ld-schedule-item ld-schedule-item--closed">
                                <span class="ld-schedule-day">Minggu & Libur</span>
                                <span class="ld-schedule-time ld-schedule-badge">IGD 24 Jam</span>
                            </li>
                        </ul>
                    </div>--}}

                    {{-- BPJS / Asuransi --}}
                    <div class="ld-card ld-card-insurance mt-4">
                        <i class="fas fa-check-circle ld-insurance-icon"></i>
                        <div>
                            <h6 class="ld-insurance-title">Menerima BPJS & Asuransi</h6>
                            <p class="ld-insurance-desc">Layanan ini dapat diakses menggunakan Asuransi dan Umum dan berbagai asuransi rekanan.</p>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

{{-- ── LAYANAN TERKAIT ── --}}
@if(isset($related) && $related->count())
<section class="ld-related sec bg-light">
    <div class="container">
        <div class="sec-head">
            <div>
                <span class="eyebrow">Eksplorasi</span>
                <h3 class="sec-h2">Layanan Lainnya</h3>
            </div>
            <a href="{{ route('layanan.index') }}" class="btn-ol">
                Lihat Semua <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="row g-4">
            @foreach($related as $item)
            <div class="col-md-4">
                <a href="{{ route('layanan.show', $item->slug) }}" class="ld-related-card">
                    <div class="ld-related-ic">
                        @if($item->logo)
                            <img src="{{ asset('storage/'.$item->logo) }}" alt="{{ $item->nama }}">
                        @else
                            <i class="fas fa-hospital-alt"></i>
                        @endif
                    </div>
                    <div class="ld-related-body">
                        <h6 class="ld-related-title">{{ $item->nama }}</h6>
                        @if($item->deskripsi)
                        <p class="ld-related-desc">{{ Str::limit($item->deskripsi, 80) }}</p>
                        @endif
                    </div>
                    <span class="ld-related-arrow"><i class="fas fa-arrow-right"></i></span>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif


<style>


</style>

@endsection
