@extends('admin.layouts.app')
@section('title','Profil RS')
@section('page-title','Pengaturan Profil RS')
@section('content')

<div class="page-hd">
    <div>
        <h1 class="page-hd-title">Profil Rumah Sakit</h1>
        <p class="page-hd-sub">Kelola deskripsi, visi, misi, dan logo KARS</p>
    </div>
</div>

<div class="admin-card">
    <form action="{{ route('admin.profil-rs.update') }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="row g-4">
            
            <div class="col-md-12">
                <label class="form-label">Deskripsi RS</label>
                <textarea name="deskripsi" class="form-control" rows="4" required>{{ old('deskripsi', $profil->deskripsi) }}</textarea>
            </div>

            <div class="col-md-6">
                <label class="form-label">Visi</label>
                <textarea name="visi" class="form-control" rows="4" required>{{ old('visi', $profil->visi) }}</textarea>
            </div>

            <div class="col-md-6">
                <label class="form-label">Misi (Pisahkan tiap poin dengan enter)</label>
                <textarea name="misi" class="form-control" rows="4" required>{{ old('misi', $profil->misi) }}</textarea>
            </div>

            <div class="col-md-4">
                <label class="form-label">Total Dokter Spesialis</label>
                <input type="text" name="total_dokter" class="form-control" value="{{ old('total_dokter', $profil->total_dokter) }}" placeholder="Contoh: 32+">
            </div>

            <div class="col-md-4">
                <label class="form-label">Total Tempat Tidur</label>
                <input type="text" name="total_bed" class="form-control" value="{{ old('total_bed', $profil->total_bed) }}" placeholder="Contoh: 100+">
            </div>

            <div class="col-md-4">
                <label class="form-label">Pusat Unggulan</label>
                <input type="text" name="pusat_unggulan" class="form-control" value="{{ old('pusat_unggulan', $profil->pusat_unggulan) }}" placeholder="Contoh: 10+">
            </div>

            <div class="col-md-6">
                <label class="form-label">Gambar Utama (Opsional)</label>
                @if($profil->gambar_utama)
                    <div class="mb-2">
                        <img src="{{ asset('storage/'.$profil->gambar_utama) }}" alt="Gambar Utama" style="height:80px;object-fit:cover;border-radius:4px">
                    </div>
                @endif
                <input type="file" name="gambar_utama" class="form-control" accept="image/*">
            </div>

            <div class="col-md-6">
                <label class="form-label">Logo KARS (Samping Nama RS)</label>
                @if($profil->kars_logo)
                    <div class="mb-2">
                        <img src="{{ asset('storage/'.$profil->kars_logo) }}" alt="KARS Logo" style="height:80px;object-fit:contain;background:#f8f9fa;padding:5px;border-radius:4px">
                    </div>
                @endif
                <input type="file" name="kars_logo" class="form-control" accept="image/*">
            </div>

            <div class="col-12 mt-4 text-end">
                <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save me-2"></i>Simpan Perubahan</button>
            </div>
        </div>
    </form>
</div>

@endsection
