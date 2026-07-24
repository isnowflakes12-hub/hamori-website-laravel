@extends('admin.layouts.app')
@section('title','Fasilitas')
@section('page-title','Manajemen Fasilitas')
@section('content')
<div class="page-hd">
    <div><h1 class="page-hd-title">Fasilitas</h1><p class="page-hd-sub">Kelola informasi fasilitas rumah sakit</p></div>
    <a href="{{ route('admin.fasilitas.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-2"></i>Tambah Fasilitas</a>
</div>

{{-- Toolbar bulk action (tidak nested di dalam tabel) --}}
<div id="bulkBar" class="d-none mb-3 p-3 rounded-3 align-items-center gap-3" style="background:#f0f7ff;border:1px solid #bfdbfe;">
    <span class="fw-semibold text-primary" id="bulkCount">0 dipilih</span>
    <button type="button" onclick="submitBulk('tampilkan')" class="btn btn-sm btn-success">
        <i class="bi bi-eye me-1"></i>Tampilkan di Navbar
    </button>
    <button type="button" onclick="submitBulk('sembunyikan')" class="btn btn-sm btn-secondary">
        <i class="bi bi-eye-slash me-1"></i>Sembunyikan dari Navbar
    </button>
    <button type="button" class="btn btn-sm btn-link text-danger ms-auto" id="clearSelect">Batal pilih</button>
</div>

<div class="admin-table">
    <table class="table">
        <thead><tr>
            <th style="width:40px"><input type="checkbox" id="checkAll" class="form-check-input"></th>
            <th style="width:80px">#</th>
            <th>Gambar</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th style="width:90px">Status</th>
            <th style="width:110px">Navbar</th>
            <th style="width:140px">Aksi</th>
        </tr></thead>
        <tbody>
        @forelse($fasilitas as $f)
        <tr>
            <td><input type="checkbox" data-id="{{ $f->id }}" class="form-check-input row-check"></td>
            <td>{{ $loop->iteration + ($fasilitas->currentPage() - 1) * $fasilitas->perPage() }}</td>
            <td>
                @if($f->gambar)
                <img src="{{ asset('storage/'.$f->gambar) }}" style="width:60px;height:40px;object-fit:cover;border-radius:6px;border:1px solid #e5eaf0">
                @else
                <div style="width:60px;height:40px;background:#f8fafc;border-radius:6px;border:1px dashed #cbd5e1;display:flex;align-items:center;justify-content:center;color:#94a3b8;font-size:16px"><i class="bi bi-image"></i></div>
                @endif
            </td>
            <td class="fw-semibold">{{ $f->nama }}</td>
            <td><span class="badge bg-light text-dark border">{{ $f->kategori->nama ?? '-' }}</span></td>
            <td>
                <form method="POST" action="{{ route('admin.fasilitas.toggle', $f->id) }}">@csrf @method('PATCH')
                    <button type="submit" class="badge border-0 bg-{{ $f->is_active ? 'success' : 'secondary' }}" style="cursor:pointer;font-size:11px;padding:5px 10px">
                        {{ $f->is_active ? 'Aktif' : 'Nonaktif' }}
                    </button>
                </form>
            </td>
            <td>
                @if($f->tampil_di_navbar)
                    <span class="badge bg-primary" style="font-size:11px;padding:5px 10px"><i class="bi bi-layout-text-sidebar-reverse me-1"></i>Navbar</span>
                @else
                    <span class="badge bg-light text-secondary border" style="font-size:11px;padding:5px 10px">Tersembunyi</span>
                @endif
            </td>
            <td>
                <a href="{{ route('admin.fasilitas.edit', $f->id) }}" class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil"></i></a>
                <form method="POST" action="{{ route('admin.fasilitas.destroy', $f->id) }}" class="d-inline" onsubmit="return confirm('Hapus fasilitas ini?')">@csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="8" class="text-center py-4 text-muted">Belum ada fasilitas</td></tr>
        @endforelse
        </tbody>
    </table>
    <div class="p-3">{{ $fasilitas->links() }}</div>
</div>

@push('scripts')
<script>
const checkAll  = document.getElementById('checkAll');
const bulkBar   = document.getElementById('bulkBar');
const bulkCount = document.getElementById('bulkCount');
const rows      = document.querySelectorAll('.row-check');
const clearBtn  = document.getElementById('clearSelect');

function getCheckedIds() {
    return Array.from(document.querySelectorAll('.row-check:checked')).map(el => el.dataset.id);
}

function updateBulkBar() {
    const checked = getCheckedIds().length;
    if (checked > 0) {
        bulkBar.classList.remove('d-none');
        bulkBar.classList.add('d-flex');
        bulkCount.textContent = checked + ' dipilih';
    } else {
        bulkBar.classList.add('d-none');
        bulkBar.classList.remove('d-flex');
    }
    checkAll.indeterminate = checked > 0 && checked < rows.length;
    checkAll.checked = checked === rows.length && rows.length > 0;
}

// Submit bulk action via dynamically created form (menghindari nested form)
function submitBulk(action) {
    const ids = getCheckedIds();
    if (ids.length === 0) return;

    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '{{ route('admin.fasilitas.bulk-navbar') }}';

    const csrf = document.createElement('input');
    csrf.type = 'hidden';
    csrf.name = '_token';
    csrf.value = '{{ csrf_token() }}';
    form.appendChild(csrf);

    const actionInput = document.createElement('input');
    actionInput.type = 'hidden';
    actionInput.name = 'action';
    actionInput.value = action;
    form.appendChild(actionInput);

    ids.forEach(id => {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'ids[]';
        input.value = id;
        form.appendChild(input);
    });

    document.body.appendChild(form);
    form.submit();
}

checkAll.addEventListener('change', () => {
    rows.forEach(r => r.checked = checkAll.checked);
    updateBulkBar();
});
rows.forEach(r => r.addEventListener('change', updateBulkBar));
clearBtn.addEventListener('click', () => {
    rows.forEach(r => r.checked = false);
    checkAll.checked = false;
    updateBulkBar();
});
</script>
@endpush
@endsection
