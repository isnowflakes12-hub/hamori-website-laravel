@extends('admin.layouts.app')
@section('title','Lowongan Kerja')
@section('page-title','Manajemen Lowongan Kerja')
@section('content')
<div class="page-hd">
    <div><h1 class="page-hd-title">Lowongan Kerja</h1><p class="page-hd-sub">Kelola rekrutmen dan lowongan kerja</p></div>
    <a href="{{ route('admin.karir.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-2"></i>Tambah Lowongan</a>
</div>
<div class="filter-bar mb-4">
<form method="GET" class="d-flex gap-2 align-items-center w-100" style="flex-wrap:nowrap;">
        <input type="text" name="search" class="form-control" style="flex:1 1 0; min-width:0;" placeholder="Cari posisi..." value="{{ request('search') }}">
        
        @php
            $reqKategori = request('kategori');
            $katLabel = 'Semua Kategori';
            if ($reqKategori) $katLabel = $reqKategori;
        @endphp
        <div class="custom-dropdown-wrapper flex-shrink-0" style="width:180px">
            <input type="hidden" name="kategori" value="{{ $reqKategori }}">
            <div class="custom-dropdown-trigger">
                <span class="custom-dropdown-label">{{ $katLabel }}</span>
                <i class="bi bi-chevron-down custom-dropdown-arrow"></i>
            </div>
            <ul class="custom-dropdown-options-container">
                <li class="custom-dropdown-option {{ $reqKategori == '' ? 'active' : '' }}" data-value="">Semua Kategori</li>
                @foreach($kategoriList as $k)
                <li class="custom-dropdown-option {{ $reqKategori == $k ? 'active' : '' }}" data-value="{{ $k }}">{{ $k }}</li>
                @endforeach
            </ul>
        </div>

        @php
            $reqStatus = request('status');
            $statLabel = 'Semua Status';
            if ($reqStatus == 'aktif') $statLabel = 'Aktif';
            elseif ($reqStatus == 'nonaktif') $statLabel = 'Nonaktif';
        @endphp
        <div class="custom-dropdown-wrapper flex-shrink-0" style="width:140px">
            <input type="hidden" name="status" value="{{ $reqStatus }}">
            <div class="custom-dropdown-trigger">
                <span class="custom-dropdown-label">{{ $statLabel }}</span>
                <i class="bi bi-chevron-down custom-dropdown-arrow"></i>
            </div>
            <ul class="custom-dropdown-options-container">
                <li class="custom-dropdown-option {{ $reqStatus == '' ? 'active' : '' }}" data-value="">Semua Status</li>
                <li class="custom-dropdown-option {{ $reqStatus == 'aktif' ? 'active' : '' }}" data-value="aktif">Aktif</li>
                <li class="custom-dropdown-option {{ $reqStatus == 'nonaktif' ? 'active' : '' }}" data-value="nonaktif">Nonaktif</li>
            </ul>
        </div>
        
        <button class="btn btn-primary flex-shrink-0" type="submit">Filter</button>
        @if(request()->hasAny(['search','kategori','status']))<a href="{{ route('admin.karir.index') }}" class="btn btn-outline-secondary flex-shrink-0">Reset</a>@endif
    </form>
</div>
<div id="bulkActionContainer" data-url="{{ route('admin.karir.bulk-toggle') }}" data-csrf="{{ csrf_token() }}">
<div class="d-flex justify-content-between align-items-center mb-2">
    <div class="d-flex align-items-center gap-3">
        <div class="form-check mb-0">
            <input type="checkbox" id="checkAllTop" class="form-check-input">
            <label class="form-check-label" for="checkAllTop" style="font-size: 14px;">Pilih Semua</label>
        </div>
        
        <div class="d-flex align-items-center gap-2">
            <div class="custom-dropdown-wrapper" style="width:180px;">
                <input type="hidden" name="action" id="bulkActionInput" required>
                <div class="custom-dropdown-trigger py-1 px-2" style="font-size:13px; min-height:32px;">
                    <span class="custom-dropdown-label">-- Pilih Aksi Bulk --</span>
                    <i class="bi bi-chevron-down custom-dropdown-arrow"></i>
                </div>
                <ul class="custom-dropdown-options-container">
                    <li class="custom-dropdown-option active" data-value="">-- Pilih Aksi Bulk --</li>
                    <li class="custom-dropdown-option" data-value="aktif">Set Aktif</li>
                    <li class="custom-dropdown-option" data-value="nonaktif">Set Nonaktif</li>
                </ul>
            </div>
            <button type="button" class="btn btn-primary" style="height: 32px; padding: 0 16px; font-size: 13px;" id="btnApplyBulk" disabled>Terapkan</button>
        </div>
    </div>
