@extends('admin.layouts.app')
@section('title','Artikel')
@section('page-title','Manajemen Artikel')

@section('content')
<div class="page-hd">
    <div>
        <h1 class="page-hd-title">Artikel</h1>
        <p class="page-hd-sub">Kelola konten edukasi kesehatan & berita RS Hamori</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.kategori-artikel.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-folder2 me-1"></i>Kategori
        </a>
        <a href="{{ route('admin.artikel.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-2"></i>Tulis Artikel
        </a>
    </div>
</div>

<div class="filter-bar">
    <form method="GET" class="d-flex gap-2 flex-wrap w-100">
        <input type="text" name="search" class="form-control" style="max-width:240px"
               placeholder="Cari judul..." value="{{ request('search') }}">
        <select name="kategori" class="form-select" style="max-width:180px">
            <option value="">Semua Kategori</option>
            @foreach($kategoris as $k)
            <option value="{{ $k->id }}" {{ request('kategori')==$k->id?'selected':'' }}>{{ $k->nama }}</option>
            @endforeach
        </select>
        <select name="status" class="form-select" style="max-width:150px">
            <option value="">Semua Status</option>
            <option value="published" {{ request('status')=='published'?'selected':'' }}>Published</option>
            <option value="draft"     {{ request('status')=='draft'?'selected':'' }}>Draft</option>
        </select>
        <button class="btn btn-primary" type="submit">Filter</button>
        @if(request()->hasAny(['search','kategori','status']))
        <a href="{{ route('admin.artikel.index') }}" class="btn btn-outline-secondary">Reset</a>
        @endif
    </form>
</div>

<div class="admin-table">
    <table class="table">
        <thead>
            <tr>
                <th width="80">Thumbnail</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Views</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th width="120">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($artikels as $a)
            <tr>
                <td>
                    <div style="width:64px;height:44px;border-radius:8px;overflow:hidden;background:#e2e8f0;flex-shrink:0">
                        @if($a->thumbnail)
                        <img src="{{ asset('storage/'.$a->thumbnail) }}"
                             style="width:100%;height:100%;object-fit:cover">
                        @else
                        <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:#94a3b8">
                            <i class="bi bi-image"></i>
                        </div>
                        @endif
                    </div>
                </td>
                <td>
                    <div class="fw-semibold" style="max-width:300px;font-size:14px;line-height:1.4">
                        {{ Str::limit($a->judul, 65) }}
                    </div>
                </td>
                <td>
                    @if($a->kategori)
                    <span class="badge" style="background:{{ $a->kategori->warna ?? '#005bab' }}20;color:{{ $a->kategori->warna ?? '#005bab' }};font-size:11px;padding:4px 10px">
                        {{ $a->kategori->nama }}
                    </span>
                    @else <span class="text-muted">—</span> @endif
                </td>
                <td style="font-size:13px;color:#64748b">{{ number_format($a->views) }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.artikel.publish', $a) }}">
                        @csrf @method('PATCH')
                        <button type="submit"
                                class="badge border-0 bg-{{ $a->is_published ? 'success' : 'secondary' }}"
                                style="cursor:pointer;font-size:11px;padding:5px 10px">
                            {{ $a->is_published ? '✓ Published' : '○ Draft' }}
                        </button>
                    </form>
                </td>
                <td style="font-size:12px;color:#64748b;white-space:nowrap">
                    {{ optional($a->published_at ?? $a->created_at)->format('d M Y') }}
                </td>
                <td>
                    <div class="d-flex gap-1">
                        <a href="{{ route('admin.artikel.edit', $a) }}"
                           class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.artikel.destroy', $a) }}"
                              onsubmit="return confirm('Hapus artikel ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center py-5 text-muted">
                    <i class="bi bi-newspaper d-block mb-2" style="font-size:2rem;opacity:.4"></i>
                    Belum ada artikel
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-3">{{ $artikels->links() }}</div>
</div>
@endsection
