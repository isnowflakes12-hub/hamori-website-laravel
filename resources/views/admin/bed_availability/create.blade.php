@extends('admin.layouts.app')
@section('title','Tambah Ruangan / Kelas')
@section('page-title','Info Tempat Tidur')

@section('content')
<div class="page-hd">
    <div>
        <h1 class="page-hd-title">Tambah Ruangan</h1>
        <p class="page-hd-sub">Tambahkan data kamar atau kelas baru</p>
    </div>
    <a href="{{ route('admin.bed-availability.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>Kembali
    </a>
</div>

<div class="admin-card">
    <div class="card-body p-4">
        <form action="{{ route('admin.bed-availability.store') }}" method="POST">
            @csrf
            
            <div class="row mb-4">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Kelas <span class="text-danger">*</span></label>
                    <input type="text" name="kelas" class="form-control @error('kelas') is-invalid @enderror" value="{{ old('kelas') }}" placeholder="Contoh: VIP, Kelas I, ICU" required>
                    @error('kelas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Nama Ruangan</label>
                    <input type="text" name="nama_ruangan" class="form-control @error('nama_ruangan') is-invalid @enderror" value="{{ old('nama_ruangan') }}" placeholder="Contoh: Paviliun Anggrek (Opsional)">
                    <div class="form-text">Opsional jika rumah sakit menggunakan nama spesifik.</div>
                    @error('nama_ruangan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            
            <div class="row mb-4">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold text-primary">Kapasitas Total <span class="text-danger">*</span></label>
                    <input type="number" name="kapasitas" class="form-control @error('kapasitas') is-invalid @enderror" value="{{ old('kapasitas', 0) }}" min="0" required>
                    @error('kapasitas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold text-danger">Jumlah Terisi <small class="text-muted fw-normal">(opsional)</small></label>
                    <input type="number" name="terisi" class="form-control @error('terisi') is-invalid @enderror" value="{{ old('terisi', 0) }}" min="0">
                    <div class="form-text">Masukkan berapa jumlah bed yang sedang digunakan. Kosongkan jika belum diketahui.</div>
                    @error('terisi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Urutan Tampil</label>
                    <input type="number" name="urutan" class="form-control @error('urutan') is-invalid @enderror" value="{{ old('urutan', 0) }}">
                    <div class="form-text">Semakin kecil angkanya, semakin di atas (contoh: 1 untuk VVIP).</div>
                    @error('urutan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold d-block">Status Penayangan</label>
                    <div class="form-check form-switch mt-2">
                        <input class="form-check-input" type="checkbox" name="is_active" id="isActive" checked>
                        <label class="form-check-label" for="isActive">Tampilkan ke publik</label>
                    </div>
                </div>
            </div>

            <hr class="my-4">
            
            <div class="text-end">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-save me-2"></i>Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
