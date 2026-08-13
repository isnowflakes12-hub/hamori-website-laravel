@extends('layouts.app')
@section('title', 'Profil Rumah Sakit')

@section('content')

@push('styles')
<style>
    .sec { padding: 30px 0; }
</style>
@endpush

<div class="page-header">
    <div class="container">
        <h1 class="page-title">Profil RS Hamori</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Profil RS</li>
            </ol>
        </nav>
    </div>
</div>

<section class="pr-section sec">
    <div class="container">
        <div class="row g-5 align-items-center">

            <div class="col-lg-6">
                <span class="eyebrow">Tentang Kami</span>
                <div class="d-flex align-items-center gap-3 mt-1 mb-4">
                    <h2 class="sec-h2 mb-0">Rumah Sakit Hamori</h2>
                    @if($profil->kars_logo)
                        <img src="{{ asset('storage/'.$profil->kars_logo) }}" alt="Logo KARS" style="height:45px;object-fit:contain;">
                    @endif
                </div>
                <p class="pr-desc">
                    {!! nl2br(e($profil->deskripsi)) !!}
                </p>

                <div class="pr-stats">
                    <div class="pr-stat">
                        <span class="pr-stat-n">{{ $profil->total_dokter }}</span>
                        <span class="pr-stat-l">Dokter Spesialis</span>
                    </div>
                    <div class="pr-stat">
                        <span class="pr-stat-n">{{ $profil->total_bed }}</span>
                        <span class="pr-stat-l">Tempat Tidur</span>
                    </div>
                    <div class="pr-stat">
                        <span class="pr-stat-n">24/7</span>
                        <span class="pr-stat-l">Layanan IGD</span>
                    </div>
                    <div class="pr-stat">
                        <span class="pr-stat-n">{{ $profil->pusat_unggulan }}</span>
                        <span class="pr-stat-l">Pusat Unggulan</span>
                    </div>
                </div>

                <div class="pr-trust">
                    <span class="pr-trust-item">
                        <i class="fas fa-check-circle"></i> Terakreditasi Paripurna KARS
                    </span>
                    <span class="pr-trust-item">
                        <i class="fas fa-check-circle"></i> Bisa menggunakan BPJS
                    </span>
                    
                </div>
            </div>

            <div class="col-lg-6">
                <div class="pr-gallery">
                    @php $imgUtama = $profil->gambar_utama ? asset('storage/'.$profil->gambar_utama) : asset('assets/images/hamoripf.jpeg'); @endphp
                    <a href="{{ $imgUtama }}"
                       class="glightbox pr-img-main"
                       data-gallery="rs-gallery"
                       data-title="Rumah Sakit Hamori – Subang | &copy; {{ date('Y') }} RS HAMORI">
                        <img src="{{ $imgUtama }}"
                             alt="Rumah Sakit Hamori" loading="eager">
                        <span class="pr-img-overlay">
                            <i class="fas fa-expand-alt"></i>
                            <span>Lihat Foto</span>
                        </span>
                    </a>

                    <a href="{{ asset('assets/images/hamoripf2.jpeg') }}"
                       class="glightbox d-none"
                       data-gallery="rs-gallery"
                       data-title="Rumah Sakit Hamori – Subang | &copy; {{ date('Y') }} RS HAMORI">
                    </a>

                    <div class="pr-location-badge">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Subang, Jawa Barat</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="pr-vm-section sec bg-light">
    <div class="container">

        <div class="sec-head justify-content-center text-center mb-5">
            <div>
                <span class="eyebrow">Landasan Kami</span>
                <h2 class="sec-h2 mt-1">Visi & Misi</h2>
            </div>
        </div>

        <div class="row g-4 align-items-start">

            <div class="col-lg-4">
                <div class="pr-vm-card pr-vm-card--visi">
                    {{--<div class="pr-vm-icon">
                        <i class="fas fa-eye"></i>
                    </div> --}}
                    <h4 class="pr-vm-label">Visi</h4>
                    <p class="pr-vm-text">
                        {!! nl2br(e($profil->visi)) !!}
                    </p>
                    <div class="pr-vm-accent"></div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="pr-vm-card pr-vm-card--misi">
                     {{-- <div class="pr-vm-icon pr-vm-icon--accent">
                        <i class="fas fa-bullseye"></i>
                    </div>--}}
                    <h4 class="pr-vm-label">Misi</h4>
                    <ul class="pr-misi-list">
                        @php $misiList = array_filter(array_map('trim', explode("\n", $profil->misi))); @endphp
                        @foreach($misiList as $i => $m)
                        <li class="pr-misi-item">
                            <span class="pr-misi-num">{{ str_pad($i+1, 2, '0', STR_PAD_LEFT) }}</span>
                            <p class="pr-misi-text">
                                {{ $m }}
                            </p>
                        </li>
                        @endforeach
                    </ul>
                    <div class="pr-vm-accent pr-vm-accent--right"></div>
                </div>
            </div>

        </div>
    </div>
</section>

