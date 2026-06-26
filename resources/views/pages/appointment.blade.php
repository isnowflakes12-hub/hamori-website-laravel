@extends('layouts.app')
@section('title', 'Buat Appointment — RS Hamori')

@section('content')

{{-- ── PAGE HEADER ── --}}
<div class="page-header">
    <div class="container">
        <h1 class="page-title">Buat Appointment</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Buat Appointment</li>
            </ol>
        </nav>
    </div>
</div>

{{-- ═══ PILIHAN APPOINTMENT (VERTIKAL) ═══ --}}
<section class="appt-section">
    <div class="appt-container">

        {{-- OPSI 1: Aplikasi Mobile --}}
        <div class="appt-app-section">
            {{-- Header: Judul + Deskripsi + Tombol Unduh (atas, full width) --}}
            <div class="appt-app-top">
                <div class="appt-app-top-text">
                    <div class="appt-card-badge">Paling Praktis</div>
                    <h2 class="appt-app-title">Lewat Aplikasi <span>RS Hamori</span></h2>
                    <p class="appt-app-desc">Daftar antrian, cek jadwal dokter, pantau hasil lab, dan kelola riwayat kesehatan — semua dalam genggaman Anda.</p>
                </div>
                <div class="appt-store-btns">
                    <a href="https://play.google.com/store" target="_blank" class="appt-store-btn appt-store-btn--android">
                        <i class="bi bi-google-play"></i>
                        <div><small>Tersedia di</small><strong>Google Play</strong></div>
                    </a>
                    <a href="https://apps.apple.com" target="_blank" class="appt-store-btn appt-store-btn--ios">
                        <i class="bi bi-apple"></i>
                        <div><small>Download di</small><strong>App Store</strong></div>
                    </a>
                </div>
            </div>

            {{-- Slider Gambar Tutorial (bawah, full width) --}}
            <div class="swiper apptFeatSwiper">
                <div class="swiper-wrapper">
                    @for($i = 1; $i <= 8; $i++)
                    <div class="swiper-slide">
                        <div class="appt-img-card">
                            <img src="{{ asset('assets/images/tutorial-app/'.$i.'.png') }}"
                                 alt="Tutorial Langkah {{ $i }}"
                                 onerror="this.src='https://placehold.co/280x350/e8f4f8/1ba99d?text=Step+{{ $i }}'">
                        </div>
                    </div>
                    @endfor
                </div>
                <div class="swiper-pagination apptFeatPagination"></div>
            </div>
        </div>


        {{-- OPSI 2: WhatsApp (Full Width) --}}
        <div class="appt-card-fw appt-card-fw--wa mt-4">
            <div class="appt-fw-media appt-fw-media--wa">
                <div class="appt-chat-wrap">
                    <div class="appt-chat-bubble appt-chat-bubble--in">
                        <div class="appt-chat-avatar"><i class="bi bi-hospital-fill"></i></div>
                        <div class="appt-chat-text">Halo! Selamat datang di layanan pendaftaran RS Hamori 👋 Ada yang bisa dibantu?</div>
                    </div>
                    <div class="appt-chat-bubble appt-chat-bubble--out">
                        <div class="appt-chat-text">Saya mau daftar ke poli anak.</div>
                    </div>
                    <div class="appt-chat-bubble appt-chat-bubble--in">
                        <div class="appt-chat-avatar"><i class="bi bi-hospital-fill"></i></div>
                        <div class="appt-chat-text">Baik, kami bantu daftarkan. Silakan kirimkan foto KTP ya. 😊</div>
                    </div>
                </div>
            </div>
            <div class="appt-fw-content">
                <div class="appt-card-icon appt-card-icon--wa"><i class="bi bi-whatsapp"></i></div>
                <h2 class="appt-card-title">Chat via <span>WhatsApp</span></h2>
                <p class="appt-card-desc">Bantuan pendaftaran langsung dengan staf kami. Sangat cocok jika Anda butuh bantuan informasi poli yang tepat untuk keluhan Anda.</p>

                <div class="appt-wa-info">
                    <div class="appt-wa-info-row">
                        <i class="bi bi-clock-fill"></i>
                        <div><small>Jam Operasional Admin</small><strong>Senin–Sabtu, 07.00 – 21.00 WIB</strong></div>
                    </div>
                </div>

                <a href="https://wa.me/{{ \App\Models\SiteSetting::get('phone_whatsapp', '6281111121705') }}?text=Halo%20RS%20Hamori%2C%20saya%20ingin%20membuat%20appointment." target="_blank" class="appt-wa-btn">
                    <i class="bi bi-whatsapp"></i> Chat WhatsApp Sekarang
                </a>
            </div>
        </div>

        {{-- OPSI 3: Call Center (Full Width) --}}
        <div class="appt-card-fw appt-card-fw--call mt-4">
            <div class="appt-fw-content d-flex align-items-center justify-content-between flex-wrap gap-4">
                <div>
                    <h2 class="appt-card-title text-white mb-2"><i class="bi bi-telephone-inbound-fill me-2"></i> Panggilan Darurat / Cepat</h2>
                    <p class="text-white-50 mb-0" style="font-size:15px; max-width: 500px;">Butuh penanganan segera atau konsultasi pendaftaran langsung via suara? Hubungi hotline kami kapan saja.</p>
                </div>
                <a href="tel:{{ \App\Models\SiteSetting::get('phone_call_center', '1500816') }}" class="btn btn-light btn-lg rounded-pill px-4 fw-bold shadow-sm" style="color:var(--primary);">
                    <i class="bi bi-telephone-fill me-2"></i> {{ \App\Models\SiteSetting::get('phone_call_center', '1500816') }}
                </a>
            </div>
        </div>

        {{-- INFORMASI PENTING (Jadwal & BPJS) --}}
        <div class="row g-4 mt-5">
            {{-- Akses Cepat Jadwal Dokter --}}
            <div class="col-md-6">
                <div class="appt-info-box">
                    <div class="appt-info-icon bg-primary-light text-primary"><i class="bi bi-calendar2-week"></i></div>
                    <div class="appt-info-body">
                        <h5>Cek Jadwal Dokter</h5>
                        <p>Pastikan jadwal praktik dokter spesialis tujuan Anda sebelum melakukan pendaftaran.</p>
                        <a href="{{ route('dokter.index') }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">Lihat Jadwal <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            {{-- Panduan BPJS --}}
            <div class="col-md-6">
                <div class="appt-info-box">
                    <div class="appt-info-icon bg-success-light text-success"><i class="bi bi-shield-check"></i></div>
                    <div class="appt-info-body">
                        <h5>Pasien BPJS Kesehatan</h5>
                        <p>Pastikan rujukan dari Faskes Tingkat 1 Anda sudah aktif dan ditujukan ke Poli RS Hamori.</p>
                        <button class="btn btn-outline-success btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#bpjsModal">Syarat & Ketentuan <i class="bi bi-info-circle"></i></button>
                    </div>
                </div>
            </div>
        </div>

        {{-- FAQ PENDAFTARAN --}}
        <div class="appt-faq-sec mt-5 pt-4">
            <div class="text-center mb-4">
                <h3 class="fw-bold" style="color:var(--ink);">Pertanyaan Umum (FAQ) Pendaftaran</h3>
                <p class="text-muted">Informasi seputar proses pembuatan janji temu di RS Hamori</p>
            </div>
            <div class="accordion" id="faqAppointment">
                <div class="accordion-item border-0 rounded-4 shadow-sm mb-3 overflow-hidden">
                    <h2 class="accordion-header">
                        <button class="accordion-button bg-white fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                            Apakah bisa mendaftar di hari H (hari yang sama)?
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAppointment">
                        <div class="accordion-body text-muted">
                            Untuk pendaftaran online (Aplikasi & WhatsApp), pendaftaran minimal dilakukan H-1 (satu hari sebelumnya). Pendaftaran di hari H hanya dapat dilakukan secara langsung di loket pendaftaran rumah sakit, menyesuaikan kuota yang masih tersedia.
                        </div>
                    </div>
                </div>
                <div class="accordion-item border-0 rounded-4 shadow-sm mb-3 overflow-hidden">
                    <h2 class="accordion-header">
                        <button class="accordion-button bg-white fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                            Bagaimana jika saya ingin membatalkan atau mengubah jadwal janji?
                        </button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAppointment">
                        <div class="accordion-body text-muted">
                            Pembatalan atau perubahan jadwal bisa dilakukan melalui Aplikasi RS Hamori pada menu 'Riwayat Appointment', atau dengan menghubungi admin WhatsApp kami selambat-lambatnya 3 jam sebelum jadwal praktik dokter dimulai.
                        </div>
                    </div>
                </div>
                <div class="accordion-item border-0 rounded-4 shadow-sm mb-3 overflow-hidden">
                    <h2 class="accordion-header">
                        <button class="accordion-button bg-white fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                            Apakah pendaftaran via aplikasi dan WhatsApp dikenakan biaya administrasi tambahan?
                        </button>
                    </h2>
                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAppointment">
                        <div class="accordion-body text-muted">
                            Tidak. Pendaftaran janji temu melalui semua kanal resmi RS Hamori 100% gratis. Anda hanya akan dikenakan biaya konsultasi dokter dan obat (bagi pasien umum) yang pembayarannya dilakukan di kasir rumah sakit.
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

