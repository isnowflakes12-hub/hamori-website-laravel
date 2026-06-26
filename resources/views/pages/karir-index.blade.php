@extends('layouts.app')
@section('title', 'Karir - Rekrutmen RS Hamori')

@push('styles')

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
                    <a href="https://wa.me/{{ \App\Models\SiteSetting::get('phone_whatsapp', '6281111121705') }}?text=Halo%2C+saya+ingin+mengirim+lamaran+terbuka+ke+RS+Hamori"
                       target="_blank" class="btn btn-light btn-lg fw-bold d-inline-flex align-items-center gap-2">
                        <i class="bi bi-whatsapp text-success"></i> Chat via WhatsApp
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

