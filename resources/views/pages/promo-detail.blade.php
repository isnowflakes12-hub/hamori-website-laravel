@extends('layouts.app')
@section('title', $promo->judul ?? $promo->nama)

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
                            Promo dan Penawaran Menarik
                        </span>
                        <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('promo.index') }}">Promo dan Penawaran</a></li>
                        <li class="breadcrumb-item active">{{ $promo->judul ?? $promo->nama }}</li>
                    </ol>
                </nav>
                <br>
                        <div class="ld-hero-header-flex">
            {{-- Judul --}}
            <h1 class="ld-hero-title">{{ $promo->judul ?? $promo->nama }}</h1>
            </div>

                <div class="ld-hero-stats">
                    <div class="id-hero-stat">
                    <a href="#" class="ld-btn-primary">
                        <i class="fas fa-calendar-check"></i>
                        Buat Janji Sekarang
                    </a>
                    </div>
                    <div class="ld-hero-stat">
                        <span class="ld-hero-stat-n">{{ $promo->diskon ?? 'Diskon Spesial' }}</span>
                        <span class="ld-hero-stat-l">Penawaran Terbaik</span>
                    </div>
                    <div class="ld-hero-stat-div"></div>
                    <div class="ld-hero-stat">
                        <span class="ld-hero-stat-n">24/7</span>
                        <span class="ld-hero-stat-l">Layanan Aktif</span>
                    </div>
                    <div class="ld-hero-stat-div"></div>
                    <div class="ld-hero-stat">
                        <span class="ld-hero-stat-n">100%</span>
                        <span class="ld-hero-stat-l">Profesional</span>
                    </div>
                    <div class="ld-hero-stat-div"></div>
                    <div class="ld-hero-stat">
                        <span class="ld-hero-stat-n">BPJS</span>
                        <span class="ld-hero-stat-l">Diterima</span>
                    </div>
                    
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
                <div class="pd-card mt-4">
                    <div class="pd-card-header">
                        <span class="pd-card-icon pd-card-icon--amber"><i class="fas fa-file-lines"></i></span>
                        <h3 class="pd-card-title">Syarat & Ketentuan</h3>
                    </div>
                    <ul class="pd-terms-list">
                        @if(isset($promo->syarat) && count($promo->syarat ?? []) > 0)
                            @foreach($promo->syarat as $s)
                            <li class="pd-terms-item">
                                <i class="fas fa-circle-dot"></i>
                                <span>{{ $s }}</span>
                            </li>
                            @endforeach
                        @else
                        <li class="pd-terms-item"><i class="fas fa-circle-dot"></i><span>Berlaku untuk pasien umum dan peserta asuransi rekanan.</span></li>
                        <li class="pd-terms-item"><i class="fas fa-circle-dot"></i><span>Promo tidak dapat digabungkan dengan penawaran lainnya.</span></li>
                        <li class="pd-terms-item"><i class="fas fa-circle-dot"></i><span>Pendaftaran wajib dilakukan sebelum masa berlaku berakhir.</span></li>
                        <li class="pd-terms-item"><i class="fas fa-circle-dot"></i><span>RS Hamori berhak mengubah ketentuan sewaktu-waktu.</span></li>
                        @endif
                    </ul>
                </div>

                {{-- Cara Mendapatkan --}}
                <div class="pd-card mt-4">
                    <div class="pd-card-header">
                        <span class="pd-card-icon pd-card-icon--green"><i class="fas fa-route"></i></span>
                        <h3 class="pd-card-title">Cara Mendapatkan Promo</h3>
                    </div>
                    <div class="pd-steps">
                        <div class="pd-step">
                            <div class="pd-step-num">1</div>
                            <div class="pd-step-body">
                                <h6 class="pd-step-title">Hubungi Kami</h6>
                                <p class="pd-step-desc">Chat via WhatsApp atau hubungi call center kami untuk informasi lebih lanjut.</p>
                            </div>
                        </div>
                        <div class="pd-step">
                            <div class="pd-step-num">2</div>
                            <div class="pd-step-body">
                                <h6 class="pd-step-title">Daftar & Konfirmasi</h6>
                                <p class="pd-step-desc">Sebutkan kode promo dan lengkapi administrasi pendaftaran.</p>
                            </div>
                        </div>
                        <div class="pd-step">
                            <div class="pd-step-num">3</div>
                            <div class="pd-step-body">
                                <h6 class="pd-step-title">Datang & Nikmati</h6>
                                <p class="pd-step-desc">Kunjungi RS Hamori sesuai jadwal dan dapatkan layanan terbaik.</p>
                            </div>
                        </div>
                    </div>
                </div>

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

                        <a href="{{ $promo->link_wa ?? 'https://wa.me/6281111121705' }}"
                           target="_blank" class="pd-sidebar-btn-wa">
                            <i class="fab fa-whatsapp"></i> Daftar via WhatsApp
                        </a>
                        <a href="#" class="pd-sidebar-btn-primary">
                            <i class="fas fa-calendar-check"></i> Buat Janji Sekarang
                        </a>
                        <a href="tel:+62211234567" class="pd-sidebar-btn-tel">
                            <i class="fas fa-phone"></i> 021-1234567
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

                    {{-- BPJS --}}
                    <div class="pd-card pd-card-insurance mt-4">
                        <i class="fas fa-check-circle pd-insurance-icon"></i>
                        <div>
                            <h6 class="pd-insurance-title">Menerima BPJS & Asuransi</h6>
                            <p class="pd-insurance-desc">Promo ini dapat dikombinasikan dengan berbagai asuransi rekanan RS Hamori.</p>
                        </div>
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


