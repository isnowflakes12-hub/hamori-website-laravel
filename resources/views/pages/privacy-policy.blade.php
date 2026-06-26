@extends('layouts.app')
@section('title', 'Privacy Policy')

@section('content')

{{-- ── PAGE HEADER ── --}}
<div class="page-header">
    <div class="container">
        <h1 class="page-title">Privacy Policy</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Privacy Policy</li>
            </ol>
        </nav>
    </div>
</div>

{{-- ── MAIN ── --}}
<section class="pv-section sec">
    <div class="container">
        <div class="row g-5">

            {{-- ── SIDEBAR: TOC ── --}}
            @if($policies->isNotEmpty())
            <div class="col-lg-3 d-none d-lg-block">
                <div class="pv-toc">
                    <div class="pv-toc-header">
                        <i class="fas fa-list-ul"></i>
                        <span>Daftar Isi</span>
                    </div>
                    <ul class="pv-toc-list">
                        @foreach($policies as $i => $policy)
                        <li>
                            <a href="#section-{{ $i + 1 }}" class="pv-toc-link" data-toc-link data-target="section-{{ $i + 1 }}">
                                <span class="pv-toc-num">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                <span class="pv-toc-text">{{ $policy->judul }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>

                    <a href="{{ route('kontak') }}" class="pv-toc-cta">
                        <i class="fas fa-circle-question"></i>
                        Ada pertanyaan?
                    </a>
                </div>
            </div>
            @endif

            {{-- ── MAIN DOCUMENT ── --}}
            <div class="{{ $policies->isNotEmpty() ? 'col-lg-9' : 'col-lg-12' }}">
                <div class="pv-doc">

                    {{-- Doc header --}}
                    <div class="pv-doc-header">
                        <div class="pv-doc-icon"><i class="fas fa-shield-halved"></i></div>
                        <div class="pv-doc-meta">
                            <h2 class="pv-doc-title">Kebijakan Privasi RS Hamori</h2>
                            <p class="pv-doc-sub">
                                Dokumen ini menjelaskan bagaimana kami mengumpulkan, menggunakan, dan melindungi informasi pribadi Anda.
                            </p>
                            <span class="pv-doc-updated">
                                <i class="fas fa-clock"></i>
                                Terakhir diperbarui: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
                            </span>
                        </div>
                    </div>

                    {{-- Body --}}
                    <div class="pv-doc-body">

                        @forelse($policies as $i => $policy)
                        <article class="pv-clause" id="section-{{ $i + 1 }}">
                            <div class="pv-clause-head">
                                <span class="pv-clause-num">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                <h4 class="pv-clause-title">{{ $policy->judul }}</h4>
                            </div>
                            <div class="pv-clause-body">
                                <p>{{ $policy->konten }}</p>
                            </div>
                        </article>
                        @empty
                        <div class="pv-empty">
                            <div class="pv-empty-icon"><i class="fas fa-file-shield"></i></div>
                            <h4 class="pv-empty-title">Kebijakan Privasi Belum Tersedia</h4>
                            <p class="pv-empty-desc">Dokumen kebijakan privasi sedang dalam proses penyusunan.</p>
                        </div>
                        @endforelse

                    </div>

                    {{-- Footer note --}}
                    @if($policies->isNotEmpty())
                    <div class="pv-doc-footer">
                        <i class="fas fa-circle-info"></i>
                        <p>
                            Jika Anda memiliki pertanyaan terkait kebijakan privasi ini, silakan
                            <a href="{{ route('kontak') }}">hubungi tim kami</a> atau kirim email ke
                            <a href="mailto:info@rshamori.co.id">info@rshamori.co.id</a>.
                        </p>
                    </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
</section>


{{-- Scroll-spy untuk TOC --}}
<script>
(function () {
    const links    = document.querySelectorAll('[data-toc-link]');
    const sections = [...links].map(l => document.getElementById(l.dataset.target)).filter(Boolean);
    if (!sections.length) return;

    function onScroll() {
        let current = sections[0];
        const offset = 140;
        sections.forEach(sec => {
            if (sec.getBoundingClientRect().top - offset <= 0) current = sec;
        });
        links.forEach(l => l.classList.toggle('pv-toc-link--active', l.dataset.target === current.id));
    }

    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
})();
</script>


<style>

/* ── SECTION ── */
.pv-section { background: var(--bg); }

/* ── TOC SIDEBAR ── */
.pv-toc {
    position: sticky; top: 100px;
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 22px;
    box-shadow: var(--shadow-xs);
}
.pv-toc-header {
    display: flex; align-items: center; gap: 8px;
    font-size: 11px; font-weight: 800; letter-spacing: 1.5px;
    text-transform: uppercase; color: var(--muted);
    padding-bottom: 14px; margin-bottom: 12px;
    border-bottom: 1px solid var(--border-2);
}
.pv-toc-header i { color: var(--primary); }

.pv-toc-list { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 2px; }
.pv-toc-link {
    display: flex; align-items: flex-start; gap: 10px;
    padding: 8px 10px; border-radius: var(--radius-sm);
    text-decoration: none;
    transition: background .18s, padding-left .18s;
}
.pv-toc-link:hover { background: var(--primary-light); }
.pv-toc-link--active { background: var(--primary-light); }
.pv-toc-link--active .pv-toc-num,
.pv-toc-link--active .pv-toc-text { color: var(--primary-dark); }

.pv-toc-num {
    font-family: 'Libre Baskerville', Georgia, serif;
    font-size: 11px; font-weight: 700; color: var(--muted-2);
    flex-shrink: 0; min-width: 18px; padding-top: 1px;
}
.pv-toc-text {
    font-size: 12.5px; font-weight: 600; color: var(--ink-2); line-height: 1.5;
}

.pv-toc-cta {
    display: flex; align-items: center; gap: 8px;
    margin-top: 18px; padding-top: 16px;
    border-top: 1px solid var(--border-2);
    font-size: 12.5px; font-weight: 700; color: var(--primary);
    text-decoration: none; transition: color .2s;
}
.pv-toc-cta:hover { color: var(--primary-dark); }

/* ── DOCUMENT ── */
.pv-doc {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-sm);
    overflow: hidden;
}