{{-- MODAL INFO BPJS --}}
<div class="modal fade" id="bpjsModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0">
            <div class="modal-header bg-success text-white border-0 rounded-top-4">
                <h5 class="modal-title fw-bold"><i class="bi bi-shield-check me-2"></i>Persyaratan Pasien BPJS</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <p>Bagi pasien yang akan menggunakan fasilitas BPJS Kesehatan, mohon siapkan dokumen berikut saat kedatangan:</p>
                <ul class="list-group list-group-flush mb-0">
                    <li class="list-group-item px-0 border-bottom-0"><i class="bi bi-check2-circle text-success me-2"></i> Kartu BPJS Asli & Fotokopi</li>
                    <li class="list-group-item px-0 border-bottom-0"><i class="bi bi-check2-circle text-success me-2"></i> KTP Asli & Fotokopi</li>
                    <li class="list-group-item px-0 border-bottom-0"><i class="bi bi-check2-circle text-success me-2"></i> Surat Rujukan dari Faskes Tingkat 1 (Klinik/Puskesmas) yang masih berlaku.</li>
                    <li class="list-group-item px-0 border-bottom-0"><i class="bi bi-info-circle text-primary me-2"></i> Khusus IGD (Gawat Darurat) dapat langsung ditangani tanpa rujukan Faskes 1.</li>
                </ul>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Mengerti</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        new Swiper('.apptFeatSwiper', {
            loop: true,
            speed: 600,
            slidesPerView: 'auto',
            spaceBetween: 12,
            centeredSlides: true,
            autoplay: {
                delay: 10000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.apptFeatPagination',
                clickable: true,
            },
            breakpoints: {
                640:  { centeredSlides: false, spaceBetween: 16 },
                768:  { centeredSlides: false, spaceBetween: 16 },
                1200: { centeredSlides: false, spaceBetween: 20 },
            }
        });
    });
</script>
@endpush

@endsection