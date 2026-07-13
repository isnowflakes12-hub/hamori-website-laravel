@extends('admin.layouts.app')
@section('title','Kritik & Saran Masuk')
@section('page-title','Kritik & Saran')
@section('content')

<div class="page-hd">
    <div>
        <h1 class="page-hd-title">Kritik & Saran</h1>
        <p class="page-hd-sub">Kelola masukan, kritik, dan saran dari pasien/pengunjung</p>
    </div>
    <a href="{{ route('admin.kritik-saran.export', ['status' => $status]) }}" class="btn btn-sm btn-success">
        <i class="bi bi-file-earmark-excel-fill"></i> Export CSV
    </a>
</div>

{{-- Stat Cards --}}
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <a href="{{ route('admin.kritik-saran.index', ['status' => 'all']) }}" class="stat-card {{ $status === 'all' ? 'border-primary shadow-sm' : '' }}">
            <div class="stat-icon" style="background:#e0e7ff;color:#4f46e5"><i class="bi bi-inbox-fill"></i></div>
            <div class="stat-num">{{ $stats['total'] }}</div>
            <div class="stat-label">Total Masuk</div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="{{ route('admin.kritik-saran.index', ['status' => 'pending']) }}" class="stat-card {{ $status === 'pending' ? 'border-warning shadow-sm' : '' }}">
            <div class="stat-icon" style="background:#fef3c7;color:#d97706"><i class="bi bi-hourglass-split"></i></div>
            <div class="stat-num">{{ $stats['pending'] }}</div>
            <div class="stat-label">Pending</div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="{{ route('admin.kritik-saran.index', ['status' => 'approved']) }}" class="stat-card {{ $status === 'approved' ? 'border-success shadow-sm' : '' }}">
            <div class="stat-icon" style="background:#dcfce7;color:#15803d"><i class="bi bi-check-circle-fill"></i></div>
            <div class="stat-num">{{ $stats['approved'] }}</div>
            <div class="stat-label">Disetujui</div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="{{ route('admin.kritik-saran.index', ['status' => 'approved']) }}" class="stat-card" style="border: 1.5px solid #0055a5">
            <div class="stat-icon" style="background:#0055a5;color:#fff"><i class="bi bi-star-fill"></i></div>
            <div class="stat-num">{{ $stats['featured'] }} <span style="font-size:12px;color:#64748b;font-weight:600">/ 10</span></div>
            <div class="stat-label text-primary fw-bold">Tampil di Beranda</div>
        </a>
    </div>
</div>

{{-- Scrollable Table --}}
<div class="admin-table" style="overflow-x:auto;">
    <table class="table table-bordered table-hover align-middle" style="min-width:1800px;font-size:13px;">
        <thead class="table-light">
            <tr>
                <th style="min-width:45px;position:sticky;left:0;background:#f8fafc;z-index:2">#</th>
                <th style="min-width:160px;position:sticky;left:45px;background:#f8fafc;z-index:2">Pengirim</th>
                <th style="min-width:100px">Responden</th>
                <th style="min-width:130px">Poliklinik</th>
                <th style="min-width:120px">No. Telepon</th>
                <th style="min-width:220px">Pesan</th>
                <th style="min-width:90px">Kepuasan RS</th>
                <th style="min-width:90px">Alur Pelayanan</th>
                <th style="min-width:80px">Fasilitas</th>
                <th style="min-width:110px">Kesesuaian Biaya</th>
                <th style="min-width:110px">Pelayanan Dokter</th>
                <th style="min-width:110px">Pelayanan Perawat</th>
                <th style="min-width:100px">Laboratorium</th>
                <th style="min-width:90px">Radiologi</th>
                <th style="min-width:90px">Fisioterapi</th>
                <th style="min-width:80px">Farmasi</th>
                <th style="min-width:100px">Tanggal</th>
                <th style="min-width:110px">Status</th>
                <th style="min-width:160px;position:sticky;right:0;background:#f8fafc;z-index:2">Aksi</th>
            </tr>
        </thead>
        <tbody>
        @forelse($kritikSaran as $ks)
        <tr class="{{ !$ks->is_read ? 'table-warning fw-semibold' : '' }}">
            {{-- No --}}
            <td style="position:sticky;left:0;background:{{ !$ks->is_read ? '#fef3c7' : '#fff' }};z-index:1">
                {{ $loop->iteration + ($kritikSaran->currentPage() - 1) * $kritikSaran->perPage() }}
            </td>

            {{-- Pengirim --}}
            <td style="position:sticky;left:45px;background:{{ !$ks->is_read ? '#fef3c7' : '#fff' }};z-index:1">
                <div class="fw-semibold">{{ $ks->nama }}</div>
                <div style="font-size:11px;color:#64748b;font-weight:normal">{{ $ks->email ?? '-' }}</div>
            </td>

            {{-- Responden --}}
            <td>
                @if($ks->responden)
                    <span class="badge {{ $ks->responden === 'pasien' ? 'bg-info' : 'bg-secondary' }}" style="font-size:10px;text-transform:capitalize">
                        {{ $ks->responden }}
                    </span>
                @else
                    <span class="text-muted">-</span>
                @endif
            </td>

            {{-- Poliklinik --}}
            <td style="font-size:12px;color:#475569">{{ $ks->nama_poliklinik ?? '-' }}</td>

            {{-- Telepon --}}
            <td style="font-size:12px">{{ $ks->telepon ?? '-' }}</td>

            {{-- Pesan --}}
            <td style="font-size:12px;color:#475569;max-width:220px;white-space:normal">
                {{ Str::limit($ks->pesan, 100) }}
            </td>

            {{-- 10 Rating Columns --}}
            @php
                $ratingData = [
                    $ks->rating_kepuasan_rs,
                    $ks->rating_alur_pelayanan,
                    $ks->rating_fasilitas,
                    $ks->rating_kesesuaian_biaya,
                    $ks->rating_pelayanan_dokter,
                    $ks->rating_pelayanan_perawat,
                    $ks->rating_laboratorium,
                    $ks->rating_radiologi,
                    $ks->rating_fisioterapi,
                    $ks->rating_farmasi,
                ];
            @endphp
            @foreach($ratingData as $rv)
            <td class="text-center">
                @if($rv)
                    <div style="color:#f59e0b;font-size:12px;white-space:nowrap">
                        @for($s=1;$s<=5;$s++)<i class="{{ $s <= $rv ? 'fas' : 'far' }} fa-star" style="font-size:10px"></i>@endfor
                    </div>
                    <small class="text-muted" style="font-size:10px">{{ $rv }}/5</small>
                @else
                    <span class="text-muted">-</span>
                @endif
            </td>
            @endforeach

            {{-- Tanggal --}}
            <td style="font-size:11px;color:#64748b;white-space:nowrap">
                {{ $ks->created_at->format('d M Y') }}<br>
                <span style="font-size:10px;color:#94a3b8">{{ $ks->created_at->format('H:i') }}</span>
            </td>

            {{-- Status --}}
            <td>
                @if($ks->status === 'pending') <span class="badge bg-warning text-dark">Pending</span>
                @elseif($ks->status === 'approved') <span class="badge bg-success">Disetujui</span>
                @else <span class="badge bg-danger">Ditolak</span>
                @endif

                @if($ks->is_featured)
                <div class="mt-1">
                    @if($ks->approved_at && $ks->approved_at->diffInMonths(now()) >= 3)
                        <span class="badge bg-danger" title="Kedaluwarsa"><i class="bi bi-exclamation-triangle"></i> Expired</span>
                    @else
                        <span class="badge bg-primary"><i class="bi bi-star-fill"></i> Featured</span>
                    @endif
                </div>
                @endif

                @if(!$ks->is_read)
                <div class="mt-1"><span class="badge bg-info text-dark" style="font-size:9px">● Baru</span></div>
                @endif
            </td>

            {{-- Aksi --}}
            <td style="position:sticky;right:0;background:{{ !$ks->is_read ? '#fef3c7' : '#fff' }};z-index:1">
                <div class="d-flex gap-1 align-items-center flex-wrap">
                    <a href="{{ route('admin.kritik-saran.show', $ks) }}" class="btn btn-sm btn-outline-secondary" title="Lihat Detail">
                        <i class="bi bi-eye"></i>
                    </a>

                    @if($ks->status === 'pending')
                    <form method="POST" action="{{ route('admin.kritik-saran.status', $ks) }}" class="d-inline">@csrf @method('PATCH')
                        <input type="hidden" name="status" value="approved">
                        <button class="btn btn-sm btn-success" title="Setujui"><i class="bi bi-check-lg"></i></button>
                    </form>
                    <form method="POST" action="{{ route('admin.kritik-saran.status', $ks) }}" class="d-inline">@csrf @method('PATCH')
                        <input type="hidden" name="status" value="rejected">
                        <button class="btn btn-sm btn-danger" title="Tolak"><i class="bi bi-x-lg"></i></button>
                    </form>
                    @endif

                    @if($ks->status === 'approved')
                    <form method="POST" action="{{ route('admin.kritik-saran.featured', $ks) }}" class="d-inline">@csrf @method('PATCH')
                        <button class="btn btn-sm {{ $ks->is_featured ? 'btn-primary' : 'btn-outline-primary' }}"
                                title="{{ $ks->is_featured ? 'Hapus dari Beranda' : 'Tampilkan di Beranda' }}">
                            <i class="bi bi-star{{ $ks->is_featured ? '-fill' : '' }}"></i>
                        </button>
                    </form>
                    @endif

                    <form method="POST" action="{{ route('admin.kritik-saran.destroy', $ks) }}" class="d-inline"
                          onsubmit="return confirm('Hapus pesan ini?')">@csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger" title="Hapus"><i class="bi bi-trash"></i></button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr><td colspan="19" class="text-center py-5 text-muted">Belum ada kritik & saran.</td></tr>
        @endforelse
        </tbody>
    </table>
    <div class="p-3">{{ $kritikSaran->appends(['status' => $status])->links() }}</div>
</div>

<style>
.admin-table { border-radius: 12px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,.08); }
.admin-table table thead th { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: .04em; color: #64748b; padding: 10px 12px; border-bottom: 2px solid #e2e8f0; white-space: nowrap; }
.admin-table table tbody td { padding: 10px 12px; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
.admin-table table tbody tr:hover td { background: #f8fafc !important; }
</style>
@endsection
