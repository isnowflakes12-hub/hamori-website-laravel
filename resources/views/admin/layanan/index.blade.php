@extends('admin.layouts.app')
@section('title','Layanan Unggulan')
@section('page-title','Layanan Unggulan')

@section('content')
<div class="page-hd">
    <div>
        <h1 class="page-hd-title">Layanan Unggulan</h1>
        <p class="page-hd-sub">Kelola layanan medis unggulan yang ditampilkan di website</p>
    </div>
    <a href="{{ route('admin.layanan.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-2"></i>Tambah Layanan
    </a>
</div>

{{-- Filter --}}
<div class="filter-bar">
    <form method="GET" class="d-flex gap-2 flex-wrap w-100">
        <input type="text" name="search" class="form-control" style="max-width:260px"
               placeholder="Cari nama layanan..." value="{{ request('search') }}">
        <button class="btn btn-primary" type="submit">Filter</button>
        @if(request('search'))
        <a href="{{ route('admin.layanan.index') }}" class="btn btn-outline-secondary">Reset</a>
        @endif
    </form>
</div>

<div class="admin-table">
    <table class="table">
        <thead>
            <tr>
                <th width="60">Urutan</th>
                <th width="80">Logo</th>
                <th>Nama Layanan</th>
                <th>Slug</th>
                <th>Deskripsi Singkat</th>
                <th>Status</th>
                <th width="130">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($layanans as $l)
            <tr>
                <td class="text-center">
                    <span style="font-size:13px;font-weight:700;color:#64748b">{{ $l->urutan }}</span>
                </td>
                <td>
                    @if($l->logo)
                    <img src="{{ asset('storage/'.$l->logo) }}"
                         style="width:44px;height:44px;object-fit:contain;border-radius:10px;border:1px solid #e2e8f0;background:#f8fafc;padding:4px">
                    @else
                    <div style="width:44px;height:44px;border-radius:10px;background:#e8f2ff;display:flex;align-items:center;justify-content:center;color:#005bab">
                        <i class="bi bi-hospital" style="font-size:18px"></i>
                    </div>
                    @endif
                </td>
                <td>
                    <span class="fw-semibold">{{ $l->nama }}</span>
                </td>
                <td>
                    <code style="font-size:11.5px;background:#f1f5f9;padding:2px 8px;border-radius:6px;color:#64748b">{{ $l->slug }}</code>
                </td>
                <td style="max-width:280px">
                    <span style="font-size:13px;color:#64748b">
                        {{ Str::limit($l->deskripsi_singkat ?? $l->deskripsi ?? '—', 70) }}
                    </span>
                </td>
                <td>
                    <form method="POST" action="{{ route('admin.layanan.toggle', $l) }}">
                        @csrf @method('PATCH')
                        <button type="submit"
                                class="badge border-0 bg-{{ $l->is_active ? 'success' : 'secondary' }}"
                                style="cursor:pointer;font-size:11px;padding:5px 10px">
                            {{ $l->is_active ? 'Aktif' : 'Nonaktif' }}
                        </button>
                    </form>
                </td>
                <td>
                    <div class="d-flex gap-1">
                        <a href="{{ route('admin.layanan.edit', $l) }}"
                           class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.layanan.destroy', $l) }}"
                              onsubmit="return confirm('Hapus layanan \'{{ $l->nama }}\'?')">
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
                    <i class="bi bi-award d-block mb-2" style="font-size:2rem;opacity:.4"></i>
                    Belum ada layanan unggulan
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-3">{{ $layanans->links() }}</div>
</div>
@endsection
