@extends('admin.layouts.app')
@section('title', 'Tipe Pekerjaan')
@section('page-title', 'Tipe Pekerjaan')
@section('content')
<div class="page-hd">
    <div>
        <h1 class="page-hd-title">Tipe Pekerjaan</h1>
        <p class="page-hd-desc">Kelola tipe pekerjaan untuk form lowongan karir.</p>
    </div>
    <a href="{{ route('admin.karir-tipe.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>Tambah Tipe</a>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">No</th>
                        <th>Nama Tipe</th>
                        <th>Slug</th>
                        <th>Warna Teks</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tipes as $t)
                    <tr>
                        <td class="ps-4">{{ $loop->iteration }}</td>
                        <td>
                            <div class="fw-bold">{{ $t->nama }}</div>
                        </td>
                        <td>{{ $t->slug }}</td>
                        <td>
                            <span class="badge" style="background: {{ $t->warna }}; color: #fff;">{{ $t->warna }}</span>
                        </td>
                        <td>
                            <form action="{{ route('admin.karir-tipe.toggle', $t->id) }}" method="POST" class="d-inline">
                                @csrf @method('PATCH')
                                <button type="submit" class="btn btn-sm {{ $t->is_active ? 'btn-success' : 'btn-secondary' }}" style="font-size:12px;border-radius:20px;padding:4px 12px">
                                    {{ $t->is_active ? 'Aktif' : 'Nonaktif' }}
                                </button>
                            </form>
                        </td>
                        <td class="text-end pe-4">
                            <a href="{{ route('admin.karir-tipe.edit', $t->id) }}" class="btn btn-sm btn-light text-primary me-1"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.karir-tipe.destroy', $t->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus tipe ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light text-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">Belum ada tipe pekerjaan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
