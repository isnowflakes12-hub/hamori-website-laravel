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

        {{-- DAFTAR POLI ACCORDION --}}
        <div class="poli-list" id="poli-list">
            @foreach($polis as $index => $poli)
            @if($poli->dokters->count() > 0)
            @php
                $isOpenByDefault = request()->hasAny(['nama','hari']) || (request('poli') == $poli->id);
            @endphp
            <div class="poli-accordion {{ $isOpenByDefault ? 'is-open' : '' }}" id="poli-{{ $poli->id }}">
                {{-- POLI HEADER --}}
                <button class="poli-header" type="button" onclick="togglePoli(this)">
                    <div class="poli-header-left">
                        <div class="poli-icon">
                            <i class="bi bi-hospital-fill"></i>
                        </div>
                        <div>
                            <div class="poli-nama">{{ $poli->nama }}</div>
                            <div class="poli-count">{{ $poli->dokters->count() }} Dokter</div>
                        </div>
                    </div>
                    <div class="poli-header-right">
                        <span class="poli-badge">{{ $poli->dokters->count() }}</span>
                        <div class="poli-chevron"><i class="bi bi-chevron-down"></i></div>
                    </div>
                </button>

                {{-- DAFTAR DOKTER --}}
                <div class="poli-body">
                    <div class="dokter-grid">
                        @foreach($poli->dokters as $dokter)
                        <div class="dokter-card-v2">
                            <div class="dokter-card-photo">
                                @if($dokter->foto)
                                <img src="{{ asset('storage/' . $dokter->foto) }}" alt="{{ $dokter->nama }}" loading="lazy">
                                @else
                                <div class="dokter-photo-placeholder-v2">
                                    <i class="bi bi-person-fill"></i>
                                </div>
                                @endif
                            </div>
                            <div class="dokter-card-body">
                                <h5 class="dokter-card-nama">{{ $dokter->nama_lengkap }}</h5>
                                <p class="dokter-card-spesialis">{{ $poli->nama }}</p>

                                @if($dokter->jadwal->count())
                                <div class="dokter-schedule-wrap">
                                    <div class="dokter-schedule-label"><i class="bi bi-clock me-1"></i>Jadwal Praktek</div>
                                    @foreach($dokter->jadwal->sortBy(fn($j) => ['Senin'=>1,'Selasa'=>2,'Rabu'=>3,'Kamis'=>4,'Jumat'=>5,'Sabtu'=>6,'Minggu'=>7][$j->hari] ?? 8) as $jadwal)
                                    <div class="dokter-schedule-row">
                                        <span class="dokter-schedule-hari">{{ $jadwal->hari }}</span>
                                        <span class="dokter-schedule-jam">{{ substr($jadwal->jam_mulai,0,5) }} – {{ substr($jadwal->jam_selesai,0,5) }}</span>
                                    </div>
                                    @endforeach
                                </div>
                                @else
                                <div class="dokter-no-schedule"><i class="bi bi-info-circle me-1"></i>Jadwal belum tersedia</div>
                                @endif

                                <a href="https://wa.me/{{ \App\Models\SiteSetting::get('phone_whatsapp', '6281111121705') }}" target="_blank" class="dokter-wa-btn">
                                    <i class="bi bi-whatsapp me-2"></i>Buat Janji
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
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
   POLI ACCORDION
────────────────────────────────────────────────── */
.poli-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.poli-accordion {
    background: #fff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 2px 12px rgba(0,0,0,.05);
    border: 1.5px solid #eef1f6;
    transition: box-shadow .25s;
}

.poli-accordion.is-open {
    box-shadow: 0 6px 28px rgba(13,110,253,.1);
    border-color: rgba(13,110,253,.2);
}

/* Header Poli */
.poli-header {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 18px 24px;
    background: none;
    border: none;
    cursor: pointer;
    text-align: left;
    transition: background .2s;
}

.poli-header:hover {
    background: #f7f9fc;
}

.is-open .poli-header {
    background: linear-gradient(135deg, rgba(13,110,253,.06), rgba(13,110,253,.02));
    border-bottom: 1px solid #eef1f6;
}

.poli-header-left {
    display: flex;
    align-items: center;
    gap: 16px;
}

