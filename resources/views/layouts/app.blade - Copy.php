<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'RS Hamori') - Rumah Sakit Hamori</title>
    <meta name="description" content="@yield('meta_description', 'RS Hamori - Rumah Sakit terdepan di Subang, Jawa Barat. Layanan kesehatan terpercaya dengan dokter spesialis berpengalaman.')">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">

    @stack('styles')
</head>
<body>

    {{-- Top Bar --}}
    <div class="topbar d-none d-lg-block">
        <div class="container-fluid px-4">
            <div class="d-flex justify-content-between align-items-center">
                <div class="topbar-contact d-flex gap-4">
                    <a href="tel:1500816" class="topbar-link">
                        <i class="bi bi-telephone-fill"></i> 1500 816
                    </a>
                    <a href="tel:02604250888" class="topbar-link">
                        <i class="bi bi-telephone-fill"></i> 0260-4250 888
                    </a>
                    <span class="topbar-link">
                        <i class="bi bi-geo-alt-fill"></i> Jl. Raya Pagaden-Subang, Kab. Subang, Jawa Barat
                    </span>
                </div>
                <div class="topbar-social d-flex gap-2 align-items-center">
                    <a href="https://www.instagram.com/rshamori/" target="_blank" class="social-icon"><i class="bi bi-instagram"></i></a>
                    <a href="https://www.youtube.com/@rshamori" target="_blank" class="social-icon"><i class="bi bi-youtube"></i></a>
                    <a href="https://web.facebook.com/rshamori" target="_blank" class="social-icon"><i class="bi bi-facebook"></i></a>
                    <a href="https://www.tiktok.com/@rshamori" target="_blank" class="social-icon"><i class="bi bi-tiktok"></i></a>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Navbar --}}
    <nav class="navbar navbar-expand-lg main-navbar" id="mainNavbar">
        <div class="container-fluid px-0">
            <div class="navbar-inner-wrap w-100 px-4">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('assets/images/logo.svg') }}" alt="RS Hamori" height="44">
                <div>
                    <div class="navbar-brand-name">RS Hamori</div>
                    <div class="navbar-brand-sub">Subang, Jawa Barat</div>
                </div>
            </a>

            <button class="navbar-toggler border-0 ms-auto me-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav mx-auto gap-1">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('profil-rs') ? 'active' : '' }}" href="{{ route('profil') }}">Profil RS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('layanan-unggulan*') ? 'active' : '' }}" href="{{ route('layanan.index') }}">Layanan Unggulan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('hamori-update*') ? 'active' : '' }}" href="{{ route('artikel.index') }}">Hamori Update</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"
                        href="#"
                        data-bs-toggle="dropdown"
                        data-bs-auto-close="true">
                        Fasilitas
                        </a>
                        <ul class="dropdown-menu mega-menu">
                            <li class="mega-menu-col">
                                <h6 class="mega-menu-title">Pelayanan Medis</h6>
                                <a class="dropdown-item" href="{{ route('fasilitas.show', 'IGD & Ambulans 24 jam') }}">IGD & Ambulans 24 Jam</a>
                                <a class="dropdown-item" href="{{ route('fasilitas.show', 'Rawat Jalan') }}">Rawat Jalan</a>
                                <a class="dropdown-item" href="{{ route('fasilitas.show', 'Rawat Intensive dan Isolasi') }}">Rawat Intensive & Isolasi</a>
                                <a class="dropdown-item" href="{{ route('fasilitas.show', 'Kamar Operasi') }}">Kamar Operasi</a>
                            </li>
                            <li class="mega-menu-col">
                                <h6 class="mega-menu-title">Penunjang Medis</h6>
                                <a class="dropdown-item" href="{{ route('fasilitas.show', 'Radiologi & CT-Scan') }}">Radiologi & CT-Scan</a>
                                <a class="dropdown-item" href="{{ route('fasilitas.show', 'Laboratorium') }}">Laboratorium</a>
                                <a class="dropdown-item" href="{{ route('fasilitas.show', 'Farmasi') }}">Farmasi</a>
                                <a class="dropdown-item" href="{{ route('fasilitas.show', 'Rehabilitasi Medik') }}">Rehabilitasi Medik</a>
                            </li>
                            <li class="mega-menu-col">
                                <h6 class="mega-menu-title">Rawat Inap</h6>
                                <a class="dropdown-item" href="{{ route('fasilitas.show', 'President Suite') }}">President Suite</a>
                                <a class="dropdown-item" href="{{ route('fasilitas.show', 'Suite Room') }}">Suite Room</a>
                                <a class="dropdown-item" href="{{ route('fasilitas.show', 'VIP') }}">VIP</a>
                                <a class="dropdown-item" href="{{ route('fasilitas.show', 'Kelas Utama') }}">Kelas Utama</a>
                                <a class="dropdown-item" href="{{ route('fasilitas.show', 'Kelas 1') }}">Kelas 1</a>
                                <a class="dropdown-item" href="{{ route('fasilitas.show', 'Kelas 2') }}">Kelas 2</a>
                                <a class="dropdown-item" href="{{ route('fasilitas.show', 'Kelas 3') }}">Kelas 3</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Informasi</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('dokter.index') }}">Jadwal Dokter</a></li>
                            <li><a class="dropdown-item" href="{{ route('tempat-tidur') }}">Info Tempat Tidur</a></li>
                            <li><a class="dropdown-item" href="{{ route('karir.index') }}">Karir</a></li>
                            <li><a class="dropdown-item" href="{{ route('partner') }}">Partner</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('kontak') ? 'active' : '' }}" href="{{ route('kontak') }}">Kontak</a>
                    </li>
                </ul>

                <div class="d-flex gap-2 align-items-center">
                    <a href="tel:1500816" class="btn-emergency d-none d-xl-inline-flex">
                        <i class="bi bi-telephone-fill"></i> Emergency
                    </a>
                    <a href="https://wa.link/1uk9rl" target="_blank" class="btn btn-primary btn-sm d-inline-flex align-items-center gap-1">
                        <i class="bi bi-calendar-check"></i> Buat Appointment
                    </a>
                </div>
            </div>
            </div><!-- end navbar-inner-wrap -->
        </div>
    </nav>

    {{-- Page Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row g-5">
                    <div class="col-lg-4">
                        <img src="{{ asset('assets/images/logo-white.svg') }}" alt="RS Hamori" height="55" class="mb-3">
                        <p class="footer-desc">Rumah Sakit Hamori berkomitmen memberikan pelayanan kesehatan terbaik dengan standar internasional untuk masyarakat Subang dan sekitarnya.</p>
                        <address class="footer-address">
                            <i class="bi bi-geo-alt-fill me-2"></i>
                            Jalan Raya Pagaden-Subang, Ds. Jabong Kec. Pagaden Kab. Subang Jawa Barat 41251
                        </address>
                        <div class="footer-phones mt-3">
                            <div><i class="bi bi-telephone-fill me-2"></i> <a href="tel:1500816">1500 816</a> (Call Center)</div>
                            <div><i class="bi bi-telephone-fill me-2"></i> <a href="tel:02604250888">0260-4250 888</a></div>
                            <div><i class="bi bi-ambulance me-2"></i> <a href="tel:02604250999">0260-4250 999</a> (IGD & Ambulans)</div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-2">
                        <h6 class="footer-heading">Informasi</h6>
                        <ul class="footer-links">
                            <li><a href="{{ route('profil') }}">Profil RS</a></li>
                            <li><a href="{{ route('kontak') }}">Kontak</a></li>
                            <li><a href="{{ route('karir.index') }}">Informasi Karir</a></li>
                            <li><a href="{{ route('faq') }}">FAQ</a></li>
                            <li><a href="{{ route('kritik-saran') }}">Kritik dan Saran</a></li>
                            <li><a href="{{ route('privacy-policy') }}">Privacy Policy</a></li>
                        </ul>
                    </div>
                    <div class="col-6 col-lg-2">
                        <h6 class="footer-heading">Layanan</h6>
                        <ul class="footer-links">
                            <li><a href="{{ route('dokter.index') }}">Jadwal Dokter</a></li>
                            <li><a href="https://wa.link/1uk9rl" target="_blank">Buat Appointment</a></li>
                            <li><a href="{{ route('tempat-tidur') }}">Info Tempat Tidur</a></li>
                            <li><a href="{{ route('layanan.index') }}">Layanan Unggulan</a></li>
                            <li><a href="{{ route('partner') }}">Partner</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-4">
                        <h6 class="footer-heading">Download Aplikasi</h6>
                        <p class="text-white-50 small">Nikmati kemudahan layanan RS Hamori dari genggaman Anda.</p>
                        <a href="https://play.google.com/store/apps/details?id=com.terasolusi.hamori.patient" target="_blank" class="btn btn-outline-light btn-sm mb-2 d-inline-flex align-items-center gap-2">
                            <i class="bi bi-google-play"></i> Google Play
                        </a>
                        <br>
                        <a href="{{ route('coming-soon') }}" class="btn btn-outline-light btn-sm d-inline-flex align-items-center gap-2">
                            <i class="bi bi-apple"></i> App Store
                        </a>
                        <div class="footer-social mt-4">
                            <h6 class="footer-heading">Ikuti Kami</h6>
                            <div class="d-flex gap-2">
                                <a href="https://www.instagram.com/rshamori/" target="_blank" class="social-btn"><i class="bi bi-instagram"></i></a>
                                <a href="https://www.youtube.com/@rshamori" target="_blank" class="social-btn"><i class="bi bi-youtube"></i></a>
                                <a href="https://web.facebook.com/rshamori" target="_blank" class="social-btn"><i class="bi bi-facebook"></i></a>
                                <a href="https://www.tiktok.com/@rshamori" target="_blank" class="social-btn"><i class="bi bi-tiktok"></i></a>
                                <a href="https://twitter.com/RSHamori" target="_blank" class="social-btn"><i class="bi bi-twitter-x"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <p class="mb-0 text-center text-white-50 small">
                    Copyright &copy; {{ date('Y') }} RS HAMORI - All Rights Reserved
                </p>
            </div>
        </div>
    </footer>

    {{-- WhatsApp Float Button --}}
    <a href="https://wa.me/628888905555" target="_blank" class="whatsapp-float" title="Chat via WhatsApp">
        <i class="bi bi-whatsapp"></i>
    </a>

    {{-- Floating Promo Button --}}
    <button class="promo-float-btn" id="promoFloatBtn" title="Lihat Promo Spesial">
        <div class="promo-float-pulse"></div>
        <div class="promo-float-inner">
            <i class="bi bi-gift-fill promo-float-icon"></i>
            <span class="promo-float-label">PROMO</span>
        </div>
        <div class="promo-float-badge">!</div>
    </button>


    {{-- ====================== POPUP PROMO ====================== --}}
    <div class="promo-overlay" id="promoOverlay">
        <div class="promo-popup" id="promoPopup">

            {{-- Close button outside overflow so it's never clipped --}}
            <button class="promo-close" id="promoClose" aria-label="Tutup">
                <i class="bi bi-x-lg"></i>
            </button>

            <div class="promo-popup-inner">
            <div class="promo-visual">
                <div class="promo-badge-float">PROMO</div>
                <div class="promo-icon-wrap">
                    <i class="bi bi-heart-pulse-fill"></i>
                </div>
                <h2 class="promo-visual-title">Cek Kesehatan<br>Sekarang!</h2>
                <p class="promo-visual-sub">Dapatkan penawaran spesial hari ini</p>
            </div>

            <div class="promo-content">
                <div class="promo-tag">Penawaran Terbatas</div>
                <h3 class="promo-title">Paket Medical Check Up</h3>
                <p class="promo-desc">
                    Kenali kondisi kesehatan Anda lebih awal dengan paket Medical Check Up lengkap bersama dokter spesialis RS Hamori.
                </p>
                <div class="promo-benefits">
                    <div class="promo-benefit-item"><i class="bi bi-check-circle-fill"></i><span>Laboratorium Lengkap (30+ parameter)</span></div>
                    <div class="promo-benefit-item"><i class="bi bi-check-circle-fill"></i><span>Rontgen Thorax &amp; EKG</span></div>
                    <div class="promo-benefit-item"><i class="bi bi-check-circle-fill"></i><span>Konsultasi Dokter Spesialis</span></div>
                    <div class="promo-benefit-item"><i class="bi bi-check-circle-fill"></i><span>USG Abdomen</span></div>
                </div>
                <div class="promo-price-wrap">
                    <div class="promo-price-old">Rp 1.500.000</div>
                    <div class="promo-price-new">Rp 850.000</div>
                    <div class="promo-discount">Hemat 43%</div>
                </div>
                <div class="promo-timer">
                    <i class="bi bi-clock-fill me-1"></i>
                    Penawaran berakhir dalam:
                    <span class="promo-countdown" id="promoCountdown">23:59:59</span>
                </div>
                <div class="promo-actions">
                    <a href="https://wa.link/1uk9rl" target="_blank" class="btn-promo-primary">
                        <i class="bi bi-whatsapp me-2"></i> Daftar Sekarang
                    </a>
                    <a href="tel:1500816" class="btn-promo-secondary">
                        <i class="bi bi-telephone me-1"></i> 1500 816
                    </a>
                </div>
                <label class="promo-dont-show">
                    <input type="checkbox" id="promoDontShow">
                    <span>Jangan tampilkan lagi hari ini</span>
                </label>
            </div>
            </div>{{-- end promo-popup-inner --}}
        </div>
    </div>
    {{-- ====================== END POPUP ====================== --}}

        <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <!-- Main JS -->
    <script src="{{ asset('assets/js/app.js') }}"></script>

    @stack('scripts')

    <script>
    // Floating Promo Button
    (function(){
        var btn = document.getElementById('promoFloatBtn');
        var overlay = document.getElementById('promoOverlay');
        if(!btn || !overlay) return;
        btn.addEventListener('click', function(){
            overlay.classList.add('show');
        });
        // Hide button when popup is open, show when closed
        var observer = new MutationObserver(function(){
            if(overlay.classList.contains('show')){
                btn.style.opacity = '0';
                btn.style.pointerEvents = 'none';
            } else {
                btn.style.opacity = '1';
                btn.style.pointerEvents = 'auto';
            }
        });
        observer.observe(overlay, { attributes: true, attributeFilter: ['class'] });
    })();
    </script>
</body>
</html>
