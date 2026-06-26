@extends('admin.layouts.app')
@section('title', $milestone->id ? 'Edit Milestone' : 'Tambah Milestone')
@section('page-title', 'Milestone')

@section('content')

<div class="page-hd">
    <div>
        <a href="{{ route('admin.milestone.index') }}" class="text-muted text-decoration-none mb-2 d-inline-block">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke daftar
        </a>
        <h1 class="page-hd-title">{{ $milestone->id ? 'Edit Milestone' : 'Tambah Milestone Baru' }}</h1>
    </div>
</div>

<div class="admin-card" style="max-width:800px">
    <form action="{{ $milestone->id ? route('admin.milestone.update', $milestone) : route('admin.milestone.store') }}" 
          method="POST" enctype="multipart/form-data">
        @csrf
        @if($milestone->id) @method('PUT') @endif

        <div class="row g-4">
            <div class="col-md-4">
                <label class="form-label">Tahun <span class="text-danger">*</span></label>
                <input type="number" name="tahun" class="form-control @error('tahun') is-invalid @enderror" 
                       value="{{ old('tahun', $milestone->tahun ?? date('Y')) }}" required>
                @error('tahun')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-8">
                <label class="form-label">Judul Pencapaian <span class="text-danger">*</span></label>
                <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" 
                       value="{{ old('judul', $milestone->judul) }}" required>
                @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12">
                <label class="form-label">Deskripsi <span class="text-danger">*</span></label>
                <textarea name="deskripsi" rows="4" class="form-control @error('deskripsi') is-invalid @enderror" required>{{ old('deskripsi', $milestone->deskripsi) }}</textarea>
                @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12">
                <label class="form-label">Gambar/Foto (Opsional)</label>
                @if($milestone->gambar)
                    <div class="mb-2">
                        <img src="{{ asset('storage/'.$milestone->gambar) }}" alt="Gambar" style="height:120px;border-radius:6px">
                    </div>
                @endif
                <input type="file" name="gambar" class="form-control" accept="image/*">
            </div>

            <div class="col-12 text-end mt-4">
                <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save me-2"></i>Simpan Milestone</button>
            </div>
        </div>
    </form>
</div>

@endsection
