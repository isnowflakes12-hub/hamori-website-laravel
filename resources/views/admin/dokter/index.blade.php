@extends('admin.layouts.app')
@section('title', 'Manajemen Dokter & Jadwal')
@section('page-title', 'Dokter & Jadwal')

@section('content')

<div class="page-hd">
    <div>
        <h1 class="page-hd-title">Manajemen Dokter & Jadwal</h1>
        <p class="text-muted mb-0" style="font-size:13px;">Kelola foto & visibilitas dokter dari data Teramedik</p>
    </div>
    <div class="page-hd-action d-flex gap-2 align-items-center">
        <form action="{{ route('admin.dokter.sync') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-primary" onclick="return confirm('Sinkronisasi jadwal dengan Teramedik?')">
                <i class="bi bi-arrow-repeat me-1"></i>Sync Teramedik
            </button>
        </form>
    </div>
</div>



{{-- FILTER --}}
<div class="card mb-4" style="border-radius:14px;border:1px solid #e5eaf0;">
    <div class="card-body py-3 px-4">
        <form method="GET" action="{{ route('admin.dokter.index') }}">
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <input type="text" name="q" class="form-control form-control-sm" placeholder="Cari nama dokter..." value="{{ request('q') }}">
                </div>
                <div class="col-md-3">
                    @php
                        $reqPoli = request('poli_id');
                        $poliLabel = 'Semua Poli';
                        if ($reqPoli) {
                            $selPoli = $polis->firstWhere('id', $reqPoli);
                            if ($selPoli) $poliLabel = $selPoli->nama;
                        }
                    @endphp
                    <div class="custom-dropdown-wrapper">
                        <input type="hidden" name="poli_id" value="{{ $reqPoli }}">
                        <div class="custom-dropdown-trigger">
                            <span class="custom-dropdown-label">{{ $poliLabel }}</span>
                            <i class="bi bi-chevron-down custom-dropdown-arrow"></i>
                        </div>
                        <ul class="custom-dropdown-options-container">
                            <li class="custom-dropdown-option {{ $reqPoli == '' ? 'active' : '' }}" data-value="">Semua Poli</li>
                            @foreach($polis as $poli)
                            <li class="custom-dropdown-option {{ $reqPoli == $poli->id ? 'active' : '' }}" data-value="{{ $poli->id }}">{{ $poli->nama }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    @php
                        $reqStatus = request('status');
                        $statLabel = 'Semua Status';
                        if ($reqStatus === '1') $statLabel = 'Ditampilkan';
                        elseif ($reqStatus === '0') $statLabel = 'Disembunyikan';
                    @endphp
                    <div class="custom-dropdown-wrapper">
                        <input type="hidden" name="status" value="{{ $reqStatus }}">
                        <div class="custom-dropdown-trigger">
                            <span class="custom-dropdown-label">{{ $statLabel }}</span>
                            <i class="bi bi-chevron-down custom-dropdown-arrow"></i>
                        </div>
                        <ul class="custom-dropdown-options-container">
                            <li class="custom-dropdown-option {{ $reqStatus == '' ? 'active' : '' }}" data-value="">Semua Status</li>
                            <li class="custom-dropdown-option {{ $reqStatus === '1' ? 'active' : '' }}" data-value="1">Ditampilkan</li>
                            <li class="custom-dropdown-option {{ $reqStatus === '0' ? 'active' : '' }}" data-value="0">Disembunyikan</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2 d-flex gap-2">
                    <button type="submit" class="btn btn-primary btn-sm flex-fill">Cari</button>
                    <a href="{{ route('admin.dokter.index') }}" class="btn btn-secondary btn-sm text-white">Reset</a>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- STAT BADGES --}}
<div class="d-flex gap-3 mb-3 flex-wrap">
    <span class="badge bg-primary-subtle text-primary fw-semibold px-3 py-2" style="border-radius:20px;font-size:13px;">
        <i class="bi bi-people-fill me-1"></i>Total: {{ $total }} Dokter
    </span>
    <span class="badge bg-success-subtle text-success fw-semibold px-3 py-2" style="border-radius:20px;font-size:13px;">
        <i class="bi bi-eye-fill me-1"></i>Ditampilkan: {{ $totalAktif }}
    </span>
    <span class="badge bg-secondary-subtle text-secondary fw-semibold px-3 py-2" style="border-radius:20px;font-size:13px;">
        <i class="bi bi-eye-slash-fill me-1"></i>Disembunyikan: {{ $total - $totalAktif }}
    </span>
</div>

