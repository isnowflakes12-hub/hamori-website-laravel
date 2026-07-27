@extends('layouts.app')
@section('title', 'Promo & Penawaran Spesial')

@section('content')


<div class="pm-intro">
    <div class="pm-intro-glow pm-intro-glow--left"></div>
    <div class="pm-intro-glow pm-intro-glow--right"></div>

    @php
        $favicon = \App\Models\SiteSetting::get('favicon');
    @endphp
    <div class="pm-intro-watermark">
        @if($favicon)
            <img src="{{ asset('storage/' . $favicon) }}" alt="Logo Hamori Watermark">
        @else
            <img src="{{ asset('assets/images/favicon.png') }}" alt="Logo Hamori Watermark">
        @endif
    </div>

    <div class="container position-relative">
        <div class="pm-intro-inner">
            <div class="pm-intro-text">
                <span class="eyebrow">Penawaran Eksklusif</span>
                <h2 class="sec-h2 mt-1">Promo Kesehatan Terbaik untuk Anda</h2>
                <p class="sec-sub mt-2">
                    Dapatkan akses layanan medis berkualitas dengan harga spesial.
                    Semua paket ditangani langsung oleh dokter spesialis berpengalaman.
                </p>
                <br>
            </div>
        </div>
    </div>
</div>

<div class="pm-search-section">
    <div class="container">
        <form method="GET" action="{{ route('promo.index') }}" class="pm-search-wrap" id="pmSearchForm" style="display:flex; gap:10px; align-items:center;">
            
            <!-- Custom Dropdown Kategori -->
            <div class="pm-custom-select-wrapper" style="flex: 0 0 160px; position: relative;">
                <input type="hidden" name="kategori" id="kategoriInput" value="{{ request('kategori') }}">
                
                <div class="pm-custom-select-trigger" id="pmKategoriTrigger" style="display: flex; justify-content: space-between; align-items: center; width: 100%; border: none; background: transparent; font-family: inherit; font-size: 15px; font-weight: 500; color: var(--ink); padding: 8px 15px; outline: none; cursor: pointer; border-right: 1px solid #e2e8f0; user-select: none;">
                    <span id="pmKategoriLabel">
                        @if(request('kategori') == 'Promo') Promo
                        @elseif(request('kategori') == 'Paket') Paket
                        @else Semua Kategori
                        @endif
                    </span>
                    <i class="fas fa-chevron-down" style="font-size: 12px; color: var(--muted); transition: transform 0.2s;" id="pmKategoriArrow"></i>
                </div>
                
                <ul class="pm-custom-select-options" id="pmKategoriOptions" style="position: absolute; top: 120%; left: 0; width: 100%; background: #ffffff; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.08); border: 1px solid #f1f5f9; list-style: none; padding: 6px; margin: 0; z-index: 100; opacity: 0; visibility: hidden; transform: translateY(-10px); transition: all 0.2s ease;">
                    <li class="pm-custom-option {{ request('kategori') == '' ? 'active' : '' }}" data-value="">Semua Kategori</li>
                    <li class="pm-custom-option {{ request('kategori') == 'Promo' ? 'active' : '' }}" data-value="Promo">Promo</li>
                    <li class="pm-custom-option {{ request('kategori') == 'Paket' ? 'active' : '' }}" data-value="Paket">Paket</li>
                </ul>
            </div>

            <div style="display:flex; flex:1; align-items:center; position:relative;">
                <i class="fas fa-search pm-search-icon" style="position:static; padding: 0 15px;"></i>
                <input type="text" name="search" id="pmSearchInput" class="pm-search-input"
                       placeholder="Cari... contoh: scaling, medical check up"
                       value="{{ request('search') }}" style="padding-left:0; flex:1;">
                <button type="submit" class="pm-search-btn"><i class="fas fa-arrow-right"></i></button>
                @if(request('search') || request('kategori'))
                    <a href="{{ route('promo.index') }}" class="pm-search-clear" title="Hapus pencarian">
                        <i class="fas fa-times"></i>
                    </a>
                @endif
            </div>
        </form>
        <div style="text-align: center; margin-top: 10px;">
            <span class="pm-search-count" id="pmSearchCount" style="position:static;">
                @if(request('search') || request('kategori'))
                    {{ $promos->total() }} hasil ditemukan
                @endif
            </span>
        </div>
    </div>
