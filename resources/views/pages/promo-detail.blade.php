@extends('layouts.app')
@section('title', $promo->judul ?? $promo->nama)

@section('content')

{{-- ── HERO ── --}}
<section class="ld-hero ld-hero--compact">
    <div class="ld-hero-bg-pattern"></div>
    <div class="ld-hero-glow"></div>
    <div class="container position-relative">
        <div class="ld-hero-inner">
            {{-- Teks --}}
            <div class="ld-hero-text">
                <span class="ld-hero-badge">
                    <i class="fas fa-star-of-life"></i>
                    Promo dan Penawaran Menarik
                </span>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('promo.index') }}" class="text-white-50 text-decoration-none">Promo dan Penawaran</a></li>
                        <li class="breadcrumb-item active text-white">{{ $promo->judul ?? $promo->nama }}</li>
                    </ol>
                </nav>
                <br>
                <div class="ld-hero-header-flex">
                    <h1 class="ld-hero-title">{{ $promo->judul ?? $promo->nama }}</h1>
                </div>

            </div>

            {{-- Media --}}
            <div class="ld-hero-media">
                <div class="ld-hero-media-ring ld-hero-media-ring--outer"></div>
                <div class="ld-hero-media-ring ld-hero-media-ring--inner"></div>
            </div>
        </div>
    </div>
</section>     
                

{{-- ── MAIN CONTENT ── --}}
<section class="pd-body sec">
    <div class="container">
        <div class="row g-5">

            {{-- ── KOLOM UTAMA ── --}}
            <div class="col-lg-8">

                {{-- Tentang Promo --}}
                <div class="pd-card">
                    <div class="pd-card-header">
                        <span class="pd-card-icon"><i class="fas fa-info-circle"></i></span>
                        <h3 class="pd-card-title">Tentang Promo</h3>
                    </div>

                    {{-- Menampilkan gambar promo di sini --}}
                    @if($promo->gambar)
                    <div class="pd-body-image-wrapper">
                        <img src="{{ asset('storage/'.$promo->gambar) }}"
                             alt="{{ $promo->judul ?? $promo->nama }}" loading="lazy"
                             class="pd-body-image">
                    </div>
                    @endif

                    <div class="pd-richtext mt-4">
                        {!! $promo->konten ?? '<p>'.$promo->deskripsi.'</p>' !!}
                    </div>
                </div>

                {{-- Benefit --}}
                @if(isset($promo->benefit) && count($promo->benefit) > 0)
                <div class="pd-card mt-4">
                    <div class="pd-card-header">
                        <span class="pd-card-icon pd-card-icon--accent"><i class="fas fa-medal"></i></span>
                        <h3 class="pd-card-title">Yang Anda Dapatkan</h3>
                    </div>
                    <div class="pd-benefit-grid">
                        @foreach($promo->benefit as $b)
                        <div class="pd-benefit-item">
                            <div class="pd-benefit-ic"><i class="fas fa-circle-check"></i></div>
                            <span>{{ $b }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Syarat & Ketentuan --}}
                @if($promo->syarat_ketentuan)
                <div class="pd-card mt-4">
                    <div class="pd-card-header">
                        <span class="pd-card-icon pd-card-icon--amber"><i class="fas fa-file-lines"></i></span>
                        <h3 class="pd-card-title">Syarat & Ketentuan</h3>
                    </div>
                    <div class="pd-richtext" style="white-space:pre-line;font-size:14px;line-height:1.8">
                        {{ $promo->syarat_ketentuan }}
                    </div>
                </div>
                @endif

                {{-- Cara Mendapatkan --}}
                @if($promo->cara_mendapatkan && count($promo->cara_mendapatkan) > 0)
                <div class="pd-card mt-4">
                    <div class="pd-card-header">
                        <span class="pd-card-icon pd-card-icon--green"><i class="fas fa-route"></i></span>
                        <h3 class="pd-card-title">Cara Mendapatkan Promo</h3>
                    </div>
                    <div class="pd-steps">
                        @foreach($promo->cara_mendapatkan as $i => $step)
                        <div class="pd-step">
                            <div class="pd-step-num">{{ $i + 1 }}</div>
                            <div class="pd-step-body">
                                <p class="pd-step-desc mb-0">{{ $step }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            {{-- ── SIDEBAR ── --}}
            <div class="col-lg-4">
                <div class="pd-sidebar">

                    {{-- Daftar Promo --}}
                    <div class="pd-card pd-sidebar-cta">
                        <div class="pd-sidebar-cta-badge">
                            <i class="fas fa-headset"></i> Siap Membantu 24 Jam
                        </div>
                        <h5 class="pd-sidebar-cta-title">Tertarik dengan Promo Ini?</h5>
                        <p class="pd-sidebar-cta-desc">Daftar sekarang sebelum masa promo berakhir. Tim kami siap memandu proses pendaftaran.</p>

                        @if(($promo->harga_promo ?? false) || ($promo->harga_normal ?? false))
                        <div class="pd-sidebar-price">
                            @if($promo->harga_normal ?? false)
                            <span class="pd-sidebar-price-old">{{ $promo->harga_normal }}</span>
                            @endif
                            @if($promo->harga_promo ?? false)
                            <span class="pd-sidebar-price-new">{{ $promo->harga_promo }}</span>
                            @endif
                        </div>
                        @endif

                        <a href="{{ $promo->link_wa ?? 'https://wa.me/'.(\App\Models\SiteSetting::get('phone_whatsapp', '6281111121705')) }}"
                           target="_blank" class="pd-sidebar-btn-wa">
                            <i class="fab fa-whatsapp"></i> Chat via WhatsApp
                        </a>
                        <a href="#" class="pd-sidebar-btn-primary">
                            <i class="fas fa-calendar-check"></i> Buat Janji Sekarang
                        </a>
                        <a href="tel:{{ \App\Models\SiteSetting::get('phone_call_center', '1500816') }}" class="pd-sidebar-btn-tel">
                            <i class="fas fa-phone"></i> {{ \App\Models\SiteSetting::get('phone_call_center', '1500816') }}
                        </a>
                    </div>

                    {{-- Masa Berlaku --}}
                    @if($promo->berlaku_sampai ?? false)
                    <div class="pd-card mt-4">
                        <div class="pd-card-header">
                            <span class="pd-card-icon pd-card-icon--amber"><i class="fas fa-clock"></i></span>
                            <h5 class="pd-card-title">Masa Berlaku</h5>
                        </div>
                        <div class="pd-expire-wrap">
                            <div class="pd-expire-date">
                                {{ $promo->berlaku_sampai->format('d') }}
                                <span>{{ $promo->berlaku_sampai->format('M Y') }}</span>
                            </div>
                            <p class="pd-expire-note">
                                <i class="fas fa-triangle-exclamation"></i>
                                Segera manfaatkan promo ini sebelum berakhir.
                            </p>
                        </div>
                    </div>
                    @endif

                    {{-- BPJS Info --}}
                    <div class="pd-card mt-4" style="border:1.5px solid {{ $promo->terima_bpjs ? '#00a859' : '#e5eaf0' }}">
                        <div class="pd-card-header">
                            <span class="pd-card-icon" style="background:{{ $promo->terima_bpjs ? '#f0fdf4' : '#f8fafc' }}"><i class="fas fa-shield-halved" style="color:{{ $promo->terima_bpjs ? '#00a859' : '#94a3b8' }}"></i></span>
                            <h5 class="pd-card-title">Status BPJS</h5>
                        </div>
                        @if($promo->terima_bpjs)
                        <div class="d-flex align-items-center gap-2 p-2 rounded-3" style="background:#f0fdf4">
                            <i class="fas fa-circle-check" style="color:#00a859;font-size:18px"></i>
                            <div>
                                <div class="fw-bold" style="color:#00a859;font-size:14px">Menerima BPJS Kesehatan</div>
                                <div style="font-size:12px;color:#64748b">Promo ini dapat digunakan peserta BPJS</div>
                            </div>
                        </div>
                        @else
                        <div class="d-flex align-items-center gap-2 p-2 rounded-3" style="background:#f8fafc">
                            <i class="fas fa-circle-xmark" style="color:#94a3b8;font-size:18px"></i>
                            <div>
                                <div class="fw-semibold" style="color:#64748b;font-size:14px">Khusus Pasien Umum</div>
                                <div style="font-size:12px;color:#94a3b8">Tidak berlaku untuk peserta BPJS</div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ── PROMO TERKAIT ── --}}
