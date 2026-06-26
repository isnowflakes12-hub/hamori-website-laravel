@extends('admin.layouts.app')
@section('title','Promo')
@section('page-title','Manajemen Promo')
@section('content')

<div class="page-hd">
    <div>
        <h1 class="page-hd-title">Promo & Penawaran</h1>
        <p class="page-hd-sub">Maksimal <strong>3 promo unggulan</strong> yang ditampilkan di website</p>
    </div>
    <a href="{{ route('admin.promo.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-2"></i>Tambah Promo
    </a>
</div>

{{-- Featured status bar --}}
@php $featuredCount = $featured->count(); $maxFeatured = 3; @endphp
<div class="alert mb-4 d-flex align-items-center gap-3"
     style="background:{{ $featuredCount >= $maxFeatured ? '#fef2f2' : '#f0fdf4' }};border-radius:12px;border:none">
    <div style="font-size:22px">{{ $featuredCount >= $maxFeatured ? '⚠️' : '✅' }}</div>
    <div class="flex-grow-1">
        <strong>Promo Unggulan: {{ $featuredCount }}/{{ $maxFeatured }}</strong>
        @if($featuredCount > 0)
        <div style="font-size:13px;color:#64748b;margin-top:2px">
            {{ $featured->pluck('judul')->implode(' · ') }}
        </div>
        @endif
        @if($featuredCount >= $maxFeatured)
        <div style="font-size:13px;color:#d93025;margin-top:2px">Slot penuh — hapus salah satu ⭐ untuk menambah promo unggulan baru.</div>
        @endif
    </div>
    {{-- Tombol Batalkan Semua Unggulan --}}
    @if($featuredCount > 0)
    <form method="POST" action="{{ route('admin.promo.clear-featured') }}" onsubmit="return confirm('Batalkan semua status unggulan?')">
        @csrf
        <button type="submit" class="btn btn-sm btn-outline-danger">
            <i class="bi bi-x-circle me-1"></i>Batalkan Semua Unggulan
        </button>
    </form>
    @endif
</div>

{{-- Hidden form untuk bulk submit — terpisah dari tabel agar tidak nested --}}
<form method="POST" action="{{ route('admin.promo.bulk-featured') }}" id="bulkFeaturedForm">
    @csrf
    <div id="bulkHiddenIds"></div>{{-- JS akan inject hidden inputs ke sini --}}
</form>

{{-- Bulk Action Bar --}}
<div id="bulkActionBar" class="d-none mb-3 p-3 align-items-center gap-3" style="background:#eff6ff;border-radius:12px;border:1px solid #bfdbfe;">
    <i class="bi bi-star-fill text-warning"></i>
    <span id="bulkSelectedCount" class="fw-semibold" style="font-size:14px">0 promo dipilih (maks. 3)</span>
    <button type="button" id="btnBulkSubmit" class="btn btn-sm btn-warning ms-auto">
        <i class="bi bi-star me-1"></i>Jadikan Unggulan
    </button>
    <button type="button" class="btn btn-sm btn-secondary" id="btnClearCheck">
        <i class="bi bi-x-lg"></i> Batal
    </button>
</div>

<div class="d-flex justify-content-end mb-3">
    <form method="GET" action="{{ route('admin.promo.index') }}" class="d-flex w-25 min-w-300">
        <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari promo..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-sm btn-primary ms-2">
            <i class="bi bi-search"></i>
        </button>
        @if(request('search'))
            <a href="{{ route('admin.promo.index') }}" class="btn btn-sm btn-secondary ms-2">
                <i class="bi bi-x-lg"></i>
            </a>
        @endif
    </form>
</div>

