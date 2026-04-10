@extends('admin.layouts.app')
@section('title','Kategori Artikel')
@section('page-title','Kategori Artikel')

@section('content')
<div class="page-hd">
    <div>
        <h1 class="page-hd-title">Kategori Artikel</h1>
        <p class="page-hd-sub">Kelola kategori untuk pengelompokan artikel</p>
    </div>
    <a href="{{ route('admin.kategori-artikel.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-2"></i>Tambah Kategori
    </a>
</div>

<div class="admin-table">
    <table class="table">
        <thead>
            <tr>
                <th width="60">#</th>
                <th>Nama Kategori</th>
                <th>Slug</th>
                <th>Warna</th>
                <th>Artikel</th>
                <th>Urutan</th>
                <th>Status</th>
                <th width="120">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kategoris as $k)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <div class="d-flex align-items-center gap-2">
                        <div style="width:12px;height:12px;border-radius:50%;background:{{ $k->warna ?? '#0055a5' }};flex-shrink:0"></div>
                        <span class="fw-semibold">{{ $k->nama }}</span>
                    </div>
                </td>
                <td>
                    <code style="font-size:12px;background:#f1f5f9;padding:2px 8px;border-radius:6px;color:#64748b">{{ $k->slug }}</code>
                </td>
                <td>
                    <div class="d-flex align-items-center gap-2">
                        <div style="width:24px;height:24px;border-radius:6px;background:{{ $k->warna ?? '#0055a5' }};border:1px solid rgba(0,0,0,.1)"></div>
                        <span style="font-size:12px;color:#64748b">{{ $k->warna ?? '#0055a5' }}</span>
                    </div>
                </td>
                <td>
                    <span class="badge" style="background:#e8f2ff;color:#005bab;font-size:12px">
                        {{ $k->artikels_count }} artikel
                    </span>
                </td>
                <td>{{ $k->urutan }}</td>
                <td>
                    <span class="badge bg-{{ $k->is_active ? 'success' : 'secondary' }}" style="font-size:11px;padding:4px 10px">
                        {{ $k->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </td>
                <td>
                    <div class="d-flex gap-1">
                        <a href="{{ route('admin.kategori-artikel.edit', $k) }}"
                           class="btn btn-sm btn-outline-primary" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.kategori-artikel.destroy', $k) }}"
                              onsubmit="return confirm('Hapus kategori \'{{ $k->nama }}\'?\n\nKategori dengan artikel tidak bisa dihapus.')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" title="Hapus"
                                    {{ $k->artikels_count > 0 ? 'disabled title=Tidak dapat dihapus karena masih memiliki artikel' : '' }}>
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center py-4 text-muted">
                    <i class="bi bi-folder2-open d-block mb-2" style="font-size:2rem;opacity:.4"></i>
                    Belum ada kategori artikel
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
