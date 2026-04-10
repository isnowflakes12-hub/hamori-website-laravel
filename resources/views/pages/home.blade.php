@extends('layouts.app')
@section('title', 'Beranda — RS Hamori')

@section('content')
@php
$heroSlides = $banners->count() ? $banners : collect([
    (object)['gambar'=>null,'judul'=>'Pelayanan Kesehatan Terbaik untuk Keluarga Anda','link'=>null,'color'=>'linear-gradient(135deg,#001f4d,#0055a5)'],
    (object)['gambar'=>null,'judul'=>'Pusat Layanan Jantung & Pembuluh Darah','link'=>null,'color'=>'linear-gradient(135deg,#0d1b2a,#1b4f72)'],
    (object)['gambar'=>null,'judul'=>'IGD & Ambulans Siap 24 Jam','link'=>null,'color'=>'linear-gradient(135deg,#1a0a00,#c0392b)'],
    (object)['gambar'=>null,'judul'=>'Medical Check Up Komprehensif','link'=>null,'color'=>'linear-gradient(135deg,#0a1f0a,#00a859)'],
]);
@endphp


{{-- ═══ HERO + PROMO SEJAJAR ═══ --}}
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
                    <div class="hs-btns">
                        <a href="{{ $slide->link ?? 'https://wa.link/1uk9rl' }}" target="{{ empty($slide->link)?'_blank':'_self' }}" class="hs-btn1">
                            Selengkapnya <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                        <a href="{{ route('dokter.index') }}" class="hs-btn2">
                            <i class="bi bi-person-badge"></i> Cari Dokter
                        </a>
                    </div>
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

    {{-- Promo panel kanan — dinamis dari database --}}
    <div class="hero-promo-panel">
        @if($promoFeatured)
        @php $p = $promoFeatured; @endphp
        <div class="hpp-top">
            <span class="hpp-label">⚡ Penawaran Terbatas</span>
            <h3 class="hpp-title">{{ $p->judul }}</h3>
        </div>
        @if($p->gambar)
        <div style="border-radius:12px;overflow:hidden;margin-bottom:14px;max-height:120px">
            <img src="{{ asset('storage/'.$p->gambar) }}" alt="{{ $p->judul }}"
                 style="width:100%;height:120px;object-fit:cover">
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
            <button class="hpp-btn-main" id="btnOpenPromo">
                <i class="bi bi-gift-fill"></i> Lihat Promo
            </button>
            <a href="{{ $p->link_wa ?? 'https://wa.link/1uk9rl' }}" target="_blank" class="hpp-btn-wa">
                <i class="bi bi-whatsapp"></i> Daftar
            </a>
        </div>
        <div class="hpp-footer">
            <i class="bi bi-shield-check"></i>
            <span>Promo terbatas, segera daftar!</span>
        </div>
        {{-- @else
        fallback static
        <div class="hpp-top">
            <span class="hpp-label">⚡ Penawaran Terbatas</span>
            <h3 class="hpp-title">Paket Medical<br>Check Up Lengkap</h3>
        </div>
        <ul class="hpp-list">
            <li><i class="bi bi-check2-circle"></i> Laboratorium 30+ parameter</li>
            <li><i class="bi bi-check2-circle"></i> Rontgen Thorax &amp; EKG</li>
            <li><i class="bi bi-check2-circle"></i> Konsultasi Dokter Spesialis</li>
            <li><i class="bi bi-check2-circle"></i> USG Abdomen</li>
        </ul>
        <div class="hpp-price">
            <span class="hpp-old">Rp 1.500.000</span>
            <div class="hpp-new-wrap">
                <span class="hpp-new">Rp 850.000</span>
                <span class="hpp-disc">43% OFF</span>
            </div>
        </div>
        <div class="hpp-actions">
            <button class="hpp-btn-main" id="btnOpenPromo">
                <i class="bi bi-gift-fill"></i> Lihat Promo
            </button>
            <a href="https://wa.link/1uk9rl" target="_blank" class="hpp-btn-wa">
                <i class="bi bi-whatsapp"></i> Daftar
            </a>
        </div> --}}
        @endif
    </div>

</div>

{{-- ═══ QUICK ACTION BAR ═══ --}}
<div class="qbar">
    <div class="qbar-inner">
        <a href="{{ route('dokter.index') }}" class="qa"><div class="qa-ic"><i class="bi bi-person-badge-fill"></i></div><span>Cari Dokter</span></a>
        <a href="https://wa.link/1uk9rl" target="_blank" class="qa"><div class="qa-ic"><i class="bi bi-calendar2-check-fill"></i></div><span>Appointment</span></a>
        <a href="tel:1500816" class="qa"><div class="qa-ic"><i class="bi bi-telephone-fill"></i></div><span>Telepon 24 Jam</span></a>
        <a href="{{ route('tempat-tidur') }}" class="qa"><div class="qa-ic"><i class="bi bi-hospital-fill"></i></div><span>Tempat Tidur</span></a>
        <a href="{{ route('paket-kesehatan') }}" class="qa"><div class="qa-ic"><i class="bi bi-heart-pulse-fill"></i></div><span>Paket Sehat</span></a>
        <a href="{{ route('layanan.index') }}" class="qa"><div class="qa-ic"><i class="bi bi-award-fill"></i></div><span>Layanan</span></a>
        <a href="https://wa.me/628888905555" target="_blank" class="qa qa-wa"><div class="qa-ic"><i class="bi bi-whatsapp"></i></div><span>WhatsApp</span></a>
        <button class="qa qa-promo" id="btnOpenPromo"><div class="qa-ic"><i class="bi bi-gift-fill"></i></div><span>Promo</span></button>
    </div>
