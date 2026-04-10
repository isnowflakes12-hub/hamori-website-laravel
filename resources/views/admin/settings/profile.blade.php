@extends('admin.layouts.app')
@section('title','Profil Saya')
@section('page-title','Profil Saya')
@section('content')
<div class="row justify-content-center">
<div class="col-lg-7">
<div class="form-card">
    <div class="d-flex align-items-center gap-3 mb-4 pb-4" style="border-bottom:1px solid #e5eaf0">
        <div style="width:64px;height:64px;border-radius:50%;background:#0055a5;display:flex;align-items:center;justify-content:center;color:#fff;font-size:26px;font-weight:700;overflow:hidden">
            @if($user->avatar)<img src="{{ asset('storage/'.$user->avatar) }}" style="width:100%;height:100%;object-fit:cover">@else{{ strtoupper(substr($user->name,0,1)) }}@endif
        </div>
        <div>
            <h5 class="fw-bold mb-1">{{ $user->name }}</h5>
            <span class="badge {{ $user->getRoleBadgeClass() }}">{{ $user->getRoleLabel() }}</span>
        </div>
    </div>
    <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Foto Profil</label>
            <input type="file" name="avatar" class="form-control" accept="image/*" onchange="previewAvatar(this)">
            <img id="avatarPreview" class="mt-2 rounded-circle" style="width:64px;height:64px;object-fit:cover;display:none">
        </div>
        <hr class="my-4">
        <h6 class="fw-bold mb-3">Ganti Password</h6>
        <div class="mb-3">
            <label class="form-label">Password Baru</label>
            <input type="password" name="password" class="form-control" minlength="8" placeholder="Min. 8 karakter">
        </div>
        <div class="mb-4">
            <label class="form-label">Konfirmasi Password Baru</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary"><i class="bi bi-save me-2"></i>Simpan Perubahan</button>
    </form>
</div>
</div>
</div>
@endsection
@push('scripts')
<script>
function previewAvatar(input) {
    const p = document.getElementById('avatarPreview');
    if (input.files && input.files[0]) {
        const r = new FileReader();
        r.onload = e => { p.src = e.target.result; p.style.display = 'block'; };
        r.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush