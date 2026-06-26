@extends('admin.layouts.app')
@section('title','Kritik & Saran Masuk')
@section('page-title','Kritik & Saran')
@section('content')
<div class="page-hd">
    <div><h1 class="page-hd-title">Kritik & Saran</h1><p class="page-hd-sub">Kelola masukan, kritik, dan saran dari pasien/pengunjung</p></div>
</div>

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

<div class="admin-table">
    <table class="table">
        <thead><tr><th style="width:60px">#</th><th>Pengirim</th><th>Pesan</th><th>Kategori/Rating</th><th>Status</th><th style="width:180px">Aksi</th></tr></thead>
        <tbody>
        @forelse($kritikSaran as $ks)
        <tr class="{{ !$ks->is_read ? 'bg-light fw-bold' : '' }}">
            <td>{{ $loop->iteration + ($kritikSaran->currentPage() - 1) * $kritikSaran->perPage() }}</td>
            <td>
                <div>{{ $ks->nama }}</div>
                <div style="font-size:11px;color:#64748b;font-weight:normal">{{ $ks->email ?? $ks->telepon ?? '-' }}</div>
                <div style="font-size:10px;color:#94a3b8;margin-top:4px">{{ $ks->created_at->diffForHumans() }}</div>
            </td>
            <td style="font-size:13px;color:#475569;max-width:300px">{{ Str::limit($ks->pesan, 80) }}</td>
            <td>
                <span class="badge bg-secondary mb-1" style="text-transform:uppercase;font-size:10px">{{ $ks->kategori }}</span><br>
                @if($ks->rating)
                <span style="color:#f59e0b;font-size:12px">{{ str_repeat('★', $ks->rating) }}{{ str_repeat('☆', 5 - $ks->rating) }}</span>
                @else
                <span style="font-size:11px;color:#94a3b8">-</span>
                @endif
            </td>
            <td>
                @if($ks->status === 'pending') <span class="badge bg-warning text-dark">Pending</span>
                @elseif($ks->status === 'approved') <span class="badge bg-success">Disetujui</span>
                @else <span class="badge bg-danger">Ditolak</span>
                @endif
                
                @if($ks->is_featured)
                    <div class="mt-1">
                        @if($ks->approved_at && $ks->approved_at->diffInMonths(now()) >= 3)
                            <span class="badge bg-danger" title="Kedaluwarsa (Lebih dari 3 bulan)"><i class="bi bi-exclamation-triangle"></i> Expired</span>
                        @else
                            <span class="badge bg-primary"><i class="bi bi-star-fill"></i> Featured</span>
                        @endif
                    </div>
                @endif
            </td>
            <td>
                <div class="d-flex gap-1 align-items-center flex-wrap">
                    <a href="{{ route('admin.kritik-saran.show', $ks) }}" class="btn btn-sm btn-outline-secondary" title="Lihat"><i class="bi bi-eye"></i></a>
                    
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
                        <button class="btn btn-sm {{ $ks->is_featured ? 'btn-primary' : 'btn-outline-primary' }}" title="{{ $ks->is_featured ? 'Hapus dari Beranda' : 'Tampilkan di Beranda' }}">
                            <i class="bi bi-star{{ $ks->is_featured ? '-fill' : '' }}"></i>
                        </button>
                    </form>
                    @endif
                    
                    <form method="POST" action="{{ route('admin.kritik-saran.destroy', $ks) }}" class="d-inline" onsubmit="return confirm('Hapus pesan ini?')">@csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr><td colspan="6" class="text-center py-5 text-muted">Belum ada kritik & saran.</td></tr>
        @endforelse
        </tbody>
    </table>
    <div class="p-3">{{ $kritikSaran->appends(['status' => $status])->links() }}</div>
</div>
@endsection