</div>
<div class="admin-table">
    <table class="table">
        <thead>
            <tr>
                <th style="width: 40px"><input type="checkbox" id="checkAll" class="form-check-input"></th>
                <th>Posisi</th>
                <th>Departemen</th>
                <th>Kategori</th>
                <th>Tipe</th>
                <th>Kuota</th>
                <th>Lamaran</th>
                <th>Deadline</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @forelse($karirs as $k)
        @php $deadline = $k->batas_lamaran; $isExpired = $deadline && $deadline->isPast(); @endphp
        <tr>
            <td><input type="checkbox" name="ids[]" value="{{ $k->id }}" class="form-check-input check-item"></td>
            <td class="fw-semibold">{{ $k->posisi }}</td>
            <td style="font-size:12px;color:#64748b">{{ $k->departemen }}</td>
            <td><span class="badge" style="background:#e8f0fa;color:#0055a5;font-size:11px">{{ $k->kategori }}</span></td>
            <td><span class="badge bg-secondary" style="font-size:11px">{{ ucfirst(str_replace('-',' ',$k->tipe)) }}</span></td>
            <td class="text-center">{{ $k->kuota ?? 1 }}</td>
            <td><a href="{{ route('admin.lamaran.index', ['karir_id' => $k->id]) }}" class="badge bg-primary" style="font-size:11px;text-decoration:none">{{ $k->lamarans_count }}</a></td>
            <td style="font-size:12px;color:{{ $isExpired ? '#e8333c' : '#64748b' }}">{{ $deadline ? $deadline->format('d M Y') : '—' }}</td>
            <td>
                <form method="POST" action="{{ route('admin.karir.toggle', $k) }}" style="display:inline">@csrf @method('PATCH')
                    <button type="submit" class="border-0 bg-transparent p-0" title="{{ $k->is_active ? 'Klik untuk nonaktifkan' : 'Klik untuk aktifkan' }}">
                        <div style="position:relative; width:46px; height:24px; border-radius:12px; background:{{ $k->is_active ? '#1ba99d' : '#cbd5e1' }}; transition:background 0.3s; cursor:pointer; display:inline-block;">
                            <div style="position:absolute; top:3px; left:{{ $k->is_active ? '25px' : '3px' }}; width:18px; height:18px; border-radius:50%; background:#fff; box-shadow:0 1px 4px rgba(0,0,0,0.2); transition:left 0.3s;"></div>
                        </div>
                        <span style="font-size:11px; font-weight:600; color:{{ $k->is_active ? '#1ba99d' : '#94a3b8' }}; vertical-align:middle; margin-left:4px;">
                            {{ $k->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </button>
                </form>
            </td>
            <td class="d-flex gap-1">
                <a href="{{ route('admin.karir.edit', $k) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                <form method="POST" action="{{ route('admin.karir.destroy', $k) }}" onsubmit="return confirm('Hapus lowongan ini?')">@csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="10" class="text-center py-4 text-muted">Belum ada lowongan</td></tr>
        @endforelse
        </tbody>
    </table>
    <div class="p-3">{{ $karirs->links() }}</div>
</div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkAll = document.getElementById('checkAll');
    const checkAllTop = document.getElementById('checkAllTop');
    const checkItems = document.querySelectorAll('.check-item');
    const btnApplyBulk = document.getElementById('btnApplyBulk');
    
    function updateBulkState() {
        const anyChecked = Array.from(checkItems).some(cb => cb.checked);
        const allChecked = Array.from(checkItems).every(cb => cb.checked);
        
        btnApplyBulk.disabled = !anyChecked;
        if (checkAll) checkAll.checked = allChecked && checkItems.length > 0;
        if (checkAllTop) checkAllTop.checked = allChecked && checkItems.length > 0;
    }

    if (checkAll) {
        checkAll.addEventListener('change', function() {
            const isChecked = this.checked;
            checkItems.forEach(cb => cb.checked = isChecked);
            if (checkAllTop) checkAllTop.checked = isChecked;
            updateBulkState();
        });
    }
    
    if (checkAllTop) {
        checkAllTop.addEventListener('change', function() {
            const isChecked = this.checked;
            checkItems.forEach(cb => cb.checked = isChecked);
            if (checkAll) checkAll.checked = isChecked;
            updateBulkState();
        });
    }

    checkItems.forEach(cb => {
        cb.addEventListener('change', updateBulkState);
    });

    document.getElementById('btnApplyBulk').addEventListener('click', function(e) {
        const action = document.getElementById('bulkActionInput').value;
        if (!action) {
            alert('Silakan pilih aksi terlebih dahulu.');
            return;
        }
        if (!confirm('Yakin ingin menerapkan aksi ini pada lowongan yang dipilih?')) {
            return;
        }
        
        const checkedItems = Array.from(checkItems).filter(cb => cb.checked).map(cb => cb.value);
        
        const form = document.createElement('form');
        form.method = 'POST';
        const container = document.getElementById('bulkActionContainer');
        form.action = container.getAttribute('data-url');
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = container.getAttribute('data-csrf');
        form.appendChild(csrfToken);
        
        const actionInput = document.createElement('input');
        actionInput.type = 'hidden';
        actionInput.name = 'action';
        actionInput.value = action;
        form.appendChild(actionInput);
        
        checkedItems.forEach(id => {
            const idInput = document.createElement('input');
            idInput.type = 'hidden';
            idInput.name = 'ids[]';
            idInput.value = id;
            form.appendChild(idInput);
        });
        
        document.body.appendChild(form);
        form.submit();
    });
});
</script>
@endpush
@endsection