{{-- TABEL DOKTER --}}
<div class="card" style="border-radius:16px;border:1px solid #e5eaf0;overflow:hidden;">
    <div class="table-responsive">
        <table class="table table-hover mb-0" style="font-size:13.5px;">
            <thead style="background:#f8fafc;border-bottom:2px solid #e5eaf0;">
                <tr>
                    <th style="padding:14px 16px;font-weight:700;color:#64748b;font-size:11px;text-transform:uppercase;letter-spacing:.8px;width:50px;">#</th>
                    <th style="padding:14px 16px;font-weight:700;color:#64748b;font-size:11px;text-transform:uppercase;letter-spacing:.8px;">Foto</th>
                    <th style="padding:14px 16px;font-weight:700;color:#64748b;font-size:11px;text-transform:uppercase;letter-spacing:.8px;">Nama Dokter</th>
                    <th style="padding:14px 16px;font-weight:700;color:#64748b;font-size:11px;text-transform:uppercase;letter-spacing:.8px;">Poli / Spesialis</th>
                    <th style="padding:14px 16px;font-weight:700;color:#64748b;font-size:11px;text-transform:uppercase;letter-spacing:.8px;text-align:center;">Jadwal</th>
                    <th style="padding:14px 16px;font-weight:700;color:#64748b;font-size:11px;text-transform:uppercase;letter-spacing:.8px;text-align:center;">Tampilkan</th>
                    <th style="padding:14px 16px;font-weight:700;color:#64748b;font-size:11px;text-transform:uppercase;letter-spacing:.8px;text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dokters as $dokter)
                <tr class="{{ !$dokter->is_active ? 'table-secondary' : '' }}">
                    <td style="padding:12px 16px;color:#9ba5b4;">{{ $loop->iteration }}</td>
                    <td style="padding:12px 16px;">
                        @if($dokter->foto)
                        <img src="{{ asset('storage/'.$dokter->foto) }}" alt="{{ $dokter->nama }}"
                            style="width:44px;height:56px;object-fit:cover;object-position:top;border-radius:8px;border:1px solid #e5eaf0;">
                        @else
                        <div style="width:44px;height:56px;background:#f0f4f8;border-radius:8px;display:flex;align-items:center;justify-content:center;border:1px solid #e5eaf0;color:#9ba5b4;font-size:20px;">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        @endif
                    </td>
                    <td style="padding:12px 16px;">
                        <div style="font-weight:700;color:#1a202c;">{{ $dokter->nama_lengkap }}</div>
                        @if($dokter->teramedik_id)
                        <span class="badge bg-info-subtle text-info" style="font-size:10px;">Teramedik ID: {{ $dokter->teramedik_id }}</span>
                        @endif
                    </td>
                    <td style="padding:12px 16px;color:#64748b;">{{ $dokter->poli?->nama ?? '-' }}</td>
                    <td style="padding:12px 16px;text-align:center;">
                        <span class="badge {{ $dokter->jadwal->count() > 0 ? 'bg-success-subtle text-success' : 'bg-secondary-subtle text-secondary' }}" style="font-size:11px;border-radius:8px;">
                            {{ $dokter->jadwal->count() }} Jadwal
                        </span>
                    </td>
                    <td style="padding:12px 16px;text-align:center;">
                        <form action="{{ route('admin.dokter.toggle', $dokter) }}" method="POST">
                            @csrf @method('PATCH')
                            <button type="submit" class="btn btn-sm {{ $dokter->is_active ? 'btn-success' : 'btn-outline-secondary' }}"
                                style="border-radius:20px;padding:4px 14px;font-size:12px;font-weight:600;"
                                title="{{ $dokter->is_active ? 'Klik untuk sembunyikan' : 'Klik untuk tampilkan' }}">
                                <i class="bi {{ $dokter->is_active ? 'bi-eye-fill' : 'bi-eye-slash-fill' }} me-1"></i>
                                {{ $dokter->is_active ? 'Tampil' : 'Sembunyikan' }}
                            </button>
                        </form>
                    </td>
                    <td style="padding:12px 16px;text-align:center;">
                        <a href="{{ route('admin.dokter.edit', $dokter) }}" class="btn btn-sm btn-outline-primary" style="border-radius:8px;" title="Edit Foto & Info">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-5 text-muted">
                        <i class="bi bi-person-x display-6 d-block mb-2"></i>
                        Belum ada dokter. Klik "Sync Teramedik" untuk menarik data.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4">
    {{ $dokters->withQueryString()->links() }}
</div>

@endsection