@if($milestones->isNotEmpty())
<section class="pr-milestone-section sec">
    <div class="container">
        <div class="text-center mb-5">
            <span class="eyebrow">Perjalanan Kami</span>
            <h2 class="sec-h2 mt-1">Milestone RS Hamori</h2>
        </div>

        <div class="ms-timeline">
            @foreach($milestones as $i => $ms)
            <div class="ms-item {{ $i % 2 == 0 ? 'ms-left' : 'ms-right' }}">
                <div class="ms-content">
                    <h3 class="ms-year">{{ $ms->tahun }}</h3>
                    <h4 class="ms-title">{{ $ms->judul }}</h4>
                    <p class="ms-desc">{{ $ms->deskripsi }}</p>
                    @if($ms->gambar)
                        <img src="{{ asset('storage/'.$ms->gambar) }}" alt="{{ $ms->judul }}" class="ms-img">
                    @endif

                    @if(is_array($ms->galeri) && count($ms->galeri) > 0)
                    <button type="button"
                            class="ms-gallery-btn"
                            onclick="openMsGallery({{ $ms->id }})"
                            title="Lihat {{ count($ms->galeri) }} foto kejadian">
                        <i class="fas fa-images"></i>
                        Lihat Foto ({{ count($ms->galeri) }})
                    </button>

                    <div id="ms-gallery-data-{{ $ms->id }}" style="display:none;"
                         data-images='@json(array_map(fn($p) => asset("storage/".$p), $ms->galeri))'
                         data-title="{{ $ms->tahun }} – {{ $ms->judul }}">
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<div id="msLightboxModal" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.88); z-index:99999; align-items:center; justify-content:center; flex-direction:column; overflow:hidden;">
    <div style="position:absolute; top:20px; right:20px; z-index:2;">
        <button onclick="closeMsGallery()" style="background:rgba(255,255,255,0.15); border:none; border-radius:50%; width:44px; height:44px; color:#fff; font-size:20px; cursor:pointer; display:flex; align-items:center; justify-content:center;">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <div style="text-align:center; color:#fff; margin-bottom:16px; padding:0 20px; z-index:2;">
        <h5 id="msLightboxTitle" style="margin:0; font-size:16px; opacity:.8;"></h5>
    </div>
    <div style="position:relative; display:flex; align-items:center; justify-content:center; width:100%; max-width:900px; padding:0 60px; z-index:2;">
        <button onclick="msPrevSlide()" style="position:absolute; left:10px; background:rgba(255,255,255,0.15); border:none; border-radius:50%; width:44px; height:44px; color:#fff; font-size:20px; cursor:pointer; display:flex; align-items:center; justify-content:center;">
            <i class="fas fa-chevron-left"></i>
        </button>
        <img id="msLightboxImg" src="" alt="" style="max-height:70vh; max-width:100%; border-radius:12px; box-shadow:0 20px 60px rgba(0,0,0,0.5);">
        <button onclick="msNextSlide()" style="position:absolute; right:10px; background:rgba(255,255,255,0.15); border:none; border-radius:50%; width:44px; height:44px; color:#fff; font-size:20px; cursor:pointer; display:flex; align-items:center; justify-content:center;">
            <i class="fas fa-chevron-right"></i>
        </button>
    </div>
    <div id="msLightboxCounter" style="color:rgba(255,255,255,0.6); margin-top:14px; font-size:14px; z-index:2;"></div>
    <div id="msLightboxDots" style="display:flex; gap:8px; margin-top:12px; z-index:2;"></div>
</div>

<style>
#msLightboxModal {
    /* Ensure it covers full viewport regardless of parent context */
    position: fixed !important;
    top: 0 !important;
    left: 0 !important;
    width: 100vw !important;
    height: 100vh !important;
    margin: 0 !important;
    padding: 0 !important;
    z-index: 99999 !important;
}
body.lightbox-open {
    overflow: hidden;
}
.ms-gallery-btn {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    margin-top: 14px;
    padding: 8px 18px;
    background: var(--primary-light);
    color: var(--primary-dark);
    border: 1.5px solid var(--primary);
    border-radius: 50px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s, color 0.2s;
}
.ms-gallery-btn:hover {
    background: var(--primary);
    color: #fff;
}
</style>

<script>
let msImages = [];
let msCurrent = 0;

