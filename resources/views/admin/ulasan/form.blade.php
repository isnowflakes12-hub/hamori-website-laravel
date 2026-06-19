@extends('admin.layouts.app')
@section('title', $ulasan ? 'Edit Ulasan' : 'Tambah Ulasan')
@section('page-title', $ulasan ? 'Edit Ulasan' : 'Tambah Ulasan Baru')

@section('content')

<div class="page-hd">
    <div>
        <h1 class="page-hd-title">
            {{ $ulasan ? 'Edit Ulasan' : 'Tambah Ulasan Baru' }}
        </h1>

        <p class="page-hd-sub">
            Kelola review dan testimoni pasien untuk website klinik
        </p>
    </div>

    <a href="{{ route('admin.ulasan.index') }}"
       class="btn btn-outline-secondary">

        <i class="bi bi-arrow-left me-1"></i>
        Kembali

    </a>
</div>

<form method="POST"
      action="{{ $ulasan ? route('admin.ulasan.update', $ulasan) : route('admin.ulasan.store') }}"
      enctype="multipart/form-data">

    @csrf
    @if($ulasan)
        @method('PUT')
    @endif

    <div class="row g-4">

        {{-- LEFT CONTENT --}}
        <div class="col-xl-8 col-lg-7">

            {{-- Informasi Pengirim --}}
            <div class="form-card mb-4">

                <h6 class="section-title">
                    <i class="bi bi-person-circle text-primary"></i>
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
                               value="{{ old('nama', $ulasan->nama ?? '') }}"
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
                               value="{{ old('email', $ulasan->email ?? '') }}"
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
                                   value="{{ old('whatsapp', $ulasan->whatsapp ?? '') }}"
                                   placeholder="0812xxxxxxx">

                        </div>

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">
                            Sumber Ulasan
                        </label>

                        <select name="sumber" class="form-select">

                            @php
                                $sumber = old('sumber', $ulasan->sumber ?? 'manual');
                            @endphp

                            <option value="manual" {{ $sumber == 'manual' ? 'selected' : '' }}>
                                Manual (Admin)
                            </option>

                            <option value="website" {{ $sumber == 'website' ? 'selected' : '' }}>
                                Website
                            </option>

                            <option value="whatsapp" {{ $sumber == 'whatsapp' ? 'selected' : '' }}>
                                WhatsApp
                            </option>

                            <option value="google" {{ $sumber == 'google' ? 'selected' : '' }}>
                                Google Review
                            </option>

                        </select>

                    </div>

                </div>

            </div>

            {{-- Isi Ulasan --}}
            <div class="form-card mb-4">

                <h6 class="section-title">
                    <i class="bi bi-chat-left-text text-primary"></i>
                    Isi Ulasan
                </h6>

                <div class="mb-4">

                    <label class="form-label">
                        Ulasan Pasien
                        <span class="text-danger">*</span>

                        <span class="float-end text-muted small"
                              id="ulasanCount"></span>
                    </label>

                    <textarea name="ulasan"
                              class="form-control"
                              rows="6"
                              minlength="5"
                              maxlength="1000"
                              required
                              oninput="countChars(this,'ulasanCount',1000)"
                              placeholder="Tuliskan pengalaman pasien terhadap pelayanan klinik...">{{ old('ulasan', $ulasan->ulasan ?? '') }}</textarea>

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

                            @foreach(\App\Models\Ulasan::KATEGORI as $k => $v)

                            <option value="{{ $k }}"
                                {{ old('kategori', $ulasan->kategori ?? '') == $k ? 'selected' : '' }}>

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

                            @for($r = 5; $r >= 1; $r--)

                            <option value="{{ $r }}"
                                {{ old('rating', $ulasan->rating ?? 5) == $r ? 'selected' : '' }}>

                                {{ $r }} Bintang {{ str_repeat('★', $r) }}

                            </option>

                            @endfor

                        </select>

                    </div>

                </div>

            </div>

            {{-- Catatan Admin --}}
            <div class="form-card">

                <h6 class="section-title">
                    <i class="bi bi-journal-text text-primary"></i>
                    Catatan Internal
                </h6>

                <textarea name="catatan_admin"
                          class="form-control"
                          rows="5"
                          maxlength="500"
                          placeholder="Catatan internal admin (tidak tampil di website)">{{ old('catatan_admin', $ulasan->catatan_admin ?? '') }}</textarea>

                <div class="form-text">
                    Opsional. Hanya terlihat oleh admin.
                </div>

            </div>

        </div>

        {{-- RIGHT SIDEBAR --}}
        <div class="col-xl-4 col-lg-5">

            {{-- Preview --}}
            <div class="form-card mb-4">

                <h6 class="section-title-sm">
                    <i class="bi bi-eye text-primary"></i>
                    Preview Testimoni
                </h6>

                <div class="review-preview">

                    <div class="review-stars">
                        ★★★★★
                    </div>

                    <div class="review-avatar-preview">
                        {{ strtoupper(substr(old('nama', $ulasan->nama ?? 'U'),0,1)) }}
                    </div>

                    <div class="fw-semibold mt-3">
                        {{ old('nama', $ulasan->nama ?? 'Nama Pasien') }}
                    </div>

                    <div class="small text-muted mt-1">
                        Tampilan testimonial website
                    </div>

                </div>

            </div>

            {{-- Pengaturan --}}
            <div class="form-card mb-4">

                <h6 class="section-title-sm">
                    <i class="bi bi-gear text-primary"></i>
                    Pengaturan
                </h6>

                <div class="mb-3">

                    <label class="form-label">
                        Tanggal Ulasan
                    </label>

                    <input type="date"
                           name="created_at"
                           class="form-control"
                           value="{{ old('created_at',
                                isset($ulasan->created_at)
                                    ? $ulasan->created_at->format('Y-m-d')
                                    : now()->format('Y-m-d')) }}">

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Urutan Tampil
                    </label>

                    <input type="number"
                           name="urutan"
                           class="form-control"
                           min="0"
                           value="{{ old('urutan', $ulasan->urutan ?? 0) }}">

                    <div class="form-text">
                        Angka kecil tampil lebih awal
                    </div>

                </div>

                <div class="setting-box mb-3">

                    <div class="form-check">

                        <input class="form-check-input"
                               type="checkbox"
                               name="is_approved"
                               id="isApproved"
                               value="1"
                               {{ old('is_approved', $ulasan->is_approved ?? true) ? 'checked' : '' }}>

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

                </div>

                <div class="setting-box featured-box">

                    <div class="form-check">

                        <input class="form-check-input"
                               type="checkbox"
                               name="is_featured"
                               id="isFeatured"
                               value="1"
                               {{ old('is_featured', $ulasan->is_featured ?? false) ? 'checked' : '' }}>

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

            </div>

            <button type="submit"
                    class="btn btn-primary w-100 save-btn">

                <i class="bi bi-save me-2"></i>

                {{ $ulasan ? 'Simpan Perubahan' : 'Simpan Ulasan' }}

            </button>

        </div>

    </div>

