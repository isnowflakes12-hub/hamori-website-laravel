@extends('layouts.app')
@section('title', 'PORTAL')

@section('content')
@php
$heroSlides = $banners->count() ? $banners : collect([
    (object)['gambar'=>null,'judul'=>'Pelayanan Kesehatan Terbaik untuk Keluarga Anda','link'=>null,'color'=>'linear-gradient(135deg,#001f4d,#0055a5)'],
    (object)['gambar'=>null,'judul'=>'Pusat Layanan Jantung & Pembuluh Darah','link'=>null,'color'=>'linear-gradient(135deg,#0d1b2a,#1b4f72)'],
    (object)['gambar'=>null,'judul'=>'IGD & Ambulans Siap 24 Jam','link'=>null,'color'=>'linear-gradient(135deg,#1a0a00,#c0392b)'],
    (object)['gambar'=>null,'judul'=>'Medical Check Up Komprehensif','link'=>null,'color'=>'linear-gradient(135deg,#0a1f0a,#00a859)'],
]);
@endphp


{{-- â•â•â• HERO + PROMO SEJAJAR â•â•â• --}}
<div class="hero-promo-wrap">

    {{-- Carousel kiri --}}
    <div id="hero">
        @foreach($heroSlides as $i => $slide)
        <div class="hs{{ $i===0?' on':'' }}">
            @if(!empty($slide->gambar))
                <img src="{{ asset('storage/'.$slide->gambar) }}" alt="{{ $slide->judul ?? '' }}" loading="{{ $i===0?'eager':'lazy' }}">
            @else
                <div class="hs-grad" style="background:{{ $slide->color ?? 'linear-gradient(135deg,#001f4d,#0055a5)' }}"></div>
            @endif
            <div class="hs-ov"></div>
            <div class="hs-body">
                <div class="hs-body-inner">
                    @if(!empty($slide->judul))
                    <h1 class="hs-title">{{ $slide->judul }}</h1>
                    @endif
                    
                </div>
            </div>
        </div>
        @endforeach
        <button class="hc-arr" id="hcPrev"><i class="bi bi-chevron-left"></i></button>
        <button class="hc-arr" id="hcNext"><i class="bi bi-chevron-right"></i></button>
        <div class="hc-dots">
            @foreach($heroSlides as $i => $s)
            <span class="hc-dot{{ $i===0?' on':'' }}" data-i="{{ $i }}"></span>
            @endforeach
        </div>
        <div class="hc-bar"><div id="hcFill"></div></div>
    </div>

    {{-- Promo panel kanan â€” ambil urutan ke-1 dari DB --}}
    <div class="hero-promo-panel">
    @php
        try {
            $p = \App\Models\Promo::getHomeFeatured();
        } catch(\Exception $e) {
            $p = null;
        }
    @endphp

    @if($p)
        <div class="hpp-top">
            <span class="hpp-label">âš¡ Penawaran Terbatas</span>
            <h3 class="hpp-title">{{ $p->judul }}</h3>
        </div>
        @if($p->gambar)
        <div style="border-radius:12px;overflow:hidden;margin-bottom:14px;max-height:100%">
            <img src="{{ asset('storage/'.$p->gambar) }}" alt="{{ $p->judul }}"
                style="width:100%;height:100%">
        </div>
        @endif
        @if($p->benefit && count($p->benefit) > 0)
        <ul class="hpp-list">
            @foreach(array_slice($p->benefit,0,4) as $b)
            <li><i class="bi bi-check2-circle"></i> {{ $b }}</li>
            @endforeach
        </ul>
        @endif
        @if($p->harga_promo)
        <div class="hpp-price">
            @if($p->harga_normal)<span class="hpp-old">{{ $p->harga_normal }}</span>@endif
            <div class="hpp-new-wrap">
                <span class="hpp-new">{{ $p->harga_promo }}</span>
                @if($p->diskon)<span class="hpp-disc">{{ $p->diskon }}</span>@endif
            </div>
        </div>
        @endif
        @if($p->berlaku_sampai)
        <div class="hpp-timer">
            <i class="bi bi-clock"></i>
            <span>Berakhir: {{ $p->berlaku_sampai->format('d M Y') }}</span>
        </div>
        @endif
        <div class="hpp-actions">
            <a href="{{ $p->link_wa ?? 'https://wa.me/6281111121705' }}" target="_blank" class="hpp-btn-wa">
                <i class="bi bi-whatsapp"></i> Daftar
            </a>
            <a href="{{ route('pages.promo-detail', $p->id) }}" class="pca-detail">
                Detail <i class="bi bi-arrow-right"></i>
            </a>
        </div>
        <div class="hpp-footer">
            <i class="bi bi-shield-check"></i>
            <span>Promo terbatas, segera daftar!</span>
        </div>
    @else
        <ul class="hpp-list">
            <h3 class="hpp-title">Mohon Maaf<br> Saat ini Belum tersedia Promo</h3>
        </ul>
    @endif
    </div>
