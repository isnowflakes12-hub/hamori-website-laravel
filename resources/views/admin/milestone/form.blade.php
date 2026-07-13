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

<div class="admin-card" style="max-width:900px">
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
                <label class="form-label">Foto Utama (Thumbnail)</label>
                @if($milestone->gambar)
                    <div class="mb-2">
                        <img src="{{ asset('storage/'.$milestone->gambar) }}" alt="Thumbnail"
                             style="height:120px; border-radius:8px; border:1px solid #e2e8f0;">
                        <div class="form-text">Upload baru untuk mengganti gambar yang ada.</div>
                    </div>
                @endif
                <input type="file" name="gambar" class="form-control" accept="image/*">
            </div>

            <div class="col-12">
                <label class="form-label">Galeri Foto Kejadian <span class="text-muted fw-normal">(banyak gambar)</span></label>

                @if($milestone->id && is_array($milestone->galeri) && count($milestone->galeri) > 0)
                <div class="mb-3">
                    <p class="form-text mb-2">Foto galeri yang sudah ada. Centang untuk menghapus:</p>
                    <div class="row g-2">
                        @foreach($milestone->galeri as $img)
                        <div class="col-auto">
                            <div style="position:relative; display:inline-block;">
                                <img src="{{ asset('storage/'.$img) }}" alt="Galeri"
                                     style="height:100px; width:100px; object-fit:cover; border-radius:8px; border:1px solid #e2e8f0;">
                                <div style="position:absolute; top:4px; right:4px; background:rgba(0,0,0,0.6); border-radius:4px; padding:2px 5px;">
                                    <label style="cursor:pointer; color:#fff; font-size:11px; display:flex; align-items:center; gap:4px; margin:0;">
                                        <input type="checkbox" name="delete_galeri[]" value="{{ $img }}"
                                               style="accent-color:#e53e3e;">
                                        Hapus
                                    </label>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <input type="file" name="galeri[]" class="form-control" accept="image/*" multiple
                       id="galeriInput" onchange="previewGaleri(this)">
                <div class="form-text">Pilih beberapa file sekaligus. Format: JPG, PNG, WEBP. Maks 3MB per foto.</div>
                <div id="galeriPreview" class="row g-2 mt-2"></div>
            </div>

            <div class="col-12 text-end mt-4">
                <a href="{{ route('admin.milestone.index') }}" class="btn btn-secondary me-2">Batal</a>
                <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save me-2"></i>Simpan Milestone</button>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
function previewGaleri(input) {
    const container = document.getElementById('galeriPreview');
    container.innerHTML = '';
    if (!input.files || !input.files.length) return;
    Array.from(input.files).forEach(file => {
        const reader = new FileReader();
        reader.onload = function(e) {
            const col = document.createElement('div');
            col.className = 'col-auto';
            col.innerHTML = `<img src="${e.target.result}" style="height:100px; width:100px; object-fit:cover; border-radius:8px; border:1px solid #e2e8f0;">`;
            container.appendChild(col);
        };
        reader.readAsDataURL(file);
    });
}
</script>
@endpush

@endsection