</form>

@endsection

@push('styles')
<style>

.section-title{
    display:flex;
    align-items:center;
    gap:10px;
    font-size:14px;
    font-weight:700;
    color:#374151;
    margin-bottom:24px;
    padding-bottom:14px;
    border-bottom:1px solid #e2e8f0;
}

.section-title-sm{
    display:flex;
    align-items:center;
    gap:10px;
    font-size:14px;
    font-weight:700;
    color:#374151;
    margin-bottom:18px;
}

.review-preview{
    border-radius:20px;
    padding:30px 20px;
    background:#f8fafc;
    border:1px solid #e2e8f0;
    text-align:center;
}

.review-stars{
    font-size:32px;
    line-height:1;
    color:#f59e0b;
    margin-bottom:20px;
}

.review-avatar-preview{
    width:72px;
    height:72px;
    border-radius:20px;
    margin:auto;
    display:flex;
    align-items:center;
    justify-content:center;
    background:linear-gradient(135deg,#3b82f6,#2563eb);
    color:#fff;
    font-size:24px;
    font-weight:700;
    box-shadow:0 10px 30px rgba(37,99,235,.2);
}

.setting-box{
    border:1px solid #e2e8f0;
    border-radius:14px;
    padding:16px;
    background:#fff;
}

.featured-box{
    border-color:#f59e0b;
    background:rgba(245,158,11,.08);
}

.save-btn{
    height:50px;
    font-weight:600;
    border-radius:14px;
}

@media (max-width: 991px){

    .review-preview{
        padding:24px 16px;
    }

    .review-stars{
        font-size:28px;
    }

    .review-avatar-preview{
        width:64px;
        height:64px;
        font-size:20px;
        border-radius:18px;
    }

}

@media (max-width: 576px){

    .page-hd{
        flex-direction:column;
        align-items:flex-start !important;
        gap:14px;
    }

    .page-hd .btn{
        width:100%;
    }

    .section-title,
    .section-title-sm{
        font-size:13px;
    }

    .review-preview{
        border-radius:16px;
    }

}

</style>
@endpush

@push('scripts')
<script>

function countChars(el,id,max){
    const counter = document.getElementById(id);
    counter.innerHTML = el.value.length + '/' + max;
}

document.addEventListener('DOMContentLoaded', function(){

    const textarea = document.querySelector('textarea[name="ulasan"]');

    if(textarea){
        countChars(textarea,'ulasanCount',1000);
    }

});

</script>
@endpush