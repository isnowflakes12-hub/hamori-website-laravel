@extends('layouts.app')
@section('title', 'FAQ')

@section('content')

{{-- ── PAGE HEADER ── --}}

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

{{-- ── SEARCH BAR (terpisah dari hero) ── --}}
<div class="fq-search-section">
    <div class="container">
        <div class="fq-search-wrap">
            <i class="fas fa-search fq-search-icon"></i>
            <input type="text" id="fqSearchInput" class="fq-search-input"
                   placeholder="Cari pertanyaan... contoh: jam kunjungan, BPJS, pendaftaran">
            <span class="fq-search-count" id="fqSearchCount"></span>
        </div>
    </div>
</div>

{{-- ── FAQ LIST ── --}}
<section class="fq-section sec">
    <div class="container">
        <div class="fq-wrap">

            @if($faqs->isEmpty())
            <div class="fq-empty">
                <div class="fq-empty-icon"><i class="fas fa-circle-question"></i></div>
                <h4 class="fq-empty-title">Belum Ada Pertanyaan</h4>
                <p class="fq-empty-desc">Daftar FAQ akan segera kami tambahkan.</p>
            </div>

            @else
            <div class="fq-accordion" id="fqAccordion">
                @foreach($faqs as $i => $faq)
                <div class="fq-item" data-faq-item>
                    <button class="fq-question {{ $i === 0 ? '' : 'fq-question--collapsed' }}"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#faq{{ $faq->id }}"
                            aria-expanded="{{ $i === 0 ? 'true' : 'false' }}">
                        <span class="fq-question-num">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        <span class="fq-question-text" data-faq-question>{{ $faq->pertanyaan }}</span>
                        <span class="fq-question-arrow"><i class="fas fa-chevron-down"></i></span>
                    </button>

                    <div id="faq{{ $faq->id }}"
                         class="fq-answer-collapse collapse {{ $i === 0 ? 'show' : '' }}"
                         data-bs-parent="#fqAccordion">
                        <div class="fq-answer" data-faq-answer>
                            {{ $faq->jawaban }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <p class="fq-no-result" id="fqNoResult" style="display:none">
                <i class="fas fa-magnifying-glass"></i>
                Tidak ada pertanyaan yang cocok dengan pencarian Anda.
            </p>
            @endif

        </div>
    </div>
</section>

{{-- ── CTA BANNER ── --}}
<section class="fq-cta-section">
    <div class="container">
        <div class="fq-cta-inner">
            <div class="fq-cta-glow"></div>
            <div class="fq-cta-icon-wrap">
                <i class="fas fa-headset"></i>
            </div>
            <div class="fq-cta-text">
                <h3 class="fq-cta-title">Masih Ada Pertanyaan?</h3>
                <p class="fq-cta-desc">Tim kami siap membantu menjawab pertanyaan Anda kapan saja.</p>
            </div>
            <div class="fq-cta-actions">
                <a href="{{ route('kontak') }}" class="fq-cta-btn-ghost">
                    <i class="fas fa-envelope"></i> Hubungi Kami
                </a>
                <a href="https://wa.me/{{ \App\Models\SiteSetting::get('phone_whatsapp', '6281111121705') }}" target="_blank" class="fq-cta-btn-wa">
                    <i class="fab fa-whatsapp"></i> Chat via WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>


{{-- Live search script --}}
<script>
(function () {
    const input    = document.getElementById('fqSearchInput');
    const items     = document.querySelectorAll('[data-faq-item]');
    const noResult  = document.getElementById('fqNoResult');
    const count     = document.getElementById('fqSearchCount');

    if (!input) return;

    input.addEventListener('input', function () {
        const q = this.value.trim().toLowerCase();
        let visible = 0;

        items.forEach(item => {
            const q1 = item.querySelector('[data-faq-question]')?.textContent.toLowerCase() || '';
            const q2 = item.querySelector('[data-faq-answer]')?.textContent.toLowerCase() || '';
            const match = !q || q1.includes(q) || q2.includes(q);
            item.style.display = match ? '' : 'none';
            if (match) visible++;
        });

        noResult.style.display = visible === 0 ? 'flex' : 'none';
        count.textContent = q ? `${visible} hasil ditemukan` : '';
    });
})();
</script>


<style>

/* ── INTRO ── */
.fq-intro {
    background: linear-gradient(135deg, var(--accent) 0%, var(--accent-mid) 50%, var(--primary) 100%);
    padding: 28px 0 56px;
    position: relative; overflow: hidden;
}
.fq-intro-glow {
    position: absolute; border-radius: 50%; filter: blur(80px); pointer-events: none;
}
.fq-intro-glow--left  { top: -60px; left: -80px; width: 280px; height: 280px; background: rgba(27,169,157,.25); }
.fq-intro-glow--right { bottom: -80px; right: -80px; width: 320px; height: 320px; background: rgba(255,255,255,.04); }

/* Breadcrumb di dalam hero gelap */
.fq-breadcrumb-nav { position: relative; z-index: 1; margin-bottom: 28px; }
.fq-breadcrumb-nav .breadcrumb { margin: 0; }
.fq-breadcrumb-nav .breadcrumb-item a { color: rgba(255,255,255,.65); transition: color .2s; }
.fq-breadcrumb-nav .breadcrumb-item a:hover { color: rgba(255,255,255,.9); }
.fq-breadcrumb-nav .breadcrumb-item.active { color: rgba(255,255,255,.45); }
.fq-breadcrumb-nav .breadcrumb-item + .breadcrumb-item::before { color: rgba(255,255,255,.3); }

.fq-intro-inner {
    max-width: 680px; margin: 0 auto; text-align: center;
    position: relative; z-index: 1;
}
.fq-intro-badge {
    display: inline-flex; align-items: center; gap: 7px;
    background: rgba(255,255,255,.12); border: 1px solid rgba(255,255,255,.2);
    color: rgba(255,255,255,.9);
    font-size: 11px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase;
    padding: 6px 16px; border-radius: 100px; margin-bottom: 18px;
}
.fq-intro-title {
    font-family: 'Libre Baskerville', Georgia, serif;
    font-size: clamp(1.6rem, 3.5vw, 2.3rem);
    font-weight: 700; color: #fff; line-height: 1.25; margin: 0 0 14px;
}
.fq-intro-sub {
    font-size: 15px; color: rgba(255,255,255,.7); line-height: 1.75; margin: 0;
}

/* ── SEARCH SECTION (terpisah dari hero) ── */
.fq-search-section {
    background: var(--bg);
    padding: 0;
    position: relative;
}
.fq-search-section .container {
    display: flex; justify-content: center;
    transform: translateY(-28px);
}
.fq-search-wrap {
    width: 100%; max-width: 640px;
    position: relative;
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-lg);
    display: flex; align-items: center;
    padding: 4px;
}
.fq-search-icon {
    position: absolute; left: 22px;
    color: var(--muted-2); font-size: 16px;
    pointer-events: none;
}
.fq-search-input {
    flex: 1; border: none; outline: none;
    background: transparent;
    padding: 16px 18px 16px 52px;
    font-size: 14.5px; color: var(--ink);
    font-family: 'Plus Jakarta Sans', sans-serif;
}
.fq-search-input::placeholder { color: var(--muted-2); }
.fq-search-count {
    font-size: 12px; font-weight: 700; color: var(--primary);
    padding-right: 18px; white-space: nowrap;
}

