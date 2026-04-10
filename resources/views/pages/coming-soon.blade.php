@extends('layouts.app')
@section('title', 'Segera Hadir')
@section('content')
<div class="d-flex align-items-center justify-content-center" style="min-height: 70vh;">
    <div class="text-center">
        <i class="bi bi-hourglass-split display-1 text-primary mb-4 d-block"></i>
        <h1 class="display-5 fw-bold">Segera Hadir</h1>
        <p class="lead text-muted mb-4">Fitur ini sedang dalam pengembangan. Pantau terus untuk updatenya!</p>
        <a href="{{ route('home') }}" class="btn btn-primary">
            <i class="bi bi-house me-2"></i> Kembali ke Beranda
        </a>
    </div>
</div>
@endsection
