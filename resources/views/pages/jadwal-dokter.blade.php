@extends('layouts.app')

@section('title', 'Jadwal Dokter - RS Hamori')

@section('content')

@php
    $polis = $polis->sortBy(function($poli, $key) {
        $nama = strtolower($poli->nama);
        if (str_contains($nama, 'umum')) return 999;
        if (str_contains($nama, 'gigi')) return 998;
        return $key;
    });
@endphp<div class="page-header">
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

                    <div class="jadwal-search-field" style="position: relative;">
                        <i class="bi bi-calendar3 jadwal-search-icon"></i>
                        <input type="hidden" name="hari" id="input-hari" value="{{ request('hari') }}">
                        
                        <div class="jadwal-search-input jadwal-search-select custom-dropdown-trigger" id="hariDropdownTrigger" style="display: flex; justify-content: space-between; align-items: center; cursor: pointer; user-select: none;">
                            <span id="hariDropdownLabel">{{ request('hari') ?: 'Semua Hari' }}</span>
                            <i class="bi bi-chevron-down ms-2" id="hariDropdownArrow" style="transition: transform 0.2s; color: #94a3b8; font-size: 14px;"></i>
                        </div>

                        <ul class="custom-dropdown-options" id="hariDropdownOptions" style="position: absolute; top: calc(100% + 5px); left: 0; width: 100%; background: #ffffff; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.08); border: 1px solid #e2e8f0; list-style: none; padding: 6px; margin: 0; z-index: 100; opacity: 0; visibility: hidden; transform: translateY(-10px); transition: all 0.2s ease;">
                            <li class="custom-dropdown-option {{ request('hari') == '' ? 'active' : '' }}" data-value="">Semua Hari</li>
                            @foreach($haris as $hari)
                            <li class="custom-dropdown-option {{ request('hari') == $hari ? 'active' : '' }}" data-value="{{ $hari }}">{{ $hari }}</li>
                            @endforeach
                        </ul>
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
        <div class="jadwal-stats-wrapper">
            <div class="jadwal-stat-badge">
                <i class="bi bi-building-fill-check"></i>
                <span><strong>{{ $polis->count() }}</strong> Poli Aktif</span>
            </div>
            <div class="jadwal-stat-badge">
                <i class="bi bi-people-fill"></i>
                <span><strong>{{ $polis->sum(fn($p) => $p->dokters->count()) }}</strong> Dokter</span>
            </div>
            @if(request()->hasAny(['nama','poli','hari']))
            <div class="jadwal-stat-badge badge-filter">
                <i class="bi bi-funnel-fill"></i>
                <span>Filter aktif</span>
            </div>
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

        <div class="row jadwal-enterprise-layout">
            {{-- SIDEBAR KIRI (DESKTOP) --}}
            <div class="col-lg-3 d-none d-lg-block">
                <div class="jadwal-sidebar sticky-top" style="top: 100px; z-index: 10;">
                    <h5 class="fw-bold mb-3 text-dark">Poliklinik</h5>
                    <div class="list-group list-group-flush jadwal-sidebar-menu rounded-3 shadow-sm border border-light overflow-hidden">

                        @foreach($polis as $poli)
                        @if($poli->dokters->count() > 0)
                        <a href="javascript:void(0)" class="list-group-item list-group-item-action border-bottom" id="menu-poli-{{ $poli->id }}" onclick="scrollToPoli('poli-section-{{ $poli->id }}', this)">
                            {{ $poli->nama }}
                        </a>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- KONTEN KANAN (DAFTAR DOKTER) --}}
            <div class="col-lg-9">
                {{-- GRUP DOKTER PER POLI --}}
                <div id="all-doctors-wrapper">
                    @foreach($polis as $poli)
                    @if($poli->dokters->count() > 0)
                    <div class="poli-section mb-3 mb-lg-5" id="poli-section-{{ $poli->id }}">
                        <h4 class="poli-accordion-header fw-bold mb-0 mb-lg-4 pb-2 border-bottom" style="font-size: 1.25rem; color: #1ba99e; border-bottom-color: rgba(27, 169, 158, 0.2) !important;" onclick="toggleMobileAccordion(this)">
                            <span>{{ $poli->nama }}</span>
                            <i class="bi bi-chevron-down poli-accordion-icon d-lg-none"></i>
                        </h4>
                        
                        <div class="doctor-grid-modern">
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
                            <div class="doctor-card-modern" 
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
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
                
                {{-- No Results --}}
                <div id="no-doctor-found" class="text-center py-5" style="display: none;">
                    <i class="bi bi-search text-muted" style="font-size: 3rem;"></i>
                    <h4 class="mt-3 text-muted">Tidak ada dokter ditemukan</h4>
                </div>
            </div>
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
            <p id="oc-poli" class="fw-semibold small mb-0" style="color: #1ba99e;"></p>
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
        <a href="#" id="oc-btn-profil" class="btn btn-outline-primary w-100 mb-2" style="color:#1ba99e; border-color:#1ba99e;">Lihat Profil Lengkap</a>
        <a href="#" id="oc-btn-wa" target="_blank" class="btn w-100" style="background:#1ba99e; color:#fff; border:none;">
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
    border-color: var(--primary, #a91e41);
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
    background: #1ba99e;
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
    display: inline-flex;
    align-items: center;
}

