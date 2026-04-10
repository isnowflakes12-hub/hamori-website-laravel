@extends('layouts.app')
@section('title', 'Kritik dan Saran')
@section('content')
<div class="page-header"><div class="container"><h1 class="page-title">Kritik dan Saran</h1></div></div>
<section class="py-5"><div class="container" style="max-width:700px">
@if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
<div class="contact-form-card">
<h3 class="fw-bold mb-4">Sampaikan Pendapat Anda</h3>
<form action="{{ route('kritik-saran.send') }}" method="POST">
@csrf
<div class="row g-3">
<div class="col-md-6"><label class="form-label">Nama <span class="text-danger">*</span></label>
<input type="text" name="nama" class="form-control" required value="{{ old('nama') }}"></div>
<div class="col-md-6"><label class="form-label">Email</label>
<input type="email" name="email" class="form-control" value="{{ old('email') }}"></div>
<div class="col-md-6"><label class="form-label">Telepon</label>
<input type="text" name="telepon" class="form-control" value="{{ old('telepon') }}"></div>
<div class="col-md-6"><label class="form-label">Kategori <span class="text-danger">*</span></label>
<select name="kategori" class="form-select" required>
<option value="">Pilih kategori...</option>
<option value="kritik" {{ old('kategori')=='kritik'?'selected':'' }}>Kritik</option>
<option value="saran" {{ old('kategori')=='saran'?'selected':'' }}>Saran</option>
<option value="pertanyaan" {{ old('kategori')=='pertanyaan'?'selected':'' }}>Pertanyaan</option>
</select></div>
<div class="col-12"><label class="form-label">Penilaian Layanan</label>
<div class="d-flex gap-2">
@for($i=1;$i<=5;$i++)
<label class="rating-btn"><input type="radio" name="rating" value="{{ $i }}" class="d-none" {{ old('rating')==$i?'checked':'' }}>
<span class="btn btn-outline-warning btn-sm">{{ $i }} <i class="bi bi-star-fill"></i></span></label>
@endfor
</div></div>
<div class="col-12"><label class="form-label">Pesan <span class="text-danger">*</span></label>
<textarea name="pesan" class="form-control" rows="5" required>{{ old('pesan') }}</textarea></div>
<div class="col-12"><button type="submit" class="btn btn-primary px-5">Kirim</button></div>
</div>
</form>
</div>
</div></section>
@endsection
