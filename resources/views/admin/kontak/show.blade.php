@extends('admin.layouts.app')
@section('title', 'Detail Pesan Masuk')
@section('page-title', 'Detail Pesan')
@section('content')
<div class="page-hd">
    <div>
        <h1 class="page-hd-title">Detail Pesan</h1>
        <p class="page-hd-sub">Dari: {{ $kontak->nama }}</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.kontak.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
    </div>
</div>

<div class="card border-0 shadow-sm" style="border-radius:16px; overflow:hidden;">
    <div class="card-header bg-white p-4 border-bottom">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-1 fw-bold">{{ $kontak->subjek ?? 'Tanpa Subjek' }}</h5>
                <div class="text-muted" style="font-size:13px"><i class="bi bi-clock"></i> {{ $kontak->created_at->format('d F Y, H:i') }}</div>
            </div>
            <div>
                <span class="badge bg-secondary">Terbaca</span>
            </div>
        </div>
    </div>
    <div class="card-body p-4 bg-light">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="bg-white p-4 rounded-3 border h-100">
                    <h6 class="fw-bold mb-3 border-bottom pb-2">Informasi Pengirim</h6>
                    <div class="mb-3">
                        <label class="text-muted d-block" style="font-size:12px">Nama Lengkap</label>
                        <div class="fw-semibold">{{ $kontak->nama }}</div>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted d-block" style="font-size:12px">Email</label>
                        <div><a href="mailto:{{ $kontak->email }}" class="text-decoration-none">{{ $kontak->email ?? '-' }}</a></div>
                    </div>
                    <div>
                        <label class="text-muted d-block" style="font-size:12px">No. Telepon / WhatsApp</label>
                        @if($kontak->telepon)
                            <div><a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $kontak->telepon) }}" target="_blank" class="text-decoration-none text-success"><i class="bi bi-whatsapp"></i> {{ $kontak->telepon }}</a></div>
                        @else
                            <div>-</div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="bg-white p-4 rounded-3 border h-100">
                    <h6 class="fw-bold mb-3 border-bottom pb-2">Isi Pesan</h6>
                    <div style="white-space: pre-wrap; line-height: 1.8; color: #334155;">{{ $kontak->pesan }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer bg-white p-3 text-end">
        <form method="POST" action="{{ route('admin.kontak.destroy', $kontak) }}" onsubmit="return confirm('Hapus pesan ini secara permanen?')">
            @csrf @method('DELETE')
            <button class="btn btn-outline-danger"><i class="bi bi-trash"></i> Hapus Pesan</button>
        </form>
    </div>
</div>
@endsection
