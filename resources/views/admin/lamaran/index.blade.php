@extends('admin.layouts.app')
@section('title','Lamaran Masuk')
@section('page-title','Lamaran Masuk')
@section('content')
<div class="page-hd">
    <div><h1 class="page-hd-title">Lamaran Masuk</h1><p class="page-hd-sub">Kelola dan tracking status pelamar</p></div>
</div>
<div class="filter-bar mb-4">
    <form method="GET" class="d-flex gap-2 flex-wrap w-100 align-items-center">
        <input type="text" name="search" class="form-control flex-grow-1" style="min-width: 250px; max-width: 600px;" placeholder="Nama pelamar..." value="{{ request('search') }}">
        
        <div class="ms-auto d-flex gap-2 flex-wrap align-items-center">
            @php
                $reqKarirId = request('karir_id');
                $posisiLabel = 'Semua Posisi';
                if ($reqKarirId) {
                    $selKarir = collect($karirs)->firstWhere('id', $reqKarirId);
                    if ($selKarir) $posisiLabel = $selKarir->posisi;
                }
            @endphp
            <div class="custom-dropdown-wrapper" style="width:200px">
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
            <div class="custom-dropdown-wrapper" style="width:160px">
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
            
            <div class="d-flex gap-2">
                <button class="btn btn-primary" type="submit">Filter</button>
                @if(request()->hasAny(['search','karir_id','status']))<a href="{{ route('admin.lamaran.index') }}" class="btn btn-outline-secondary">Reset</a>@endif
            </div>
        </div>
    </form>
</div>
<div class="admin-table">
    <table class="table">
        <thead><tr><th>Nama</th><th>Email / Telp</th><th>Posisi</th><th>CV</th><th>Status</th><th>Tanggal</th><th>Aksi</th></tr></thead>
        <tbody>
        @forelse($lamarans as $l)
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
                <a href="{{ route('admin.lamaran.show', $l) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a>
                <form method="POST" action="{{ route('admin.lamaran.destroy', $l) }}" onsubmit="return confirm('Hapus lamaran ini?')">@csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
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
@endsection