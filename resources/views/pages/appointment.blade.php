@extends('layouts.app')
@section('title', 'Buat Appointment — RS Hamori')

@section('content')

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

<section class="appt-section">
    <div class="appt-container">

        <div class="appt-app-section">
            <div class="appt-app-top">
                <div class="appt-app-top-text">
                    <div class="appt-card-badge">Paling Praktis</div>
                    <h2 class="appt-app-title">Lewat Aplikasi <span>RS Hamori</span></h2>
                    <p class="appt-app-desc">Daftar antrian, cek jadwal dokter, pantau hasil lab, dan kelola riwayat kesehatan — semua dalam genggaman Anda.</p>
                </div>
                <div class="appt-store-btns">
                    <a href="https://play.google.com/store" target="_blank" class="appt-store-btn appt-store-btn--android">
                        <i class="bi bi-google-play"></i>
                        <div><small>Tersedia di</small><strong>Playstore</strong></div>
                    </a>
                    <a href="https://apps.apple.com" target="_blank" class="appt-store-btn appt-store-btn--ios">
                        <i class="bi bi-apple"></i>
                        <div><small>Download di</small><strong>App Store</strong></div>
                    </a>
                </div>
            </div>

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

        <div class="row g-4 mt-5">
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

        {{-- ===================== BPJS SECTION ===================== --}}
        <div class="bpjs-section mt-5 pt-2">

            {{-- Header --}}
            <div class="bpjs-header">
                <div class="bpjs-header-icon"><i class="bi bi-shield-check-fill"></i></div>
                <div>
                    <h3 class="bpjs-header-title">Panduan Layanan BPJS Kesehatan</h3>
                    <p class="bpjs-header-sub">Informasi lengkap dan terstruktur untuk pasien JKN-KIS / BPJS Kesehatan di RS Hamori</p>
                </div>
            </div>

            {{-- Tab Navigation --}}
            <div class="bpjs-tabs" id="bpjsTabs">
                <button class="bpjs-tab active" data-target="bpjsPanel1">
                    <i class="bi bi-clipboard2-pulse"></i> Rawat Jalan
                </button>
                <button class="bpjs-tab" data-target="bpjsPanel2">
                    <i class="bi bi-hospital"></i> IGD & Rawat Inap
                </button>
                <button class="bpjs-tab" data-target="bpjsPanel3">
                    <i class="bi bi-capsule"></i> Obat-obatan
                </button>
                <button class="bpjs-tab" data-target="bpjsPanel4">
                    <i class="bi bi-arrow-up-circle"></i> Upgrade Kamar
                </button>
                <button class="bpjs-tab" data-target="bpjsPanel5">
                    <i class="bi bi-activity"></i> Program Khusus
                </button>
            </div>

            {{-- Tab Panels --}}
            <div class="bpjs-panels">

                {{-- Panel 1: Rawat Jalan --}}
                <div class="bpjs-panel active" id="bpjsPanel1">
                    <div class="bpjs-card">
                        <div class="bpjs-card-head">
                            <span class="bpjs-badge"><i class="bi bi-clipboard2-pulse me-1"></i>Rawat Jalan (Poliklinik)</span>
                        </div>
                        <div class="bpjs-info-grid">
                            <div class="bpjs-info-row">
                                <div class="bpjs-info-label"><i class="bi bi-card-text"></i><span>Deskripsi</span></div>
                                <div class="bpjs-info-val">Pelayanan pemeriksaan dokter spesialis bagi pasien BPJS yang memiliki rujukan aktif dari Faskes Tingkat 1 (Puskesmas/Klinik).</div>
                            </div>
                            <div class="bpjs-info-row">
                                <div class="bpjs-info-label"><i class="bi bi-check-circle"></i><span>Syarat</span></div>
                                <div class="bpjs-info-val">Kartu BPJS/JKN-KIS berstatus <strong>aktif</strong>. Surat rujukan online terbaca di sistem PCare BPJS.</div>
                            </div>
                            <div class="bpjs-info-row">
                                <div class="bpjs-info-label"><i class="bi bi-folder2-open"></i><span>Dokumen</span></div>
                                <div class="bpjs-info-val">
                                    <div class="bpjs-doc-list">
                                        <span><i class="bi bi-file-person"></i> KTP / Kartu Identitas Anak (Asli & Fotokopi)</span>
                                        <span><i class="bi bi-credit-card"></i> Kartu BPJS Kesehatan (Asli & Fotokopi)</span>
                                        <span><i class="bi bi-file-earmark-medical"></i> Surat Rujukan dari Faskes Tingkat 1 (Asli & Fotokopi)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="bpjs-info-row bpjs-info-row--warn">
                                <div class="bpjs-info-label"><i class="bi bi-exclamation-triangle"></i><span>Catatan</span></div>
                                <div class="bpjs-info-val">Masa berlaku surat rujukan maksimal <strong>90 hari</strong> sejak tanggal diterbitkan oleh Faskes Tingkat 1.</div>
                            </div>
                            <div class="bpjs-info-row">
                                <div class="bpjs-info-label"><i class="bi bi-list-ol"></i><span>Prosedur</span></div>
                                <div class="bpjs-info-val">
                                    <ol class="bpjs-steps">
                                        <li>Kunjungi Faskes 1 (Puskesmas/Klinik) untuk pemeriksaan awal.</li>
                                        <li>Minta surat rujukan ke RS Hamori jika membutuhkan penanganan spesialis.</li>
                                        <li>Daftar via Aplikasi / WhatsApp H-1, atau datang langsung ke loket pendaftaran.</li>
                                        <li>Verifikasi berkas dan cetak Surat Eligibilitas Peserta (SEP).</li>
                                        <li>Menuju ke Poliklinik tujuan sesuai jadwal dokter.</li>
                                    </ol>
                                </div>
                            </div>
                            <div class="bpjs-info-row bpjs-info-row--source">
                                <div class="bpjs-info-label"><i class="bi bi-book"></i><span>Sumber</span></div>
                                <div class="bpjs-info-val">Buku Panduan Layanan JKN-KIS & Standar Operasional Prosedur RS Hamori</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Panel 2: IGD & Rawat Inap --}}
                <div class="bpjs-panel" id="bpjsPanel2">
                    <div class="bpjs-card">
                        <div class="bpjs-card-head">
                            <span class="bpjs-badge bpjs-badge--red"><i class="bi bi-hospital me-1"></i>IGD & Rawat Inap</span>
                        </div>
                        <div class="bpjs-info-grid">
                            <div class="bpjs-info-row">
                                <div class="bpjs-info-label"><i class="bi bi-card-text"></i><span>Deskripsi</span></div>
                                <div class="bpjs-info-val">Pelayanan kondisi gawat darurat yang mengancam nyawa atau membutuhkan tindakan segera — <strong>tanpa surat rujukan</strong>.</div>
                            </div>
                            <div class="bpjs-info-row">
                                <div class="bpjs-info-label"><i class="bi bi-check-circle"></i><span>Syarat</span></div>
                                <div class="bpjs-info-val">Sesuai kriteria kegawatdaruratan medis BPJS. Status kepesertaan BPJS aktif.</div>
                            </div>
                            <div class="bpjs-info-row">
                                <div class="bpjs-info-label"><i class="bi bi-folder2-open"></i><span>Dokumen</span></div>
                                <div class="bpjs-info-val">
                                    <div class="bpjs-doc-list">
                                        <span><i class="bi bi-file-person"></i> KTP / Kartu Identitas Anak (Asli & Fotokopi)</span>
                                        <span><i class="bi bi-credit-card"></i> Kartu BPJS Kesehatan (Asli & Fotokopi)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="bpjs-info-row bpjs-info-row--warn">
                                <div class="bpjs-info-label"><i class="bi bi-exclamation-triangle"></i><span>Catatan</span></div>
                                <div class="bpjs-info-val">Dokumen dapat disusulkan paling lambat <strong>3×24 jam</strong> sejak masuk rawat inap, atau sebelum pasien pulang (mana yang lebih dulu).</div>
                            </div>
                            <div class="bpjs-info-row">
                                <div class="bpjs-info-label"><i class="bi bi-list-ol"></i><span>Prosedur</span></div>
                                <div class="bpjs-info-val">
                                    <ol class="bpjs-steps">
                                        <li>Pasien datang langsung ke IGD RS Hamori.</li>
                                        <li>Pemeriksaan kegawatdaruratan dan tindakan stabilisasi oleh tim medis.</li>
                                        <li>Keluarga melakukan registrasi BPJS di loket pendaftaran IGD.</li>
                                        <li>Pasien dilanjutkan ke ruang perawatan (Rawat Inap) jika ada indikasi medis.</li>
                                    </ol>
                                </div>
                            </div>
                            <div class="bpjs-info-row bpjs-info-row--source">
                                <div class="bpjs-info-label"><i class="bi bi-book"></i><span>Sumber</span></div>
                                <div class="bpjs-info-val">Peraturan Presiden JKN & Regulasi Medis IGD RS Hamori</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Panel 3: Obat-obatan --}}
                <div class="bpjs-panel" id="bpjsPanel3">
                    <div class="bpjs-card">
                        <div class="bpjs-card-head">
                            <span class="bpjs-badge bpjs-badge--blue"><i class="bi bi-capsule me-1"></i>Obat-obatan BPJS</span>
                        </div>
                        <div class="bpjs-info-grid">
                            <div class="bpjs-info-row">
                                <div class="bpjs-info-label"><i class="bi bi-card-text"></i><span>Deskripsi</span></div>
                                <div class="bpjs-info-val">Obat yang diresepkan dokter spesialis RS Hamori ditanggung BPJS sesuai <strong>Formularium Nasional (Fornas)</strong> yang berlaku.</div>
                            </div>
                            <div class="bpjs-info-row">
                                <div class="bpjs-info-label"><i class="bi bi-check-circle"></i><span>Syarat</span></div>
                                <div class="bpjs-info-val">Resep dari dokter RS Hamori. Obat tercantum dalam Formularium Nasional. Status BPJS aktif.</div>
                            </div>
                            <div class="bpjs-info-row">
                                <div class="bpjs-info-label"><i class="bi bi-folder2-open"></i><span>Dokumen</span></div>
                                <div class="bpjs-info-val">
                                    <div class="bpjs-doc-list">
                                        <span><i class="bi bi-file-earmark-text"></i> Resep dokter asli dari poliklinik RS Hamori</span>
                                        <span><i class="bi bi-credit-card"></i> Kartu BPJS Kesehatan</span>
                                        <span><i class="bi bi-file-earmark-medical"></i> Surat Eligibilitas Peserta (SEP)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="bpjs-info-row bpjs-info-row--warn">
                                <div class="bpjs-info-label"><i class="bi bi-exclamation-triangle"></i><span>Catatan</span></div>
                                <div class="bpjs-info-val">Jika obat tidak tersedia di Farmasi RS Hamori, dokter memberikan form obat <strong>PRB (Program Rujuk Balik)</strong> ke apotek jejaring BPJS terdekat.</div>
                            </div>
                            <div class="bpjs-info-row">
                                <div class="bpjs-info-label"><i class="bi bi-list-ol"></i><span>Prosedur</span></div>
                                <div class="bpjs-info-val">
                                    <ol class="bpjs-steps">
                                        <li>Terima resep dari dokter spesialis setelah konsultasi.</li>
                                        <li>Bawa resep ke Instalasi Farmasi RS Hamori.</li>
                                        <li>Tunjukkan kartu BPJS dan SEP kepada petugas farmasi.</li>
                                        <li>Obat diserahkan <strong>tanpa biaya tambahan</strong> jika sesuai Fornas.</li>
                                    </ol>
                                </div>
                            </div>
                            <div class="bpjs-info-row bpjs-info-row--source">
                                <div class="bpjs-info-label"><i class="bi bi-book"></i><span>Sumber</span></div>
                                <div class="bpjs-info-val">Permenkes tentang Formularium Nasional & Panduan Farmasi RS Hamori</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Panel 4: Upgrade Kamar --}}
                <div class="bpjs-panel" id="bpjsPanel4">
                    <div class="bpjs-card">
                        <div class="bpjs-card-head">
                            <span class="bpjs-badge bpjs-badge--purple"><i class="bi bi-arrow-up-circle me-1"></i>Upgrade Kamar Rawat Inap</span>
                        </div>
                        <div class="bpjs-info-grid">
                            <div class="bpjs-info-row">
                                <div class="bpjs-info-label"><i class="bi bi-card-text"></i><span>Deskripsi</span></div>
                                <div class="bpjs-info-val">Peserta BPJS dapat naik ke kelas kamar yang lebih tinggi dari haknya dengan membayar <strong>selisih biaya (iur biaya)</strong> secara mandiri.</div>
                            </div>
                            <div class="bpjs-info-row">
                                <div class="bpjs-info-label"><i class="bi bi-check-circle"></i><span>Syarat</span></div>
                                <div class="bpjs-info-val">Permintaan atas keinginan sendiri atau kamar sesuai hak penuh. Status BPJS aktif dan iuran tidak menunggak.</div>
                            </div>
                            <div class="bpjs-info-row">
                                <div class="bpjs-info-label"><i class="bi bi-folder2-open"></i><span>Dokumen</span></div>
                                <div class="bpjs-info-val">
                                    <div class="bpjs-doc-list">
                                        <span><i class="bi bi-file-person"></i> KTP & Kartu BPJS</span>
                                        <span><i class="bi bi-file-earmark-text"></i> Surat pernyataan naik kelas (disiapkan oleh RS)</span>
                                        <span><i class="bi bi-pen"></i> Persetujuan tertulis dari pasien/keluarga</span>
                                    </div>
                                </div>
                            </div>
                            <div class="bpjs-info-row bpjs-info-row--warn">
                                <div class="bpjs-info-label"><i class="bi bi-exclamation-triangle"></i><span>Catatan</span></div>
                                <div class="bpjs-info-val">Iur biaya <strong>hanya mencakup akomodasi kamar</strong>. Biaya tindakan medis, operasi, dan obat (sesuai Fornas) tetap <strong>ditanggung penuh BPJS</strong>.</div>
                            </div>
                            <div class="bpjs-info-row">
                                <div class="bpjs-info-label"><i class="bi bi-list-ol"></i><span>Prosedur</span></div>
                                <div class="bpjs-info-val">
                                    <ol class="bpjs-steps">
                                        <li>Sampaikan keinginan naik kelas ke petugas Admisi/Rawat Inap.</li>
                                        <li>Petugas menjelaskan rincian selisih biaya.</li>
                                        <li>Tanda tangani surat pernyataan naik kelas.</li>
                                        <li>Pasien ditempatkan di kamar pilihan.</li>
                                    </ol>
                                </div>
                            </div>
                            <div class="bpjs-info-row bpjs-info-row--source">
                                <div class="bpjs-info-label"><i class="bi bi-book"></i><span>Sumber</span></div>
                                <div class="bpjs-info-val">Peraturan BPJS Kesehatan tentang Iur Biaya & Kebijakan Rawat Inap RS Hamori</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Panel 5: Program Khusus --}}
                <div class="bpjs-panel" id="bpjsPanel5">
                    <div class="bpjs-card">
                        <div class="bpjs-card-head">
                            <span class="bpjs-badge bpjs-badge--orange"><i class="bi bi-activity me-1"></i>Program Khusus (Hemodialisa, Kemoterapi, Rehabilitasi)</span>
                        </div>
                        <div class="bpjs-info-grid">
                            <div class="bpjs-info-row">
                                <div class="bpjs-info-label"><i class="bi bi-card-text"></i><span>Deskripsi</span></div>
                                <div class="bpjs-info-val">Layanan penyakit kronis yang membutuhkan kunjungan rutin seperti <strong>Cuci Darah, Kemoterapi, dan Rehabilitasi Medis</strong> — ditanggung penuh BPJS dengan prosedur khusus.</div>
                            </div>
                            <div class="bpjs-info-row">
                                <div class="bpjs-info-label"><i class="bi bi-check-circle"></i><span>Syarat</span></div>
                                <div class="bpjs-info-val">Ada surat rujukan ke spesialis RS Hamori. Sudah mendapat rencana terapi dari dokter. Status BPJS aktif.</div>
                            </div>
                            <div class="bpjs-info-row">
                                <div class="bpjs-info-label"><i class="bi bi-folder2-open"></i><span>Dokumen</span></div>
                                <div class="bpjs-info-val">
                                    <div class="bpjs-doc-list">
                                        <span><i class="bi bi-file-person"></i> KTP & Kartu BPJS</span>
                                        <span><i class="bi bi-file-earmark-medical"></i> Surat Rujukan (kunjungan pertama)</span>
                                        <span><i class="bi bi-calendar-week"></i> Surat Perintah Terapi / Jadwal Terapi dari dokter</span>
                                        <span><i class="bi bi-clipboard2-data"></i> Hasil pemeriksaan penunjang (lab, USG, dll.)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="bpjs-info-row bpjs-info-row--warn">
                                <div class="bpjs-info-label"><i class="bi bi-exclamation-triangle"></i><span>Catatan</span></div>
                                <div class="bpjs-info-val">Untuk kunjungan <strong>rutin</strong> (sesi cuci darah ke-2 dst.), pasien <strong>tidak perlu</strong> kembali ke Faskes 1 meminta rujukan baru. Cukup bawa kartu BPJS dan jadwal terapi.</div>
                            </div>
                            <div class="bpjs-info-row">
                                <div class="bpjs-info-label"><i class="bi bi-list-ol"></i><span>Prosedur</span></div>
                                <div class="bpjs-info-val">
                                    <ol class="bpjs-steps">
                                        <li>Konsultasi ke Faskes 1 dan dapatkan surat rujukan ke spesialis.</li>
                                        <li>Dokter spesialis RS Hamori menetapkan rencana & jadwal terapi.</li>
                                        <li>Datang sesuai jadwal ke Unit Hemodialisa / Kemoterapi / Rehabilitasi.</li>
                                        <li>Verifikasi BPJS dilakukan oleh petugas setiap kunjungan.</li>
                                    </ol>
                                </div>
                            </div>
                            <div class="bpjs-info-row bpjs-info-row--source">
                                <div class="bpjs-info-label"><i class="bi bi-book"></i><span>Sumber</span></div>
                                <div class="bpjs-info-val">Panduan Teknis Pelayanan BPJS untuk Penyakit Kronis & SOP Unit Khusus RS Hamori</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>{{-- end bpjs-panels --}}

            {{-- FAQ BPJS --}}
            <div class="bpjs-faq-wrap mt-5">
                <h5 class="bpjs-faq-title"><i class="bi bi-question-circle me-2"></i>Pertanyaan Umum Seputar BPJS</h5>
                <div class="bpjs-faq-grid">
                    <div class="bpjs-faq-item">
                        <div class="bpjs-faq-q"><i class="bi bi-chevron-right"></i>Bagaimana cara cek status kepesertaan BPJS?</div>
                        <div class="bpjs-faq-a">Melalui Aplikasi <strong>Mobile JKN</strong>, website <strong>bpjs-kesehatan.go.id</strong>, Call Center BPJS <strong>165</strong>, atau langsung ke kantor BPJS Kesehatan terdekat.</div>
                    </div>
                    <div class="bpjs-faq-item">
                        <div class="bpjs-faq-q"><i class="bi bi-chevron-right"></i>Apa yang harus dilakukan jika iuran menunggak?</div>
                        <div class="bpjs-faq-a">Segera lunasi tunggakan melalui bank, minimarket, atau aplikasi Mobile JKN. Kepesertaan aktif kembali dalam <strong>24 jam</strong> setelah pembayaran.</div>
                    </div>
                    <div class="bpjs-faq-item">
                        <div class="bpjs-faq-q"><i class="bi bi-chevron-right"></i>Apakah ada biaya administrasi di RS Hamori?</div>
                        <div class="bpjs-faq-a">Tidak ada. Semua biaya rawat jalan, rawat inap, obat (sesuai Fornas), dan tindakan medis yang tercakup JKN <strong>ditanggung penuh BPJS</strong>.</div>
                    </div>
                    <div class="bpjs-faq-item">
                        <div class="bpjs-faq-q"><i class="bi bi-chevron-right"></i>Bisakah langsung ke RS Hamori tanpa ke Puskesmas dulu?</div>
                        <div class="bpjs-faq-a">Untuk rawat jalan non-darurat, wajib ke Faskes 1 dulu untuk mendapat rujukan. Untuk <strong>kondisi darurat (IGD)</strong>, bisa langsung ke RS Hamori tanpa rujukan.</div>
                    </div>
                </div>
            </div>

        </div>{{-- end bpjs-section --}}
            <div class="accordion" id="faqBpjs">
                
                <!-- Rawat Jalan -->
                <div class="accordion-item border-0 rounded-4 shadow-sm mb-3 overflow-hidden">
                    <h2 class="accordion-header">
                        <button class="accordion-button bg-white fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#bpjs1">
                            [Kategori] Pelayanan Rawat Jalan (Poliklinik)
                        </button>
                    </h2>
                    <div id="bpjs1" class="accordion-collapse collapse" data-bs-parent="#faqBpjs">
                        <div class="accordion-body p-0">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0" style="font-size: 14px;">
                                    <tbody>
                                        <tr>
                                            <th style="width: 250px; background-color: #f8fafc; color: var(--ink);">RINGKASAN/DESKRIPSI</th>
                                            <td class="text-muted">Pelayanan pemeriksaan dokter spesialis bagi pasien BPJS yang memiliki rujukan aktif dari Faskes Tingkat 1.</td>
                                        </tr>
                                        <tr>
                                            <th style="background-color: #f8fafc; color: var(--ink);">SYARAT</th>
                                            <td class="text-muted">Kartu BPJS/JKN-KIS berstatus aktif. Surat rujukan online terbaca di sistem PCare.</td>
                                        </tr>
                                        <tr>
                                            <th style="background-color: #f8fafc; color: var(--ink);">DOKUMEN YANG DIBUTUHKAN</th>
                                            <td class="text-muted">
                                                <ul class="mb-0 ps-3">
                                                    <li>KTP / Kartu Identitas Anak Asli & Fotokopi</li>
                                                    <li>Kartu BPJS Asli & Fotokopi</li>
                                                    <li>Surat Rujukan dari Faskes Tingkat 1 Asli & Fotokopi</li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="background-color: #f8fafc; color: var(--ink);">CATATAN PENTING</th>
                                            <td class="text-muted">Pastikan masa berlaku surat rujukan belum habis (maksimal 90 hari sejak diterbitkan oleh Faskes Tingkat 1).</td>
                                        </tr>
                                        <tr>
                                            <th style="background-color: #f8fafc; color: var(--ink);">PROSEDUR</th>
                                            <td class="text-muted">
                                                <ol class="mb-0 ps-3">
                                                    <li>Datang ke Faskes 1 untuk pemeriksaan awal.</li>
                                                    <li>Minta rujukan ke RS Hamori jika indikasi medis mengharuskan pemeriksaan spesialis.</li>
                                                    <li>Daftar via aplikasi/WA H-1 atau datang langsung ke loket.</li>
                                                    <li>Lakukan verifikasi berkas dan cetak Surat Eligibilitas Peserta (SEP).</li>
                                                    <li>Menuju ke Poliklinik tujuan.</li>
                                                </ol>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="background-color: #f8fafc; color: var(--ink);">SUMBER</th>
                                            <td class="text-muted">Buku Panduan Layanan JKN-KIS & Standar Operasional Prosedur RS Hamori</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Rawat Inap / IGD -->
                <div class="accordion-item border-0 rounded-4 shadow-sm mb-3 overflow-hidden">
                    <h2 class="accordion-header">
                        <button class="accordion-button bg-white fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#bpjs2">
                            [Kategori] Gawat Darurat (IGD) & Rawat Inap
                        </button>
                    </h2>
                    <div id="bpjs2" class="accordion-collapse collapse" data-bs-parent="#faqBpjs">
                        <div class="accordion-body p-0">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0" style="font-size: 14px;">
                                    <tbody>
                                        <tr>
                                            <th style="width: 250px; background-color: #f8fafc; color: var(--ink);">RINGKASAN/DESKRIPSI</th>
                                            <td class="text-muted">Pelayanan kondisi gawat darurat yang mengancam nyawa atau membutuhkan tindakan segera (tanpa surat rujukan).</td>
                                        </tr>
                                        <tr>
                                            <th style="background-color: #f8fafc; color: var(--ink);">SYARAT</th>
                                            <td class="text-muted">Sesuai dengan kriteria gawat darurat (kegawatdaruratan medis) yang ditetapkan oleh BPJS Kesehatan. Status kepesertaan BPJS aktif.</td>
                                        </tr>
                                        <tr>
                                            <th style="background-color: #f8fafc; color: var(--ink);">DOKUMEN YANG DIBUTUHKAN</th>
                                            <td class="text-muted">
                                                <ul class="mb-0 ps-3">
                                                    <li>KTP / Kartu Identitas Anak Asli & Fotokopi</li>
                                                    <li>Kartu BPJS Asli & Fotokopi</li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="background-color: #f8fafc; color: var(--ink);">CATATAN PENTING</th>
                                            <td class="text-muted">Dokumen pendaftaran dapat disusulkan paling lambat 3x24 jam sejak pasien masuk rawat inap atau sebelum pasien pulang (mana yang lebih dulu).</td>
                                        </tr>
                                        <tr>
                                            <th style="background-color: #f8fafc; color: var(--ink);">PROSEDUR</th>
                                            <td class="text-muted">
                                                <ol class="mb-0 ps-3">
                                                    <li>Pasien datang langsung ke IGD RS Hamori.</li>
                                                    <li>Pemeriksaan kegawatdaruratan dan tindakan stabilisasi oleh tim medis.</li>
                                                    <li>Keluarga pasien melakukan registrasi BPJS di loket pendaftaran IGD.</li>
                                                    <li>Pasien akan dilanjutkan ke ruang perawatan (Rawat Inap) jika ada indikasi medis.</li>
                                                </ol>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="background-color: #f8fafc; color: var(--ink);">SUMBER</th>
                                            <td class="text-muted">Peraturan Presiden JKN & Regulasi Medis IGD RS Hamori</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Obat-obatan -->
                <div class="accordion-item border-0 rounded-4 shadow-sm mb-3 overflow-hidden">
                    <h2 class="accordion-header">
                        <button class="accordion-button bg-white fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#bpjs3">
                            [Kategori] Pelayanan Obat-obatan BPJS
                        </button>
                    </h2>
                    <div id="bpjs3" class="accordion-collapse collapse" data-bs-parent="#faqBpjs">
                        <div class="accordion-body p-0">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0" style="font-size: 14px;">
                                    <tbody>
                                        <tr>
                                            <th style="width: 250px; background-color: #f8fafc; color: var(--ink);">RINGKASAN/DESKRIPSI</th>
                                            <td class="text-muted">Obat-obatan yang diresepkan dokter spesialis RS Hamori ditanggung oleh BPJS sesuai dengan Formularium Nasional (Fornas) yang berlaku.</td>
                                        </tr>
                                        <tr>
                                            <th style="background-color: #f8fafc; color: var(--ink);">SYARAT</th>
                                            <td class="text-muted">Resep ditulis oleh dokter yang bertugas di RS Hamori. Obat yang diresepkan tercantum dalam Formularium Nasional. Status kepesertaan BPJS aktif.</td>
                                        </tr>
                                        <tr>
                                            <th style="background-color: #f8fafc; color: var(--ink);">DOKUMEN YANG DIBUTUHKAN</th>
                                            <td class="text-muted">
                                                <ul class="mb-0 ps-3">
                                                    <li>Resep dokter asli dari poliklinik RS Hamori</li>
                                                    <li>Kartu BPJS Asli</li>
                                                    <li>Surat Eligibilitas Peserta (SEP)</li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="background-color: #f8fafc; color: var(--ink);">CATATAN PENTING</th>
                                            <td class="text-muted">Jika obat yang dibutuhkan tidak tersedia di Instalasi Farmasi RS Hamori, dokter akan memberikan surat permohonan obat ke apotek jejaring BPJS terdekat (menggunakan form obat PRB — Program Rujuk Balik).</td>
                                        </tr>
                                        <tr>
                                            <th style="background-color: #f8fafc; color: var(--ink);">PROSEDUR</th>
                                            <td class="text-muted">
                                                <ol class="mb-0 ps-3">
                                                    <li>Setelah konsultasi, terima resep dari dokter spesialis.</li>
                                                    <li>Bawa resep ke Instalasi Farmasi RS Hamori.</li>
                                                    <li>Tunjukkan kartu BPJS dan SEP kepada petugas farmasi.</li>
                                                    <li>Obat akan diserahkan tanpa biaya tambahan (jika sesuai Fornas).</li>
                                                </ol>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="background-color: #f8fafc; color: var(--ink);">SUMBER</th>
                                            <td class="text-muted">Permenkes tentang Formularium Nasional & Panduan Farmasi RS Hamori</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Naik Kelas Rawat Inap -->
                <div class="accordion-item border-0 rounded-4 shadow-sm mb-3 overflow-hidden">
                    <h2 class="accordion-header">
                        <button class="accordion-button bg-white fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#bpjs4">
                            [Kategori] Naik Kelas Rawat Inap (Upgrade Kamar)
                        </button>
                    </h2>
                    <div id="bpjs4" class="accordion-collapse collapse" data-bs-parent="#faqBpjs">
                        <div class="accordion-body p-0">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0" style="font-size: 14px;">
                                    <tbody>
                                        <tr>
                                            <th style="width: 250px; background-color: #f8fafc; color: var(--ink);">RINGKASAN/DESKRIPSI</th>
                                            <td class="text-muted">Peserta BPJS dapat memilih kamar rawat inap di atas haknya dengan membayar selisih biaya secara mandiri (iur biaya), sepanjang tersedia kamar yang diinginkan.</td>
                                        </tr>
                                        <tr>
                                            <th style="background-color: #f8fafc; color: var(--ink);">SYARAT</th>
                                            <td class="text-muted">Permintaan naik kelas atas keinginan sendiri atau kondisi kamar sesuai hak penuh terisi. Status kepesertaan BPJS aktif dan iuran tidak menunggak.</td>
                                        </tr>
                                        <tr>
                                            <th style="background-color: #f8fafc; color: var(--ink);">DOKUMEN YANG DIBUTUHKAN</th>
                                            <td class="text-muted">
                                                <ul class="mb-0 ps-3">
                                                    <li>KTP & Kartu BPJS</li>
                                                    <li>Surat pernyataan naik kelas (disiapkan oleh RS)</li>
                                                    <li>Persetujuan tertulis dari pasien/keluarga</li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="background-color: #f8fafc; color: var(--ink);">CATATAN PENTING</th>
                                            <td class="text-muted">Iur biaya (selisih) yang harus dibayar pasien hanya mencakup biaya akomodasi kamar. Biaya tindakan medis, operasi, dan obat-obatan (sesuai Fornas) tetap ditanggung penuh oleh BPJS.</td>
                                        </tr>
                                        <tr>
                                            <th style="background-color: #f8fafc; color: var(--ink);">PROSEDUR</th>
                                            <td class="text-muted">
                                                <ol class="mb-0 ps-3">
                                                    <li>Sampaikan keinginan naik kelas kepada petugas Admisi/Rawat Inap RS Hamori.</li>
                                                    <li>Petugas akan menjelaskan rincian selisih biaya yang harus dibayar.</li>
                                                    <li>Tanda tangani surat pernyataan naik kelas.</li>
                                                    <li>Pasien akan ditempatkan di kamar yang dipilih.</li>
                                                </ol>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="background-color: #f8fafc; color: var(--ink);">SUMBER</th>
                                            <td class="text-muted">Peraturan BPJS Kesehatan tentang Iur Biaya & Kebijakan Rawat Inap RS Hamori</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Program Khusus -->
                <div class="accordion-item border-0 rounded-4 shadow-sm mb-3 overflow-hidden">
                    <h2 class="accordion-header">
                        <button class="accordion-button bg-white fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#bpjs5">
                            [Kategori] Program Khusus (Hemodialisa, Kemoterapi, Rehabilitasi)
                        </button>
                    </h2>
                    <div id="bpjs5" class="accordion-collapse collapse" data-bs-parent="#faqBpjs">
                        <div class="accordion-body p-0">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0" style="font-size: 14px;">
                                    <tbody>
                                        <tr>
                                            <th style="width: 250px; background-color: #f8fafc; color: var(--ink);">RINGKASAN/DESKRIPSI</th>
                                            <td class="text-muted">Pelayanan penyakit kronis yang membutuhkan kunjungan rutin seperti Cuci Darah (Hemodialisa), Kemoterapi, dan Rehabilitasi Medis ditanggung penuh oleh BPJS dengan prosedur khusus.</td>
                                        </tr>
                                        <tr>
                                            <th style="background-color: #f8fafc; color: var(--ink);">SYARAT</th>
                                            <td class="text-muted">Memiliki surat rujukan dari Faskes 1 ke poliklinik terkait di RS Hamori. Sudah mendapat rencana terapi dari dokter spesialis RS Hamori. Status BPJS aktif.</td>
                                        </tr>
                                        <tr>
                                            <th style="background-color: #f8fafc; color: var(--ink);">DOKUMEN YANG DIBUTUHKAN</th>
                                            <td class="text-muted">
                                                <ul class="mb-0 ps-3">
                                                    <li>KTP & Kartu BPJS</li>
                                                    <li>Surat Rujukan (untuk kunjungan pertama)</li>
                                                    <li>Surat Perintah Terapi / Jadwal Terapi dari dokter</li>
                                                    <li>Hasil pemeriksaan penunjang yang relevan (lab, USG, dll.)</li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="background-color: #f8fafc; color: var(--ink);">CATATAN PENTING</th>
                                            <td class="text-muted">Untuk kunjungan tindakan <strong>rutin</strong> (seperti sesi cuci darah ke-2 dan seterusnya), pasien tidak perlu kembali ke Faskes 1 untuk meminta rujukan baru. Cukup bawa kartu BPJS dan jadwal terapi yang sudah ada.</td>
                                        </tr>
                                        <tr>
                                            <th style="background-color: #f8fafc; color: var(--ink);">PROSEDUR</th>
                                            <td class="text-muted">
                                                <ol class="mb-0 ps-3">
                                                    <li>Konsultasi ke Faskes 1 dan dapatkan surat rujukan ke spesialis terkait.</li>
                                                    <li>Dokter spesialis RS Hamori menetapkan rencana dan jadwal terapi.</li>
                                                    <li>Pasien datang sesuai jadwal ke Unit Hemodialisa / Kemoterapi / Rehabilitasi Medis.</li>
                                                    <li>Verifikasi BPJS dilakukan oleh petugas setiap kunjungan.</li>
                                                </ol>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="background-color: #f8fafc; color: var(--ink);">SUMBER</th>
                                            <td class="text-muted">Panduan Teknis Pelayanan BPJS untuk Penyakit Kronis & SOP Unit Khusus RS Hamori</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- FAQ Tambahan tentang BPJS --}}
            <div class="mt-4">
                <div class="text-center mb-3">
                    <h5 class="fw-bold" style="color:var(--ink);">Pertanyaan Umum Seputar BPJS</h5>
                </div>
                <div class="accordion" id="faqBpjsExtra">
                    <div class="accordion-item border-0 rounded-4 shadow-sm mb-3 overflow-hidden">
                        <h2 class="accordion-header">
                            <button class="accordion-button bg-white fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#bpjsq1">
                                Bagaimana cara cek status kepesertaan BPJS saya aktif atau tidak?
                            </button>
                        </h2>
                        <div id="bpjsq1" class="accordion-collapse collapse" data-bs-parent="#faqBpjsExtra">
                            <div class="accordion-body text-muted">
                                Anda dapat mengecek status kepesertaan BPJS melalui: (1) Aplikasi Mobile JKN di HP Anda, (2) Website resmi BPJS di <strong>bpjs-kesehatan.go.id</strong>, (3) Menghubungi Call Center BPJS di nomor <strong>165</strong>, atau (4) Datang langsung ke kantor BPJS Kesehatan terdekat.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 rounded-4 shadow-sm mb-3 overflow-hidden">
                        <h2 class="accordion-header">
                            <button class="accordion-button bg-white fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#bpjsq2">
                                Apa yang harus dilakukan jika iuran BPJS saya menunggak?
                            </button>
                        </h2>
                        <div id="bpjsq2" class="accordion-collapse collapse" data-bs-parent="#faqBpjsExtra">
                            <div class="accordion-body text-muted">
                                Jika iuran menunggak, kepesertaan BPJS akan dinonaktifkan sementara dan Anda tidak dapat menggunakan fasilitas layanan kesehatan. Segera lunasi tunggakan iuran melalui bank, minimarket, atau aplikasi Mobile JKN. Kepesertaan akan aktif kembali 24 jam setelah pembayaran.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 rounded-4 shadow-sm mb-3 overflow-hidden">
                        <h2 class="accordion-header">
                            <button class="accordion-button bg-white fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#bpjsq3">
                                Apakah peserta BPJS perlu membayar biaya administrasi di RS Hamori?
                            </button>
                        </h2>
                        <div id="bpjsq3" class="accordion-collapse collapse" data-bs-parent="#faqBpjsExtra">
                            <div class="accordion-body text-muted">
                                Tidak ada biaya administrasi tambahan untuk pelayanan yang dijamin BPJS. Semua biaya rawat jalan, rawat inap, obat (sesuai Fornas), dan tindakan medis yang tercakup dalam manfaat JKN ditanggung sepenuhnya oleh BPJS Kesehatan.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 rounded-4 shadow-sm mb-3 overflow-hidden">
                        <h2 class="accordion-header">
                            <button class="accordion-button bg-white fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#bpjsq4">
                                Apakah saya bisa langsung ke RS Hamori tanpa ke Puskesmas/Klinik terlebih dahulu?
                            </button>
                        </h2>
                        <div id="bpjsq4" class="accordion-collapse collapse" data-bs-parent="#faqBpjsExtra">
                            <div class="accordion-body text-muted">
                                Untuk pelayanan <strong>rawat jalan non-darurat</strong>, Anda wajib datang ke Faskes Tingkat 1 (Puskesmas/Klinik) terlebih dahulu dan mendapatkan surat rujukan jika membutuhkan penanganan spesialis. Namun, untuk kondisi <strong>gawat darurat (IGD)</strong>, Anda dapat langsung datang ke RS Hamori tanpa surat rujukan.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

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

        // BPJS Tab switching
        const bpjsTabs = document.querySelectorAll('.bpjs-tab');
        const bpjsPanels = document.querySelectorAll('.bpjs-panel');
        bpjsTabs.forEach(tab => {
            tab.addEventListener('click', () => {
                bpjsTabs.forEach(t => t.classList.remove('active'));
                bpjsPanels.forEach(p => p.classList.remove('active'));
                tab.classList.add('active');
                const target = document.getElementById(tab.dataset.target);
                if (target) target.classList.add('active');
            });
        });
    });
