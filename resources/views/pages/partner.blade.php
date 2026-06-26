@extends('layouts.app')
@section('title', 'Partner')
@section('content')
<div class="page-header">
    <div class="container">
        <h1 class="page-title">Partner RS Hamori</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Partner</li>
            </ol>
        </nav>
    </div>
</div>
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-badge">Kerjasama</span>
            <h2 class="section-title">Mitra Asuransi & Partner</h2>
            <p class="text-muted">RS Hamori bekerjasama dengan berbagai perusahaan asuransi dan institusi untuk kemudahan layanan Anda.</p>
        </div>
        @forelse($partners as $kategori => $items)
        <div class="mb-5">
            <h4 class="fw-bold mb-4 border-bottom pb-2">{{ $kategori }}</h4>
            <div class="row g-3">
                @foreach($items as $partner)
                <div class="col-6 col-md-3 col-lg-2">
                    <div class="partner-card">
                        @if($partner->logo)
                        <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->nama }}" class="partner-logo">
                        @else
                        <div class="partner-nama">{{ $partner->nama }}</div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @empty
        <div class="empty-state text-center py-5">
            <i class="bi bi-building display-1 text-muted"></i>
            <h4 class="mt-3">Data partner belum tersedia</h4>
        </div>
        @endforelse
    </div>
</section>

@endsection

