@extends('admin.layouts.app')
@section('title','Detail Lamaran')
@section('page-title','Detail Lamaran')
@section('content')
<div class="page-hd">
    <div><h1 class="page-hd-title">Detail Lamaran</h1></div>
    <a href="{{ route('admin.lamaran.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
</div>
<div class="row g-4">
    <div class="col-lg-8">
        <div class="form-card mb-4">
            <h6 class="fw-bold mb-4" style="font-size:15px;border-bottom:1px solid #e5eaf0;padding-bottom:12px">Data Pelamar</h6>
            <div class="row g-3">
                <div class="col-md-6"><div style="font-size:12px;color:#64748b;font-weight:700;margin-bottom:3px">NAMA LENGKAP</div><div class="fw-semibold">{{ $lamaran->nama }}</div></div>
                <div class="col-md-6"><div style="font-size:12px;color:#64748b;font-weight:700;margin-bottom:3px">EMAIL</div><div>{{ $lamaran->email }}</div></div>
                <div class="col-md-6"><div style="font-size:12px;color:#64748b;font-weight:700;margin-bottom:3px">TELEPON</div><div>{{ $lamaran->telepon }}</div></div>
                <div class="col-md-6"><div style="font-size:12px;color:#64748b;font-weight:700;margin-bottom:3px">POSISI DILAMAR</div><div class="fw-semibold text-primary">{{ $lamaran->karir->posisi ?? '—' }}</div></div>
                <div class="col-md-6"><div style="font-size:12px;color:#64748b;font-weight:700;margin-bottom:3px">KATEGORI</div><div>{{ $lamaran->karir->kategori ?? '—' }}</div></div>
                <div class="col-md-6"><div style="font-size:12px;color:#64748b;font-weight:700;margin-bottom:3px">TANGGAL LAMAR</div><div>{{ $lamaran->created_at->format('d M Y, H:i') }}</div></div>
            </div>
            @if($lamaran->cover_letter)
            <div class="mt-4">
                <div style="font-size:12px;color:#64748b;font-weight:700;margin-bottom:6px">COVER LETTER</div>
                <div style="background:#f8fafc;border-radius:10px;padding:16px;font-size:14px;line-height:1.7;white-space:pre-wrap">{{ $lamaran->cover_letter }}</div>
            </div>
            @endif
            <div class="mt-4">
                <div style="font-size:12px;color:#64748b;font-weight:700;margin-bottom:8px">CV / RESUME</div>
                <div style="border:1px solid #e5eaf0;border-radius:12px;overflow:hidden;background:#f1f5f9;">
                    <div style="display:flex;align-items:center;justify-content:space-between;padding:10px 16px;background:#fff;border-bottom:1px solid #e5eaf0;">
                        <div style="display:flex;align-items:center;gap:8px;font-size:13px;font-weight:600;color:#374151;">
                            <i class="bi bi-file-earmark-pdf-fill" style="color:#dc2626;font-size:18px;"></i>
                            CV — {{ $lamaran->nama }}
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary" id="btnZoomOut" title="Zoom Out">
                                    <i class="bi bi-zoom-out"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-secondary" id="btnZoomReset" title="Reset Zoom" style="font-size:12px;font-weight:600;">
                                    100%
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-secondary" id="btnZoomIn" title="Zoom In">
                                    <i class="bi bi-zoom-in"></i>
                                </button>
                            </div>
                            <a href="{{ asset('storage/'.$lamaran->cv) }}" target="_blank" download class="btn btn-sm btn-primary">
                                <i class="bi bi-download me-1"></i>Download
                            </a>
                        </div>
                    </div>
                    <div id="pdfCanvasContainer" style="padding:16px;display:flex;flex-direction:column;gap:12px;height:75vh;overflow:auto;cursor:grab;user-select:none;">
                        <div id="pdfLoading" style="text-align:center;padding:40px;color:#64748b;">
                            <div class="spinner-border spinner-border-sm me-2" role="status"></div>
                            Memuat PDF...
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-card">
            <h6 class="fw-bold mb-3" style="font-size:15px">Update Status</h6>
            <div class="mb-3 text-center">
                <span class="badge bg-{{ $lamaran->status_color }}" style="font-size:13px;padding:8px 16px">{{ $lamaran->status_label }}</span>
            </div>
            <form method="POST" action="{{ route('admin.lamaran.status', $lamaran) }}">
                @csrf @method('PATCH')
                <div class="mb-3">
                    <label class="form-label">Status Baru</label>
                    @php
                        $statusOptions = [
                            'pending'   => 'Menunggu',
                            'review'    => 'Sedang Direview',
                            'shortlist' => 'Shortlist',
                            'interview' => 'Interview',
                            'diterima'  => 'Diterima',
                            'ditolak'   => 'Tidak Lolos',
                        ];
                        $currentStatus = $lamaran->status;
                        $currentStatusLabel = $statusOptions[$currentStatus] ?? 'Pilih Status';
                    @endphp
                    <div class="custom-dropdown-wrapper">
                        <input type="hidden" name="status" value="{{ $currentStatus }}">
                        <div class="custom-dropdown-trigger">
                            <span class="custom-dropdown-label">{{ $currentStatusLabel }}</span>
                            <i class="bi bi-chevron-down custom-dropdown-arrow"></i>
                        </div>
                        <ul class="custom-dropdown-options-container">
                            @foreach($statusOptions as $v => $l)
                            <li class="custom-dropdown-option {{ $currentStatus == $v ? 'active' : '' }}" data-value="{{ $v }}">{{ $l }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Catatan Internal</label>
                    <textarea name="catatan" class="form-control" rows="3" placeholder="Catatan untuk team SDM...">{{ $lamaran->catatan }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100"><i class="bi bi-check2 me-2"></i>Simpan Status</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
<script>
(function () {
    const container = document.getElementById('pdfCanvasContainer');
    const loading   = document.getElementById('pdfLoading');

    // Set workerSrc untuk PDF.js
    pdfjsLib.GlobalWorkerOptions.workerSrc =
        'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

    // Dapatkan path asli file di storage
    @php
        $fileContent = '';
        if (\Illuminate\Support\Facades\Storage::disk('public')->exists($lamaran->cv)) {
            $fileContent = base64_encode(\Illuminate\Support\Facades\Storage::disk('public')->get($lamaran->cv));
        }
    @endphp

    const pdfBase64 = "{{ $fileContent }}";

    if (!pdfBase64) {
        loading.innerHTML = '<div class="alert alert-danger">File PDF tidak ditemukan di storage server.</div>';
        return;
    }

    // Decode base64 ke Uint8Array
    const pdfData = atob(pdfBase64);
    const pdfArray = new Uint8Array(pdfData.length);
    for (let i = 0; i < pdfData.length; i++) {
        pdfArray[i] = pdfData.charCodeAt(i);
    }

    let currentPdf = null;
    let currentScale = 1.5;

    // Load PDF langsung dari memory (tanpa HTTP request)
    pdfjsLib.getDocument({ data: pdfArray }).promise
        .then(function (pdf) {
            loading.remove();
            currentPdf = pdf;
            renderAllPages();
        })
        .catch(function (err) {
            let errMsg = err.message || JSON.stringify(err);
            const fallbackUrl = '{{ asset('storage/'.$lamaran->cv) }}';
            loading.innerHTML = '<div style="background:#fee2e2;color:#991b1b;padding:12px;border-radius:8px;text-align:left;">' +
                                '<strong><i class="bi bi-exclamation-triangle me-2"></i>Gagal memuat PDF</strong><br>' +
                                '<small>Error: ' + errMsg + '</small><br><br>' +
                                '<a href="' + fallbackUrl + '" target="_blank" class="btn btn-sm btn-outline-danger">Buka PDF di Tab Baru</a>' +
                                '</div>';
            console.error('PDF load error:', err);
        });

    function renderAllPages() {
        if (!currentPdf) return;

        // Bersihkan container sebelumnya, tapi biarkan pesan error jika ada
        container.innerHTML = '';
        const totalPages = currentPdf.numPages;
        
        // Update label zoom
        document.getElementById('btnZoomReset').textContent = Math.round(currentScale * 100 / 1.5) + '%';

        const renderPage = function (pageNum) {
            return currentPdf.getPage(pageNum).then(function (page) {
                const viewport = page.getViewport({ scale: currentScale });

                // Wrapper per halaman
                const pageWrap = document.createElement('div');
                // max-width:100% dihapus agar bisa membesar melebih layar dan bisa di-scroll
                pageWrap.style.cssText = 'flex-shrink:0;background:#fff;border-radius:8px;box-shadow:0 1px 6px rgba(0,0,0,0.10);overflow:hidden;position:relative;margin:0 auto;width:' + viewport.width + 'px;';

                // Label nomor halaman
                if (totalPages > 1) {
                    const pageLabel = document.createElement('div');
                    pageLabel.textContent = 'Halaman ' + pageNum + ' / ' + totalPages;
                    pageLabel.style.cssText = 'font-size:11px;color:#94a3b8;padding:6px 12px;background:#f8fafc;border-bottom:1px solid #e5eaf0;';
                    pageWrap.appendChild(pageLabel);
                }

                const canvas    = document.createElement('canvas');
                canvas.width    = viewport.width;
                canvas.height   = viewport.height;
                canvas.style.cssText = 'display:block;width:100%;height:auto;';

                pageWrap.appendChild(canvas);
                container.appendChild(pageWrap);

                return page.render({
                    canvasContext: canvas.getContext('2d'),
                    viewport: viewport,
                }).promise;
            });
        };

        // Render halaman satu per satu secara berurutan
        let chain = Promise.resolve();
        for (let i = 1; i <= totalPages; i++) {
            chain = chain.then(renderPage.bind(null, i));
        }

        chain.catch(function (err) {
            console.error('PDF render error:', err);
            container.innerHTML += '<div class="alert alert-danger">Error rendering page: ' + err.message + '</div>';
        });
    }

    document.getElementById('btnZoomIn').addEventListener('click', function() {
        if (currentScale >= 3.0) return; // max zoom
        currentScale += 0.25;
        renderAllPages();
    });

    document.getElementById('btnZoomOut').addEventListener('click', function() {
        if (currentScale <= 0.5) return; // min zoom
        currentScale -= 0.25;
        renderAllPages();
    });

    document.getElementById('btnZoomReset').addEventListener('click', function() {
        currentScale = 1.5; // base scale
        renderAllPages();
    });

    // Fitur Drag-to-Pan (Geser dengan Mouse)
    let isDown = false;
    let startX, startY, scrollLeft, scrollTop;

    container.addEventListener('mousedown', (e) => {
        isDown = true;
        container.style.cursor = 'grabbing';
        startX = e.clientX;
        startY = e.clientY;
        scrollLeft = container.scrollLeft;
        scrollTop = container.scrollTop;
        e.preventDefault(); // Mencegah native drag/text selection yang memblokir event
    });

    window.addEventListener('mouseup', () => {
        if (!isDown) return;
        isDown = false;
        container.style.cursor = 'grab';
    });

    window.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const walkX = (e.clientX - startX) * 1.5; // kecepatan geser
        const walkY = (e.clientY - startY) * 1.5;
        container.scrollLeft = scrollLeft - walkX;
        container.scrollTop  = scrollTop - walkY;
    });
}());
</script>
@endpush