</script>

@push('styles')
<style>
/* ========== BPJS Section ========== */
.bpjs-section { max-width: 900px; margin-left: auto; margin-right: auto; }

.bpjs-header {
    display: flex;
    align-items: center;
    gap: 16px;
    background: linear-gradient(135deg, #0d6e56, #1b9e77);
    border-radius: 16px;
    padding: 24px 28px;
    margin-bottom: 28px;
    color: #fff;
}
.bpjs-header-icon {
    font-size: 38px;
    opacity: 0.95;
    flex-shrink: 0;
}
.bpjs-header-title { font-size: 20px; font-weight: 700; margin: 0 0 4px; }
.bpjs-header-sub   { font-size: 13.5px; opacity: 0.85; margin: 0; }

/* Tabs */
.bpjs-tabs {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
    margin-bottom: 20px;
    border-bottom: 2px solid #e8f0ed;
    padding-bottom: 0;
}
.bpjs-tab {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 10px 18px;
    border: none;
    background: transparent;
    font-size: 13.5px;
    font-weight: 600;
    color: #64748b;
    cursor: pointer;
    border-bottom: 3px solid transparent;
    margin-bottom: -2px;
    border-radius: 6px 6px 0 0;
    transition: color .2s, border-color .2s, background .2s;
}
.bpjs-tab:hover { color: #0d6e56; background: #f0faf6; }
.bpjs-tab.active { color: #0d6e56; border-bottom-color: #0d6e56; background: #f0faf6; }

/* Panels */
.bpjs-panel { display: none; }
.bpjs-panel.active { display: block; }

.bpjs-card {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 2px 20px rgba(0,0,0,0.07);
    overflow: hidden;
    border: 1px solid #e8f0ed;
}
.bpjs-card-head {
    padding: 18px 24px;
    background: #f7fdfb;
    border-bottom: 1px solid #e0ece8;
}
.bpjs-badge {
    display: inline-flex;
    align-items: center;
    font-size: 13px;
    font-weight: 700;
    padding: 6px 14px;
    border-radius: 999px;
    background: #d1f7ea;
    color: #0d6e56;
    letter-spacing: .3px;
}
.bpjs-badge--red    { background: #ffe4e4; color: #b91c1c; }
.bpjs-badge--blue   { background: #dbeafe; color: #1e40af; }
.bpjs-badge--purple { background: #ede9fe; color: #6d28d9; }
.bpjs-badge--orange { background: #ffedd5; color: #c2410c; }

/* Info grid rows */
.bpjs-info-grid { display: flex; flex-direction: column; }
.bpjs-info-row {
    display: flex;
    align-items: flex-start;
    gap: 0;
    border-bottom: 1px solid #f0f4f2;
}
.bpjs-info-row:last-child { border-bottom: none; }
.bpjs-info-label {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
    gap: 5px;
    min-width: 110px;
    width: 110px;
    padding: 18px 12px;
    background: #f7fdfb;
    border-right: 1px solid #e0ece8;
    text-align: center;
    font-size: 11px;
    font-weight: 700;
    color: #0d6e56;
    text-transform: uppercase;
    letter-spacing: .5px;
    flex-shrink: 0;
}
.bpjs-info-label i { font-size: 18px; color: #1b9e77; }
.bpjs-info-row--warn .bpjs-info-label { color: #b45309; background: #fffbf0; border-right-color: #fde68a; }
.bpjs-info-row--warn .bpjs-info-label i { color: #f59e0b; }
.bpjs-info-row--warn { background: #fffdf5; }
.bpjs-info-row--source .bpjs-info-label { color: #6b7280; background: #f9fafb; }
.bpjs-info-row--source .bpjs-info-label i { color: #9ca3af; }
.bpjs-info-row--source { background: #f9fafb; }
.bpjs-info-val {
    padding: 16px 20px;
    font-size: 14px;
    color: #374151;
    line-height: 1.7;
    flex: 1;
}

/* Doc list */
.bpjs-doc-list { display: flex; flex-direction: column; gap: 8px; }
.bpjs-doc-list span {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 13.5px;
    background: #f0faf6;
    border: 1px solid #d1e8df;
    border-radius: 8px;
    padding: 7px 12px;
    color: #1f5c45;
}
.bpjs-doc-list span i { font-size: 15px; color: #1b9e77; }

/* Steps */
.bpjs-steps { padding-left: 20px; margin: 0; display: flex; flex-direction: column; gap: 6px; }
.bpjs-steps li { font-size: 14px; color: #374151; line-height: 1.6; }
.bpjs-steps li::marker { color: #0d6e56; font-weight: 700; }

/* FAQ */
.bpjs-faq-wrap {
    background: #f7fdfb;
    border-radius: 16px;
    padding: 28px;
    border: 1px solid #d1e8df;
}
.bpjs-faq-title {
    font-size: 16px;
    font-weight: 700;
    color: #0d6e56;
    margin-bottom: 20px;
}
.bpjs-faq-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
}
.bpjs-faq-item {
    background: #fff;
    border-radius: 12px;
    padding: 18px 20px;
    border: 1px solid #e0ece8;
    box-shadow: 0 1px 6px rgba(0,0,0,0.04);
}
.bpjs-faq-q {
    font-size: 13.5px;
    font-weight: 700;
    color: #1f5c45;
    margin-bottom: 8px;
    display: flex;
    align-items: flex-start;
    gap: 6px;
}
.bpjs-faq-q i { color: #1b9e77; margin-top: 2px; flex-shrink: 0; }
.bpjs-faq-a { font-size: 13px; color: #6b7280; line-height: 1.65; }

@media (max-width: 640px) {
    .bpjs-info-label { min-width: 72px; width: 72px; font-size: 9.5px; padding: 14px 6px; }
    .bpjs-info-label i { font-size: 15px; }
    .bpjs-info-val { padding: 12px 14px; font-size: 13px; }
    .bpjs-faq-grid { grid-template-columns: 1fr; }
    .bpjs-tab { font-size: 12px; padding: 8px 12px; }
    .bpjs-header { padding: 18px 16px; }
    .bpjs-header-icon { font-size: 28px; }
    .bpjs-header-title { font-size: 16px; }
}
</style>
@endpush

@endsection