<style>

/* ── HERO ── */
.pd-hero {
    background: linear-gradient(135deg, var(--accent) 0%, var(--accent-mid) 45%, var(--primary) 100%);
    padding: 80px 0 72px;
    position: relative; overflow: hidden;
}
.pd-hero-bg-pattern {
    position: absolute; inset: 0;
    background-image:
        radial-gradient(circle at 15% 50%, rgba(27,169,157,.2) 0%, transparent 50%),
        radial-gradient(circle at 85% 20%, rgba(255,255,255,.04) 0%, transparent 40%);
    pointer-events: none;
}
.pd-hero-glow {
    position: absolute; bottom: -80px; right: -80px;
    width: 360px; height: 360px;
    background: rgba(27,169,157,.15);
    border-radius: 50%; filter: blur(80px); pointer-events: none;
}

.pd-hero-inner {
    display: flex; align-items: center; gap: 56px;
}

/* Badges */
.pd-hero-badges { display: flex; align-items: center; gap: 8px; flex-wrap: wrap; margin-bottom: 18px; }
.pd-hero-badge {
    display: inline-flex; align-items: center; gap: 5px;
    background: rgba(255,255,255,.12);
    border: 1px solid rgba(255,255,255,.2);
    color: rgba(255,255,255,.9);
    font-size: 11px; font-weight: 700; letter-spacing: 1px;
    text-transform: uppercase;
    padding: 5px 13px; border-radius: 100px;
}
.pd-hero-badge i { font-size: 10px; color: var(--primary-mid); }
.pd-hero-badge--star i { color: var(--amber); }
.pd-hero-badge--disc {
    background: var(--red); border-color: var(--red); color: #fff;
    animation: discPulse 2.5s ease infinite;
}

/* Title & sub */
.pd-hero-title {
    font-family: 'Libre Baskerville', Georgia, serif;
    font-size: clamp(1.9rem, 4vw, 3rem);
    font-weight: 700; color: #fff; line-height: 1.15; margin: 0 0 16px;
    text-shadow: 0 2px 24px rgba(0,0,0,.2);
}
.pd-hero-sub {
    font-size: 15.5px; color: rgba(255,255,255,.78);
    line-height: 1.75; margin: 0 0 20px; max-width: 520px;
}

/* Price */
.pd-hero-price {
    display: flex; align-items: baseline; gap: 12px;
    margin-bottom: 16px; flex-wrap: wrap;
}
.pd-price-old {
    font-size: 14px; color: rgba(255,255,255,.45); text-decoration: line-through;
}
.pd-price-new {
    font-family: 'Libre Baskerville', Georgia, serif;
    font-size: 2rem; font-weight: 700; color: #fff; line-height: 1;
}

/* Expire */
.pd-hero-expire {
    display: inline-flex; align-items: center; gap: 7px;
    background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.15);
    color: rgba(255,255,255,.8); font-size: 13px;
    padding: 7px 14px; border-radius: 100px; margin-bottom: 28px;
}
.pd-hero-expire i { color: var(--amber); }