.pv-doc-header {
    display: flex; align-items: flex-start; gap: 20px;
    padding: 36px 40px;
    background: linear-gradient(135deg, var(--accent-light) 0%, var(--primary-light) 100%);
    border-bottom: 1px solid var(--border-2);
}
.pv-doc-icon {
    width: 56px; height: 56px; border-radius: var(--radius-md);
    background: var(--white);
    color: var(--primary); font-size: 24px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; box-shadow: var(--shadow-sm);
}
.pv-doc-title {
    font-family: 'Libre Baskerville', Georgia, serif;
    font-size: 1.4rem; font-weight: 700; color: var(--ink); margin: 0 0 8px;
}
.pv-doc-sub { font-size: 14px; color: var(--ink-2); line-height: 1.7; margin: 0 0 12px; max-width: 560px; }
.pv-doc-updated {
    display: inline-flex; align-items: center; gap: 6px;
    font-size: 12px; font-weight: 700; color: var(--primary-dark);
    background: rgba(255,255,255,.7); padding: 5px 12px; border-radius: 100px;
}

/* Body */
.pv-doc-body { padding: 12px 40px 16px; }

.pv-clause {
    padding: 28px 0;
    border-bottom: 1px solid var(--border-2);
    scroll-margin-top: 110px;
}
.pv-clause:last-child { border-bottom: none; }

.pv-clause-head {
    display: flex; align-items: baseline; gap: 14px;
    margin-bottom: 14px;
}
.pv-clause-num {
    font-family: 'Libre Baskerville', Georgia, serif;
    font-size: 1.3rem; font-weight: 700; color: var(--primary);
    flex-shrink: 0; line-height: 1;
}
.pv-clause-title {
    font-family: 'Libre Baskerville', Georgia, serif;
    font-size: 1.1rem; font-weight: 700; color: var(--ink); margin: 0; line-height: 1.4;
}

.pv-clause-body p {
    font-size: 14.5px; color: var(--ink-2); line-height: 1.85;
    margin: 0; text-align: justify;
}

/* Empty state */
.pv-empty { text-align: center; padding: 64px 24px; }
.pv-empty-icon { font-size: 3rem; color: var(--border); margin-bottom: 14px; }
.pv-empty-title { font-weight: 700; color: var(--ink-2); margin-bottom: 6px; }
.pv-empty-desc  { font-size: 14px; color: var(--muted); }

/* Footer note */
.pv-doc-footer {
    display: flex; align-items: flex-start; gap: 12px;
    padding: 22px 40px;
    background: var(--bg);
    border-top: 1px solid var(--border-2);
}
.pv-doc-footer i { color: var(--primary); font-size: 16px; margin-top: 2px; flex-shrink: 0; }
.pv-doc-footer p { font-size: 13px; color: var(--muted); line-height: 1.7; margin: 0; }
.pv-doc-footer a { color: var(--primary); font-weight: 700; text-decoration: none; }
.pv-doc-footer a:hover { color: var(--primary-dark); text-decoration: underline; }

/* ── RESPONSIVE ── */
@media (max-width: 992px) {
    .pv-doc-header { flex-direction: column; gap: 14px; padding: 28px 28px; }
}
@media (max-width: 768px) {
    .pv-doc-body { padding: 8px 24px 12px; }
    .pv-doc-footer { padding: 18px 24px; }
    .pv-clause-num { font-size: 1.1rem; }
    .pv-clause-title { font-size: 1rem; }
}
@media (max-width: 576px) {
    .pv-doc-header { padding: 24px 20px; }
    .pv-doc-title { font-size: 1.2rem; }
    .pv-clause-head { flex-direction: column; gap: 4px; }
}

</style>

@endsection