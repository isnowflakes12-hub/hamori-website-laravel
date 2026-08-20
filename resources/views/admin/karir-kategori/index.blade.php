@extends('admin.layouts.app')
@section('title', 'Kategori Pekerjaan')
@section('page-title', 'Kategori Pekerjaan')
@section('content')
<div class="page-hd">
    <div>
        <h1 class="page-hd-title">Kategori Pekerjaan</h1>
        <p class="page-hd-desc">Kelola kategori pekerjaan untuk halaman karir. <span class="text-muted" style="font-size:12px;"><i class="bi bi-grip-vertical me-1"></i>Seret baris untuk mengubah urutan.</span></p>
    </div>
    <a href="{{ route('admin.karir-kategori.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>Tambah Kategori</a>
</div>

{{-- Toast Notifikasi Urutan --}}
<div id="reorderToast" style="display:none; position:fixed; bottom:24px; right:24px; z-index:9999; background:#1ba99d; color:#fff; padding:12px 20px; border-radius:12px; font-size:14px; font-weight:600; box-shadow:0 8px 24px rgba(27,169,157,0.3); animation:fadeInUp 0.3s ease;">
    <i class="bi bi-check-circle me-2"></i><span id="toastMsg">Urutan berhasil disimpan</span>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4" style="width:44px;"></th>
                        <th style="width:40px;">No</th>
                        <th>Kategori</th>
                        <th>Warna Teks</th>
                        <th>Warna BG</th>
                        <th>Icon</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody id="sortableBody">
                    @forelse($kategoris as $k)
                    <tr data-id="{{ $k->id }}" class="sortable-row" style="cursor:grab;">
                        <td class="ps-4 text-muted drag-handle" style="cursor:grab;">
                            <i class="bi bi-grip-vertical fs-5" style="opacity:0.4;"></i>
                        </td>
                        <td class="row-num fw-semibold text-muted" style="font-size:13px;">{{ $loop->iteration }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                                     style="width:36px;height:36px;background:{{ $k->warna_bg }};color:{{ $k->warna }};font-size:16px;">
                                    <i class="bi {{ $k->icon }}"></i>
                                </div>
                                <span class="fw-bold">{{ $k->nama }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="badge" style="background: {{ $k->warna }}; color: #fff; font-size:11px;">{{ $k->warna }}</span>
                        </td>
                        <td>
                            <span class="badge" style="background: {{ $k->warna_bg }}; color: #333; border: 1px solid #ccc; font-size:11px;">{{ $k->warna_bg }}</span>
                        </td>
                        <td>
                            <code style="font-size:12px;">{{ $k->icon }}</code>
                        </td>
                        <td>
                            <form action="{{ route('admin.karir-kategori.toggle', $k->id) }}" method="POST" style="display:inline">
                                @csrf @method('PATCH')
                                <button type="submit" class="border-0 bg-transparent p-0" title="{{ $k->is_active ? 'Klik untuk nonaktifkan' : 'Klik untuk aktifkan' }}">
                                    <div style="position:relative; width:46px; height:24px; border-radius:12px; background:{{ $k->is_active ? '#1ba99d' : '#cbd5e1' }}; display:inline-block;">
                                        <div style="position:absolute; top:3px; left:{{ $k->is_active ? '25px' : '3px' }}; width:18px; height:18px; border-radius:50%; background:#fff; box-shadow:0 1px 4px rgba(0,0,0,0.2);"></div>
                                    </div>
                                    <span style="font-size:11px; font-weight:600; color:{{ $k->is_active ? '#1ba99d' : '#94a3b8' }}; vertical-align:middle; margin-left:4px;">
                                        {{ $k->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </button>
                            </form>
                        </td>
                        <td class="text-end pe-4">
                            <a href="{{ route('admin.karir-kategori.edit', $k->id) }}" class="btn btn-sm btn-light text-primary me-1"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.karir-kategori.destroy', $k->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus kategori ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light text-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">Belum ada kategori pekerjaan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
{{-- SortableJS CDN --}}
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const tbody = document.getElementById('sortableBody');
    if (!tbody) return;

    const toast = document.getElementById('reorderToast');
    let toastTimer = null;

    function showToast(msg, isError = false) {
        document.getElementById('toastMsg').textContent = msg;
        toast.style.background = isError ? '#e8333c' : '#1ba99d';
        toast.style.display = 'block';
        clearTimeout(toastTimer);
        toastTimer = setTimeout(() => toast.style.display = 'none', 3000);
    }

    // Re-number rows after sorting
    function renumberRows() {
        const rows = tbody.querySelectorAll('.sortable-row');
        rows.forEach((row, i) => {
            const num = row.querySelector('.row-num');
            if (num) num.textContent = i + 1;
        });
    }

    Sortable.create(tbody, {
        handle: '.drag-handle',
        animation: 150,
        ghostClass: 'sortable-ghost',
        chosenClass: 'sortable-chosen',
        dragClass: 'sortable-drag',
        onEnd: function () {
            renumberRows();

            const rows = tbody.querySelectorAll('.sortable-row');
            const ids = Array.from(rows).map(row => row.dataset.id);

            fetch('{{ route('admin.karir-kategori.reorder') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ ids }),
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    showToast('✓ Urutan berhasil disimpan');
                } else {
                    showToast('Gagal menyimpan urutan', true);
                }
            })
            .catch(() => showToast('Gagal menyimpan urutan', true));
        }
    });
});
</script>

<style>
.sortable-ghost {
    opacity: 0.4;
    background: #e8f8f7 !important;
    border: 2px dashed #1ba99d !important;
}
.sortable-chosen {
    background: #f0fdfb !important;
    box-shadow: 0 4px 16px rgba(27,169,157,0.18);
}
.sortable-drag {
    opacity: 0.9;
    box-shadow: 0 8px 24px rgba(0,0,0,0.12);
}
.drag-handle:hover {
    opacity: 1 !important;
    color: #1ba99d !important;
}
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(12px); }
    to   { opacity: 1; transform: translateY(0); }
}
</style>
@endpush
@endsection
