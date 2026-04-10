@extends('layouts.app')
@section('title', 'Layanan Unggulan')
@section('content')
<div class="page-header">
    <div class="container">
        <h1 class="page-title">Layanan Unggulan</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Layanan Unggulan</li>
            </ol>
        </nav>
    </div>
</div>
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-badge">Pusat Layanan Terpadu</span>
            <h2 class="section-title">Layanan Unggulan RS Hamori</h2>
            <p class="text-muted">RS Hamori mendirikan beberapa pusat layanan terpadu yang siap memenuhi kebutuhan kesehatan Anda.</p>
        </div>
        <div class="row g-4">
            @foreach($layanans as $layanan)
            <div class="col-md-6 col-lg-4">
                <a href="{{ route('layanan.show', $layanan->slug) }}" class="layanan-unggulan-card">
                    <div class="luc-logo">
                        @if($layanan->logo)
                        <img src="{{ asset('storage/' . $layanan->logo) }}" alt="{{ $layanan->nama }}">
                        @else
                        <i class="bi bi-award text-primary" style="font-size:40px"></i>
                        @endif
                    </div>
                    <div class="luc-body">
                        <h5>{{ $layanan->nama }}</h5>
                        <p>{{ $layanan->deskripsi }}</p>
                        <span class="btn-read-more">Selengkapnya <i class="bi bi-arrow-right"></i></span>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
<style>
.layanan-unggulan-card { display: block; background: #fff; border-radius: 12px; box-shadow: var(--shadow); overflow: hidden; text-decoration: none; color: inherit; transition: transform .2s, box-shadow .2s; }
.layanan-unggulan-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-lg); color: inherit; }
.luc-logo { padding: 28px 28px 0; min-height: 80px; display: flex; align-items: center; }
.luc-logo img { max-height: 60px; max-width: 160px; object-fit: contain; }
.luc-body { padding: 16px 28px 24px; }
.luc-body h5 { font-weight: 700; margin-bottom: 8px; }
.luc-body p { font-size: 14px; color: var(--text-muted); }
</style>
@endsection
