@extends('admin.layouts.app')

@section('title', 'Manajemen Partner & Mitra')

@section('content')
<div class="page-hd">
    <div>
        <h1 class="page-hd-title">Partner & Mitra</h1>
        <p class="page-hd-sub">Kelola daftar asuransi, perusahaan, dan mitra kerja sama lainnya.</p>
    </div>
    <a href="{{ route('admin.partner.create') }}" class="btn btn-sm btn-primary">
        <i class="bi bi-plus-lg me-1"></i> Tambah Partner
    </a>
</div>

{{-- Stat Cards --}}
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon" style="background:#e0e7ff;color:#4f46e5"><i class="bi bi-building"></i></div>
            <div class="stat-num">{{ $stats['total'] }}</div>
            <div class="stat-label">Total Partner</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon" style="background:#dcfce7;color:#15803d"><i class="bi bi-eye-fill"></i></div>
            <div class="stat-num">{{ $stats['active'] }}</div>
            <div class="stat-label">Tampil Publik</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon" style="background:#fef3c7;color:#d97706"><i class="bi bi-eye-slash-fill"></i></div>
            <div class="stat-num">{{ $stats['hidden'] }}</div>
            <div class="stat-label">Disembunyikan</div>
        </div>
    </div>
</div>

{{-- Filters --}}
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-3">
        <form action="{{ route('admin.partner.index') }}" method="GET" class="row g-2 align-items-center">
            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-text bg-white text-muted border-end-0">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" class="form-control border-start-0 ps-0" name="search" value="{{ request('search') }}" placeholder="Cari nama atau kategori partner...">
                </div>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select" onchange="this.form.submit()">
                    <option value="">Semua Status</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Tampil Publik</option>
                    <option value="hidden" {{ request('status') === 'hidden' ? 'selected' : '' }}>Sembunyi</option>
                </select>
            </div>
            <div class="col-md-4 text-md-end">
                @if(request()->hasAny(['search', 'status']))
                    <a href="{{ route('admin.partner.index') }}" class="btn btn-light text-muted">Reset Filter</a>
                @endif
                <button type="submit" class="btn btn-secondary d-md-none">Filter</button>
            </div>
        </form>
    </div>
</div>

{{-- Data Table --}}
<div class="admin-table">
    <table class="table table-borderless table-hover align-middle mb-0" style="font-size:13px;">
        <thead class="table-light">
            <tr>
                <th class="ps-4">Logo</th>
                <th>Info Partner</th>
                <th>Kategori</th>
                <th>Status</th>
                <th class="text-end pe-4">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($partners as $partner)
            <tr>
                <td class="ps-4" style="width: 100px;">
                    @if($partner->logo)
                        <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->nama }}" style="width: 70px; height: 44px; object-fit: contain; border-radius: 6px; background: #fff; border: 1px solid #e2e8f0;">
                    @else
                        <div style="width: 70px; height: 44px; border-radius: 6px; background: #f1f5f9; display: flex; align-items: center; justify-content: center; color: #94a3b8; border: 1px dashed #cbd5e1;">
                            <i class="bi bi-building fs-5"></i>
                        </div>
                    @endif
                </td>
                <td>
                    <div class="fw-bold" style="color: #1e293b; font-size: 14px;">{{ $partner->nama }}</div>
                    @if($partner->website)
                        <a href="{{ $partner->website }}" target="_blank" class="text-decoration-none" style="font-size: 12px; color: #3b82f6;">
                            <i class="bi bi-link-45deg"></i> Kunjungi Website
                        </a>
                    @else
                        <span style="font-size: 11px; color: #94a3b8;">Tanpa website</span>
                    @endif
                </td>
                <td>
                    @if($partner->kategori)
                        <span class="badge" style="background: #f0f9ff; color: #0284c7; border: 1px solid #bae6fd; font-weight: 600; padding: 4px 8px;">{{ $partner->kategori }}</span>
                    @else
                        <span class="text-muted small">-</span>
                    @endif
                </td>
                <td>
                    <form action="{{ route('admin.partner.toggle', $partner) }}" method="POST" class="d-inline">
                        @csrf @method('PATCH')
                        <button type="submit" class="btn btn-sm rounded-pill px-3" style="font-size: 11.5px; font-weight: 600; border: none; {{ $partner->is_active ? 'background:#dcfce7;color:#166534;' : 'background:#f1f5f9;color:#475569;' }}"
                                data-bs-toggle="tooltip" title="Klik untuk ubah status">
                            <i class="bi {{ $partner->is_active ? 'bi-eye-fill' : 'bi-eye-slash-fill' }} me-1"></i>
                            {{ $partner->is_active ? 'Tampil' : 'Sembunyi' }}
                        </button>
                    </form>
                </td>
                <td class="text-end pe-4">
                    <a href="{{ route('admin.partner.edit', $partner) }}" class="btn btn-sm btn-outline-secondary border-0 text-primary me-1" data-bs-toggle="tooltip" title="Edit">
                        <i class="bi bi-pencil-square fs-6"></i>
                    </a>
                    <form action="{{ route('admin.partner.destroy', $partner) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus partner ini?');">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-secondary border-0 text-danger" data-bs-toggle="tooltip" title="Hapus">
                            <i class="bi bi-trash fs-6"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center py-5">
                    <div class="text-muted">
                        <i class="bi bi-building-slash display-4 mb-3 d-block" style="color: #cbd5e1;"></i>
                        <h5 class="fw-bold" style="color: #475569;">Belum Ada Data Partner</h5>
                        <p style="font-size: 13px;">Silakan tambahkan data partner atau mitra baru.</p>
                        <a href="{{ route('admin.partner.create') }}" class="btn btn-sm btn-primary mt-2">
                            <i class="bi bi-plus-lg me-1"></i> Tambah Partner
                        </a>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    @if($partners->hasPages())
    <div class="p-3 border-top bg-white" style="border-radius: 0 0 12px 12px;">
        {{ $partners->links() }}
    </div>
    @endif
</div>

<style>
.admin-table { border-radius: 12px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,.08); background: #fff; }
.admin-table table thead th { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: .04em; color: #64748b; padding: 12px; border-bottom: 2px solid #f1f5f9; white-space: nowrap; }
.admin-table table tbody td { padding: 14px 12px; border-bottom: 1px solid #f8fafc; vertical-align: middle; }
.admin-table table tbody tr:hover td { background: #f8fafc !important; }
</style>
@endsection
