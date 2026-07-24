@extends('admin.layouts.app')
@section('title', 'Kategori Fasilitas')
@section('page-title', 'Manajemen Kategori Fasilitas')
@section('content')
<div class="page-hd">
    <div>
        <h1 class="page-hd-title">Kategori Fasilitas</h1>
        <p class="page-hd-sub">Seret baris untuk mengatur urutan tampilan kategori di navbar</p>
    </div>
    <a href="{{ route('admin.kategori-fasilitas.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-2"></i>Tambah Kategori
    </a>
</div>

{{-- Notifikasi simpan urutan --}}
<div id="reorderToast" class="d-none mb-3 p-3 rounded-3 align-items-center gap-2" style="background:#f0fdf4;border:1px solid #86efac;font-size:14px;">
    <i class="bi bi-check-circle-fill text-success"></i>
    <span class="text-success fw-semibold">Urutan berhasil disimpan!</span>
</div>

<div class="admin-table">
    <table class="table" id="sortableTable">
        <thead>
            <tr>
                <th style="width:40px"></th>
                <th style="width:70px">Urutan</th>
                <th>Nama Kategori</th>
                <th>Deskripsi</th>
                <th style="width:90px">Status</th>
                <th style="width:140px">Aksi</th>
            </tr>
        </thead>
        <tbody id="sortableBody">
            @forelse($kategori as $k)
            <tr data-id="{{ $k->id }}" style="cursor: grab;">
                <td style="color:#94a3b8;font-size:18px;"><i class="bi bi-grip-vertical"></i></td>
                <td>
                    <span class="badge bg-primary rounded-pill urutan-badge">{{ $k->urutan }}</span>
                </td>
                <td class="fw-semibold">{{ $k->nama }}</td>
                <td><span class="text-muted" style="font-size: 13px;">{{ Str::limit($k->deskripsi, 50) ?: '-' }}</span></td>
                <td>
                    <form method="POST" action="{{ route('admin.kategori-fasilitas.toggle', $k->id) }}">
                        @csrf @method('PATCH')
                        <button type="submit" class="badge border-0 bg-{{ $k->is_active ? 'success' : 'secondary' }}" style="cursor:pointer;font-size:11px;padding:5px 10px">
                            {{ $k->is_active ? 'Aktif' : 'Nonaktif' }}
                        </button>
                    </form>
                </td>
                <td>
                    <a href="{{ route('admin.kategori-fasilitas.edit', $k->id) }}" class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil"></i></a>
                    <form method="POST" action="{{ route('admin.kategori-fasilitas.destroy', $k->id) }}" class="d-inline" onsubmit="return confirm('Hapus kategori ini?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center py-4 text-muted">Belum ada kategori fasilitas</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-3">{{ $kategori->links() }}</div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.3/Sortable.min.js"></script>
<script>
const tbody   = document.getElementById('sortableBody');
const toast   = document.getElementById('reorderToast');
let toastTimer;

if (tbody) {
    Sortable.create(tbody, {
        animation: 180,
        handle: '.bi-grip-vertical',
        ghostClass: 'table-active',
        onEnd: function () {
            // Update badge urutan secara visual
            tbody.querySelectorAll('tr').forEach((row, idx) => {
                const badge = row.querySelector('.urutan-badge');
                if (badge) badge.textContent = idx + 1;
            });

            // Kirim urutan baru ke server via AJAX
            const order = Array.from(tbody.querySelectorAll('tr[data-id]')).map(r => r.dataset.id);

            fetch('{{ route('admin.kategori-fasilitas.reorder') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ order })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    // Tampilkan toast sukses
                    toast.classList.remove('d-none');
                    toast.classList.add('d-flex');
                    clearTimeout(toastTimer);
                    toastTimer = setTimeout(() => {
                        toast.classList.add('d-none');
                        toast.classList.remove('d-flex');
                    }, 3000);
                }
            });
        }
    });
}
</script>
@endpush
@endsection
