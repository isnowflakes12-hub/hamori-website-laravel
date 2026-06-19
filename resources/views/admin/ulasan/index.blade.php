@extends('admin.layouts.app')
@section('title','Ulasan')
@section('page-title','Manajemen Ulasan')
@section('content')

<div class="page-hd">
    <div>
        <h1 class="page-hd-title">Ulasan & Testimoni</h1>
        <p class="page-hd-sub">
            Moderasi review pasien sebelum ditampilkan di website
        </p>
    </div>

    <a href="{{ route('admin.ulasan.form') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-2"></i>Tambah Ulasan
    </a>
</div>

{{-- Featured Status --}}
@php
    $featuredCount = $stats['featured'];
    $maxFeatured  = 6;
@endphp

<div class="alert mb-4 d-flex align-items-center gap-3"
     style="background:{{ $featuredCount >= $maxFeatured ? '#fef2f2' : '#f0fdf4' }};border-radius:12px;border:none">

    <div style="font-size:22px">
        {{ $featuredCount >= $maxFeatured ? '⚠️' : '✅' }}
    </div>

    <div>
        <strong>Ulasan Unggulan: {{ $featuredCount }}/{{ $maxFeatured }}</strong>

        @if($featuredCount >= $maxFeatured)
        <div style="font-size:13px;color:#d93025;margin-top:2px">
            Slot unggulan penuh — hapus salah satu ⭐ untuk menambah ulasan unggulan baru.
        </div>
        @endif
    </div>
</div>

