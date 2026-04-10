@extends('layouts.app')
@section('title', 'Profil Rumah Sakit')
@section('content')
<div class="page-header">
    <div class="container">
        <h1 class="page-title">Profil RS Hamori</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Profil RS</li>
            </ol>
        </nav>
    </div>
</div>
<section class="py-5">
    <div class="container">
        <div class="row g-5 align-items-center mb-5">
            <div class="col-lg-6">
                <span class="section-badge">Tentang Kami</span>
                <h2 class="section-title">Rumah Sakit Hamori</h2>
                <p>RS Hamori merupakan salah satu rumah sakit rujukan terdepan yang berlokasi di Kabupaten Subang, Jawa Barat. Dengan komitmen memberikan <em>service of excellent</em>, kami hadir untuk memenuhi kebutuhan kesehatan masyarakat dengan standar layanan berkualitas tinggi.</p>
                <p>Didukung oleh dokter spesialis berpengalaman, tenaga medis profesional, dan fasilitas medis modern berstandar internasional, RS Hamori siap memberikan pelayanan terbaik 24 jam sehari, 7 hari seminggu.</p>
                <div class="row g-3 mt-3">
                    <div class="col-6"><div class="info-box"><div class="info-number">50+</div><div class="info-label">Dokter Spesialis</div></div></div>
                    <div class="col-6"><div class="info-box"><div class="info-number">200+</div><div class="info-label">Tempat Tidur</div></div></div>
                    <div class="col-6"><div class="info-box"><div class="info-number">24/7</div><div class="info-label">Layanan IGD</div></div></div>
                    <div class="col-6"><div class="info-box"><div class="info-number">8</div><div class="info-label">Pusat Unggulan</div></div></div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ratio ratio-4x3 rounded-4 overflow-hidden shadow-lg">
                    <div style="background: linear-gradient(135deg, #0055a5, #00a859); display:flex; align-items:center; justify-content:center;">
                        <div class="text-center text-white p-4">
                            <i class="bi bi-hospital display-1 mb-3 d-block"></i>
                            <h3>RS Hamori</h3>
                            <p class="opacity-75">Subang, Jawa Barat</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="value-card">
                    <div class="value-icon"><i class="bi bi-eye-fill"></i></div>
                    <h5>Visi</h5>
                    <p>Menjadi rumah sakit unggulan dan terpercaya yang memberikan layanan kesehatan berstandar internasional untuk masyarakat Indonesia.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="value-card">
                    <div class="value-icon"><i class="bi bi-flag-fill"></i></div>
                    <h5>Misi</h5>
                    <p>Memberikan pelayanan kesehatan berkualitas tinggi, mengembangkan SDM profesional, dan berperan aktif dalam peningkatan derajat kesehatan masyarakat.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="value-card">
                    <div class="value-icon"><i class="bi bi-heart-fill"></i></div>
                    <h5>Nilai</h5>
                    <p>Integritas, Profesionalisme, Kepedulian, Inovasi, dan Kerjasama dalam setiap aspek pelayanan kesehatan yang kami berikan.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
.info-box { background: var(--primary-light); border-radius: 12px; padding: 16px; text-align: center; }
.info-number { font-size: 2rem; font-weight: 800; color: var(--primary); line-height: 1; }
.info-label { font-size: 12px; color: var(--text-muted); margin-top: 4px; }
.value-card { background: var(--white); border-radius: 12px; padding: 28px; box-shadow: var(--shadow); border-top: 4px solid var(--primary); }
.value-icon { width: 48px; height: 48px; background: var(--primary-light); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--primary); font-size: 20px; margin-bottom: 16px; }
</style>
@endsection
