@extends('layouts.app')
@section('title', 'Kritik & Saran')

@section('content')

<div class="page-header">
    <div class="container">
        <h1 class="page-title">Kritik & Saran</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Kritik & Saran</li>
            </ol>
        </nav>
    </div>
</div>

<section class="ks-section sec">
    <div class="container">
        <div class="ks-wrap">

            <div class="ks-info">

                <span class="eyebrow">Suara Anda Penting</span>
                <h2 class="sec-h2 mt-1">Bantu Kami Menjadi Lebih Baik</h2>
                <p class="ks-info-desc">
                    Setiap kritik dan saran Anda adalah bahan bakar perbaikan kami.
                    Tim manajemen RS Hamori berkomitmen membaca dan menindaklanjuti
                    setiap masukan yang masuk.
                </p>

                <div class="ks-promises">
                    <div class="ks-promise">
                        <div class="ks-promise-ic ks-promise-ic--teal">
                            <i class="fas fa-eye"></i>
                        </div>
                        <div>
                            <h6 class="ks-promise-title">Dibaca Langsung</h6>
                            <p class="ks-promise-desc">Setiap pesan diteruskan ke tim manajemen RS.</p>
                        </div>
                    </div>
                    <div class="ks-promise">
                        <div class="ks-promise-ic ks-promise-ic--accent">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <div>
                            <h6 class="ks-promise-title">Ditindaklanjuti</h6>
                            <p class="ks-promise-desc">Masukan Anda menjadi dasar evaluasi layanan.</p>
                        </div>
                    </div>
                    <div class="ks-promise">
                        <div class="ks-promise-ic ks-promise-ic--green">
                            <i class="fas fa-shield-halved"></i>
                        </div>
                        <div>
                            <h6 class="ks-promise-title">Dijaga Kerahasiaannya</h6>
                            <p class="ks-promise-desc">Identitas Anda bersifat rahasia dan aman.</p>
                        </div>
                    </div>
                </div>

                <div class="ks-categories">
                    <p class="ks-cat-label">Jenis Masukan yang Kami Terima:</p>
                    <div class="ks-cat-chips">
                        <span class="ks-chip ks-chip--red">
                            <i class="fas fa-circle-exclamation"></i> Kritik
                        </span>
                        <span class="ks-chip ks-chip--teal">
                            <i class="fas fa-lightbulb"></i> Saran
                        </span>
                        <span class="ks-chip ks-chip--accent">
                            <i class="fas fa-circle-question"></i> Pertanyaan
                        </span>
                    </div>
                </div>

                <div class="ks-alt-contact">
                    <p class="ks-alt-label">Atau hubungi langsung:</p>
                    <a href="https://wa.me/{{ \App\Models\SiteSetting::get('phone_whatsapp', '6281111121705') }}" target="_blank" class="ks-alt-wa">
                        <i class="fab fa-whatsapp"></i>
                        Chat via WhatsApp
                    </a>
                </div>

            </div>

            <div class="ks-form-wrap">

                @if(session('success'))
                <div class="ks-alert">
                    <i class="fas fa-circle-check ks-alert-icon"></i>
                    <div>
                        <strong>Terima Kasih!</strong>
                        <p class="ks-alert-msg">{{ session('success') }}</p>
                    </div>
                    <button class="ks-alert-close" onclick="this.parentElement.remove()">
                        <i class="fas fa-xmark"></i>
                    </button>
                </div>
                @endif

                <div class="ks-form-card">

                    <div class="ks-form-header">
                        <span class="ks-form-icon"><i class="fas fa-comment-dots"></i></span>
                        <div>
                            <h3 class="ks-form-title">Sampaikan Pendapat Anda</h3>
                            <p class="ks-form-sub">Semua kolom bertanda <span class="ks-required">*</span> wajib diisi.</p>
                        </div>
                    </div>

                    <form action="{{ route('kritik-saran.send') }}" method="POST" class="ks-form" novalidate>
                        @csrf

                        <div class="row g-4">

                            {{-- Responden --}}
                            <div class="col-md-12">
                                <div class="ks-field">
                                    <label class="ks-label">Responden <span class="ks-required">*</span></label>
                                    <div class="d-flex gap-4 mt-2">
                                        <label class="d-flex align-items-center gap-2" style="cursor:pointer;font-weight:500">
                                            <input type="radio" name="responden" value="pasien" class="form-check-input" id="respPasien" {{ old('responden') == 'pasien' ? 'checked' : '' }} required>
                                            Pasien
                                        </label>
                                        <label class="d-flex align-items-center gap-2" style="cursor:pointer;font-weight:500">
                                            <input type="radio" name="responden" value="pengunjung" class="form-check-input" id="respPengunjung" {{ old('responden') == 'pengunjung' ? 'checked' : '' }} required>
                                            Pengunjung
                                        </label>
                                    </div>
                                    @error('responden')
                                    <span class="ks-error-msg mt-1 d-block"><i class="fas fa-triangle-exclamation"></i> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Poliklinik (only visible for Pasien) --}}
                            <div class="col-md-12" id="poliWrap" style="display:none;">
                                <div class="ks-field">
                                    <label class="ks-label">Nama Poliklinik</label>
                                    <div class="ks-input-wrap {{ $errors->has('nama_poliklinik') ? 'ks-input-wrap--error' : '' }}">
                                        <i class="fas fa-hospital ks-input-icon"></i>
                                        <select name="nama_poliklinik" class="ks-input ks-select" id="poliSelect">
                                            <option value="">Pilih Poliklinik...</option>
                                            @foreach($polis as $poli)
                                                <option value="{{ $poli->nama }}" {{ old('nama_poliklinik') == $poli->nama ? 'selected' : '' }}>{{ $poli->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            {{-- Nama --}}
                            <div class="col-md-6">
                                <div class="ks-field">
                                    <label class="ks-label">Nama Pasien/Pengunjung <span class="ks-required">*</span></label>
                                    <div class="ks-input-wrap {{ $errors->has('nama') ? 'ks-input-wrap--error' : '' }}">
                                        <i class="fas fa-user ks-input-icon"></i>
                                        <input type="text" name="nama" class="ks-input"
                                               value="{{ old('nama') }}"
                                               placeholder="Nama Anda" required>
                                    </div>
                                    @error('nama')
                                    <span class="ks-error-msg"><i class="fas fa-triangle-exclamation"></i> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Telepon --}}
                            <div class="col-md-6">
                                <div class="ks-field">
                                    <label class="ks-label">Nomor Telepon <span class="ks-required">*</span></label>
                                    <div class="ks-input-wrap {{ $errors->has('telepon') ? 'ks-input-wrap--error' : '' }}">
                                        <i class="fas fa-phone ks-input-icon"></i>
                                        <input type="text" name="telepon" class="ks-input"
                                               value="{{ old('telepon') }}"
                                               placeholder="contoh: +62 856 94xxxxxx" required>
                                    </div>
                                    @error('telepon')
                                    <span class="ks-error-msg"><i class="fas fa-triangle-exclamation"></i> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Multiple Star Ratings --}}
                            @php
                                $ratingFields = [
                                    'rating_kepuasan_rs'         => ['label' => 'Kepuasan Rumah Sakit',  'sub' => null],
                                    'rating_alur_pelayanan'      => ['label' => 'Alur Pelayanan',         'sub' => null],
                                    'rating_fasilitas'           => ['label' => 'Fasilitas',              'sub' => null],
                                    'rating_kesesuaian_biaya'    => ['label' => 'Kesesuaian Biaya',       'sub' => null],
                                    'rating_pelayanan_dokter'    => ['label' => 'Pelayanan Dokter',       'sub' => null],
                                    'rating_pelayanan_perawat'   => ['label' => 'Pelayanan Perawat',      'sub' => null],
                                    'rating_laboratorium'        => ['label' => 'Laboratorium',           'sub' => 'Pelayanan Penunjang'],
                                    'rating_radiologi'           => ['label' => 'Radiologi',              'sub' => 'Pelayanan Penunjang'],
                                    'rating_fisioterapi'         => ['label' => 'Fisioterapi',            'sub' => 'Pelayanan Penunjang'],
                                    'rating_farmasi'             => ['label' => 'Farmasi',                'sub' => 'Pelayanan Penunjang'],
                                ];
                            @endphp

                            <div class="col-12">
                                <div class="ks-field">
                                    <label class="ks-label mb-3">Penilaian Layanan <span class="ks-required">*</span></label>
                                    <div class="row g-3">
                                        @foreach($ratingFields as $field => $info)
                                        <div class="col-md-6">
                                            <div class="p-3 rounded {{ $errors->has($field) ? 'border border-danger bg-danger bg-opacity-10' : 'border bg-light' }}">
                                                <label class="d-block fw-semibold mb-1" style="font-size:14px">
                                                    {{ $info['label'] }}
                                                    @if($info['sub'])
                                                    <br><small class="text-muted fw-normal" style="font-size:11px">{{ $info['sub'] }}</small>
                                                    @endif
                                                </label>
                                                <div class="ks-rating-wrap ks-multi-rating" data-field="{{ $field }}">
                                                    @for($i = 1; $i <= 5; $i++)
                                                    <label class="ks-rating-label {{ old($field) >= $i ? 'ks-rating-label--active' : '' }}" data-val="{{ $i }}">
                                                        <input type="radio" name="{{ $field }}" value="{{ $i }}"
                                                               class="ks-rating-input"
                                                               {{ old($field) == $i ? 'checked' : '' }} required>
                                                        <span class="ks-rating-star"><i class="fas fa-star"></i></span>
                                                    </label>
                                                    @endfor
                                                    <span class="ks-rating-hint ms-2" style="font-size:12px;font-weight:600">
                                                        @php
                                                            $ov = old($field);
                                                            $hintTexts = [1=>'Sangat Buruk',2=>'Buruk',3=>'Cukup',4=>'Baik',5=>'Sangat Baik'];
                                                        @endphp
                                                        {{ $ov && isset($hintTexts[$ov]) ? $hintTexts[$ov] : 'Pilih' }}
                                                    </span>
                                                </div>
                                                @error($field)
                                                <span class="ks-error-msg mt-2 d-block"><i class="fas fa-triangle-exclamation"></i> {{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            {{-- Pesan / Kritik & Saran --}}
                            <div class="col-12">
                                <div class="ks-field">
                                    <label class="ks-label">Kritik dan Saran <span class="ks-required">*</span></label>
                                    <div class="ks-input-wrap ks-input-wrap--textarea {{ $errors->has('pesan') ? 'ks-input-wrap--error' : '' }}">
                                        <i class="fas fa-comment ks-input-icon ks-input-icon--top"></i>
                                        <textarea name="pesan" class="ks-input ks-textarea"
                                                  rows="5"
                                                  placeholder="Isikan Kritik dan saran Anda"
                                                  required>{{ old('pesan') }}</textarea>
                                    </div>
                                    @error('pesan')
                                    <span class="ks-error-msg"><i class="fas fa-triangle-exclamation"></i> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Submit --}}
                            <div class="col-12">
                                <div class="ks-form-footer">
                                    <p class="ks-form-note">
                                        <i class="fas fa-lock"></i>
                                        Data Anda aman dan tidak dibagikan ke pihak ketiga.
                                    </p>
                                    <button type="submit" class="ks-submit-btn">
                                        <i class="fas fa-paper-plane"></i>
                                        Kirim Sekarang
                                    </button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
