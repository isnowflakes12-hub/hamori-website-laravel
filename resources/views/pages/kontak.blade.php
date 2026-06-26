@extends('layouts.app')
@section('title', 'Kontak Kami')

@section('content')

{{-- ── PAGE HEADER ── --}}
<div class="page-header">
    <div class="container">
        <h1 class="page-title">Kontak Kami</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Kontak</li>
            </ol>
        </nav>
    </div>
</div>

{{-- ── QUICK ACCESS STRIP ── --}}
{{--<div class="kt-quick">
    <div class="kt-quick-glow kt-quick-glow--left"></div>
    <div class="kt-quick-glow kt-quick-glow--right"></div>
    <div class="container position-relative">
        <div class="kt-quick-grid">

            <a href="tel:1500816" class="kt-quick-item">
                <div class="kt-quick-ic kt-quick-ic--teal">
                    <i class="fas fa-phone"></i>
                </div>
                <div class="kt-quick-body">
                    <span class="kt-quick-label">Call Center</span>
                    <strong class="kt-quick-val">1500 816</strong>
                </div>
            </a>

            <div class="kt-quick-div"></div>

            <a href="tel:02604250999" class="kt-quick-item kt-quick-item--red">
                <div class="kt-quick-ic kt-quick-ic--red">
                    <i class="fas fa-truck-medical"></i>
                </div>
                <div class="kt-quick-body">
                    <span class="kt-quick-label">IGD & Ambulans</span>
                    <strong class="kt-quick-val">0260-4250 999</strong>
                </div>
            </a>

            <div class="kt-quick-div"></div>

            <a href="https://wa.me/{{ \App\Models\SiteSetting::get('phone_whatsapp', '6281111121705') }}" target="_blank" class="kt-quick-item kt-quick-item--wa">
                <div class="kt-quick-ic kt-quick-ic--wa">
                    <i class="fab fa-whatsapp"></i>
                </div>
                <div class="kt-quick-body">
                    <span class="kt-quick-label">WhatsApp</span>
                    <strong class="kt-quick-val">{{ \App\Models\SiteSetting::get('phone_whatsapp', '6281111121705') }}</strong>
                </div>
            </a>

            <div class="kt-quick-div"></div>

            <div class="kt-quick-item kt-quick-item--plain">
                <div class="kt-quick-ic kt-quick-ic--accent">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="kt-quick-body">
                    <span class="kt-quick-label">Jam Operasional</span>
                    <strong class="kt-quick-val">Senin – Minggu 24 Jam</strong>
                </div>
            </div>

        </div>
    </div>
</div>--}}

