@extends('layouts.app')

@section('title', 'Kontak')

@section('content')

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

<section class="py-5">
    <div class="container">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="row g-5">
            {{-- Contact Info --}}
            <div class="col-lg-5">
                <h3 class="fw-bold mb-4">Informasi Kontak</h3>

                <div class="contact-info-item">
                    <div class="contact-icon"><i class="bi bi-geo-alt-fill"></i></div>
                    <div>
                        <strong>Alamat</strong>
                        <p class="mb-0">Jalan Raya Pagaden-Subang, Ds. Jabong Kec. Pagaden Kab. Subang Jawa Barat 41251</p>
                    </div>
                </div>

                <div class="contact-info-item">
                    <div class="contact-icon"><i class="bi bi-telephone-fill"></i></div>
                    <div>
                        <strong>Telepon & Call Center</strong>
                        <p class="mb-0">
                            <a href="tel:1500816">1500 816</a><br>
                            <a href="tel:02604250888">0260-4250 888</a>
                        </p>
                    </div>
                </div>

                <div class="contact-info-item">
                    <div class="contact-icon"><i class="bi bi-hospital-fill"></i></div>
                    <div>
                        <strong>IGD & Ambulans</strong>
                        <p class="mb-0"><a href="tel:02604250999">0260-4250 999</a></p>
                    </div>
                </div>

                <div class="contact-info-item">
                    <div class="contact-icon"><i class="bi bi-whatsapp"></i></div>
                    <div>
                        <strong>WhatsApp</strong>
                        <p class="mb-0"><a href="https://wa.me/628888905555" target="_blank">0888-890-5555</a></p>
                    </div>
                </div>

                {{-- Map --}}
                <div class="map-embed mt-4">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.3!2d107.6!3d-6.5!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMzAnMDAuMCJTIDEwN8KwMzYnMDAuMCJF!5e0!3m2!1sen!2sid!4v1"
                        width="100%" height="250" style="border:0; border-radius: 12px;" allowfullscreen loading="lazy">
                    </iframe>
                </div>
            </div>

            {{-- Contact Form --}}
            <div class="col-lg-7">
                <div class="contact-form-card">
                    <h3 class="fw-bold mb-4">Kirim Pesan</h3>
                    <form action="{{ route('kontak.send') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                                    value="{{ old('nama') }}" placeholder="Nama Anda" required>
                                @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}" placeholder="email@contoh.com" required>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nomor Telepon</label>
                                <input type="text" name="telepon" class="form-control"
                                    value="{{ old('telepon') }}" placeholder="08xx-xxxx-xxxx">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Subjek <span class="text-danger">*</span></label>
                                <input type="text" name="subjek" class="form-control @error('subjek') is-invalid @enderror"
                                    value="{{ old('subjek') }}" placeholder="Subjek pesan" required>
                                @error('subjek')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Pesan <span class="text-danger">*</span></label>
                                <textarea name="pesan" class="form-control @error('pesan') is-invalid @enderror"
                                    rows="5" placeholder="Tuliskan pesan Anda di sini..." required>{{ old('pesan') }}</textarea>
                                @error('pesan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary px-5">
                                    <i class="bi bi-send me-2"></i> Kirim Pesan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