<div class="admin-table">
    <table class="table">
        <thead>
            <tr>
                <th width="40" class="text-center">⭐</th>
                <th>Judul</th>
                <th>Gambar</th>
                <th width="200">Deskripsi</th>
                <th width="80">Benefit</th>
                <th width="140" class="text-center">Tampilan</th>
                <th width="100">Berlaku Hingga</th>
                <th width="130">Aksi</th>
            </tr>
        </thead>
        <tbody>
        @forelse($promos as $p)
        <tr>
            <td class="text-center">
                <input type="checkbox" value="{{ $p->id }}"
                    class="form-check-input promo-bulk-check" style="width:18px;height:18px;cursor:pointer;"
                    {{ $p->is_featured ? 'checked disabled' : '' }}>
            </td>
            <td>
                <div class="fw-semibold" style="font-size:14px">{{ $p->judul }}</div>
                @if($p->deskripsi)
                <div style="font-size:12px;color:#94a3b8;margin-top:2px">{{ Str::limit($p->deskripsi,60) }}</div>
                @endif
            </td>
            <td>
                <div class="promo-admin-card">
                <div class="pac-img">
                @if($p->gambar)
                    <img src="{{ asset('storage/'.$p->gambar) }}" alt="{{ $p->judul }}">
                @else
                    <div class="pac-img-placeholder">
                        <i class="bi bi-gift-fill"></i>
                    </div>
                @endif
                </div>
            </td>
            <td style="font-size:12.5px;color:#64748b">{{ Str::limit($p->deskripsi,80) }}</td>
            <td class="text-center">
                <span class="badge bg-secondary" style="font-size:11px">
                    {{ count($p->benefit ?? []) }} item
                </span>
            </td>
            <td class="text-center">
                <div class="d-flex flex-column gap-2 align-items-center">
                    <form method="POST" action="{{ route('admin.promo.featured', $p) }}">
                        @csrf @method('PATCH')
                        <button type="submit"
                            class="badge border-0 {{ $p->is_featured ? 'bg-warning text-dark' : 'bg-light text-muted' }}"
                            style="cursor:pointer;font-size:12px;padding:6px 12px; width: 110px;">
                            {{ $p->is_featured ? '⭐ Unggulan' : '☆ Biasa' }}
                        </button>
                    </form>
                    <form method="POST" action="{{ route('admin.promo.home-featured', $p) }}">
                        @csrf @method('PATCH')
                        <button type="submit"
                            class="badge border-0 {{ $p->is_home_featured ? 'bg-primary text-white' : 'bg-light text-muted' }}"
                            style="cursor:pointer;font-size:12px;padding:6px 12px; width: 110px;">
                            <i class="bi {{ $p->is_home_featured ? 'bi-house-fill' : 'bi-house' }}"></i> Popup
                        </button>
                    </form>
                </div>
            </td>
            <td class="text-center">
                {{ $p->berlaku_sampai ? $p->berlaku_sampai->format('d M Y') : '-' }}
            </td>
            <td>
                <div class="d-flex gap-1">
                    <a href="{{ route('admin.promo.edit', $p) }}" class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form method="POST" action="{{ route('admin.promo.destroy', $p) }}"
                          onsubmit="return confirm('Hapus promo ini?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr><td colspan="8" class="text-center py-5 text-muted">
            <i class="bi bi-gift d-block mb-2" style="font-size:2rem;opacity:.4"></i>
            Belum ada promo
        </td></tr>
        @endforelse
        </tbody>
    </table>
    <div class="p-3">{{ $promos->links() }}</div>
</div>

@push('scripts')
<script>
(function() {
    const MAX = 3;
    const checkboxes = document.querySelectorAll('.promo-bulk-check:not([disabled])');
    const bar        = document.getElementById('bulkActionBar');
    const countEl    = document.getElementById('bulkSelectedCount');
    const btnClear   = document.getElementById('btnClearCheck');
    const btnSubmit  = document.getElementById('btnBulkSubmit');
    const form       = document.getElementById('bulkFeaturedForm');
    const hiddenArea = document.getElementById('bulkHiddenIds');

    function getChecked() {
        return Array.from(document.querySelectorAll('.promo-bulk-check:checked:not([disabled])'));
    }

    function updateBar() {
        const checked = getChecked();
        const n = checked.length;
        if (n > 0) {
            bar.classList.remove('d-none');
            bar.classList.add('d-flex');
        } else {
            bar.classList.add('d-none');
            bar.classList.remove('d-flex');
        }
        countEl.textContent = n + ' promo dipilih (maks. ' + MAX + ')';
    }

    checkboxes.forEach(function(cb) {
        cb.addEventListener('change', function() {
            const n = getChecked().length;
            if (this.checked && n > MAX) {
                this.checked = false;
                alert('Maksimal ' + MAX + ' promo unggulan yang bisa dipilih sekaligus.');
                return;
            }
            updateBar();
        });
    });

    if (btnClear) {
        btnClear.addEventListener('click', function() {
            checkboxes.forEach(function(cb) { cb.checked = false; });
            updateBar();
        });
    }

    if (btnSubmit) {
        btnSubmit.addEventListener('click', function() {
            const checked = getChecked();
            if (checked.length === 0) {
                alert('Pilih minimal 1 promo.');
                return;
            }
            // Bersihkan hidden inputs lama
            hiddenArea.innerHTML = '';
            // Inject hidden inputs dengan id yang dipilih
            checked.forEach(function(cb) {
                const inp = document.createElement('input');
                inp.type  = 'hidden';
                inp.name  = 'promo_ids[]';
                inp.value = cb.value;
                hiddenArea.appendChild(inp);
            });
            form.submit();
        });
    }
})();
</script>
@endpush

@endsection
@push('styles')
<style>

.pac-img{position:relative;height:180px;overflow:hidden;background:#f1f5f9}
.pac-img img{width:100%;height:100%;object-fit:cover;transition:transform .4s}
.promo-admin-card:hover .pac-img img{transform:scale(1.04)}
.pac-img-placeholder{width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:3rem;color:#94a3b8;background:linear-gradient(135deg,#e2e8f0,#f1f5f9)}

</style>
@endpush