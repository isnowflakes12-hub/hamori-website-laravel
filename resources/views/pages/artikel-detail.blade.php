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
                        <a href="https://wa.me/6281111121705" target="_blank" class="as-cta-wa">
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


<style>

/* ── SECTION ── */
.as-section { background: var(--bg); }

/* ── ARTICLE ── */
.as-article {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 40px 44px;
    box-shadow: var(--shadow-sm);
}

/* Meta row */
.as-meta {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 16px;
}
.as-badge {
    display: inline-flex;
    align-items: center;
    background: var(--primary);
    color: #fff;
    font-size: 10px; font-weight: 800; letter-spacing: 1px;
    text-transform: uppercase;
    padding: 4px 14px; border-radius: 100px;
    text-decoration: none;
    transition: background .2s;
}
.as-badge:hover { background: var(--primary-dark); color: #fff; }
.as-meta-item {
    display: inline-flex; align-items: center; gap: 5px;
    font-size: 12.5px; color: var(--muted-2); font-weight: 600;
}
.as-meta-item i { font-size: 11px; color: var(--primary); }
.as-meta-sep { color: var(--border); font-size: 16px; line-height: 1; }

/* Title */
.as-title {
    font-family: 'Libre Baskerville', Georgia, serif;
    font-size: clamp(1.6rem, 3.5vw, 2.1rem);
    font-weight: 700;
    color: var(--ink);
    line-height: 1.3;
    margin: 0 0 16px;
}

/* Lead / ringkasan */
.as-lead {
    font-size: 16px;
    color: var(--muted);
    line-height: 1.8;
    border-left: 3px solid var(--primary);
    padding-left: 16px;
    margin-bottom: 28px;
    font-style: italic;
}

/* Thumbnail ── ukuran konsisten, proporsional */
.as-thumb-wrap {
    width: 100%;
    border-radius: var(--radius-md);
    overflow: hidden;
    margin-bottom: 32px;
    position: relative;
    box-shadow: var(--shadow-md);
}
.as-thumb-link { display: block; position: relative; }
.as-thumb {
    width: 100%;
    height: 400px;
    object-fit: cover;
    object-position: center top;
    display: block;
    transition: transform .45s var(--ease);
}
.as-thumb-link:hover .as-thumb { transform: scale(1.02); }
.as-thumb-overlay {
    position: absolute; inset: 0;
    background: rgba(41,37,98,.35);
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: 28px;
    opacity: 0;
    transition: opacity .3s;
}
.as-thumb-link:hover .as-thumb-overlay { opacity: 1; }

/* Article content */
.as-content { margin-bottom: 36px; }
.as-content.article-content {
    font-size: 15.5px;
    line-height: 1.85;
    color: var(--ink-2);
}
.as-content.article-content h2,
.as-content.article-content h3 {
    font-family: 'Libre Baskerville', Georgia, serif;
    color: var(--ink);
    margin-top: 32px; margin-bottom: 12px;
}
.as-content.article-content h2 { font-size: 1.4rem; }
.as-content.article-content h3 { font-size: 1.15rem; }
.as-content.article-content p  { margin-bottom: 16px; }
.as-content.article-content ul,
.as-content.article-content ol { padding-left: 22px; margin-bottom: 16px; }
.as-content.article-content li { margin-bottom: 8px; }
.as-content.article-content img {
    width: 100%; height: auto;
    border-radius: var(--radius-md);
    margin: 20px 0;
    box-shadow: var(--shadow-md);
}
.as-content.article-content blockquote {
    border-left: 3px solid var(--primary);
    padding: 12px 20px;
    background: var(--primary-light);
    border-radius: 0 var(--radius-sm) var(--radius-sm) 0;
    margin: 20px 0;
    color: var(--ink-2);
    font-style: italic;
}
.as-content.article-content a {
    color: var(--primary);
    text-decoration: underline;
    text-underline-offset: 3px;
}

/* Tags */
.as-tags {
    display: flex; align-items: center; flex-wrap: wrap;
    gap: 8px; margin-bottom: 28px;
}
.as-tags-label {
    font-size: 12px; font-weight: 700; color: var(--muted);
    display: flex; align-items: center; gap: 5px;
}
.as-tag {
    display: inline-block;
    background: var(--bg); border: 1.5px solid var(--border);
    color: var(--ink-2); font-size: 12px; font-weight: 600;
    padding: 4px 14px; border-radius: 100px;
    text-decoration: none;
    transition: border-color .2s, color .2s, background .2s;
}
.as-tag:hover { border-color: var(--primary); color: var(--primary); background: var(--primary-light); }

/* Share */
.as-share {
    display: flex; align-items: center; gap: 14px; flex-wrap: wrap;
    padding: 18px 0; border-top: 1px solid var(--border-2);
    border-bottom: 1px solid var(--border-2);
    margin-bottom: 28px;
}
.as-share-label { font-size: 13px; font-weight: 700; color: var(--muted); white-space: nowrap; }
.as-share-btns { display: flex; gap: 8px; }
.as-share-btn {
    width: 38px; height: 38px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 15px; color: #fff; cursor: pointer;
    text-decoration: none; border: none;
    transition: transform .2s, opacity .2s;
}
.as-share-btn:hover { transform: translateY(-2px); opacity: .9; }
.as-share-btn--wa   { background: #25d366; }
.as-share-btn--fb   { background: #1877f2; }
.as-share-btn--tw   { background: #000; }
.as-share-btn--copy { background: var(--accent); transition: background .2s, transform .2s; }

/* Author card */
.as-author-card {
    display: flex; align-items: center; gap: 16px;
    padding: 20px;
    background: var(--bg);
    border: 1px solid var(--border-2);
    border-radius: var(--radius-md);
}
.as-author-avatar {
    width: 52px; height: 52px; border-radius: 50%;
    background: var(--primary-light);
    color: var(--primary); font-size: 22px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.as-author-body { display: flex; flex-direction: column; gap: 2px; }
.as-author-label { font-size: 10px; font-weight: 700; letter-spacing: 1px;
    text-transform: uppercase; color: var(--muted); }
.as-author-name { font-size: 15px; font-weight: 700; color: var(--ink); }
.as-author-bio { font-size: 12.5px; color: var(--muted); margin: 4px 0 0; line-height: 1.6; }

/* ── RELATED ── */
.as-related-head { margin-bottom: 24px; }
.as-related-title {
    font-family: 'Libre Baskerville', Georgia, serif;
    font-size: 1.2rem; font-weight: 700; color: var(--ink); margin: 6px 0 0;
}

.as-rel-card {
    display: flex; flex-direction: column;
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-md);
    overflow: hidden;
    text-decoration: none; color: var(--ink);
    box-shadow: var(--shadow-xs);
    transition: transform .25s var(--ease), box-shadow .25s, border-color .25s;
    height: 100%;
}
.as-rel-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
    border-color: #a8e4e0;
    color: var(--ink);
}

/* Thumbnail ── tinggi konsisten */
.as-rel-thumb {
    width: 100%; height: 160px;
    position: relative; overflow: hidden;
    background: var(--bg-2); flex-shrink: 0;
}
.as-rel-thumb img {
    width: 100%; height: 100%;
    object-fit: cover; object-position: center top;
    display: block;
    transition: transform .4s var(--ease);
}
.as-rel-card:hover .as-rel-thumb img { transform: scale(1.06); }
.as-rel-thumb-placeholder {
    width: 100%; height: 100%;
    display: flex; align-items: center; justify-content: center;
    font-size: 2.2rem; color: var(--border);
}
.as-rel-badge {
    position: absolute; top: 10px; left: 10px;
    background: var(--primary); color: #fff;
    font-size: 9px; font-weight: 800; letter-spacing: 1px;
    text-transform: uppercase; padding: 3px 10px; border-radius: 100px;
}

.as-rel-body { padding: 16px 18px 18px; display: flex; flex-direction: column; flex: 1; gap: 6px; }
.as-rel-date {
    display: flex; align-items: center; gap: 5px;
    font-size: 11.5px; color: var(--muted-2); font-weight: 600;
}
.as-rel-date i { font-size: 10px; color: var(--primary); }
.as-rel-title {
    font-size: 13.5px; font-weight: 700; color: var(--ink);
    line-height: 1.45; margin: 0; flex: 1;
    transition: color .2s;
}
.as-rel-card:hover .as-rel-title { color: var(--primary); }
.as-rel-more {
    font-size: 12px; font-weight: 700; color: var(--primary);
    display: flex; align-items: center; gap: 5px;
    margin-top: auto;
}
.as-rel-more i { font-size: 11px; transition: transform .2s; }
.as-rel-card:hover .as-rel-more i { transform: translateX(3px); }

/* ── SIDEBAR ── */
.as-sidebar { position: sticky; top: 100px; }

/* Widget */
.as-widget {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 24px;
    box-shadow: var(--shadow-xs);
}
.as-widget-header {
    display: flex; align-items: center; gap: 10px;
    margin-bottom: 18px; padding-bottom: 14px;
    border-bottom: 1px solid var(--border-2);
}
.as-widget-icon {
    width: 36px; height: 36px; border-radius: var(--radius-sm);
    background: var(--primary-light); color: var(--primary);
    display: flex; align-items: center; justify-content: center;
    font-size: 15px; flex-shrink: 0;
}
.as-widget-icon--accent { background: var(--accent-light); color: var(--accent-mid); }
.as-widget-title {
    font-family: 'Libre Baskerville', Georgia, serif;
    font-size: 1rem; font-weight: 700; color: var(--ink); margin: 0;
}
.as-widget-link {
    display: flex; align-items: center; gap: 6px;
    font-size: 13px; font-weight: 700; color: var(--primary);
    text-decoration: none; margin-top: 16px;
    padding-top: 14px; border-top: 1px solid var(--border-2);
    transition: gap .2s;
}
.as-widget-link:hover { gap: 10px; color: var(--primary-dark); }

/* CTA widget */
.as-widget-cta {
    background: linear-gradient(145deg, var(--accent) 0%, var(--accent-mid) 55%, var(--primary) 100%);
    border: none; text-align: center; position: relative; overflow: hidden;
}
.as-cta-glow {
    position: absolute; top: -60px; left: 50%; transform: translateX(-50%);
    width: 200px; height: 200px;
    background: rgba(27,169,157,.2); border-radius: 50%;
    filter: blur(50px); pointer-events: none;
}
.as-cta-icon {
    width: 56px; height: 56px; border-radius: 50%;
    background: rgba(255,255,255,.12); border: 2px solid rgba(255,255,255,.2);
    color: #fff; font-size: 22px;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 14px; position: relative; z-index: 1;
}
.as-cta-title {
    font-family: 'Libre Baskerville', Georgia, serif;
    font-size: 1rem; font-weight: 700; color: #fff;
    margin-bottom: 8px; position: relative; z-index: 1;
}
.as-cta-desc {
    font-size: 13px; color: rgba(255,255,255,.65);
    line-height: 1.65; margin-bottom: 18px;
    position: relative; z-index: 1;
}
.as-cta-wa {
    display: flex; align-items: center; justify-content: center; gap: 8px;
    background: #25d366; color: #fff;
    font-size: 13.5px; font-weight: 700;
    padding: 12px 20px; border-radius: var(--radius-sm);
    text-decoration: none; margin-bottom: 10px;
    position: relative; z-index: 1;
    transition: background .2s, transform .15s;
}
.as-cta-wa:hover { background: #1ebe5d; color: #fff; transform: translateY(-1px); }
.as-cta-appt {
    display: flex; align-items: center; justify-content: center; gap: 8px;
    background: rgba(255,255,255,.12);
    border: 1.5px solid rgba(255,255,255,.2);
    color: rgba(255,255,255,.9);
    font-size: 13.5px; font-weight: 700;
    padding: 12px 20px; border-radius: var(--radius-sm);
    text-decoration: none;
    position: relative; z-index: 1;
    transition: background .2s;
}
.as-cta-appt:hover { background: rgba(255,255,255,.22); color: #fff; }

/* Recent list */
.as-recent-list { list-style: none; padding: 0; margin: 0; }
.as-recent-item {
    display: flex; align-items: flex-start; gap: 12px;
    padding: 10px 0; border-bottom: 1px solid var(--border-2);
}
.as-recent-item:last-child { border-bottom: none; padding-bottom: 0; }
.as-recent-num {
    font-family: 'Libre Baskerville', Georgia, serif;
    font-size: 1.1rem; font-weight: 700; color: var(--border);
    line-height: 1; flex-shrink: 0; min-width: 26px;
    transition: color .2s;
}
.as-recent-item:hover .as-recent-num { color: var(--primary); }
.as-recent-body { flex: 1; }
.as-recent-title {
    display: block; font-size: 13px; font-weight: 700;
    color: var(--ink); text-decoration: none;
    line-height: 1.45; margin-bottom: 4px;
    transition: color .2s;
}
.as-recent-title:hover { color: var(--primary); }
.as-recent-date {
    display: flex; align-items: center; gap: 4px;
    font-size: 11.5px; color: var(--muted-2);
}
.as-recent-date i { font-size: 10px; color: var(--primary); }

/* Category list */
.as-cat-list { list-style: none; padding: 0; margin: 0; }
.as-cat-list li + li { margin-top: 2px; }
.as-cat-link {
    display: flex; align-items: center; justify-content: space-between;
    padding: 9px 12px; border-radius: var(--radius-sm);
    font-size: 13.5px; font-weight: 600; color: var(--ink-2);
    text-decoration: none;
    transition: background .18s, color .18s, padding-left .18s;
}
.as-cat-link:hover { background: var(--primary-light); color: var(--primary-dark); padding-left: 16px; }
.as-cat-link--active { background: var(--primary-light); color: var(--primary-dark); }
.as-cat-link span:first-child { display: flex; align-items: center; gap: 8px; }
.as-cat-link i { font-size: 10px; color: var(--primary); }
.as-cat-count {
    background: var(--bg); color: var(--muted);
    font-size: 11px; font-weight: 700;
    padding: 2px 9px; border-radius: 100px;
    border: 1px solid var(--border-2); min-width: 26px; text-align: center;
}
.as-cat-link--active .as-cat-count,
.as-cat-link:hover .as-cat-count { background: var(--primary); color: #fff; border-color: var(--primary); }

/* ── RESPONSIVE ── */
@media (max-width: 992px) {
    .as-sidebar { position: static; }
}
@media (max-width: 768px) {
    .as-article { padding: 28px 24px; }
    .as-thumb { height: 280px; }
    .as-title { font-size: 1.5rem; }
}
@media (max-width: 576px) {
    .as-article { padding: 22px 18px; }
    .as-thumb { height: 220px; }
    .as-title { font-size: 1.3rem; }
    .as-share { flex-direction: column; align-items: flex-start; gap: 10px; }
    .as-rel-thumb { height: 140px; }
}

</style>

@endsection