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

{{-- Featured info --}}
@if($featured->count() > 0)
<div class="alert mb-4" style="background:#fffbeb;border-radius:12px;border:1px solid #fbbf24;font-size:13px">
    <strong>⭐ Promo unggulan saat ini ({{ $featured->count() }}/3):</strong>
    {{ $featured->pluck('judul')->implode(', ') }}
    @if(!$canFeatured)
    <div class="mt-1" style="color:#d93025;font-weight:600">Slot unggulan penuh. Hapus salah satu sebelum menandai promo ini sebagai unggulan.</div>
    @endif
</div>
@endif

<form method="POST"
      action="{{ $promo ? route('admin.promo.update', $promo) : route('admin.promo.store') }}"
      enctype="multipart/form-data">
    @csrf
    @if($promo) @method('PUT') @endif

    <div class="row g-4">

        {{-- ── LEFT: Konten Utama ── --}}
        <div class="col-lg-8">

            {{-- Informasi Promo --}}
            <div class="form-card mb-4">
                <h6 class="fw-bold mb-4" style="font-size:14px;color:#374151;border-bottom:1px solid #e2e8f0;padding-bottom:12px">
                    <i class="bi bi-info-circle me-2 text-primary"></i>Informasi Promo
                </h6>

                {{-- Judul --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Judul Promo <span class="text-danger">*</span></label>
                    <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                           value="{{ old('judul', $promo->judul ?? '') }}"
                           maxlength="150" required
                           placeholder="Contoh: Paket Medical Check Up Lengkap">
                    @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Deskripsi Singkat --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Deskripsi Singkat
                        <span class="text-muted fw-normal float-end" id="descCount" style="font-size:12px"></span>
                    </label>
                    <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror"
                              rows="3" maxlength="300"
                              oninput="countChars(this,'descCount',300)"
                              placeholder="Deskripsi singkat yang ditampilkan di halaman promo...">{{ old('deskripsi', $promo->deskripsi ?? '') }}</textarea>
                    <div class="form-text">Maks. 300 karakter. Ditampilkan di kartu promo.</div>
                    @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Detail --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Detail Promo
                        <span class="text-muted fw-normal float-end" id="detailCount" style="font-size:12px"></span>
                    </label>
                    <textarea name="detail" class="form-control @error('detail') is-invalid @enderror"
                              rows="5" maxlength="1000"
                              oninput="countChars(this,'detailCount',1000)"
                              placeholder="Penjelasan lengkap mengenai promo ini...">{{ old('detail', $promo->detail ?? '') }}</textarea>
                    <div class="form-text">Maks. 1000 karakter. Ditampilkan di halaman detail promo.</div>
                    @error('detail') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            {{-- Benefit & Cara Mendapatkan --}}
            <div class="form-card mb-4">
                <h6 class="fw-bold mb-4" style="font-size:14px;color:#374151;border-bottom:1px solid #e2e8f0;padding-bottom:12px">
                    <i class="bi bi-list-check me-2 text-success"></i>Benefit & Cara Mendapatkan
                </h6>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Benefit / Keuntungan
                            <small class="text-muted fw-normal">(satu per baris)</small>
                        </label>
                        <textarea name="benefit_text" class="form-control" rows="6"
                                  placeholder="Laboratorium Lengkap&#10;Rontgen Thorax &amp; EKG&#10;Konsultasi Dokter Spesialis">{{ old('benefit_text', $promo ? implode("\n", $promo->benefit ?? []) : '') }}</textarea>
                        <div class="form-text">Setiap baris = 1 item benefit.</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Cara Mendapatkan
                            <small class="text-muted fw-normal">(satu langkah per baris)</small>
                        </label>
                        <textarea name="cara_mendapatkan_text" class="form-control" rows="6"
                                  placeholder="Hubungi kami via WhatsApp&#10;Pilih jadwal yang tersedia&#10;Datang ke RS Hamori&#10;Tunjukkan bukti pendaftaran">{{ old('cara_mendapatkan_text', $promo ? implode("\n", $promo->cara_mendapatkan ?? []) : '') }}</textarea>
                        <div class="form-text">Setiap baris = 1 langkah.</div>
                    </div>
                </div>
            </div>

            {{-- Syarat & Ketentuan --}}
            <div class="form-card mb-0">
                <h6 class="fw-bold mb-4" style="font-size:14px;color:#374151;border-bottom:1px solid #e2e8f0;padding-bottom:12px">
                    <i class="bi bi-shield-check me-2 text-warning"></i>Syarat & Ketentuan
                </h6>
                <textarea name="syarat_ketentuan" class="form-control" rows="5"
                          placeholder="Promo berlaku untuk pasien umum (non-BPJS)&#10;Tidak dapat digabung dengan promo lain&#10;Berlaku selama persediaan masih ada">{{ old('syarat_ketentuan', $promo->syarat_ketentuan ?? '') }}</textarea>
                <div class="form-text mt-1">Tuliskan syarat & ketentuan yang berlaku untuk promo ini.</div>
            </div>

        </div>

        {{-- ── RIGHT: Sidebar ── --}}
        <div class="col-lg-4">

            {{-- Gambar Promo --}}
            <div class="form-card mb-4">
                <h6 class="fw-bold mb-3" style="font-size:14px;color:#374151">
                    <i class="bi bi-image me-2 text-primary"></i>Gambar Promo
                </h6>
                <div class="mb-3" id="previewWrap" style="{{ ($promo && $promo->gambar) ? '' : 'display:none' }}">
                    <img src="{{ $promo && $promo->gambar ? asset('storage/'.$promo->gambar) : '' }}"
                         id="imgPreview" class="img-fluid w-100 rounded-3"
                         style="object-fit:cover;max-height:220px">
                </div>
                <input type="file" name="gambar" class="form-control"
                       accept="image/*" onchange="previewImg(this,'imgPreview')">
                <div class="form-text mt-1">JPG, PNG, WebP. Maks 4MB. Ideal 800×500px.</div>
            </div>

            {{-- Jadwal Promo --}}
            <div class="form-card mb-4">
                <h6 class="fw-bold mb-3" style="font-size:14px;color:#374151">
                    <i class="bi bi-calendar-event me-2 text-primary"></i>Jadwal Promo
                </h6>
                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size:13px">Berlaku Mulai</label>
                    <input type="date" name="berlaku_mulai" class="form-control"
                           value="{{ old('berlaku_mulai', optional($promo->berlaku_mulai ?? null)->format('Y-m-d')) }}">
                </div>
                <div class="mb-0">
                    <label class="form-label fw-semibold" style="font-size:13px">Berlaku Sampai</label>
                    <input type="date" name="berlaku_sampai" class="form-control"
                           value="{{ old('berlaku_sampai', optional($promo->berlaku_sampai ?? null)->format('Y-m-d')) }}">
                </div>
            </div>

            {{-- Pengaturan --}}
            <div class="form-card mb-4">
                <h6 class="fw-bold mb-3" style="font-size:14px;color:#374151">
                    <i class="bi bi-gear me-2 text-primary"></i>Pengaturan
                </h6>

                {{-- Unggulan --}}
                <div class="p-3 rounded-3 mb-3 {{ !$canFeatured && !($promo->is_featured??false) ? 'bg-light' : 'bg-warning bg-opacity-10' }}"
                     style="border:1.5px solid {{ !$canFeatured && !($promo->is_featured??false) ? '#e2e8f0' : '#f59e0b' }};border-radius:12px!important">
                    <div class="form-check mb-0">
                        <input class="form-check-input" type="checkbox" name="is_featured"
                               id="isFeatured" value="1"
                               {{ old('is_featured', $promo->is_featured ?? false) ? 'checked' : '' }}
                               {{ !$canFeatured && !($promo->is_featured??false) ? 'disabled' : '' }}>
                        <label class="form-check-label" for="isFeatured">
                            <strong>⭐ Promo Unggulan</strong>
                            <div style="font-size:12px;color:#64748b;margin-top:2px">Ditampilkan di atas daftar promo. Maks. 3.</div>
                        </label>
                    </div>
                </div>

                {{-- Beranda & Popup --}}
                <div class="p-3 rounded-3 mb-3 bg-primary bg-opacity-10"
                     style="border:1.5px solid #0055a5;border-radius:12px!important">
                    <div class="form-check mb-0">
                        <input class="form-check-input" type="checkbox" name="is_home_featured"
                               id="isHomeFeatured" value="1"
                               {{ old('is_home_featured', $promo->is_home_featured ?? false) ? 'checked' : '' }}>
                        <label class="form-check-label" for="isHomeFeatured">
                            <strong>🏠 Tampilkan di Beranda & Popup</strong>
                            <div style="font-size:12px;color:#64748b;margin-top:2px">Hanya 1 promo. Otomatis menggantikan pilihan sebelumnya.</div>
                        </label>
                    </div>
                </div>

                {{-- BPJS --}}
                <div class="p-3 rounded-3 bg-success bg-opacity-10"
                     style="border:1.5px solid #16a34a;border-radius:12px!important">
                    <div class="form-check mb-0">
                        <input class="form-check-input" type="checkbox" name="terima_bpjs"
                               id="terimaBpjs" value="1"
                               {{ old('terima_bpjs', $promo->terima_bpjs ?? false) ? 'checked' : '' }}>
                        <label class="form-check-label" for="terimaBpjs">
                            <strong>🏥 Menerima BPJS</strong>
                            <div style="font-size:12px;color:#64748b;margin-top:2px">Promo dapat digunakan peserta BPJS Kesehatan.</div>
                        </label>
                    </div>
                </div>
            </div>

            {{-- Submit Button --}}
            <button type="submit" class="btn btn-primary w-100 py-3" style="font-size:15px;font-weight:600;border-radius:12px">
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
            if (wrap) wrap.style.display = 'block';
        };
        r.readAsDataURL(input.files[0]);
    }
}
function countChars(el, counterId, max) {
    const counter = document.getElementById(counterId);
    if (counter) {
        const len = el.value.length;
        counter.textContent = len + '/' + max;
        counter.style.color = len > max * 0.85 ? '#d93025' : '#94a3b8';
    }
}
// Init counters on load
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('textarea[maxlength]').forEach(el => {
        const evt = new Event('input');
        el.dispatchEvent(evt);
    });
});
</script>
@endpush