</div>
<section class="pm-section sec">
    <div class="container">

        @if($promos->isEmpty())
        <div class="pm-empty">
            <div class="pm-empty-icon"><i class="fas fa-gift"></i></div>
            <h4 class="pm-empty-title">Belum Ada Promo Aktif</h4>
            <p class="pm-empty-desc">Pantau terus halaman ini untuk penawaran dan paket kesehatan terbaru.</p>
            <a href="{{ route('home') }}" class="pm-empty-btn">
                <i class="fas fa-arrow-left"></i> Kembali ke Beranda
            </a>
        </div>
        @else

        <div class="row g-4">
            @foreach($promos as $p)
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
                        <div style="margin-bottom: 8px;">
                            <span style="font-size: 11px; padding: 4px 10px; border-radius: 20px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; background: {{ $p->kategori == 'Promo' ? '#eff6ff' : '#ecfdf5' }}; color: {{ $p->kategori == 'Promo' ? '#0055a5' : '#059669' }}; border: 1px solid {{ $p->kategori == 'Promo' ? '#bfdbfe' : '#a7f3d0' }}; display: inline-block;">
                                {{ $p->kategori }}
                            </span>
                        </div>
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

        @endif

        @if($promos->hasPages())
        <div class="mt-5 d-flex justify-content-center">
            {{ $promos->links('pagination::bootstrap-5') }}
        </div>
        @endif

        <div id="pmNoResult" style="display: none; flex-direction: column; align-items: center; justify-content: center; padding: 60px 20px; text-align: center; width: 100%;">
            <div style="font-size: 48px; color: var(--muted-2); margin-bottom: 16px;">
                <i class="fas fa-search"></i>
            </div>
            <h4 style="font-family: 'Libre Baskerville', Georgia, serif; font-size: 1.5rem; font-weight: 700; color: var(--ink); margin-bottom: 8px;">
                Promo Tidak Ditemukan
            </h4>
            <p style="color: var(--muted); font-size: 15px; max-width: 400px; margin: 0;">
                Maaf, kami tidak dapat menemukan promo yang sesuai dengan kata kunci pencarian Anda. Coba gunakan kata kunci lain.
            </p>
        </div>

    </div>
</section>

@push('scripts')
<script>
(function() {
    // Auto-submit search on Enter (form already handles it)
    const searchInput = document.getElementById('pmSearchInput');
    if (searchInput) {
        searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                this.closest('form').submit();
            }
        });
    }
})();
</script>
@endpush

@push('styles')
<style>
/* ── PROMO SECTION PADDING ── */
.pm-section {
    padding-top: 20px !important;
}

/* ── SEARCH BAR STYLES ── */
.pm-search-section {
    background: var(--bg);
    padding: 0;
    position: relative;
    z-index: 2;
}
.pm-search-section .container {
    display: flex; justify-content: center;
    transform: translateY(-28px);
}
.pm-search-wrap {
    width: 100%; max-width: 640px;
    position: relative;
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-lg);
    display: flex; align-items: center;
    padding: 4px;
}
.pm-search-icon {
    position: absolute; left: 22px;
    color: var(--muted-2); font-size: 16px;
    pointer-events: none;
}
.pm-search-input {
    width: 100%; border: none; background: transparent;
    padding: 16px 20px 16px 52px; font-size: 15px;
    color: var(--ink); outline: none; border-radius: var(--radius-lg);
}
.pm-search-input::placeholder { color: var(--muted-2); }
.pm-search-count {
    font-size: 13px; font-weight: 600;
    color: var(--primary); white-space: nowrap;
    padding: 0 8px;
}
.pm-search-btn {
    flex-shrink: 0;
    width: 42px; height: 42px;
    border: none; border-radius: var(--radius-sm);
    background: var(--primary); color: #fff;
    font-size: 15px; cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    transition: background 0.2s ease;
}
.pm-search-btn:hover { background: var(--primary-dark, #1a5cb0); }
.pm-search-clear {
    flex-shrink: 0;
    width: 36px; height: 36px;
    border-radius: 50%;
    background: #f1f5f9; color: var(--muted);
    font-size: 13px; cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    text-decoration: none; transition: background 0.2s ease;
    margin-left: 4px;
}
.pm-search-clear:hover { background: #e2e8f0; }

@media (max-width: 768px) {
    .pm-search-section .container { transform: translateY(-22px); padding-left: 20px; padding-right: 20px; }
    .pm-search-input { padding: 14px 16px 14px 48px; font-size: 13.5px; }
    .pm-search-count { display: none; }
}

/* ── INTRO WATERMARK STYLES ── */
.pm-intro {
    position: relative;
    overflow: hidden !important;
    padding: 30px 0 !important;
}
.pm-intro .container {
    z-index: 1;
}
.pm-intro-watermark {
    position: absolute;
    right: -20px;
    top: 50%;
    transform: translateY(-50%);
    width: 450px;
    height: 450px;
    opacity: 0.08; /* Blend transparency */
    pointer-events: none;
    z-index: 0;
    mix-blend-mode: luminosity; /* Better blend effect */
}
.pm-intro-watermark img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    filter: grayscale(100%);
}
@media (max-width: 768px) {
    .pm-intro-watermark {
        width: 250px;
        height: 250px;
        right: -40px;
        opacity: 0.05;
    }
}

/* ── CLEAN CARD STYLES (PRIMAYA STYLE) ── */
.pm-card-clean {
    display: flex;
    flex-direction: column;
    background: #fff;
    border-radius: var(--radius-lg);
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    overflow: hidden;
    height: 100%;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    border: 1px solid #f0f0f0;
}
.pm-card-clean:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}
.pm-card-clean-img {
    position: relative;
    width: 100%;
    background: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
}
.pm-card-clean-img img {
    width: 100%;
    height: auto;
    display: block;
}
.pm-card-featured {
    position: absolute;
    top: 15px;
    left: 15px;
    background: var(--primary);
    color: #fff;
    font-size: 11px;
    font-weight: 700;
    padding: 5px 12px;
    border-radius: 100px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.15);
}
.pm-card-clean-body {
    padding: 24px;
    display: flex;
    flex-direction: column;
    flex: 1;
}
.pm-card-clean-title {
    font-family: 'Inter', sans-serif;
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--ink);
    line-height: 1.4;
    margin: 0 0 12px 0;
}
.pm-card-clean-meta {
    margin-bottom: 12px;
}
.pm-card-expire {
    color: var(--muted);
    font-size: 13.5px;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}
