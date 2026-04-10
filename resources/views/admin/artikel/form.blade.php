@extends('admin.layouts.app')
@section('title', $artikel ? 'Edit Artikel' : 'Tulis Artikel')
@section('page-title', $artikel ? 'Edit Artikel' : 'Tulis Artikel Baru')

@section('content')
<div class="page-hd">
    <div>
        <h1 class="page-hd-title">{{ $artikel ? 'Edit Artikel' : 'Tulis Artikel Baru' }}</h1>
    </div>
    <a href="{{ route('admin.artikel.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<form method="POST"
      action="{{ $artikel ? route('admin.artikel.update', $artikel) : route('admin.artikel.store') }}"
      enctype="multipart/form-data">
    @csrf
    @if($artikel) @method('PUT') @endif

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="form-card">
                <div class="mb-4">
                    <label class="form-label">Judul Artikel <span class="text-danger">*</span></label>
                    <input type="text" name="judul" class="form-control"
                           value="{{ old('judul', $artikel->judul ?? '') }}"
                           required placeholder="Masukkan judul artikel yang menarik..."
                           style="font-size:16px;font-weight:600;padding:14px 16px">
                </div>
                <div class="mb-4">
                    <label class="form-label">Ringkasan / Excerpt</label>
                    <textarea name="ringkasan" class="form-control" rows="2"
                              placeholder="Ringkasan singkat yang muncul di daftar artikel...">{{ old('ringkasan', $artikel->ringkasan ?? '') }}</textarea>
                    <div class="form-text">Maks 200 karakter. Jika kosong, diambil dari awal konten.</div>
                </div>
                <div class="mb-0">
                    <label class="form-label">Konten Artikel <span class="text-danger">*</span></label>
                    <textarea name="konten" class="form-control" id="kontenEditor" rows="16"
                              required>{{ old('konten', $artikel->konten ?? '') }}</textarea>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            {{-- Publish --}}
            <div class="form-card mb-4">
                <h6 class="fw-bold mb-3" style="font-size:14px;color:#374151">
                    <i class="bi bi-send me-2 text-primary"></i>Publikasi
                </h6>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="is_published"
                           id="isPublished" value="1"
                           {{ old('is_published', $artikel->is_published ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label" for="isPublished">
                        <strong>Publikasikan sekarang</strong>
                        <div class="text-muted" style="font-size:12px">Jika tidak dicentang, tersimpan sebagai draft</div>
                    </label>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kategori <span class="text-danger">*</span></label>
                    <select name="kategori_id" class="form-select" required>
                        <option value="">Pilih Kategori</option>
                        @foreach($kategoris as $k)
                        <option value="{{ $k->id }}"
                            {{ old('kategori_id', $artikel->kategori_id ?? '') == $k->id ? 'selected' : '' }}>
                            {{ $k->nama }}
                        </option>
                        @endforeach
                    </select>
                    <div class="form-text">
                        <a href="{{ route('admin.kategori-artikel.create') }}" target="_blank">
                            <i class="bi bi-plus-circle me-1"></i>Tambah kategori baru
                        </a>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-save me-2"></i>
                    {{ $artikel ? 'Simpan Perubahan' : 'Simpan Artikel' }}
                </button>
            </div>

            {{-- Thumbnail --}}
            <div class="form-card">
                <h6 class="fw-bold mb-3" style="font-size:14px;color:#374151">
                    <i class="bi bi-image me-2 text-primary"></i>Gambar Featured
                </h6>
                @if($artikel && $artikel->thumbnail)
                <div class="mb-3">
                    <img src="{{ asset('storage/'.$artikel->thumbnail) }}"
                         class="w-100 rounded-3" style="max-height:160px;object-fit:cover" id="thumbPreview">
                </div>
                @else
                <div class="mb-3" id="thumbPreviewWrap" style="display:none">
                    <img id="thumbPreview" class="w-100 rounded-3" style="max-height:160px;object-fit:cover">
                </div>
                @endif
                <input type="file" name="thumbnail" class="form-control"
                       accept="image/*" onchange="previewThumb(this)">
                <div class="form-text mt-1">JPG, PNG, WebP. Maks 3MB. Ideal 800×500px</div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
function previewThumb(input) {
    const el = document.getElementById('thumbPreview');
    const wrap = document.getElementById('thumbPreviewWrap');
    if (input.files && input.files[0]) {
        const r = new FileReader();
        r.onload = e => {
            el.src = e.target.result;
            if(wrap) wrap.style.display = 'block';
        };
        r.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
