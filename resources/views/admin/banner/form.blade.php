@extends('admin.layouts.app')
@section('title', $banner ? 'Edit Banner' : 'Tambah Banner')
@section('page-title', $banner ? 'Edit Banner' : 'Tambah Banner')
@section('content')
<div class="page-hd">
    <div><h1 class="page-hd-title">{{ $banner ? "Edit Banner" : "Tambah Banner" }}</h1></div>
    <a href="{{ route('admin.banner.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
</div>
<div class="row g-4">
    <div class="col-lg-8">
        <div class="form-card">
            <form method="POST" action="{{ $banner ? route('admin.banner.update', $banner) : route('admin.banner.store') }}" enctype="multipart/form-data">
                @csrf @if($banner) @method('PUT') @endif
                <div class="mb-3">
                    <label class="form-label">Judul <span class="text-muted">(opsional)</span></label>
                    <input type="text" name="judul" class="form-control" value="{{ old('judul', $banner->judul ?? '') }}" placeholder="Judul banner (opsional)">
                </div>
                <div class="mb-3">
                    <label class="form-label">Gambar atau Video <span class="text-danger">*</span></label>
                    @if($banner && $banner->gambar)
                        @if(Str::endsWith($banner->gambar, ['.mp4', '.webm', '.mov']))
                            <div class="mb-2"><video src="{{ asset('storage/'.$banner->gambar) }}" class="img-prev" controls style="max-height:150px;"></video></div>
                        @else
                            <div class="mb-2"><img src="{{ asset('storage/'.$banner->gambar) }}" class="img-prev"></div>
                        @endif
                    @endif
                    <input type="file" name="gambar" class="form-control" {{ !$banner ? 'required' : '' }} accept="image/*,video/mp4,video/webm" onchange="previewImg(this,'prevDesktop')">
                    <div class="form-text">Format: JPG, PNG, WebP, MP4, WebM. Maks 50MB.</div>
                    <img id="prevDesktop" class="img-prev mt-2" style="display:none">
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Urutan</label>
                        <input type="number" name="urutan" class="form-control" value="{{ old('urutan', $banner->urutan ?? 0) }}" min="0">
                    </div>
                </div>
                <div class="form-check mt-3">
                    <input class="form-check-input" type="checkbox" name="is_active" id="isActive" value="1" {{ old('is_active', $banner->is_active ?? true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="isActive">Banner aktif (ditampilkan di website)</label>
                </div>
                <hr class="my-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-2"></i>{{ $banner ? 'Simpan Perubahan' : 'Tambah Banner' }}</button>
            </form>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-card">
            <h6 class="fw-bold mb-3">Panduan Gambar</h6>
            <ul style="font-size:13px;color:#64748b;padding-left:16px">
                <li class="mb-2">Gambar: <strong>1920×600px</strong></li>
                <li class="mb-2">Format Gambar: JPG, PNG, WebP</li>
                <li class="mb-2">Format Video: MP4, WebM</li>
                <li class="mb-2">Maksimal ukuran file: <strong>50MB</strong></li>
                <li>Video akan diputar otomatis tanpa suara</li>
            </ul>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
function previewImg(input, previewId) {
    const prev = document.getElementById(previewId);
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { prev.src = e.target.result; prev.style.display = 'block'; };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush