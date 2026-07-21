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

        {{-- GRID POLIKLINIK --}}
        <div class="poli-grid mb-5">
            @foreach($polis as $index => $poli)
            @if($poli->dokters->count() > 0)
            <div class="poli-card" onclick="showPoliDoctors('poli-{{ $poli->id }}', this)">
                <div class="poli-card-icon"><i class="bi bi-hospital-fill"></i></div>
                <div class="poli-card-name">{{ $poli->nama }}</div>
                <div class="poli-card-count">{{ $poli->dokters->count() }} Dokter</div>
            </div>
            @endif
            @endforeach
        </div>

        {{-- DAFTAR DOKTER PER POLI --}}
        <div class="doctors-container" id="doctors-container">
            @foreach($polis as $index => $poli)
            @if($poli->dokters->count() > 0)
            <div class="poli-group" id="poli-{{ $poli->id }}" style="display: none;">
                <div class="d-flex align-items-center mb-4">
                    <h3 class="mb-0 text-primary fw-bold"><i class="bi bi-hospital-fill me-2"></i>{{ $poli->nama }}</h3>
                    <span class="badge bg-primary ms-3 rounded-pill px-3">{{ $poli->dokters->count() }} Dokter</span>
                </div>
                
                <div class="dokter-list">
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
                    @endphp
                    <div class="dokter-list-row compact">
                        {{-- Kiri: foto + info --}}
                        <div class="dokter-list-left">
                            <div class="dokter-list-photo">
                                @if($dokter->foto)
                                <img src="{{ asset('storage/' . $dokter->foto) }}" alt="{{ $dokter->nama }}" loading="lazy">
                                @else
                                <div class="dokter-list-photo-placeholder"><i class="bi bi-person-fill"></i></div>
                                @endif
                            </div>
                            <div class="dokter-list-info">
                                <div class="dokter-list-nama">{{ $dokter->nama_lengkap }}</div>
                                <div class="dokter-list-spesialis">{{ strtoupper($poli->nama) }}</div>
                            </div>
                        </div>

                        {{-- Kanan: tombol aksi --}}
                        <div class="dokter-list-actions">
                            <button type="button" class="btn-lihat-jadwal" onclick="toggleJadwal('jadwal-{{ $dokter->id }}', this)">
                                Lihat Jadwal <i class="bi bi-chevron-down ms-1 transition-transform"></i>
                            </button>
                            <a href="{{ route('dokter.show', $dokter->id) }}" class="btn-lihat-profil">Lihat profil</a>
                            <a href="https://wa.me/{{ $waNumber }}?text={{ urlencode('Halo, saya ingin buat janji dengan '.$dokter->nama_lengkap.' di '.request()->root()) }}" target="_blank" class="btn-buat-janji">Buat janji</a>
                        </div>
                        
                        {{-- Bawah: tabel jadwal (hidden by default) --}}
                        <div class="dokter-list-jadwal" id="jadwal-{{ $dokter->id }}" style="display: none;">
                            <hr class="my-3 border-light">
                            @php
                                $hariOrder = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'];
                                $jadwalPerHari = [];
                                foreach($hariOrder as $h) { $jadwalPerHari[$h] = []; }
                                foreach($jadwalSorted as $j) {
                                    $jadwalPerHari[$j->hari][] = substr($j->jam_mulai,0,5).' – '.substr($j->jam_selesai,0,5);
                                }
                                $maxRows = max(1, max(array_map('count', $jadwalPerHari)));
                            @endphp
                            @if($jadwalSorted->count() > 0)
                            <table class="jadwal-week-table">
                                <thead>
                                    <tr>
                                        @foreach($hariOrder as $h)
                                        <th>{{ strtoupper(substr($h,0,3)) }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @for($row = 0; $row < $maxRows; $row++)
                                    <tr>
                                        @foreach($hariOrder as $h)
                                        <td>{{ $jadwalPerHari[$h][$row] ?? '-' }}</td>
                                        @endforeach
                                    </tr>
                                    @endfor
                                </tbody>
                            </table>
                            @else
                            <div class="text-center text-muted py-3">Jadwal belum tersedia</div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
            @endforeach
        </div>

        @endif
    </div>
</section>



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
   GRID POLIKLINIK
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
    padding: 20px 16px;
    text-align: center;
    cursor: pointer;
    transition: all 0.2s;
    box-shadow: 0 2px 8px rgba(0,0,0,0.02);
}

.poli-card:hover, .poli-card.active {
    background: #f8fbff;
    border-color: rgba(13,110,253,0.3);
    transform: translateY(-2px);
    box-shadow: 0 8px 16px rgba(13,110,253,0.08);
}

