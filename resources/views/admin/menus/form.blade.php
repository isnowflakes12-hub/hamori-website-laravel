@extends('admin.layouts.app')

@section('title', isset($menu) ? 'Edit Menu' : 'Tambah Menu')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-0">{{ isset($menu) ? 'Edit Menu' : 'Tambah Menu' }}</h4>
    <a href="{{ route('admin.menus.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <form action="{{ isset($menu) ? route('admin.menus.update', $menu) : route('admin.menus.store') }}" method="POST">
            @csrf
            @if(isset($menu)) @method('PUT') @endif

            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label">Nama Menu <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $menu->name ?? '') }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Parent Menu</label>
                    @php
                        $oldParentId = old('parent_id', $menu->parent_id ?? '');
                        $parentLabel = '-- Menu Utama --';
                        if ($oldParentId) {
                            $selParent = $parents->firstWhere('id', $oldParentId);
                            if ($selParent) $parentLabel = $selParent->name;
                        }
                    @endphp
                    <div class="custom-dropdown-wrapper">
                        <input type="hidden" name="parent_id" value="{{ $oldParentId }}">
                        <div class="custom-dropdown-trigger">
                            <span class="custom-dropdown-label">{{ $parentLabel }}</span>
                            <i class="bi bi-chevron-down custom-dropdown-arrow"></i>
                        </div>
                        <ul class="custom-dropdown-options-container">
                            <li class="custom-dropdown-option {{ $oldParentId == '' ? 'active' : '' }}" data-value="">-- Menu Utama --</li>
                            @foreach($parents as $parent)
                                <li class="custom-dropdown-option {{ $oldParentId == $parent->id ? 'active' : '' }}" data-value="{{ $parent->id }}">
                                    {{ $parent->name }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Route Name</label>
                    <input type="text" name="route_name" class="form-control" list="routeList" value="{{ old('route_name', $menu->route_name ?? '') }}" placeholder="e.g., admin.artikel.index" autocomplete="off">
                    <datalist id="routeList">
                        @foreach($routes ?? [] as $route)
                            <option value="{{ $route }}"></option>
                        @endforeach
                    </datalist>
                    <small class="text-muted">Kosongkan jika menu ini adalah parent kategori.</small>
                </div>

                <div class="col-md-6">
                    <label class="form-label">URL (Opsional)</label>
                    <input type="text" name="url" class="form-control" value="{{ old('url', $menu->url ?? '') }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Icon Class</label>
                    <div class="input-group">
                        <span class="input-group-text" id="iconPreview" style="min-width: 45px; justify-content: center;">
                            <i class="{{ old('icon', $menu->icon ?? 'bi-app') }}"></i>
                        </span>
                        <input type="text" name="icon" id="iconInput" class="form-control" value="{{ old('icon', $menu->icon ?? '') }}" placeholder="e.g., bi-newspaper" oninput="document.getElementById('iconPreview').innerHTML = '<i class=\'' + this.value + '\'></i>'">
                        <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#iconModal">Pilih Icon</button>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Urutan (Order)</label>
                    <input type="number" name="order" class="form-control" value="{{ old('order', $menu->order ?? 0) }}">
                </div>

                <div class="col-md-12">
                    <label class="form-label d-block">Hak Akses (Roles)</label>
                    @php $currentRoles = old('roles', isset($menu) ? $menu->roles : []); @endphp
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="roles[]" value="super_admin" id="role1" {{ in_array('super_admin', $currentRoles) ? 'checked' : '' }}>
                        <label class="form-check-label" for="role1">Super Admin</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="roles[]" value="admin_marketing" id="role2" {{ in_array('admin_marketing', $currentRoles) ? 'checked' : '' }}>
                        <label class="form-check-label" for="role2">Admin Marketing</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="roles[]" value="admin_sdm" id="role3" {{ in_array('admin_sdm', $currentRoles) ? 'checked' : '' }}>
                        <label class="form-check-label" for="role3">Admin SDM</label>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-check form-switch mt-2">
                        <input class="form-check-input" type="checkbox" name="is_active" id="isActive" {{ old('is_active', $menu->is_active ?? true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="isActive">Menu Aktif</label>
                    </div>
                </div>
            </div>

            <hr class="my-4">
            <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Simpan Menu</button>
        </form>
    </div>
</div>

<!-- Modal Pilih Icon -->
<div class="modal fade" id="iconModal" tabindex="-1" aria-labelledby="iconModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="iconModalLabel">Pilih Icon Bootstrap</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @php
                $commonIcons = [
                    'bi-house', 'bi-house-door', 'bi-speedometer2', 'bi-people', 'bi-person', 'bi-box', 'bi-gear',
                    'bi-file-earmark-text', 'bi-card-list', 'bi-newspaper', 'bi-images', 'bi-chat-dots',
                    'bi-envelope', 'bi-bell', 'bi-calendar', 'bi-camera', 'bi-cart', 'bi-clipboard',
                    'bi-clock', 'bi-cloud', 'bi-display', 'bi-folder', 'bi-geo-alt', 'bi-journal',
                    'bi-heart', 'bi-info-circle', 'bi-laptop', 'bi-list', 'bi-lock', 'bi-map',
                    'bi-music-note', 'bi-palette', 'bi-pen', 'bi-phone', 'bi-pie-chart', 'bi-plug',
                    'bi-printer', 'bi-puzzle', 'bi-question-circle', 'bi-receipt', 'bi-search',
                    'bi-shield', 'bi-shop', 'bi-star', 'bi-tag', 'bi-telephone', 'bi-trash',
                    'bi-truck', 'bi-tv', 'bi-umbrella', 'bi-unlock', 'bi-wallet', 'bi-wifi', 'bi-wrench',
                    'bi-hospital', 'bi-capsule', 'bi-heart-pulse', 'bi-activity', 'bi-clipboard-pulse',
                    'bi-journal-medical', 'bi-file-medical', 'bi-thermometer', 'bi-bandaid', 'bi-prescription2',
                    'bi-menu-button-wide', 'bi-grid', 'bi-layout-sidebar', 'bi-layers', 'bi-collection'
                ];
                @endphp
                <div class="row g-2">
                    @foreach($commonIcons as $ic)
                    <div class="col-2 col-md-1 text-center">
                        <button type="button" class="btn btn-outline-secondary w-100 p-2" onclick="selectIcon('{{ $ic }}')" title="{{ $ic }}">
                            <i class="{{ $ic }} fs-4"></i>
                        </button>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function selectIcon(iconClass) {
    document.getElementById('iconInput').value = iconClass;
    document.getElementById('iconPreview').innerHTML = '<i class="' + iconClass + '"></i>';
    var modalEl = document.getElementById('iconModal');
    var modal = bootstrap.Modal.getInstance(modalEl);
    modal.hide();
}
</script>

@endsection