@extends('layouts.app')
@section('title', $karir->posisi . ' — Karir RS Hamori')
@section('meta_description', 'Lowongan kerja ' . $karir->posisi . ' di Rumah Sakit Hamori Subang. ' . Str::limit(strip_tags($karir->deskripsi), 150))
@section('meta_keywords', 'lowongan kerja ' . strtolower($karir->posisi) . ', loker rs hamori, loker subang, karir rumah sakit')
@section('og_type', 'article')

@push('styles')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container .select2-selection--single {
        height: auto !important;
        min-height: 48px !important;
        border: 1.5px solid #e4e9f0 !important;
        border-radius: 10px !important;
        padding: 10px 14px 10px 40px !important;
        font-size: 14px !important;
        color: #2d3748 !important;
        background-color: #f7f9fc !important;
        display: flex !important;
        align-items: center !important;
        transition: border-color .2s, background .2s;
    }
    .select2-container--default.select2-container--open .select2-selection--single {
        border-color: #1ba99d !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 100% !important;
        right: 14px !important;
        top: 0 !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        padding-left: 0 !important;
        color: #2d3748 !important;
        line-height: normal !important;
    }
    .jadwal-search-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ba5b4;
        font-size: 16px;
        pointer-events: none;
        z-index: 10;
    }
</style>
@endpush

@php
$katMeta = [];
foreach($kategoris as $k) {
    $katMeta[$k->nama] = ['color'=>$k->warna, 'bg'=>$k->warna_bg, 'icon'=>$k->icon];
}
$km = $katMeta[$karir->kategori] ?? ['color'=>'#1ba99d', 'bg'=>'#e8f8f7', 'icon'=>'bi-briefcase'];
$isDeadlineSoon = $karir->batas_lamaran && $karir->batas_lamaran->isFuture() && $karir->batas_lamaran->diffInDays(now()) <= 7;
$isExpired = $karir->batas_lamaran && $karir->batas_lamaran->isPast();
@endphp

@section('content')

<div class="page-header">
    <div class="container">
        <h1 class="page-title mb-3">{{ $karir->posisi }}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('karir.index') }}">Karir</a></li>
                <li class="breadcrumb-item active">{{ $karir->posisi }}</li>
            </ol>
        </nav>

        
    </div>
</div>

