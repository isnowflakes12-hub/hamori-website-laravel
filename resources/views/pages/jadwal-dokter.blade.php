@extends('layouts.app')

@section('title', 'Jadwal Dokter - RS Hamori')

@section('content')

<div class="page-header">
    <div class="container">
        <h1 class="page-title">Jadwal Dokter</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Jadwal Dokter</li>
            </ol>
        </nav>
    </div>
</div>

<section class="jadwal-section">
    <div class="container">

        {{-- SEARCH BAR --}}
        <div class="jadwal-search-wrap">
            <form method="GET" action="{{ route('dokter.index') }}" id="search-form">
                <div class="jadwal-search-row">
                    <div class="jadwal-search-field">
                        <i class="bi bi-search jadwal-search-icon"></i>
                        <input type="text" name="nama" id="input-nama" class="jadwal-search-input"
                            placeholder="Cari nama dokter..." value="{{ request('nama') }}" autocomplete="off">
                    </div>
                    <div class="jadwal-search-field">
                        <i class="bi bi-hospital jadwal-search-icon"></i>
                        <select name="poli" id="input-poli" class="jadwal-search-input jadwal-search-select">
                            <option value="">Semua Poli</option>
                            @foreach($allPolis as $p)
                            <option value="{{ $p->id }}" {{ request('poli') == $p->id ? 'selected' : '' }}>{{ $p->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="jadwal-search-field">
                        <i class="bi bi-calendar3 jadwal-search-icon"></i>
                        <select name="hari" id="input-hari" class="jadwal-search-input jadwal-search-select">
                            <option value="">Semua Hari</option>
                            @foreach($haris as $hari)
                            <option value="{{ $hari }}" {{ request('hari') == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="jadwal-search-btn">
                        <i class="bi bi-search me-2"></i>Cari Dokter
                    </button>
                    @if(request()->hasAny(['nama','poli','hari']))
                    <a href="{{ route('dokter.index') }}" class="jadwal-reset-btn">
                        <i class="bi bi-x-circle me-1"></i>Reset
                    </a>
                    @endif
                </div>
            </form>
        </div>

        {{-- INFO STAT --}}
        <div class="jadwal-stats">
            <span><i class="bi bi-building-fill-check me-2 text-primary"></i>{{ $polis->count() }} Poli Aktif</span>
            <span class="ms-4"><i class="bi bi-people-fill me-2 text-primary"></i>{{ $polis->sum(fn($p) => $p->dokters->count()) }} Dokter</span>
            @if(request()->hasAny(['nama','poli','hari']))
            <span class="ms-4 badge-filter"><i class="bi bi-funnel-fill me-1"></i>Filter aktif</span>
            @endif
        </div>

        {{-- HASIL KOSONG --}}
        @if($polis->isEmpty())
        <div class="jadwal-empty">
            <div class="jadwal-empty-icon"><i class="bi bi-person-x"></i></div>
            <h4>Tidak ada dokter ditemukan</h4>
            <p>Coba ubah filter pencarian Anda atau reset ke tampilan semua dokter.</p>
            <a href="{{ route('dokter.index') }}" class="btn btn-primary">Reset Pencarian</a>
        </div>
        @else

        {{-- POLI CHIPS FILTER --}}
        <div class="poli-chips-wrapper mb-4">
            <div class="poli-chips-scroll">
                <button class="poli-chip active" onclick="filterPoli('all', this)">Semua Poli</button>
                @foreach($polis as $poli)
                @if($poli->dokters->count() > 0)
                <button class="poli-chip" onclick="filterPoli('poli-{{ $poli->id }}', this)">{{ $poli->nama }}</button>
                @endif
                @endforeach
            </div>
        </div>

        {{-- DOCTOR GRID MODERN --}}
        <div class="doctor-grid-modern">
            @foreach($polis as $poli)
            @if($poli->dokters->count() > 0)
            @foreach($poli->dokters as $dokter)
            @php
                $jadwalSorted = $dokter->jadwal->sortBy(function($j) {
                    return ['Senin'=>1,'Selasa'=>2,'Rabu'=>3,'Kamis'=>4,'Jumat'=>5,'Sabtu'=>6,'Minggu'=>7][$j->hari] ?? 8;
                });
                $waNumber = \App\Models\SiteSetting::get('phone_whatsapp', '6281111121705');
                $jadwalData = $jadwalSorted->values()->map(function($j) {
                    return [
                        'hari'    => $j->hari,
                        'mulai'   => substr($j->jam_mulai, 0, 5),
                        'selesai' => substr($j->jam_selesai, 0, 5),
                    ];
                })->values()->toArray();
                $jadwalJson = json_encode($jadwalData);
            @endphp
            <div class="doctor-card-modern poli-item poli-{{ $poli->id }}" 
                 onclick="openDoctorOffcanvas(this)"
                 data-nama="{{ $dokter->nama_lengkap }}"
                 data-poli="{{ strtoupper($poli->nama) }}"
                 data-foto="{{ $dokter->foto ? asset('storage/'.$dokter->foto) : '' }}"
                 data-wa="{{ $waNumber }}"
                 data-profil="{{ route('dokter.show', $dokter->id) }}"
                 data-jadwal='{{ $jadwalJson }}'>
                
                <div class="doctor-card-photo-wrapper">
                    @if($dokter->foto)
                    <img src="{{ asset('storage/' . $dokter->foto) }}" alt="{{ $dokter->nama }}" class="doctor-card-photo" loading="lazy">
                    @else
                    <div class="doctor-card-placeholder"><i class="bi bi-person-fill"></i></div>
                    @endif
                    <div class="doctor-card-hover-overlay">
                        <span>Lihat Jadwal <i class="bi bi-arrow-right ms-1"></i></span>
                    </div>
                </div>
                <div class="doctor-card-info">
                    <h5 class="doctor-card-nama">{{ $dokter->nama_lengkap }}</h5>
                    <p class="doctor-card-spesialis">{{ strtoupper($poli->nama) }}</p>
                </div>
            </div>
            @endforeach
            @endif
            @endforeach
        </div>

        {{-- No Results --}}
        <div id="no-doctor-found" class="text-center py-5" style="display: none;">
            <i class="bi bi-search text-muted" style="font-size: 3rem;"></i>
            <h4 class="mt-3 text-muted">Tidak ada dokter di poliklinik ini</h4>
        </div>

        @endif
    </div>
</section>

{{-- OFFCANVAS PANEL (SLIDE-OVER) --}}
<div class="doctor-offcanvas-backdrop" id="doctor-backdrop" onclick="closeDoctorOffcanvas()"></div>
<div class="doctor-offcanvas" id="doctor-offcanvas">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Detail Jadwal Dokter</h5>
        <button type="button" class="offcanvas-close-btn" onclick="closeDoctorOffcanvas()">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>
    
    <div class="offcanvas-body">
        <div class="offcanvas-profile-wrap text-center mb-4">
            <div class="offcanvas-photo-container mx-auto mb-3">
                <img src="" id="oc-foto" alt="Foto Dokter" class="offcanvas-photo" style="display:none;">
                <div id="oc-placeholder" class="offcanvas-placeholder"><i class="bi bi-person-fill"></i></div>
            </div>
            <h4 id="oc-nama" class="fw-bold mb-1"></h4>
            <p id="oc-poli" class="text-primary fw-semibold small mb-0"></p>
        </div>

        <div class="offcanvas-schedule-wrap">
            <h6 class="fw-bold mb-3"><i class="bi bi-calendar3 me-2"></i>Jadwal Praktek</h6>
            
            <div id="oc-jadwal-container" class="table-responsive">
                <!-- Jadwal table injected here via JS -->
            </div>
            <div id="oc-no-jadwal" class="alert alert-warning" style="display:none;">
                <i class="bi bi-info-circle me-2"></i>Jadwal belum tersedia.
            </div>
        </div>
    </div>

    <div class="offcanvas-footer">
        <a href="#" id="oc-btn-profil" class="btn btn-outline-primary w-100 mb-2">Lihat Profil Lengkap</a>
        <a href="#" id="oc-btn-wa" target="_blank" class="btn btn-danger w-100" style="background:#a91e41; border:none;">
            <i class="bi bi-whatsapp me-2"></i> Buat Janji Sekarang
        </a>
    </div>
</div>

<style>
/* ──────────────────────────────────────────────────
   JADWAL DOKTER PAGE
────────────────────────────────────────────────── */
.jadwal-section {
    padding: 48px 0 80px;
    background: #f7f9fc;
    min-height: 60vh;
}

/* ── Search ── */
.jadwal-search-wrap {
    background: #fff;
    border-radius: 18px;
    padding: 24px 28px;
    box-shadow: 0 4px 24px rgba(0,0,0,.07);
    margin-bottom: 24px;
}

.jadwal-search-row {
    display: flex;
    gap: 12px;
    align-items: center;
    flex-wrap: wrap;
}

.jadwal-search-field {
    flex: 1 1 220px;
    position: relative;
    min-width: 180px;
}

.jadwal-search-icon {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #9ba5b4;
    font-size: 16px;
    pointer-events: none;
}

.jadwal-search-input {
    width: 100%;
    border: 1.5px solid #e4e9f0;
    border-radius: 10px;
    padding: 11px 14px 11px 40px;
    font-size: 14px;
    color: #2d3748;
    background: #f7f9fc;
    transition: border-color .2s, background .2s;
    appearance: none;
    outline: none;
}

.jadwal-search-input:focus {
    border-color: var(--primary, #0d6efd);
    background: #fff;
    box-shadow: 0 0 0 3px rgba(13,110,253,.1);
}

.jadwal-search-select {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='%23666' d='M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 14px center;
    background-size: 12px;
    padding-right: 36px;
}

.jadwal-search-btn {
    background: var(--primary, #0d6efd);
    color: #fff;
    border: none;
    border-radius: 10px;
    padding: 11px 24px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    white-space: nowrap;
    transition: background .2s, transform .15s;
    flex-shrink: 0;
}

.jadwal-search-btn:hover {
    background: #0a58ca;
    transform: translateY(-1px);
}

.jadwal-reset-btn {
    color: #6c757d;
    font-size: 13px;
    text-decoration: none;
    padding: 11px 12px;
    border-radius: 10px;
    white-space: nowrap;
    transition: background .2s, color .2s;
    flex-shrink: 0;
}

.jadwal-reset-btn:hover {
    background: #f0f0f0;
    color: #333;
}

/* ── Stats ── */
.jadwal-stats {
    font-size: 14px;
    color: #6c757d;
    margin-bottom: 24px;
    font-weight: 500;
}

.badge-filter {
    background: #fff3cd;
    color: #856404;
    padding: 3px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

/* ── Empty ── */
.jadwal-empty {
    text-align: center;
    padding: 80px 24px;
    background: #fff;
    border-radius: 18px;
}

.jadwal-empty-icon {
    font-size: 64px;
    color: #dee2e6;
    margin-bottom: 20px;
}

.jadwal-empty h4 {
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 8px;
}

.jadwal-empty p {
    color: #9ba5b4;
    margin-bottom: 24px;
}

/* ──────────────────────────────────────────────────
   POLI CHIPS FILTER
────────────────────────────────────────────────── */
.poli-chips-wrapper {
    position: relative;
    width: 100%;
}

.poli-chips-scroll {
    display: flex;
    gap: 12px;
    overflow-x: auto;
    padding-bottom: 12px;
    scrollbar-width: none; /* Firefox */
}

.poli-chips-scroll::-webkit-scrollbar {
    display: none; /* Chrome/Safari */
}

.poli-chip {
    background: #fff;
    color: #4a5568;
    border: 1.5px solid #e2e8f0;
    padding: 10px 20px;
    border-radius: 50px;
    font-size: 14px;
    font-weight: 600;
    white-space: nowrap;
    cursor: pointer;
    transition: all 0.2s ease;
    box-shadow: 0 2px 4px rgba(0,0,0,0.02);
}

.poli-chip:hover {
    border-color: rgba(13,110,253,0.5);
    color: var(--primary, #0d6efd);
    background: #f8fbff;
}

.poli-chip.active {
    background: var(--primary, #0d6efd);
    color: #fff;
    border-color: var(--primary, #0d6efd);
    box-shadow: 0 4px 12px rgba(13,110,253,0.2);
}

/* ──────────────────────────────────────────────────
   DOCTOR GRID MODERN
────────────────────────────────────────────────── */
.doctor-grid-modern {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 20px;
}

.doctor-card-modern {
    background: #fff;
    border: 1px solid #eef1f6;
    border-radius: 16px;
    overflow: hidden;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    box-shadow: 0 4px 12px rgba(0,0,0,0.03);
    position: relative;
}

.doctor-card-modern:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 24px rgba(0,0,0,0.08);
    border-color: rgba(13,110,253,0.2);
}

.doctor-card-photo-wrapper {
    position: relative;
    width: 100%;
    aspect-ratio: 1 / 1;
    background: #e4e9f0;
    overflow: hidden;
}

.doctor-card-photo {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: top center;
    transition: transform 0.5s ease;
}

.doctor-card-modern:hover .doctor-card-photo {
    transform: scale(1.05);
}

.doctor-card-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 64px;
    color: #9ba5b4;
    background: linear-gradient(135deg, #eef1f6, #e4e9f0);
}

.doctor-card-hover-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
    padding: 20px 16px 16px;
    color: #fff;
    font-size: 13px;
    font-weight: 600;
    opacity: 0;
    transform: translateY(10px);
    transition: all 0.3s ease;
    display: flex;
    align-items: flex-end;
}

.doctor-card-modern:hover .doctor-card-hover-overlay {
    opacity: 1;
    transform: translateY(0);
}

.doctor-card-info {
    padding: 16px;
    text-align: center;
}

.doctor-card-nama {
    font-size: 15px;
    font-weight: 700;
    color: #1a202c;
    margin-bottom: 4px;
    line-height: 1.3;
}

.doctor-card-spesialis {
    font-size: 11px;
    color: var(--primary, #0d6efd);
    font-weight: 600;
    letter-spacing: 0.5px;
    margin-bottom: 0;
}

/* ──────────────────────────────────────────────────
   OFFCANVAS PANEL (Slide-Over)
────────────────────────────────────────────────── */
.doctor-offcanvas-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background: rgba(15, 23, 42, 0.4);
    backdrop-filter: blur(4px);
    z-index: 1040;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

.doctor-offcanvas-backdrop.show {
    opacity: 1;
    visibility: visible;
}

.doctor-offcanvas {
    position: fixed;
    top: 0;
    right: -400px; /* Hidden by default */
    width: 100%;
    max-width: 400px;
    height: 100vh;
    background: #fff;
    z-index: 1045;
    box-shadow: -10px 0 30px rgba(0,0,0,0.1);
    transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    display: flex;
    flex-direction: column;
}

.doctor-offcanvas.show {
    transform: translateX(-400px); /* Slide in */
}

.offcanvas-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px 24px;
    border-bottom: 1px solid #eef1f6;
    background: #fff;
}

.offcanvas-title {
    font-size: 16px;
    font-weight: 700;
    margin: 0;
    color: #1a202c;
}

.offcanvas-close-btn {
    background: #f1f5fa;
    border: none;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #4a5568;
    cursor: pointer;
    transition: background 0.2s;
}

.offcanvas-close-btn:hover {
    background: #e2e8f0;
}

.offcanvas-body {
    padding: 24px;
    overflow-y: auto;
    flex: 1;
}

.offcanvas-photo-container {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    background: #e4e9f0;
    border: 4px solid #fff;
    box-shadow: 0 4px 12px rgba(13,110,253,0.15);
    overflow: hidden;
    position: relative;
}

.offcanvas-photo {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.offcanvas-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 48px;
    color: #9ba5b4;
    background: linear-gradient(135deg, #eef1f6, #e4e9f0);
}

.offcanvas-schedule-wrap {
    background: #f8fbff;
    padding: 20px;
    border-radius: 12px;
    border: 1px solid #eef1f6;
}

.offcanvas-footer {
    padding: 20px 24px;
    border-top: 1px solid #eef1f6;
    background: #fff;
}

/* Table in offcanvas */
.jadwal-week-table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
}

.jadwal-week-table th {
    background: #f1f5fa;
    color: #1a202c;
    font-size: 11px;
    font-weight: 700;
    text-align: center;
    padding: 10px 4px;
    border: 1px solid #eef1f6;
    letter-spacing: 0.5px;
}

.jadwal-week-table td {
    text-align: center;
    padding: 10px 8px;
    font-size: 12px;
    color: #3f4756;
    border: 1px solid #eef1f6;
    font-weight: 500;
}

.dokter-schedule-row:last-child {
    border-bottom: none;
}

.dokter-schedule-hari {
    font-weight: 600;
    color: #2d3748;
}

.dokter-schedule-jam {
    color: #6c757d;
    font-size: 11.5px;
}

.dokter-card-hint {
    font-size: 12px;
    color: #9ba5b4;
    display: flex;
    align-items: center;
    gap: 4px;
    margin-top: 4px;
}

/* ──────────────────────────────────────────────────
   MODAL DOKTER
────────────────────────────────────────────────── */
.dokter-modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,.55);
    backdrop-filter: blur(4px);
    z-index: 9999;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.dokter-modal-overlay.is-open {
    display: flex;
    animation: fadeIn .2s ease;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to   { opacity: 1; }
}

.dokter-modal-box {
    background: #fff;
    border-radius: 20px;
    width: 100%;
    max-width: 560px;
    max-height: 90vh;
    overflow-y: auto;
    position: relative;
    animation: slideUp .25s ease;
    box-shadow: 0 24px 64px rgba(0,0,0,.2);
}

@keyframes slideUp {
    from { opacity: 0; transform: translateY(24px); }
    to   { opacity: 1; transform: translateY(0); }
}

.dokter-modal-close {
    position: absolute;
    top: 14px;
    right: 14px;
    width: 34px;
    height: 34px;
    border-radius: 50%;
    border: none;
    background: #f0f0f0;
    color: #666;
    font-size: 14px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background .2s;
    z-index: 10;
}

.dokter-modal-close:hover { background: #e0e0e0; }

.dokter-modal-inner {
    display: flex;
    gap: 0;
    flex-direction: column;
}

.dokter-modal-photo-wrap {
    width: 100%;
    height: 220px;
    background: linear-gradient(135deg, #e4e9f0, #f0f4f8);
    overflow: hidden;
    border-radius: 20px 20px 0 0;
    flex-shrink: 0;
}

.dokter-modal-foto {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: top center;
}

.dokter-modal-photo-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 80px;
    color: #9ba5b4;
}

.dokter-modal-info {
    padding: 24px;
}

.dokter-modal-spesialis {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: var(--primary, #0d6efd);
    margin-bottom: 6px;
}

.dokter-modal-nama {
    font-size: 20px;
    font-weight: 800;
    color: #1a202c;
    margin-bottom: 20px;
    line-height: 1.3;
}

.dokter-modal-jadwal-wrap {
    background: #f7f9fc;
    border-radius: 14px;
    padding: 16px;
    margin-bottom: 20px;
    border: 1px solid #eef1f6;
}

.dokter-modal-jadwal-title {
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .8px;
    color: #64748b;
    margin-bottom: 12px;
}

.dokter-modal-jadwal-list { display: flex; flex-direction: column; gap: 6px; }

.dokter-modal-jadwal-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #fff;
    border-radius: 8px;
    padding: 9px 12px;
    border: 1px solid #eef1f6;
}

.dokter-modal-jadwal-hari {
    font-weight: 700;
    font-size: 13px;
    color: #1a202c;
}

.dokter-modal-jadwal-jam {
    font-size: 13px;
    color: #64748b;
}

.dokter-modal-no-jadwal {
    color: #9ba5b4;
    font-size: 13px;
    text-align: center;
    padding: 12px;
}

.dokter-modal-wa-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    background: #25D366;
    color: #fff;
    border-radius: 12px;
    padding: 13px;
    font-size: 14px;
    font-weight: 700;
    text-decoration: none;
    transition: background .2s, transform .15s;
}

.dokter-modal-wa-btn:hover {
    background: #1da851;
    color: #fff;
    transform: translateY(-1px);
}

/* Responsive */
@media (max-width: 768px) {
    .jadwal-search-row { flex-direction: column; }
    .jadwal-search-field { flex: 1 1 100%; min-width: 100%; }
    .jadwal-search-btn, .jadwal-reset-btn { width: 100%; text-align: center; }
    .poli-header { padding: 14px 16px; }
    .poli-body { padding: 16px; }
    .dokter-grid { grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); gap: 12px; }
    .dokter-card-photo { max-height: 180px; }
}
</style>

<script>
// Filter Poli (Chips)
function filterPoli(poliId, btnEl) {
    // 1. Update active state on chips
    document.querySelectorAll('.poli-chip').forEach(c => c.classList.remove('active'));
    if(btnEl) btnEl.classList.add('active');

    const allCards = document.querySelectorAll('.doctor-card-modern');
    const noResult = document.getElementById('no-doctor-found');
    let visibleCount = 0;

    // 2. Tampilkan/Sembunyikan kartu dokter
    if (poliId === 'all') {
        allCards.forEach(card => {
            card.style.display = 'block';
            visibleCount++;
        });
    } else {
        allCards.forEach(card => {
            if (card.classList.contains(poliId)) {
                card.style.display = 'block';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });
    }

    // 3. Tampilkan pesan kosong jika tidak ada dokter
    if (visibleCount === 0) {
        noResult.style.display = 'block';
    } else {
        noResult.style.display = 'none';
    }
}

// Buka Offcanvas
function openDoctorOffcanvas(cardEl) {
    try {
        const nama      = cardEl.dataset.nama      || '';
        const poli      = cardEl.dataset.poli      || '';
        const foto      = cardEl.dataset.foto      || '';
        const wa        = cardEl.dataset.wa        || '';
        const profilUrl = cardEl.dataset.profil    || '#';
        const rawJson   = cardEl.dataset.jadwal    || '[]';
        const jadwal    = JSON.parse(rawJson);

        // Isi Data Profil
        document.getElementById('oc-nama').textContent = nama;
        document.getElementById('oc-poli').textContent = poli;
        document.getElementById('oc-btn-wa').href      = 'https://wa.me/' + wa + '?text=' + encodeURIComponent('Halo, saya ingin buat janji dengan ' + nama);
        document.getElementById('oc-btn-profil').href  = profilUrl;

        // Foto
        const imgEl = document.getElementById('oc-foto');
        const phEl  = document.getElementById('oc-placeholder');
        if (foto) {
            imgEl.src = foto;
            imgEl.style.display = 'block';
            phEl.style.display = 'none';
        } else {
            imgEl.style.display = 'none';
            phEl.style.display = 'flex';
        }

        // Render Jadwal
        const container = document.getElementById('oc-jadwal-container');
        const noJadwal  = document.getElementById('oc-no-jadwal');
        
        if (Array.isArray(jadwal) && jadwal.length > 0) {
            noJadwal.style.display = 'none';
            container.style.display = 'block';
            
            // Generate HTML table for schedule
            const hariOrder = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'];
            let jadwalPerHari = {};
            hariOrder.forEach(h => jadwalPerHari[h] = []);
            
            jadwal.forEach(j => {
                if (jadwalPerHari[j.hari]) {
                    jadwalPerHari[j.hari].push(j.mulai + ' – ' + j.selesai);
                }
            });

            let maxRows = 1;
            Object.values(jadwalPerHari).forEach(arr => {
                if (arr.length > maxRows) maxRows = arr.length;
            });

            let tableHtml = '<table class="jadwal-week-table"><thead><tr>';
            hariOrder.forEach(h => {
                tableHtml += `<th>${h.substring(0,3).toUpperCase()}</th>`;
            });
            tableHtml += '</tr></thead><tbody>';
            
            for (let row = 0; row < maxRows; row++) {
                tableHtml += '<tr>';
                hariOrder.forEach(h => {
                    const slot = jadwalPerHari[h][row] || '-';
                    tableHtml += `<td>${slot}</td>`;
                });
                tableHtml += '</tr>';
            }
            tableHtml += '</tbody></table>';
            
            container.innerHTML = tableHtml;
        } else {
            container.style.display = 'none';
            noJadwal.style.display = 'block';
        }

        // Tampilkan Offcanvas
        document.getElementById('doctor-backdrop').classList.add('show');
        document.getElementById('doctor-offcanvas').classList.add('show');
        document.body.style.overflow = 'hidden';

    } catch(err) {
        console.error('Error opening offcanvas:', err);
    }
}

// Tutup Offcanvas
function closeDoctorOffcanvas() {
    document.getElementById('doctor-backdrop').classList.remove('show');
    document.getElementById('doctor-offcanvas').classList.remove('show');
    document.body.style.overflow = '';
}

// ESC key listener untuk tutup offcanvas
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeDoctorOffcanvas();
    }
});
</script>

@endsection
