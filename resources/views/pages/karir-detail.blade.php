@extends('layouts.app')
@section('title', $karir->posisi . ' — Karir RS Hamori')

@push('styles')
<style>
/* ---- Hero ---- */
.karir-detail-hero {
    background: linear-gradient(135deg, #0d1b3e 0%, #0055a5 60%, #0077cc 100%);
    padding: 56px 0 40px;
    position: relative; overflow: hidden;
}
.karir-detail-hero::before {
    content:''; position:absolute; width:500px; height:500px;
    background:rgba(255,255,255,0.04); border-radius:50%;
    top:-200px; right:-100px;
}
.karir-detail-hero .breadcrumb-item a { color:rgba(255,255,255,0.65); }
.karir-detail-hero .breadcrumb-item.active { color:rgba(255,255,255,0.4); }
.karir-detail-hero .breadcrumb-divider { color:rgba(255,255,255,0.3); }

/* Category color map via data attrs */
.kat-badge {
    display:inline-flex; align-items:center; gap:6px;
    font-size:11px; font-weight:700; letter-spacing:2px; text-transform:uppercase;
    padding:5px 14px; border-radius:100px; margin-bottom:14px;
}
.hero-posisi {
    font-family:'Libre Baskerville',serif;
    font-size:clamp(1.6rem,4vw,2.4rem);
    font-weight:700; color:#fff; margin-bottom:10px; line-height:1.2;
}
.hero-dept { color:rgba(255,255,255,0.7); font-size:15px; margin-bottom:20px; }
.hero-meta-row { display:flex; flex-wrap:wrap; gap:18px; }
.hero-meta-item {
    display:flex; align-items:center; gap:6px;
    color:rgba(255,255,255,0.8); font-size:13px; font-weight:500;
}
.hero-meta-item i { font-size:15px; }

/* Deadline alert */
.deadline-chip {
    display:inline-flex; align-items:center; gap:6px;
    font-size:12px; font-weight:700; padding:7px 16px;
    border-radius:100px;
}
.deadline-chip.soon   { background:#fee2e2; color:#dc2626; }
.deadline-chip.normal { background:#dcfce7; color:#16a34a; }

/* Main layout */
.karir-detail-body { background:#f8fafc; padding:48px 0 64px; }

/* Sticky sidebar card */
.apply-sidebar {
    background:#fff; border-radius:20px;
    box-shadow:0 4px 24px rgba(0,0,0,0.09);
    overflow:hidden; position:sticky; top:88px;
}
.apply-sidebar-header {
    padding:22px 24px;
    border-bottom:1px solid #f0f0f0;
}
.apply-sidebar-header h5 { font-weight:700; margin:0; font-size:16px; }
.apply-sidebar-header p  { font-size:12px; color:#6b7280; margin:4px 0 0; }
.apply-sidebar-body { padding:24px; }
.apply-sidebar-footer { background:#f8fafc; padding:16px 24px; border-top:1px solid #f0f0f0; }

.apply-info-row {
    display:flex; align-items:center; gap:10px;
    padding:9px 0; border-bottom:1px solid #f5f5f5; font-size:13px;
}
.apply-info-row:last-child { border-bottom:none; }
.apply-info-row i { width:20px; color:#0055a5; font-size:14px; flex-shrink:0; }
.apply-info-label { color:#6b7280; min-width:80px; }
.apply-info-value { font-weight:600; color:#1a1a2e; }

/* Content cards */
.detail-card {
    background:#fff; border-radius:16px;
    box-shadow:0 2px 12px rgba(0,0,0,0.06);
    padding:28px 32px; margin-bottom:22px;
}
.detail-card h5 {
    font-size:15px; font-weight:700; color:#0055a5;
    display:flex; align-items:center; gap:8px;
    margin-bottom:16px; padding-bottom:12px;
    border-bottom:2px solid #eff6ff;
}
.detail-card h5 i { font-size:17px; }
.detail-card p  { font-size:14px; color:#374151; line-height:1.75; margin:0; }
.detail-card ul { margin:0; padding-left:20px; }
.detail-card ul li { font-size:14px; color:#374151; line-height:1.8; margin-bottom:4px; }

/* Req list styled */
.req-list { list-style:none; padding:0; margin:0; }
.req-list li {
    display:flex; align-items:flex-start; gap:10px;
    padding:6px 0; font-size:14px; color:#374151;
}
.req-list li::before {
    content:'\F26E'; font-family:'bootstrap-icons';
    color:#00a859; font-size:14px; flex-shrink:0; margin-top:2px;
}

/* Application form */
.form-lamar { background:#fff; border-radius:20px; box-shadow:0 4px 24px rgba(0,0,0,0.08); overflow:hidden; }
.form-lamar-header {
    background:linear-gradient(135deg,#0055a5,#003d7a);
    padding:24px 32px; color:#fff;
}
.form-lamar-header h4 { font-weight:700; margin:0; font-size:18px; }
.form-lamar-header p  { margin:6px 0 0; opacity:.8; font-size:13px; }
.form-lamar-body { padding:32px; }
.form-label-custom {
    font-size:13px; font-weight:600; color:#374151;
    margin-bottom:6px; display:flex; align-items:center; gap:6px;
}
.form-label-custom .required { color:#e8333c; }
.form-control-custom, .form-select-custom {
    border:1.5px solid #e5e7eb; border-radius:10px;
    padding:10px 14px; font-size:14px; width:100%;
    transition:border-color .2s, box-shadow .2s;
    background:#fafafa;
}
.form-control-custom:focus, .form-select-custom:focus {
    border-color:#0055a5;
    box-shadow:0 0 0 3px rgba(0,85,165,0.1);
    outline:none; background:#fff;
}
.form-control-custom.is-invalid { border-color:#dc2626; }

/* File upload area */
.file-upload-area {
    border:2px dashed #d1d5db; border-radius:12px;
    padding:28px 20px; text-align:center;
    cursor:pointer; transition:border-color .2s, background .2s;
    background:#fafafa; position:relative;
}
.file-upload-area:hover, .file-upload-area.dragover {
    border-color:#0055a5; background:#eff6ff;
}
.file-upload-area input[type=file] {
    position:absolute; inset:0; opacity:0; cursor:pointer;
}
.file-upload-icon { font-size:2.2rem; color:#9ca3af; margin-bottom:8px; }
.file-upload-text  { font-size:13px; color:#6b7280; }
.file-upload-text strong { color:#0055a5; }
.file-name-display {
    margin-top:8px; font-size:12px; color:#0055a5;
    font-weight:600; display:none;
}

/* Submit button */
.btn-submit-lamar {
    background:linear-gradient(135deg,#0055a5,#003d7a);
    color:#fff; border:none; border-radius:14px;
    padding:14px 32px; font-size:15px; font-weight:700;
    width:100%; cursor:pointer;
    transition:transform .2s, box-shadow .2s;
    display:flex; align-items:center; justify-content:center; gap:8px;
}
.btn-submit-lamar:hover {
    transform:translateY(-2px);
    box-shadow:0 10px 28px rgba(0,85,165,0.4);
}

/* Related jobs */
.related-card {
    background:#fff; border-radius:14px;
    box-shadow:0 2px 10px rgba(0,0,0,0.06);
    border:1px solid #f0f0f0;
    padding:18px 20px;
    display:flex; gap:14px; align-items:flex-start;
    text-decoration:none; color:inherit;
    transition:transform .2s, box-shadow .2s, border-color .2s;
}
.related-card:hover {
    transform:translateY(-3px);
    box-shadow:0 8px 24px rgba(0,0,0,0.1);
    border-color:#d0e4f7; color:inherit;
}
.related-card-icon {
    width:42px; height:42px; border-radius:10px;
    display:flex; align-items:center; justify-content:center;
    font-size:18px; flex-shrink:0;
}

/* Success alert */
.alert-success-custom {
    background:#f0fdf4; border:1.5px solid #bbf7d0;
    border-radius:14px; padding:18px 22px;
    display:flex; align-items:flex-start; gap:14px;
    margin-bottom:24px;
}
.alert-success-custom i { font-size:22px; color:#16a34a; flex-shrink:0; }
</style>
@endpush

@php
$katMeta = [
    'Perawat'         => ['color'=>'#0055a5','bg'=>'#eff6ff','icon'=>'bi-heart-pulse'],
    'Penunjang Medis' => ['color'=>'#00a859','bg'=>'#f0fdf4','icon'=>'bi-capsule'],
    'Pelayanan Medis' => ['color'=>'#6c3fc5','bg'=>'#faf5ff','icon'=>'bi-hospital'],
    'Non Perawat'     => ['color'=>'#e8333c','bg'=>'#fff1f2','icon'=>'bi-person-gear'],
];
$km = $katMeta[$karir->kategori] ?? $katMeta['Non Perawat'];
$isDeadlineSoon = $karir->batas_lamaran && $karir->batas_lamaran->isFuture() && $karir->batas_lamaran->diffInDays(now()) <= 7;
$isExpired = $karir->batas_lamaran && $karir->batas_lamaran->isPast();
@endphp

@section('content')

{{-- HERO --}}
<div class="karir-detail-hero">
    <div class="container" style="position:relative;z-index:2">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb" style="--bs-breadcrumb-divider-color:rgba(255,255,255,0.3)">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('karir.index') }}">Karir</a></li>
                <li class="breadcrumb-item active">{{ $karir->posisi }}</li>
            </ol>
        </nav>

        <div class="kat-badge" style="background:rgba(255,255,255,0.18);color:#fff;border:1px solid rgba(255,255,255,0.25)">
            <i class="bi {{ $km['icon'] }}"></i>
            {{ $karir->kategori }}
        </div>

        <h1 class="hero-posisi">{{ $karir->posisi }}</h1>
        <p class="hero-dept">
            <i class="bi bi-building me-1"></i> {{ $karir->departemen }}
        </p>

        <div class="hero-meta-row">
            <div class="hero-meta-item">
                <i class="bi bi-briefcase"></i>
                {{ ucfirst(str_replace('-',' ', $karir->tipe)) }}
            </div>
            @if($karir->lokasi)
            <div class="hero-meta-item">
                <i class="bi bi-geo-alt"></i> {{ $karir->lokasi }}
            </div>
            @endif
            @if($karir->kuota)
            <div class="hero-meta-item">
                <i class="bi bi-people"></i> {{ $karir->kuota }} orang dibutuhkan
            </div>
            @endif
            @if($karir->batas_lamaran)
            <div>
                @if($isExpired)
                <span class="deadline-chip" style="background:#fee2e2;color:#dc2626">
                    <i class="bi bi-x-circle"></i> Lamaran Ditutup
                </span>
                @elseif($isDeadlineSoon)
                <span class="deadline-chip soon">
                    <i class="bi bi-exclamation-circle"></i>
                    Segera Tutup — {{ $karir->batas_lamaran->translatedFormat('d F Y') }}
                </span>
                @else
                <span class="deadline-chip normal">
                    <i class="bi bi-calendar-check"></i>
                    Deadline: {{ $karir->batas_lamaran->translatedFormat('d F Y') }}
                </span>
                @endif
            </div>
            @endif
        </div>
    </div>
</div>

{{-- BODY --}}
<div class="karir-detail-body">
    <div class="container">
        <div class="row g-4">

            {{-- LEFT: Detail content --}}
            <div class="col-lg-8">

                {{-- Success message --}}
                @if(session('success'))
                <div class="alert-success-custom">
                    <i class="bi bi-check-circle-fill"></i>
                    <div>
                        <strong>Lamaran Berhasil Dikirim!</strong>
                        <p class="mb-0" style="font-size:13px;color:#166534;margin-top:4px">
                            {{ session('success') }}
                        </p>
                    </div>
                </div>
                @endif

                {{-- Deskripsi --}}
                <div class="detail-card">
                    <h5><i class="bi bi-file-text"></i> Deskripsi Pekerjaan</h5>
                    <p>{!! nl2br(e($karir->deskripsi)) !!}</p>
                </div>

                {{-- Persyaratan --}}
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

                {{-- Benefit --}}
                <div class="detail-card">
                    <h5><i class="bi bi-gift"></i> Keuntungan Bergabung</h5>
                    <div class="row g-3 mt-1">
                        @foreach([
                            ['bi-shield-check','#0055a5','BPJS Kesehatan & Ketenagakerjaan'],
                            ['bi-graph-up','#00a859','Jenjang karir yang jelas'],
                            ['bi-mortarboard','#6c3fc5','Pelatihan & pengembangan SDM'],
                            ['bi-house-heart','#e8333c','Tunjangan kehadiran & makan'],
                            ['bi-calendar-week','#f59e0b','Cuti tahunan & cuti melahirkan'],
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

                {{-- APPLICATION FORM --}}
                @if(!$isExpired)
                <div class="form-lamar" id="form-lamar">
                    <div class="form-lamar-header">
                        <h4><i class="bi bi-send me-2"></i>Form Lamaran — {{ $karir->posisi }}</h4>
                        <p>Isi data diri Anda dengan lengkap dan benar. Semua kolom wajib diisi.</p>
                    </div>
                    <div class="form-lamar-body">
                        <form action="{{ route('karir.apply', $karir->id) }}"
                              method="POST" enctype="multipart/form-data" novalidate>
                            @csrf

                            <div class="row g-4">
                                {{-- Nama --}}
                                <div class="col-md-6">
                                    <label class="form-label-custom">
                                        <i class="bi bi-person" style="color:#0055a5"></i>
                                        Nama Lengkap <span class="required">*</span>
                                    </label>
                                    <input type="text" name="nama"
                                           class="form-control-custom @error('nama') is-invalid @enderror"
                                           placeholder="Nama sesuai KTP"
                                           value="{{ old('nama') }}" required>
                                    @error('nama')<div style="font-size:12px;color:#dc2626;margin-top:4px">{{ $message }}</div>@enderror
                                </div>

                                {{-- Email --}}
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

                                {{-- No HP --}}
                                <div class="col-md-6">
                                    <label class="form-label-custom">
                                        <i class="bi bi-telephone" style="color:#0055a5"></i>
                                        No. HP / WhatsApp <span class="required">*</span>
                                    </label>
                                    <input type="text" name="telepon"
                                           class="form-control-custom @error('telepon') is-invalid @enderror"
                                           placeholder="08xxxxxxxxxx"
                                           value="{{ old('telepon') }}" required>
                                    @error('telepon')<div style="font-size:12px;color:#dc2626;margin-top:4px">{{ $message }}</div>@enderror
                                </div>

                                {{-- Posisi (readonly) --}}
                                <div class="col-md-6">
                                    <label class="form-label-custom">
                                        <i class="bi bi-briefcase" style="color:#0055a5"></i>
                                        Posisi yang Dilamar
                                    </label>
                                    <input type="text" class="form-control-custom"
                                           value="{{ $karir->posisi }}" readonly
                                           style="background:#f3f4f6;color:#6b7280">
                                </div>

                                {{-- Upload CV --}}
                                <div class="col-12">
                                    <label class="form-label-custom">
                                        <i class="bi bi-file-earmark-pdf" style="color:#0055a5"></i>
                                        Upload CV / Resume <span class="required">*</span>
                                        <span style="font-size:11px;color:#9ca3af;font-weight:400">(PDF, DOC, DOCX — maks. 5 MB)</span>
                                    </label>
                                    <div class="file-upload-area @error('cv') is-invalid @enderror" id="cvDropArea">
                                        <input type="file" name="cv" id="cvInput"
                                               accept=".pdf,.doc,.docx" required>
                                        <div class="file-upload-icon"><i class="bi bi-cloud-arrow-up"></i></div>
                                        <div class="file-upload-text">
                                            <strong>Klik atau drag & drop</strong> CV Anda di sini<br>
                                            <span style="font-size:11px">Format: PDF, DOC, DOCX • Maksimal 5 MB</span>
                                        </div>
                                        <div class="file-name-display" id="fileNameDisplay">
                                            <i class="bi bi-check-circle-fill text-success me-1"></i>
                                            <span id="fileNameText"></span>
                                        </div>
                                    </div>
                                    @error('cv')<div style="font-size:12px;color:#dc2626;margin-top:4px">{{ $message }}</div>@enderror
                                </div>

                                {{-- Cover Letter --}}
                                <div class="col-12">
                                    <label class="form-label-custom">
                                        <i class="bi bi-chat-text" style="color:#0055a5"></i>
                                        Surat Motivasi / Cover Letter
                                        <span style="font-size:11px;color:#9ca3af;font-weight:400">(opsional)</span>
                                    </label>
                                    <textarea name="cover_letter" rows="5"
                                              class="form-control-custom"
                                              placeholder="Ceritakan motivasi Anda melamar posisi ini, pengalaman relevan, dan mengapa Anda cocok untuk tim kami...">{{ old('cover_letter') }}</textarea>
                                </div>

                                {{-- Agreement --}}
                                <div class="col-12">
                                    <label style="display:flex;align-items:flex-start;gap:10px;cursor:pointer;font-size:13px;color:#374151">
                                        <input type="checkbox" required
                                               style="margin-top:2px;width:16px;height:16px;accent-color:#0055a5;flex-shrink:0">
                                        <span>
                                            Saya menyatakan bahwa data yang saya isi adalah benar dan dapat dipertanggungjawabkan.
                                            Saya menyetujui <a href="{{ route('privacy-policy') }}" target="_blank" style="color:#0055a5">Kebijakan Privasi</a>
                                            RS Hamori terkait pengolahan data lamaran.
                                        </span>
                                    </label>
                                </div>

                                {{-- Submit --}}
                                <div class="col-12">
                                    <button type="submit" class="btn-submit-lamar">
                                        <i class="bi bi-send-fill"></i>
                                        Kirim Lamaran Sekarang
                                    </button>
                                    <p style="text-align:center;font-size:12px;color:#9ca3af;margin-top:12px;margin-bottom:0">
                                        <i class="bi bi-lock me-1"></i>Data Anda aman dan tidak akan dibagikan kepada pihak ketiga
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @else
                <div class="detail-card" style="text-align:center;padding:40px">
                    <i class="bi bi-calendar-x" style="font-size:3rem;color:#d1d5db;display:block;margin-bottom:14px"></i>
                    <h5 class="fw-bold">Periode Lamaran Telah Ditutup</h5>
                    <p class="text-muted mb-4">Lowongan ini sudah tidak menerima lamaran baru.</p>
                    <a href="{{ route('karir.index') }}" class="btn btn-primary">
                        <i class="bi bi-arrow-left me-1"></i> Lihat Lowongan Lain
                    </a>
                </div>
                @endif

            </div>

            {{-- RIGHT: Sidebar --}}
            <div class="col-lg-4">

                {{-- Info Singkat --}}
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
                            <span class="apply-info-value">{{ ucfirst(str_replace('-',' ',$karir->tipe)) }}</span>
                        </div>
                        <div class="apply-info-row">
                            <i class="bi bi-building"></i>
                            <span class="apply-info-label">Unit</span>
                            <span class="apply-info-value">{{ $karir->departemen }}</span>
                        </div>
                        @if($karir->lokasi)
                        <div class="apply-info-row">
                            <i class="bi bi-geo-alt"></i>
                            <span class="apply-info-label">Lokasi</span>
                            <span class="apply-info-value">{{ $karir->lokasi }}</span>
                        </div>
                        @endif
                        @if($karir->kuota)
                        <div class="apply-info-row">
                            <i class="bi bi-people"></i>
                            <span class="apply-info-label">Kuota</span>
                            <span class="apply-info-value">{{ $karir->kuota }} orang</span>
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
                    <div class="apply-sidebar-footer">
                        <a href="#form-lamar" class="btn btn-primary w-100 fw-bold" style="border-radius:12px;padding:11px">
                            <i class="bi bi-send me-2"></i>Lamar Sekarang
                        </a>
                    </div>
                    @endif
                </div>

                {{-- Bagikan --}}
                <div class="apply-sidebar mb-4">
                    <div class="apply-sidebar-header">
                        <h5><i class="bi bi-share me-2" style="color:#0055a5"></i>Bagikan Lowongan</h5>
                    </div>
                    <div class="apply-sidebar-body">
                        <div class="d-flex gap-2">
                            <a href="https://wa.me/?text={{ urlencode('Lowongan: '.$karir->posisi.' di RS Hamori — '.url()->current()) }}"
                               target="_blank"
                               class="btn btn-sm flex-fill fw-600"
                               style="background:#25d366;color:#fff;border-radius:10px;padding:9px;font-size:13px">
                                <i class="bi bi-whatsapp me-1"></i>WhatsApp
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}"
                               target="_blank"
                               class="btn btn-sm flex-fill fw-600"
                               style="background:#0077b5;color:#fff;border-radius:10px;padding:9px;font-size:13px">
                                <i class="bi bi-linkedin me-1"></i>LinkedIn
                            </a>
                            <button onclick="navigator.clipboard.writeText('{{ url()->current() }}');this.innerHTML='<i class=\'bi bi-check-lg\'></i>'"
                                    class="btn btn-sm fw-600"
                                    style="background:#f3f4f6;color:#374151;border-radius:10px;padding:9px;font-size:13px">
                                <i class="bi bi-link-45deg"></i>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Related jobs --}}
                @if($related->count())
                <div style="background:#fff;border-radius:16px;box-shadow:0 2px 12px rgba(0,0,0,0.06);overflow:hidden">
                    <div style="padding:18px 20px;border-bottom:1px solid #f0f0f0">
                        <h6 class="fw-bold mb-0" style="font-size:14px">Lowongan Serupa</h6>
                    </div>
                    <div style="padding:14px 12px;display:flex;flex-direction:column;gap:8px">
                        @foreach($related as $r)
                        @php $rm = $katMeta[$r->kategori] ?? $katMeta['Non Perawat']; @endphp
                        <a href="{{ route('karir.show', $r->id) }}" class="related-card">
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
<script>
// File upload preview
const cvInput    = document.getElementById('cvInput');
const dropArea   = document.getElementById('cvDropArea');
const nameDisplay = document.getElementById('fileNameDisplay');
const nameText   = document.getElementById('fileNameText');

if (cvInput) {
    cvInput.addEventListener('change', function () {
        if (this.files.length) {
            nameText.textContent = this.files[0].name;
            nameDisplay.style.display = 'block';
        }
    });
}

// Drag & drop styling
if (dropArea) {
    dropArea.addEventListener('dragover', e => { e.preventDefault(); dropArea.classList.add('dragover'); });
    dropArea.addEventListener('dragleave', () => dropArea.classList.remove('dragover'));
    dropArea.addEventListener('drop', e => {
        e.preventDefault();
        dropArea.classList.remove('dragover');
        if (e.dataTransfer.files.length) {
            cvInput.files = e.dataTransfer.files;
            nameText.textContent = e.dataTransfer.files[0].name;
            nameDisplay.style.display = 'block';
        }
    });
}

// Smooth scroll to form
document.querySelectorAll('a[href="#form-lamar"]').forEach(a => {
    a.addEventListener('click', e => {
        e.preventDefault();
        document.getElementById('form-lamar')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
});
</script>
@endpush