<div class="karir-detail-body">
    <div class="container">
        <div class="row g-4">

            <div class="col-lg-8">

                @if(session('success'))
                <div class="alert-success-custom">
                    <i class="bi bi-check-circle-fill"></i>
                    <div>
                        <strong>Lamaran Berhasil Dikirim!</strong>
                    </div>
                </div>
                @endif

                <div class="detail-card">
                    <h5><i class="bi bi-file-text"></i> Deskripsi Pekerjaan</h5>
                    <div class="ql-editor p-0">{!! $karir->deskripsi !!}</div>
                </div>

                <div class="detail-card">
                    <h5><i class="bi bi-list-check"></i> Persyaratan</h5>
                    @php
                        $reqLines = array_filter(array_map('trim', explode("\n", $karir->persyaratan)));
                    @endphp
                    <ul class="req-list">
                        @foreach($reqLines as $line)
                        <li>{{ ltrim($line, '- ') }}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="detail-card">
                    <h5><i class="bi bi-gift"></i> Keuntungan Bergabung</h5>
                    <div class="row g-3 mt-1">
                        @foreach([
                            ['bi-shield-check','#0055a5','BPJS Kesehatan & Ketenagakerjaan'],
                            ['bi-graph-up','#00a859','Jenjang karir yang jelas'],
                            ['bi-mortarboard','#6c3fc5','Pelatihan & pengembangan SDM'],
                            ['bi-cash-coin','#e8333c','Salary meliputi Tunjangan Tetap & Tidak Tetap'],
                            ['bi-hospital','#f59e0b','Diskon berobat karyawan'],
                            ['bi-people','#0077cc','Lingkungan kerja profesional'],
                        ] as $b)
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center gap-10" style="gap:10px">
                                <div style="width:34px;height:34px;border-radius:8px;background:{{ $b[1] }}15;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                                    <i class="bi {{ $b[0] }}" style="color:{{ $b[1] }};font-size:15px"></i>
                                </div>
                                <span style="font-size:13px;color:#374151">{{ $b[2] }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                @if(!$isExpired)
                <!-- Modal Lamaran -->
                <div class="modal fade" id="modalLamaran" tabindex="-1" aria-labelledby="modalLamaranLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content" style="border-radius: 20px; border: none; overflow: hidden;">
                            <div class="modal-header" style="background: #0055a5; color: #fff; border-bottom: none; padding: 24px;">
                                <div>
                                    <h5 class="modal-title fw-bold" id="modalLamaranLabel"><i class="bi bi-send me-2"></i>Form Lamaran Kerja</h5>
                                    <p class="mb-0 mt-1" style="font-size:13px; color:#e0f2fe;">Isi data diri Anda dengan lengkap. Semua kolom wajib diisi.</p>
                                </div>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" style="align-self: flex-start;"></button>
                            </div>
                            <div class="modal-body" style="padding: 30px 24px; background: #fff;">
                                <form id="formLamaranActual" action="{{ route('karir.apply', $karir->slug) }}"
                                      method="POST" enctype="multipart/form-data" novalidate>
                                    @csrf

                                    <div class="row g-4">
                                        <div class="col-12">
                                            <label class="form-label-custom">
                                                <i class="bi bi-briefcase" style="color:#0055a5"></i>
                                                Posisi yang Dilamar <span class="required">*</span>
                                            </label>
                                            <div style="position: relative;">
                                                <i class="bi bi-search jadwal-search-icon"></i>
                                                <select name="slug_posisi" id="selectPosisi" class="form-control" required style="width: 100%;">
                                                    @foreach($allKarirs as $ak)
                                                        @php
                                                            $isExpired = $ak->batas_lamaran && $ak->batas_lamaran->isPast();
                                                        @endphp
                                                        <option value="{{ $ak->slug }}" {{ $ak->id == $karir->id ? 'selected' : '' }} {{ $isExpired ? 'disabled' : '' }}>
                                                            {{ $ak->posisi }} ({{ $ak->departemen }}) {{ $isExpired ? ' - (DITUTUP)' : '' }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label-custom">
                                                <i class="bi bi-person" style="color:#0055a5"></i>
                                                Nama Lengkap <span class="required">*</span>
                                            </label>
                                            <input type="text" name="nama"
                                                   class="form-control-custom @error('nama') is-invalid @enderror"
                                                   placeholder="Nama sesuai KTP"
                                                   value="{{ old('nama') }}" required maxlength="200">
                                            @error('nama')<div style="font-size:12px;color:#dc2626;margin-top:4px">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label-custom">
                                                <i class="bi bi-envelope" style="color:#0055a5"></i>
                                                Email Aktif <span class="required">*</span>
                                            </label>
                                            <input type="email" name="email"
                                                   class="form-control-custom @error('email') is-invalid @enderror"
                                                   placeholder="email@contoh.com"
                                                   value="{{ old('email') }}" required>
                                            @error('email')<div style="font-size:12px;color:#dc2626;margin-top:4px">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label-custom">
                                                <i class="bi bi-telephone" style="color:#0055a5"></i>
                                                No. HP / WhatsApp <span class="required">*</span>
                                            </label>
                                            <input type="text" name="telepon"
                                                   class="form-control-custom @error('telepon') is-invalid @enderror"
                                                   placeholder="08xxxxxxxxxx atau +628xxxxxxxxxx"
                                                   value="{{ old('telepon') }}" required
                                                   pattern="^(\+62|62|0)8[0-9]{7,13}$"
                                                   inputmode="tel">
                                            @error('telepon')<div style="font-size:12px;color:#dc2626;margin-top:4px">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label-custom">
                                                <i class="bi bi-file-earmark-pdf" style="color:#0055a5"></i>
                                                Upload CV / Resume <span class="required">*</span>
                                                <span style="font-size:11px;color:#9ca3af;font-weight:400">(PDF saja — maks. 5 MB)</span>
                                            </label>
                                            <div class="file-upload-area @error('cv') is-invalid @enderror" id="cvDropArea">
                                                <input type="file" name="cv" id="cvInput"
                                                       accept=".pdf,application/pdf" required>
                                                <div class="file-upload-icon"><i class="bi bi-cloud-arrow-up"></i></div>
                                                <div class="file-upload-text">
                                                    <strong>Klik atau drag & drop</strong> CV Anda di sini<br>
                                                    <span style="font-size:11px">Format: PDF • Maksimal 5 MB</span>
                                                </div>
                                                <div class="file-name-display" id="fileNameDisplay">
                                                    <i class="bi bi-check-circle-fill text-success me-1"></i>
                                                    <span id="fileNameText"></span>
                                                </div>
                                                <div id="cvError" style="display:none;font-size:12px;color:#dc2626;margin-top:6px"></div>
                                            </div>
                                            @error('cv')<div style="font-size:12px;color:#dc2626;margin-top:4px">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label-custom">
                                                <i class="bi bi-chat-text" style="color:#0055a5"></i>
                                                Surat Motivasi / Cover Letter
                                                <span style="font-size:11px;color:#9ca3af;font-weight:400">(opsional)</span>
                                            </label>
                                            <textarea name="cover_letter" rows="4"
                                                      class="form-control-custom"
                                                      placeholder="Ceritakan motivasi Anda melamar posisi ini, pengalaman relevan, dan mengapa Anda cocok untuk tim kami...">{{ old('cover_letter') }}</textarea>
                                        </div>

                                        <div class="col-12">
                                            <label style="display:flex;align-items:flex-start;gap:10px;cursor:pointer;font-size:13px;color:#374151">
                                                <input type="checkbox" name="persetujuan" id="persetujuanCheck" required
                                                       style="margin-top:2px;width:16px;height:16px;accent-color:#0055a5;flex-shrink:0">
                                                <span>
                                                    Saya menyatakan bahwa data yang saya isi adalah <strong>benar</strong> dan dapat dipertanggungjawabkan.
                                                    Saya menyetujui <a href="{{ route('privacy-policy') }}" target="_blank" style="color:#0055a5">Kebijakan Privasi</a>.
                                                </span>
                                            </label>
                                        </div>

                                        {{-- reCAPTCHA sementara dinonaktifkan --}}

                                        <div class="col-12 mt-4">
                                            <button type="submit" class="btn-submit-lamar" id="btnKirimLamaran" style="width: 100%;">
                                                <i class="bi bi-send-fill"></i> Kirim Lamaran Sekarang
                                            </button>
                                            <p style="text-align:center;font-size:12px;color:#9ca3af;margin-top:12px;margin-bottom:0">
                                                <i class="bi bi-lock me-1"></i>Data Anda aman dan tidak akan dibagikan kepada pihak ketiga
                                            </p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                @else
                <div class="detail-card" style="text-align:center;padding:40px">
                    <i class="bi bi-calendar-x" style="font-size:3rem;color:#d1d5db;display:block;margin-bottom:14px"></i>
                    <h5 class="fw-bold">Mohon Maaf Lamaran sudah di Tutup</h5>
                    <p class="text-muted mb-4">Lowongan ini sudah tidak menerima lamaran baru.</p>
                    <a href="{{ route('karir.index') }}" class="btn btn-primary">
                        <i class="bi bi-arrow-left me-1"></i> Lihat Lowongan Lain
                    </a>
                </div>
                @endif

            </div>

            <div class="col-lg-4">

                <div class="apply-sidebar mb-4">
                    <div class="apply-sidebar-header">
                        <h5><i class="bi bi-info-circle me-2" style="color:#0055a5"></i>Info Lowongan</h5>
                        <p>Ringkasan informasi pekerjaan</p>
                    </div>
                    <div class="apply-sidebar-body">
                        <div class="apply-info-row">
                            <i class="bi bi-tag"></i>
                            <span class="apply-info-label">Kategori</span>
                            <span class="apply-info-value" style="color:{{ $km['color'] }}">
                                {{ $karir->kategori }}
                            </span>
                        </div>
                        <div class="apply-info-row">
                            <i class="bi bi-briefcase"></i>
                            <span class="apply-info-label">Tipe</span>
                            <span class="apply-info-value">{{ $tipes->where('slug', $karir->tipe)->first()->nama ?? ucfirst(str_replace('-',' ',$karir->tipe)) }}</span>
                        </div>
                        <div class="apply-info-row">
                            <i class="bi bi-building"></i>
                            <span class="apply-info-label">Departemen</span>
                            <span class="apply-info-value">{{ $karir->departemen }}</span>
                        </div>
                        @if($karir->lokasi)
                        <div class="apply-info-row">
                            <i class="bi bi-geo-alt"></i>
                            <span class="apply-info-label">Lokasi</span>
                            <span class="apply-info-value">{{ $karir->lokasi }}</span>
                        </div>
                        @endif

                        @if($karir->batas_lamaran)
                        <div class="apply-info-row">
                            <i class="bi bi-calendar-event"></i>
                            <span class="apply-info-label">Deadline</span>
                            <span class="apply-info-value {{ $isDeadlineSoon ? 'text-danger' : '' }}">
                                {{ $karir->batas_lamaran->translatedFormat('d M Y') }}
                            </span>
                        </div>
                        @endif
                    </div>
                    
                    @if(!$isExpired)
                    <div style="padding: 0 20px 20px;">
                        <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#modalLamaran" style="padding: 12px; font-weight: 600; border-radius: 12px; box-shadow: 0 4px 14px rgba(0,85,165,0.3);">
                            <i class="bi bi-send-fill me-2"></i> Lamar Sekarang
                        </button>
                    </div>
                    @endif
                </div>


                @if($related->count())
                <div style="background:#fff;border-radius:16px;box-shadow:0 2px 12px rgba(0,0,0,0.06);overflow:hidden">
                    <div style="padding:18px 20px;border-bottom:1px solid #f0f0f0">
                        <h6 class="fw-bold mb-0" style="font-size:14px">Lowongan Serupa</h6>
                    </div>
                    <div style="padding:14px 12px;display:flex;flex-direction:column;gap:8px">
                        @foreach($related as $r)
                        @php $rm = $katMeta[$r->kategori] ?? ['color'=>'#1ba99d', 'bg'=>'#e8f8f7', 'icon'=>'bi-briefcase']; @endphp
                        <a href="{{ route('karir.show', $r->slug) }}" class="related-card">
                            <div class="related-card-icon" style="background:{{ $rm['bg'] }};color:{{ $rm['color'] }}">
                                <i class="bi {{ $rm['icon'] }}"></i>
                            </div>
                            <div>
                                <div style="font-size:13px;font-weight:700;color:#1a1a2e;line-height:1.3">{{ $r->posisi }}</div>
                                <div style="font-size:11px;color:#9ca3af;margin-top:3px">{{ $r->departemen }}</div>
                                @if($r->batas_lamaran)
                                <div style="font-size:11px;color:#6b7280;margin-top:4px">
                                    <i class="bi bi-calendar2 me-1"></i>{{ $r->batas_lamaran->translatedFormat('d M Y') }}
                                </div>
                                @endif
                            </div>
                        </a>
                        @endforeach
                    </div>
                    <div style="padding:12px 20px;border-top:1px solid #f0f0f0;text-align:center">
                        <a href="{{ route('karir.index', ['kategori'=>$karir->kategori]) }}"
                           style="font-size:13px;color:#0055a5;font-weight:600;text-decoration:none">
                            Lihat Semua {{ $karir->kategori }} <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Inisialisasi Select2 untuk dropdown posisi
    $('#selectPosisi').select2({
        dropdownParent: $('#modalLamaran'),
        placeholder: "Cari posisi pekerjaan...",
        allowClear: false
    });

    // Update form action URL based on selected position
    $('#selectPosisi').on('change', function() {
        const selectedSlug = $(this).val();
        const form = document.getElementById('formLamaranActual');
        // Ganti URL terakhir dengan slug yang baru
        let currentAction = form.getAttribute('action');
        let newAction = currentAction.substring(0, currentAction.lastIndexOf('/')) + '/' + selectedSlug + '/apply';
        // Karena route di laravel karir/{slug}/apply, kita cukup replace /{slug}/apply
        let parts = currentAction.split('/');
        parts[parts.length - 2] = selectedSlug; 
        form.setAttribute('action', parts.join('/'));
    });
    const cvInput     = document.getElementById('cvInput');
    const dropArea    = document.getElementById('cvDropArea');
    const nameDisplay = document.getElementById('fileNameDisplay');
    const nameText    = document.getElementById('fileNameText');
    const cvError     = document.getElementById('cvError');
    const checkbox    = document.getElementById('persetujuanCheck');
    const submitBtn   = document.getElementById('btnKirimLamaran');

    // --- Validate & preview file ---
    function validateFile(file) {
        cvError.style.display = 'none';
        cvError.textContent = '';

        if (!file) return false;

        const isPDF = file.type === 'application/pdf' || file.name.toLowerCase().endsWith('.pdf');
        if (!isPDF) {
            cvError.textContent = 'Format tidak didukung. Hanya file PDF yang diizinkan.';
            cvError.style.display = 'block';
            cvInput.value = '';
            nameDisplay.style.display = 'none';
            return false;
        }

        const maxSize = 5 * 1024 * 1024; // 5 MB
        if (file.size > maxSize) {
            cvError.textContent = 'Ukuran file melebihi batas 5 MB.';
            cvError.style.display = 'block';
            cvInput.value = '';
            nameDisplay.style.display = 'none';
            return false;
        }

        nameText.textContent = file.name;
        nameDisplay.style.display = 'block';
        return true;
    }

    if (cvInput) {
        cvInput.addEventListener('change', function () {
            validateFile(this.files[0]);
        });
    }

    // --- Drag & drop ---
    if (dropArea) {
        dropArea.addEventListener('dragover', e => { e.preventDefault(); dropArea.classList.add('dragover'); });
        dropArea.addEventListener('dragleave', () => dropArea.classList.remove('dragover'));
        dropArea.addEventListener('drop', e => {
            e.preventDefault();
            dropArea.classList.remove('dragover');
            if (e.dataTransfer.files.length) {
                const dt = e.dataTransfer;
                // Transfer files to input
                try {
                    cvInput.files = dt.files;
                } catch(err) {}
                validateFile(dt.files[0]);
            }
        });
    }

    // --- Client-side validation on submit ---
    const form = document.getElementById('formLamaranActual');
    if (form) {
        form.addEventListener('submit', function (e) {
            let valid = true;

            // Nama max 200
            const nama = form.querySelector('input[name="nama"]');
            if (nama && nama.value.trim().length > 200) {
                alert('Nama lengkap tidak boleh melebihi 200 karakter.');
                nama.focus();
                valid = false;
            }

            // Email format
            const email = form.querySelector('input[name="email"]');
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email && !emailRegex.test(email.value.trim())) {
                alert('Format email tidak valid.');
                email.focus();
                valid = false;
            }

            // Telepon format
            const telepon = form.querySelector('input[name="telepon"]');
            const phoneRegex = /^(\+62|62|0)8[0-9]{7,13}$/;
            if (telepon && !phoneRegex.test(telepon.value.trim())) {
                alert('Format nomor WhatsApp tidak valid. Gunakan format 08xxx atau +628xxx.');
                telepon.focus();
                valid = false;
            }

            // CV harus ada dan PDF
            if (cvInput && cvInput.files.length === 0) {
                alert('Harap upload file CV terlebih dahulu.');
                valid = false;
            } else if (cvInput && cvInput.files.length > 0) {
                if (!validateFile(cvInput.files[0])) {
                    valid = false;
                }
            }

            // Checkbox persetujuan
            if (checkbox && !checkbox.checked) {
                alert('Anda harus menyetujui pernyataan dan Kebijakan Privasi untuk melanjutkan.');
                checkbox.focus();
                valid = false;
            }

            if (!valid) e.preventDefault();
        });
    }

    // Buka modal jika ada session error (berguna saat validasi laravel gagal)
    @if($errors->any())
        var myModal = new bootstrap.Modal(document.getElementById('modalLamaran'), {});
        myModal.show();
    @endif
});
</script>
@endpush

