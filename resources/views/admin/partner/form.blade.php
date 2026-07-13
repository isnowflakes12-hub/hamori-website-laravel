@extends('admin.layouts.app')

@section('title', $partner->exists ? 'Edit Partner' : 'Tambah Partner')

@section('content')
<div class="page-hd">
    <div>
        <h1 class="page-hd-title">{{ $partner->exists ? 'Edit Partner/Mitra' : 'Tambah Partner/Mitra' }}</h1>
        <p class="page-hd-sub">Lengkapi formulir di bawah ini untuk mengelola data partner/mitra.</p>
    </div>
    <a href="{{ route('admin.partner.index') }}" class="btn btn-sm btn-outline-secondary" style="background:#fff">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form action="{{ $partner->exists ? route('admin.partner.update', $partner) : route('admin.partner.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if($partner->exists)
                        @method('PUT')
                    @endif

                    {{-- Info Utama --}}
                    <h6 class="text-uppercase text-muted fw-bold mb-3" style="font-size: 13px; letter-spacing: 1px;">Informasi Utama</h6>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Partner / Perusahaan <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $partner->nama) }}" required placeholder="Contoh: PT Asuransi Allianz Life Indonesia">
                        @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Kategori</label>
                            <input type="text" name="kategori" class="form-control @error('kategori') is-invalid @enderror" value="{{ old('kategori', $partner->kategori) }}" placeholder="Contoh: Asuransi, Perusahaan, BPJS">
                            <div class="form-text">Boleh dikosongkan jika tidak ada kategori khusus.</div>
                            @error('kategori')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Website Utama</label>
                            <input type="url" name="website" class="form-control @error('website') is-invalid @enderror" value="{{ old('website', $partner->website) }}" placeholder="Contoh: https://www.allianz.co.id">
                            <div class="form-text">Masukkan URL lengkap beserta https://</div>
                            @error('website')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <hr class="my-4">

                    {{-- Upload Logo --}}
                    <h6 class="text-uppercase text-muted fw-bold mb-3" style="font-size: 13px; letter-spacing: 1px;">Logo Partner</h6>
                    <div class="row align-items-center mb-4">
                        <div class="col-sm-auto mb-3 mb-sm-0 text-center">
                            @if($partner->logo)
                                <img src="{{ asset('storage/' . $partner->logo) }}" id="logo-preview" class="img-thumbnail" style="width: 150px; height: 100px; object-fit: contain; background: #f8f9fa;">
                            @else
                                <div id="logo-preview-placeholder" class="bg-light rounded d-flex align-items-center justify-content-center text-muted border border-dashed" style="width: 150px; height: 100px;">
                                    <div class="text-center">
                                        <i class="bi bi-image fs-3 d-block mb-1"></i>
                                        <span style="font-size: 11px;">Belum Ada Logo</span>
                                    </div>
                                </div>
                                <img src="" id="logo-preview" class="img-thumbnail d-none" style="width: 150px; height: 100px; object-fit: contain; background: #f8f9fa;">
                            @endif
                        </div>
                        <div class="col">
                            <input type="file" name="logo" id="logo" class="form-control mb-2 @error('logo') is-invalid @enderror" accept="image/*">
                            <div class="form-text">Format: JPG, PNG, WEBP. Maks 4MB. Resolusi akan dioptimasi otomatis.</div>
                            
                            @if($partner->exists && $partner->logo)
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" name="hapus_logo" value="1" id="hapus_logo">
                                <label class="form-check-label text-danger" for="hapus_logo">
                                    Hapus logo saat ini
                                </label>
                            </div>
                            @endif
                            
                            @error('logo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <hr class="my-4">

                    {{-- Status --}}
                    <h6 class="text-uppercase text-muted fw-bold mb-3" style="font-size: 13px; letter-spacing: 1px;">Pengaturan Tampilan</h6>
                    <div class="card bg-light border-0 mb-4">
                        <div class="card-body">
                            <div class="form-check form-switch fs-5">
                                <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active" value="1" {{ old('is_active', $partner->exists ? $partner->is_active : true) ? 'checked' : '' }}>
                                <label class="form-check-label ms-2" for="is_active">
                                    <span class="d-block fw-semibold" style="font-size: 15px;">Tampilkan Partner ini di halaman publik</span>
                                    <span class="d-block text-muted" style="font-size: 13px;">Matikan switch ini jika Anda ingin menyembunyikan partner ini untuk sementara.</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    {{-- Submit --}}
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('admin.partner.index') }}" class="btn btn-light border">Batal</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-save me-1"></i> Simpan Data Partner
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    {{-- Live Preview --}}
    <div class="col-lg-4 mt-4 mt-lg-0">
        <h6 class="text-uppercase text-muted fw-bold mb-3" style="font-size: 13px; letter-spacing: 1px;">Live Preview</h6>
        <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden; position: sticky; top: 90px;">
            <div class="card-body p-4 text-center">
                <div class="mb-3 d-flex justify-content-center align-items-center" style="height: 120px; background: #f8fafc; border-radius: 8px; border: 1px dashed #cbd5e1;">
                    @if($partner->logo)
                        <img src="{{ asset('storage/' . $partner->logo) }}" id="live-logo" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                    @else
                        <img src="" id="live-logo" class="d-none" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                        <i class="bi bi-building fs-1 text-muted" id="live-logo-icon"></i>
                    @endif
                </div>
                
                <h5 class="fw-bold mb-1" id="live-nama" style="color: #1e293b;">
                    {{ $partner->nama ?: 'Nama Partner' }}
                </h5>
                
                <div class="mb-3">
                    <span class="badge" id="live-kategori" style="background: #f0f9ff; color: #0284c7; border: 1px solid #bae6fd; font-weight: 600; padding: 5px 10px;">
                        {{ $partner->kategori ?: 'Kategori' }}
                    </span>
                </div>
                
                <div class="text-muted" style="font-size: 13px;">
                    Preview ini menunjukkan bagaimana tampilan logo dan informasi partner pada halaman depan website.
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const inputNama = document.querySelector('input[name="nama"]');
        const inputKategori = document.querySelector('input[name="kategori"]');
        const liveNama = document.getElementById('live-nama');
        const liveKategori = document.getElementById('live-kategori');
        
        // Update Nama
        inputNama.addEventListener('input', function() {
            liveNama.textContent = this.value || 'Nama Partner';
        });

        // Update Kategori
        inputKategori.addEventListener('input', function() {
            liveKategori.textContent = this.value || 'Kategori';
            if(this.value) {
                liveKategori.style.display = 'inline-block';
            } else {
                liveKategori.style.display = 'none'; // Optional: sembunyikan jika kosong
            }
        });
        
        // Init state for kategori
        if(!inputKategori.value) {
            liveKategori.textContent = 'Kategori';
        }

        // Preview image
        document.getElementById('logo').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Update main preview
                    const preview = document.getElementById('logo-preview');
                    const placeholder = document.getElementById('logo-preview-placeholder');
                    
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                    if (placeholder) placeholder.classList.add('d-none');
                    
                    // Update live preview
                    const liveLogo = document.getElementById('live-logo');
                    const liveIcon = document.getElementById('live-logo-icon');
                    liveLogo.src = e.target.result;
                    liveLogo.classList.remove('d-none');
                    if (liveIcon) liveIcon.classList.add('d-none');
                }
                reader.readAsDataURL(file);
            }
        });
    });
</script>
@endsection