</section>

<script>
(function () {
    // Poli toggle
    const respPasien  = document.getElementById('respPasien');
    const respPeng    = document.getElementById('respPengunjung');
    const poliWrap    = document.getElementById('poliWrap');
    const poliSelect  = document.getElementById('poliSelect');

    function checkPoli() {
        if (respPasien && respPasien.checked) {
            poliWrap.style.display = 'block';
            poliSelect.setAttribute('required', 'required');
        } else {
            poliWrap.style.display = 'none';
            poliSelect.removeAttribute('required');
        }
    }

    if (respPasien) respPasien.addEventListener('change', checkPoli);
    if (respPeng)   respPeng.addEventListener('change', checkPoli);
    checkPoli();

    // Star rating for each criteria
    const hints = ['', 'Sangat Buruk', 'Buruk', 'Cukup', 'Baik', 'Sangat Baik'];

    document.querySelectorAll('.ks-multi-rating').forEach(wrap => {
        const labels = wrap.querySelectorAll('.ks-rating-label');
        const inputs = wrap.querySelectorAll('.ks-rating-input');
        const hint   = wrap.querySelector('.ks-rating-hint');

        function update(active) {
            labels.forEach((l, i) => l.classList.toggle('ks-rating-label--active', i < active));
            if (hint) {
                hint.textContent = active ? hints[active] : 'Pilih';
                hint.style.color = active >= 4 ? 'var(--green)' : active >= 3 ? 'var(--amber)' : active ? 'var(--red)' : 'var(--muted-2)';
            }
        }

        labels.forEach((label, i) => {
            label.addEventListener('mouseenter', () => update(i + 1));
            label.addEventListener('mouseleave', () => {
                const checked = [...inputs].findIndex(r => r.checked);
                update(checked >= 0 ? checked + 1 : 0);
            });
            label.addEventListener('click', () => update(i + 1));
        });

        const checked = [...inputs].findIndex(r => r.checked);
        if (checked >= 0) update(checked + 1);
    });
})();
</script>

@endsection
