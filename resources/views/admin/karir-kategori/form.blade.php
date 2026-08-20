@extends('admin.layouts.app')
@section('title', $kategori ? 'Edit Kategori Pekerjaan' : 'Tambah Kategori Pekerjaan')
@section('page-title', $kategori ? 'Edit Kategori Pekerjaan' : 'Tambah Kategori Pekerjaan')
@section('content')
<div class="page-hd">
    <div><h1 class="page-hd-title">{{ $kategori ? "Edit Kategori" : "Tambah Kategori Baru" }}</h1></div>
    <a href="{{ route('admin.karir-kategori.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
</div>
<form method="POST" action="{{ $kategori ? route('admin.karir-kategori.update', $kategori) : route('admin.karir-kategori.store') }}">
@csrf @if($kategori) @method('PUT') @endif
<div class="row g-4">
    <div class="col-lg-8">
        <div class="form-card mb-4">
            <div class="mb-3">
                <label class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama', $kategori->nama ?? '') }}" required placeholder="Contoh: Perawat">
            </div>
            
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Warna Teks/Aksen (Hex) <span class="text-danger">*</span></label>
                    <div class="d-flex align-items-center gap-2">
                        <input type="color" id="colorPickerText" class="form-control form-control-color" value="{{ old('warna', $kategori->warna ?? '#0055a5') }}" title="Pilih Warna">
                        <input type="text" name="warna" id="colorInputText" class="form-control" value="{{ old('warna', $kategori->warna ?? '#0055a5') }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Warna Background (Hex) <span class="text-danger">*</span></label>
                    <div class="d-flex align-items-center gap-2">
                        <input type="color" id="colorPickerBg" class="form-control form-control-color" value="{{ old('warna_bg', $kategori->warna_bg ?? '#eff6ff') }}" title="Pilih Warna Background">
                        <input type="text" name="warna_bg" id="colorInputBg" class="form-control" value="{{ old('warna_bg', $kategori->warna_bg ?? '#eff6ff') }}" required>
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Icon Bootstrap (Class) <span class="text-danger">*</span></label>
                    <input type="text" name="icon" class="form-control" value="{{ old('icon', $kategori->icon ?? 'bi-briefcase') }}" required placeholder="Contoh: bi-heart-pulse">
                    <small class="text-muted d-block mt-1">Gunakan class dari <a href="https://icons.getbootstrap.com/" target="_blank">Bootstrap Icons</a></small>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Urutan <span class="text-danger">*</span></label>
                    <input type="number" name="urutan" class="form-control" value="{{ old('urutan', $kategori->urutan ?? 0) }}" required min="0">
                </div>
            </div>

            <div class="form-check mb-3 mt-4">
                <input class="form-check-input" type="checkbox" name="is_active" id="isActive" value="1" {{ old('is_active', $kategori->is_active ?? true) ? 'checked' : '' }}>
                <label class="form-check-label fw-semibold" for="isActive">Kategori Aktif</label>
            </div>

            <button type="submit" class="btn btn-primary"><i class="bi bi-save me-2"></i>{{ $kategori ? 'Simpan' : 'Tambah Kategori' }}</button>
        </div>
    </div>
</div>
</form>

<script>
    document.getElementById('colorPickerText').addEventListener('input', function() {
        document.getElementById('colorInputText').value = this.value;
    });
    document.getElementById('colorInputText').addEventListener('input', function() {
        document.getElementById('colorPickerText').value = this.value;
    });

    document.getElementById('colorPickerBg').addEventListener('input', function() {
        document.getElementById('colorInputBg').value = this.value;
    });
    document.getElementById('colorInputBg').addEventListener('input', function() {
        document.getElementById('colorPickerBg').value = this.value;
    });
</script>
@endsection