.jadwal-search-btn:hover {
    background: #168f86;
    transform: translateY(-1px);
}

.jadwal-reset-btn {
    background: #f1f5f9;
    color: #64748b;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    padding: 11px 20px;
    border-radius: 10px;
    white-space: nowrap;
    transition: all 0.2s;
    display: inline-flex;
    align-items: center;
    border: 1px solid #e2e8f0;
    flex-shrink: 0;
}

.jadwal-reset-btn:hover {
    background: #e2e8f0;
    color: #334155;
    border-color: #cbd5e1;
}

/* ── Stats ── */
.jadwal-stats-wrapper {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    margin-bottom: 24px;
}

.jadwal-stat-badge {
    display: flex;
    align-items: center;
    gap: 8px;
    background: #fff;
    padding: 8px 16px;
    border-radius: 30px;
    font-size: 13px;
    color: #475569;
    border: 1px solid #e2e8f0;
    box-shadow: 0 2px 8px rgba(0,0,0,0.02);
}

.jadwal-stat-badge i {
    color: #1ba99e;
    font-size: 15px;
}

.jadwal-stat-badge strong {
    color: #1e293b;
    font-weight: 700;
}

.jadwal-stat-badge.badge-filter {
    background: #fff8e1;
    border-color: #ffecb3;
    color: #b07d0a;
}
.jadwal-stat-badge.badge-filter i {
    color: #b07d0a;
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
   GRID POLIKLINIK (Initial View)
────────────────────────────────────────────────── */
.poli-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 16px;
}

.poli-card {
    background: #fff;
    border: 1px solid #eef1f6;
    border-radius: 12px;
    padding: 24px 16px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    box-shadow: 0 4px 12px rgba(0,0,0,0.03);
}

.poli-card:hover {
    background: #fcf1f3;
    border-color: rgba(169,30,65,0.3);
    transform: translateY(-5px);
    box-shadow: 0 12px 24px rgba(169,30,65,0.08);
}

