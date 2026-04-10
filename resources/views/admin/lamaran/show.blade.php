@extends('admin.layouts.app')
@section('title','Detail Lamaran')
@section('page-title','Detail Lamaran')
@section('content')
<div class="page-hd">
    <div><h1 class="page-hd-title">Detail Lamaran</h1></div>
    <a href="{{ route('admin.lamaran.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
</div>
<div class="row g-4">
    <div class="col-lg-8">
        <div class="form-card mb-4">
            <h6 class="fw-bold mb-4" style="font-size:15px;border-bottom:1px solid #e5eaf0;padding-bottom:12px">Data Pelamar</h6>
            <div class="row g-3">
                <div class="col-md-6"><div style="font-size:12px;color:#64748b;font-weight:700;margin-bottom:3px">NAMA LENGKAP</div><div class="fw-semibold">{{ $lamaran->nama }}</div></div>
                <div class="col-md-6"><div style="font-size:12px;color:#64748b;font-weight:700;margin-bottom:3px">EMAIL</div><div>{{ $lamaran->email }}</div></div>
                <div class="col-md-6"><div style="font-size:12px;color:#64748b;font-weight:700;margin-bottom:3px">TELEPON</div><div>{{ $lamaran->telepon }}</div></div>
                <div class="col-md-6"><div style="font-size:12px;color:#64748b;font-weight:700;margin-bottom:3px">POSISI DILAMAR</div><div class="fw-semibold text-primary">{{ $lamaran->karir->posisi ?? '—' }}</div></div>
                <div class="col-md-6"><div style="font-size:12px;color:#64748b;font-weight:700;margin-bottom:3px">KATEGORI</div><div>{{ $lamaran->karir->kategori ?? '—' }}</div></div>
                <div class="col-md-6"><div style="font-size:12px;color:#64748b;font-weight:700;margin-bottom:3px">TANGGAL LAMAR</div><div>{{ $lamaran->created_at->format('d M Y, H:i') }}</div></div>
            </div>
            @if($lamaran->cover_letter)
            <div class="mt-4">
                <div style="font-size:12px;color:#64748b;font-weight:700;margin-bottom:6px">COVER LETTER</div>
                <div style="background:#f8fafc;border-radius:10px;padding:16px;font-size:14px;line-height:1.7;white-space:pre-wrap">{{ $lamaran->cover_letter }}</div>
            </div>
            @endif
            <div class="mt-4">
                <a href="{{ asset('storage/'.$lamaran->cv) }}" target="_blank" class="btn btn-primary"><i class="bi bi-file-pdf me-2"></i>Download CV</a>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-card">
            <h6 class="fw-bold mb-3" style="font-size:15px">Update Status</h6>
            <div class="mb-3 text-center">
                <span class="badge bg-{{ $lamaran->status_color }}" style="font-size:13px;padding:8px 16px">{{ $lamaran->status_label }}</span>
            </div>
            <form method="POST" action="{{ route('admin.lamaran.status', $lamaran) }}">
                @csrf @method('PATCH')
                <div class="mb-3">
                    <label class="form-label">Status Baru</label>
                    <select name="status" class="form-select">
                        @foreach(['pending'=>'Menunggu','review'=>'Sedang Direview','shortlist'=>'Shortlist','interview'=>'Interview','diterima'=>'Diterima','ditolak'=>'Tidak Lolos'] as $v=>$l)
                        <option value="{{ $v }}" {{ $lamaran->status == $v ? 'selected' : '' }}>{{ $l }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Catatan Internal</label>
                    <textarea name="catatan" class="form-control" rows="3" placeholder="Catatan untuk tim HR...">{{ $lamaran->catatan }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100"><i class="bi bi-check2 me-2"></i>Simpan Status</button>
            </form>
        </div>
    </div>
</div>
@endsection