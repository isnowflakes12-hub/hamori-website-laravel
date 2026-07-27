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
                    <select name="parent_id" class="form-select">
                        <option value="">-- Menu Utama --</option>
                        @foreach($parents as $parent)
                            <option value="{{ $parent->id }}" {{ old('parent_id', $menu->parent_id ?? '') == $parent->id ? 'selected' : '' }}>
                                {{ $parent->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Route Name</label>
                    <input type="text" name="route_name" class="form-control" value="{{ old('route_name', $menu->route_name ?? '') }}" placeholder="e.g., admin.artikel.index">
                    <small class="text-muted">Kosongkan jika menu ini adalah parent kategori.</small>
                </div>

                <div class="col-md-6">
                    <label class="form-label">URL (Opsional)</label>
                    <input type="text" name="url" class="form-control" value="{{ old('url', $menu->url ?? '') }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Icon Class</label>
                    <input type="text" name="icon" class="form-control" value="{{ old('icon', $menu->icon ?? '') }}" placeholder="e.g., bi-newspaper">
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
@endsection