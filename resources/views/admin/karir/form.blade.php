@extends('admin.layouts.app')
@section('title', $karir ? 'Edit Lowongan' : 'Tambah Lowongan')
@section('page-title', $karir ? 'Edit Lowongan' : 'Tambah Lowongan Baru')
@section('content')
<div class="page-hd">
    <div><h1 class="page-hd-title">{{ $karir ? "Edit Lowongan" : "Tambah Lowongan Baru" }}</h1></div>
    <a href="{{ route('admin.karir.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
</div>
<form method="POST" action="{{ $karir ? route('admin.karir.update', $karir) : route('admin.karir.store') }}">
@csrf @if($karir) @method('PUT') @endif
<div class="row g-4">
    <div class="col-lg-8">
        <div class="form-card">
            <div class="row g-3 mb-3">
                <div class="col-md-8">
                    <label class="form-label">Nama Posisi <span class="text-danger">*</span></label>
                    <input type="text" name="posisi" class="form-control" value="{{ old('posisi', $karir->posisi ?? '') }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Kuota <span class="text-danger">*</span></label>
                    <input type="number" name="kuota" class="form-control" value="{{ old('kuota', $karir->kuota ?? 1) }}" min="1" required>
                </div>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Departemen <span class="text-danger">*</span></label>
                    <input type="text" name="departemen" class="form-control" value="{{ old('departemen', $karir->departemen ?? '') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Lokasi</label>
                    <input type="text" name="lokasi" class="form-control" value="{{ old('lokasi', $karir->lokasi ?? 'Subang, Jawa Barat') }}">
                </div>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Kategori <span class="text-danger">*</span></label>
                    @php
                        $oldKategori = old('kategori', $karir->kategori ?? '');
                    @endphp
                    <div class="custom-dropdown-wrapper">
                        <input type="hidden" name="kategori" value="{{ $oldKategori }}" required>
                        <div class="custom-dropdown-trigger">
                            <span class="custom-dropdown-label">{{ $oldKategori ?: 'Pilih Kategori' }}</span>
                            <i class="bi bi-chevron-down custom-dropdown-arrow"></i>
                        </div>
                        <ul class="custom-dropdown-options-container">
                            <li class="custom-dropdown-option {{ $oldKategori == '' ? 'active' : '' }}" data-value="">Pilih Kategori</li>
                            @foreach($kategoris as $kat)
                                <li class="custom-dropdown-option {{ $oldKategori == $kat->nama ? 'active' : '' }}" data-value="{{ $kat->nama }}">{{ $kat->nama }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tipe Pekerjaan <span class="text-danger">*</span></label>
                    @php
                        $oldTipe = old('tipe', $karir->tipe ?? '');
                        $tipeLabel = 'Pilih Tipe Pekerjaan';
                        if ($oldTipe) {
                            $selT = $tipes->firstWhere('slug', $oldTipe);
                            $tipeLabel = $selT ? $selT->nama : $oldTipe;
                        }
                    @endphp
                    <div class="custom-dropdown-wrapper">
                        <input type="hidden" name="tipe" value="{{ $oldTipe }}" required>
                        <div class="custom-dropdown-trigger">
                            <span class="custom-dropdown-label">{{ $tipeLabel }}</span>
                            <i class="bi bi-chevron-down custom-dropdown-arrow"></i>
                        </div>
                        <ul class="custom-dropdown-options-container">
                            <li class="custom-dropdown-option {{ $oldTipe == '' ? 'active' : '' }}" data-value="">Pilih Tipe Pekerjaan</li>
                            @foreach($tipes as $t)
                                <li class="custom-dropdown-option {{ $oldTipe == $t->slug ? 'active' : '' }}" data-value="{{ $t->slug }}">{{ $t->nama }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi Pekerjaan <span class="text-danger">*</span></label>
                <textarea name="deskripsi" class="form-control" rows="5" required>{{ old('deskripsi', $karir->deskripsi ?? '') }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Persyaratan <span class="text-danger">*</span></label>
                <textarea name="persyaratan" class="form-control" rows="5" required placeholder="- S1 Keperawatan&#10;- STR aktif&#10;- Pengalaman min. 1 tahun">{{ old('persyaratan', $karir->persyaratan ?? '') }}</textarea>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-card mb-4">
            <h6 class="fw-bold mb-3">Pengaturan</h6>
            <div class="mb-3">
                <label class="form-label">Batas Lamaran</label>
                <input type="date" name="batas_lamaran" class="form-control" value="{{ old('batas_lamaran', optional($karir->batas_lamaran ?? null)->format('Y-m-d')) }}">
            </div>
            {{-- Toggle Slider Status --}}
            @php $isActiveVal = old('is_active', $karir->is_active ?? true); @endphp
            <div class="mb-3">
                <label class="form-label fw-semibold d-block mb-2">Status Lowongan</label>
                <input type="hidden" name="is_active" id="isActiveHidden" value="{{ $isActiveVal ? '1' : '0' }}">
                <div class="d-flex align-items-center gap-3">
                    <div class="toggle-switch" id="toggleSwitch" onclick="toggleStatus()" style="cursor:pointer; position:relative; width:56px; height:28px; border-radius:14px; background:{{ $isActiveVal ? '#1ba99d' : '#cbd5e1' }}; transition:background 0.3s ease; flex-shrink:0;">
                        <div id="toggleKnob" style="position:absolute; top:3px; left:{{ $isActiveVal ? '31px' : '3px' }}; width:22px; height:22px; border-radius:50%; background:#fff; box-shadow:0 2px 6px rgba(0,0,0,0.18); transition:left 0.3s ease;"></div>
                    </div>
                    <span id="toggleLabel" class="fw-semibold" style="font-size:14px; color:{{ $isActiveVal ? '#1ba99d' : '#94a3b8' }};">
                        {{ $isActiveVal ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </div>
                <p class="text-muted mt-1 mb-0" style="font-size:12px;">Aktifkan agar lowongan tampil di halaman karir publik.</p>
            </div>
            <script>
            function toggleStatus() {
                const hidden = document.getElementById('isActiveHidden');
                const sw = document.getElementById('toggleSwitch');
                const knob = document.getElementById('toggleKnob');
                const lbl = document.getElementById('toggleLabel');
                const isNowActive = hidden.value !== '1';
                hidden.value = isNowActive ? '1' : '0';
                sw.style.background = isNowActive ? '#1ba99d' : '#cbd5e1';
                knob.style.left = isNowActive ? '31px' : '3px';
                lbl.textContent = isNowActive ? 'Aktif' : 'Nonaktif';
                lbl.style.color = isNowActive ? '#1ba99d' : '#94a3b8';
            }
            </script>
            <button type="submit" class="btn btn-primary w-100"><i class="bi bi-save me-2"></i>{{ $karir ? 'Simpan' : 'Tambah Lowongan' }}</button>
        </div>
    </div>
</div>
</form>
@endsection