function openMsGallery(id) {
    const el = document.getElementById('ms-gallery-data-' + id);
    msImages = JSON.parse(el.dataset.images);
    const title = el.dataset.title;
    msCurrent = 0;
    document.getElementById('msLightboxTitle').textContent = title;
    document.getElementById('msLightboxModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
    msRenderSlide();
    msRenderDots();
}

function closeMsGallery() {
    document.getElementById('msLightboxModal').style.display = 'none';
    document.body.style.overflow = '';
}

function msRenderSlide() {
    document.getElementById('msLightboxImg').src = msImages[msCurrent];
    document.getElementById('msLightboxCounter').textContent = (msCurrent + 1) + ' / ' + msImages.length;
    document.querySelectorAll('.ms-dot').forEach((d, i) => {
        d.style.opacity = i === msCurrent ? '1' : '0.4';
    });
}

function msRenderDots() {
    const container = document.getElementById('msLightboxDots');
    container.innerHTML = '';
    msImages.forEach((_, i) => {
        const d = document.createElement('button');
        d.className = 'ms-dot';
        d.style.cssText = 'width:8px;height:8px;border-radius:50%;border:none;background:#fff;cursor:pointer;opacity:' + (i === 0 ? '1' : '0.4') + ';padding:0;';
        d.onclick = () => { msCurrent = i; msRenderSlide(); };
        container.appendChild(d);
    });
}

function msPrevSlide() {
    msCurrent = (msCurrent - 1 + msImages.length) % msImages.length;
    msRenderSlide();
}

function msNextSlide() {
    msCurrent = (msCurrent + 1) % msImages.length;
    msRenderSlide();
}

// Close on backdrop click
document.getElementById('msLightboxModal').addEventListener('click', function(e) {
    if (e.target === this) closeMsGallery();
});

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    if (document.getElementById('msLightboxModal').style.display !== 'flex') return;
    if (e.key === 'ArrowRight') msNextSlide();
    if (e.key === 'ArrowLeft') msPrevSlide();
    if (e.key === 'Escape') closeMsGallery();
});
</script>
@endif

<section class="pr-values-section sec">
    <div class="container">

        <div class="text-center mb-5">
            <span class="eyebrow">KOMITMEN KAMI</span>
            <h2 class="sec-h2 mt-1">Komitmen yang Menjadi Dasar Setiap Pelayanan</h2>
        </div>

        <div class="row g-4 justify-content-center">
            <div class="col-md-4 col-6">
                <div class="pr-val-card">
                    <div class="pr-val-ic">01</div>
                    <h6 class="pr-val-title">Keselamatan Pasien</h6>
                    <p class="pr-val-desc">Keselamatan pasien selalu menjadi prioritas utama dalam setiap pelayanan yang kami berikan.</p>
                </div>
            </div>
            <div class="col-md-4 col-6">
                <div class="pr-val-card">
                    <div class="pr-val-ic pr-val-ic--accent">02</div>
                    <h6 class="pr-val-title">Kepedulian</h6>
                    <p class="pr-val-desc">Kami melayani dengan empati, menghargai setiap pasien sebagai individu yang unik.</p>
                </div>
            </div>
            <div class="col-md-4 col-6">
                <div class="pr-val-card">
                    <div class="pr-val-ic pr-val-ic--green">03</div>
                    <h6 class="pr-val-title">Profesionalisme</h6>
                    <p class="pr-val-desc">Kami menghadirkan pelayanan berkualitas melalui kompetensi, kolaborasi, dan pembelajaran berkelanjutan.</p>
                </div>
            </div>
            <div class="col-md-4 col-6">
                <div class="pr-val-card">
                    <div class="pr-val-ic pr-val-ic--amber">04</div>
                    <h6 class="pr-val-title">Integritas</h6>
                    <p class="pr-val-desc">Kami menjunjung tinggi kejujuran, etika, dan tanggung jawab dalam setiap tindakan.</p>
                </div>
            </div>
            <div class="col-md-4 col-6">
                <div class="pr-val-card">
                    <div class="pr-val-ic pr-val-ic--blue">05</div>
                    <h6 class="pr-val-title">Inovasi & Keberlanjutan</h6>
                    <p class="pr-val-desc">Kami terus berinovasi untuk menghadirkan pelayanan kesehatan yang lebih baik serta mendukung lingkungan yang sehat dan berkelanjutan.</p>
                </div>
            </div>
        </div>

    </div>
</section>

<section class="pr-cta-section">
    <div class="container">
        <div class="pr-cta-inner">
            <div class="pr-cta-glow"></div>
            <div class="pr-cta-text">
                <span class="eyebrow" style="color:rgba(255,255,255,.6)">Rumah Sakit Hamori</span>
                <h3 class="pr-cta-title">Mitra Kesehatan Terpercaya Anda !</h3>
                <p class="pr-cta-desc">
                    memberikan pelayanan terbaik secara cepat, tanggap, dan bermutu. Kami hadir lebih dekat untuk memastikan seluruh lapisan masyarakat Subang mendapatkan akses kesehatan yang setara, nyaman, dan terjangkau, baik untuk penanganan darurat maupun perawatan rutin.
                </p>
            </div>
            <div class="pr-cta-actions">
                <a href="https://wa.me/{{ \App\Models\SiteSetting::get('phone_whatsapp', '6281111121705') }}" target="_blank" class="pr-cta-wa">
                    <i class="fab fa-whatsapp"></i> Chat via WhatsApp
                </a>
                <a href="{{ route('layanan.index') }}" class="pr-cta-layanan">
                    <i class="fas fa-star-of-life"></i> Layanan Unggulan
                </a>
            </div>
        </div>
    </div>
</section>




@endsection