</div>

{{-- ═══ LAYANAN UNGGULAN ═══ --}}
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
                @foreach($layananUnggulan->take(8) as $l)
                <a href="{{ route('layanan.show', $l->slug ?? $l->id) }}" class="lc">
                    <div class="lc-ic">@if($l->logo)<img src="{{ asset('storage/'.$l->logo) }}" alt="{{ $l->nama }}">@else<i class="bi bi-hospital"></i>@endif</div>
                    <h5 class="lc-name">{{ $l->nama }}</h5>
                    <p class="lc-desc">{{ Str::limit(strip_tags($l->deskripsi_singkat ?? $l->deskripsi ?? ''), 70) }}</p>
                    <span class="lc-more">Selengkapnya <i class="bi bi-arrow-right"></i></span>
                </a>
                @endforeach
            @else
                @foreach([['bi-heart-pulse-fill','Kardiologi','Jantung & pembuluh darah komprehensif'],['bi-gender-female','Kebidanan','Perawatan ibu hamil dan bersalin'],['bi-activity','Neurologi','Penanganan gangguan saraf dan otak'],['bi-person-standing','Ortopedi','Bedah tulang, sendi dan otot modern'],['bi-eye','Mata','Pemeriksaan dan operasi mata terkini'],['bi-lungs','Paru','Diagnosis & terapi penyakit paru'],['bi-capsule','Onkologi','Penanganan kanker multidisiplin'],['bi-clipboard2-pulse','Medical Check Up','Deteksi dini paket pemeriksaan lengkap']] as $l)
                <div class="lc">
                    <div class="lc-ic"><i class="bi {{ $l[0] }}"></i></div>
                    <h5 class="lc-name">{{ $l[1] }}</h5>
                    <p class="lc-desc">{{ $l[2] }}</p>
                    <span class="lc-more">Selengkapnya <i class="bi bi-arrow-right"></i></span>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</section>



{{-- ═══ STATS ═══ --}}
<div class="stats-sec">
    <div class="stats-grid">
        <div class="st"><span class="st-n">50<sup>+</sup></span><span class="st-l">Dokter Spesialis</span></div>
        <div class="st"><span class="st-n">200<sup>+</sup></span><span class="st-l">Tempat Tidur</span></div>
        <div class="st"><span class="st-n">24/7</span><span class="st-l">Layanan IGD</span></div>
        <div class="st"><span class="st-n">10K<sup>+</sup></span><span class="st-l">Pasien per Tahun</span></div>
    </div>
</div>