.poli-card-icon {
    width: 56px;
    height: 56px;
    margin: 0 auto 16px;
    border-radius: 16px;
    background: linear-gradient(135deg, var(--primary, #a91e41), #4a90e2);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    transition: transform 0.3s ease;
}

.poli-card:hover .poli-card-icon {
    transform: scale(1.1) rotate(5deg);
}

.poli-card-name {
    font-size: 16px;
    font-weight: 700;
    color: #1a202c;
    margin-bottom: 6px;
    line-height: 1.3;
}

.poli-card-count {
    font-size: 13px;
    color: var(--primary, #a91e41);
    font-weight: 600;
}




/* Override sidebar active color */
.jadwal-sidebar-menu .list-group-item.active {
    background-color: #1ba99e !important;
    border-color: #1ba99e !important;
    color: #fff !important;
}

/* ──────────────────────────────────────────────────
   MOBILE ACCORDION
────────────────────────────────────────────────── */
.poli-accordion-header {
    cursor: default;
}

.poli-accordion-icon {
    display: none;
}

@media (max-width: 991.98px) {
    .poli-accordion-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #fff;
        border: 1.5px solid #e2e8f0 !important;
        border-radius: 14px !important;
        padding: 16px 20px !important;
        margin-bottom: 0 !important;
        cursor: pointer;
        transition: all 0.25s ease;
        border-bottom-color: #e2e8f0 !important;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    }

    .poli-accordion-header:hover {
        border-color: #1ba99e !important;
        background: #f0faf9;
    }

    .poli-accordion-header.active {
        background: #1ba99e;
        color: #fff !important;
        border-color: #1ba99e !important;
        border-bottom-left-radius: 0 !important;
        border-bottom-right-radius: 0 !important;
        box-shadow: 0 4px 12px rgba(27,169,158,0.15);
    }

    .poli-accordion-icon {
        display: inline-block !important;
        font-size: 18px;
        transition: transform 0.3s ease;
    }

    .poli-accordion-header.active .poli-accordion-icon {
        transform: rotate(180deg);
        color: #fff;
    }

    .poli-section .doctor-grid-modern {
        display: none;
        border: 1.5px solid #e2e8f0;
        border-top: none;
        border-bottom-left-radius: 14px;
        border-bottom-right-radius: 14px;
        padding: 16px;
        background: #fff;
    }

    .poli-section.accordion-open .doctor-grid-modern {
        display: grid !important;
        animation: accordionSlideDown 0.3s ease;
    }

    .poli-section {
        margin-bottom: 12px !important;
    }

    @keyframes accordionSlideDown {
        from { opacity: 0; transform: translateY(-8px); }
        to   { opacity: 1; transform: translateY(0); }
    }
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
    border-color: rgba(169,30,65,0.2);
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
    color: #1ba99e;
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
    right: 0;
    bottom: 0;
    width: 100%;
    height: 100%;
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
    background: #fff;
    z-index: 1045;
    display: flex;
    flex-direction: column;
}

/* Mobile Offcanvas */
@media (max-width: 991.98px) {
    .doctor-offcanvas {
        top: 0;
        bottom: 0;
        right: -400px; /* Hidden by default */
        width: 100%;
        max-width: 400px;
        height: 100%;
        box-shadow: -10px 0 30px rgba(0,0,0,0.1);
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .doctor-offcanvas.show {
        transform: translateX(-400px); /* Slide in */
    }
}

/* Desktop Centered Modal */
@media (min-width: 992px) {
    .doctor-offcanvas {
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0.95);
        width: 100%;
        max-width: 500px;
        height: auto;
        max-height: 90vh;
        border-radius: 20px;
        box-shadow: 0 24px 48px rgba(0,0,0,0.15);
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .doctor-offcanvas.show {
        transform: translate(-50%, -50%) scale(1);
        opacity: 1;
        visibility: visible;
    }
    .offcanvas-body {
        border-radius: 20px; /* ensure scrollbars stay inside rounded corners */
    }
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
    box-shadow: 0 4px 12px rgba(169,30,65,0.15);
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
    background: #f0faf9;
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
    white-space: nowrap;
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

.jadwal-search-select {
    width: 100%;
    border: none;
    background: transparent;
    font-size: 15px;
    font-weight: 500;
    color: var(--ink);
    outline: none;
    font-family: inherit;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    cursor: pointer;
}

/* Custom Dropdown Styles */
.jadwal-search-field.open .custom-dropdown-options {
    opacity: 1 !important;
    visibility: visible !important;
    transform: translateY(0) !important;
}
.jadwal-search-field.open #hariDropdownArrow {
    transform: rotate(180deg);
}
.custom-dropdown-option {
    padding: 10px 15px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 500;
    color: var(--ink);
    cursor: pointer;
    transition: all 0.2s;
    margin-bottom: 2px;
}
.custom-dropdown-option:hover {
    background: #f1f5f9;
}
.custom-dropdown-option.active {
    background: #eff6ff;
    color: #0055a5;
    font-weight: 600;
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
    color: var(--primary, #a91e41);
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
// ── Mobile Accordion Toggle ──
function toggleMobileAccordion(headerEl) {
    // Only work on mobile (<992px)
    if (window.innerWidth >= 992) return;

    const section = headerEl.closest('.poli-section');
    const isOpen = section.classList.contains('accordion-open');

    // Close all other accordions
    document.querySelectorAll('.poli-section.accordion-open').forEach(sec => {
        sec.classList.remove('accordion-open');
        sec.querySelector('.poli-accordion-header').classList.remove('active');
    });

    // Toggle current
    if (!isOpen) {
        section.classList.add('accordion-open');
        headerEl.classList.add('active');

        // Smooth scroll to this accordion
        setTimeout(() => {
            const y = headerEl.getBoundingClientRect().top + window.pageYOffset - 110;
            window.scrollTo({ top: y, behavior: 'smooth' });
        }, 50);
    }
}

// ── Desktop Sidebar Tab ──
function scrollToPoli(targetId, btnEl) {
    // Update active state on sidebar
    document.querySelectorAll('.jadwal-sidebar-menu a').forEach(c => c.classList.remove('active'));
    if (btnEl) btnEl.classList.add('active');

    // Filter: show only target poli section
    const allSections = document.querySelectorAll('.poli-section');
    const noResult = document.getElementById('no-doctor-found');

    allSections.forEach(sec => {
        if (sec.id === targetId) {
            sec.style.display = 'block';
            sec.style.opacity = '0';
            setTimeout(() => { sec.style.transition = 'opacity 0.3s ease'; sec.style.opacity = '1'; }, 10);
        } else {
            sec.style.display = 'none';
        }
    });
    noResult.style.display = 'none';
    window.scrollTo({ top: 250, behavior: 'smooth' });
}

// ── Init on Load ──
document.addEventListener('DOMContentLoaded', function() {
    const isMobile = window.innerWidth < 992;

    if (isMobile) {
        // Mobile: show all poli sections (accordion headers visible, grids hidden via CSS)
        document.querySelectorAll('.poli-section').forEach(sec => {
            sec.style.display = 'block';
        });
        // Auto-open the first accordion
        const firstHeader = document.querySelector('.poli-accordion-header');
        if (firstHeader) {
            toggleMobileAccordion(firstHeader);
        }
    } else {
        // Desktop: auto-select the first sidebar item
        const hasSearchQuery = {{ request()->hasAny(['nama','poli','hari']) ? 'true' : 'false' }};
        if (hasSearchQuery) {
            const reqPoli = "{{ request('poli') }}";
            if(reqPoli) {
                scrollToPoli('poli-section-' + reqPoli, document.getElementById('menu-poli-' + reqPoli));
            }
        } else {
            const firstMenu = document.querySelector('.jadwal-sidebar-menu a');
            if (firstMenu) {
                firstMenu.click();
            }
        }
    }
});

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
                tableHtml += `<th>${h}</th>`;
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

// Custom Dropdown for Hari
document.addEventListener('DOMContentLoaded', function() {
    const trigger = document.getElementById('hariDropdownTrigger');
    const wrapper = trigger ? trigger.closest('.jadwal-search-field') : null;
    const options = document.querySelectorAll('.custom-dropdown-option');
    const hiddenInput = document.getElementById('input-hari');
    
    if(trigger && wrapper) {
        trigger.addEventListener('click', function(e) {
            e.stopPropagation();
            wrapper.classList.toggle('open');
        });

        options.forEach(option => {
            option.addEventListener('click', function() {
                hiddenInput.value = this.getAttribute('data-value');
                document.getElementById('search-form').submit();
            });
        });

        document.addEventListener('click', function(e) {
            if (!wrapper.contains(e.target)) {
                wrapper.classList.remove('open');
            }
        });
    }
});
</script>

@endsection
