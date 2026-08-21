@extends('admin.layouts.app')
@section('title', $user ? 'Edit User' : 'Tambah User')
@section('page-title', $user ? 'Edit User Admin' : 'Tambah User Admin Baru')
@section('content')
<div class="page-hd">
    <div><h1 class="page-hd-title">{{ $user ? "Edit User" : "Tambah User Baru" }}</h1></div>
    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
</div>
<div class="row justify-content-center">
<div class="col-lg-7">
<div class="form-card">
    <form method="POST" action="{{ $user ? route('admin.users.update', $user) : route('admin.users.store') }}">
        @csrf @if($user) @method('PUT') @endif
        <div class="mb-3">
            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email <span class="text-danger">*</span></label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Role <span class="text-danger">*</span></label>
            @php
                $oldRole = old('role', $user->role ?? '');
                $roleLabel = 'Pilih Role';
                if ($oldRole == 'admin_marketing') $roleLabel = 'Admin Marketing';
                elseif ($oldRole == 'admin_sdm') $roleLabel = 'Admin SDM';
                elseif ($oldRole == 'super_admin') $roleLabel = 'Super Admin';
            @endphp
            <div class="custom-dropdown-wrapper @error('role') is-invalid @enderror">
                <input type="hidden" name="role" value="{{ $oldRole }}" required>
                <div class="custom-dropdown-trigger">
                    <span class="custom-dropdown-label">{{ $roleLabel }}</span>
                    <i class="bi bi-chevron-down custom-dropdown-arrow"></i>
                </div>
                <ul class="custom-dropdown-options-container">
                    <li class="custom-dropdown-option {{ $oldRole == '' ? 'active' : '' }}" data-value="">Pilih Role</li>
                    <li class="custom-dropdown-option {{ $oldRole == 'admin_marketing' ? 'active' : '' }}" data-value="admin_marketing">Admin Marketing</li>
                    <li class="custom-dropdown-option {{ $oldRole == 'admin_sdm' ? 'active' : '' }}" data-value="admin_sdm">Admin SDM</li>
                    <li class="custom-dropdown-option {{ $oldRole == 'super_admin' ? 'active' : '' }}" data-value="super_admin">Super Admin</li>
                </ul>
            </div>
            @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror

            <div class="form-text">
                <strong>Admin Marketing:</strong> Kelola banner, artikel, layanan, dokter<br>
                <strong>Admin SDM:</strong> Kelola lowongan dan lamaran kerja<br>
                <strong>Super Admin:</strong> Akses penuh ke semua fitur
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Password {{ $user ? '(kosongkan jika tidak diubah)' : '' }} <span class="text-danger">{{ !$user ? '*' : '' }}</span></label>
            <input type="password" name="password" class="form-control" {{ !$user ? 'required' : '' }} minlength="8" placeholder="Min. 8 karakter">
        </div>
        <div class="mb-4">
            <label class="form-label">Konfirmasi Password {{ !$user ? '*' : '' }}</label>
            <input type="password" name="password_confirmation" class="form-control" {{ !$user ? 'required' : '' }} placeholder="Ulangi password">
        </div>
        <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" name="is_active" id="isActive" value="1" {{ old('is_active', $user->is_active ?? true) ? 'checked' : '' }}>
            <label class="form-check-label fw-semibold" for="isActive">Akun aktif</label>
        </div>
        <button type="submit" class="btn btn-primary"><i class="bi bi-save me-2"></i>{{ $user ? 'Simpan Perubahan' : 'Tambah User' }}</button>
    </form>
</div>
</div>
</div>
@endsection