</div>

{{-- â•â•â• QUICK ACTION BAR â•â•â• --}}
<div class="qbar">
    <div class="qbar-inner">
        <a href="{{ route('dokter.index') }}" class="qa"><div class="qa-ic"><i class="bi bi-person-badge-fill"></i></div><span>Cari Dokter</span></a>
        <a href="{{ route('appointment') }}" class="qa"><div class="qa-ic"><i class="bi bi-calendar2-check-fill"></i></div><span>Appointment</span></a>
        <a href="tel:1500816" class="qa"><div class="qa-ic"><i class="bi bi-telephone-fill"></i></div><span>Telepon 24 Jam</span></a>
        <a href="{{ route('tempat-tidur') }}" class="qa"><div class="qa-ic"><i class="bi bi-hospital-fill"></i></div><span>Tempat Tidur</span></a>
        <a href="{{ route('paket-kesehatan') }}" class="qa"><div class="qa-ic"><i class="bi bi-heart-pulse-fill"></i></div><span>Paket Sehat</span></a>
        <a href="{{ route('layanan.index') }}" class="qa"><div class="qa-ic"><i class="bi bi-award-fill"></i></div><span>Layanan</span></a>
        
    </div>
</div>

{{-- â•â•â• LAYANAN UNGGULAN â•â•â• --}}
<section class="sec" style="background:#fff">
    <div class="sec-cont">
        <div class="sec-head">
            <div>
                <span class="eyebrow">Temukan Layanan</span>
                <h2 class="sec-h2">Layanan Unggulan</h2>
                <p class="sec-sub">RS Hamori menghadirkan pusat layanan terpadu yang siap memenuhi kebutuhan kesehatan Anda dan keluarga.</p>
            </div>
            <a href="{{ route('layanan.index') }}" class="btn-ol">Lihat Semua <i class="bi bi-arrow-right ms-1"></i></a>
        </div>

        <div class="lay-grid">
            @if(isset($layananUnggulan) && $layananUnggulan->count())
                @foreach($layananUnggulan->take(6) as $l)
                <div class="lc">
                    <div class="lc-thumb">
                        <div class="lc-ic">
                            @if($l->logo)
                                <img src="{{ asset('storage/'.$l->logo) }}" alt="{{ $l->nama }}">
                            @else
                                <i class="bi bi-hospital"></i>
                            @endif
                        </div>
                    </div>
                    <div class="lc-body">
                        <h5 class="lc-name">{{ $l->nama }}</h5>
                        <p class="lc-desc">{{ Str::limit(strip_tags($l->deskripsi_singkat ?? $l->deskripsi ?? ''), 70) }}</p>
                        <div class="lc-footer">
                            <a href="{{ route('layanan.show', $l->slug ?? $l->id) }}" class="lc-more">
                                Selengkapnya
                                <span class="lc-more-arrow"><i class="bi bi-arrow-right"></i></span>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                @foreach([
                    ['bi-heart-pulse-fill', 'Kardiologi',      'Jantung & pembuluh darah komprehensif'],
                    ['bi-gender-female',    'Kebidanan',        'Perawatan ibu hamil dan bersalin'],
                    ['bi-activity',         'Neurologi',        'Penanganan gangguan saraf dan otak'],
                    ['bi-person-standing',  'Ortopedi',         'Bedah tulang, sendi dan otot modern'],
                    ['bi-eye',              'Mata',             'Pemeriksaan dan operasi mata terkini'],
                    ['bi-lungs',            'Paru',             'Diagnosis & terapi penyakit paru'],
                    ['bi-capsule',          'Onkologi',         'Penanganan kanker multidisiplin'],
                    ['bi-clipboard2-pulse', 'Medical Check Up', 'Deteksi dini paket pemeriksaan lengkap'],
                ] as $l)
                <div class="lc">
                    <div class="lc-thumb">
                        @if($l->logo)
                            <img src="{{ asset('storage/'.$l->logo) }}" alt="{{ $l->nama }}">
                        @else
                            <div class="lc-ic">
                                <i class="bi bi-hospital"></i>
                            </div>
                        @endif
                    </div>
                    <div class="lc-body">
                        <h5 class="lc-name">{{ $l[1] }}</h5>
                        <p class="lc-desc">{{ $l[2] }}</p>
                        <div class="lc-footer">
                            <span class="lc-more">
                                Selengkapnya
                                <span class="lc-more-arrow"><i class="bi bi-arrow-right"></i></span>
                            </span>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</section>



