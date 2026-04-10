@extends('admin.layouts.app')
@section('title','Banner')
@section('page-title','Manajemen Banner')
@section('content')
<div class="page-hd">
    <div><h1 class="page-hd-title">Banner</h1><p class="page-hd-sub">Kelola banner hero carousel website</p></div>
    <a href="{{ route('admin.banner.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-2"></i>Tambah Banner</a>
</div>
<div class="admin-table">
    <table class="table">
        <thead><tr><th style="width:80px">#</th><th>Gambar</th><th>Judul</th><th>Link</th><th>Urutan</th><th>Status</th><th style="width:140px">Aksi</th></tr></thead>
        <tbody>
        @forelse($banners as $b)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td><img src="{{ asset('storage/'.$b->gambar) }}" style="width:80px;height:48px;object-fit:cover;border-radius:8px;border:1px solid #e5eaf0"></td>
            <td class="fw-semibold">{{ $b->judul ?? '(tanpa judul)' }}</td>
            <td style="font-size:12px;color:#64748b">{{ $b->link ? Str::limit($b->link,35) : '—' }}</td>
            <td>{{ $b->urutan }}</td>
            <td>
                <form method="POST" action="{{ route('admin.banner.toggle', $b) }}">@csrf @method('PATCH')
                    <button type="submit" class="badge border-0 bg-{{ $b->is_active ? 'success' : 'secondary' }}" style="cursor:pointer;font-size:11px;padding:5px 10px">
                        {{ $b->is_active ? 'Aktif' : 'Nonaktif' }}
                    </button>
                </form>
            </td>
            <td>
                <a href="{{ route('admin.banner.edit', $b) }}" class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil"></i></a>
                <form method="POST" action="{{ route('admin.banner.destroy', $b) }}" class="d-inline" onsubmit="return confirm('Hapus banner ini?')">@csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="7" class="text-center py-4 text-muted">Belum ada banner</td></tr>
        @endforelse
        </tbody>
    </table>
    <div class="p-3">{{ $banners->links() }}</div>
</div>
@endsection