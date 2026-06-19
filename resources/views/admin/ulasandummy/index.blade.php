@extends('admin.layouts.app')

@section('title','Manajemen Ulasan & Testimoni')
@section('page-title','Manajemen Ulasan & Testimoni')

@section('content')

<div class="page-hd">
    <div>
        <h1 class="page-hd-title">
            Ulasan & Testimoni
        </h1>

        <p class="page-hd-sub">
            Moderasi review pasien sebelum ditampilkan di website
        </p>
    </div>

    <button class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#modalTambah">
        <i class="bi bi-plus-lg me-2"></i>
        Tambah Manual
    </button>
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
    <form method="GET"
          action="{{ route('admin.ulasan.index') }}">

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
                    <option value="pending" {{ request('status')=='pending' ? 'selected':'' }}>
                        Pending
                    </option>
                    <option value="approved" {{ request('status')=='approved' ? 'selected':'' }}>
                        Disetujui
                    </option>
                    <option value="featured" {{ request('status')=='featured' ? 'selected':'' }}>
                        Unggulan
                    </option>
                    <option value="trash" {{ request('status')=='trash' ? 'selected':'' }}>
                        Sampah
                    </option>
                </select>
            </div>

            <div class="col-lg-2">
                <select name="rating" class="form-select">
                    <option value="">Semua Rating</option>

                    @for($r=5;$r>=1;$r--)
                    <option value="{{ $r }}" {{ request('rating')==$r ? 'selected':'' }}>
                        {{ $r }} Bintang
                    </option>
                    @endfor
                </select>
            </div>

            <div class="col-lg-2">
                <select name="kategori" class="form-select">
                    <option value="">Semua Kategori</option>

                    @foreach(\App\Models\Ulasan::KATEGORI as $k=>$v)
                    <option value="{{ $k }}" {{ request('kategori')==$k ? 'selected':'' }}>
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

{{-- Bulk Action --}}
<form method="POST"
      action="{{ route('admin.ulasan.bulk') }}"
      id="bulkForm">

    @csrf

    <div class="alert alert-light border mb-3 d-none"
         id="bulkBar">

        <div class="d-flex align-items-center gap-3 flex-wrap">

            <strong id="bulkCount">0 dipilih</strong>

            <select name="action"
                    class="form-select"
                    style="max-width:220px">

                <option value="">-- Pilih aksi --</option>
                <option value="approve">✓ Setujui semua</option>
                <option value="featured">★ Jadikan unggulan</option>
                <option value="delete">✕ Hapus semua</option>
            </select>

            <button type="submit"
                    class="btn btn-primary"
                    onclick="return confirm('Yakin?')">
                Terapkan
            </button>

        </div>

    </div>

    {{-- Table --}}
    <div class="admin-table">

        <table class="table align-middle">

            <thead>
                <tr>
                    <th width="40">
                        <input type="checkbox" id="checkAll">
                    </th>

                    <th>Pengirim</th>
                    <th>Ulasan</th>
                    <th width="100">Rating</th>
                    <th width="120">Kategori</th>
                    <th width="110">Status</th>
                    <th width="100">Tanggal</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>

            <tbody>

            @forelse($ulasans as $u)

                <tr class="{{ $u->trashed() ? 'table-danger' : '' }}">

                    <td>
                        <input type="checkbox"
                               name="ids[]"
                               value="{{ $u->id }}"
                               class="row-check"
                               {{ $u->trashed() ? 'disabled':'' }}>
                    </td>

                    <td>
                        <div class="d-flex align-items-center gap-3">

                            <div class="review-avatar"
                                 style="background:{{ $u->avatar_color }}">
                                {{ $u->initial }}
                            </div>

                            <div>
                                <div class="fw-semibold">
                                    {{ $u->nama }}
                                </div>

                                @if($u->email)
                                <div class="small text-muted">
                                    {{ $u->email }}
                                </div>
                                @endif

                                <span class="badge bg-light text-dark border mt-1">
                                    {{ ucfirst($u->sumber) }}
                                </span>
                            </div>

                        </div>
                    </td>

                    <td>

                        <div style="font-size:14px">
                            {{ Str::limit($u->ulasan,120) }}
                        </div>

                        @if($u->is_featured)
                        <span class="badge bg-warning text-dark mt-2">
                            ⭐ Unggulan
                        </span>
                        @endif

                    </td>

                    <td>
                        <div class="d-flex gap-1">
                            @for($s=1;$s<=5;$s++)
                            <i class="bi bi-star{{ $s <= $u->rating ? '-fill':'' }}"
                               style="color:{{ $s <= $u->rating ? '#f59e0b':'#cbd5e1' }}"></i>
                            @endfor
                        </div>
                    </td>

                    <td>
                        <span class="badge bg-secondary-subtle text-dark border">
                            {{ $u->kategori_label }}
                        </span>
                    </td>

                    <td>

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

                    <td class="text-muted small">
                        {{ $u->created_at->format('d M Y') }}
                    </td>

                    <td>

                        <div class="d-flex gap-1 flex-wrap">

                            @if($u->trashed())

                            <form action="{{ route('admin.ulasan.bulk') }}"
                                    method="POST">

                                    @csrf

                                <button type="submit"
                                        class="btn btn-sm btn-outline-success">
                                    <i class="bi bi-arrow-counterclockwise"></i>
                                </button>
                            </form>

                            @else

                                @if(!$u->is_approved)
                                <form method="POST"
                                      action="{{ route('admin.ulasan.approve',$u) }}">
                                    @csrf
                                    

                                    <button type="submit"
                                            class="btn btn-sm btn-outline-success">
                                        <i class="bi bi-check-lg"></i>
                                    </button>
                                </form>
                                @endif

                                <form method="POST"
                                      action="{{ route('admin.ulasan.featured',$u) }}">
                                    @csrf
                                     @method('PATCH')

                                    <button type="submit"
                                            class="btn btn-sm {{ $u->is_featured ? 'btn-warning' : 'btn-outline-warning' }}">
                                        <i class="bi bi-star{{ $u->is_featured ? '-fill':'' }}"></i>
                                    </button>
                                </form>

                                <form method="POST"
                                      action="{{ route('admin.ulasan.destroy',$u) }}"
                                      onsubmit="return confirm('Hapus ulasan ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-outline-danger">
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

