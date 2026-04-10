@extends('admin.layouts.app')
@section('title','Promo')
@section('page-title','Manajemen Promo')

@section('content')
<div class="page-hd">
    <div>
        <h1 class="page-hd-title">Promo & Penawaran</h1>
        <p class="page-hd-sub">Kelola promosi dan penawaran spesial RS Hamori</p>
    </div>
    <a href="{{ route('admin.promo.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-2"></i>Tambah Promo
    </a>
</div>

{{-- Filter --}}
<div class="filter-bar">
    <form method="GET" class="d-flex gap-2 flex-wrap w-100">
        <input type="text" name="search" class="form-control" style="max-width:240px"
               placeholder="Cari judul promo..." value="{{ request('search') }}">
        <select name="status" class="form-select" style="max-width:160px">
            <option value="">Semua Status</option>
            <option value="aktif"    {{ request('status')=='aktif'    ? 'selected':'' }}>Aktif</option>
            <option value="nonaktif" {{ request('status')=='nonaktif' ? 'selected':'' }}>Nonaktif</option>
        </select>
        <button class="btn btn-primary" type="submit">Filter</button>
        @if(request()->hasAny(['search','status']))
        <a href="{{ route('admin.promo.index') }}" class="btn btn-outline-secondary">Reset</a>
        @endif
    </form>
</div>

{{-- Promo Cards Grid --}}
@if($promos->isEmpty())
<div class="text-center py-5">
    <i class="bi bi-gift" style="font-size:3rem;color:#d1d5db;display:block;margin-bottom:16px"></i>
    <h5 style="color:#374151">Belum ada promo</h5>
    <p class="text-muted" style="font-size:14px">Tambahkan promo pertama Anda</p>
    <a href="{{ route('admin.promo.create') }}" class="btn btn-primary mt-2">Tambah Promo</a>
</div>
@else
<div class="row g-4 mb-4">
    @foreach($promos as $p)
    <div class="col-md-6 col-xl-4">
        <div class="promo-admin-card">
            {{-- Gambar --}}
            <div class="pac-img">
                @if($p->gambar)
                    <img src="{{ asset('storage/'.$p->gambar) }}" alt="{{ $p->judul }}">
                @else
                    <div class="pac-img-placeholder">
                        <i class="bi bi-gift-fill"></i>
                    </div>
                @endif
                {{-- Badges --}}
                <div class="pac-badges">
                    @if($p->is_featured)
                    <span class="pac-badge-featured"><i class="bi bi-star-fill"></i> Unggulan</span>
                    @endif
                    <span class="pac-badge-status bg-{{ $p->getStatusColor() }}">{{ $p->getStatusLabel() }}</span>
                </div>
                @if($p->diskon)
                <div class="pac-disc-badge">{{ $p->diskon }}</div>
                @endif
            </div>

            {{-- Body --}}
            <div class="pac-body">
                <h5 class="pac-title">{{ $p->judul }}</h5>
                @if($p->harga_promo)
                <div class="pac-price">
                    @if($p->harga_normal)<span class="pac-price-old">{{ $p->harga_normal }}</span>@endif
                    <span class="pac-price-new">{{ $p->harga_promo }}</span>
                </div>
                @endif
                @if($p->berlaku_sampai)
                <div class="pac-expire {{ $p->isExpired() ? 'pac-expire-red' : '' }}">
                    <i class="bi bi-calendar-event"></i>
                    Berlaku s/d {{ $p->berlaku_sampai->format('d M Y') }}
                    @if($p->isExpired())<span class="ms-1">(Kedaluwarsa)</span>@endif
                </div>
                @endif
            </div>

            {{-- Actions --}}
            <div class="pac-actions">
                {{-- Toggle Featured --}}
                <form method="POST" action="{{ route('admin.promo.featured', $p) }}" class="d-inline">
                    @csrf @method('PATCH')
                    <button type="submit" class="pac-btn pac-btn-star {{ $p->is_featured ? 'active' : '' }}"
                            title="{{ $p->is_featured ? 'Hapus dari unggulan' : 'Jadikan unggulan' }}">
                        <i class="bi bi-star{{ $p->is_featured ? '-fill' : '' }}"></i>
                    </button>
                </form>
                {{-- Toggle Active --}}
                <form method="POST" action="{{ route('admin.promo.toggle', $p) }}" class="d-inline">
                    @csrf @method('PATCH')
                    <button type="submit" class="pac-btn pac-btn-toggle {{ $p->is_active ? 'active' : '' }}"
                            title="{{ $p->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                        <i class="bi bi-toggle-{{ $p->is_active ? 'on' : 'off' }}"></i>
                    </button>
                </form>
                <a href="{{ route('admin.promo.edit', $p) }}" class="pac-btn" title="Edit">
                    <i class="bi bi-pencil"></i>
                </a>
                <form method="POST" action="{{ route('admin.promo.destroy', $p) }}" class="d-inline"
                      onsubmit="return confirm('Hapus promo {{ $p->judul }}?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="pac-btn pac-btn-del" title="Hapus">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="d-flex justify-content-center">{{ $promos->links() }}</div>