/* CTA */
.pd-hero-cta { display: flex; gap: 12px; flex-wrap: wrap; }
.pd-btn-wa {
    display: inline-flex; align-items: center; gap: 8px;
    background: #25d366; color: #fff;
    font-size: 14px; font-weight: 700;
    padding: 13px 26px; border-radius: 50px;
    text-decoration: none;
    transition: background .2s, transform .2s;
    box-shadow: 0 4px 16px rgba(37,211,102,.35);
}
.pd-btn-wa:hover { background: #1ebe5d; color: #fff; transform: translateY(-2px); }
.pd-btn-ghost {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(255,255,255,.1); color: #fff;
    font-size: 14px; font-weight: 700;
    padding: 13px 26px; border-radius: 50px;
    border: 1.5px solid rgba(255,255,255,.25);
    text-decoration: none; backdrop-filter: blur(6px);
    transition: background .2s, border-color .2s, transform .2s;
}
.pd-btn-ghost:hover {
    background: rgba(255,255,255,.2); border-color: rgba(255,255,255,.4);
    color: #fff; transform: translateY(-2px);
}

/* ── BODY ── */
.pd-body { background: var(--bg); }

/* Image in Body (About Section) */
.pd-body-image-wrapper {
    width: 100%;
    overflow: hidden;
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-md);
    margin-bottom: 24px;
}
.pd-body-image {
    width: 100%;
    height: auto;
    display: block;
    object-fit: cover;
    object-position: center;
}

/* Card base */
.pd-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 28px 32px;
    box-shadow: var(--shadow-sm);
    transition: box-shadow .25s;
}
.pd-card:hover { box-shadow: var(--shadow-md); }

