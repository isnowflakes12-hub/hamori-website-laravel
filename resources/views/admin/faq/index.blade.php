@extends('admin.layouts.app')
@section('title','FAQ')
@section('page-title','Manajemen FAQ')
@section('content')
<div class="page-hd">
    <div><h1 class="page-hd-title">FAQ</h1><p class="page-hd-sub">Kelola pertanyaan yang sering diajukan</p></div>
    <a href="{{ route('admin.faq.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-2"></i>Tambah FAQ</a>
</div>
<div class="admin-table">
    <table class="table">
        <thead><tr><th style="width:60px">#</th><th>Pertanyaan</th><th>Jawaban</th><th style="width:80px">Urutan</th><th style="width:90px">Status</th><th style="width:140px">Aksi</th></tr></thead>
        <tbody>
        @forelse($faqs as $faq)
        <tr>
            <td>{{ $loop->iteration + ($faqs->currentPage() - 1) * $faqs->perPage() }}</td>
            <td class="fw-semibold">{{ Str::limit($faq->pertanyaan, 60) }}</td>
            <td style="font-size:13px;color:#64748b">{{ Str::limit($faq->jawaban, 80) }}</td>
            <td>{{ $faq->urutan }}</td>
            <td>
                <form method="POST" action="{{ route('admin.faq.toggle', $faq) }}">@csrf @method('PATCH')
                    <button type="submit" class="badge border-0 bg-{{ $faq->is_active ? 'success' : 'secondary' }}" style="cursor:pointer;font-size:11px;padding:5px 10px">
                        {{ $faq->is_active ? 'Aktif' : 'Nonaktif' }}
                    </button>
                </form>
            </td>
            <td>
                <a href="{{ route('admin.faq.edit', $faq) }}" class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil"></i></a>
                <form method="POST" action="{{ route('admin.faq.destroy', $faq) }}" class="d-inline" onsubmit="return confirm('Hapus FAQ ini?')">@csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="6" class="text-center py-4 text-muted">Belum ada FAQ</td></tr>
        @endforelse
        </tbody>
    </table>
    <div class="p-3">{{ $faqs->links() }}</div>
</div>
@endsection
