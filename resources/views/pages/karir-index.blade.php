@extends('layouts.app')
@section('title', 'Karir - Rekrutmen RS Hamori')

@push('styles')
<style>
.karir-hero {
    background: linear-gradient(135deg, #0d1b3e 0%, #0055a5 60%, #0077cc 100%);
    padding: 64px 0 48px;
    position: relative;
    overflow: hidden;
}
.karir-hero::before {
    content:''; position:absolute; width:500px; height:500px;
    background:rgba(255,255,255,0.04); border-radius:50%;
    top:-200px; right:-100px;
}
.karir-hero h1 {
    font-family:'Libre Baskerville',serif;
    font-size:clamp(1.8rem,4vw,2.8rem);
    font-weight:700; color:#fff; margin-bottom:12px;
}
.karir-hero p { color:rgba(255,255,255,0.75); font-size:16px; max-width:540px; }
.karir-hero-stats { display:flex; gap:32px; margin-top:32px; flex-wrap:wrap; }
.karir-stat-num { font-size:2rem; font-weight:800; color:#fff; line-height:1; }
.karir-stat-label { font-size:12px; color:rgba(255,255,255,0.65); margin-top:4px; }

/* Tabs */
.karir-tabs-wrap {
    background:#fff;
    border-bottom:1px solid #e5e7eb;
    position:sticky; top:70px; z-index:99;
    box-shadow:0 4px 12px rgba(0,0,0,0.06);
}
.karir-tabs { display:flex; overflow-x:auto; scrollbar-width:none; }
.karir-tabs::-webkit-scrollbar { display:none; }
.karir-tab {
    display:flex; align-items:center; gap:10px;
    padding:18px 24px; border:none; background:transparent;
    color:#6b7280; font-size:14px; font-weight:600;
    white-space:nowrap; cursor:pointer;
    border-bottom:3px solid transparent;
    transition:color .2s,border-color .2s,background .2s;
    text-decoration:none;
}
.karir-tab:hover { color:#0055a5; background:#f0f6ff; }
.karir-tab.active { color:#0055a5; border-bottom-color:#0055a5; background:#f0f6ff; }
.karir-tab-icon {
    width:32px; height:32px; border-radius:8px;
    display:flex; align-items:center; justify-content:center;
    font-size:15px; background:#f3f4f6; color:#6b7280;
    transition:background .2s,color .2s; flex-shrink:0;
}
.karir-tab.active .karir-tab-icon { background:#0055a5; color:#fff; }
.karir-tab-badge {
    background:#e5e7eb; color:#6b7280;
    font-size:11px; font-weight:700;
    padding:2px 8px; border-radius:100px;
    transition:background .2s,color .2s;
}
.karir-tab.active .karir-tab-badge { background:#0055a5; color:#fff; }

/* Per-category active colors */
.karir-tab[data-kat="Perawat"].active        { color:#0055a5; border-bottom-color:#0055a5; }
.karir-tab[data-kat="Perawat"].active .karir-tab-icon,
.karir-tab[data-kat="Perawat"].active .karir-tab-badge { background:#0055a5; color:#fff; }

.karir-tab[data-kat="Penunjang Medis"].active { color:#00a859; border-bottom-color:#00a859; }
.karir-tab[data-kat="Penunjang Medis"].active .karir-tab-icon,
.karir-tab[data-kat="Penunjang Medis"].active .karir-tab-badge { background:#00a859; color:#fff; }

.karir-tab[data-kat="Pelayanan Medis"].active { color:#6c3fc5; border-bottom-color:#6c3fc5; }
.karir-tab[data-kat="Pelayanan Medis"].active .karir-tab-icon,
.karir-tab[data-kat="Pelayanan Medis"].active .karir-tab-badge { background:#6c3fc5; color:#fff; }

.karir-tab[data-kat="Non Perawat"].active    { color:#e8333c; border-bottom-color:#e8333c; }
.karir-tab[data-kat="Non Perawat"].active .karir-tab-icon,
.karir-tab[data-kat="Non Perawat"].active .karir-tab-badge { background:#e8333c; color:#fff; }

/* Filter bar */
.karir-filter-bar { background:#f8fafc; border-bottom:1px solid #e5e7eb; padding:14px 0; }
.karir-filter-form { display:flex; gap:10px; align-items:center; flex-wrap:wrap; }
.karir-filter-form .form-control,
.karir-filter-form .form-select { font-size:13px; border-radius:10px; border-color:#e5e7eb; padding:8px 14px; }
.karir-filter-form .form-control { min-width:220px; flex:1; }

/* Kategori banner */
.karir-kat-banner {
    border-radius:16px; padding:22px 26px;
    display:flex; align-items:center; gap:18px;
    margin-bottom:28px; border:1px solid rgba(0,0,0,0.06);
}
.karir-kat-icon-lg {
    width:52px; height:52px; border-radius:14px;
    display:flex; align-items:center; justify-content:center;
    font-size:22px; color:#fff; flex-shrink:0;
}

/* Job cards */
.karir-card {
    background:#fff; border-radius:16px;
    box-shadow:0 2px 12px rgba(0,0,0,0.07);
    border:1px solid #f0f0f0;
    display:flex; flex-direction:column; height:100%;
    transition:transform .2s,box-shadow .2s,border-color .2s;
    overflow:hidden;
}
.karir-card:hover {
    transform:translateY(-4px);
    box-shadow:0 12px 32px rgba(0,0,0,0.12);
    border-color:#d0e4f7;
}
.karir-card-colorbar { height:4px; }
.karir-card-top { padding:18px 18px 0; display:flex; justify-content:space-between; align-items:flex-start; gap:8px; }
.karir-badges { display:flex; gap:6px; flex-wrap:wrap; }
.badge-tipe {
    font-size:10px; font-weight:700;
    padding:4px 10px; border-radius:100px;
    text-transform:uppercase; letter-spacing:0.5px;
}
.badge-tipe.full-time { background:#dbeafe; color:#1d4ed8; }
.badge-tipe.part-time { background:#dcfce7; color:#15803d; }
.badge-tipe.kontrak   { background:#fef9c3; color:#854d0e; }
.badge-tipe.magang    { background:#f3e8ff; color:#7e22ce; }
.badge-soon {
    font-size:10px; font-weight:700;
    padding:4px 10px; border-radius:100px;
    background:#fee2e2; color:#dc2626;
    animation:pulseBadge 1.5s ease infinite;
}
@keyframes pulseBadge { 0%,100%{opacity:1} 50%{opacity:.6} }
.karir-card-body { padding:12px 18px 0; flex:1; }
.karir-posisi { font-size:15px; font-weight:700; color:#1a1a2e; margin-bottom:5px; line-height:1.3; }
.karir-dept { color:#6b7280; font-size:12px; display:flex; align-items:center; gap:4px; margin-bottom:8px; }
.karir-desc { font-size:12px; color:#6b7280; line-height:1.6; margin-bottom:10px; }
.karir-meta { display:flex; flex-wrap:wrap; gap:8px; margin-bottom:10px; }
.karir-meta-item { font-size:11px; color:#6b7280; display:flex; align-items:center; gap:4px; }
.karir-dl {
    font-size:11px; font-weight:600; padding:5px 10px;
    border-radius:8px; display:inline-flex; align-items:center; gap:5px; margin-bottom:10px;
}
.karir-dl.soon   { background:#fee2e2; color:#dc2626; }
.karir-dl.normal { background:#f0f6ff; color:#0055a5; }
.karir-card-footer { padding:12px 18px 18px; display:flex; gap:8px; }
.btn-detail {
    flex:1; background:#0055a5; color:#fff; border:none;
    border-radius:10px; padding:10px 14px; font-size:13px; font-weight:700;
    text-decoration:none; display:flex; align-items:center; justify-content:center; gap:6px;
    transition:background .2s,transform .15s;
}
.btn-detail:hover { background:#003d7a; color:#fff; transform:translateY(-1px); }
.btn-lamar {
    background:#e8f0fa; color:#0055a5; border:none;
    border-radius:10px; padding:10px 13px; font-size:13px; font-weight:600;
    text-decoration:none; display:flex; align-items:center; gap:5px;
    transition:background .2s; white-space:nowrap;
}
.btn-lamar:hover { background:#0055a5; color:#fff; }

/* Empty */
.karir-empty {
    text-align:center; padding:60px 20px;
    background:#f8fafc; border-radius:16px; border:2px dashed #e5e7eb;
}
.karir-empty i { font-size:3.5rem; color:#d1d5db; margin-bottom:16px; display:block; }

/* Why join */
.why-join { background:#f8fafc; }
.why-card {
    background:#fff; border-radius:16px; padding:26px 22px; text-align:center;
    box-shadow:0 2px 12px rgba(0,0,0,0.06); height:100%;
    transition:transform .2s,box-shadow .2s;
}
.why-card:hover { transform:translateY(-4px); box-shadow:0 8px 28px rgba(0,0,0,0.1); }
.why-icon {
    width:56px; height:56px; border-radius:16px;
    display:flex; align-items:center; justify-content:center;
    font-size:24px; margin:0 auto 14px;
}

/* CTA card */
.open-app-card {
    background:linear-gradient(135deg,#0d1b3e,#0055a5);
    border-radius:20px; padding:40px 44px; color:#fff;
    position:relative; overflow:hidden;
}
.open-app-card::before {
    content:''; position:absolute;
    width:280px; height:280px; background:rgba(255,255,255,0.05);
    border-radius:50%; top:-80px; right:-60px;
}
</style>
@endpush

@section('content')

@php
    $tabMeta = [
        'Semua'           => ['icon'=>'bi-grid-3x3-gap', 'color'=>'#0055a5', 'bg'=>'#eff6ff'],
        'Perawat'         => ['icon'=>'bi-heart-pulse',  'color'=>'#0055a5', 'bg'=>'#eff6ff'],
        'Penunjang Medis' => ['icon'=>'bi-capsule',      'color'=>'#00a859', 'bg'=>'#f0fdf4'],
        'Pelayanan Medis' => ['icon'=>'bi-hospital',     'color'=>'#6c3fc5', 'bg'=>'#faf5ff'],
        'Non Perawat'     => ['icon'=>'bi-person-gear',  'color'=>'#e8333c', 'bg'=>'#fff1f2'],
    ];
    $katDescs = [
        'Perawat'         => 'Tenaga keperawatan profesional untuk asuhan langsung kepada pasien.',
        'Penunjang Medis' => 'Radiologi, laboratorium, farmasi, rehabilitasi medik, dan lainnya.',
        'Pelayanan Medis' => 'Dokter umum, dokter spesialis, dan tenaga medis klinis.',
        'Non Perawat'     => 'Administrasi, keuangan, SDM, IT, dan operasional rumah sakit.',
    ];
@endphp

{{-- HERO --}}
<div class="karir-hero">
    <div class="container" style="position:relative;z-index:2">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb" style="--bs-breadcrumb-divider-color:rgba(255,255,255,0.4)">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color:rgba(255,255,255,0.7)">Beranda</a></li>
                <li class="breadcrumb-item active" style="color:rgba(255,255,255,0.5)">Karir</li>
            </ol>
        </nav>
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1>Bergabung Bersama Tim RS Hamori</h1>
                <p>Kami mencari tenaga kesehatan yang berdedikasi dan profesional untuk bersama memberikan pelayanan terbaik kepada masyarakat.</p>
                <div class="karir-hero-stats">
                    @foreach(array_keys($tabMeta) as $k)
                        @if($k !== 'Semua')
                        <div>
                            <div class="karir-stat-num">{{ $counts[$k] ?? 0 }}</div>
                            <div class="karir-stat-label">{{ $k }}</div>
                        </div>
                        @endif
                    @endforeach
                    <div>
                        <div class="karir-stat-num">{{ $counts['Semua'] }}</div>
                        <div class="karir-stat-label">Total Lowongan</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- TABS --}}
<div class="karir-tabs-wrap">
    <div class="container px-0">
        <div class="karir-tabs">
            @foreach($tabMeta as $kat => $meta)
            <a href="{{ $kat === 'Semua' ? route('karir.index') : route('karir.index', ['kategori'=>$kat]) }}"
               class="karir-tab {{ $aktifKategori === $kat ? 'active' : '' }}"
               data-kat="{{ $kat }}">
                <div class="karir-tab-icon">
                    <i class="bi {{ $meta['icon'] }}"></i>
                </div>
                {{ $kat === 'Semua' ? 'Semua Lowongan' : $kat }}
                <span class="karir-tab-badge">{{ $counts[$kat] ?? 0 }}</span>
            </a>
            @endforeach
        </div>
    </div>
</div>

{{-- FILTER --}}
<div class="karir-filter-bar">
    <div class="container">
        <form method="GET" action="{{ route('karir.index') }}" class="karir-filter-form">
            @if($aktifKategori !== 'Semua')
            <input type="hidden" name="kategori" value="{{ $aktifKategori }}">
            @endif
            <input type="text" name="search" class="form-control"
                   placeholder="🔍  Cari posisi pekerjaan..."
                   value="{{ request('search') }}">
            <select name="tipe" class="form-select" style="max-width:170px">
                <option value="">Semua Tipe</option>
                @foreach(['full-time'=>'Full Time','part-time'=>'Part Time','kontrak'=>'Kontrak','magang'=>'Magang'] as $val=>$label)
                <option value="{{ $val }}" {{ request('tipe')===$val?'selected':'' }}>{{ $label }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary" style="border-radius:10px;font-size:13px;padding:8px 20px">
                <i class="bi bi-search me-1"></i> Cari
            </button>
            @if(request()->hasAny(['search','tipe']))
            <a href="{{ route('karir.index', $aktifKategori!=='Semua' ? ['kategori'=>$aktifKategori] : []) }}"
               class="btn btn-outline-secondary" style="border-radius:10px;font-size:13px;padding:8px 16px">
                <i class="bi bi-x"></i> Reset
            </a>
            @endif
        </form>
    </div>
</div>

{{-- CONTENT --}}
<section class="py-5">
    <div class="container">

        {{-- Kategori banner --}}
        @if($aktifKategori !== 'Semua')
        @php $km = $tabMeta[$aktifKategori] ?? $tabMeta['Semua']; @endphp
        <div class="karir-kat-banner" style="background:{{ $km['bg'] }}">
            <div class="karir-kat-icon-lg" style="background:{{ $km['color'] }}">
                <i class="bi {{ $km['icon'] }}"></i>
            </div>
            <div>
                <h5 class="fw-bold mb-1" style="color:{{ $km['color'] }}">{{ $aktifKategori }}</h5>
                <p class="mb-0 text-muted" style="font-size:13px">
                    {{ $katDescs[$aktifKategori] ?? '' }}
                    &nbsp;—&nbsp;<strong>{{ $karirs->total() }} lowongan tersedia</strong>
                </p>
            </div>
        </div>
        @endif

        @if($karirs->isEmpty())
        <div class="karir-empty">
            <i class="bi bi-briefcase"></i>
            <h5>Belum ada lowongan{{ $aktifKategori!=='Semua' ? ' untuk '.$aktifKategori : '' }} saat ini</h5>
            <p class="text-muted">Pantau terus halaman ini, atau kirim lamaran terbuka di bawah.</p>
            @if($aktifKategori !== 'Semua')
            <a href="{{ route('karir.index') }}" class="btn btn-outline-primary mt-3">Lihat Semua Lowongan</a>
            @endif
        </div>

        @else
        <div class="row g-4">
            @foreach($karirs as $karir)
            @php
                $km2 = $tabMeta[$karir->kategori] ?? $tabMeta['Semua'];
                $isDeadlineSoon = $karir->batas_lamaran && $karir->batas_lamaran->isFuture() && $karir->batas_lamaran->diffInDays(now()) <= 7;
            @endphp
            <div class="col-md-6 col-xl-4">
                <div class="karir-card">
                    <div class="karir-card-colorbar" style="background:{{ $km2['color'] }}"></div>
                    <div class="karir-card-top">
                        <div class="karir-badges">
                            <span class="badge-tipe {{ $karir->tipe }}">{{ ucfirst(str_replace('-',' ',$karir->tipe)) }}</span>
                            @if($isDeadlineSoon)<span class="badge-soon">⚡ Segera Tutup</span>@endif
                        </div>
                        <span style="font-size:11px;color:{{ $km2['color'] }};font-weight:600;white-space:nowrap">
                            <i class="bi {{ $km2['icon'] }} me-1"></i>{{ $karir->kategori }}
                        </span>
                    </div>
                    <div class="karir-card-body">
                        <h5 class="karir-posisi">{{ $karir->posisi }}</h5>
                        <p class="karir-dept">
                            <i class="bi bi-building"></i> {{ $karir->departemen }}
                            @if(!empty($karir->lokasi))&nbsp;·&nbsp;<i class="bi bi-geo-alt"></i> {{ $karir->lokasi }}@endif
                        </p>
                        <p class="karir-desc">{{ Str::limit(strip_tags($karir->deskripsi), 100) }}</p>
                        <div class="karir-meta">
                            @if(!empty($karir->kuota))
                            <span class="karir-meta-item"><i class="bi bi-people"></i> {{ $karir->kuota }} orang</span>
                            @endif
                            <span class="karir-meta-item"><i class="bi bi-briefcase"></i> {{ ucfirst(str_replace('-',' ',$karir->tipe)) }}</span>
                        </div>
                        @if($karir->batas_lamaran)
                        <div class="karir-dl {{ $isDeadlineSoon ? 'soon' : 'normal' }}">
                            <i class="bi bi-calendar-event"></i>
                            Deadline: {{ $karir->batas_lamaran->translatedFormat('d F Y') }}
                        </div>
                        @endif
                    </div>
                    <div class="karir-card-footer">
                        <a href="{{ route('karir.show', $karir->id) }}" class="btn-detail">
                            <i class="bi bi-eye"></i> Lihat Detail
                        </a>
                        <a href="{{ route('karir.show', $karir->id) }}#form-lamar" class="btn-lamar">
                            <i class="bi bi-send"></i> Lamar
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-5 d-flex justify-content-center">{{ $karirs->links() }}</div>
        @endif

    </div>
</section>

{{-- WHY JOIN --}}
<section class="why-join py-5">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-badge">Keuntungan</span>
            <h2 class="section-title">Mengapa Bergabung dengan RS Hamori?</h2>
        </div>
        <div class="row g-4">
            @foreach([
                ['bg'=>'#eff6ff','color'=>'#0055a5','icon'=>'bi-graph-up-arrow','title'=>'Karir Berkembang','desc'=>'Pengembangan karir terstruktur dan promosi yang transparan.'],
                ['bg'=>'#f0fdf4','color'=>'#00a859','icon'=>'bi-shield-check','title'=>'BPJS & Asuransi','desc'=>'Perlindungan kesehatan dan jiwa untuk karyawan dan keluarga.'],
                ['bg'=>'#faf5ff','color'=>'#6c3fc5','icon'=>'bi-mortarboard','title'=>'Pelatihan Kontinu','desc'=>'Akses pelatihan, seminar, dan sertifikasi profesi didukung RS.'],
                ['bg'=>'#fff1f2','color'=>'#e8333c','icon'=>'bi-emoji-smile','title'=>'Lingkungan Positif','desc'=>'Budaya kerja inklusif, kolaboratif, dan berorientasi kesejahteraan.'],
            ] as $w)
            <div class="col-sm-6 col-lg-3">
                <div class="why-card">
                    <div class="why-icon" style="background:{{ $w['bg'] }};color:{{ $w['color'] }}">
                        <i class="bi {{ $w['icon'] }}"></i>
                    </div>
                    <h6 class="fw-bold mb-2">{{ $w['title'] }}</h6>
                    <p class="text-muted" style="font-size:13px;margin:0">{{ $w['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- OPEN APPLICATION --}}
<section class="py-5">
    <div class="container">
        <div class="open-app-card">
            <div class="row align-items-center" style="position:relative;z-index:2">
                <div class="col-lg-8">
                    <h3 class="fw-bold mb-2">Tidak menemukan posisi yang sesuai?</h3>
                    <p class="opacity-75 mb-0">Kirim lamaran terbuka. Kami akan menghubungi saat ada posisi yang cocok dengan profil Anda.</p>
                </div>
                <div class="col-lg-4 mt-4 mt-lg-0 d-flex gap-3 flex-wrap justify-content-lg-end">
                    <a href="https://wa.me/628888905555?text=Halo%2C+saya+ingin+mengirim+lamaran+terbuka+ke+RS+Hamori"
                       target="_blank" class="btn btn-light btn-lg fw-bold d-inline-flex align-items-center gap-2">
                        <i class="bi bi-whatsapp text-success"></i> Via WhatsApp
                    </a>
                    <a href="mailto:hrd@rshamori.co.id"
                       class="btn btn-outline-light btn-lg fw-semibold d-inline-flex align-items-center gap-2">
                        <i class="bi bi-envelope"></i> Via Email
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
