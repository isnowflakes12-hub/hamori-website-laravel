@extends('admin.layouts.app')
@section('title', $faq ? 'Edit FAQ' : 'Tambah FAQ')
@section('page-title', $faq ? 'Edit FAQ' : 'Tambah FAQ')
@section('content')
<div class="page-hd">
    <div><h1 class="page-hd-title">{{ $faq ? 'Edit FAQ' : 'Tambah FAQ' }}</h1></div>
    <a href="{{ route('admin.faq.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
</div>
<div class="row g-4">
    <div class="col-lg-8">
        <div class="form-card">
            <form method="POST" action="{{ $faq ? route('admin.faq.update', $faq) : route('admin.faq.store') }}">
                @csrf @if($faq) @method('PUT') @endif
                <div class="mb-3">
                    <label class="form-label">Pertanyaan <span class="text-danger">*</span></label>
                    <input type="text" name="pertanyaan" class="form-control @error('pertanyaan') is-invalid @enderror" value="{{ old('pertanyaan', $faq->pertanyaan ?? '') }}" placeholder="Tuliskan pertanyaan..." required>
                    @error('pertanyaan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Jawaban <span class="text-danger">*</span></label>
                    <textarea name="jawaban" class="form-control @error('jawaban') is-invalid @enderror" rows="6" placeholder="Tuliskan jawaban..." required>{{ old('jawaban', $faq->jawaban ?? '') }}</textarea>
                    @error('jawaban')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Urutan</label>
                        <input type="number" name="urutan" class="form-control" value="{{ old('urutan', $faq->urutan ?? 0) }}" min="0">
                    </div>
                </div>
                <div class="form-check mt-3">
                    <input class="form-check-input" type="checkbox" name="is_active" id="isActive" value="1" {{ old('is_active', $faq->is_active ?? true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="isActive">FAQ aktif (ditampilkan di website)</label>
                </div>
                <hr class="my-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-2"></i>{{ $faq ? 'Simpan Perubahan' : 'Tambah FAQ' }}</button>
            </form>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-card">
            <h6 class="fw-bold mb-3"><i class="bi bi-info-circle me-2"></i>Panduan</h6>
            <ul style="font-size:13px;color:#64748b;padding-left:16px">
                <li class="mb-2">Tulis pertanyaan yang sering ditanyakan oleh pasien atau pengunjung</li>
                <li class="mb-2">Jawaban harus jelas dan informatif</li>
                <li class="mb-2"><strong>Urutan</strong>: Angka kecil ditampilkan lebih dulu</li>
                <li>FAQ dengan status <strong>nonaktif</strong> tidak akan tampil di website</li>
            </ul>
        </div>
    </div>
</div>
@endsection
