@extends('admin.layouts.app')
@section('title','Lamaran Masuk')
@section('page-title','Lamaran Masuk')
@section('content')
<div class="page-hd">
    <div><h1 class="page-hd-title">Lamaran Masuk</h1><p class="page-hd-sub">Kelola dan tracking status pelamar</p></div>
</div>
<div class="filter-bar mb-4">
    <form method="GET" class="d-flex gap-2 align-items-center w-100" style="flex-wrap:nowrap;">
        <input type="text" name="search" class="form-control" style="flex:1 1 0; min-width:0;" placeholder="Nama pelamar..." value="{{ request('search') }}">
        
        @php
            $reqKarirId = request('karir_id');
            $posisiLabel = 'Semua Posisi';
            if ($reqKarirId) {
                $selKarir = collect($karirs)->firstWhere('id', $reqKarirId);
                if ($selKarir) $posisiLabel = $selKarir->posisi;
            }
        @endphp
        <div class="custom-dropdown-wrapper flex-shrink-0" style="width:200px">
            <input type="hidden" name="karir_id" value="{{ $reqKarirId }}">
            <div class="custom-dropdown-trigger">
                <span class="custom-dropdown-label">{{ $posisiLabel }}</span>
                <i class="bi bi-chevron-down custom-dropdown-arrow"></i>
            </div>
            <ul class="custom-dropdown-options-container">
                <li class="custom-dropdown-option {{ $reqKarirId == '' ? 'active' : '' }}" data-value="">Semua Posisi</li>
                @foreach($karirs as $k)
                <li class="custom-dropdown-option {{ $reqKarirId == $k->id ? 'active' : '' }}" data-value="{{ $k->id }}">{{ $k->posisi }}</li>
                @endforeach
            </ul>
        </div>
        
        @php
            $reqStatus = request('status');
            $statusOptions = ['pending'=>'Menunggu','review'=>'Review','shortlist'=>'Shortlist','interview'=>'Interview','diterima'=>'Diterima','ditolak'=>'Ditolak'];
            $statLabel = 'Semua Status';
            if ($reqStatus && isset($statusOptions[$reqStatus])) {
                $statLabel = $statusOptions[$reqStatus];
            }
        @endphp
        <div class="custom-dropdown-wrapper flex-shrink-0" style="width:160px">
            <input type="hidden" name="status" value="{{ $reqStatus }}">
            <div class="custom-dropdown-trigger">
                <span class="custom-dropdown-label">{{ $statLabel }}</span>
                <i class="bi bi-chevron-down custom-dropdown-arrow"></i>
            </div>
            <ul class="custom-dropdown-options-container">
                <li class="custom-dropdown-option {{ $reqStatus == '' ? 'active' : '' }}" data-value="">Semua Status</li>
                @foreach($statusOptions as $v => $l)
                <li class="custom-dropdown-option {{ $reqStatus == $v ? 'active' : '' }}" data-value="{{ $v }}">{{ $l }}</li>
                @endforeach
            </ul>
        </div>
        
        <button class="btn btn-primary flex-shrink-0" type="submit">Filter</button>
        @if(request()->hasAny(['search','karir_id','status']))<a href="{{ route('admin.lamaran.index') }}" class="btn btn-outline-secondary flex-shrink-0">Reset</a>@endif
</div>
@if(isset($kategoriList))
<div class="admin-table">
    <table class="table">
        <thead>
            <tr>
                <th>Kategori Pekerjaan</th>
                <th class="text-center">Total Posisi Buka</th>
                <th class="text-center">Total Pelamar</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
        @forelse($kategoriList as $k)
        @php
            $meta = $kategoriMeta[$k->kategori] ?? null;
            $warna = $meta ? $meta->warna : '#0055a5';
            $warna_bg = $meta ? $meta->warna_bg : '#e0f2fe';
            $icon = $meta ? $meta->icon : 'bi-tags';
        @endphp
        <tr>
            <td class="fw-bold" style="color: #0f172a;">
                <div class="d-flex align-items-center gap-2">
                    <div style="width:32px;height:32px;border-radius:8px;background:{{ $warna_bg }};color:{{ $warna }};display:flex;align-items:center;justify-content:center;">
                        <i class="bi {{ $icon }}"></i>
                    </div>
                    <span>{{ $k->kategori }}</span>
                </div>
            </td>
            <td class="text-center">{{ $k->total_posisi }} Posisi</td>
            <td class="text-center">
                @if((int)$k->pelamar_baru > 0)
                <span class="badge bg-danger" style="font-size:12px; padding:6px 12px; border-radius:12px;" title="Ada {{ (int)$k->pelamar_baru }} Pelamar Baru (Pending)">
                    {{ (int)$k->total_pelamar }}
                </span>
                @else
                <span class="badge bg-secondary" style="font-size:12px; padding:6px 12px; border-radius:12px; background-color: #94a3b8 !important;" title="Tidak ada pelamar baru">
                    {{ (int)$k->total_pelamar }}
                </span>
                @endif
            </td>
            <td class="text-center">
                <a href="{{ route('admin.lamaran.index', ['kategori' => $k->kategori]) }}" class="btn btn-sm btn-outline-primary" style="border-radius: 8px;">
                    <i class="bi bi-briefcase me-1"></i> Lihat Posisi
                </a>
            </td>
        </tr>
        @empty
        <tr><td colspan="4" class="text-center py-4 text-muted">Belum ada data kategori</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endif

@if(isset($karirList))
<div class="mb-3 d-flex align-items-center justify-content-between">
    <h5 class="mb-0 text-muted" style="font-size:15px;"><i class="bi bi-briefcase me-2"></i>Daftar Posisi Pekerjaan — {{ $kategori_title }}</h5>
    <a href="{{ route('admin.lamaran.index') }}" class="btn btn-sm btn-outline-secondary" style="border-radius: 8px;"><i class="bi bi-arrow-left me-1"></i> Kembali ke Kategori Utama</a>
