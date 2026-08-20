@extends('layouts.app')
@section('title', 'Karir - Rekrutmen RS Hamori')

@push('styles')
<style>
/* --- Search Bar Styles (Copied from Jadwal Dokter) --- */
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
    border-color: #1ba99d;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(27,169,157,.1);
}
.jadwal-search-select {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='%23666' d='M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 14px center;
    background-size: 12px;
}
.jadwal-search-btn {
    background: #1ba99d;
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
    background: #138a80;
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
}
.jadwal-reset-btn:hover {
    background: #e2e8f0;
    color: #475569;
}
@media (max-width: 767.98px) {
    .jadwal-search-row { flex-direction: column; }
    .jadwal-search-field { flex: 1 1 100%; min-width: 100%; }
    .jadwal-search-btn, .jadwal-reset-btn { width: 100%; justify-content: center; }
}

/* Custom Dropdown */
.custom-dropdown-option {
    padding: 10px 15px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 500;
    color: #1a202c;
    cursor: pointer;
    transition: all 0.2s;
    margin-bottom: 2px;
    list-style: none;
}
.custom-dropdown-option:hover {
    background: #f1f5f9;
}
.custom-dropdown-option.active {
    background: #e8f8f7;
    color: #1ba99d;
    font-weight: 600;
}
.jadwal-search-field.open .custom-dropdown-options {
    opacity: 1 !important;
    visibility: visible !important;
    transform: translateY(0) !important;
}
.jadwal-search-field.open #tipeDropdownArrow {
    transform: rotate(180deg);
}

/* Custom Pagination to match Karir Card */
.karir-pagination .pagination {
    gap: 8px;
    flex-wrap: wrap;
}
.karir-pagination .page-item .page-link {
    border-radius: 12px !important;
    border: 1px solid #f0f0f0;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    color: #1ba99d;
    font-weight: 600;
    padding: 10px 16px;
    transition: all 0.2s;
    background: #fff;
    margin: 0;
}
.karir-pagination .page-item.active .page-link {
    background: #1ba99d;
    color: #fff;
    border-color: #1ba99d;
    box-shadow: 0 4px 12px rgba(27, 169, 157, 0.25);
}
.karir-pagination .page-item:not(.active) .page-link:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
    border-color: #a7e8e4;
    background: #e8f8f7;
}
.karir-pagination .page-item.disabled .page-link {
    color: #9ca3af;
    background: #f9fafb;
    box-shadow: none;
    pointer-events: none;
}

/* ===== Karir Tabs Redesign: Smooth Pill Slider ===== */
.karir-tabs-wrap {
    background: #fff;
    border-bottom: 1px solid #e5e7eb;
    position: sticky;
    top: 70px;
    z-index: 99;
    box-shadow: 0 4px 16px rgba(0,0,0,0.06);
}
.karir-tabs {
    position: relative;
    overflow: hidden;
}
.karir-tabs-inner {
    display: flex;
    overflow-x: auto;
    scrollbar-width: none;
    -ms-overflow-style: none;
    scroll-behavior: smooth;
    padding-bottom: 0;
}
.karir-tabs-inner::-webkit-scrollbar { display: none; }

