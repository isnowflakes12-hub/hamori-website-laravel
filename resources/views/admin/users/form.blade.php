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
            <select name="role" class="form-select" required>
                <option value="admin_marketing" {{ old('role', $user->role ?? '') == 'admin_marketing' ? 'selected' : '' }}>Admin Marketing</option>
                <option value="admin_sdm" {{ old('role', $user->role ?? '') == 'admin_sdm' ? 'selected' : '' }}>Admin SDM</option>
                <option value="super_admin" {{ old('role', $user->role ?? '') == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
            </select>
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