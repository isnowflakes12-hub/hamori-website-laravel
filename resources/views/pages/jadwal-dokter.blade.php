@extends('layouts.app')

@section('title', 'Jadwal Dokter')

@section('content')

<div class="page-header">
    <div class="container">
        <h1 class="page-title">Jadwal Dokter</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Jadwal Dokter</li>
            </ol>
        </nav>
    </div>
</div>

<section class="py-5">
    <div class="container">
        {{-- Filter --}}
        <div class="filter-card mb-4">
            <form method="GET" action="{{ route('dokter.index') }}">
                <div class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Nama Dokter</label>
                        <input type="text" name="nama" class="form-control" placeholder="Cari nama dokter..." value="{{ request('nama') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Poli / Spesialis</label>
                        <select name="poli" class="form-select">
                            <option value="">Semua Poli</option>
                            @foreach($polis as $poli)
                            <option value="{{ $poli->id }}" {{ request('poli') == $poli->id ? 'selected' : '' }}>{{ $poli->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Hari Praktek</label>
                        <select name="hari" class="form-select">
                            <option value="">Semua Hari</option>
                            @foreach($haris as $hari)
                            <option value="{{ $hari }}" {{ request('hari') == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search me-1"></i> Cari
                        </button>
                    </div>
                </div>
            </form>
        </div>

        {{-- Results --}}
        @if($dokters->isEmpty())
        <div class="empty-state text-center py-5">
            <i class="bi bi-person-x display-1 text-muted"></i>
            <h4 class="mt-3">Tidak ada dokter ditemukan</h4>
            <p class="text-muted">Coba ubah filter pencarian Anda</p>
            <a href="{{ route('dokter.index') }}" class="btn btn-outline-primary">Reset Pencarian</a>
        </div>
        @else
        <div class="row g-4">
            @foreach($dokters as $dokter)
            <div class="col-md-6 col-xl-4">
                <div class="dokter-card">
                    <div class="dokter-photo">
                        @if($dokter->foto)
                        <img src="{{ asset('storage/' . $dokter->foto) }}" alt="{{ $dokter->nama }}">
                        @else
                        <div class="dokter-photo-placeholder">
                            <i class="bi bi-person-circle"></i>
                        </div>
                        @endif
                    </div>
                    <div class="dokter-info">
                        <p class="dokter-spesialis">{{ $dokter->poli?->nama ?? $dokter->spesialisasi }}</p>
                        <h5 class="dokter-nama">{{ $dokter->nama_lengkap }}</h5>
                        @if($dokter->jadwal->count())
                        <div class="dokter-jadwal">
                            @foreach($dokter->jadwal as $jadwal)
                            <div class="jadwal-item">
                                <span class="jadwal-hari">{{ $jadwal->hari }}</span>
                                <span class="jadwal-jam">{{ substr($jadwal->jam_mulai, 0, 5) }} - {{ substr($jadwal->jam_selesai, 0, 5) }}</span>
                            </div>
                            @endforeach
                        </div>
                        @endif
                        <a href="https://wa.me/{{ \App\Models\SiteSetting::get('phone_whatsapp', '6281111121705') }}" target="_blank" class="btn btn-primary btn-sm w-100 mt-3">
                            <i class="bi bi-calendar-check me-1"></i> Chat via WhatsApp
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $dokters->withQueryString()->links() }}
        </div>
        @endif
    </div>
</section>

@endsection
