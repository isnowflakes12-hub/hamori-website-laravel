@extends('admin.layouts.app')
@section('title', ($dokter ? 'Edit' : 'Tambah') . ' Dokter')
@section('page-title', 'Dokter & Jadwal')

@section('content')

<div class="page-hd">
    <div>
        <a href="{{ route('admin.dokter.index') }}" class="btn btn-sm btn-outline-secondary mb-2">
            <i class="bi bi-arrow-left me-1"></i>Kembali
        </a>
        <h1 class="page-hd-title">{{ $dokter ? 'Edit Dokter' : 'Tambah Dokter' }}</h1>
    </div>
</div>

<div class="row g-4">
    {{-- FORM --}}
    <div class="col-lg-7">
        <div class="card" style="border-radius:16px;border:1px solid #e5eaf0;">
            <div class="card-body p-4">
                <form action="{{ $dokter ? route('admin.dokter.update', $dokter) : route('admin.dokter.store') }}"
                      method="POST" enctype="multipart/form-data">
                    @csrf
                    @if($dokter) @method('PUT') @endif

                    @if($errors->any())
                    <div class="alert alert-danger alert-dismissible mb-4">
                        <i class="bi bi-exclamation-circle me-2"></i>
                        <ul class="mb-0 ps-3">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    {{-- NAMA --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Nama <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                            value="{{ old('nama', $dokter?->nama) }}" placeholder="Contoh: Ahmad Fauzi" required>
                        @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-5">
                            <label class="form-label fw-semibold">Gelar Depan</label>
                            <input type="text" name="gelar_depan" class="form-control"
                                value="{{ old('gelar_depan', $dokter?->gelar_depan) }}" placeholder="dr. / drg. / Prof.">
                        </div>
                        <div class="col-md-7">
                            <label class="form-label fw-semibold">Gelar Belakang</label>
                            <input type="text" name="gelar_belakang" class="form-control"
                                value="{{ old('gelar_belakang', $dokter?->gelar_belakang) }}" placeholder="Sp.PD / Sp.A / dll.">
                        </div>
                    </div>

                    {{-- POLI --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Poli / Spesialis</label>
                        <select name="poli_id" class="form-select">
                            <option value="">-- Pilih Poli --</option>
                            @foreach($polis as $poli)
                            <option value="{{ $poli->id }}" {{ old('poli_id', $dokter?->poli_id) == $poli->id ? 'selected' : '' }}>{{ $poli->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- FOTO --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Foto Dokter</label>
                        @if($dokter && $dokter->foto)
                        <div class="mb-2 d-flex align-items-center gap-3">
                            <img src="{{ asset('storage/'.$dokter->foto) }}" alt="Foto"
                                style="width:70px;height:88px;object-fit:cover;object-position:top;border-radius:10px;border:1px solid #e5eaf0;">
                            <div>
                                <div class="text-muted" style="font-size:12px;">Foto saat ini</div>
                                <label class="d-flex align-items-center gap-2 mt-1" style="cursor:pointer;">
                                    <input type="checkbox" name="hapus_foto" value="1" class="form-check-input m-0">
                                    <span style="font-size:13px;color:#e8333c;">Hapus foto ini</span>
                                </label>
                            </div>
                        </div>
                        @endif
                        <input type="file" name="foto" id="foto-input" class="form-control @error('foto') is-invalid @enderror"
                            accept="image/*" onchange="previewFoto(this)">
                        <div class="form-text">Format JPG/PNG/WEBP, maks. 4MB. Otomatis dikompresi ke WebP.</div>
                        @error('foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <div id="foto-preview" class="mt-2" style="display:none;">
                            <img id="foto-preview-img" style="width:80px;height:100px;object-fit:cover;border-radius:10px;border:2px solid #0055a5;">
                        </div>
                    </div>

                    {{-- STATUS --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Status Tampil di Website</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
                                {{ old('is_active', $dokter?->is_active ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Tampilkan di halaman Jadwal Dokter</label>
                        </div>
                    </div>

                    {{-- BIO --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Bio / Tentang</label>
                        <textarea name="bio" class="form-control" rows="4"
                            placeholder="Deskripsi singkat tentang dokter...">{{ old('bio', $dokter?->bio) }}</textarea>
                    </div>

                    {{-- PENDIDIKAN --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Riwayat Pendidikan</label>
                        <textarea name="pendidikan" class="form-control" rows="3"
                            placeholder="Contoh: S1 Kedokteran UI, Sp.PD FKUI...">{{ old('pendidikan', $dokter?->pendidikan) }}</textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-save me-2"></i>{{ $dokter ? 'Simpan Perubahan' : 'Tambah Dokter' }}
                        </button>
                        <a href="{{ route('admin.dokter.index') }}" class="btn btn-outline-secondary px-4">Batal</a>
                    </div>

                </form>
            </div>
        </div>
    </div>

    {{-- SIDEBAR: INFO JADWAL --}}
    <div class="col-lg-5">
        @if($dokter && $dokter->jadwal->count())
        <div class="card" style="border-radius:16px;border:1px solid #e5eaf0;">
            <div class="card-header" style="background:#f8fafc;border-bottom:1px solid #e5eaf0;border-radius:16px 16px 0 0;padding:16px 20px;">
                <h6 class="mb-0 fw-bold"><i class="bi bi-calendar3-fill me-2 text-primary"></i>Jadwal Praktek (dari Teramedik)</h6>
            </div>
            <div class="card-body p-0">
                @foreach($dokter->jadwal->sortBy(fn($j) => ['Senin'=>1,'Selasa'=>2,'Rabu'=>3,'Kamis'=>4,'Jumat'=>5,'Sabtu'=>6,'Minggu'=>7][$j->hari] ?? 8) as $jadwal)
                <div class="d-flex align-items-center justify-content-between px-4 py-3" style="border-bottom:1px solid #f0f0f0;">
                    <span style="font-weight:600;color:#1a202c;font-size:13.5px;">{{ $jadwal->hari }}</span>
                    <span style="color:#64748b;font-size:13px;">{{ substr($jadwal->jam_mulai,0,5) }} – {{ substr($jadwal->jam_selesai,0,5) }}</span>
                </div>
                @endforeach
            </div>
            <div class="card-footer text-muted" style="font-size:12px;background:#f8fafc;border-radius:0 0 16px 16px;">
                <i class="bi bi-info-circle me-1"></i>Jadwal dikelola otomatis oleh Teramedik, tidak dapat diedit manual.
            </div>
        </div>
        @elseif($dokter)
        <div class="card" style="border-radius:16px;border:1px solid #e5eaf0;">
            <div class="card-body text-center py-4 text-muted">
                <i class="bi bi-calendar-x display-6 d-block mb-2"></i>
                Belum ada jadwal praktek terdaftar.
            </div>
        </div>
        @else
        <div class="card" style="border-radius:16px;border:1px solid #e5eaf0;">
            <div class="card-body py-4">
                <h6 class="fw-bold mb-3"><i class="bi bi-lightbulb-fill text-warning me-2"></i>Tips</h6>
                <ul class="text-muted mb-0" style="font-size:13px;line-height:1.8;">
                    <li>Gunakan tombol <strong>Sync Teramedik</strong> untuk import data jadwal otomatis.</li>
                    <li>Foto akan otomatis dikompresi ke format WebP.</li>
                    <li>Toggle tampil/sembunyikan bisa dilakukan langsung dari halaman daftar.</li>
                </ul>
            </div>
        </div>
        @endif
    </div>
</div>

<script>
function previewFoto(input) {
    const preview = document.getElementById('foto-preview');
    const img = document.getElementById('foto-preview-img');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { img.src = e.target.result; preview.style.display = 'block'; };
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.style.display = 'none';
    }
}
</script>

@endsection