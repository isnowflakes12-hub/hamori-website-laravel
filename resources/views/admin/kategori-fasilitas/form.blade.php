@extends('admin.layouts.app')
@section('title', $kategori ? 'Edit Kategori Fasilitas' : 'Tambah Kategori Fasilitas')
@section('page-title', $kategori ? 'Edit Kategori Fasilitas' : 'Tambah Kategori Fasilitas')
@section('content')
<div class="page-hd">
    <div>
        <h1 class="page-hd-title">{{ $kategori ? 'Edit Kategori' : 'Tambah Kategori' }}</h1>
    </div>
    <a href="{{ route('admin.kategori-fasilitas.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="form-card">
            <form method="POST" action="{{ $kategori ? route('admin.kategori-fasilitas.update', $kategori->id) : route('admin.kategori-fasilitas.store') }}">
                @csrf 
                @if($kategori) @method('PUT') @endif
                
                <div class="mb-3">
                    <label class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $kategori->nama ?? '') }}" placeholder="Contoh: Rawat Inap" required>
                    @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi Singkat</label>
                    <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="3" placeholder="Penjelasan singkat kategori...">{{ old('deskripsi', $kategori->deskripsi ?? '') }}</textarea>
                    @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Urutan</label>
                        <input type="number" name="urutan" class="form-control @error('urutan') is-invalid @enderror" value="{{ old('urutan', $kategori->urutan ?? 0) }}">
                        <div class="form-text">Urutan tampilan (angka terkecil tampil lebih dulu)</div>
                        @error('urutan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="form-check mt-3">
                    <input class="form-check-input" type="checkbox" name="is_active" id="isActive" value="1" {{ old('is_active', $kategori->is_active ?? true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="isActive">Tampilkan kategori ini</label>
                </div>

                <hr class="my-4">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i>{{ $kategori ? 'Simpan Perubahan' : 'Tambah Kategori' }}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