</div>
<div class="admin-table">
    <table class="table">
        <thead>
            <tr>
                <th>Posisi Pekerjaan</th>
                <th>Kategori</th>
                <th>Departemen</th>
                <th>Status Lowongan</th>
                <th class="text-center">Total Pelamar</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
        @forelse($karirList as $k)
        @php
            $meta = $kategoriMeta[$k->kategori] ?? null;
            $warna = $meta ? $meta->warna : '#0055a5';
            $warna_bg = $meta ? $meta->warna_bg : '#e0f2fe';
            $icon = $meta ? $meta->icon : 'bi-tags';
        @endphp
        <tr>
            <td class="fw-bold" style="color: #0f172a;">{{ $k->posisi }}</td>
            <td style="font-size:13px; color:#475569;">
                <span class="badge" style="background:{{ $warna_bg }};color:{{ $warna }};padding:6px 10px;font-weight:600;">
                    <i class="bi {{ $icon }} me-1"></i> {{ $k->kategori }}
                </span>
            </td>
            <td style="font-size:13px; color:#475569;">{{ $k->departemen }}</td>
            <td>
                @if($k->is_active)
                    <span class="badge bg-success-subtle text-success">Aktif</span>
                @else
                    <span class="badge bg-danger-subtle text-danger">Tutup</span>
                @endif
            </td>
            <td class="text-center">
                @if((int)$k->pelamar_baru > 0)
                <span class="badge bg-danger" style="font-size:12px; padding:6px 12px; border-radius:12px;" title="Ada {{ (int)$k->pelamar_baru }} Pelamar Baru (Pending)">
                    {{ $k->lamarans_count }}
                </span>
                @else
                <span class="badge bg-secondary" style="font-size:12px; padding:6px 12px; border-radius:12px; background-color: #94a3b8 !important;" title="Tidak ada pelamar baru">
                    {{ $k->lamarans_count }}
                </span>
                @endif
            </td>
            <td class="text-center">
                <a href="{{ route('admin.lamaran.index', ['karir_id' => $k->id]) }}" class="btn btn-sm btn-outline-primary" style="border-radius: 8px;">
                    <i class="bi bi-list-check me-1"></i> Lihat Pelamar
                </a>
            </td>
        </tr>
        @empty
        <tr><td colspan="6" class="text-center py-4 text-muted">Belum ada posisi pekerjaan</td></tr>
        @endforelse
        </tbody>
    </table>
    <div class="p-3">{{ $karirList->links() }}</div>
</div>
@endif

@if(isset($lamarans))
<div class="mb-3 d-flex align-items-center justify-content-between">
    <h5 class="mb-0 text-muted" style="font-size:15px;"><i class="bi bi-people me-2"></i>Daftar Pelamar</h5>
    <a href="{{ request()->has('karir_id') ? route('admin.lamaran.index', ['kategori' => $karirs->firstWhere('id', request('karir_id'))->kategori ?? '']) : route('admin.lamaran.index') }}" class="btn btn-sm btn-outline-secondary" style="border-radius: 8px;"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
</div>
<div class="admin-table">
    <table class="table">
        <thead><tr><th>Nama</th><th>Email / Telp</th><th>Posisi</th><th>CV</th><th>Status</th><th>Tanggal</th><th>Aksi</th></tr></thead>
        <tbody>
        @forelse($lamarans as $l)
        @php
            $waNum = preg_replace('/[^0-9]/', '', $l->telepon);
            if(str_starts_with($waNum, '0')) $waNum = '62' . substr($waNum, 1);
            $waLink = "https://wa.me/{$waNum}?text=Assalamualaikum%20wr.%20wb,%20Halo%20*{$l->nama}*,%20kami%20dari%20SDM%20Rumah%20sakit%20HAMORI%20terkait%20lamaran%20Anda%20sebagai%20*" . rawurlencode($l->karir->posisi ?? 'Karyawan') . "*";
        @endphp
        <tr>
            <td class="fw-semibold">{{ $l->nama }}</td>
            <td style="font-size:12px;color:#64748b">{{ $l->email }}<br>{{ $l->telepon }}</td>
            <td style="font-size:12px">{{ $l->karir->posisi ?? '—' }}</td>
            <td><a href="{{ asset('storage/'.$l->cv) }}" target="_blank" class="btn btn-sm btn-outline-primary"><i class="bi bi-file-pdf me-1"></i>CV</a></td>
            <td>
                <span class="badge bg-{{ $l->status_color }}" style="font-size:11px">{{ $l->status_label }}</span>
            </td>
            <td style="font-size:12px;color:#64748b">{{ $l->created_at->format('d M Y') }}</td>
            <td class="d-flex gap-1">
                <a href="{{ $waLink }}" target="_blank" class="btn btn-sm btn-success" title="Hubungi via WhatsApp"><i class="bi bi-whatsapp"></i></a>
                <a href="{{ route('admin.lamaran.show', $l) }}" class="btn btn-sm btn-outline-primary" title="Detail"><i class="bi bi-eye"></i></a>
                <form method="POST" action="{{ route('admin.lamaran.destroy', $l) }}" onsubmit="return confirm('Hapus lamaran ini?')">@csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger" title="Hapus"><i class="bi bi-trash"></i></button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="7" class="text-center py-4 text-muted">Belum ada lamaran</td></tr>
        @endforelse
        </tbody>
    </table>
    <div class="p-3">{{ $lamarans->links() }}</div>
</div>
@endif
@endsection