.pd-card-header {
    display: flex; align-items: center; gap: 12px;
    margin-bottom: 22px; padding-bottom: 18px;
    border-bottom: 1px solid var(--border-2);
}
.pd-card-icon {
    width: 40px; height: 40px; border-radius: var(--radius-sm);
    background: var(--primary-light); color: var(--primary);
    display: flex; align-items: center; justify-content: center;
    font-size: 17px; flex-shrink: 0;
}
.pd-card-icon--accent { background: var(--accent-light); color: var(--accent-mid); }
.pd-card-icon--green  { background: #f0fff4; color: var(--green); }
.pd-card-icon--amber  { background: #fffbeb; color: var(--amber); }

.pd-card-title {
    font-family: 'Libre Baskerville', Georgia, serif;
    font-size: 1.1rem; font-weight: 700; color: var(--ink); margin: 0; line-height: 1.3;
}

/* Richtext */
.pd-richtext p { color: var(--ink-2); font-size: 15px; line-height: 1.8; margin-bottom: 14px; }
.pd-richtext p:last-child { margin-bottom: 0; }
.pd-richtext ul { padding-left: 20px; }
.pd-richtext li { color: var(--ink-2); font-size: 15px; line-height: 1.8; margin-bottom: 6px; }

/* Benefit grid */
.pd-benefit-grid {
    display: grid; grid-template-columns: 1fr 1fr; gap: 12px;
}
.pd-benefit-item {
    display: flex; align-items: center; gap: 10px;
    padding: 12px 16px;
    background: var(--bg); border-radius: var(--radius-sm);
    border: 1px solid var(--border-2);
    font-size: 13.5px; color: var(--ink-2); font-weight: 600;
    transition: border-color .2s, background .2s;
}
.pd-benefit-item:hover { border-color: #a8e4e0; background: var(--primary-light); }
.pd-benefit-ic {
    color: var(--primary); font-size: 17px; flex-shrink: 0;
}

/* Terms list */
.pd-terms-list { list-style: none; padding: 0; margin: 0; }
.pd-terms-item {
    display: flex; align-items: flex-start; gap: 10px;
    padding: 10px 0; border-bottom: 1px solid var(--border-2);
    font-size: 14px; color: var(--ink-2); line-height: 1.65;
}
.pd-terms-item:last-child { border-bottom: none; padding-bottom: 0; }
.pd-terms-item i { color: var(--primary); font-size: 11px; flex-shrink: 0; margin-top: 5px; }

/* Steps */
.pd-steps { display: flex; flex-direction: column; gap: 0; position: relative; }
.pd-steps::before {
    content: ''; position: absolute;
    top: 20px; bottom: 20px; left: 19px;
    width: 2px;
    background: linear-gradient(to bottom, var(--primary), rgba(27,169,157,.15));
    z-index: 0;
}
.pd-step {
    display: flex; align-items: flex-start; gap: 18px;
    padding: 0 0 24px; position: relative; z-index: 1;
}
.pd-step:last-child { padding-bottom: 0; }
.pd-step-num {
    width: 40px; height: 40px; border-radius: 50%;
    background: var(--primary); color: #fff;
    font-size: 15px; font-weight: 800;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; box-shadow: 0 0 0 4px var(--primary-light);
}
.pd-step-title {
    font-size: 14px; font-weight: 700; color: var(--ink);
    margin: 0 0 4px; line-height: 1.3; padding-top: 9px;
}
.pd-step-desc { font-size: 13px; color: var(--muted); line-height: 1.65; margin: 0; }

/* ── SIDEBAR ── */
.pd-sidebar { position: sticky; top: 100px; }

.pd-sidebar-cta {
    background: linear-gradient(145deg, var(--accent) 0%, var(--accent-mid) 60%, var(--primary) 100%);
    border: none; padding: 28px;
}
.pd-sidebar-cta-badge {
    display: inline-flex; align-items: center; gap: 6px;
    font-size: 10px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase;
    color: rgba(255,255,255,.7); background: rgba(255,255,255,.1);
    padding: 4px 12px; border-radius: 100px; margin-bottom: 12px;
}
.pd-sidebar-cta-title {
    font-family: 'Libre Baskerville', Georgia, serif;
    font-size: 1.1rem; font-weight: 700; color: #fff; margin: 0 0 8px;
}
.pd-sidebar-cta-desc { font-size: 13px; color: rgba(255,255,255,.6); margin-bottom: 18px; line-height: 1.6; }

/* Sidebar price */
.pd-sidebar-price {
    display: flex; align-items: baseline; gap: 10px; flex-wrap: wrap;
    margin-bottom: 20px;
}
.pd-sidebar-price-old { font-size: 13px; color: rgba(255,255,255,.4); text-decoration: line-through; }
.pd-sidebar-price-new {
    font-family: 'Libre Baskerville', Georgia, serif;
    font-size: 1.7rem; font-weight: 700; color: #fff; line-height: 1;
}

.pd-sidebar-btn-wa {
    display: flex; align-items: center; justify-content: center; gap: 8px;
    background: #25d366; color: #fff; font-size: 14px; font-weight: 700;
    padding: 13px 20px; border-radius: var(--radius-sm);
    text-decoration: none; margin-bottom: 10px;
    transition: background .2s, transform .15s;
}
.pd-sidebar-btn-wa:hover { background: #1ebe5d; color: #fff; transform: translateY(-1px); }

.pd-sidebar-btn-primary {
    display: flex; align-items: center; justify-content: center; gap: 8px;
    background: rgba(255,255,255,.12); border: 1.5px solid rgba(255,255,255,.2);
    color: rgba(255,255,255,.9); font-size: 14px; font-weight: 700;
    padding: 12px 20px; border-radius: var(--radius-sm);
    text-decoration: none; margin-bottom: 10px; transition: background .2s;
}
.pd-sidebar-btn-primary:hover { background: rgba(255,255,255,.22); color: #fff; }

.pd-sidebar-btn-tel {
    display: flex; align-items: center; justify-content: center; gap: 8px;
    background: rgba(0,0,0,.15); border: 1px solid rgba(255,255,255,.1);
    color: rgba(255,255,255,.65); font-size: 14px; font-weight: 700;
    padding: 11px 20px; border-radius: var(--radius-sm);
    text-decoration: none; transition: background .2s, color .2s;
}
.pd-sidebar-btn-tel:hover { background: rgba(0,0,0,.25); color: rgba(255,255,255,.9); }

/* Expire widget */
.pd-expire-wrap { display: flex; align-items: center; gap: 16px; }
.pd-expire-date {
    font-family: 'Libre Baskerville', Georgia, serif;
    font-size: 2.4rem; font-weight: 700; color: var(--primary);
    line-height: 1; flex-shrink: 0; text-align: center;
}
.pd-expire-date span { display: block; font-size: 13px; font-weight: 700; color: var(--muted); margin-top: 4px; }
.pd-expire-note {
    font-size: 12.5px; color: var(--muted); line-height: 1.6; margin: 0;
    display: flex; align-items: flex-start; gap: 6px;
}
.pd-expire-note i { color: var(--amber); flex-shrink: 0; margin-top: 2px; }

/* Insurance */
.pd-card-insurance {
    display: flex; align-items: flex-start; gap: 14px;
    background: var(--primary-light); border-color: #a8e4e0;
}
.pd-insurance-icon { font-size: 24px; color: var(--primary); flex-shrink: 0; margin-top: 2px; }
.pd-insurance-title { font-size: 14px; font-weight: 700; color: var(--ink); margin: 0 0 4px; }
.pd-insurance-desc  { font-size: 12.5px; color: var(--muted); margin: 0; line-height: 1.6; }

/* ── RELATED ── */
.pd-related-card {
    display: flex; flex-direction: column;
    background: var(--white); border: 1px solid var(--border);
    border-radius: var(--radius-md); overflow: hidden;
    text-decoration: none; color: var(--ink);
    box-shadow: var(--shadow-xs);
    transition: transform .25s var(--ease), box-shadow .25s, border-color .25s;
    position: relative;
}
.pd-related-card::before {
    content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 3px;
    background: linear-gradient(90deg, var(--primary), var(--primary-mid));
    transform: scaleX(0); transition: transform .3s var(--ease);
}
.pd-related-card:hover {
    transform: translateY(-5px); box-shadow: var(--shadow-lg);
    border-color: #a8e4e0; color: var(--ink);
}
.pd-related-card:hover::before { transform: scaleX(1); }

/* Gambar related ── tinggi konsisten */
.pd-related-media {
    width: 100%; height: 160px;
    position: relative; overflow: hidden;
    background: var(--primary-light); flex-shrink: 0;
}
.pd-related-media img {
    width: 100%; height: 100%;
    object-fit: cover; object-position: center;
    display: block; transition: transform .4s var(--ease);
}
.pd-related-card:hover .pd-related-media img { transform: scale(1.06); }
.pd-related-placeholder {
    width: 100%; height: 100%;
    display: flex; align-items: center; justify-content: center;
    font-size: 2.5rem; color: rgba(27,169,157,.3);
}
.pd-related-disc {
    position: absolute; top: 10px; right: 10px;
    background: var(--red); color: #fff;
    font-size: 10px; font-weight: 800; padding: 3px 10px; border-radius: 100px;
}

.pd-related-body {
    padding: 16px 18px 18px;
    display: flex; flex-direction: column; gap: 6px;
}
.pd-related-title {
    font-size: 14px; font-weight: 700; color: var(--ink);
    margin: 0; line-height: 1.4; transition: color .2s;
}
.pd-related-card:hover .pd-related-title { color: var(--primary-dark); }
.pd-related-price {
    font-family: 'Libre Baskerville', Georgia, serif;
    font-size: 1.05rem; font-weight: 700; color: var(--primary);
}
.pd-related-more {
    font-size: 12px; font-weight: 700; color: var(--primary);
    display: flex; align-items: center; gap: 5px; margin-top: 4px;
}
.pd-related-more i { font-size: 11px; transition: transform .2s; }
.pd-related-card:hover .pd-related-more i { transform: translateX(3px); }

/* ── RESPONSIVE ── */
@media (max-width: 992px) {
    .pd-sidebar { position: static; }
    /* .pd-hero-media { display: none; } - Tidak diperlukan karena hero media dikomentari */
    .pd-hero-inner { display: block; }
}
@media (max-width: 768px) {
    .pd-hero { padding: 56px 0 48px; }
    .pd-hero-title { font-size: 1.85rem; }
    .pd-benefit-grid { grid-template-columns: 1fr; }
    .pd-card { padding: 22px 20px; }
    .pd-sidebar-cta { padding: 22px 20px; }
    .pd-body-image-wrapper { border-radius: var(--radius-md); } /* Sedikit kurangi radius pada mobile */
}
@media (max-width: 576px) {
    .pd-hero-cta { flex-direction: column; }
    .pd-btn-wa, .pd-btn-ghost { justify-content: center; }
    .pd-hero-badges { gap: 6px; }
}

</style>

@endsection