.poli-card-icon {
    width: 48px;
    height: 48px;
    margin: 0 auto 12px;
    border-radius: 12px;
    background: linear-gradient(135deg, var(--primary, #0d6efd), #4a90e2);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    transition: transform 0.2s;
}

.poli-card:hover .poli-card-icon {
    transform: scale(1.05);
}

.poli-card-name {
    font-size: 15px;
    font-weight: 700;
    color: #1a202c;
    color: #fff;
}

/* Body Poli */
.poli-body {
    display: none;
    padding: 24px;
    animation: fadeSlideDown .25s ease;
}

.is-open .poli-body {
    display: block;
}

@keyframes fadeSlideDown {
    from { opacity: 0; transform: translateY(-8px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ──────────────────────────────────────────────────
   DOKTER LIST V3 (Horizontal Layout)
────────────────────────────────────────────────── */
.dokter-list {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.dokter-list-row {
    background: #fff;
    border: 1px solid #eef1f6;
    border-radius: 12px;
    padding: 24px;
    display: flex;
    flex-direction: column;
    gap: 20px;
    transition: box-shadow 0.2s, border-color 0.2s;
}

.dokter-list-row:hover {
    box-shadow: 0 8px 24px rgba(0,0,0,0.04);
    border-color: rgba(13,110,253,0.15);
}

@media (min-width: 992px) {
    .dokter-list-row {
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
    }
}

/* Kiri: Foto & Info */
.dokter-list-left {
    display: flex;
    align-items: center;
    gap: 20px;
    flex: 1;
}

.dokter-list-photo {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    overflow: hidden;
    background: #e4e9f0;
    flex-shrink: 0;
    position: relative;
    border: 3px solid #fff;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}

.dokter-list-photo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: top center;
}

.dokter-list-photo-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 32px;
    color: #9ba5b4;
    background: linear-gradient(135deg, #eef1f6, #e4e9f0);
}

.dokter-list-info {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.dokter-list-nama {
    font-size: 16px;
    font-weight: 700;
    color: #1a202c;
    line-height: 1.3;
}

.dokter-list-spesialis {
    font-size: 12px;
    color: #6c757d;
    font-weight: 600;
    letter-spacing: 0.5px;
}

/* Kanan: Actions */
.dokter-list-actions {
    display: flex;
    align-items: center;
    gap: 12px;
    flex-shrink: 0;
}

.btn-lihat-profil {
    background: #fff;
    color: var(--primary, #0d6efd);
    border: 1px solid var(--primary, #0d6efd);
    padding: 8px 16px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s;
}

.btn-lihat-profil:hover {
    background: #f8fbff;
    color: #0a58ca;
}

.btn-buat-janji {
    background: #a91e41; /* Warna merah Hamori sesuai gambar */
    color: #fff;
    border: none;
    padding: 8px 20px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    transition: background 0.2s;
}

.btn-buat-janji:hover {
    background: #8b1835;
    color: #fff;
}

/* Tengah: Tabel Jadwal */
.dokter-list-jadwal {
    width: 100%;
    margin-top: 16px;
    overflow-x: auto;
}

@media (min-width: 992px) {
    .dokter-list-jadwal {
        width: 100%;
        margin-top: 24px;
        order: 3;
    }
    .dokter-list-row {
        flex-wrap: wrap;
    }
}

.jadwal-week-table {
    width: 100%;
    min-width: 600px;
    border-collapse: collapse;
    background: #fff;
}

.jadwal-week-table th {
    background: #f8fbff;
    color: #1a202c;
    font-size: 11px;
    font-weight: 700;
    text-align: center;
    padding: 10px 8px;
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
function showPoliDoctors(poliId, cardEl) {
    // 1. Reset semua active card
    document.querySelectorAll('.poli-card').forEach(c => c.classList.remove('active'));
    if(cardEl) {
        cardEl.classList.add('active');
    }

    // 2. Sembunyikan semua grup dokter
    document.querySelectorAll('.poli-group').forEach(g => {
        g.style.display = 'none';
    });

    // 3. Tampilkan grup dokter yang dipilih
    const selectedGroup = document.getElementById(poliId);
    if(selectedGroup) {
        selectedGroup.style.display = 'block';
        // Optional: Scroll otomatis ke list dokter
        selectedGroup.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
}

function toggleJadwal(jadwalId, btn) {
    const jadwalEl = document.getElementById(jadwalId);
    const chevron = btn.querySelector('.bi-chevron-down');
    
    if (jadwalEl.style.display === 'none') {
        // Tampilkan
        jadwalEl.style.display = 'block';
        if (chevron) chevron.style.transform = 'rotate(180deg)';
        btn.classList.add('bg-light');
    } else {
        // Sembunyikan
        jadwalEl.style.display = 'none';
        if (chevron) chevron.style.transform = 'rotate(0deg)';
        btn.classList.remove('bg-light');
    }
}

// Auto-open the first poli if no search filters active
document.addEventListener('DOMContentLoaded', function() {
    // Check if we have active filter, if not just click the first card
    const hasFilter = {{ request()->hasAny(['nama','poli','hari']) ? 'true' : 'false' }};
    if (!hasFilter) {
        const firstCard = document.querySelector('.poli-card');
        if (firstCard) {
            firstCard.click();
        }
    } else {
        // If there's a filter, show ALL matched doctors by displaying all non-empty poli-groups
        document.querySelectorAll('.poli-group').forEach(g => {
            g.style.display = 'block';
        });
        // Sembunyikan grid poli karena sedang mode search
        const poliGrid = document.querySelector('.poli-grid');
        if (poliGrid) poliGrid.style.display = 'none';
    }
});
</script>

@endsection
