<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'RS Hamori') - Rumah Sakit Hamori</title>
    <meta name="description" content="@yield('meta_description', 'RS Hamori - Rumah Sakit terdepan di Subang, Jawa Barat. Layanan kesehatan terpercaya dengan dokter spesialis berpengalaman.')">
    
    <!-- Favicon -->
    @php
        $favicon = \App\Models\SiteSetting::get('favicon');
        $faviconUrl = $favicon ? asset('storage/' . $favicon) : asset('assets/images/logosq.png');
        $logoUtama = \App\Models\SiteSetting::get('logo');
        $logoUtamaUrl = $logoUtama ? asset('storage/' . $logoUtama) : asset('assets/images/logo.png');
        $logoPutih = \App\Models\SiteSetting::get('logo_white');
        $logoPutihUrl = $logoPutih ? asset('storage/' . $logoPutih) : asset('assets/images/logoputih.png');
    @endphp
    <link rel="icon" type="image/png" href="{{ $faviconUrl }}">
    
    <style>
        :root {
            --header-bg-img: url('{{ $faviconUrl }}');
        }
    </style>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" rel="stylesheet">
    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}?v={{ time() }}">

    
    @stack('styles')
</head>
<body>

    {{-- Top Bar --}}
    {{-- <div class="topbar d-none d-lg-block">
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
    </div> --}}

    {{-- Main Navbar --}}
    <nav class="navbar navbar-expand-lg main-navbar" id="mainNavbar">
        <div class="container-fluid px-0">
            <div class="navbar-inner-wrap w-100 px-4">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ $logoUtamaUrl }}" alt="Rumah Sakit Hamori" height="44">
                
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
                            {{-- Header bar: Semua Fasilitas di pojok kanan, dipisah dari kategori --}}
                            <li class="mega-menu-header">
                                <span style="font-size: 11px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: var(--muted);">Layanan & Fasilitas</span>
                                <a href="{{ route('fasilitas.index') }}" class="mega-menu-all-link">
                                    Semua Fasilitas <i class="bi bi-arrow-right"></i>
                                </a>
                            </li>
                            {{-- Wrapper baris: semua kolom kategori sejajar --}}
                            <li class="mega-menu-cols-row">
                                <div class="mega-menu-col">
                                    <a href="{{ route('fasilitas.kategori', 'pelayanan-medis') }}" class="text-decoration-none"><h6 class="mega-menu-title hover-primary">Pelayanan Medis</h6></a>
                                    <a class="dropdown-item" href="{{ route('fasilitas.show', 'IGD & Ambulans 24 jam') }}">IGD & Ambulans 24 Jam</a>
                                    <a class="dropdown-item" href="{{ route('fasilitas.show', 'Rawat Jalan') }}">Rawat Jalan</a>
                                    <a class="dropdown-item" href="{{ route('fasilitas.show', 'Rawat Intensive dan Isolasi') }}">Rawat Intensive & Isolasi</a>
                                    <a class="dropdown-item" href="{{ route('fasilitas.show', 'Kamar Operasi') }}">Kamar Operasi</a>
                                </div>
                                <div class="mega-menu-col">
                                    <a href="{{ route('fasilitas.kategori', 'penunjang-medis') }}" class="text-decoration-none"><h6 class="mega-menu-title hover-primary">Penunjang Medis</h6></a>
                                    <a class="dropdown-item" href="{{ route('fasilitas.show', 'Radiologi & CT-Scan') }}">Radiologi & CT-Scan</a>
                                    <a class="dropdown-item" href="{{ route('fasilitas.show', 'Laboratorium') }}">Laboratorium</a>
                                    <a class="dropdown-item" href="{{ route('fasilitas.show', 'Farmasi') }}">Farmasi</a>
                                    <a class="dropdown-item" href="{{ route('fasilitas.show', 'Rehabilitasi Medik') }}">Rehabilitasi Medik</a>
                                </div>
                                <div class="mega-menu-col">
                                    <a href="{{ route('fasilitas.rawat-inap') }}" class="text-decoration-none"><h6 class="mega-menu-title hover-primary">Rawat Inap</h6></a>
                                    <a class="dropdown-item" href="{{ route('fasilitas.show', 'President Suite') }}">President Suite</a>
                                    <a class="dropdown-item" href="{{ route('fasilitas.show', 'Suite Room') }}">Suite Room</a>
                                    <a class="dropdown-item" href="{{ route('fasilitas.show', 'VIP') }}">VIP</a>
                                    <a class="dropdown-item" href="{{ route('fasilitas.show', 'Kelas Utama') }}">Kelas Utama</a>
                                    <a class="dropdown-item" href="{{ route('fasilitas.show', 'Kelas 1') }}">Kelas 1</a>
                                    <a class="dropdown-item" href="{{ route('fasilitas.show', 'Kelas 2') }}">Kelas 2</a>
                                    <a class="dropdown-item" href="{{ route('fasilitas.show', 'Kelas 3') }}">Kelas 3</a>
                                </div>
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
                        <a class="nav-link {{ request()->is('promo*') ? 'active' : '' }} nav-promo-link" href="{{ route('promo.index') }}">
                            <i class="bi bi-gift-fill me-1" style="font-size:12px"></i>Promo
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('kontak') ? 'active' : '' }}" href="{{ route('kontak') }}">Kontak</a>
                    </li>
                </ul>

                <div class="d-flex gap-2 align-items-center">
                    <a href="tel:1500816" class="btn-emergency d-none d-xl-inline-flex">
                        <i class="bi bi-telephone-fill"></i> Emergency
                    </a>
                    <a href="{{ route('appointment') }}" class="btn btn-primary btn-sm d-inline-flex align-items-center gap-1">
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
                        <img src="{{ $logoPutihUrl }}" alt="RS Hamori" height="55" class="mb-3">
                        <p class="footer-desc">Rumah Sakit Hamori berkomitmen memberikan pelayanan kesehatan terbaik dengan standar internasional untuk masyarakat Subang dan sekitarnya.</p>
                        <address class="footer-address">
                            <i class="bi bi-geo-alt-fill me-2"></i>
                            Jalan Raya Pagaden-Subang, Ds. Jabong Kec. Pagaden Kab. Subang Jawa Barat 41251
                        </address>
                        <div class="footer-phones mt-3">
                            <div><i class="bi bi-telephone-fill me-2"></i> <a href="tel:1500816">1500 816</a> (Call Center)</div>
                            <div><i class="bi bi-telephone-fill me-2"></i> <a href="tel:02604250888">0260-4250 888</a></div>
                            <div><i class="bi bi-telephone-fill me-2"></i> <a href="tel:02604250999">0260-4250 999</a> (IGD & Ambulans)</div>
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
                            <li><a href="{{ route('appointment') }}" target="_blank">Buat Appointment</a></li>
                            <li><a href="{{ route('tempat-tidur') }}">Info Tempat Tidur</a></li>
                            <li><a href="{{ route('layanan.index') }}">Layanan Unggulan</a></li>
                            <li><a href="{{ route('partner') }}">Partner</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-4">
                        <h6 class="footer-heading">Download Aplikasi</h6>
                        <p class="text-white-50 small">Nikmati kemudahan layanan RS Hamori dari genggaman Anda.</p>
                        <a href="https://play.google.com/store/apps/details?id=com.terakorp.hamori&hl=id" target="_blank" class="btn btn-outline-light btn-sm mb-2 d-inline-flex align-items-center gap-2">
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

            <div class="container">
                <p class="mb-0 text-center text-white-50 small">
                    Copyright &copy; {{ date('Y') }} Rumah Sakit HAMORI - All Rights Reserved
                </p>
            </div>
        </div>


    {{-- WhatsApp Float Button --}}
    <a href="https://wa.me/6281111121705" target="_blank" class="whatsapp-float" title="Chat via WhatsApp">
        <i class="bi bi-whatsapp"></i>
    </a>

  


    

        <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <!-- Main JS -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <!-- GLightbox JS -->
    <script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const lightbox = GLightbox({
                selector: '.glightbox'
            });
        });
    </script>
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