{{-- â•â•â• STATS â•â•â• --}}
<div class="stats-sec">
    <div class="stats-grid">
        <div class="st"><span class="st-n">32<sup>+</sup></span><span class="st-l">Dokter Spesialis</span></div>
        <div class="st"><span class="st-n">100<sup>+</sup></span><span class="st-l">Tempat Tidur</span></div>
        <div class="st"><span class="st-n">24/7</span><span class="st-l">Layanan IGD</span></div>
        <div class="st"><span class="st-n">10K<sup>+</sup></span><span class="st-l">Pasien per Tahun</span></div>
    </div>
</div>


{{-- â•â•â• PROMO AKTIF â•â•â• --}}
@if(isset($promoAktif) && $promoAktif->count())
<section class="sec" style="background:#f8fafc">
    <div class="sec-cont">
        <div class="sec-head">
            <div>
                <span class="eyebrow">Penawaran Spesial</span>
                <h2 class="sec-h2">Promo & Paket Kesehatan</h2>
                <p class="sec-sub">Dapatkan layanan kesehatan terbaik dengan harga spesial untuk Anda dan keluarga.</p>
            </div>
            <a href="{{ route('promo.index') }}" class="btn-ol">Lihat Semua <i class="bi bi-arrow-right ms-1"></i></a>
        </div>
        <div class="row g-4">
            @foreach($promoAktif->take(3) as $p)
            <div class="col-md-6 col-lg-4 pm-item-col" data-promo-item>
                <div class="pm-card-clean">
                    <div class="pm-card-clean-img">
                        @if($p->gambar)
                            <img src="{{ asset('storage/'.$p->gambar) }}" alt="{{ $p->judul }}" loading="lazy">
                        @else
                            <div class="pm-media-placeholder"><i class="fas fa-gift"></i></div>
                        @endif
                        @if($p->is_featured)
                        <span class="pm-card-featured"><i class="fas fa-star"></i> Unggulan</span>
                        @endif
                    </div>
                    <div class="pm-card-clean-body">
                        <h5 class="pm-card-clean-title" data-promo-text>{{ $p->judul }}</h5>
                        
                        <div class="pm-card-clean-meta">
                            @if($p->berlaku_sampai)
                            <span class="pm-card-expire"><i class="fas fa-clock"></i> Hingga {{ $p->berlaku_sampai->format('d M Y') }}</span>
                            @endif
                        </div>

                        @if($p->deskripsi)
                        <p class="pm-card-clean-desc" data-promo-text>{{ Str::limit($p->deskripsi, 80) }}</p>
                        @endif

                        <div class="pm-card-clean-footer">
                            <a href="{{ route('pages.promo-detail', $p->id) }}" class="pm-btn-outline">
                                Lihat detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- â•â•â• ARTIKEL â•â•â• --}}
