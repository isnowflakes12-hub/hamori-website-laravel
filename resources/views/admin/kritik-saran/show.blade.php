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
                        <h5 class="mb-0 fw-bold">{{ $kritik_saran->nama }}</h5>`n                        <div class="mb-1">`n                            <span class="badge bg-info" style="font-size:10px;text-transform:uppercase">{{ $kritik_saran->responden ?? '-' }}</span>`n                            @if($kritik_saran->nama_poliklinik)<span class="badge bg-secondary" style="font-size:10px">{{ $kritik_saran->nama_poliklinik }}</span>@endif`n                        </div>
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

            @php
                $allRatings = [
                    'Kepuasan Rumah Sakit' => $kritik_saran->rating_kepuasan_rs,
                    'Alur Pelayanan'       => $kritik_saran->rating_alur_pelayanan,
                    'Fasilitas'            => $kritik_saran->rating_fasilitas,
                    'Kesesuaian Biaya'     => $kritik_saran->rating_kesesuaian_biaya,
                    'Pelayanan Dokter'     => $kritik_saran->rating_pelayanan_dokter,
                    'Pelayanan Perawat'    => $kritik_saran->rating_pelayanan_perawat,
                ];
                $penunjangRatings = [
                    'Laboratorium' => $kritik_saran->rating_laboratorium,
                    'Radiologi'    => $kritik_saran->rating_radiologi,
                    'Fisioterapi'  => $kritik_saran->rating_fisioterapi,
                    'Farmasi'      => $kritik_saran->rating_farmasi,
                ];
            @endphp
            <div class="mb-4">
                <h6 class="fw-bold text-muted mb-3">Penilaian Layanan:</h6>
                <div class="row g-2">
                    @foreach($allRatings as $label => $val)
                    <div class="col-md-6">
                        <div class="p-2 border rounded bg-light d-flex justify-content-between align-items-center">
                            <span style="font-size:13px;font-weight:600">{{ $label }}</span>
                            <span>
                                @if($val)
                                    @for($s=1;$s<=5;$s++)
                                        <i class="fas fa-star" style="color:{{ $s <= $val ? '#f59e0b' : '#e2e8f0' }};font-size:14px"></i>
                                    @endfor
                                    <small class="ms-1 text-muted">({{ $val }}/5)</small>
                                @else
                                    <span class="text-muted" style="font-size:12px">-</span>
                                @endif
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Pelayanan Penunjang --}}
                <div class="mt-3 p-3 border rounded" style="background:#f8f9fa;">
                    <p class="fw-bold mb-2" style="font-size:13px;color:#475569">
                        <i class="bi bi-hospital me-1"></i> Pelayanan Penunjang
                    </p>
                    <div class="row g-2">
                        @foreach($penunjangRatings as $label => $val)
                        <div class="col-md-6">
                            <div class="p-2 border rounded bg-white d-flex justify-content-between align-items-center">
                                <span style="font-size:13px;font-weight:600">{{ $label }}</span>
                                <span>
                                    @if($val)
                                        @for($s=1;$s<=5;$s++)
                                            <i class="fas fa-star" style="color:{{ $s <= $val ? '#f59e0b' : '#e2e8f0' }};font-size:14px"></i>
                                        @endfor
                                        <small class="ms-1 text-muted">({{ $val }}/5)</small>
                                    @else
                                        <span class="text-muted" style="font-size:12px">-</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

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

