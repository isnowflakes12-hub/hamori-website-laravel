@extends('admin.layouts.app')
@section('title', $karir ? 'Edit Lowongan' : 'Tambah Lowongan')
@section('page-title', $karir ? 'Edit Lowongan' : 'Tambah Lowongan Baru')
@section('content')
<div class="page-hd">
    <div><h1 class="page-hd-title">{{ $karir ? "Edit Lowongan" : "Tambah Lowongan Baru" }}</h1></div>
    <a href="{{ route('admin.karir.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
</div>
<form method="POST" action="{{ $karir ? route('admin.karir.update', $karir) : route('admin.karir.store') }}">
@csrf @if($karir) @method('PUT') @endif
<div class="row g-4">
    <div class="col-lg-8">
        <div class="form-card">
            <div class="row g-3 mb-3">
                <div class="col-md-8">
                    <label class="form-label">Nama Posisi <span class="text-danger">*</span></label>
                    <input type="text" name="posisi" class="form-control" value="{{ old('posisi', $karir->posisi ?? '') }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Kuota <span class="text-danger">*</span></label>
                    <input type="number" name="kuota" class="form-control" value="{{ old('kuota', $karir->kuota ?? 1) }}" min="1" required>
                </div>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Departemen <span class="text-danger">*</span></label>
                    <input type="text" name="departemen" class="form-control" value="{{ old('departemen', $karir->departemen ?? '') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Lokasi</label>
                    <input type="text" name="lokasi" class="form-control" value="{{ old('lokasi', $karir->lokasi ?? 'Subang, Jawa Barat') }}">
                </div>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Kategori <span class="text-danger">*</span></label>
                    <select name="kategori" class="form-select" required>
                        @foreach($kategoriList as $kat)<option value="{{ $kat }}" {{ old('kategori', $karir->kategori ?? '') == $kat ? 'selected' : '' }}>{{ $kat }}</option>@endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tipe Pekerjaan <span class="text-danger">*</span></label>
                    <select name="tipe" class="form-select" required>
                        @foreach(['full-time'=>'Full Time','part-time'=>'Part Time','kontrak'=>'Kontrak','magang'=>'Magang'] as $v=>$l)
                        <option value="{{ $v }}" {{ old('tipe', $karir->tipe ?? '') == $v ? 'selected' : '' }}>{{ $l }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi Pekerjaan <span class="text-danger">*</span></label>
                <textarea name="deskripsi" class="form-control" rows="5" required>{{ old('deskripsi', $karir->deskripsi ?? '') }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Persyaratan <span class="text-danger">*</span></label>
                <textarea name="persyaratan" class="form-control" rows="5" required placeholder="- S1 Keperawatan&#10;- STR aktif&#10;- Pengalaman min. 1 tahun">{{ old('persyaratan', $karir->persyaratan ?? '') }}</textarea>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-card mb-4">
            <h6 class="fw-bold mb-3">Pengaturan</h6>
            <div class="mb-3">
                <label class="form-label">Batas Lamaran</label>
                <input type="date" name="batas_lamaran" class="form-control" value="{{ old('batas_lamaran', optional($karir->batas_lamaran ?? null)->format('Y-m-d')) }}">
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="is_active" id="isActive" value="1" {{ old('is_active', $karir->is_active ?? true) ? 'checked' : '' }}>
                <label class="form-check-label fw-semibold" for="isActive">Lowongan aktif</label>
            </div>
            <button type="submit" class="btn btn-primary w-100"><i class="bi bi-save me-2"></i>{{ $karir ? 'Simpan' : 'Tambah Lowongan' }}</button>
        </div>
    </div>
</div>
</form>
@endsection