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

<section class="py-5">
    <div class="container">
        <div class="row g-4">
            {{-- Articles --}}
            <div class="col-lg-8">
                {{-- Category Tabs --}}
                <div class="category-tabs mb-4">
                    <a href="{{ route('artikel.index') }}" class="cat-tab {{ !request('kategori') ? 'active' : '' }}">Semua</a>
                    @foreach($kategoris as $kat)
                    <a href="{{ route('artikel.kategori', $kat->slug) }}" class="cat-tab {{ request()->is('*/'.$kat->slug) ? 'active' : '' }}">
                        {{ $kat->nama }}
                        <span class="cat-count">{{ $kat->artikels_count }}</span>
                    </a>
                    @endforeach
                </div>

                @if($artikels->isEmpty())
                <div class="empty-state text-center py-5">
                    <i class="bi bi-journal-x display-1 text-muted"></i>
                    <h4 class="mt-3">Belum ada artikel</h4>
                </div>
                @else
                <div class="row g-4">
                    @foreach($artikels as $artikel)
                    <div class="col-md-6">
                        <article class="artikel-card h-100">
                            @if($artikel->thumbnail)
                            <div class="artikel-thumb">
                                <img src="{{ asset('storage/' . $artikel->thumbnail) }}" alt="{{ $artikel->judul }}">
                                @if($artikel->kategori)
                                <span class="artikel-badge">{{ $artikel->kategori->nama }}</span>
                                @endif
                            </div>
                            @endif
                            <div class="artikel-body">
                                <p class="artikel-date">
                                    <i class="bi bi-calendar3 me-1"></i>
                                    {{ $artikel->published_at?->translatedFormat('d F Y') ?? '-' }}
                                </p>
                                <h5 class="artikel-title">
                                    <a href="{{ route('artikel.show', [$artikel->kategori?->slug ?? 'artikel', $artikel->slug]) }}">{{ $artikel->judul }}</a>
                                </h5>
                                <p class="artikel-desc">{{ Str::limit($artikel->ringkasan, 120) }}</p>
                                <a href="{{ route('artikel.show', [$artikel->kategori?->slug ?? 'artikel', $artikel->slug]) }}" class="btn-read-more">
                                    Selengkapnya <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </article>
                    </div>
                    @endforeach
                </div>
                <div class="mt-4">{{ $artikels->links() }}</div>
                @endif
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">
                <div class="sidebar-card mb-4">
                    <h5 class="sidebar-title">Kategori</h5>
                    <ul class="category-list">
                        @foreach($kategoris as $kat)
                        <li>
                            <a href="{{ route('artikel.kategori', $kat->slug) }}">
                                {{ $kat->nama }}
                                <span class="badge bg-primary rounded-pill">{{ $kat->artikels_count }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Appointment CTA --}}
                <div class="sidebar-cta">
                    <i class="bi bi-calendar-heart fs-1 text-primary mb-3 d-block"></i>
                    <h5>Butuh Konsultasi Dokter?</h5>
                    <p class="small text-muted">Buat appointment dengan dokter spesialis kami sekarang.</p>
                    <a href="https://wa.link/1uk9rl" target="_blank" class="btn btn-primary w-100">
                        <i class="bi bi-whatsapp me-1"></i> Buat Appointment
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
