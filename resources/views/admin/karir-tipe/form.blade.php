@extends('admin.layouts.app')
@section('title', $tipe ? 'Edit Tipe Pekerjaan' : 'Tambah Tipe Pekerjaan')
@section('page-title', $tipe ? 'Edit Tipe Pekerjaan' : 'Tambah Tipe Pekerjaan')
@section('content')
<div class="page-hd">
    <div><h1 class="page-hd-title">{{ $tipe ? "Edit Tipe" : "Tambah Tipe Baru" }}</h1></div>
    <a href="{{ route('admin.karir-tipe.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
</div>
<form method="POST" action="{{ $tipe ? route('admin.karir-tipe.update', $tipe) : route('admin.karir-tipe.store') }}">
@csrf @if($tipe) @method('PUT') @endif
<div class="row g-4">
    <div class="col-lg-6">
        <div class="form-card mb-4">
            <div class="mb-3">
                <label class="form-label">Nama Tipe <span class="text-danger">*</span></label>
                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $tipe->nama ?? '') }}" required placeholder="Contoh: Full Time">
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label class="form-label">Warna Teks/Aksen (Hex) <span class="text-danger">*</span></label>
                <div class="d-flex align-items-center gap-2">
                    <input type="color" id="colorPickerText" class="form-control form-control-color" value="{{ old('warna', $tipe->warna ?? '#1ba99d') }}" title="Pilih Warna">
                    <input type="text" name="warna" id="colorInputText" class="form-control" value="{{ old('warna', $tipe->warna ?? '#1ba99d') }}" required>
                </div>
            </div>

            <div class="form-check mb-3 mt-4">
                <input class="form-check-input" type="checkbox" name="is_active" id="isActive" value="1" {{ old('is_active', $tipe->is_active ?? true) ? 'checked' : '' }}>
                <label class="form-check-label fw-semibold" for="isActive">Tipe Aktif</label>
            </div>

            <button type="submit" class="btn btn-primary"><i class="bi bi-save me-2"></i>{{ $tipe ? 'Simpan' : 'Tambah Tipe' }}</button>
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
</script>
@endsection