.pm-card-clean-desc {
    color: var(--muted);
    font-size: 13.5px;
    line-height: 1.6;
    margin: 0 0 20px 0;
    flex: 1;
}
.pm-card-clean-footer {
    margin-top: auto;
}
.pm-btn-outline {
    display: inline-block;
    padding: 10px 24px;
    background: transparent;
    border: 1.5px solid var(--primary);
    color: var(--primary);
    font-size: 14px;
    font-weight: 600;
    border-radius: var(--radius-sm);
    text-decoration: none;
    transition: all 0.2s ease;
}
.pm-btn-outline:hover {
    background: var(--primary);
    color: #fff;
}

/* ── CUSTOM PAGINATION STYLES ── */
.pagination {
    margin-bottom: 0;
}
/* Force flex column on desktop to stack elements */
nav .d-sm-flex {
    flex-direction: column !important;
    align-items: center !important;
    gap: 15px;
}
/* Swap the order: buttons on top, text on bottom */
nav .d-sm-flex > div:first-child {
    order: 2;
}
nav .d-sm-flex > div:last-child {
    order: 1;
}
/* Ensure the active page number has white text */
.pagination .page-item.active .page-link {
    color: #ffffff !important;
}
/* Custom Dropdown Option Styles */
.pm-custom-select-wrapper.open .pm-custom-select-options {
    opacity: 1 !important;
    visibility: visible !important;
    transform: translateY(0) !important;
}
.pm-custom-select-wrapper.open #pmKategoriArrow {
    transform: rotate(180deg);
}
.pm-custom-option {
    padding: 10px 15px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 500;
    color: var(--ink);
    cursor: pointer;
    transition: all 0.2s;
    margin-bottom: 2px;
}
.pm-custom-option:hover {
    background: #f1f5f9;
}
.pm-custom-option.active {
    background: #eff6ff;
    color: #0055a5;
    font-weight: 600;
}
</style>
@endpush

@if(!$promos->isEmpty())
<section class="pm-cta-section">
    <div class="container">
        <div class="pm-cta-inner">
            <div class="pm-cta-glow"></div>
            <div class="pm-cta-text">
                <span class="eyebrow" style="color:rgba(255,255,255,.6)">Butuh Informasi Lebih Lanjut?</span>
                <h3 class="pm-cta-title">Konsultasikan Pilihan Promo Anda</h3>
                <p class="pm-cta-desc">Tim kami siap membantu memilih paket yang paling sesuai dengan kebutuhan dan kondisi kesehatan Anda.</p>
            </div>
            <div class="pm-cta-actions">
                <a href="https://wa.me/{{ \App\Models\SiteSetting::get('phone_whatsapp', '6281111121705') }}" target="_blank" class="pm-cta-wa">
                    <i class="fab fa-whatsapp"></i> Chat via WhatsApp
                </a>
                <a href="tel:{{ \App\Models\SiteSetting::get('phone_call_center', '1500816') }}" class="pm-cta-tel">
                    <i class="fas fa-phone"></i> {{ \App\Models\SiteSetting::get('phone_call_center', '1500816') }}
                </a>
            </div>
        </div>
    </div>
</section>
@endif




@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const trigger = document.getElementById('pmKategoriTrigger');
    const wrapper = document.querySelector('.pm-custom-select-wrapper');
    const options = document.querySelectorAll('.pm-custom-option');
    const hiddenInput = document.getElementById('kategoriInput');
    const form = document.getElementById('pmSearchForm');

    if(trigger && wrapper) {
        // Toggle Dropdown
        trigger.addEventListener('click', function(e) {
            e.stopPropagation();
            wrapper.classList.toggle('open');
        });

        // Handle Option Click
        options.forEach(option => {
            option.addEventListener('click', function() {
                const value = this.getAttribute('data-value');
                hiddenInput.value = value;
                form.submit();
            });
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!wrapper.contains(e.target)) {
                wrapper.classList.remove('open');
            }
        });
    }
});
</script>
@endpush

@endsection
