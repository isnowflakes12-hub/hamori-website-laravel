@extends('layouts.app')
@section('title', 'Informasi Tempat Tidur')
@section('content')
<div class="page-header">
    <div class="container">
        <h1 class="page-title">Informasi Tempat Tidur</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Info Tempat Tidur</li>
            </ol>
        </nav>
    </div>
</div>
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-badge">Ketersediaan</span>
            <h2 class="section-title">Ketersediaan Tempat Tidur</h2>
            <p class="text-muted">Informasi real-time ketersediaan tempat tidur di RS Hamori</p>
        </div>
        @forelse($tempatTidur as $kelas => $data)
        <div class="mb-4">
            <h5 class="fw-bold text-primary mb-3">{{ $kelas }}</h5>
            <div class="row g-3">
                @foreach($data as $tt)
                <div class="col-md-4">
                    <div class="bed-card">
                        <div class="bed-info">
                            <div>
                                <div class="bed-kelas">{{ $tt->kelas }}</div>
                                <div class="bed-total text-muted small">Total: {{ $tt->total }} tempat tidur</div>
                            </div>
                            <div class="bed-tersedia {{ $tt->tersedia > 0 ? 'available' : 'full' }}">
                                {{ $tt->tersedia }}
                                <small>Tersedia</small>
                            </div>
                        </div>
                        <div class="progress mt-3" style="height: 8px;">
                            <div class="progress-bar {{ $tt->persentase_terisi > 80 ? 'bg-danger' : ($tt->persentase_terisi > 60 ? 'bg-warning' : 'bg-success') }}"
                                style="width: {{ $tt->persentase_terisi }}%"></div>
                        </div>
                        <small class="text-muted">{{ $tt->persentase_terisi }}% terisi</small>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @empty
        <div class="empty-state text-center py-5">
            <i class="bi bi-hospital display-1 text-muted"></i>
            <h4 class="mt-3">Data tidak tersedia</h4>
        </div>
        @endforelse
    </div>
</section>
<style>
.bed-card { background: #fff; border-radius: 12px; padding: 20px; box-shadow: var(--shadow); }
.bed-info { display: flex; justify-content: space-between; align-items: flex-start; }
.bed-kelas { font-weight: 700; }
.bed-tersedia { text-align: center; font-size: 1.8rem; font-weight: 800; line-height: 1; }
.bed-tersedia small { display: block; font-size: 10px; font-weight: 500; }
.bed-tersedia.available { color: #00a859; }
.bed-tersedia.full { color: #e8333c; }
</style>
@endsection
