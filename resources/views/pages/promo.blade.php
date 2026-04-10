@extends('layouts.app')
@section('title','Promo & Penawaran Spesial')

@section('content')
<div class="page-header">
    <div class="container">
        <h1 class="page-title"><i class="bi bi-gift-fill me-2" style="font-size:.85em"></i>Promo & Penawaran Spesial</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Promo</li>
            </ol>
        </nav>
    </div>
</div>

<section class="sec">
    <div class="sec-cont">
        @if($promos->isEmpty())
        <div class="text-center py-5">
            <i class="bi bi-gift" style="font-size:4rem;color:#e2e8f0;display:block;margin-bottom:16px"></i>
            <h4 style="color:#374151">Belum ada promo aktif saat ini</h4>
            <p class="text-muted">Pantau terus halaman ini untuk penawaran terbaru.</p>
            <a href="{{ route('home') }}" class="btn btn-primary mt-3">Kembali ke Beranda</a>
        </div>
        @else
        <div class="promo-grid">
            @foreach($promos as $p)
            <div class="promo-card {{ $p->is_featured ? 'promo-card-featured' : '' }}">
                @if($p->gambar)
                <div class="promo-card-img">
                    <img src="{{ asset('storage/'.$p->gambar) }}" alt="{{ $p->judul }}" loading="lazy">
                    @if($p->diskon)<div class="promo-card-disc">{{ $p->diskon }}</div>@endif
                    @if($p->is_featured)<div class="promo-card-featured-badge">⭐ Unggulan</div>@endif
                </div>
                @endif
                <div class="promo-card-body">
                    <h4 class="promo-card-title">{{ $p->judul }}</h4>
                    @if($p->deskripsi)
                    <p class="promo-card-desc">{{ $p->deskripsi }}</p>
                    @endif
                    @if($p->benefit && count($p->benefit) > 0)
                    <ul class="promo-card-list">
                        @foreach($p->benefit as $b)
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
                        <i class="bi bi-calendar-event"></i>
                        Berlaku hingga {{ $p->berlaku_sampai->format('d M Y') }}
                    </div>
                    @endif
                    <div class="promo-card-actions">
                        <a href="{{ $p->link_wa ?? 'https://wa.link/1uk9rl' }}" target="_blank" class="pca-wa">
                            <i class="bi bi-whatsapp"></i> Daftar Sekarang
                        </a>
                        @if($p->link_daftar)
                        <a href="{{ $p->link_daftar }}" class="pca-detail">
                            Detail <i class="bi bi-arrow-right"></i>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>
@endsection
