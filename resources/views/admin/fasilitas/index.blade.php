@extends('admin.layouts.app')
@section('title','Fasilitas')
@section('page-title','Manajemen Fasilitas')
@section('content')
<div class="page-hd">
    <div><h1 class="page-hd-title">Fasilitas</h1><p class="page-hd-sub">Kelola informasi fasilitas rumah sakit</p></div>
    <a href="{{ route('admin.fasilitas.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-2"></i>Tambah Fasilitas</a>
</div>
<div class="admin-table">
    <table class="table">
        <thead><tr><th style="width:80px">#</th><th>Gambar</th><th>Nama</th><th>Kategori</th><th style="width:90px">Status</th><th style="width:140px">Aksi</th></tr></thead>
        <tbody>
        @forelse($fasilitas as $f)
        <tr>
            <td>{{ $loop->iteration + ($fasilitas->currentPage() - 1) * $fasilitas->perPage() }}</td>
            <td>
                @if($f->gambar)
                <img src="{{ asset('storage/'.$f->gambar) }}" style="width:60px;height:40px;object-fit:cover;border-radius:6px;border:1px solid #e5eaf0">
                @else
                <div style="width:60px;height:40px;background:#f8fafc;border-radius:6px;border:1px dashed #cbd5e1;display:flex;align-items:center;justify-content:center;color:#94a3b8;font-size:16px"><i class="bi bi-image"></i></div>
                @endif
            </td>
            <td class="fw-semibold">{{ $f->nama }}</td>
            <td><span class="badge bg-light text-dark border">{{ $f->kategori->nama ?? '-' }}</span></td>
            <td>
                <form method="POST" action="{{ route('admin.fasilitas.toggle', $f->id) }}">@csrf @method('PATCH')
                    <button type="submit" class="badge border-0 bg-{{ $f->is_active ? 'success' : 'secondary' }}" style="cursor:pointer;font-size:11px;padding:5px 10px">
                        {{ $f->is_active ? 'Aktif' : 'Nonaktif' }}
                    </button>
                </form>
            </td>
            <td>
                <a href="{{ route('admin.fasilitas.edit', $f->id) }}" class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil"></i></a>
                <form method="POST" action="{{ route('admin.fasilitas.destroy', $f->id) }}" class="d-inline" onsubmit="return confirm('Hapus fasilitas ini?')">@csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="6" class="text-center py-4 text-muted">Belum ada fasilitas</td></tr>
        @endforelse
        </tbody>
    </table>
    <div class="p-3">{{ $fasilitas->links() }}</div>
</div>
@endsection