.poli-icon {
    width: 46px;
    height: 46px;
    border-radius: 12px;
    background: linear-gradient(135deg, var(--primary, #0d6efd), #4a90e2);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    flex-shrink: 0;
}

.is-open .poli-icon {
    background: linear-gradient(135deg, #0a58ca, var(--primary, #0d6efd));
}

.poli-nama {
    font-size: 15px;
    font-weight: 700;
    color: #1a202c;
    line-height: 1.3;
}

.poli-count {
    font-size: 12px;
    color: #9ba5b4;
    margin-top: 2px;
}

.poli-header-right {
    display: flex;
    align-items: center;
    gap: 12px;
    flex-shrink: 0;
}

.poli-badge {
    background: #e7f0ff;
    color: var(--primary, #0d6efd);
    font-size: 12px;
    font-weight: 700;
    padding: 3px 10px;
    border-radius: 20px;
    min-width: 32px;
    text-align: center;
}

.poli-chevron {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #f0f0f0;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: transform .3s, background .2s;
    font-size: 14px;
    color: #6c757d;
}

.is-open .poli-chevron {
    transform: rotate(180deg);
    background: var(--primary, #0d6efd);
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
   DOKTER CARD V2
────────────────────────────────────────────────── */
.dokter-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
    gap: 16px;
}

.dokter-card-v2 {
    background: #f7f9fc;
    border-radius: 14px;
    overflow: hidden;
    border: 1.5px solid #eef1f6;
    transition: transform .25s, box-shadow .25s, border-color .25s;
    display: flex;
    flex-direction: column;
}

.dokter-card-v2:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 32px rgba(0,0,0,.1);
    border-color: rgba(13,110,253,.25);
}

.dokter-card-photo {
    width: 100%;
    aspect-ratio: 3/4;
    overflow: hidden;
    background: #e4e9f0;
    max-height: 220px;
}

.dokter-card-photo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: top center;
    transition: transform .4s;
}

.dokter-card-v2:hover .dokter-card-photo img {
    transform: scale(1.05);
}

.dokter-photo-placeholder-v2 {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 56px;
    color: #9ba5b4;
    background: linear-gradient(135deg, #eef1f6, #e4e9f0);
}

.dokter-card-body {
    padding: 16px;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.dokter-card-nama {
    font-size: 14px;
    font-weight: 700;
    color: #1a202c;
    margin-bottom: 4px;
    line-height: 1.35;
}

.dokter-card-spesialis {
    font-size: 11px;
    color: var(--primary, #0d6efd);
    font-weight: 600;
    letter-spacing: .3px;
    margin-bottom: 12px;
    text-transform: uppercase;
}

.dokter-schedule-wrap {
    background: #fff;
    border-radius: 10px;
    padding: 10px 12px;
    margin-bottom: 12px;
    border: 1px solid #eef1f6;
    flex: 1;
}

.dokter-schedule-label {
    font-size: 11px;
    font-weight: 700;
    color: #9ba5b4;
    text-transform: uppercase;
    letter-spacing: .8px;
    margin-bottom: 8px;
}

.dokter-schedule-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 4px 0;
    border-bottom: 1px dashed #f0f0f0;
    font-size: 12px;
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

.dokter-no-schedule {
    font-size: 12px;
    color: #9ba5b4;
    background: #f7f9fc;
    border-radius: 8px;
    padding: 10px;
    text-align: center;
    margin-bottom: 12px;
    flex: 1;
}

.dokter-wa-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    background: #25D366;
    color: #fff;
    border-radius: 10px;
    padding: 10px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    transition: background .2s, transform .15s;
    margin-top: auto;
}

.dokter-wa-btn:hover {
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
function togglePoli(btn) {
    const accordion = btn.closest('.poli-accordion');
    const isOpen = accordion.classList.contains('is-open');
    accordion.classList.toggle('is-open', !isOpen);
}

// Auto-open the first poli if no search filters active
document.addEventListener('DOMContentLoaded', function() {
    const hasFilter = {{ request()->hasAny(['nama','poli','hari']) ? 'true' : 'false' }};
    if (!hasFilter) {
        const first = document.querySelector('.poli-accordion');
        if (first) first.classList.add('is-open');
    }
});
</script>

@endsection
