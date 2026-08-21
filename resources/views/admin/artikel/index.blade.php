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

<div class="filter-bar mb-4">
    <form method="GET" class="d-flex gap-2 align-items-center w-100" style="flex-wrap:nowrap;">
        <input type="text" name="search" class="form-control" style="flex:1 1 0; min-width:0;"
               placeholder="Cari judul artikel..." value="{{ request('search') }}">
        
        @php
            $reqKategori = request('kategori');
            $katLabel = 'Semua Kategori';
            if ($reqKategori) {
                $selKat = collect($kategoris)->firstWhere('id', $reqKategori);
                if ($selKat) $katLabel = $selKat->nama;
            }
        @endphp
        <div class="custom-dropdown-wrapper flex-shrink-0" style="width: 200px;">
            <input type="hidden" name="kategori" value="{{ $reqKategori }}">
            <div class="custom-dropdown-trigger">
                <span class="custom-dropdown-label">{{ $katLabel }}</span>
                <i class="bi bi-chevron-down custom-dropdown-arrow"></i>
            </div>
            <ul class="custom-dropdown-options-container">
                <li class="custom-dropdown-option {{ $reqKategori == '' ? 'active' : '' }}" data-value="">Semua Kategori</li>
                @foreach($kategoris as $k)
                <li class="custom-dropdown-option {{ $reqKategori == $k->id ? 'active' : '' }}" data-value="{{ $k->id }}">{{ $k->nama }}</li>
                @endforeach
            </ul>
        </div>
        
        @php
            $reqStatus = request('status');
            $statLabel = 'Semua Status';
            if ($reqStatus == 'published') $statLabel = 'Published';
            elseif ($reqStatus == 'draft') $statLabel = 'Draft';
        @endphp
        <div class="custom-dropdown-wrapper flex-shrink-0" style="width: 160px;">
            <input type="hidden" name="status" value="{{ $reqStatus }}">
            <div class="custom-dropdown-trigger">
                <span class="custom-dropdown-label">{{ $statLabel }}</span>
                <i class="bi bi-chevron-down custom-dropdown-arrow"></i>
            </div>
            <ul class="custom-dropdown-options-container">
                <li class="custom-dropdown-option {{ $reqStatus == '' ? 'active' : '' }}" data-value="">Semua Status</li>
                <li class="custom-dropdown-option {{ $reqStatus == 'published' ? 'active' : '' }}" data-value="published">Published</li>
                <li class="custom-dropdown-option {{ $reqStatus == 'draft' ? 'active' : '' }}" data-value="draft">Draft</li>
            </ul>
        </div>

        <button class="btn btn-primary flex-shrink-0" type="submit">Filter</button>
        @if(request()->hasAny(['search','kategori','status']))
        <a href="{{ route('admin.artikel.index') }}" class="btn btn-outline-secondary flex-shrink-0">Reset</a>
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
                    @if($a->kategoris && $a->kategoris->count() > 0)
                        <div class="d-flex flex-wrap gap-1">
                        @foreach($a->kategoris as $kat)
                            <span class="badge" style="background:{{ $kat->warna ?? '#005bab' }}20;color:{{ $kat->warna ?? '#005bab' }};font-size:11px;padding:4px 10px">
                                {{ $kat->nama }}
                            </span>
                        @endforeach
                        </div>
                    @else 
                        <span class="text-muted">—</span> 
                    @endif
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
