@extends('layouts.app')
@section('title', $artikel->judul)

@section('content')

{{-- ── PAGE HEADER ── --}}
<div class="page-header">
    <div class="container">
        <h1 class="page-title">Hamori Update</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('artikel.index') }}">Hamori Update</a></li>
                <li class="breadcrumb-item active">{{ Str::limit($artikel->judul, 40) }}</li>
            </ol>
        </nav>
    </div>
</div>

{{-- ── ARTICLE BODY ── --}}
<section class="as-section sec">
    <div class="container">
        <div class="row g-5 justify-content-center">

            {{-- ── MAIN ARTICLE ── --}}
            <div class="col-lg-8">
                <article class="as-article">

                    {{-- Category + Meta --}}
                    <div class="as-meta">
                        @if($artikel->kategori)
                        <a href="{{ route('artikel.kategori', $artikel->kategori->slug) }}" class="as-badge">
                            {{ $artikel->kategori->nama }}
                        </a>
                        @endif
                        <span class="as-meta-item">
                            <i class="fas fa-calendar-alt"></i>
                            {{ $artikel->published_at?->translatedFormat('d F Y') ?? '-' }}
                        </span>
                        @if($artikel->author ?? false)
                        <span class="as-meta-sep">·</span>
                        <span class="as-meta-item">
                            <i class="fas fa-user-md"></i>
                            {{ $artikel->author }}
                        </span>
                        @endif
                        @if($artikel->read_time ?? false)
                        <span class="as-meta-sep">·</span>
                        <span class="as-meta-item">
                            <i class="fas fa-clock"></i>
                            {{ $artikel->read_time }} menit baca
                        </span>
                        @endif
                    </div>

                    {{-- Title --}}
                    <h1 class="as-title">{{ $artikel->judul }}</h1>

                    {{-- Ringkasan --}}
                    @if($artikel->ringkasan)
                    <p class="as-lead">{{ $artikel->ringkasan }}</p>
                    @endif

                    {{-- Thumbnail --}}
                    @if($artikel->thumbnail)
                    <div class="as-thumb-wrap">
                        <a href="{{ asset('storage/' . $artikel->thumbnail) }}"
                           class="glightbox as-thumb-link">
                            <img src="{{ asset('storage/' . $artikel->thumbnail) }}"
                                 alt="{{ $artikel->judul }}"
                                 class="as-thumb"
                                 loading="eager">
                            <span class="as-thumb-overlay">
                                <i class="fas fa-expand-alt"></i>
                            </span>
                        </a>
                    </div>
                    @endif

                    {{-- Content --}}
                    <div class="as-content article-content">
                        {!! $artikel->konten !!}
                    </div>

                    {{-- Tags --}}
                    @if(isset($artikel->tags) && $artikel->tags->count())
                    <div class="as-tags">
                        <span class="as-tags-label"><i class="fas fa-tag"></i> Tag:</span>
                        @foreach($artikel->tags as $tag)
                        <a href="#" class="as-tag">{{ $tag->nama }}</a>
                        @endforeach
                    </div>
                    @endif

                    {{-- Share --}}
                    <div class="as-share">
                        <span class="as-share-label">Bagikan artikel ini:</span>
                        <div class="as-share-btns">
                            <a href="https://wa.me/?text={{ urlencode($artikel->judul . ' ' . request()->url()) }}"
                               target="_blank" class="as-share-btn as-share-btn--wa" title="WhatsApp">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                               target="_blank" class="as-share-btn as-share-btn--fb" title="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?text={{ urlencode($artikel->judul) }}&url={{ urlencode(request()->url()) }}"
                               target="_blank" class="as-share-btn as-share-btn--tw" title="Twitter/X">
                                <i class="fab fa-x-twitter"></i>
                            </a>
                            <button class="as-share-btn as-share-btn--copy"
                                    onclick="copyUrl(this)" title="Salin tautan">
                                <i class="fas fa-link"></i>
                            </button>
                        </div>
                    </div>

                    {{-- Author Card --}}
                    @if($artikel->author ?? false)
                    <div class="as-author-card">
                        <div class="as-author-avatar">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <div class="as-author-body">
                            <span class="as-author-label">Ditulis oleh</span>
                            <strong class="as-author-name">{{ $artikel->author }}</strong>
                            @if($artikel->author_bio ?? false)
                            <p class="as-author-bio">{{ $artikel->author_bio }}</p>
                            @endif
                        </div>
                    </div>
                    @endif

                </article>

                {{-- ── RELATED ARTICLES ── --}}
                @if(isset($related) && $related->count())
                <div class="as-related mt-5">
                    <div class="as-related-head">
                        <span class="eyebrow">Baca Juga</span>
                        <h4 class="as-related-title">Artikel Terkait</h4>
                    </div>
                    <div class="row g-4">
                        @foreach($related->take(3) as $rel)
                        <div class="col-md-4">
                            <a href="{{ route('artikel.show', [$rel->kategori?->slug ?? 'artikel', $rel->slug]) }}"
                               class="as-rel-card">
                                <div class="as-rel-thumb">
                                    @if($rel->thumbnail)
                                        <img src="{{ asset('storage/' . $rel->thumbnail) }}"
                                             alt="{{ $rel->judul }}" loading="lazy">
                                    @else
                                        <div class="as-rel-thumb-placeholder">
                                            <i class="fas fa-newspaper"></i>
                                        </div>
                                    @endif
                                    @if($rel->kategori)
                                    <span class="as-rel-badge">{{ $rel->kategori->nama }}</span>
                                    @endif
                                </div>
                                <div class="as-rel-body">
                                    <p class="as-rel-date">
                                        <i class="fas fa-calendar-alt"></i>
                                        {{ $rel->published_at?->translatedFormat('d M Y') ?? '-' }}
                                    </p>
                                    <h6 class="as-rel-title">{{ $rel->judul }}</h6>
                                    <span class="as-rel-more">
                                        Baca Selengkapnya
                                        <i class="fas fa-arrow-right"></i>
                                    </span>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

            </div>

            {{-- ── SIDEBAR ── --}}
            <div class="col-lg-4">
                <div class="as-sidebar">

                    {{-- CTA Konsultasi --}}
                    <div class="as-widget as-widget-cta">
                        <div class="as-cta-glow"></div>
                        <div class="as-cta-icon"><i class="fas fa-stethoscope"></i></div>
                        <h5 class="as-cta-title">Butuh Konsultasi Dokter?</h5>
                        <p class="as-cta-desc">Buat appointment dengan dokter spesialis kami dan dapatkan penanganan terbaik.</p>
                        <a href="https://wa.me/{{ \App\Models\SiteSetting::get('phone_whatsapp', '6281111121705') }}" target="_blank" class="as-cta-wa">
                            <i class="fab fa-whatsapp"></i> Chat via WhatsApp
                        </a>
                        <a href="#" class="as-cta-appt">
                            <i class="fas fa-calendar-check"></i> Buat Appointment
                        </a>
                    </div>

                    {{-- Artikel Terbaru --}}
                    <div class="as-widget mt-4">
                        <div class="as-widget-header">
                            <span class="as-widget-icon"><i class="fas fa-newspaper"></i></span>
                            <h5 class="as-widget-title">Artikel Terbaru</h5>
                        </div>
                        @if(isset($terbaru) && $terbaru->count())
                        <ul class="as-recent-list">
                            @foreach($terbaru->take(5) as $i => $rec)
                            <li class="as-recent-item">
                                <span class="as-recent-num">{{ str_pad($i+1, 2, '0', STR_PAD_LEFT) }}</span>
                                <div class="as-recent-body">
                                    <a href="{{ route('artikel.show', [$rec->kategori?->slug ?? 'artikel', $rec->slug]) }}"
                                       class="as-recent-title">{{ $rec->judul }}</a>
                                    <span class="as-recent-date">
                                        <i class="fas fa-calendar-alt"></i>
                                        {{ $rec->published_at?->translatedFormat('d M Y') ?? '-' }}
                                    </span>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        @else
                        <p class="text-muted" style="font-size:13px">Belum ada artikel lain.</p>
                        @endif
                        <a href="{{ route('artikel.index') }}" class="as-widget-link">
                            Lihat Semua Artikel <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>

                    {{-- Kategori --}}
                    @if(isset($kategoris) && $kategoris->count())
                    <div class="as-widget mt-4">
                        <div class="as-widget-header">
                            <span class="as-widget-icon as-widget-icon--accent"><i class="fas fa-tags"></i></span>
                            <h5 class="as-widget-title">Kategori</h5>
                        </div>
                        <ul class="as-cat-list">
                            @foreach($kategoris as $kat)
                            <li>
                                <a href="{{ route('artikel.kategori', $kat->slug) }}"
                                   class="as-cat-link {{ optional($artikel->kategori)->slug === $kat->slug ? 'as-cat-link--active' : '' }}">
                                    <span><i class="fas fa-circle-dot"></i> {{ $kat->nama }}</span>
                                    <span class="as-cat-count">{{ $kat->artikels_count }}</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
</section>

<script>
function copyUrl(btn) {
    navigator.clipboard.writeText(window.location.href).then(() => {
        const icon = btn.querySelector('i');
        icon.className = 'fas fa-check';
        btn.style.background = 'var(--green)';
        setTimeout(() => {
            icon.className = 'fas fa-link';
            btn.style.background = '';
        }, 2000);
    });
}
</script>




@endsection
