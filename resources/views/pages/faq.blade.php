@extends('layouts.app')
@section('title', 'FAQ')
@section('content')
<div class="page-header">
    <div class="container">
        <h1 class="page-title">FAQ</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">FAQ</li>
            </ol>
        </nav>
    </div>
</div>
<section class="py-5">
    <div class="container" style="max-width:800px">
        <div class="text-center mb-5">
            <span class="section-badge">Bantuan</span>
            <h2 class="section-title">Pertanyaan yang Sering Diajukan</h2>
        </div>
        <div class="accordion" id="faqAccordion">
            @foreach($faqs as $i => $faq)
            <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 overflow-hidden">
                <h2 class="accordion-header">
                    <button class="accordion-button {{ $i > 0 ? 'collapsed' : '' }} fw-semibold" type="button"
                        data-bs-toggle="collapse" data-bs-target="#faq{{ $faq->id }}">
                        {{ $faq->pertanyaan }}
                    </button>
                </h2>
                <div id="faq{{ $faq->id }}" class="accordion-collapse collapse {{ $i === 0 ? 'show' : '' }}" data-bs-parent="#faqAccordion">
                    <div class="accordion-body text-muted">{{ $faq->jawaban }}</div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-5 p-4 bg-light rounded-3">
            <h5>Masih ada pertanyaan?</h5>
            <p class="text-muted">Hubungi kami melalui telepon atau kirim pesan langsung.</p>
            <a href="{{ route('kontak') }}" class="btn btn-primary me-2">Hubungi Kami</a>
            <a href="https://wa.me/628888905555" target="_blank" class="btn btn-success">
                <i class="bi bi-whatsapp me-1"></i> WhatsApp
            </a>
        </div>
    </div>
</section>
@endsection