{{-- Statistik --}}
<div class="row g-3 mb-4">

    <div class="col-lg-3 col-md-6">
        <div class="form-card h-100">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-ic bg-primary-subtle text-primary">
                    <i class="bi bi-chat-left-dots-fill"></i>
                </div>

                <div>
                    <div class="text-muted small">Total Ulasan</div>
                    <div class="fw-bold fs-4">{{ $stats['total'] }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="form-card h-100">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-ic bg-warning-subtle text-warning">
                    <i class="bi bi-hourglass-split"></i>
                </div>

                <div>
                    <div class="text-muted small">Pending</div>
                    <div class="fw-bold fs-4">{{ $stats['pending'] }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="form-card h-100">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-ic bg-success-subtle text-success">
                    <i class="bi bi-check-circle-fill"></i>
                </div>

                <div>
                    <div class="text-muted small">Disetujui</div>
                    <div class="fw-bold fs-4">{{ $stats['approved'] }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="form-card h-100">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-ic bg-warning text-dark">
                    <i class="bi bi-star-fill"></i>
                </div>

                <div>
                    <div class="text-muted small">Unggulan</div>
                    <div class="fw-bold fs-4">{{ $stats['featured'] }}/6</div>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- Alert --}}
@if(session('success'))
<div class="alert alert-success border-0 shadow-sm">
    <i class="bi bi-check-circle-fill me-2"></i>
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="alert alert-danger border-0 shadow-sm">
    <i class="bi bi-exclamation-triangle-fill me-2"></i>
    {{ session('error') }}
</div>
@endif

{{-- Filter --}}
<div class="form-card mb-4">
    <form method="GET" action="{{ route('admin.ulasan.index') }}">

        <div class="row g-3">

            <div class="col-lg">
                <input type="text"
                       name="q"
                       value="{{ request('q') }}"
                       class="form-control"
                       placeholder="Cari nama / isi ulasan...">
            </div>

            <div class="col-lg-2">
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>

                    <option value="pending"
                        {{ request('status') == 'pending' ? 'selected' : '' }}>
                        Pending
                    </option>

                    <option value="approved"
                        {{ request('status') == 'approved' ? 'selected' : '' }}>
                        Disetujui
                    </option>

                    <option value="featured"
                        {{ request('status') == 'featured' ? 'selected' : '' }}>
                        Unggulan
                    </option>

                    <option value="trash"
                        {{ request('status') == 'trash' ? 'selected' : '' }}>
                        Sampah
                    </option>
                </select>
            </div>

            <div class="col-lg-2">
                <select name="rating" class="form-select">

                    <option value="">Semua Rating</option>

                    @for($r = 5; $r >= 1; $r--)
                    <option value="{{ $r }}"
                        {{ request('rating') == $r ? 'selected' : '' }}>
                        {{ $r }} Bintang
                    </option>
                    @endfor

                </select>
            </div>

            <div class="col-lg-2">
                <select name="kategori" class="form-select">

                    <option value="">Semua Kategori</option>

                    @foreach(\App\Models\Ulasan::KATEGORI as $k => $v)
                    <option value="{{ $k }}"
                        {{ request('kategori') == $k ? 'selected' : '' }}>
                        {{ $v }}
                    </option>
                    @endforeach

                </select>
            </div>

            <div class="col-lg-auto d-flex gap-2">

                <button class="btn btn-primary">
                    <i class="bi bi-search me-1"></i>
                    Cari
                </button>

                <a href="{{ route('admin.ulasan.index') }}"
                   class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-clockwise"></i>
                </a>

            </div>

        </div>

    </form>
</div>

{{--
    BUG FIX #2: Semua form aksi per-baris (approve, featured, destroy, restore)
    dipindahkan ke LUAR <form id="bulkForm"> agar tidak nested.
    HTML tidak mengizinkan <form> di dalam <form> — browser akan mengabaikan
    form-form inner sehingga submit selalu mengenai bulkForm → error validasi.

    Solusi: tabel dibungkus bulkForm hanya untuk checkbox + bulk bar.
    Kolom Aksi menggunakan form mandiri di luar, dikendalikan via JS (fetch/submit).
--}}

{{-- Bulk Bar (di luar tabel, di luar form tabel) --}}
<div class="alert alert-light border mb-3 d-none" id="bulkBar">
    <form method="POST"
          action="{{ route('admin.ulasan.bulk') }}"
          id="bulkForm">
        @csrf
        {{-- IDs akan diisi oleh JS --}}
        <div id="bulkHiddenIds"></div>

        <div class="d-flex align-items-center gap-3 flex-wrap">

            <strong id="bulkCount">0 dipilih</strong>

            <select name="action" class="form-select" style="max-width:220px" id="bulkAction">
                <option value="">-- Pilih aksi --</option>
                <option value="approve">✓ Setujui semua</option>
                <option value="featured">⭐ Jadikan unggulan</option>
                <option value="delete">✕ Hapus semua</option>
            </select>

            <button type="submit"
                    class="btn btn-primary"
                    onclick="return confirm('Yakin menerapkan aksi ini?')">
                Terapkan
            </button>

        </div>
    </form>
</div>

{{-- Tabel (form hanya untuk checkbox select-all; tidak ada submit di sini) --}}
<div class="admin-table">
    <table class="table">

        <thead>
            <tr>
                <th width="40">
                    <input type="checkbox" id="checkAll">
                </th>

                <th>Pengirim</th>
                <th width="320">Ulasan</th>
                <th width="100">Rating</th>
                <th width="130">Kategori</th>
                <th width="110">Status</th>
                <th width="110">Tanggal</th>
                <th width="150">Aksi</th>
            </tr>
        </thead>

        <tbody>

        @forelse($ulasans as $u)

        <tr class="{{ $u->trashed() ? 'table-danger' : '' }}">

            <td>
                <input type="checkbox"
                       value="{{ $u->id }}"
                       class="row-check"
                       {{ $u->trashed() ? 'disabled' : '' }}>
            </td>

            {{-- Pengirim --}}
            <td>

                <div class="d-flex align-items-center gap-3">

                    <div class="review-avatar"
                         style="background:{{ $u->avatar_color }}">
                        {{ $u->initial }}
                    </div>

                    <div>

                        <div class="fw-semibold"
                             style="font-size:14px">
                            {{ $u->nama }}
                        </div>

                        @if($u->email)
                        <div style="font-size:12px;color:#94a3b8">
                            {{ $u->email }}
                        </div>
                        @endif

                        <span class="badge bg-light text-dark border mt-1"
                              style="font-size:11px">
                            {{ ucfirst($u->sumber) }}
                        </span>

                    </div>

                </div>

            </td>

            {{-- Ulasan --}}
            <td>

                <div style="font-size:13px;color:#64748b;line-height:1.6">
                    {{ Str::limit($u->ulasan, 120) }}
                </div>

                @if($u->is_featured)
                <span class="badge bg-warning text-dark mt-2"
                      style="font-size:11px">
                    ⭐ Unggulan
                </span>
                @endif

            </td>

            {{-- Rating --}}
            <td class="text-center">

                <div class="d-flex justify-content-center gap-1">

                    @for($s = 1; $s <= 5; $s++)
                    <i class="bi bi-star{{ $s <= $u->rating ? '-fill' : '' }}"
                       style="color:{{ $s <= $u->rating ? '#f59e0b' : '#cbd5e1' }}"></i>
                    @endfor

                </div>

            </td>

            {{-- Kategori --}}
            <td class="text-center">

                <span class="badge bg-secondary-subtle text-dark border"
                      style="font-size:11px">
                    {{ $u->kategori_label }}
                </span>

            </td>

            {{-- Status --}}
            <td class="text-center">

                @if($u->trashed())

                <span class="badge bg-danger">
                    Sampah
                </span>

                @elseif($u->is_approved)

                <span class="badge bg-success">
                    Disetujui
                </span>

                @else

                <span class="badge bg-warning text-dark">
                    Pending
                </span>

                @endif

            </td>

            {{-- Tanggal --}}
            <td class="text-center"
                style="font-size:12px;color:#64748b">

                {{ $u->created_at->format('d M Y') }}

            </td>

            {{-- Aksi — semua form berdiri sendiri, tidak nested --}}
            <td>

                <div class="d-flex gap-1 flex-wrap">

                    @if($u->trashed())

                    {{-- BUG FIX #3: gunakan route restore yang benar, bukan bulk --}}
                    <form method="POST"
                          action="{{ route('admin.ulasan.restore', $u->id) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                                class="btn btn-sm btn-outline-success"
                                title="Pulihkan">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </button>
                    </form>

                    @else

                        @if(!$u->is_approved)

                        {{-- BUG FIX #2: form approve berdiri sendiri di luar bulkForm --}}
                        <form method="POST"
                              action="{{ route('admin.ulasan.approve', $u) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                    class="btn btn-sm btn-outline-success"
                                    title="Setujui">
                                <i class="bi bi-check-lg"></i>
                            </button>
                        </form>

                        @endif

                        <form method="POST"
                              action="{{ route('admin.ulasan.featured', $u) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                class="badge border-0 {{ $u->is_featured ? 'bg-warning text-dark' : 'bg-light text-muted' }}"
                                style="cursor:pointer;font-size:12px;padding:7px 12px">
                                {{ $u->is_featured ? '⭐ Unggulan' : '☆ Biasa' }}
                            </button>
                        </form>

                        <form method="POST"
                              action="{{ route('admin.ulasan.destroy', $u) }}"
                              onsubmit="return confirm('Hapus ulasan ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"
                                    title="Hapus">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>

                    @endif

                </div>

            </td>

        </tr>

        @empty

        <tr>
            <td colspan="8"
                class="text-center py-5 text-muted">

                <i class="bi bi-chat-square-dots d-block mb-2"
                   style="font-size:2rem;opacity:.4"></i>

                Tidak ada ulasan ditemukan

            </td>
        </tr>

        @endforelse

        </tbody>

    </table>

</div>

<div class="mt-4">
    {{ $ulasans->links() }}
</div>

@endsection

@push('styles')
<style>

.review-avatar{
    width:46px;
    height:46px;
    border-radius:14px;
    display:flex;
    align-items:center;
    justify-content:center;
    color:#fff;
    font-weight:700;
    font-size:15px;
    flex-shrink:0;
    box-shadow:0 4px 14px rgba(0,0,0,.08);
}

.stat-ic{
    width:52px;
    height:52px;
    border-radius:14px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:20px;
}

.admin-table table td{
    vertical-align:middle;
}

</style>
@endpush

@push('scripts')
<script>
/**
 * BUG FIX #1: JavaScript untuk checkbox bulk selection.
 * Sebelumnya tidak ada JS sama sekali → bulkBar selamanya tersembunyi,
 * checkbox tidak berfungsi.
 */
(function () {
    const checkAll  = document.getElementById('checkAll');
    const bulkBar   = document.getElementById('bulkBar');
    const bulkCount = document.getElementById('bulkCount');
    const bulkHiddenIds = document.getElementById('bulkHiddenIds');
    const bulkForm  = document.getElementById('bulkForm');

    function getChecked() {
        return [...document.querySelectorAll('.row-check:not(:disabled):checked')];
    }

    function updateBar() {
        const checked = getChecked();
        const n = checked.length;

        if (n > 0) {
            bulkBar.classList.remove('d-none');
            bulkCount.textContent = n + ' dipilih';
        } else {
            bulkBar.classList.add('d-none');
        }
    }

    // Sinkron hidden inputs ke bulkForm saat submit
    bulkForm.addEventListener('submit', function (e) {
        const action = document.getElementById('bulkAction').value;
        if (!action) {
            e.preventDefault();
            alert('Pilih aksi terlebih dahulu.');
            return;
        }

        // Hapus hidden ids lama
        bulkHiddenIds.innerHTML = '';

        // Isi dari checkbox yang tercentang
        getChecked().forEach(function (cb) {
            const inp = document.createElement('input');
            inp.type  = 'hidden';
            inp.name  = 'ids[]';
            inp.value = cb.value;
            bulkHiddenIds.appendChild(inp);
        });

        if (bulkHiddenIds.children.length === 0) {
            e.preventDefault();
            alert('Pilih setidaknya satu ulasan.');
        }
    });

    // Check-all
    checkAll.addEventListener('change', function () {
        document.querySelectorAll('.row-check:not(:disabled)').forEach(function (cb) {
            cb.checked = checkAll.checked;
        });
        updateBar();
    });

    // Per-baris checkbox
    document.querySelectorAll('.row-check').forEach(function (cb) {
        cb.addEventListener('change', function () {
            const all  = document.querySelectorAll('.row-check:not(:disabled)');
            const done = document.querySelectorAll('.row-check:not(:disabled):checked');
            checkAll.indeterminate = done.length > 0 && done.length < all.length;
            checkAll.checked = done.length === all.length && all.length > 0;
            updateBar();
        });
    });
})();
</script>
@endpush