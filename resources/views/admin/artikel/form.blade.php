@extends('admin.layouts.app')
@section('title', $artikel ? 'Edit Artikel' : 'Tulis Artikel')
@section('page-title', $artikel ? 'Edit Artikel' : 'Tulis Artikel Baru')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
<style>
.choices__inner { border-radius: 10px; border: 1.5px solid #e5eaf0; background-color: #fff; padding-bottom: 0px; }
.choices[data-type*="select-multiple"] .choices__button, .choices[data-type*="text"] .choices__button {
    border-left: 1px solid rgba(255,255,255,.5);
    margin-left: 5px;
}
.choices__list--multiple .choices__item {
    background-color: #0055a5;
    border: 1px solid #003d7a;
    border-radius: 6px;
}
</style>
@endpush

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
                <label class="form-label">
                    Konten Artikel <span class="text-danger">*</span>
                </label>

                <textarea
                    name="konten"
                    id="kontenEditor"
                    class="form-control"
                    rows="16">{{ old('konten', $artikel->konten ?? '') }}</textarea>
            </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="form-card mb-4">
                <h6 class="fw-bold mb-3" style="font-size:14px;color:#374151">
                    <i class="bi bi-tags me-2 text-primary"></i>Kategori & Publikasi
                </h6>
                <div class="alert alert-info py-2" style="font-size:12px;">
                    <i class="bi bi-info-circle me-1"></i> Artikel akan langsung dipublikasikan.
                </div>
                <div class="mb-3">
                    <label class="form-label">Kategori <span class="text-danger">*</span></label>
                    <div class="form-text mb-2">Tahan tombol Ctrl (Windows) atau Command (Mac) untuk memilih lebih dari satu kategori.</div>
                    @php
                        $selectedKategoris = old('kategori_ids', $artikel ? $artikel->kategoris->pluck('id')->toArray() : []);
                    @endphp
                    <select name="kategori_ids[]" id="kategoriSelect" class="form-select" multiple required>
                        @foreach($kategoris as $k)
                        <option value="{{ $k->id }}"
                            {{ in_array($k->id, (array)$selectedKategoris) ? 'selected' : '' }}>
                            {{ $k->nama }}
                        </option>
                        @endforeach
                    </select>
                    <div class="form-text mt-2">
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

            <div class="form-card mt-4">
                <h6 class="fw-bold mb-3" style="font-size:14px;color:#374151">
                    <i class="bi bi-images me-2 text-primary"></i>Galeri (Opsional)
                </h6>
                <div class="form-text mb-2">Upload beberapa gambar untuk dijadikan slider.</div>
                
                @if($artikel && is_array($artikel->galeri) && count($artikel->galeri) > 0)
                <div class="d-flex flex-wrap gap-2 mb-3">
                    @foreach($artikel->galeri as $i => $img)
                    <div class="position-relative" style="width:80px;height:80px">
                        <img src="{{ asset('storage/'.$img) }}" class="w-100 h-100 rounded object-fit-cover">
                        <label class="position-absolute top-0 end-0 bg-danger text-white rounded-circle p-1 m-1 cursor-pointer" style="line-height:1;cursor:pointer" title="Hapus gambar ini">
                            <input type="checkbox" name="delete_galeri[]" value="{{ $img }}" class="d-none">
                            <i class="bi bi-trash" style="font-size:10px"></i>
                        </label>
                    </div>
                    @endforeach
                </div>
                <div class="form-text text-danger mb-3" style="font-size:11px"><i class="bi bi-info-circle"></i> Klik ikon tempat sampah untuk menghapus gambar dari galeri.</div>
                @endif

                <input type="file" name="galeri[]" class="form-control" multiple accept="image/*">
                <div class="form-text mt-1">Pilih beberapa file sekaligus.</div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    new Choices('#kategoriSelect', {
        removeItemButton: true,
        placeholderValue: 'Pilih Kategori...',
        searchPlaceholderValue: 'Cari kategori...',
        noResultsText: 'Kategori tidak ditemukan',
        noChoicesText: 'Tidak ada kategori lagi untuk dipilih',
        itemSelectText: 'Tekan untuk memilih',
    });
});

function previewThumb(input) {
    const el = document.getElementById('thumbPreview');
    const wrap = document.getElementById('thumbPreviewWrap');

    if (input.files && input.files[0]) {
        const r = new FileReader();

        r.onload = function(e) {
            el.src = e.target.result;

            if (wrap) {
                wrap.style.display = 'block';
            }
        };

        r.readAsDataURL(input.files[0]);
    }
}

let editor;

ClassicEditor
    .create(document.querySelector('#kontenEditor'))
    .then(newEditor => {

        editor = newEditor;

        const form = document.querySelector('form');

        form.addEventListener('submit', function(e) {

            const isi = editor.getData().trim();

            if (isi === '') {
                e.preventDefault();

                alert('Konten artikel wajib diisi');

                editor.editing.view.focus();

                return false;
            }

            document.querySelector('#kontenEditor').value = isi;
        });

    })
    .catch(error => {
        console.error(error);
    });
</script>
@endpush