@if(isset($related) && $related->count())
<section class="pd-related sec bg-light">
    <div class="container">
        <div class="sec-head">
            <div>
                <span class="eyebrow">Penawaran Lainnya</span>
                <h3 class="sec-h2">Promo Lainnya</h3>
            </div>
            <a href="{{ route('promo.index') }}" class="btn-ol">
                Lihat Semua <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="row g-4">
            @foreach($related as $item)
            <div class="col-md-4">
                <a href="{{ route('pages.promo-detail', $item->id) }}" class="pd-related-card">
                    
                    {{-- Gambar terkait ── ukuran konsisten --}}
                    <div class="pd-related-media">
                        @if($item->gambar)
                            <img src="{{ asset('storage/'.$item->gambar) }}"
                                 alt="{{ $item->judul ?? $item->nama }}" loading="lazy">
                        @else
                            <div class="pd-related-placeholder">
                                <i class="fas fa-gift"></i>
                            </div>
                        @endif
                        @if($item->diskon ?? false)
                        <span class="pd-related-disc">{{ $item->diskon }}</span>
                        @endif
                    </div>
                    
                    <div class="pd-related-body">
                        <h6 class="pd-related-title">{{ $item->judul ?? $item->nama }}</h6>
                        @if($item->harga_promo ?? false)
                        <span class="pd-related-price">{{ $item->harga_promo }}</span>
                        @endif
                        <span class="pd-related-more">
                            Lihat Detail <i class="fas fa-arrow-right"></i>
                        </span>
                    </div>

                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif




@endsection
