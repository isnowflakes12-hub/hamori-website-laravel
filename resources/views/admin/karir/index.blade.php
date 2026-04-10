@extends('admin.layouts.app')
@section('title','Lowongan Kerja')
@section('page-title','Manajemen Lowongan Kerja')
@section('content')
<div class="page-hd">
    <div><h1 class="page-hd-title">Lowongan Kerja</h1><p class="page-hd-sub">Kelola rekrutmen dan lowongan kerja</p></div>
    <a href="{{ route('admin.karir.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-2"></i>Tambah Lowongan</a>
</div>
<div class="filter-bar">
    <form method="GET" class="d-flex gap-2 flex-wrap w-100">
        <input type="text" name="search" class="form-control" style="max-width:200px" placeholder="Cari posisi..." value="{{ request('search') }}">
        <select name="kategori" class="form-select" style="max-width:180px">
            <option value="">Semua Kategori</option>
            @foreach($kategoriList as $k)<option value="{{ $k }}" {{ request('kategori')==$k?'selected':'' }}>{{ $k }}</option>@endforeach
        </select>
        <select name="status" class="form-select" style="max-width:140px">
            <option value="">Semua Status</option>
            <option value="aktif" {{ request('status')=='aktif'?'selected':'' }}>Aktif</option>
            <option value="nonaktif" {{ request('status')=='nonaktif'?'selected':'' }}>Nonaktif</option>
        </select>
        <button class="btn btn-primary" type="submit">Filter</button>
        @if(request()->hasAny(['search','kategori','status']))<a href="{{ route('admin.karir.index') }}" class="btn btn-outline-secondary">Reset</a>@endif
    </form>
</div>
<div class="admin-table">
    <table class="table">
        <thead><tr><th>Posisi</th><th>Departemen</th><th>Kategori</th><th>Tipe</th><th>Kuota</th><th>Lamaran</th><th>Deadline</th><th>Status</th><th>Aksi</th></tr></thead>
        <tbody>
        @forelse($karirs as $k)
        @php $deadline = $k->batas_lamaran; $isExpired = $deadline && $deadline->isPast(); @endphp
        <tr>
            <td class="fw-semibold">{{ $k->posisi }}</td>
            <td style="font-size:12px;color:#64748b">{{ $k->departemen }}</td>
            <td><span class="badge" style="background:#e8f0fa;color:#0055a5;font-size:11px">{{ $k->kategori }}</span></td>
            <td><span class="badge bg-secondary" style="font-size:11px">{{ ucfirst(str_replace('-',' ',$k->tipe)) }}</span></td>
            <td class="text-center">{{ $k->kuota ?? 1 }}</td>
            <td><a href="{{ route('admin.lamaran.index', ['karir_id' => $k->id]) }}" class="badge bg-primary" style="font-size:11px;text-decoration:none">{{ $k->lamarans_count }}</a></td>
            <td style="font-size:12px;color:{{ $isExpired ? '#e8333c' : '#64748b' }}">{{ $deadline ? $deadline->format('d M Y') : '—' }}</td>
            <td>
                <form method="POST" action="{{ route('admin.karir.toggle', $k) }}">@csrf @method('PATCH')
                    <button type="submit" class="badge border-0 bg-{{ $k->is_active ? 'success' : 'secondary' }}" style="cursor:pointer;font-size:11px;padding:5px 10px">
                        {{ $k->is_active ? 'Aktif' : 'Nonaktif' }}
                    </button>
                </form>
            </td>
            <td class="d-flex gap-1">
                <a href="{{ route('admin.karir.edit', $k) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                <form method="POST" action="{{ route('admin.karir.destroy', $k) }}" onsubmit="return confirm('Hapus lowongan ini?')">@csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="9" class="text-center py-4 text-muted">Belum ada lowongan</td></tr>
        @endforelse
        </tbody>
    </table>
    <div class="p-3">{{ $karirs->links() }}</div>
</div>
@endsection