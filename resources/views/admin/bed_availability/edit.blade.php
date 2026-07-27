@extends('admin.layouts.app')
@section('title','Edit Ruangan / Kelas')
@section('page-title','Info Tempat Tidur')

@section('content')
<div class="page-hd">
    <div>
        <h1 class="page-hd-title">Edit Ruangan</h1>
        <p class="page-hd-sub">Perbarui kapasitas dan jumlah keterisian tempat tidur</p>
    </div>
    <a href="{{ route('admin.bed-availability.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>Kembali
    </a>
</div>

<div class="admin-card">
    <div class="card-body p-4">
        <form action="{{ route('admin.bed-availability.update', $bedAvailability) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row mb-4">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Kelas <span class="text-danger">*</span></label>
                    <input type="text" name="kelas" class="form-control @error('kelas') is-invalid @enderror" value="{{ old('kelas', $bedAvailability->kelas) }}" required>
                    @error('kelas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Nama Ruangan</label>
                    <input type="text" name="nama_ruangan" class="form-control @error('nama_ruangan') is-invalid @enderror" value="{{ old('nama_ruangan', $bedAvailability->nama_ruangan) }}">
                    @error('nama_ruangan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            
            <div class="row mb-4">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold text-primary">Kapasitas Total <span class="text-danger">*</span></label>
                    <input type="number" name="kapasitas" class="form-control @error('kapasitas') is-invalid @enderror" value="{{ old('kapasitas', $bedAvailability->kapasitas) }}" min="0" required>
                    @error('kapasitas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold text-danger">Jumlah Terisi <small class="text-muted fw-normal">(opsional)</small></label>
                    <input type="number" name="terisi" class="form-control @error('terisi') is-invalid @enderror" value="{{ old('terisi', $bedAvailability->terisi) }}" min="0">
                    <div class="form-text">Masukkan berapa jumlah bed yang sedang digunakan. Kosongkan jika belum diketahui.</div>
                    @error('terisi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Urutan Tampil</label>
                    <input type="number" name="urutan" class="form-control @error('urutan') is-invalid @enderror" value="{{ old('urutan', $bedAvailability->urutan) }}">
                    @error('urutan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold d-block">Status Penayangan</label>
                    <div class="form-check form-switch mt-2">
                        <input class="form-check-input" type="checkbox" name="is_active" id="isActive" {{ old('is_active', $bedAvailability->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label" for="isActive">Tampilkan ke publik</label>
                    </div>
                </div>
            </div>

            <hr class="my-4">
            
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted" style="font-size:13px">
                    Tersedia saat ini: <strong class="text-success">{{ $bedAvailability->tersedia }} bed</strong>
                </div>
                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-save me-2"></i>Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