<section class="sec" style="background:#f8fafc">
    <div class="sec-cont"> 
        <div class="sec-head">
            <div>
                <span class="eyebrow">Edukasi Kesehatan</span>
                <h2 class="sec-h2">Artikel Terbaru</h2>
            </div>
            <a href="{{ route('artikel.index') }}" class="btn-ol">Lihat Semua <i class="bi bi-arrow-right ms-1"></i></a>
        </div>
        <div class="art-grid">
            @if(isset($artikelTerbaru) && $artikelTerbaru->count())
                @foreach($artikelTerbaru->take(6) as $idx => $art)
                @php $artUrl = route('artikel.show', [$art->kategori->slug ?? 'umum', $art->slug]); @endphp
                <div class="ac{{ $idx===0?' feat':'' }}">
                    <div class="ac-thumb">
                        @if($art->thumbnail)
                            <img src="{{ asset('storage/'.$art->thumbnail) }}" alt="{{ $art->judul }}" loading="lazy">
                        @else
                            <div style="background:linear-gradient(135deg,#0055a5,#0077cc);width:100%;height:100%"></div>
                        @endif
                    </div>
                    <div class="ac-body">
                        @if($art->kategori)<span class="ac-cat">{{ $art->kategori->nama }}</span>@endif
                        <h4 class="ac-title">{{ $art->judul }}</h4>
                        <p class="ac-exc">{{ Str::limit(strip_tags($art->konten ?? ''), 90) }}</p>
                        <div class="ac-foot">
                            <span><i class="bi bi-calendar3 me-1"></i>{{ optional($art->published_at)->format('d M Y') }}</span>
                            <a href="{{ $artUrl }}" class="ac-more">Baca <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                @foreach([['Kardiologi','Tips Menjaga Kesehatan Jantung di Usia Muda','10 Mar 2025'],['Umum','Pentingnya Medical Check Up Rutin Setiap Tahun','05 Mar 2025'],['Neurologi','Mengenal Gejala Stroke dan Cara Penanganannya','01 Mar 2025']] as $idx => $art)
                <div class="ac{{ $idx===0?' feat':'' }}">
                    <div class="ac-thumb"><div style="background:linear-gradient(135deg,#0055a5,#0077cc);width:100%;height:100%"></div></div>
                    <div class="ac-body">
                        <span class="ac-cat">{{ $art[0] }}</span>
                        <h4 class="ac-title">{{ $art[1] }}</h4>
                        <div class="ac-foot">
                            <span><i class="bi bi-calendar3 me-1"></i>{{ $art[2] }}</span>
                            <span class="ac-more">Baca <i class="bi bi-arrow-right"></i></span>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</section>



{{-- â•â•â• KRITIK & SARAN TERPILIH â•â•â• --}}
@if(isset($kritikSaranFeatured) && $kritikSaranFeatured->count())
<section class="sec ks-section">
    <div class="sec-cont">
        <div class="sec-head">
            <div>
                <span class="eyebrow" style="color:#1ba99e;background:rgba(27,169,158,0.1)">Suara Pasien</span>
                <h2 class="sec-h2">Kritik & Saran Membangun</h2>
                <p class="sec-sub">Kritik dan saran dari Anda adalah pendorong utama kami untuk terus meningkatkan kualitas pelayanan RS Hamori.</p>
            </div>
            <a href="{{ route('kritik-saran') }}" class="btn-ol" style="border-color:#1ba99e;color:#1ba99e">Tulis Masukan <i class="bi bi-pencil-square ms-1"></i></a>
        </div>

        {{-- CAROUSEL / SLIDER WRAPPER --}}
        <div class="ks-carousel-wrap">
            {{-- Prev button (desktop only) --}}
            <button class="ks-nav ks-nav--prev" id="ksPrev" aria-label="Sebelumnya">
                <i class="bi bi-chevron-left"></i>
            </button>

            {{-- Track --}}
            <div class="ks-track-outer" id="ksOuter">
                <div class="ks-track" id="ksTrack">
                    @foreach($kritikSaranFeatured as $ks)
                    <div class="ks-slide">
                        <div class="ks-card">
                            {{-- Header: avatar + rating --}}
                            <div class="ks-card-head">
                                <div class="ks-avatar">{{ strtoupper(substr($ks->nama, 0, 1)) }}</div>
                                <div class="ks-meta">
                                    <div class="ks-name">{{ $ks->nama }}</div>
                                    <div class="ks-date">{{ $ks->created_at->format('d M Y') }}</div>
                                </div>
                                @if($ks->rating)
                                <div class="ks-stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $ks->rating)
                                            <i class="fas fa-star" style="color:#f59e0b;font-size:13px"></i>
                                        @else
                                            <i class="far fa-star" style="color:#e2e8f0;font-size:13px"></i>
                                        @endif
                                    @endfor
                                </div>
                                @endif
                            </div>
                            {{-- Kategori --}}
                            <div class="ks-kategori">{{ $ks->kategori }}</div>
                            {{-- Pesan --}}
                            <p class="ks-pesan">&ldquo;{{ Str::limit($ks->pesan, 160) }}&rdquo;</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Next button (desktop only) --}}
            <button class="ks-nav ks-nav--next" id="ksNext" aria-label="Berikutnya">
                <i class="bi bi-chevron-right"></i>
            </button>
        </div>

        {{-- Dots --}}
        <div class="ks-dots" id="ksDots"></div>

    </div>