@endif

@endsection

@push('styles')
<style>
.promo-admin-card{background:#fff;border-radius:16px;border:1px solid #e2e8f0;overflow:hidden;transition:transform .22s,box-shadow .22s}
.promo-admin-card:hover{transform:translateY(-3px);box-shadow:0 12px 32px rgba(0,0,0,.1)}
.pac-img{position:relative;height:180px;overflow:hidden;background:#f1f5f9}
.pac-img img{width:100%;height:100%;object-fit:cover;transition:transform .4s}
.promo-admin-card:hover .pac-img img{transform:scale(1.04)}
.pac-img-placeholder{width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:3rem;color:#94a3b8;background:linear-gradient(135deg,#e2e8f0,#f1f5f9)}
.pac-badges{position:absolute;top:10px;left:10px;display:flex;gap:6px;flex-wrap:wrap}
.pac-badge-featured{background:#f59e0b;color:#fff;font-size:10px;font-weight:700;padding:3px 8px;border-radius:100px}
.pac-badge-status{font-size:10px;font-weight:700;padding:3px 8px;border-radius:100px;color:#fff}
.pac-disc-badge{position:absolute;top:10px;right:10px;background:#d93025;color:#fff;font-size:11px;font-weight:800;padding:5px 10px;border-radius:100px}
.pac-body{padding:16px 18px 12px}
.pac-title{font-size:14.5px;font-weight:700;color:#0f172a;margin:0 0 8px;line-height:1.35}
.pac-price{display:flex;align-items:baseline;gap:8px;margin-bottom:8px}
.pac-price-old{font-size:12px;color:#94a3b8;text-decoration:line-through}
.pac-price-new{font-size:1.1rem;font-weight:800;color:#005bab}
.pac-expire{font-size:11.5px;color:#64748b;display:flex;align-items:center;gap:5px}
.pac-expire-red{color:#d93025}
.pac-actions{display:flex;gap:6px;padding:10px 18px 16px;border-top:1px solid #f1f5f9}
.pac-btn{width:34px;height:34px;border-radius:8px;border:1px solid #e2e8f0;background:#f8fafc;color:#64748b;display:flex;align-items:center;justify-content:center;font-size:15px;cursor:pointer;transition:all .2s;text-decoration:none}
.pac-btn:hover{background:#e2e8f0;color:#0f172a}
.pac-btn-star.active{background:#fffbeb;color:#f59e0b;border-color:#fde68a}
.pac-btn-star.active:hover{background:#fef3c7}
.pac-btn-toggle.active{background:#f0fdf4;color:#16a34a;border-color:#bbf7d0}
.pac-btn-del:hover{background:#fce8e6;color:#d93025;border-color:#fca5a5}
</style>
@endpush
