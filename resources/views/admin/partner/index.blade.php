@extends('admin.layouts.app')

@section('title', 'Manajemen Partner & Mitra')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1">Manajemen Partner & Mitra</h4>
        <p class="text-muted mb-0">Kelola daftar asuransi, perusahaan, dan mitra kerja sama lainnya.</p>
    </div>
    <a href="{{ route('admin.partner.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i> Tambah Partner
    </a>
</div>

{{-- Stats --}}
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body d-flex align-items-center">
                <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px;">
                    <i class="bi bi-building fs-4"></i>
                </div>
                <div>
                    <h6 class="mb-0 text-muted">Total Partner</h6>
                    <h3 class="mb-0 fw-bold">{{ $stats['total'] }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body d-flex align-items-center">
                <div class="bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px;">
                    <i class="bi bi-eye-fill fs-4"></i>
                </div>
                <div>
                    <h6 class="mb-0 text-muted">Tampil di Publik</h6>
                    <h3 class="mb-0 fw-bold">{{ $stats['active'] }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body d-flex align-items-center">
                <div class="bg-secondary bg-opacity-10 text-secondary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px;">
                    <i class="bi bi-eye-slash-fill fs-4"></i>
                </div>
                <div>
                    <h6 class="mb-0 text-muted">Disembunyikan</h6>
                    <h3 class="mb-0 fw-bold">{{ $stats['hidden'] }}</h3>
                </div>
            </div>
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
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
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
                                <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->nama }}" class="img-thumbnail" style="width: 80px; height: 50px; object-fit: contain; background: #f8f9fa;">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center text-muted" style="width: 80px; height: 50px;">
                                    <i class="bi bi-building fs-5"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <h6 class="mb-1 text-dark">{{ $partner->nama }}</h6>
                            @if($partner->website)
                                <a href="{{ $partner->website }}" target="_blank" class="text-decoration-none small text-muted">
                                    <i class="bi bi-link-45deg"></i> Kunjungi Website
                                </a>
                            @else
                                <span class="small text-muted fst-italic">Tanpa website</span>
                            @endif
                        </td>
                        <td>
                            @if($partner->kategori)
                                <span class="badge bg-info text-dark">{{ $partner->kategori }}</span>
                            @else
                                <span class="text-muted small">-</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('admin.partner.toggle', $partner) }}" method="POST" class="d-inline">
                                @csrf @method('PATCH')
                                <button type="submit" class="btn btn-sm rounded-pill px-3 {{ $partner->is_active ? 'btn-success bg-opacity-10 text-success border-success' : 'btn-secondary bg-opacity-10 text-secondary border-secondary' }}"
                                        data-bs-toggle="tooltip" title="Klik untuk ubah status">
                                    <i class="bi {{ $partner->is_active ? 'bi-eye-fill' : 'bi-eye-slash-fill' }} me-1"></i>
                                    {{ $partner->is_active ? 'Tampil' : 'Sembunyi' }}
                                </button>
                            </form>
                        </td>
                        <td class="text-end pe-4">
                            <a href="{{ route('admin.partner.edit', $partner) }}" class="btn btn-sm btn-light text-primary me-1" data-bs-toggle="tooltip" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('admin.partner.destroy', $partner) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus partner ini?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light text-danger" data-bs-toggle="tooltip" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <div class="text-muted">
                                <i class="bi bi-building-slash display-4 mb-3 d-block"></i>
                                <h5>Belum Ada Data Partner</h5>
                                <p>Silakan tambahkan data partner atau mitra baru.</p>
                                <a href="{{ route('admin.partner.create') }}" class="btn btn-primary mt-2">
                                    <i class="bi bi-plus-lg me-1"></i> Tambah Partner
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($partners->hasPages())
    <div class="card-footer bg-white border-top py-3">
        {{ $partners->links() }}
    </div>
    @endif
</div>
@endsection
