@extends('admin.layouts.app')
@section('title', $layanan ? 'Edit Layanan' : 'Tambah Layanan')
@section('page-title', $layanan ? 'Edit Layanan Unggulan' : 'Tambah Layanan Unggulan')

@section('content')
<div class="page-hd">
    <div>
        <h1 class="page-hd-title">{{ $layanan ? 'Edit Layanan' : 'Tambah Layanan Baru' }}</h1>
    </div>
    <a href="{{ route('admin.layanan.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<form method="POST"
      action="{{ $layanan ? route('admin.layanan.update', $layanan) : route('admin.layanan.store') }}"
      enctype="multipart/form-data">
    @csrf
    @if($layanan) @method('PUT') @endif

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="form-card mb-4">
                <h6 class="fw-bold mb-4" style="font-size:14px;color:#374151;border-bottom:1px solid #e2e8f0;padding-bottom:12px">
                    <i class="bi bi-info-circle me-2 text-primary"></i>Informasi Layanan
                </h6>
                <div class="mb-3">
                    <label class="form-label">Nama Layanan <span class="text-danger">*</span></label>
                    <input type="text" name="nama" class="form-control" required
                           value="{{ old('nama', $layanan->nama ?? '') }}"
                           placeholder="Contoh: Kardiologi, Kebidanan, Neurologi...">
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi Singkat</label>
                    <input type="text" name="deskripsi_singkat" class="form-control"
                           value="{{ old('deskripsi_singkat', $layanan->deskripsi_singkat ?? '') }}"
                           placeholder="Kalimat singkat untuk card di beranda (maks 100 karakter)"
                           maxlength="100">
                    <div class="form-text">Ditampilkan di card layanan di halaman beranda</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi Lengkap</label>
                    <textarea name="deskripsi" class="form-control" rows="4"
                              placeholder="Deskripsi layanan untuk halaman detail...">{{ old('deskripsi', $layanan->deskripsi ?? '') }}</textarea>
                </div>
                <div class="mb-0">
                    <label class="form-label">Konten Detail <span class="text-muted fw-normal">(HTML diizinkan)</span></label>
                    <textarea name="konten" class="form-control" rows="8"
                              placeholder="Konten lengkap halaman detail layanan...">{{ old('konten', $layanan->konten ?? '') }}</textarea>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            {{-- Logo --}}
            <div class="form-card mb-4">
                <h6 class="fw-bold mb-3" style="font-size:14px;color:#374151">
                    <i class="bi bi-image me-2 text-primary"></i>Logo / Ikon Layanan
                </h6>
                @if($layanan && $layanan->logo)
                <div class="mb-3 text-center p-3" style="background:#f8fafc;border-radius:12px">
                    <img src="{{ asset('storage/'.$layanan->logo) }}"
                         style="max-width:80px;max-height:80px;object-fit:contain" id="logoPreview">
                </div>
                @else
                <div class="mb-3 text-center p-3" id="logoPreviewWrap" style="background:#f8fafc;border-radius:12px;display:none">
                    <img id="logoPreview" style="max-width:80px;max-height:80px;object-fit:contain">
                </div>
                @endif
                <input type="file" name="logo" class="form-control" accept="image/*"
                       onchange="previewImg(this,'logoPreview')">
                <div class="form-text mt-1">PNG/SVG transparan. Maks 2MB. Ideal 200×200px</div>
            </div>

            {{-- Settings --}}
            <div class="form-card mb-4">
                <h6 class="fw-bold mb-3" style="font-size:14px;color:#374151">
                    <i class="bi bi-gear me-2 text-primary"></i>Pengaturan
                </h6>
                <div class="mb-3">
                    <label class="form-label">Urutan Tampil</label>
                    <input type="number" name="urutan" class="form-control"
                           value="{{ old('urutan', $layanan->urutan ?? 0) }}" min="0">
                    <div class="form-text">Angka kecil = tampil lebih awal</div>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="is_active"
                           id="isActive" value="1"
                           {{ old('is_active', $layanan->is_active ?? true) ? 'checked' : '' }}>
                    <label class="form-check-label fw-semibold" for="isActive">
                        Layanan aktif (ditampilkan di website)
                    </label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100">
                <i class="bi bi-save me-2"></i>
                {{ $layanan ? 'Simpan Perubahan' : 'Tambah Layanan' }}
            </button>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
function previewImg(input, id) {
    const el = document.getElementById(id);
    const wrap = document.getElementById('logoPreviewWrap');
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
