@extends('admin.layouts.app')
@section('title', $promo ? 'Edit Promo' : 'Tambah Promo')
@section('page-title', $promo ? 'Edit Promo' : 'Tambah Promo Baru')

@section('content')
<div class="page-hd">
    <div>
        <h1 class="page-hd-title">{{ $promo ? 'Edit Promo' : 'Tambah Promo Baru' }}</h1>
    </div>
    <a href="{{ route('admin.promo.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<form method="POST"
      action="{{ $promo ? route('admin.promo.update', $promo) : route('admin.promo.store') }}"
      enctype="multipart/form-data">
    @csrf
    @if($promo) @method('PUT') @endif

    <div class="row g-4">
        {{-- LEFT: Main info --}}
        <div class="col-lg-8">
            <div class="form-card mb-4">
                <h6 class="fw-bold mb-4" style="font-size:14px;color:#374151;border-bottom:1px solid #e2e8f0;padding-bottom:12px">
                    <i class="bi bi-info-circle me-2 text-primary"></i>Informasi Promo
                </h6>
                <div class="mb-3">
                    <label class="form-label">Judul Promo <span class="text-danger">*</span></label>
                    <input type="text" name="judul" class="form-control"
                           value="{{ old('judul', $promo->judul ?? '') }}"
                           placeholder="Contoh: Paket Medical Check Up Lengkap" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3"
                              placeholder="Deskripsi singkat promo...">{{ old('deskripsi', $promo->deskripsi ?? '') }}</textarea>
                </div>

                {{-- Harga --}}
                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Harga Normal</label>
                        <input type="text" name="harga_normal" class="form-control"
                               value="{{ old('harga_normal', $promo->harga_normal ?? '') }}"
                               placeholder="Rp 1.500.000">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Harga Promo</label>
                        <input type="text" name="harga_promo" class="form-control"
                               value="{{ old('harga_promo', $promo->harga_promo ?? '') }}"
                               placeholder="Rp 850.000">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Label Diskon</label>
                        <input type="text" name="diskon" class="form-control"
                               value="{{ old('diskon', $promo->diskon ?? '') }}"
                               placeholder="43% OFF">
                    </div>
                </div>

                {{-- Benefits --}}
                <div class="mb-3">
                    <label class="form-label">
                        Benefit / Keuntungan
                        <small class="text-muted fw-normal">(satu per baris)</small>
                    </label>
                    <textarea name="benefit_text" class="form-control" rows="5"
                              placeholder="Laboratorium Lengkap (30+ parameter)&#10;Rontgen Thorax &amp; EKG&#10;Konsultasi Dokter Spesialis&#10;USG Abdomen">{{ old('benefit_text', $promo ? implode("\n", $promo->benefit ?? []) : '') }}</textarea>
                    <div class="form-text">Setiap baris = 1 item benefit yang ditampilkan di popup promo</div>
                </div>
            </div>

            {{-- Links --}}
            <div class="form-card">
                <h6 class="fw-bold mb-4" style="font-size:14px;color:#374151;border-bottom:1px solid #e2e8f0;padding-bottom:12px">
                    <i class="bi bi-link-45deg me-2 text-primary"></i>Link & Tombol Aksi
                </h6>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Link WhatsApp</label>
                        <div class="input-group">
                            <span class="input-group-text" style="background:#f0fdf4;border-color:#e2e8f0">
                                <i class="bi bi-whatsapp text-success"></i>
                            </span>
                            <input type="url" name="link_wa" class="form-control"
                                   value="{{ old('link_wa', $promo->link_wa ?? 'https://wa.link/1uk9rl') }}"
                                   placeholder="https://wa.link/...">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Link Daftar / Detail</label>
                        <input type="url" name="link_daftar" class="form-control"
                               value="{{ old('link_daftar', $promo->link_daftar ?? '') }}"
                               placeholder="https://...">
                    </div>
                </div>
            </div>
        </div>

        {{-- RIGHT: Sidebar --}}
        <div class="col-lg-4">
            {{-- Gambar --}}
            <div class="form-card mb-4">
                <h6 class="fw-bold mb-3" style="font-size:14px;color:#374151">
                    <i class="bi bi-image me-2 text-primary"></i>Gambar Promo
                </h6>
                @if($promo && $promo->gambar)
                <div class="mb-3">
                    <img src="{{ asset('storage/'.$promo->gambar) }}"
                         class="img-prev w-100" id="imgPreview">
                </div>
                @else
                <div class="mb-3" id="previewWrap" style="display:none">
                    <img id="imgPreview" class="img-prev w-100">
                </div>
                @endif
                <input type="file" name="gambar" class="form-control"
                       accept="image/*" onchange="previewImg(this,'imgPreview')">
                <div class="form-text mt-1">JPG, PNG, WebP. Maks 4MB. Ideal 800×500px</div>
            </div>

            {{-- Jadwal --}}
            <div class="form-card mb-4">
                <h6 class="fw-bold mb-3" style="font-size:14px;color:#374151">
                    <i class="bi bi-calendar-event me-2 text-primary"></i>Jadwal Promo
                </h6>
                <div class="mb-3">
                    <label class="form-label">Berlaku Mulai</label>
                    <input type="date" name="berlaku_mulai" class="form-control"
                           value="{{ old('berlaku_mulai', optional($promo->berlaku_mulai ?? null)->format('Y-m-d')) }}">
                </div>
                <div class="mb-0">
                    <label class="form-label">Berlaku Sampai</label>
                    <input type="date" name="berlaku_sampai" class="form-control"
                           value="{{ old('berlaku_sampai', optional($promo->berlaku_sampai ?? null)->format('Y-m-d')) }}">
                </div>
            </div>

            {{-- Settings --}}
            <div class="form-card mb-4">
                <h6 class="fw-bold mb-3" style="font-size:14px;color:#374151">
                    <i class="bi bi-gear me-2 text-primary"></i>Pengaturan
                </h6>
                <div class="mb-3">
                    <label class="form-label">Urutan Tampil</label>
                    <input type="number" name="urutan" class="form-control"
                           value="{{ old('urutan', $promo->urutan ?? 0) }}" min="0">
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="is_active"
                           id="isActive" value="1"
                           {{ old('is_active', $promo->is_active ?? true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="isActive">
                        <strong>Promo Aktif</strong>
                        <div class="text-muted" style="font-size:12px">Ditampilkan di website</div>
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="is_featured"
                           id="isFeatured" value="1"
                           {{ old('is_featured', $promo->is_featured ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label" for="isFeatured">
                        <strong>Promo Unggulan ⭐</strong>
                        <div class="text-muted" style="font-size:12px">Ditampilkan di popup utama</div>
                    </label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100">
                <i class="bi bi-save me-2"></i>
                {{ $promo ? 'Simpan Perubahan' : 'Tambah Promo' }}
            </button>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
function previewImg(input, id) {
    const el = document.getElementById(id);
    const wrap = document.getElementById('previewWrap');
    if (input.files && input.files[0]) {
        const r = new FileReader();
        r.onload = e => {
            el.src = e.target.result;
            el.style.display = 'block';
            if(wrap) wrap.style.display = 'block';
        };
        r.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
