@extends('layouts.app')
@section('title', 'Layanan & Fasilitas')

@section('content')

{{-- ── INTRO STRIP ── --}}
<div class="pm-intro">
    <div class="pm-intro-glow pm-intro-glow--left"></div>
    <div class="pm-intro-glow pm-intro-glow--right"></div>

    {{-- Watermark Logo Blend --}}
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
                <span class="eyebrow">Pusat Layanan Medis</span>
                <h2 class="sec-h2 mt-1">Layanan & Fasilitas Terbaik</h2>
                <p class="sec-sub mt-2">
                    RS Hamori menyediakan berbagai layanan dan fasilitas medis dengan standar pelayanan prima. Fasilitas kami dilengkapi dengan teknologi terkini dan ditangani oleh tenaga medis profesional.
                </p>
            </div>
            <div class="pm-intro-badges">
                <div class="pm-intro-badge">
                    <i class="fas fa-hospital-user"></i>
                    <span>Pelayanan Medis Terpadu</span>
                </div>
                <div class="pm-intro-badge">
                    <i class="fas fa-stethoscope"></i>
                    <span>Dokter Ahli</span>
                </div>
                <div class="pm-intro-badge">
                    <i class="fas fa-vial"></i>
                    <span>Penunjang Medis Modern</span>
                </div>
                <div class="pm-intro-badge">
                    <i class="fas fa-bed"></i>
                    <span>Rawat Inap Nyaman</span>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ── SEARCH BAR ── --}}
<div class="pm-search-section">
    <div class="container">
        <form method="GET" action="{{ route('fasilitas.index') }}" class="pm-search-wrap">
            <i class="fas fa-search pm-search-icon"></i>
            <input type="text" name="search" id="pmSearchInput" class="pm-search-input"
                   placeholder="Cari fasilitas atau layanan... contoh: rawat inap, IGD, radiologi"
                   value="{{ request('search') }}">
            <button type="submit" class="pm-search-btn"><i class="fas fa-arrow-right"></i></button>
            @if(request('search'))
                <a href="{{ route('fasilitas.index') }}" class="pm-search-clear" title="Hapus pencarian">
                    <i class="fas fa-times"></i>
                </a>
            @endif
            <span class="pm-search-count" id="pmSearchCount">
                @if(request('search'))
                    {{ $fasilitas->total() }} hasil
                @endif
            </span>
        </form>
    </div>
</div>

{{-- ── FASILITAS GRID ── --}}
<section class="pm-section sec">
    <div class="container">

        @if($fasilitas->isEmpty())
        <div class="pm-empty">
            <div class="pm-empty-icon"><i class="fas fa-hospital"></i></div>
            <h4 class="pm-empty-title">Belum Ada Fasilitas</h4>
            <p class="pm-empty-desc">Maaf, fasilitas atau layanan yang Anda cari belum tersedia.</p>
            <a href="{{ route('fasilitas.index') }}" class="pm-empty-btn">
                <i class="fas fa-arrow-left"></i> Lihat Semua Fasilitas
            </a>
        </div>
        @else

        <div class="row g-4">
            @foreach($fasilitas as $f)
            <div class="col-md-6 col-lg-4 pm-item-col">
                <div class="pm-card-clean">
                    <div class="pm-card-clean-img" style="height: 200px; overflow: hidden; background: #f8fafc;">
                        @if($f->gambar)
                            <img src="{{ asset('storage/'.$f->gambar) }}" alt="{{ $f->nama }}" loading="lazy" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <i class="fas fa-hospital-user text-muted" style="font-size: 3rem;"></i>
                        @endif
                        <span class="pm-card-featured"><i class="fas fa-tag"></i> {{ $f->kategori->nama ?? 'Umum' }}</span>
                    </div>
                    <div class="pm-card-clean-body">
                        <h3 class="pm-card-clean-title">{{ $f->nama }}</h3>
                        <p class="pm-card-clean-desc">
                            {{ Str::limit($f->deskripsi ?? 'Fasilitas medis unggulan dengan pelayanan terbaik untuk Anda.', 100) }}
                        </p>
                        <div class="pm-card-clean-footer">
                            <a href="{{ route('fasilitas.show', $f->slug ?? $f->nama) }}" class="pm-btn-outline">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($fasilitas->hasPages())
        <div class="mt-5 d-flex justify-content-center">
            {{ $fasilitas->links('pagination::bootstrap-5') }}
        </div>
        @endif

        @endif

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

/* EMPTY STATE */
.pm-empty {
    text-align: center;
    padding: 80px 20px;
    background: #fff;
    border-radius: var(--radius-lg);
    box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    border: 1px dashed var(--border);
}
.pm-empty-icon {
    font-size: 3rem;
    color: var(--muted-2);
    margin-bottom: 20px;
}
.pm-empty-title {
    font-family: 'Libre Baskerville', serif;
    font-size: 1.5rem;
    color: var(--ink);
    margin-bottom: 10px;
}
.pm-empty-desc {
    color: var(--muted);
    margin-bottom: 24px;
}
.pm-empty-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 24px;
    background: #f8fafc;
    color: var(--primary);
    font-weight: 600;
    border-radius: var(--radius-md);
    text-decoration: none;
    transition: all 0.2s ease;
}
.pm-empty-btn:hover {
    background: var(--primary);
    color: #fff;
}
</style>
@endpush

@endsection
