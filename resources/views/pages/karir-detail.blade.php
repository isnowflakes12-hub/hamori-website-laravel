@extends('layouts.app')
@section('title', $karir->posisi . ' — Karir RS Hamori')

@push('styles')

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

