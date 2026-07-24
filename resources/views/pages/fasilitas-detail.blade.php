@extends('layouts.app')
@section('title', $fasilitas->nama . ' - Fasilitas')

@section('content')

<div class="page-header">
    <div class="container">
        <h1 class="page-title">{{ $fasilitas->nama }}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('fasilitas.index') }}">Fasilitas</a></li>
                <li class="breadcrumb-item active">{{ $fasilitas->nama }}</li>
            </ol>
        </nav>
    </div>
</div>

<section class="fd-section sec bg-light py-5">
    <div class="container">
        <div class="row g-5 align-items-start">
            
            <!-- Kolom Kiri: Gambar / Slider -->
            <div class="col-lg-5 mb-4 mb-lg-0">
                <div class="sticky-top" style="top: 100px;">
                    @if(!empty($fasilitas->galeri) && count($fasilitas->galeri) > 1)
                        <div id="fasilitasCarousel" class="carousel slide fd-main-slider shadow-sm rounded-4 overflow-hidden" data-bs-ride="carousel" style="border: 1px solid var(--border); height: auto; aspect-ratio: 4/3;">
                            <div class="carousel-indicators">
                                @foreach($fasilitas->galeri as $index => $img)
                                    <button type="button" data-bs-target="#fasilitasCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}" aria-current="{{ $index == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"></button>
                                @endforeach
                            </div>
                            <div class="carousel-inner h-100">
                                @foreach($fasilitas->galeri as $index => $img)
                                    <div class="carousel-item h-100 {{ $index == 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/'.$img) }}" class="d-block w-100 h-100" alt="{{ $fasilitas->nama }} - Foto {{ $index + 1 }}" style="object-fit: cover;">
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#fasilitasCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#fasilitasCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    @elseif($fasilitas->gambar)
                        <div class="fd-main-img-wrap shadow-sm rounded-4 overflow-hidden" style="border: 1px solid var(--border); aspect-ratio: 4/3;">
                            <img src="{{ asset('storage/'.$fasilitas->gambar) }}" alt="{{ $fasilitas->nama }}" class="w-100 h-100" style="object-fit: cover;">
                        </div>
                    @endif
                </div>
            </div>

            <!-- Kolom Kanan: Deskripsi & Konten -->
            <div class="col-lg-7">
                <div class="fd-content bg-white p-4 p-md-5 rounded-4 shadow-sm" style="border: 1px solid var(--border);">
                    
                    @if($fasilitas->deskripsi)
                    <div class="mb-5 pb-4" style="border-bottom: 1px dashed var(--border);">
                        <div class="d-flex align-items-start gap-3">
                            <i class="bi bi-quote fs-1" style="color: var(--primary); opacity: 0.3; margin-top: -10px;"></i>
                            <p class="mb-0 fw-medium" style="font-size: 1rem; color: var(--ink); line-height: 1.8;">
                                {{ $fasilitas->deskripsi }}
                            </p>
                        </div>
                    </div>
                    @endif

                    @if($fasilitas->konten)
                        <div class="fd-rich-text">
                            {!! $fasilitas->konten !!}
                        </div>
                    @else
                        @if(!$fasilitas->deskripsi)
                        <div class="text-center py-5 text-muted">
                            <i class="bi bi-info-circle fs-1 mb-3 text-secondary opacity-50"></i>
                            <p>Informasi detail fasilitas sedang dalam pembaruan.</p>
                        </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
/* ── FASILITAS HEADER (Senada Promo) ── */
.pm-intro {
    position: relative;
    padding: 60px 0 80px;
    background: #ffffff;
    overflow: hidden;
    border-bottom: 1px solid var(--border);
}
.pm-intro-glow {
    position: absolute;
    width: 600px;
    height: 600px;
    background: radial-gradient(circle, rgba(14,165,233,0.08) 0%, rgba(255,255,255,0) 70%);
    border-radius: 50%;
    z-index: 1;
    pointer-events: none;
}
.pm-intro-glow--left { top: -200px; left: -200px; }
.pm-intro-glow--right { bottom: -200px; right: -200px; }

.pm-intro-watermark {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 400px;
    height: 400px;
    opacity: 0.03;
    z-index: 1;
    pointer-events: none;
}
.pm-intro-watermark img { width: 100%; height: 100%; object-fit: contain; }

.pm-intro-inner {
    position: relative;
    z-index: 2;
}

/* ── FASILITAS SLIDER ── */
.fd-main-slider {
    height: 550px;
    background: #f8fafc;
}

/* ── FASILITAS DETAIL RICH TEXT ── */
.fd-rich-text {
    font-size: 16px;
    line-height: 1.9;
    color: var(--ink-2);
}
.fd-rich-text p {
    margin-bottom: 24px;
}
.fd-rich-text h2, .fd-rich-text h3, .fd-rich-text h4 {
    font-family: 'Libre Baskerville', Georgia, serif;
    font-weight: 700;
    color: var(--ink);
    margin-top: 40px;
    margin-bottom: 20px;
    position: relative;
    padding-left: 16px;
}
.fd-rich-text h2::before, .fd-rich-text h3::before {
    content: "";
    position: absolute;
    left: 0;
    top: 5px;
    bottom: 5px;
    width: 4px;
    background: var(--primary);
    border-radius: 4px;
}
.fd-rich-text ul {
    padding-left: 20px;
    margin-bottom: 24px;
}
.fd-rich-text li {
    margin-bottom: 10px;
}
.fd-rich-text img {
    max-width: 100%;
    height: auto;
    border-radius: 12px;
    margin: 20px 0;
}

@media (max-width: 768px) {
    .pm-intro { padding: 40px 0; }
    .fd-main-slider { height: 350px; }
    .fd-content { margin-top: -40px; padding: 24px !important; }
}
</style>
@endpush

@endsection