{{-- ═══ PROMO AKTIF ═══ --}}
@if(isset($promoAktif) && $promoAktif->count())
<section class="sec" style="background:#f8fafc">
    <div class="sec-cont">
        <div class="sec-head">
            <div>
                <span class="eyebrow">Penawaran Spesial</span>
                <h2 class="sec-h2">Promo & Paket Kesehatan</h2>
                <p class="sec-sub">Dapatkan layanan kesehatan terbaik dengan harga spesial untuk Anda dan keluarga.</p>
            </div>
        </div>
        <div class="promo-grid">
            @foreach($promoAktif as $p)
            <div class="promo-card {{ $p->is_featured ? 'promo-card-featured' : '' }}">
                @if($p->gambar)
                <div class="promo-card-img">
                    <img src="{{ asset('storage/'.$p->gambar) }}" alt="{{ $p->judul }}" loading="lazy">
                    @if($p->diskon)<div class="promo-card-disc">{{ $p->diskon }}</div>@endif
                </div>
                @endif
                <div class="promo-card-body">
                    @if($p->is_featured)<span class="promo-card-badge">⭐ Unggulan</span>@endif
                    <h4 class="promo-card-title">{{ $p->judul }}</h4>
                    @if($p->deskripsi)
                    <p class="promo-card-desc">{{ Str::limit($p->deskripsi, 80) }}</p>
                    @endif
                    @if($p->benefit && count($p->benefit) > 0)
                    <ul class="promo-card-list">
                        @foreach(array_slice($p->benefit,0,3) as $b)
                        <li><i class="bi bi-check2-circle"></i>{{ $b }}</li>
                        @endforeach
                    </ul>
                    @endif
                    @if($p->harga_promo)
                    <div class="promo-card-price">
                        @if($p->harga_normal)<span class="pcp-old">{{ $p->harga_normal }}</span>@endif
                        <span class="pcp-new">{{ $p->harga_promo }}</span>
                    </div>
                    @endif
                    @if($p->berlaku_sampai)
                    <div class="promo-card-expire">
                        <i class="bi bi-calendar-event"></i> s/d {{ $p->berlaku_sampai->format('d M Y') }}
                    </div>
                    @endif
                    <div class="promo-card-actions">
                        <a href="{{ $p->link_wa ?? 'https://wa.link/1uk9rl' }}" target="_blank" class="pca-wa">
                            <i class="bi bi-whatsapp"></i> Daftar Sekarang
                        </a>
                        @if($p->link_daftar)
                        <a href="{{ $p->link_daftar }}" class="pca-detail">Detail</a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ═══ ARTIKEL ═══ --}}
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
                @foreach($artikelTerbaru->take(3) as $idx => $art)
                <a href="{{ route('artikel.show', [$art->kategori->slug ?? 'umum', $art->slug]) }}" class="ac{{ $idx===0?' feat':'' }}">
                    <div class="ac-thumb">@if($art->gambar)<img src="{{ asset('storage/'.$art->gambar) }}" alt="{{ $art->judul }}" loading="lazy">@else<div style="background:linear-gradient(135deg,#0055a5,#0077cc);width:100%;height:100%"></div>@endif</div>
                    <div class="ac-body">
                        @if($art->kategori)<span class="ac-cat">{{ $art->kategori->nama }}</span>@endif
                        <h4 class="ac-title">{{ $art->judul }}</h4>
                        <p class="ac-exc">{{ Str::limit(strip_tags($art->konten ?? ''), 90) }}</p>
                        <div class="ac-foot"><span><i class="bi bi-calendar3 me-1"></i>{{ optional($art->published_at)->format('d M Y') }}</span><span class="ac-more">Baca <i class="bi bi-arrow-right"></i></span></div>
                    </div>
                </a>
                @endforeach
            @else
                @foreach([['Kardiologi','Tips Menjaga Kesehatan Jantung di Usia Muda','10 Mar 2025'],['Umum','Pentingnya Medical Check Up Rutin Setiap Tahun','05 Mar 2025'],['Neurologi','Mengenal Gejala Stroke dan Cara Penanganannya','01 Mar 2025']] as $idx => $art)
                <div class="ac{{ $idx===0?' feat':'' }}">
                    <div class="ac-thumb"><div style="background:linear-gradient(135deg,#0055a5,#0077cc);width:100%;height:100%"></div></div>
                    <div class="ac-body"><span class="ac-cat">{{ $art[0] }}</span><h4 class="ac-title">{{ $art[1] }}</h4><div class="ac-foot"><span><i class="bi bi-calendar3 me-1"></i>{{ $art[2] }}</span><span class="ac-more">Baca <i class="bi bi-arrow-right"></i></span></div></div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</section>

{{-- ═══ APP DOWNLOAD ═══ --}}
<div class="app-sec">
    <div class="app-card">
        <div class="app-inner">
            <div class="app-txt">
                <span class="eyebrow" style="color:rgba(255,255,255,.65)">Aplikasi Mobile</span>
                <h3 class="app-h">Layanan Kesehatan<br>di Genggaman Anda</h3>
                <p class="app-d">Daftar antrian, cek jadwal dokter, dan pantau hasil lab langsung dari smartphone Anda.</p>
                <div class="app-btns">
                    <a href="#" class="app-btn"><i class="bi bi-apple"></i><div><small>Download di</small><strong>App Store</strong></div></a>
                    <a href="#" class="app-btn"><i class="bi bi-google-play"></i><div><small>Download di</small><strong>Google Play</strong></div></a>
                </div>
            </div>
            <div class="app-ph"><i class="bi bi-phone"></i></div>
        </div>
    </div>
</div>

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

/* open promo popup */
['btnOpenPromo','btnOpenPromo2'].forEach(function(id){
    var el = document.getElementById(id);
    if(el) el.addEventListener('click', function(){
        var o = document.getElementById('promoOverlay');
        if(o) o.classList.add('show');
    });
});

/* promo panel countdown */
(function(){
    var el = document.getElementById('hppCountdown');
    if(!el) return;
    function tick(){
        var now = new Date();
        var end = new Date(now); end.setHours(23,59,59,0);
        var s = Math.max(0, Math.floor((end - now) / 1000));
        var h = String(Math.floor(s/3600)).padStart(2,'0');
        var m = String(Math.floor((s%3600)/60)).padStart(2,'0');
        var sec = String(s%60).padStart(2,'0');
        el.textContent = h+':'+m+':'+sec;
    }
    tick(); setInterval(tick, 1000);
})();
</script>
@endpush
