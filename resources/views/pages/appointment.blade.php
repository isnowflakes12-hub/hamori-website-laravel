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

{{-- ═══ PILIHAN APPOINTMENT ═══ --}}
<section class="appt-section">
    <div class="appt-container">

        {{-- Grid 2 opsi utama --}}
        <div class="appt-grid">

            {{-- OPSI 1: Aplikasi Mobile --}}
            <div class="appt-card appt-card--app">
                <div class="appt-card-badge">Rekomendasi</div>
                <div class="appt-card-icon">
                    <i class="bi bi-phone-fill"></i>
                </div>
                <div class="appt-card-body">
                    <h2 class="appt-card-title">Lewat Aplikasi<br><span>RS Hamori</span></h2>
                    <p class="appt-card-desc">Daftar antrian, cek jadwal dokter, pantau hasil lab, dan kelola riwayat kesehatan langsung dari smartphone Anda — kapan saja, di mana saja.</p>

                    <ul class="appt-features">
                        <li><i class="bi bi-check-circle-fill"></i> Pilih dokter & jadwal sendiri</li>
                        <li><i class="bi bi-check-circle-fill"></i> Notifikasi pengingat otomatis</li>
                        <li><i class="bi bi-check-circle-fill"></i> Hasil lab & rekam medis digital</li>
                        <li><i class="bi bi-check-circle-fill"></i> Antre tanpa harus datang lebih awal</li>
                        <li><i class="bi bi-check-circle-fill"></i> Gratis, tanpa biaya tambahan</li>
                    </ul>

                    <div class="appt-store-wrap">
                        <p class="appt-store-label">Unduh sekarang:</p>
                        <div class="appt-store-btns">
                            <a href="https://play.google.com/store" target="_blank" class="appt-store-btn appt-store-btn--android">
                                <i class="bi bi-google-play"></i>
                                <div>
                                    <small>Tersedia di</small>
                                    <strong>Google Play</strong>
                                </div>
                            </a>
                            <a href="https://apps.apple.com" target="_blank" class="appt-store-btn appt-store-btn--ios">
                                <i class="bi bi-apple"></i>
                                <div>
                                    <small>Download di</small>
                                    <strong>App Store</strong>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Mockup phone --}}
                <div class="appt-phone-mockup">
                    <div class="appt-phone-frame">
                        <div class="appt-phone-screen">
                            <div class="appt-phone-header">
                                <span>RS Hamori</span>
                                <i class="bi bi-bell-fill"></i>
                            </div>
                            <div class="appt-phone-content">
                                <div class="appt-phone-greeting">Halo, Selamat Datang 👋</div>
                                <div class="appt-phone-menu-grid">
                                    <div class="appt-phone-menu-item">
                                        <i class="bi bi-calendar2-check-fill"></i>
                                        <span>Buat Janji</span>
                                    </div>
                                    <div class="appt-phone-menu-item">
                                        <i class="bi bi-person-badge-fill"></i>
                                        <span>Dokter</span>
                                    </div>
                                    <div class="appt-phone-menu-item">
                                        <i class="bi bi-file-earmark-medical-fill"></i>
                                        <span>Hasil Lab</span>
                                    </div>
                                    <div class="appt-phone-menu-item">
                                        <i class="bi bi-heart-pulse-fill"></i>
                                        <span>Rekam Medis</span>
                                    </div>
                                </div>
                                <div class="appt-phone-card">
                                    <div class="appt-phone-card-label">Antrian Anda</div>
                                    <div class="appt-phone-card-num">A-014</div>
                                    <div class="appt-phone-card-doc">dr. Budi Santoso, Sp.JP</div>
                                    <div class="appt-phone-card-status">
                                        <span class="dot"></span> Sedang berjalan
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- OPSI 2: WhatsApp --}}
            <div class="appt-card appt-card--wa">
                <div class="appt-card-icon appt-card-icon--wa">
                    <i class="bi bi-whatsapp"></i>
                </div>
                <div class="appt-card-body">
                    <h2 class="appt-card-title">Chat via<br><span>WhatsApp</span></h2>
                    <p class="appt-card-desc">Hubungi tim kami langsung melalui WhatsApp. Staf kami siap membantu mendaftarkan jadwal Anda dengan cepat dan ramah.</p>

                    <ul class="appt-features appt-features--wa">
                        <li><i class="bi bi-check-circle-fill"></i> Respons cepat oleh staf kami</li>
                        <li><i class="bi bi-check-circle-fill"></i> Tidak perlu instal aplikasi</li>
                        <li><i class="bi bi-check-circle-fill"></i> Bisa tanya-jawab langsung</li>
                        <li><i class="bi bi-check-circle-fill"></i> Layanan 07.00 – 21.00 WIB</li>
                    </ul>

                    <div class="appt-wa-info">
                        <div class="appt-wa-info-row">
                            <i class="bi bi-telephone-fill"></i>
                            <div>
                                <small>Nomor WhatsApp</small>
                                <strong>0811-1121-705</strong>
                            </div>
                        </div>
                        <div class="appt-wa-info-row">
                            <i class="bi bi-clock-fill"></i>
                            <div>
                                <small>Jam Layanan</small>
                                <strong>Senin–Sabtu, 07.00–21.00</strong>
                            </div>
                        </div>
                    </div>

                    <a href="https://wa.me/6281111121705?text=Halo%20RS%20Hamori%2C%20saya%20ingin%20membuat%20appointment%20dengan%20dokter." 
                       target="_blank" class="appt-wa-btn">
                        <i class="bi bi-whatsapp"></i>
                        Chat Sekarang di WhatsApp
                    </a>

                    <p class="appt-wa-note">
                        <i class="bi bi-info-circle me-1"></i>
                        Pesan akan langsung terhubung ke tim pendaftaran RS Hamori.
                    </p>
                </div>

                {{-- Ilustrasi WA chat bubble --}}
                <div class="appt-wa-illustration">
                    <div class="appt-chat-wrap">
                        <div class="appt-chat-bubble appt-chat-bubble--in">
                            <div class="appt-chat-avatar"><i class="bi bi-hospital-fill"></i></div>
                            <div class="appt-chat-text">Halo! Selamat datang di RS Hamori 👋 Ada yang bisa kami bantu?</div>
                        </div>
                        <div class="appt-chat-bubble appt-chat-bubble--out">
                            <div class="appt-chat-text">Saya ingin buat janji dengan dokter spesialis jantung.</div>
                        </div>
                        <div class="appt-chat-bubble appt-chat-bubble--in">
                            <div class="appt-chat-avatar"><i class="bi bi-hospital-fill"></i></div>
                            <div class="appt-chat-text">Baik! Dr. Budi Sp.JP tersedia Senin & Rabu jam 09.00–12.00. Mau kami bantu daftarkan? 😊</div>
                        </div>
                        <div class="appt-chat-bubble appt-chat-bubble--out">
                            <div class="appt-chat-text">Iya, Senin jam 10 pagi ya.</div>
                        </div>
                        <div class="appt-chat-bubble appt-chat-bubble--in">
                            <div class="appt-chat-avatar"><i class="bi bi-hospital-fill"></i></div>
                            <div class="appt-chat-text">✅ Sudah kami daftarkan! Nomor antrian Anda <strong>B-07</strong>. Sampai Senin!</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- PANDUAN LANGKAH --}}
        <div class="appt-guide">
            <h3 class="appt-guide-title">Cara Buat Appointment via Aplikasi</h3>
            <div class="appt-steps">
                <div class="appt-step">
                    <div class="appt-step-num">1</div>
                    <div class="appt-step-body">
                        <strong>Unduh & Daftar</strong>
                        <p>Download aplikasi RS Hamori di Play Store atau App Store, lalu buat akun dengan nomor HP Anda.</p>
                    </div>
                </div>
                <div class="appt-step-arrow"><i class="bi bi-arrow-right"></i></div>
                <div class="appt-step">
                    <div class="appt-step-num">2</div>
                    <div class="appt-step-body">
                        <strong>Pilih Dokter & Jadwal</strong>
                        <p>Cari spesialis yang Anda butuhkan, pilih hari dan jam yang tersedia.</p>
                    </div>
                </div>
                <div class="appt-step-arrow"><i class="bi bi-arrow-right"></i></div>
                <div class="appt-step">
                    <div class="appt-step-num">3</div>
                    <div class="appt-step-body">
                        <strong>Konfirmasi</strong>
                        <p>Isi data pasien dan konfirmasi. Nomor antrian langsung Anda terima.</p>
                    </div>
                </div>
                <div class="appt-step-arrow"><i class="bi bi-arrow-right"></i></div>
                <div class="appt-step">
                    <div class="appt-step-num">4</div>
                    <div class="appt-step-body">
                        <strong>Datang Sesuai Jadwal</strong>
                        <p>Tunjukkan nomor antrian di loket. Tidak perlu mengantre panjang!</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- TELEPON & WALK-IN --}}
        <div class="appt-alt">
            <div class="appt-alt-icon"><i class="bi bi-telephone-fill"></i></div>
            <div class="appt-alt-body">
                <strong>Atau hubungi kami via telepon / datang langsung</strong>
                <p>Loket pendaftaran buka Senin–Sabtu pukul 07.00–20.00 WIB · <a href="tel:02604250388">(0260) 4250 388</a> · IGD 24 Jam: <a href="tel:1500816">1500 816</a></p>
            </div>
        </div>

    </div>
</section>

@endsection