</form>

<div class="mt-4">
    {{ $ulasans->links() }}
</div>
{{-- Modal Tambah / Edit Ulasan --}}
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content border-0">

            <div class="modal-header">
                <div>
                    <h5 class="modal-title fw-bold mb-1">
                        <i class="bi bi-chat-square-heart me-2 text-primary"></i>
                        Tambah Ulasan Manual
                    </h5>

                    <div class="text-muted small">
                        Tambahkan testimoni pasien secara manual
                    </div>
                </div>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"></button>
            </div>

            <form method="POST"
                  action="{{ route('admin.ulasan.store') }}">

                @csrf

                <div class="modal-body">

                    <div class="row g-4">

                        {{-- LEFT --}}
                        <div class="col-lg-8">

                            {{-- Informasi Pengirim --}}
                            <div class="form-card mb-4">

                                <h6 class="fw-bold mb-4"
                                    style="font-size:14px;color:#374151;border-bottom:1px solid #e2e8f0;padding-bottom:12px">

                                    <i class="bi bi-person-circle me-2 text-primary"></i>
                                    Informasi Pengirim

                                </h6>

                                <div class="row g-3">

                                    <div class="col-md-6">
                                        <label class="form-label">
                                            Nama Pasien
                                            <span class="text-danger">*</span>
                                        </label>

                                        <input type="text"
                                               name="nama"
                                               class="form-control"
                                               maxlength="100"
                                               required
                                               placeholder="Contoh: Budi Santoso">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">
                                            Email
                                        </label>

                                        <input type="email"
                                               name="email"
                                               class="form-control"
                                               maxlength="150"
                                               placeholder="opsional@email.com">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">
                                            Nomor WhatsApp
                                        </label>

                                        <div class="input-group">
                                            <span class="input-group-text bg-success-subtle">
                                                <i class="bi bi-whatsapp text-success"></i>
                                            </span>

                                            <input type="text"
                                                   name="whatsapp"
                                                   class="form-control"
                                                   placeholder="0812xxxxxxx">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">
                                            Sumber Ulasan
                                        </label>

                                        <select name="sumber"
                                                class="form-select">

                                            <option value="manual">
                                                Manual (Admin)
                                            </option>

                                            <option value="website">
                                                Website
                                            </option>

                                            <option value="whatsapp">
                                                WhatsApp
                                            </option>

                                            <option value="google">
                                                Google Review
                                            </option>

                                        </select>
                                    </div>

                                </div>

                            </div>

                            {{-- Isi Ulasan --}}
                            <div class="form-card mb-4">

                                <h6 class="fw-bold mb-4"
                                    style="font-size:14px;color:#374151;border-bottom:1px solid #e2e8f0;padding-bottom:12px">

                                    <i class="bi bi-chat-left-text me-2 text-primary"></i>
                                    Isi Ulasan

                                </h6>

                                <div class="mb-4">

                                    <label class="form-label">
                                        Ulasan Pasien
                                        <span class="text-danger">*</span>

                                        <span class="text-muted fw-normal float-end"
                                              id="ulasanCount"
                                              style="font-size:12px">
                                        </span>
                                    </label>

                                    <textarea name="ulasan"
                                              class="form-control"
                                              rows="6"
                                              minlength="5"
                                              maxlength="1000"
                                              required
                                              oninput="countChars(this,'ulasanCount',1000)"
                                              placeholder="Tuliskan pengalaman pasien terhadap pelayanan klinik..."></textarea>

                                    <div class="form-text">
                                        Maksimal 1000 karakter
                                    </div>

                                </div>

                                <div class="row g-3">

                                    <div class="col-md-6">

                                        <label class="form-label">
                                            Kategori
                                        </label>

                                        <select name="kategori"
                                                class="form-select"
                                                required>

                                            @foreach(\App\Models\Ulasan::KATEGORI as $k=>$v)
                                            <option value="{{ $k }}">
                                                {{ $v }}
                                            </option>
                                            @endforeach

                                        </select>

                                    </div>

                                    <div class="col-md-6">

                                        <label class="form-label">
                                            Rating
                                        </label>

                                        <select name="rating"
                                                class="form-select"
                                                required>

                                            @for($r=5;$r>=1;$r--)
                                            <option value="{{ $r }}">
                                                {{ $r }} Bintang {{ str_repeat('★',$r) }}
                                            </option>
                                            @endfor

                                        </select>

                                    </div>

                                </div>

                            </div>

                            {{-- Catatan Admin --}}
                            <div class="form-card">

                                <h6 class="fw-bold mb-4"
                                    style="font-size:14px;color:#374151;border-bottom:1px solid #e2e8f0;padding-bottom:12px">

                                    <i class="bi bi-journal-text me-2 text-primary"></i>
                                    Catatan Internal

                                </h6>

                                <textarea name="catatan_admin"
                                          class="form-control"
                                          rows="4"
                                          maxlength="500"
                                          placeholder="Catatan internal admin (tidak tampil di website)"></textarea>

                                <div class="form-text">
                                    Opsional. Hanya terlihat oleh admin.
                                </div>

                            </div>

                        </div>

                        {{-- RIGHT SIDEBAR --}}
                        <div class="col-lg-4">

                            {{-- Preview --}}
                            <div class="form-card mb-4">

                                <h6 class="fw-bold mb-3"
                                    style="font-size:14px;color:#374151">

                                    <i class="bi bi-eye me-2 text-primary"></i>
                                    Preview Rating

                                </h6>

                                <div class="border rounded-4 p-4 text-center bg-light">

                                    <div class="mb-3"
                                         style="font-size:38px;color:#f59e0b">
                                        ★★★★★
                                    </div>

                                    <div class="fw-semibold">
                                        Review Positif
                                    </div>

                                    <div class="small text-muted mt-1">
                                        Tampilan preview testimonial
                                    </div>

                                </div>

                            </div>

                            {{-- Pengaturan --}}
                            <div class="form-card mb-4">

                                <h6 class="fw-bold mb-3"
                                    style="font-size:14px;color:#374151">

                                    <i class="bi bi-gear me-2 text-primary"></i>
                                    Pengaturan

                                </h6>

                                <div class="mb-3">

                                    <label class="form-label">
                                        Tanggal Ulasan
                                    </label>

                                    <input type="date"
                                           name="created_at"
                                           class="form-control"
                                           value="{{ now()->format('Y-m-d') }}">

                                </div>

                                <div class="mb-3">

                                    <label class="form-label">
                                        Urutan Tampil
                                    </label>

                                    <input type="number"
                                           name="urutan"
                                           class="form-control"
                                           min="0"
                                           value="0">

                                </div>

                                <div class="form-check p-3 rounded-3 mb-3"
                                     style="border:1px solid #e2e8f0">

                                    <input class="form-check-input"
                                           type="checkbox"
                                           name="is_approved"
                                           id="isApproved"
                                           value="1"
                                           checked>

                                    <label class="form-check-label"
                                           for="isApproved">

                                        <strong>
                                            Langsung Setujui
                                        </strong>

                                        <div class="small text-muted">
                                            Review langsung tampil di website
                                        </div>

                                    </label>

                                </div>

                                <div class="form-check p-3 rounded-3 bg-warning bg-opacity-10"
                                     style="border:1px solid #f59e0b">

                                    <input class="form-check-input"
                                           type="checkbox"
                                           name="is_featured"
                                           id="isFeatured"
                                           value="1">

                                    <label class="form-check-label"
                                           for="isFeatured">

                                        <strong>
                                            ⭐ Jadikan Unggulan
                                        </strong>

                                        <div class="small text-muted">
                                            Ditampilkan di section testimonial utama
                                        </div>

                                    </label>

                                </div>

                            </div>

                            <button type="submit"
                                    class="btn btn-primary w-100">

                                <i class="bi bi-save me-2"></i>
                                Simpan Ulasan

                            </button>

                        </div>

                    </div>

                </div>

            </form>

        </div>
    </div>
</div>
@endsection

@push('styles')
<style>

.review-avatar{
    width:48px;
    height:48px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    color:#fff;
    font-weight:700;
    flex-shrink:0;
}

.stat-ic{
    width:56px;
    height:56px;
    border-radius:16px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:22px;
}

</style>
@endpush