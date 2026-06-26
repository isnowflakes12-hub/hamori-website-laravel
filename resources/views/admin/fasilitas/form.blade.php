@extends('admin.layouts.app')
@section('title', $fasilitas ? 'Edit Fasilitas' : 'Tambah Fasilitas')
@section('page-title', $fasilitas ? 'Edit Fasilitas' : 'Tambah Fasilitas')
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endpush
@section('content')
<div class="page-hd">
    <div><h1 class="page-hd-title">{{ $fasilitas ? 'Edit Fasilitas' : 'Tambah Fasilitas' }}</h1></div>
    <a href="{{ route('admin.fasilitas.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
</div>
<div class="row g-4">
    <div class="col-lg-8">
        <div class="form-card">
            <form method="POST" action="{{ $fasilitas ? route('admin.fasilitas.update', $fasilitas->id) : route('admin.fasilitas.store') }}" enctype="multipart/form-data">
                @csrf @if($fasilitas) @method('PUT') @endif
                
                <div class="row g-3 mb-3">
                    <div class="col-md-7">
                        <label class="form-label">Nama Fasilitas <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $fasilitas->nama ?? '') }}" placeholder="Contoh: Kamar VIP" required>
                        @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-5">
                        <label class="form-label">Kategori <span class="text-danger">*</span></label>
                        <select name="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Kategori --</option>
                            @php $kat_id = old('kategori_id', $fasilitas->kategori_id ?? ''); @endphp
                            @foreach($kategori as $kat)
                                <option value="{{ $kat->id }}" {{ $kat_id == $kat->id ? 'selected' : '' }}>{{ $kat->nama }}</option>
                            @endforeach
                        </select>
                        @error('kategori_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gambar/Galeri Fasilitas</label>
                    @if($fasilitas && !empty($fasilitas->galeri))
                        <div class="mb-2 d-flex flex-wrap gap-2">
                            @foreach($fasilitas->galeri as $img)
                                <img src="{{ asset('storage/'.$img) }}" class="img-prev border rounded" style="max-height: 80px; object-fit: cover;">
                            @endforeach
                        </div>
                        <div class="form-text text-warning mb-2"><i class="bi bi-info-circle me-1"></i>Mengupload gambar baru akan menimpa seluruh galeri ini.</div>
                    @elseif($fasilitas && $fasilitas->gambar)
                        <div class="mb-2"><img src="{{ asset('storage/'.$fasilitas->gambar) }}" class="img-prev border rounded" style="max-height: 80px; object-fit: cover;"></div>
                    @endif
                    <input type="file" name="gambar[]" class="form-control" accept="image/*" multiple onchange="previewMultipleImg(this,'prevGambarContainer')">
                    <div class="form-text">Bisa pilih lebih dari 1 gambar. Format: JPG, PNG, WebP. Maks 5MB per gambar.</div>
                    <div id="prevGambarContainer" class="d-flex flex-wrap gap-2 mt-2"></div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi Singkat</label>
                    <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="3" placeholder="Penjelasan singkat mengenai fasilitas ini...">{{ old('deskripsi', $fasilitas->deskripsi ?? '') }}</textarea>
                    @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Konten Lengkap</label>
                    <textarea name="konten" id="summernote" class="form-control">{{ old('konten', $fasilitas->konten ?? '') }}</textarea>
                </div>

                <div class="form-check mt-3">
                    <input class="form-check-input" type="checkbox" name="is_active" id="isActive" value="1" {{ old('is_active', $fasilitas->is_active ?? true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="isActive">Tampilkan fasilitas ini di website</label>
                </div>

                <hr class="my-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-2"></i>{{ $fasilitas ? 'Simpan Perubahan' : 'Tambah Fasilitas' }}</button>
            </form>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-card">
            <h6 class="fw-bold mb-3"><i class="bi bi-info-circle me-2"></i>Panduan</h6>
            <ul style="font-size:13px;color:#64748b;padding-left:16px;line-height:1.7">
                <li class="mb-2"><strong>Kategori:</strong> Tentukan kategori untuk pengelompokan di website. Contoh: Rawat Inap untuk daftar kelas-kelas kamar.</li>
                <li class="mb-2"><strong>Deskripsi Singkat:</strong> Akan ditampilkan di kartu daftar fasilitas.</li>
                <li class="mb-2"><strong>Konten Lengkap:</strong> Digunakan untuk halaman detail (misal: merinci daftar alat di dalam kamar).</li>
            </ul>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
$('#summernote').summernote({
    placeholder: 'Tuliskan deskripsi lengkap fasilitas di sini...',
    tabsize: 2,
    height: 250,
    toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['insert', ['link']],
        ['view', ['codeview']]
    ]
});
function previewMultipleImg(input, containerId) {
    const container = document.getElementById(containerId);
    container.innerHTML = ''; // clear existing previews
    if (input.files) {
        Array.from(input.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'img-prev border rounded';
                img.style.maxHeight = '80px';
                img.style.objectFit = 'cover';
                container.appendChild(img);
            }
            reader.readAsDataURL(file);
        });
    }
}
</script>
@endpush