/* ── SECTION ── */
.fq-section { background: var(--bg); padding-top: 32px; }
.fq-wrap { max-width: 760px; margin: 0 auto; }

/* ── EMPTY ── */
.fq-empty { text-align: center; padding: 64px 24px; }
.fq-empty-icon { font-size: 3rem; color: var(--border); margin-bottom: 14px; }
.fq-empty-title { font-weight: 700; color: var(--ink-2); margin-bottom: 6px; }
.fq-empty-desc  { font-size: 14px; color: var(--muted); }

/* ── ACCORDION ── */
.fq-accordion { display: flex; flex-direction: column; gap: 14px; }

.fq-item {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-md);
    box-shadow: var(--shadow-xs);
    overflow: hidden;
    transition: border-color .2s, box-shadow .2s;
}
.fq-item:has(.fq-question[aria-expanded="true"]) {
    border-color: #a8e4e0;
    box-shadow: var(--shadow-sm);
}

.fq-question {
    width: 100%;
    display: flex; align-items: center; gap: 16px;
    background: transparent; border: none; cursor: pointer;
    padding: 18px 22px;
    text-align: left;
    font-family: 'Plus Jakarta Sans', sans-serif;
}

.fq-question-num {
    font-family: 'Libre Baskerville', Georgia, serif;
    font-size: 1rem; font-weight: 700;
    color: var(--border); flex-shrink: 0;
    min-width: 28px;
    transition: color .2s;
}
.fq-question[aria-expanded="true"] .fq-question-num { color: var(--primary); }

