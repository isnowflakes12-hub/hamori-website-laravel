@extends('admin.layouts.app')
@section('title','Lamaran Masuk')
@section('page-title','Lamaran Masuk')
@section('content')
<div class="page-hd">
    <div><h1 class="page-hd-title">Lamaran Masuk</h1><p class="page-hd-sub">Kelola dan tracking status pelamar</p></div>
</div>
<div class="filter-bar">
    <form method="GET" class="d-flex gap-2 flex-wrap w-100">
        <input type="text" name="search" class="form-control" style="max-width:200px" placeholder="Nama pelamar..." value="{{ request('search') }}">
        <select name="karir_id" class="form-select" style="max-width:200px">
            <option value="">Semua Posisi</option>
            @foreach($karirs as $k)<option value="{{ $k->id }}" {{ request('karir_id')==$k->id?'selected':'' }}>{{ $k->posisi }}</option>@endforeach
        </select>
        <select name="status" class="form-select" style="max-width:160px">
            <option value="">Semua Status</option>
            @foreach(['pending'=>'Menunggu','review'=>'Review','shortlist'=>'Shortlist','interview'=>'Interview','diterima'=>'Diterima','ditolak'=>'Ditolak'] as $v=>$l)
            <option value="{{ $v }}" {{ request('status')==$v?'selected':'' }}>{{ $l }}</option>
            @endforeach
        </select>
        <button class="btn btn-primary" type="submit">Filter</button>
        @if(request()->hasAny(['search','karir_id','status']))<a href="{{ route('admin.lamaran.index') }}" class="btn btn-outline-secondary">Reset</a>@endif
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