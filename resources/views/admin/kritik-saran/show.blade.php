@extends('admin.layouts.app')
@section('title','Detail Kritik & Saran')
@section('page-title','Detail Kritik & Saran')
@section('content')
<div class="page-hd">
    <div><h1 class="page-hd-title">Detail Pesan</h1></div>
    <a href="{{ route('admin.kritik-saran.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="form-card">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                <div class="d-flex align-items-center gap-3">
                    <div style="width:50px;height:50px;border-radius:50%;background:var(--primary);color:#fff;display:flex;align-items:center;justify-content:center;font-size:20px;font-weight:bold">
                        {{ strtoupper(substr($kritik_saran->nama, 0, 1)) }}
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold">{{ $kritik_saran->nama }}</h5>
                        <div class="text-muted" style="font-size:13px">{{ $kritik_saran->email ?? '-' }} &bull; {{ $kritik_saran->telepon ?? '-' }}</div>
                    </div>
                </div>
                <div class="text-end">
                    <div style="font-size:12px;color:#94a3b8">{{ $kritik_saran->created_at->format('d M Y, H:i') }}</div>
                    <span class="badge bg-secondary mt-1" style="text-transform:uppercase">{{ $kritik_saran->kategori }}</span>
                </div>
            </div>

            <div class="mb-4">
                <h6 class="fw-bold text-muted mb-2">Pesan:</h6>
                <div class="p-4 rounded bg-light" style="font-size:15px;line-height:1.7;color:#334155;white-space:pre-wrap">{{ $kritik_saran->pesan }}</div>
            </div>

            @if($kritik_saran->rating)
            <div class="mb-4">
                <h6 class="fw-bold text-muted mb-2">Rating Diberikan:</h6>
                <span style="color:#f59e0b;font-size:24px">{{ str_repeat('★', $kritik_saran->rating) }}</span>
                <span style="color:#e2e8f0;font-size:24px">{{ str_repeat('★', 5 - $kritik_saran->rating) }}</span>
            </div>
            @endif

            <hr>
            
            <div class="d-flex gap-2">
                @if($kritik_saran->status === 'pending')
                <form method="POST" action="{{ route('admin.kritik-saran.status', $kritik_saran) }}" class="d-inline">@csrf @method('PATCH')
                    <input type="hidden" name="status" value="approved">
                    <button class="btn btn-success"><i class="bi bi-check-lg me-2"></i>Setujui</button>
                </form>
                <form method="POST" action="{{ route('admin.kritik-saran.status', $kritik_saran) }}" class="d-inline">@csrf @method('PATCH')
                    <input type="hidden" name="status" value="rejected">
                    <button class="btn btn-danger"><i class="bi bi-x-lg me-2"></i>Tolak</button>
                </form>
                @elseif($kritik_saran->status === 'approved')
                <button class="btn btn-success" disabled><i class="bi bi-check-circle-fill me-2"></i>Sudah Disetujui</button>
                @else
                <button class="btn btn-danger" disabled><i class="bi bi-x-circle-fill me-2"></i>Ditolak</button>
                @endif
            </div>

        </div>
    </div>
</div>
@endsection
