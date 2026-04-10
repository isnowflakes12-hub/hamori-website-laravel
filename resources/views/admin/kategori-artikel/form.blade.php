@extends('admin.layouts.app')
@section('title', $kategori ? 'Edit Kategori' : 'Tambah Kategori')
@section('page-title', $kategori ? 'Edit Kategori Artikel' : 'Tambah Kategori Artikel')

@section('content')
<div class="page-hd">
    <div>
        <h1 class="page-hd-title">{{ $kategori ? 'Edit Kategori' : 'Tambah Kategori Baru' }}</h1>
    </div>
    <a href="{{ route('admin.kategori-artikel.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<div class="row justify-content-center">
<div class="col-lg-7">
<div class="form-card">
    <form method="POST"
          action="{{ $kategori ? route('admin.kategori-artikel.update', $kategori) : route('admin.kategori-artikel.store') }}">
        @csrf
        @if($kategori) @method('PUT') @endif

        <div class="mb-4">
            <label class="form-label">Nama Kategori <span class="text-danger">*</span></label>
            <input type="text" name="nama" class="form-control"
                   value="{{ old('nama', $kategori->nama ?? '') }}"
                   placeholder="Contoh: Kardiologi, Kesehatan Ibu, Tips Sehat..."
                   required autofocus>
        </div>

        <div class="mb-4">
            <label class="form-label">Deskripsi <span class="text-muted fw-normal">(opsional)</span></label>
            <textarea name="deskripsi" class="form-control" rows="3"
                      placeholder="Deskripsi singkat tentang kategori ini...">{{ old('deskripsi', $kategori->deskripsi ?? '') }}</textarea>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <label class="form-label">Warna Kategori</label>
                <div class="d-flex gap-2 align-items-center">
                    <input type="color" name="warna" id="warnaInput"
                           value="{{ old('warna', $kategori->warna ?? '#005bab') }}"
                           style="width:44px;height:40px;border-radius:8px;border:1.5px solid #e2e8f0;padding:2px;cursor:pointer">
                    <input type="text" id="warnaText"
                           value="{{ old('warna', $kategori->warna ?? '#005bab') }}"
                           class="form-control" style="max-width:100px;font-family:monospace"
                           onchange="document.getElementById('warnaInput').value=this.value">
                </div>
                <div class="form-text">Digunakan untuk label kategori di website</div>
            </div>
            <div class="col-md-6">
                <label class="form-label">Urutan Tampil</label>
                <input type="number" name="urutan" class="form-control"
                       value="{{ old('urutan', $kategori->urutan ?? 0) }}" min="0">
                <div class="form-text">Semakin kecil angka, semakin awal tampil</div>
            </div>
        </div>

        {{-- Preview --}}
        <div class="mb-4 p-3 rounded-3" style="background:#f8fafc;border:1px solid #e2e8f0">
            <div class="form-text mb-2">Preview label kategori:</div>
            <span id="katPreview" style="font-size:10px;font-weight:800;letter-spacing:2px;text-transform:uppercase;padding:4px 12px;border-radius:100px;color:#fff;background:{{ $kategori->warna ?? '#005bab' }}">
                {{ $kategori->nama ?? 'Nama Kategori' }}
            </span>
        </div>

        <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" name="is_active" id="isActive" value="1"
                   {{ old('is_active', $kategori->is_active ?? true) ? 'checked' : '' }}>
            <label class="form-check-label fw-semibold" for="isActive">Kategori aktif</label>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save me-2"></i>{{ $kategori ? 'Simpan Perubahan' : 'Tambah Kategori' }}
            </button>
            <a href="{{ route('admin.kategori-artikel.index') }}" class="btn btn-outline-secondary">Batal</a>
        </div>
    </form>
</div>
</div>
</div>
@endsection

@push('scripts')
<script>
const warnaInput = document.getElementById('warnaInput');
const warnaText  = document.getElementById('warnaText');
const namaInput  = document.querySelector('input[name="nama"]');
const preview    = document.getElementById('katPreview');

warnaInput.addEventListener('input', function() {
    warnaText.value   = this.value;
    preview.style.background = this.value;
});
namaInput && namaInput.addEventListener('input', function() {
    preview.textContent = this.value || 'Nama Kategori';
});
</script>
@endpush