.karir-tab {
    display: flex;
    align-items: center;
    gap: 9px;
    padding: 16px 22px;
    border: none;
    background: transparent;
    color: #6b7280;
    font-size: 14px;
    font-weight: 600;
    white-space: nowrap;
    cursor: pointer;
    text-decoration: none;
    position: relative;
    transition: color 0.25s ease, background 0.25s ease;
    flex-shrink: 0;
}
.karir-tab:hover {
    color: #1e293b;
    background: rgba(0,0,0,0.025);
}
.karir-tab.active {
    color: var(--tab-color, #1ba99d);
}
.karir-tab-icon {
    width: 30px;
    height: 30px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    transition: background 0.25s ease, color 0.25s ease, transform 0.2s ease;
    flex-shrink: 0;
    background: #f3f4f6;
    color: #6b7280;
}
.karir-tab:hover .karir-tab-icon {
    transform: scale(1.08);
}
.karir-tab-label {
    transition: color 0.25s;
}
.karir-tab-badge {
    background: #e5e7eb;
    color: #6b7280;
    font-size: 10.5px;
    font-weight: 700;
    padding: 2px 7px;
    border-radius: 100px;
    transition: background 0.25s ease, color 0.25s ease;
}

/* Sliding indicator bar */
.karir-tab-indicator {
    position: absolute;
    bottom: 0;
    left: 0;
    height: 3px;
    border-radius: 3px 3px 0 0;
    background: #1ba99d;
    transition: left 0.35s cubic-bezier(0.4, 0, 0.2, 1),
                width 0.35s cubic-bezier(0.4, 0, 0.2, 1),
                background 0.3s ease;
    pointer-events: none;
}
</style>
@endpush

@push('scripts')
<script>
(function() {
    function initKarirTabs() {
        const inner = document.getElementById('karirTabsInner');
        const indicator = document.getElementById('tabIndicator');
        if (!inner || !indicator) return;

        const activeTab = inner.querySelector('.karir-tab.active');

        function moveIndicator(tab) {
            const color = tab.dataset.color || '#1ba99d';
            const innerRect = inner.getBoundingClientRect();
            const tabRect = tab.getBoundingClientRect();
            indicator.style.left  = (tabRect.left - innerRect.left + inner.scrollLeft) + 'px';
            indicator.style.width = tabRect.width + 'px';
            indicator.style.background = color;
        }

        // Position indicator on active tab immediately (no transition on load)
        if (activeTab) {
            indicator.style.transition = 'none';
            moveIndicator(activeTab);
            // Scroll active tab into view smoothly
            activeTab.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
            // Re-enable transition after initial position
            requestAnimationFrame(() => {
                requestAnimationFrame(() => {
                    indicator.style.transition = '';
                });
            });
        }

        // Hover preview
        inner.querySelectorAll('.karir-tab').forEach(tab => {
            tab.addEventListener('mouseenter', function() {
                if (!this.classList.contains('active')) {
                    moveIndicator(this);
                    indicator.style.opacity = '0.4';
                }
            });
            tab.addEventListener('mouseleave', function() {
                indicator.style.opacity = '1';
                if (activeTab) moveIndicator(activeTab);
                else { indicator.style.width = '0'; }
            });
            tab.addEventListener('click', function(e) {
                // Animate before navigation
                moveIndicator(this);
                indicator.style.opacity = '1';
            });
        });

        // Reposition on scroll (inner scrolls horizontally)
        inner.addEventListener('scroll', function() {
            const current = inner.querySelector('.karir-tab.active') || activeTab;
            if (current) {
                indicator.style.transition = 'none';
                moveIndicator(current);
                requestAnimationFrame(() => { indicator.style.transition = ''; });
            }
        });

        // Reposition on window resize
        window.addEventListener('resize', function() {
            const current = inner.querySelector('.karir-tab.active') || activeTab;
            if (current) moveIndicator(current);
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initKarirTabs);
    } else {
        initKarirTabs();
    }
})();
</script>
@endpush

@section('content')

@php
    $tabMeta = ['Semua' => ['icon'=>'bi-grid', 'color'=>'#0f172a', 'bg'=>'#f1f5f9']];
    foreach($kategoris as $k) {
        $tabMeta[$k->nama] = ['icon'=>$k->icon, 'color'=>$k->warna, 'bg'=>$k->warna_bg];
    }
@endphp

<div class="page-header">
    <div class="container">
        <h1 class="page-title">Bergabung Bersama Tim RS Hamori</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Karir</li>
            </ol>
        </nav>
    </div>
</div>

<div class="karir-tabs-wrap">
    <div class="container px-0">
        <div class="karir-tabs" id="karirTabsScroll">
            <div class="karir-tabs-inner" id="karirTabsInner">
                @foreach($tabMeta as $kat => $meta)
                @php
                    $isActive = $aktifKategori === $kat;
                    $color = $meta['color'];
                    $bg    = $meta['bg'];
                @endphp
                <a href="{{ $kat === 'Semua' ? route('karir.index') : route('karir.index', ['kategori'=>$kat]) }}"
                   class="karir-tab {{ $isActive ? 'active' : '' }}"
                   data-kat="{{ $kat }}"
                   data-color="{{ $color }}"
                   data-bg="{{ $bg }}"
                   style="
                       {{ $isActive ? '--tab-color:'.$color.';--tab-bg:'.$bg.';' : '' }}
                   ">
                    <div class="karir-tab-icon" style="{{ $isActive ? 'background:'.$color.';color:#fff;' : 'background:'.$bg.';color:'.$color.';' }}">
                        <i class="bi {{ $meta['icon'] }}"></i>
                    </div>
                    <span class="karir-tab-label">{{ $kat === 'Semua' ? 'Semua' : $kat }}</span>
                    <span class="karir-tab-badge" style="{{ $isActive ? 'background:'.$color.';color:#fff;' : '' }}">{{ $counts[$kat] ?? 0 }}</span>
                </a>
                @endforeach
            </div>
            {{-- Smooth sliding underline indicator --}}
            <div class="karir-tab-indicator" id="tabIndicator"></div>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="jadwal-search-wrap">
        <form method="GET" action="{{ route('karir.index') }}" class="karir-search-form">
            @if($aktifKategori !== 'Semua')
            <input type="hidden" name="kategori" value="{{ $aktifKategori }}">
            @endif
            <div class="jadwal-search-row">
                <div class="jadwal-search-field">
                    <i class="bi bi-search jadwal-search-icon"></i>
                    <input type="text" name="search" class="jadwal-search-input"
                           placeholder="Cari posisi pekerjaan..."
                           value="{{ request('search') }}">
                </div>
                <div class="jadwal-search-field" style="position: relative; max-width: 200px;">
                    <i class="bi bi-briefcase jadwal-search-icon"></i>
                    <input type="hidden" name="tipe" id="input-tipe" value="{{ request('tipe') }}">
                    <div class="jadwal-search-input jadwal-search-select custom-dropdown-trigger" id="tipeDropdownTrigger"
                         style="display:flex; justify-content:space-between; align-items:center; cursor:pointer; user-select:none; padding-left:40px;">
                        <span id="tipeDropdownLabel">
                            @php
                                $tipeLabels = [];
                                foreach($tipes as $t) {
                                    $tipeLabels[$t->slug] = $t->nama;
                                }
                            @endphp
                            {{ $tipeLabels[request('tipe')] ?? 'Semua Tipe' }}
                        </span>
                        <i class="bi bi-chevron-down ms-2" id="tipeDropdownArrow" style="transition:transform 0.2s; color:#94a3b8; font-size:14px;"></i>
                    </div>
                    <ul class="custom-dropdown-options" id="tipeDropdownOptions"
                        style="position:absolute; top:calc(100% + 5px); left:0; width:100%; background:#fff; border-radius:12px; box-shadow:0 10px 25px rgba(0,0,0,0.08); border:1px solid #e2e8f0; padding:6px; margin:0; z-index:100; opacity:0; visibility:hidden; transform:translateY(-10px); transition:all 0.2s ease;">
                        <li class="custom-dropdown-option {{ request('tipe') == '' ? 'active' : '' }}" data-value="">Semua Tipe</li>
                        @foreach($tipes as $t)
                        <li class="custom-dropdown-option {{ request('tipe') == $t->slug ? 'active' : '' }}" data-value="{{ $t->slug }}">{{ $t->nama }}</li>
                        @endforeach
                    </ul>
                </div>
                <button type="submit" class="jadwal-search-btn">
                    <i class="bi bi-search me-1"></i> Cari
                </button>
                @if(request()->hasAny(['search','tipe']))
                <a href="{{ route('karir.index', $aktifKategori!=='Semua' ? ['kategori'=>$aktifKategori] : []) }}"
                   class="jadwal-reset-btn">
                    <i class="bi bi-x-circle"></i> Reset
                </a>
                @endif
            </div>
        </form>
    </div>
</div>

<section class="py-5">
    <div class="container">

        @if($aktifKategori !== 'Semua')
        @php $km = $tabMeta[$aktifKategori] ?? $tabMeta['Semua']; @endphp
        <div class="karir-kat-banner" style="background:{{ $km['bg'] }}">
            <div class="karir-kat-icon-lg" style="background:{{ $km['color'] }}">
                <i class="bi {{ $km['icon'] }}"></i>
            </div>
            <div>
                <h5 class="fw-bold mb-1" style="color:{{ $km['color'] }}">{{ $aktifKategori }}</h5>
                <p class="mb-0 text-muted" style="font-size:13px">
                    <strong>{{ $karirs->total() }} lowongan tersedia</strong>
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
                            @php
                                $tipeObj = $tipes->where('slug', $karir->tipe)->first();
                                $tc = $tipeObj->warna ?? '#1ba99d';
                                $tn = $tipeObj->nama ?? ucfirst(str_replace('-',' ',$karir->tipe));
                            @endphp
                            <span class="badge-tipe" style="color: {{ $tc }}; background: {{ $tc }}15; border-color: {{ $tc }}33;">{{ $tn }}</span>
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
        <div class="mt-5 d-flex justify-content-center karir-pagination">{{ $karirs->links() }}</div>
        @endif

    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const trigger = document.getElementById('tipeDropdownTrigger');
    const wrapper = trigger ? trigger.closest('.jadwal-search-field') : null;
    const options = document.querySelectorAll('#tipeDropdownOptions .custom-dropdown-option');
    const hiddenInput = document.getElementById('input-tipe');
    const form = trigger ? trigger.closest('form') : null;

    if (trigger && wrapper) {
        trigger.addEventListener('click', function(e) {
            e.stopPropagation();
            wrapper.classList.toggle('open');
        });

        options.forEach(option => {
            option.addEventListener('click', function() {
                hiddenInput.value = this.getAttribute('data-value');
                if (form) form.submit();
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
@endpush

@endsection
