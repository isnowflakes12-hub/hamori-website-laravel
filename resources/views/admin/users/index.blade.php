@extends('admin.layouts.app')
@section('title','Manajemen User')
@section('page-title','Manajemen User Admin')
@section('content')
<div class="page-hd">
    <div><h1 class="page-hd-title">Manajemen User</h1><p class="page-hd-sub">Kelola akun admin panel</p></div>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-2"></i>Tambah Admin</a>
</div>
<div class="admin-table">
    <table class="table">
        <thead><tr><th>#</th><th>Nama</th><th>Email</th><th>Role</th><th>Status</th><th>Login Terakhir</th><th>Aksi</th></tr></thead>
        <tbody>
        @forelse($users as $u)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
                <div class="d-flex align-items-center gap-2">
                    <div style="width:32px;height:32px;border-radius:50%;background:#0055a5;display:flex;align-items:center;justify-content:center;color:#fff;font-size:13px;font-weight:700;flex-shrink:0">
                        @if($u->avatar)<img src="{{ asset('storage/'.$u->avatar) }}" style="width:100%;height:100%;border-radius:50%;object-fit:cover">@else{{ strtoupper(substr($u->name,0,1)) }}@endif
                    </div>
                    <span class="fw-semibold">{{ $u->name }}</span>
                    @if($u->id === auth()->id())<span class="badge bg-secondary ms-1" style="font-size:10px">Anda</span>@endif
                </div>
            </td>
            <td style="font-size:13px;color:#64748b">{{ $u->email }}</td>
            <td><span class="badge {{ $u->getRoleBadgeClass() }}" style="font-size:11px;padding:5px 10px">{{ $u->getRoleLabel() }}</span></td>
            <td>
                <form method="POST" action="{{ route('admin.users.toggle', $u) }}">@csrf @method('PATCH')
                    <button type="submit" class="badge border-0 bg-{{ $u->is_active ? 'success' : 'danger' }}" style="cursor:pointer;font-size:11px;padding:5px 10px" {{ $u->id === auth()->id() ? 'disabled' : '' }}>
                        {{ $u->is_active ? 'Aktif' : 'Nonaktif' }}
                    </button>
                </form>
            </td>
            <td style="font-size:12px;color:#64748b">{{ $u->last_login_at ? $u->last_login_at->diffForHumans() : 'Belum pernah' }}</td>
            <td class="d-flex gap-1">
                <a href="{{ route('admin.users.edit', $u) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                @if($u->id !== auth()->id())
                <form method="POST" action="{{ route('admin.users.destroy', $u) }}" onsubmit="return confirm('Hapus user ini?')">@csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                </form>
                @endif
            </td>
        </tr>
        @empty
        <tr><td colspan="7" class="text-center py-4 text-muted">Belum ada user</td></tr>
        @endforelse
        </tbody>
    </table>
    <div class="p-3">{{ $users->links() }}</div>
</div>
@endsection