@extends('admin.layouts.app')
@section('title','Kebijakan Privasi')
@section('page-title','Manajemen Kebijakan Privasi')
@section('content')
<div class="page-hd">
    <div><h1 class="page-hd-title">Kebijakan Privasi</h1><p class="page-hd-sub">Kelola isi halaman Privacy Policy</p></div>
    <a href="{{ route('admin.privacy-policy.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-2"></i>Tambah Bagian</a>
</div>
<div class="admin-table">
    <table class="table">
        <thead><tr><th style="width:60px">#</th><th>Judul</th><th>Konten</th><th style="width:80px">Urutan</th><th style="width:90px">Status</th><th style="width:140px">Aksi</th></tr></thead>
        <tbody>
        @forelse($policies as $policy)
        <tr>
            <td>{{ $loop->iteration + ($policies->currentPage() - 1) * $policies->perPage() }}</td>
            <td class="fw-semibold">{{ Str::limit($policy->judul, 50) }}</td>
            <td style="font-size:13px;color:#64748b">{{ Str::limit(strip_tags($policy->konten), 80) }}</td>
            <td>{{ $policy->urutan }}</td>
            <td>
                <form method="POST" action="{{ route('admin.privacy-policy.toggle', $policy) }}">@csrf @method('PATCH')
                    <button type="submit" class="badge border-0 bg-{{ $policy->is_active ? 'success' : 'secondary' }}" style="cursor:pointer;font-size:11px;padding:5px 10px">
                        {{ $policy->is_active ? 'Aktif' : 'Nonaktif' }}
                    </button>
                </form>
            </td>
            <td>
                <a href="{{ route('admin.privacy-policy.edit', $policy) }}" class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil"></i></a>
                <form method="POST" action="{{ route('admin.privacy-policy.destroy', $policy) }}" class="d-inline" onsubmit="return confirm('Hapus bagian ini?')">@csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="6" class="text-center py-4 text-muted">Belum ada kebijakan privasi</td></tr>
        @endforelse
        </tbody>
    </table>
    <div class="p-3">{{ $policies->links() }}</div>
</div>
@endsection