{{-- ── MAIN CONTENT ── --}}
<section class="kt-section sec">
    <div class="container">

        {{-- Success alert --}}
        @if(session('success'))
        <div class="kt-alert">
            <i class="fas fa-circle-check kt-alert-icon"></i>
            <div>
                <strong>Pesan Anda Terkirim!</strong>
                <p class="kt-alert-msg">{{ session('success') }}</p>
            </div>
            <button class="kt-alert-close" onclick="this.parentElement.remove()">
                <i class="fas fa-xmark"></i>
            </button>
        </div>
        @endif

        <div class="row g-5">

            {{-- ── KOLOM KIRI: INFO + MAP ── --}}
            <div class="col-lg-5">

                {{-- Info header --}}
                <div class="kt-info-head">
                    <span class="eyebrow">Hubungi Kami</span>
                    <h2 class="sec-h2 mt-1">Informasi Kontak</h2>
                    <p class="sec-sub mt-2">
                        Kami siap melayani Anda. Hubungi kami melalui salah satu saluran berikut.
                    </p>
                </div>

                {{-- Info cards --}}
                <div class="kt-info-list">

                    <div class="kt-info-item">
                        <div class="kt-info-ic">
                            <i class="fas fa-location-dot"></i>
                        </div>
                        <div class="kt-info-body">
                            <h6 class="kt-info-title">Alamat</h6>
                            <p class="kt-info-text">
                                Jalan Raya Pagaden-Subang, Ds. Jabong<br>
                                Kec. Pagaden, Kab. Subang<br>
                                Jawa Barat 41251
                            </p>
                        </div>
                    </div>

                    <div class="kt-info-item">
                        <div class="kt-info-ic kt-info-ic--accent">
                            <i class="fas fa-phone-volume"></i>
                        </div>
                        <div class="kt-info-body">
                            <h6 class="kt-info-title">Telepon & Call Center</h6>
                            <p class="kt-info-text">
                                <a href="tel:{{ \App\Models\SiteSetting::get('phone_call_center', '1500816') }}" class="kt-info-link">{{ \App\Models\SiteSetting::get('phone_call_center', '1500816') }}</a>
                                <span class="kt-info-sep">·</span>
                                <a href="tel:{{ \App\Models\SiteSetting::get('phone_general', '02604250888') }}" class="kt-info-link">{{ \App\Models\SiteSetting::get('phone_general', '02604250888') }}</a>
                            </p>
                        </div>
                    </div>

                    <div class="kt-info-item">
                        <div class="kt-info-ic kt-info-ic--red">
                            <i class="fas fa-truck-medical"></i>
                        </div>
                        <div class="kt-info-body">
                            <h6 class="kt-info-title">IGD & Ambulans</h6>
                            <p class="kt-info-text">
                                <a href="tel:{{ \App\Models\SiteSetting::get('phone_igd', '02604250999') }}" class="kt-info-link">{{ \App\Models\SiteSetting::get('phone_igd', '02604250999') }}</a>
                                <span class="kt-info-badge kt-info-badge--red">24 Jam</span>
                            </p>
                        </div>
                    </div>

                    <div class="kt-info-item">
                        <div class="kt-info-ic kt-info-ic--wa">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                        <div class="kt-info-body">
                            <h6 class="kt-info-title">WhatsApp</h6>
                            <a href="https://wa.me/{{ \App\Models\SiteSetting::get('phone_whatsapp', '6281111121705') }}" target="_blank"
                               class="kt-wa-btn">
                                <i class="fab fa-whatsapp"></i>
                                Chat via WhatsApp
                            </a>
                        </div>
                    </div>

                    <div class="kt-info-item">
                        <div class="kt-info-ic kt-info-ic--amber">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="kt-info-body">
                            <h6 class="kt-info-title">Email</h6>
                            <p class="kt-info-text">
                                <a href="mailto:info@rshamori.co.id" class="kt-info-link">info@rshamori.co.id</a>
                            </p>
                        </div>
                    </div>

                </div>

                {{-- Peta --}}
                <div class="kt-map-wrap">
                    <div class="kt-map-header">
                        <i class="fas fa-map-location-dot"></i>
                        <span>Lokasi RS Hamori</span>

                        <a href="https://maps.app.goo.gl/NHw7bvQCeiiS3f7e9"
                        target="_blank"
                        class="kt-map-open">
                            Buka di Maps
                            <i class="fas fa-arrow-up-right-from-square"></i>
                        </a>
                    </div>

                    <div class="kt-map-frame">
                        <iframe
                            src="https://www.google.com/maps?q=RS+Hamori&output=embed"
                            width="100%"
                            height="260"
                            style="border:0;"
                            allowfullscreen
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>

            </div>

            {{-- ── KOLOM KANAN: FORM ── --}}
            <div class="col-lg-7">
                <div class="kt-form-card">

                    <div class="kt-form-header">
                        <span class="kt-form-icon"><i class="fas fa-paper-plane"></i></span>
                        <div>
                            <h3 class="kt-form-title">Kirim Pesan</h3>
                            <p class="kt-form-sub">Kami akan merespons pesan Anda dalam 1×24 jam kerja.</p>
                        </div>
                    </div>

                    <form action="{{ route('kontak.send') }}" method="POST" class="kt-form" novalidate>
                        @csrf

                        <div class="row g-4">

                            <div class="col-md-6">
                                <div class="kt-field">
                                    <label class="kt-label">
                                        Nama Lengkap <span class="kt-required">*</span>
                                    </label>
                                    <div class="kt-input-wrap {{ $errors->has('nama') ? 'kt-input-wrap--error' : '' }}">
                                        <i class="fas fa-user kt-input-icon"></i>
                                        <input type="text" name="nama"
                                               class="kt-input"
                                               value="{{ old('nama') }}"
                                               placeholder="Nama Anda" required>
                                    </div>
                                    @error('nama')
                                    <span class="kt-error-msg"><i class="fas fa-triangle-exclamation"></i> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="kt-field">
                                    <label class="kt-label">
                                        Email <span class="kt-required">*</span>
                                    </label>
                                    <div class="kt-input-wrap {{ $errors->has('email') ? 'kt-input-wrap--error' : '' }}">
                                        <i class="fas fa-envelope kt-input-icon"></i>
                                        <input type="email" name="email"
                                               class="kt-input"
                                               value="{{ old('email') }}"
                                               placeholder="email@contoh.com" required>
                                    </div>
                                    @error('email')
                                    <span class="kt-error-msg"><i class="fas fa-triangle-exclamation"></i> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="kt-field">
                                    <label class="kt-label">Nomor Telepon <span class="kt-required">*</span></label>
                                    <div class="kt-input-wrap {{ $errors->has('telepon') ? 'kt-input-wrap--error' : '' }}">
                                        <i class="fas fa-phone kt-input-icon"></i>
                                        <input type="text" name="telepon"
                                               class="kt-input"
                                               value="{{ old('telepon') }}"
                                               placeholder="08xx-xxxx-xxxx" required>
                                    </div>
                                    @error('telepon')
                                    <span class="kt-error-msg"><i class="fas fa-triangle-exclamation"></i> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="kt-field">
                                    <label class="kt-label">
                                        Subjek <span class="kt-required">*</span>
                                    </label>
                                    <div class="kt-input-wrap {{ $errors->has('subjek') ? 'kt-input-wrap--error' : '' }}">
                                        <i class="fas fa-tag kt-input-icon"></i>
                                        <input type="text" name="subjek"
                                               class="kt-input"
                                               value="{{ old('subjek') }}"
                                               placeholder="Subjek pesan" required>
                                    </div>
                                    @error('subjek')
                                    <span class="kt-error-msg"><i class="fas fa-triangle-exclamation"></i> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="kt-field">
                                    <label class="kt-label">
                                        Pesan <span class="kt-required">*</span>
                                    </label>
                                    <div class="kt-input-wrap kt-input-wrap--textarea {{ $errors->has('pesan') ? 'kt-input-wrap--error' : '' }}">
                                        <i class="fas fa-message kt-input-icon kt-input-icon--top"></i>
                                        <textarea name="pesan"
                                                  class="kt-input kt-textarea"
                                                  rows="9"
                                                  placeholder="Tuliskan pesan Anda di sini..." required>{{ old('pesan') }}</textarea>
                                    </div>
                                    @error('pesan')
                                    <span class="kt-error-msg"><i class="fas fa-triangle-exclamation"></i> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="kt-form-footer">
                                    <p class="kt-form-note">
                                        <i class="fas fa-lock"></i>
                                        Data Anda aman dan tidak akan dibagikan kepada pihak ketiga.
                                    </p>
                                    <button type="submit" class="kt-submit-btn">
                                        <i class="fas fa-paper-plane"></i>
                                        Kirim Pesan
                                    </button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>

                {{-- Info tambahan --}}
                <div class="kt-info-cards">
                    <div class="kt-info-card">
                        <div class="kt-info-card-ic"><i class="fas fa-clock"></i></div>
                        <div>
                            <h6 class="kt-info-card-title">Waktu Respons</h6>
                            <p class="kt-info-card-desc">Kami merespons dalam 1×24 jam kerja.</p>
                        </div>
                    </div>
                    <div class="kt-info-card">
                        <div class="kt-info-card-ic kt-info-card-ic--accent"><i class="fas fa-shield-halved"></i></div>
                        <div>
                            <h6 class="kt-info-card-title">Data Aman</h6>
                            <p class="kt-info-card-desc">Privasi Anda terlindungi penuh.</p>
                        </div>
                    </div>
                    <div class="kt-info-card">
                        <div class="kt-info-card-ic kt-info-card-ic--green"><i class="fas fa-headset"></i></div>
                        <div>
                            <h6 class="kt-info-card-title">Dukungan Penuh</h6>
                            <p class="kt-info-card-desc">Tim kami siap membantu Anda.</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>




@endsection
