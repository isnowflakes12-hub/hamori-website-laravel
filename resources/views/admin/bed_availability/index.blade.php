@extends('admin.layouts.app')
@section('title','Ketersediaan Tempat Tidur')
@section('page-title','Info Tempat Tidur')

@section('content')
<div class="page-hd">
    <div>
        <h1 class="page-hd-title">Ketersediaan Tempat Tidur</h1>
        <p class="page-hd-sub">Kelola informasi jumlah tempat tidur untuk publik. Seret baris untuk mengubah urutan.</p>
    </div>
    <a href="{{ route('admin.bed-availability.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-2"></i>Tambah Ruangan
    </a>
</div>

<div class="admin-table">
    <table class="table" id="bed-table">
        <thead>
            <tr>
                <th width="40" style="color:#94a3b8"><i class="bi bi-grip-vertical"></i></th>
                <th width="50">#</th>
                <th>Kelas</th>
                <th>Nama Ruangan</th>
                <th>Kapasitas</th>
                <th>Terisi</th>
                <th>Tersedia</th>
                <th>Status</th>
                <th width="120">Aksi</th>
            </tr>
        </thead>
        <tbody id="sortable-body">
            @forelse($beds as $b)
            <tr data-id="{{ $b->id }}" style="cursor:grab">
                <td style="color:#cbd5e1;font-size:18px"><i class="bi bi-grip-vertical"></i></td>
                <td class="row-num">{{ $loop->iteration }}</td>
                <td><span class="fw-semibold">{{ $b->kelas }}</span></td>
                <td><span style="color:#64748b">{{ $b->nama_ruangan ?? '-' }}</span></td>
                <td>
                    <span class="badge" style="background:#e8f2ff;color:#005bab;font-size:13px;padding:6px 12px">{{ $b->kapasitas }}</span>
                </td>
                <td>
                    <span class="badge" style="background:#fff1f2;color:#e11d48;font-size:13px;padding:6px 12px">{{ $b->terisi }}</span>
                </td>
                <td>
                    <span class="badge" style="background:#ecfdf5;color:#059669;font-size:13px;padding:6px 12px">{{ $b->tersedia }}</span>
                </td>
                <td>
                    <span class="badge bg-{{ $b->is_active ? 'success' : 'secondary' }}" style="font-size:11px;padding:4px 10px">
                        {{ $b->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.bed-availability.edit', $b) }}" class="btn btn-sm btn-light" style="color:#005bab">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                        <form action="{{ route('admin.bed-availability.destroy', $b) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data kamar ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-light" style="color:#e11d48">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" class="text-center py-5 text-muted">
                    <i class="bi bi-info-circle d-block mb-2" style="font-size:24px"></i>
                    Belum ada data tempat tidur
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div id="sort-toast" style="display:none;position:fixed;bottom:24px;right:24px;z-index:9999;background:#0055a5;color:#fff;padding:12px 20px;border-radius:10px;font-size:14px;box-shadow:0 4px 15px rgba(0,85,165,0.25)">
    <i class="bi bi-check-circle me-2"></i> Urutan berhasil disimpan
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.3/Sortable.min.js"></script>
<script>
const sortableBody = document.getElementById('sortable-body');
if (sortableBody) {
    Sortable.create(sortableBody, {
        handle: '.bi-grip-vertical',
        animation: 150,
        ghostClass: 'table-active',
        onEnd: function () {
            // Update row numbers visually
            sortableBody.querySelectorAll('tr').forEach((row, i) => {
                const numCell = row.querySelector('.row-num');
                if (numCell) numCell.textContent = i + 1;
            });

            // Collect new order
            const order = [...sortableBody.querySelectorAll('tr[data-id]')].map(r => r.dataset.id);

            // Send to server
            fetch('{{ route("admin.bed-availability.reorder") }}', {
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
                    const toast = document.getElementById('sort-toast');
                    toast.style.display = 'block';
                    setTimeout(() => toast.style.display = 'none', 2500);
                }
            });
        }
    });
}
</script>
@endpush
