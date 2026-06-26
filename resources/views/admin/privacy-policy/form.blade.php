@extends('admin.layouts.app')
@section('title', $policy ? 'Edit Kebijakan Privasi' : 'Tambah Kebijakan Privasi')
@section('page-title', $policy ? 'Edit Kebijakan Privasi' : 'Tambah Kebijakan Privasi')
@section('content')
<div class="page-hd">
    <div><h1 class="page-hd-title">{{ $policy ? 'Edit Bagian' : 'Tambah Bagian' }}</h1></div>
    <a href="{{ route('admin.privacy-policy.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
</div>
<div class="row g-4">
    <div class="col-lg-8">
        <div class="form-card">
            <form method="POST" action="{{ $policy ? route('admin.privacy-policy.update', $policy) : route('admin.privacy-policy.store') }}">
                @csrf @if($policy) @method('PUT') @endif
                <div class="mb-3">
                    <label class="form-label">Judul Bagian <span class="text-danger">*</span></label>
                    <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul', $policy->judul ?? '') }}" placeholder="Contoh: Pengumpulan Informasi" required>
                    @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Konten <span class="text-danger">*</span></label>
                    <textarea name="konten" class="form-control @error('konten') is-invalid @enderror" rows="8" placeholder="Tuliskan isi kebijakan privasi..." required>{{ old('konten', $policy->konten ?? '') }}</textarea>
                    @error('konten')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Urutan</label>
                        <input type="number" name="urutan" class="form-control" value="{{ old('urutan', $policy->urutan ?? 0) }}" min="0">
                    </div>
                </div>
                <div class="form-check mt-3">
                    <input class="form-check-input" type="checkbox" name="is_active" id="isActive" value="1" {{ old('is_active', $policy->is_active ?? true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="isActive">Bagian aktif (ditampilkan di website)</label>
                </div>
                <hr class="my-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-2"></i>{{ $policy ? 'Simpan Perubahan' : 'Tambah Bagian' }}</button>
            </form>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-card">
            <h6 class="fw-bold mb-3"><i class="bi bi-info-circle me-2"></i>Panduan</h6>
            <ul style="font-size:13px;color:#64748b;padding-left:16px">
                <li class="mb-2">Setiap bagian mewakili satu poin kebijakan privasi</li>
                <li class="mb-2"><strong>Judul</strong>: Nama bagian (contoh: "Pengumpulan Informasi")</li>
                <li class="mb-2"><strong>Konten</strong>: Penjelasan lengkap dari bagian tersebut</li>
                <li class="mb-2"><strong>Urutan</strong>: Angka kecil ditampilkan lebih dulu</li>
                <li>Bagian dengan status <strong>nonaktif</strong> tidak akan tampil di website</li>
            </ul>
        </div>
    </div>
</div>
@endsection
