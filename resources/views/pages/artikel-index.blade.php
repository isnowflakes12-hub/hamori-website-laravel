@extends('layouts.app')

@section('title', 'Hamori Update')

@section('content')

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

<section class="au-section sec">
    <div class="container">
        <div class="row g-5">

            <div class="col-lg-8">

                @if($artikels->isEmpty())
                <div class="au-empty">
                    <div class="au-empty-icon"><i class="fas fa-newspaper"></i></div>
                    <h4 class="au-empty-title">Belum Ada Artikel</h4>
                    <p class="au-empty-desc">Artikel untuk kategori ini belum tersedia. Coba kategori lainnya.</p>
                    <a href="{{ route('artikel.index') }}" class="ld-btn-primary mt-2">
                        <i class="fas fa-arrow-left"></i> Lihat Semua Artikel
                    </a>
                </div>

                @else 
                <div class="row g-4">
                    @foreach($artikels as $i => $artikel)
                    <div class="{{ $i === 0 ? 'col-12' : 'col-md-6' }}">
                        <article class="au-card {{ $i === 0 ? 'au-card--featured' : '' }} h-100">

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

                                @if($artikel->kategoris && $artikel->kategoris->count() > 0)
                                    <div style="position: absolute; top: 1rem; left: 1rem; z-index: 10; display: flex; flex-wrap: wrap; gap: 5px;">
                                    @foreach($artikel->kategoris as $kat)
                                        <span class="au-badge" style="position: relative; top: 0; left: 0;">{{ $kat->nama }}</span>
                                    @endforeach
                                    </div>
                                @endif

                                @if($artikel->published_at && $artikel->published_at->diffInDays(now()) <= 7)
                                <span class="au-featured-label">
                                    <i class="fas fa-bookmark"></i> Artikel Terbaru
                                </span>
                                @endif
                            </div>

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
                                    <a href="{{ route('artikel.show', [$artikel->kategoris->first()?->slug ?? 'artikel', $artikel->slug]) }}">
                                        {{ $artikel->judul }}
                                    </a>
                                </h5>

                                <p class="au-desc">
                                    {{ Str::limit($artikel->ringkasan, $i === 0 ? 160 : 110) }}
                                </p>

                                <div class="au-footer">
                                    @if($artikel->read_time ?? false)
                                    <span class="au-read-time">
                                        <i class="fas fa-clock"></i> {{ $artikel->read_time }} menit baca
                                    </span>
                                    @else
                                    <span></span> {{-- Empty span to push read-more to the right if no read-time --}}
                                    @endif

                                    <a href="{{ route('artikel.show', [$artikel->kategoris->first()?->slug ?? 'artikel', $artikel->slug]) }}"
                                       class="au-read-more">
                                        Selengkapnya
                                        <span class="au-read-more-arrow"><i class="fas fa-arrow-right"></i></span>
                                    </a>
                                </div>
                            </div>

                        </article>
                    </div>
                    @endforeach
                </div>

                @if($artikels->hasPages())
                <div class="au-pagination">
                    {{ $artikels->links() }}
                </div>
                @endif

                @endif
            </div>

            <div class="col-lg-4">
                <div class="au-sidebar">

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
                                    <a href="{{ route('artikel.show', [$pop->kategoris->first()?->slug ?? 'artikel', $pop->slug]) }}"
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


@endsection