.fq-question-text {
    flex: 1; font-size: 14.5px; font-weight: 700;
    color: var(--ink); line-height: 1.5;
}

.fq-question-arrow {
    width: 30px; height: 30px; border-radius: 50%;
    background: var(--bg);
    color: var(--muted);
    display: flex; align-items: center; justify-content: center;
    font-size: 12px; flex-shrink: 0;
    transition: background .2s, color .2s, transform .3s var(--ease);
}
.fq-question[aria-expanded="true"] .fq-question-arrow {
    background: var(--primary);
    color: #fff;
    transform: rotate(180deg);
}

.fq-answer-collapse { }
.fq-answer {
    padding: 0 22px 22px 66px;
    font-size: 14px; color: var(--muted); line-height: 1.8;
}

/* No result */
.fq-no-result {
    display: flex; align-items: center; justify-content: center; gap: 10px;
    padding: 48px 24px;
    color: var(--muted); font-size: 14px; font-weight: 600;
}
.fq-no-result i { color: var(--border); font-size: 18px; }

/* ── CTA BANNER ── */
.fq-cta-section { padding: 64px 0 72px; background: var(--bg); }
.fq-cta-inner {
    max-width: 760px; margin: 0 auto;
    background: var(--white);
    border: 1.5px solid var(--border);
    border-radius: var(--radius-xl);
    padding: 40px 48px;
    display: flex; align-items: center; gap: 24px;
    position: relative; overflow: hidden;
    box-shadow: var(--shadow-md);
}
.fq-cta-glow {
    position: absolute; top: -60px; right: -60px;
    width: 200px; height: 200px;
    background: rgba(27,169,157,.1);
    border-radius: 50%; filter: blur(60px); pointer-events: none;
}
.fq-cta-icon-wrap {
    width: 60px; height: 60px; border-radius: 50%;
    background: var(--primary-light); color: var(--primary);
    font-size: 24px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; position: relative; z-index: 1;
}
.fq-cta-text { flex: 1; position: relative; z-index: 1; }
.fq-cta-title {
    font-family: 'Libre Baskerville', Georgia, serif;
    font-size: 1.2rem; font-weight: 700; color: var(--ink); margin: 0 0 6px;
}
.fq-cta-desc { font-size: 13.5px; color: var(--muted); margin: 0; }

.fq-cta-actions {
    display: flex; gap: 10px; flex-shrink: 0;
    position: relative; z-index: 1;
}
.fq-cta-btn-ghost {
    display: inline-flex; align-items: center; gap: 7px;
    background: var(--bg); border: 1.5px solid var(--border);
    color: var(--ink-2); font-size: 13.5px; font-weight: 700;
    padding: 11px 20px; border-radius: var(--radius-sm);
    text-decoration: none; transition: background .2s, border-color .2s;
}
.fq-cta-btn-ghost:hover { background: var(--primary-light); border-color: #a8e4e0; color: var(--primary-dark); }

.fq-cta-btn-wa {
    display: inline-flex; align-items: center; gap: 7px;
    background: #25d366; color: #fff;
    font-size: 13.5px; font-weight: 700;
    padding: 11px 20px; border-radius: var(--radius-sm);
    text-decoration: none; transition: background .2s, transform .15s;
}
.fq-cta-btn-wa:hover { background: #1ebe5d; color: #fff; transform: translateY(-1px); }

/* ── RESPONSIVE ── */
@media (max-width: 768px) {
    .fq-intro { padding: 24px 0 44px; }
    .fq-search-section .container { transform: translateY(-22px); padding-left: 20px; padding-right: 20px; }
    .fq-search-input { padding: 14px 16px 14px 48px; font-size: 13.5px; }
    .fq-search-count { display: none; }
    .fq-section { padding-top: 26px; }
    .fq-cta-inner { flex-direction: column; text-align: center; padding: 32px 28px; }
    .fq-cta-actions { flex-direction: column; width: 100%; }
    .fq-cta-btn-ghost, .fq-cta-btn-wa { justify-content: center; }
    .fq-answer { padding-left: 22px; }
}
@media (max-width: 576px) {
    .fq-question { padding: 16px 18px; gap: 12px; }
    .fq-question-text { font-size: 13.5px; }
    .fq-answer { padding: 0 18px 18px 18px; font-size: 13.5px; }
}

</style>

@endsection