</section>
@endif




{{-- â•â•â• APP DOWNLOAD â•â•â• --}}
<div class="app-sec">
    <div class="app-card">
        <div class="app-inner">
            <div class="app-txt">
                
                <span class="eyebrow" style="color:rgba(255,255,255,.65)">Aplikasi Mobile</span>
                <h3 class="app-h">Ingin lebih dekat dengan<br>RS Hamori?</h3>
                <p class="app-d">Download aplikasi sekarang! dan nikmati kemudahan layanan dalam satu aplikasi</p>
                <div class="app-btns">
                    <a href="#" class="app-btn"><i class="bi bi-apple"></i><div><small>Download di</small><strong>App Store</strong></div></a>
                    <a href="https://play.google.com/store/apps/details?id=com.terakorp.hamori&hl=id" class="app-btn"><i class="bi bi-google-play"></i><div><small>Download di</small><strong>Google Play</strong></div></a>
                </div>
            </div>
            <div class="app-ph"><img src="{{ asset('assets/images/qr.png') }}" alt="RS Hamori" class="app-logo"></div>
        </div>
    </div>
</div>


    {{-- Floating Promo Button --}}
    <button class="promo-float-btn" id="promoFloatBtn" title="Lihat Promo Spesial">
        <div class="promo-float-pulse"></div>
        <div class="promo-float-inner">
            <i class="bi bi-gift-fill promo-float-icon"></i>
            <span class="promo-float-label">PROMO</span>
        </div>
        <div class="promo-float-badge">!</div>
    </button>



@include('pages.popup-promo-detail')

@endsection

@push('scripts')
<script>
(function(){
    var slides = document.querySelectorAll('.hs');
    var dots   = document.querySelectorAll('.hc-dot');
    var fill   = document.getElementById('hcFill');
    var DUR    = 6000;
    var cur    = 0;
    var timer  = null;
    var paused = false;
    if(!slides.length) return;

    function show(n){
        n = ((n % slides.length) + slides.length) % slides.length;
        slides[cur].classList.remove('on');
        dots[cur].classList.remove('on');
        cur = n;
        slides[cur].classList.add('on');
        dots[cur].classList.add('on');
        resetBar();
    }
    function resetBar(){
        if(!fill) return;
        fill.style.transition = 'none';
        fill.style.width = '0%';
        setTimeout(function(){ fill.style.transition='width '+DUR+'ms linear'; fill.style.width='100%'; }, 30);
    }
    function startAuto(){ clearInterval(timer); timer=setInterval(function(){ if(!paused) show(cur+1); }, DUR); }

    document.getElementById('hcPrev').onclick = function(){ show(cur-1); startAuto(); };
    document.getElementById('hcNext').onclick = function(){ show(cur+1); startAuto(); };
    dots.forEach(function(d,i){ d.onclick=function(){ show(i); startAuto(); }; });

    var hero = document.getElementById('hero');
    hero.onmouseenter = function(){ paused=true; };
    hero.onmouseleave = function(){ paused=false; };
    var tx=0;
    hero.addEventListener('touchstart',function(e){tx=e.touches[0].clientX;},{passive:true});
    hero.addEventListener('touchend',function(e){ var dx=e.changedTouches[0].clientX-tx; if(Math.abs(dx)>50){show(cur+(dx<0?1:-1));startAuto();} });

    resetBar(); startAuto();
})();
</script>




{{-- AUTO SHOW POPUP --}}
<script>
document.addEventListener("DOMContentLoaded", function () {

    const overlay = document.getElementById('promoOverlay');
    const closeBtn = document.getElementById('promoClose');
    const dontShow = document.getElementById('promoDontShow');

    if(localStorage.getItem('hidePromoToday') === new Date().toDateString()) { return; }
    setTimeout(() => { if (overlay) overlay.classList.add('show'); }, 1200);
    if(closeBtn){
        closeBtn.addEventListener('click', function(){
            overlay.classList.remove('show');
            if(dontShow && dontShow.checked) localStorage.setItem('hidePromoToday', new Date().toDateString());
        });
    }
    if(overlay){
        overlay.addEventListener('click', function(e){
            if(e.target === overlay) overlay.classList.remove('show');
        });
    }
});
</script>

