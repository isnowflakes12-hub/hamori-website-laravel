@extends('admin.layouts.app')
@section('title','Pesan Masuk (Kontak)')
@section('page-title','Pesan Masuk')
@section('content')
<div class="page-hd">
    <div><h1 class="page-hd-title">Pesan Masuk (Kontak)</h1><p class="page-hd-sub">Kelola pesan dari pengunjung website</p></div>
</div>

<div class="admin-table">
    <table class="table">
        <thead><tr><th style="width:60px">#</th><th>Pengirim</th><th>Subjek & Pesan</th><th>Status</th><th style="width:120px">Aksi</th></tr></thead>
        <tbody>
        @forelse($kontaks as $k)
        <tr class="{{ !$k->is_read ? 'bg-light fw-bold' : '' }}">
            <td>{{ $loop->iteration + ($kontaks->currentPage() - 1) * $kontaks->perPage() }}</td>
            <td>
                <div>{{ $k->nama }}</div>
                <div style="font-size:11px;color:#64748b;font-weight:normal">{{ $k->email ?? '-' }}</div>
                <div style="font-size:11px;color:#64748b;font-weight:normal">{{ $k->telepon ?? '-' }}</div>
                <div style="font-size:10px;color:#94a3b8;margin-top:4px">{{ $k->created_at->diffForHumans() }}</div>
            </td>
            <td>
                <div style="font-size:14px;color:#0f172a">{{ $k->subjek ?? 'Tanpa Subjek' }}</div>
                <div style="font-size:13px;color:#475569;max-width:350px">{{ Str::limit($k->pesan, 80) }}</div>
            </td>
            <td>
                @if(!$k->is_read)
                    <span class="badge bg-warning text-dark">Baru</span>
                @else
                    <span class="badge bg-secondary">Terbaca</span>
                @endif
            </td>
            <td>
                <div class="d-flex gap-1 align-items-center">
                    <a href="{{ route('admin.kontak.show', $k) }}" class="btn btn-sm btn-outline-secondary" title="Lihat"><i class="bi bi-eye"></i></a>
                    <form method="POST" action="{{ route('admin.kontak.destroy', $k) }}" class="d-inline" onsubmit="return confirm('Hapus pesan ini?')">@csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr><td colspan="5" class="text-center py-5 text-muted">Belum ada pesan masuk.</td></tr>
        @endforelse
        </tbody>
    </table>
    <div class="p-3">{{ $kontaks->links() }}</div>
</div>
@endsection
