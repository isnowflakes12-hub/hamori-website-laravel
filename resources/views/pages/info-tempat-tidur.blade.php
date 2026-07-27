@extends('layouts.app')

@section('title', 'Info Ketersediaan Tempat Tidur - RS Hamori')
@section('meta_description', 'Informasi real-time ketersediaan tempat tidur dan ruang rawat inap di Rumah Sakit Hamori Subang.')

@push('styles')
<style>
    .bed-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid rgba(0,0,0,0.05);
        box-shadow: 0 10px 30px rgba(0,0,0,0.04);
        padding: 24px;
        height: 100%;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    .bed-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,85,165,0.1);
        border-color: rgba(0,85,165,0.2);
    }
    .bed-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; width: 4px; height: 100%;
        background: var(--primary-color);
        opacity: 0;
        transition: 0.3s;
    }
    .bed-card:hover::before { opacity: 1; }
    
    .bed-kelas {
        font-size: 20px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 4px;
    }
    .bed-ruangan {
        font-size: 14px;
        color: #64748b;
        margin-bottom: 20px;
    }
    .bed-stats {
        display: flex;
        gap: 12px;
    }
    .stat-box {
        flex: 1;
        background: #f8fafc;
        border-radius: 12px;
        padding: 16px 12px;
        text-align: center;
    }
    .stat-box.available {
        background: #ecfdf5;
    }
    .stat-box.full {
        background: #fff1f2;
    }
    .stat-label {
        font-size: 12px;
        color: #64748b;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }
    .stat-value {
        font-size: 24px;
        font-weight: 800;
        color: var(--text-dark);
        line-height: 1;
    }
    .stat-box.available .stat-label { color: #059669; }
    .stat-box.available .stat-value { color: #059669; }
    
    .stat-box.full .stat-label { color: #e11d48; }
    .stat-box.full .stat-value { color: #e11d48; }
    
    .update-time {
        text-align: center;
        font-size: 14px;
        color: #64748b;
        margin-top: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }
</style>
@endpush

@section('content')
<div class="page-header">
    <div class="container">
        <h1 class="page-title">Info Tempat Tidur</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Info Tempat Tidur</li>
            </ol>
        </nav>
    </div>
</div>

<section class="py-5" style="background: #f8fafc; min-height: 50vh;">
    <div class="container">
        
        <div class="row g-4 justify-content-center">
            @forelse($beds as $bed)
            <div class="col-md-6 col-lg-4">
                <div class="bed-card">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <div class="bed-kelas">{{ $bed->kelas }}</div>
                            <div class="bed-ruangan">{{ $bed->nama_ruangan ?? 'Ruang Rawat Inap' }}</div>
                        </div>
                        <div style="width: 48px; height: 48px; background: #e0f2fe; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #0284c7; font-size: 24px;">
                            <i class="bi bi-hospital"></i>
                        </div>
                    </div>
                    
                    <div class="bed-stats">
                        <div class="stat-box">
                            <div class="stat-label">Kapasitas</div>
                            <div class="stat-value">{{ $bed->kapasitas }}</div>
                        </div>
                        <div class="stat-box {{ $bed->tersedia > 0 ? 'available' : 'full' }}">
                            <div class="stat-label">Tersedia</div>
                            <div class="stat-value">{{ $bed->tersedia }}</div>
                        </div>
                    </div>
                    
                    @if($bed->tersedia == 0)
                    <div class="mt-3 text-center" style="font-size: 13px; color: #e11d48; font-weight: 500; background: #fff1f2; padding: 6px; border-radius: 6px;">
                        <i class="bi bi-exclamation-circle me-1"></i> Penuh
                    </div>
                    @else
                    <div class="mt-3 text-center" style="font-size: 13px; color: #059669; font-weight: 500; background: #ecfdf5; padding: 6px; border-radius: 6px;">
                        <i class="bi bi-check-circle me-1"></i> Tersedia
                    </div>
                    @endif
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <div style="width: 80px; height: 80px; background: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
                    <i class="bi bi-info-circle text-muted" style="font-size: 32px;"></i>
                </div>
                <h4 class="text-muted">Data tempat tidur belum tersedia.</h4>
            </div>
            @endforelse
        </div>
        
        @if($beds->count() > 0)
        <div class="update-time">
            <i class="bi bi-clock-history"></i>
            Terakhir diperbarui: <strong>{{ \Carbon\Carbon::parse($beds->max('updated_at'))->isoFormat('dddd, D MMMM Y - HH:mm') }} WIB</strong>
        </div>
        @endif

    </div>
</section>
@endsection
