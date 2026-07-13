@extends('admin.layouts.app')
@section('title','Manajemen')
@section('page-title','Manajemen')
@section('content')
<div class="page-hd">
    <div><h1 class="page-hd-title">Manajemen Dokter & Jadwal</h1></div>
    <div class="page-hd-action">
        <form action="{{ route('admin.dokter.sync') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-primary" onclick="return confirm('Mulai sinkronisasi jadwal dengan API Teramedik? Proses ini mungkin memakan waktu beberapa saat.')">
                <i class="bi bi-arrow-repeat me-2"></i>Sync Jadwal Teramedik
            </button>
        </form>
    </div>
</div>
<div class="alert alert-info"><i class="bi bi-info-circle me-2"></i>Halaman ini dalam pengembangan lanjutan.</div>
@endsection