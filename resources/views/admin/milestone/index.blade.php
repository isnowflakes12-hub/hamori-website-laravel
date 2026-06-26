@extends('admin.layouts.app')
@section('title','Milestone')
@section('page-title','Milestone Perusahaan')
@section('content')

<div class="page-hd">
    <div>
        <h1 class="page-hd-title">Milestone</h1>
        <p class="page-hd-sub">Kelola riwayat perjalanan dan pencapaian RS</p>
    </div>
    <a href="{{ route('admin.milestone.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-2"></i>Tambah Milestone
    </a>
</div>

<div class="admin-table">
    <table class="table">
        <thead>
            <tr>
                <th width="80">Tahun</th>
                <th>Pencapaian</th>
                <th width="120">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($milestones as $m)
            <tr>
                <td class="fw-bold fs-5 text-primary">{{ $m->tahun }}</td>
                <td>
                    <div class="d-flex align-items-center gap-3">
                        @if($m->gambar)
                        <img src="{{ asset('storage/'.$m->gambar) }}" alt="Gambar" style="width:60px;height:60px;object-fit:cover;border-radius:6px">
                        @endif
                        <div>
                            <strong class="d-block">{{ $m->judul }}</strong>
                            <span class="text-muted small">{{ Str::limit($m->deskripsi, 100) }}</span>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="d-flex gap-1">
                        <a href="{{ route('admin.milestone.edit', $m) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                        <form method="POST" action="{{ route('admin.milestone.destroy', $m) }}" onsubmit="return confirm('Hapus milestone ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center text-muted py-5">Belum ada milestone</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-3">
        {{ $milestones->links() }}
    </div>
</div>

@endsection
