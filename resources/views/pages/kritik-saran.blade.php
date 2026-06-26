@extends('layouts.app')
@section('title', 'Kritik & Saran')

@section('content')

{{-- ── PAGE HEADER ── --}}
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

{{-- ── MAIN ── --}}
<section class="ks-section sec">
    <div class="container">
        <div class="ks-wrap">

            {{-- ── LEFT: Info Panel ── --}}
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

                {{-- Kategori chips --}}
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

                {{-- Kontak alternatif --}}
                <div class="ks-alt-contact">
                    <p class="ks-alt-label">Atau hubungi langsung:</p>
                    <a href="https://wa.me/{{ \App\Models\SiteSetting::get('phone_whatsapp', '6281111121705') }}" target="_blank" class="ks-alt-wa">
                        <i class="fab fa-whatsapp"></i>
                        Chat via WhatsApp
                    </a>
                </div>

            </div>

            {{-- ── RIGHT: Form ── --}}
            <div class="ks-form-wrap">

                {{-- Success alert --}}
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

                            {{-- Nama --}}
                            <div class="col-md-6">
                                <div class="ks-field">
                                    <label class="ks-label">Nama Lengkap <span class="ks-required">*</span></label>
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

                            {{-- Email --}}
                            <div class="col-md-6">
                                <div class="ks-field">
                                    <label class="ks-label">Email <span class="ks-required">*</span></label>
                                    <div class="ks-input-wrap {{ $errors->has('email') ? 'ks-input-wrap--error' : '' }}">
                                        <i class="fas fa-envelope ks-input-icon"></i>
                                        <input type="email" name="email" class="ks-input"
                                               value="{{ old('email') }}"
                                               placeholder="email@contoh.com" required>
                                    </div>
                                    @error('email')
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
                                               placeholder="08xx-xxxx-xxxx" required>
                                    </div>
                                    @error('telepon')
                                    <span class="ks-error-msg"><i class="fas fa-triangle-exclamation"></i> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Kategori --}}
                            <div class="col-md-6">
                                <div class="ks-field">
                                    <label class="ks-label">Kategori <span class="ks-required">*</span></label>
                                    <div class="ks-input-wrap {{ $errors->has('kategori') ? 'ks-input-wrap--error' : '' }}">
                                        <i class="fas fa-tag ks-input-icon"></i>
                                        <select name="kategori" class="ks-input ks-select" required>
                                            <option value="">Pilih kategori...</option>
                                            <option value="kritik"     {{ old('kategori') == 'kritik'     ? 'selected' : '' }}>Kritik</option>
                                            <option value="saran"      {{ old('kategori') == 'saran'      ? 'selected' : '' }}>Saran</option>
                                            <option value="pertanyaan" {{ old('kategori') == 'pertanyaan' ? 'selected' : '' }}>Pertanyaan</option>
                                        </select>
                                    </div>
                                    @error('kategori')
                                    <span class="ks-error-msg"><i class="fas fa-triangle-exclamation"></i> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Rating --}}
                            <div class="col-12">
                                <div class="ks-field">
                                    <label class="ks-label">Penilaian Layanan <span class="ks-required">*</span></label>
                                    <div class="ks-rating-wrap {{ $errors->has('rating') ? 'border border-danger rounded' : '' }}" style="{{ $errors->has('rating') ? 'padding: 10px;' : '' }}">
                                        @for($i = 1; $i <= 5; $i++)
                                        <label class="ks-rating-label" data-val="{{ $i }}">
                                            <input type="radio" name="rating" value="{{ $i }}"
                                                   class="ks-rating-input"
                                                   {{ old('rating') == $i ? 'checked' : '' }} required>
                                            <span class="ks-rating-star">
                                                <i class="fas fa-star"></i>
                                            </span>
                                        </label>
                                        @endfor
                                        <span class="ks-rating-hint" id="ratingHint">Pilih penilaian Anda</span>
                                    </div>
                                    @error('rating')
                                    <span class="ks-error-msg mt-2 d-block"><i class="fas fa-triangle-exclamation"></i> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Pesan --}}
                            <div class="col-12">
                                <div class="ks-field">
                                    <label class="ks-label">Pesan <span class="ks-required">*</span></label>
                                    <div class="ks-input-wrap ks-input-wrap--textarea {{ $errors->has('pesan') ? 'ks-input-wrap--error' : '' }}">
                                        <i class="fas fa-comment ks-input-icon ks-input-icon--top"></i>
                                        <textarea name="pesan" class="ks-input ks-textarea"
                                                  rows="5"
                                                  placeholder="Tuliskan kritik, saran, atau pertanyaan Anda di sini..."
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

{{-- Rating JS --}}
<script>
(function () {
    const labels  = document.querySelectorAll('.ks-rating-label');
    const inputs  = document.querySelectorAll('.ks-rating-input');
    const hint    = document.getElementById('ratingHint');
    const hints   = ['', 'Sangat Buruk', 'Buruk', 'Cukup', 'Baik', 'Sangat Baik'];

    function update(active) {
        labels.forEach((l, i) => {
            l.classList.toggle('ks-rating-label--active', i < active);
        });
        hint.textContent = active ? hints[active] : 'Pilih penilaian Anda';
        hint.style.color = active >= 4
            ? 'var(--green)'
            : active >= 3
            ? 'var(--amber)'
            : active
            ? 'var(--red)'
            : 'var(--muted-2)';
    }

    labels.forEach((label, i) => {
        label.addEventListener('mouseenter', () => update(i + 1));
        label.addEventListener('mouseleave', () => {
            const checked = [...inputs].findIndex(r => r.checked);
            update(checked >= 0 ? checked + 1 : 0);
        });
        label.addEventListener('click', () => update(i + 1));
    });

    // restore old value on page load
    const checked = [...inputs].findIndex(r => r.checked);
    if (checked >= 0) update(checked + 1);
})();
</script>




@endsection
