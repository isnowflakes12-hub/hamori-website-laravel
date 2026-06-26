@extends('admin.layouts.app')
@section('title', 'Kategori Fasilitas')
@section('page-title', 'Manajemen Kategori Fasilitas')
@section('content')
<div class="page-hd">
    <div>
        <h1 class="page-hd-title">Kategori Fasilitas</h1>
        <p class="page-hd-sub">Kelola daftar kategori untuk fasilitas (misal: Rawat Inap, Rawat Jalan)</p>
    </div>
    <a href="{{ route('admin.kategori-fasilitas.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-2"></i>Tambah Kategori
    </a>
</div>

<div class="admin-table">
    <table class="table">
        <thead>
            <tr>
                <th style="width:80px">#</th>
                <th>Nama Kategori</th>
                <th>Deskripsi</th>
                <th style="width:90px">Status</th>
                <th style="width:140px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kategori as $k)
            <tr>
                <td>{{ $loop->iteration + ($kategori->currentPage() - 1) * $kategori->perPage() }}</td>
                <td class="fw-semibold">{{ $k->nama }}</td>
                <td><span class="text-muted" style="font-size: 13px;">{{ Str::limit($k->deskripsi, 50) ?: '-' }}</span></td>
                <td>
                    <form method="POST" action="{{ route('admin.kategori-fasilitas.toggle', $k->id) }}">
                        @csrf @method('PATCH')
                        <button type="submit" class="badge border-0 bg-{{ $k->is_active ? 'success' : 'secondary' }}" style="cursor:pointer;font-size:11px;padding:5px 10px">
                            {{ $k->is_active ? 'Aktif' : 'Nonaktif' }}
                        </button>
                    </form>
                </td>
                <td>
                    <a href="{{ route('admin.kategori-fasilitas.edit', $k->id) }}" class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil"></i></a>
                    <form method="POST" action="{{ route('admin.kategori-fasilitas.destroy', $k->id) }}" class="d-inline" onsubmit="return confirm('Hapus kategori ini?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center py-4 text-muted">Belum ada kategori fasilitas</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-3">{{ $kategori->links() }}</div>
</div>
@endsection
