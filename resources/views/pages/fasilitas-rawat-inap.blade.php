@extends('layouts.app')
@section('title', 'Fasilitas Rawat Inap')

@section('content')

{{-- ── PAGE HEADER ── --}}
<div class="page-header">
    <div class="container">
        <h1 class="page-title">Fasilitas Rawat Inap</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Fasilitas Rawat Inap</li>
            </ol>
        </nav>
    </div>
</div>

{{-- ── MAIN CONTENT ── --}}
<section class="fri-section sec">
    <div class="container">

        <div class="row g-4 justify-content-center">
            @forelse($fasilitas as $f)
            <div class="col-lg-4 col-md-6">
                <div class="fri-card">
                    <div class="fri-img-wrap">
                        @if($f->gambar)
                            <img src="{{ asset('storage/'.$f->gambar) }}" alt="{{ $f->nama }}" class="fri-img">
                        @else
                            <div class="fri-img-placeholder">
                                <i class="fas fa-bed"></i>
                            </div>
                        @endif
                        <div class="fri-badge">{{ $f->kategori->nama ?? '-' }}</div>
                    </div>
                    <div class="fri-body">
                        <h4 class="fri-title">{{ $f->nama }}</h4>
                        <p class="fri-desc">
                            {{ Str::limit($f->deskripsi ?? 'Fasilitas rawat inap unggulan dengan pelayanan komprehensif.', 120) }}
                        </p>
                        <a href="{{ route('fasilitas.show', $f->slug) }}" class="fri-link">
                            Lihat Detail <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <div style="font-size:3rem;color:#cbd5e1;margin-bottom:15px"><i class="fas fa-bed"></i></div>
                <h4 class="fw-bold text-secondary">Belum Ada Data</h4>
                <p class="text-muted">Data fasilitas rawat inap saat ini belum tersedia.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<style>
/* ── FASILITAS RAWAT INAP ── */
.fri-section { background: var(--bg); padding-top: 40px; }

.fri-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    overflow: hidden;
    transition: transform .3s ease, box-shadow .3s ease;
    height: 100%;
    display: flex; flex-direction: column;
}
.fri-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-md);
    border-color: #a8e4e0;
}

.fri-img-wrap {
    position: relative;
    width: 100%;
    padding-top: 65%; /* 16:10 aspect ratio */
    overflow: hidden;
    background: #f8fafc;
}
.fri-img {
    position: absolute; top: 0; left: 0;
    width: 100%; height: 100%; object-fit: cover;
    transition: transform .5s ease;
}
.fri-card:hover .fri-img { transform: scale(1.05); }

.fri-img-placeholder {
    position: absolute; top: 0; left: 0;
    width: 100%; height: 100%;
    display: flex; align-items: center; justify-content: center;
    font-size: 40px; color: #cbd5e1;
}

.fri-badge {
    position: absolute; top: 16px; right: 16px;
    background: rgba(255,255,255,.9); backdrop-filter: blur(4px);
    color: var(--primary-dark);
    font-size: 11px; font-weight: 800; letter-spacing: 1px;
    text-transform: uppercase;
    padding: 6px 14px; border-radius: 100px;
    box-shadow: 0 4px 12px rgba(0,0,0,.08);
}

.fri-body {
    padding: 24px;
    flex: 1; display: flex; flex-direction: column;
}

.fri-title {
    font-family: 'Libre Baskerville', Georgia, serif;
    font-size: 1.25rem; font-weight: 700; color: var(--ink);
    margin-bottom: 10px;
}

.fri-desc {
    font-size: 14px; color: var(--ink-2); line-height: 1.6;
    margin-bottom: 20px; flex: 1;
}

.fri-link {
    display: inline-flex; align-items: center; gap: 8px;
    color: var(--primary); font-size: 13.5px; font-weight: 700;
    text-decoration: none; align-self: flex-start;
    transition: color .2s;
}
.fri-link i { transition: transform .2s; }
.fri-link:hover { color: var(--primary-dark); }
.fri-link:hover i { transform: translateX(4px); }

</style>
@endsection