{{-- KRITIK SARAN CAROUSEL --}}
<script>
(function() {
    const track   = document.getElementById('ksTrack');
    const outer   = document.getElementById('ksOuter');
    const btnPrev = document.getElementById('ksPrev');
    const btnNext = document.getElementById('ksNext');
    const dotsEl  = document.getElementById('ksDots');
    if (!track || !outer) return;

    const slides = track.querySelectorAll('.ks-slide');
    const total  = slides.length;
    if (total === 0) return;

    let VISIBLE  = getVisible();
    let cur      = 0;
    let autoTimer;
    let touchStartX = 0;

    // â”€â”€ Build dots â”€â”€
    function buildDots() {
        dotsEl.innerHTML = '';
        const pages = Math.ceil(total / VISIBLE);
        for (let i = 0; i < pages; i++) {
            const d = document.createElement('button');
            d.className = 'ks-dot' + (i === 0 ? ' ks-dot--active' : '');
            d.addEventListener('click', () => { goTo(i * VISIBLE); resetAuto(); });
            dotsEl.appendChild(d);
        }
    }

    function updateDots() {
        dotsEl.querySelectorAll('.ks-dot').forEach((d, i) => {
            d.classList.toggle('ks-dot--active', i === Math.round(cur / VISIBLE));
        });
    }

    function getVisible() {
        return window.innerWidth >= 992 ? 3 : (window.innerWidth >= 640 ? 2 : 1);
    }

    function setSlideWidth() {
        VISIBLE = getVisible();
        const gap = 24;
        const w   = (outer.offsetWidth - gap * (VISIBLE - 1)) / VISIBLE;
        slides.forEach(s => { s.style.minWidth = w + 'px'; s.style.maxWidth = w + 'px'; });
        track.style.gap = gap + 'px';
        goTo(cur, false);
        buildDots();
    }

    function goTo(index, animate = true) {
        const maxIndex = Math.max(0, total - VISIBLE);
        cur = Math.min(Math.max(index, 0), maxIndex);
        updateDots();

        if (window.innerWidth < 768) {
            const slideW = slides[0].offsetWidth + 16;
            outer.scrollTo({ left: cur * slideW, behavior: animate ? 'smooth' : 'auto' });
            return;
        }

        const slideW = slides[0].offsetWidth + 24; // width + gap
        track.style.transition = animate ? 'transform 0.45s cubic-bezier(.4,0,.2,1)' : 'none';
        track.style.transform  = `translateX(-${cur * slideW}px)`;
        
        // disable buttons at edges
        if (btnPrev) btnPrev.disabled = cur === 0;
        if (btnNext) btnNext.disabled = cur >= maxIndex;
    }

    function next() { goTo(cur + VISIBLE <= total - VISIBLE ? cur + VISIBLE : 0); }
    function prev() { goTo(cur - VISIBLE >= 0 ? cur - VISIBLE : Math.max(0, total - VISIBLE)); }

    function resetAuto() {
        clearInterval(autoTimer);
        autoTimer = setInterval(next, 5000);
    }

    if (btnPrev) btnPrev.addEventListener('click', () => { prev(); resetAuto(); });
    if (btnNext) btnNext.addEventListener('click', () => { next(); resetAuto(); });

    // Desktop Touch / Swipe
    outer.addEventListener('touchstart', e => { 
        if (window.innerWidth >= 768) touchStartX = e.touches[0].clientX; 
    }, { passive: true });
    outer.addEventListener('touchend', e => {
        if (window.innerWidth >= 768) {
            const dx = e.changedTouches[0].clientX - touchStartX;
            if (Math.abs(dx) > 50) { dx < 0 ? next() : prev(); resetAuto(); }
        }
    });

    // Mobile native scroll sync
    outer.addEventListener('scroll', () => {
        if (window.innerWidth < 768) {
            const slideW = slides[0].offsetWidth + 16;
            cur = Math.round(outer.scrollLeft / slideW);
            updateDots();
        }
    }, { passive: true });

    // Init
    setSlideWidth();
    resetAuto();

    window.addEventListener('resize', () => { setSlideWidth(); });
})();
</script>
@endpush
