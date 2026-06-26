@extends('layouts.app')

@section('title', 'Hamori Update')

@section('content')

{{-- ── PAGE HEADER ── --}}
<div class="page-header">
    <div class="container">
        <h1 class="page-title">Hamori Update</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Hamori Update</li>
            </ol>
        </nav>
    </div>
</div>

{{-- ── MAIN CONTENT ── --}}
<section class="au-section sec">
    <div class="container">
        <div class="row g-5">

            {{-- ── KOLOM ARTIKEL ── --}}
            <div class="col-lg-8">

                {{-- Category Tabs --}}
                <div class="au-tabs">
                    <a href="{{ route('artikel.index') }}"
                       class="au-tab {{ !request('kategori') && !request()->routeIs('artikel.kategori') ? 'au-tab--active' : '' }}">
                        <i class="fas fa-border-all"></i>
                        Semua
                    </a>
                    @foreach($kategoris as $kat)
                    <a href="{{ route('artikel.kategori', $kat->slug) }}"
                       class="au-tab {{ request()->is('*/'.$kat->slug) ? 'au-tab--active' : '' }}">
                        {{ $kat->nama }}
                        @if($kat->artikels_count)
                        <span class="au-tab-count">{{ $kat->artikels_count }}</span>
                        @endif
                    </a>
                    @endforeach
                </div>

                {{-- Empty State --}}
                @if($artikels->isEmpty())
                <div class="au-empty">
                    <div class="au-empty-icon"><i class="fas fa-newspaper"></i></div>
                    <h4 class="au-empty-title">Belum Ada Artikel</h4>
                    <p class="au-empty-desc">Artikel untuk kategori ini belum tersedia. Coba kategori lainnya.</p>
                    <a href="{{ route('artikel.index') }}" class="ld-btn-primary mt-2">
                        <i class="fas fa-arrow-left"></i> Lihat Semua Artikel
                    </a>
                </div>

                {{-- Article Grid --}}
                @else 
                <div class="row g-4">
                    @foreach($artikels as $i => $artikel)
                    <div class="{{ $i === 0 ? 'col-12' : 'col-md-6' }}">
                        <article class="au-card {{ $i === 0 ? 'au-card--featured' : '' }} h-100">

                            {{-- Thumbnail --}}
                            <div class="au-thumb">
                                @if($artikel->thumbnail)
                                    <img src="{{ asset('storage/' . $artikel->thumbnail) }}"
                                         alt="{{ $artikel->judul }}"
                                         loading="{{ $i === 0 ? 'eager' : 'lazy' }}">
                                @else
                                    <div class="au-thumb-placeholder">
                                        <i class="fas fa-newspaper"></i>
                                    </div>
                                @endif

                                @if($artikel->kategori)
                                <span class="au-badge">{{ $artikel->kategori->nama }}</span>
                                @endif

                                @if($i === 0)
                                <span class="au-featured-label">
                                    <i class="fas fa-bookmark"></i> Artikel Terbaru
                                </span>
                                @endif
                            </div>

                            {{-- Body --}}
                            <div class="au-body">
                                <div class="au-meta">
                                    <span class="au-meta-date">
                                        <i class="fas fa-calendar-alt"></i>
                                        {{ $artikel->published_at?->translatedFormat('d F Y') ?? '-' }}
                                    </span>
                                    @if($artikel->author ?? false)
                                    <span class="au-meta-sep">·</span>
                                    <span class="au-meta-author">
                                        <i class="fas fa-user-md"></i>
                                        {{ $artikel->author }}
                                    </span>
                                    @endif
                                </div>

                                <h5 class="au-title {{ $i === 0 ? 'au-title--lg' : '' }}">
                                    <a href="{{ route('artikel.show', [$artikel->kategori?->slug ?? 'artikel', $artikel->slug]) }}">
                                        {{ $artikel->judul }}
                                    </a>
                                </h5>

                                <p class="au-desc">
                                    {{ Str::limit($artikel->ringkasan, $i === 0 ? 160 : 110) }}
                                </p>

                                <div class="au-footer">
                                    <a href="{{ route('artikel.show', [$artikel->kategori?->slug ?? 'artikel', $artikel->slug]) }}"
                                       class="au-read-more">
                                        Selengkapnya
                                        <span class="au-read-more-arrow"><i class="fas fa-arrow-right"></i></span>
                                    </a>

                                    @if($artikel->read_time ?? false)
                                    <span class="au-read-time">
                                        <i class="fas fa-clock"></i> {{ $artikel->read_time }} menit baca
                                    </span>
                                    @endif
                                </div>
                            </div>

                        </article>
                    </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                @if($artikels->hasPages())
                <div class="au-pagination">
                    {{ $artikels->links() }}
                </div>
                @endif

                @endif
            </div>

            {{-- ── SIDEBAR ── --}}
            <div class="col-lg-4">
                <div class="au-sidebar">

                    {{-- Search --}}
                    <div class="au-widget">
                        <div class="au-widget-header">
                            <span class="au-widget-icon"><i class="fas fa-search"></i></span>
                            <h5 class="au-widget-title">Cari Artikel</h5>
                        </div>
                        <form action="{{ route('artikel.index') }}" method="GET">
                            @if(request('kategori'))
                                <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                            @endif
                            <div class="au-search-wrap">
                                <input type="text" name="search" class="au-search-input"
                                       placeholder="Kata kunci artikel..."
                                       value="{{ request('search') }}">
                                <button type="submit" class="au-search-btn">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- Kategori --}}
                    <div class="au-widget mt-4">
                        <div class="au-widget-header">
                            <span class="au-widget-icon au-widget-icon--accent"><i class="fas fa-tags"></i></span>
                            <h5 class="au-widget-title">Kategori</h5>
                        </div>
                        <ul class="au-cat-list">
                            <li class="au-cat-item">
                                <a href="{{ route('artikel.index') }}"
                                   class="au-cat-link {{ !request()->routeIs('artikel.kategori') ? 'au-cat-link--active' : '' }}">
                                    <span class="au-cat-name">
                                        <i class="fas fa-border-all"></i> Semua Artikel
                                    </span>
                                    <span class="au-cat-count">{{ $artikels->total() ?? 0 }}</span>
                                </a>
                            </li>
                            @foreach($kategoris as $kat)
                            <li class="au-cat-item">
                                <a href="{{ route('artikel.kategori', $kat->slug) }}"
                                   class="au-cat-link {{ request()->is('*/'.$kat->slug) ? 'au-cat-link--active' : '' }}">
                                    <span class="au-cat-name">
                                        <i class="fas fa-circle-dot"></i> {{ $kat->nama }}
                                    </span>
                                    <span class="au-cat-count">{{ $kat->artikels_count }}</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- Artikel Populer --}}
                    @if(isset($populer) && $populer->count())
                    <div class="au-widget mt-4">
                        <div class="au-widget-header">
                            <span class="au-widget-icon au-widget-icon--amber"><i class="fas fa-fire"></i></span>
                            <h5 class="au-widget-title">Artikel Populer</h5>
                        </div>
                        <ul class="au-popular-list">
                            @foreach($populer->take(4) as $i => $pop)
                            <li class="au-popular-item">
                                <span class="au-popular-num">{{ str_pad($i+1, 2, '0', STR_PAD_LEFT) }}</span>
                                <div class="au-popular-body">
                                    <a href="{{ route('artikel.show', [$pop->kategori?->slug ?? 'artikel', $pop->slug]) }}"
                                       class="au-popular-title">{{ $pop->judul }}</a>
                                    <span class="au-popular-date">
                                        {{ $pop->published_at?->diffForHumans() ?? '-' }}
                                    </span>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    {{-- Appointment CTA --}}
                    <div class="au-widget au-widget-cta mt-4">
                        <div class="au-cta-glow"></div>
                        <div class="au-cta-icon-wrap">
                            <i class="fas fa-stethoscope"></i>
                        </div>
                        <h5 class="au-cta-title">Butuh Konsultasi Dokter?</h5>
                        <p class="au-cta-desc">Buat appointment dengan dokter spesialis kami sekarang dan dapatkan penanganan terbaik.</p>
                        <a href="https://wa.me/{{ \App\Models\SiteSetting::get('phone_whatsapp', '6281111121705') }}" target="_blank" class="au-cta-wa">
                            <i class="fab fa-whatsapp"></i>
                            Chat via WhatsApp
                        </a>
                        <a href="{{ route('appointment') }}" class="au-cta-appt">
                            <i class="fas fa-calendar-check"></i>
                            Buat Appointment
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>


{{-- ================================================================
     STYLES — scoped, inheriting design system tokens
     ================================================================ --}}


@endsection
