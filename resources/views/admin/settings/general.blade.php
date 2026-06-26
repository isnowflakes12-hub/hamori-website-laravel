@extends('admin.layouts.app')
@section('title', 'Pengaturan Umum')
@section('page-title', 'Pengaturan Umum')

@section('content')
<div class="page-hd">
    <div>
        <h1 class="page-hd-title">Pengaturan Umum</h1>
        <p class="page-hd-sub">Kelola informasi website yang ditampilkan di seluruh halaman publik</p>
    </div>
</div>

<form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row g-4">
        {{-- ═══════════════════════════════════════
             LEFT COLUMN
        ═══════════════════════════════════════ --}}
        <div class="col-lg-8">

            {{-- ── SOCIAL MEDIA ── --}}
            <div class="form-card mb-4">
                <h6 class="settings-section-title">
                    <i class="bi bi-share-fill me-2 text-primary"></i>Sosial Media
                </h6>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label"><i class="bi bi-instagram me-1" style="color:#E4405F"></i> Instagram</label>
                        <input type="url" name="social_instagram" class="form-control"
                               value="{{ old('social_instagram', $settings['social_instagram'] ?? '') }}"
                               placeholder="https://instagram.com/rshamori">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><i class="bi bi-youtube me-1" style="color:#FF0000"></i> YouTube</label>
                        <input type="url" name="social_youtube" class="form-control"
                               value="{{ old('social_youtube', $settings['social_youtube'] ?? '') }}"
                               placeholder="https://youtube.com/@rshamori">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><i class="bi bi-facebook me-1" style="color:#1877F2"></i> Facebook</label>
                        <input type="url" name="social_facebook" class="form-control"
                               value="{{ old('social_facebook', $settings['social_facebook'] ?? '') }}"
                               placeholder="https://facebook.com/rshamori">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><i class="bi bi-tiktok me-1"></i> TikTok</label>
                        <input type="url" name="social_tiktok" class="form-control"
                               value="{{ old('social_tiktok', $settings['social_tiktok'] ?? '') }}"
                               placeholder="https://tiktok.com/@rshamori">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><i class="bi bi-twitter-x me-1"></i> X / Twitter</label>
                        <input type="url" name="social_twitter" class="form-control"
                               value="{{ old('social_twitter', $settings['social_twitter'] ?? '') }}"
                               placeholder="https://twitter.com/RSHamori">
                    </div>
                </div>
            </div>

            {{-- ── MOBILE APPS ── --}}
            <div class="form-card mb-4">
                <h6 class="settings-section-title">
                    <i class="bi bi-phone-fill me-2 text-info"></i>Aplikasi Mobile
                </h6>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label"><i class="bi bi-google-play me-1" style="color:#414141"></i> Google Play</label>
                        <input type="url" name="link_google_play" class="form-control"
                               value="{{ old('link_google_play', $settings['link_google_play'] ?? '') }}"
                               placeholder="https://play.google.com/store/apps/details?id=...">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><i class="bi bi-apple me-1" style="color:#000000"></i> App Store</label>
                        <input type="url" name="link_app_store" class="form-control"
                               value="{{ old('link_app_store', $settings['link_app_store'] ?? '') }}"
                               placeholder="https://apps.apple.com/id/app/...">
                    </div>
                </div>
            </div>

            {{-- ── PHONE NUMBERS ── --}}
            <div class="form-card mb-4">
                <h6 class="settings-section-title">
                    <i class="bi bi-telephone-fill me-2 text-success"></i>Nomor Telepon
                </h6>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Call Center</label>
                        <input type="text" name="phone_call_center" class="form-control"
                               value="{{ old('phone_call_center', $settings['phone_call_center'] ?? '') }}"
                               placeholder="1500816">
                        <div class="form-text">Nomor Call Center utama RS</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Telepon Umum</label>
                        <input type="text" name="phone_general" class="form-control"
                               value="{{ old('phone_general', $settings['phone_general'] ?? '') }}"
                               placeholder="02604250888">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">IGD & Ambulans</label>
                        <input type="text" name="phone_igd" class="form-control"
                               value="{{ old('phone_igd', $settings['phone_igd'] ?? '') }}"
                               placeholder="02604250999">
                        <div class="form-text">Nomor darurat IGD 24 jam</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><i class="bi bi-whatsapp me-1" style="color:#25D366"></i> WhatsApp</label>
                        <input type="text" name="phone_whatsapp" class="form-control"
                               value="{{ old('phone_whatsapp', $settings['phone_whatsapp'] ?? '') }}"
                               placeholder="628888905555">
                        <div class="form-text">Format: 62xxxx (tanpa +)</div>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Link WhatsApp Appointment</label>
                        <input type="url" name="link_wa_appointment" class="form-control"
                               value="{{ old('link_wa_appointment', $settings['link_wa_appointment'] ?? '') }}"
                               placeholder="https://wa.link/xxxxx">
                        <div class="form-text">Link pendek WhatsApp untuk tombol "Buat Appointment"</div>
                    </div>
                </div>
            </div>

            {{-- ── ADDRESS & MAPS ── --}}
            <div class="form-card mb-4">
                <h6 class="settings-section-title">
                    <i class="bi bi-geo-alt-fill me-2 text-danger"></i>Lokasi & Peta
                </h6>
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">Alamat Lengkap</label>
                        <textarea name="address" class="form-control" rows="3"
                                  placeholder="Jalan Raya Pagaden-Subang, Ds. Jabong...">{{ old('address', $settings['address'] ?? '') }}</textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Google Maps Embed URL</label>
                        <textarea name="maps_embed_url" class="form-control" rows="3"
                                  placeholder="https://www.google.com/maps/embed?pb=...">{{ old('maps_embed_url', $settings['maps_embed_url'] ?? '') }}</textarea>
                        <div class="form-text">Buka Google Maps → Share → Embed → Salin URL dari src iframe</div>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Google Maps Link</label>
                        <input type="url" name="maps_link" class="form-control"
                               value="{{ old('maps_link', $settings['maps_link'] ?? '') }}"
                               placeholder="https://maps.google.com/?q=RS+Hamori">
                        <div class="form-text">Link langsung ke Google Maps (untuk tombol "Lihat di Maps")</div>
                    </div>

                    {{-- Maps Preview --}}
                    @if(!empty($settings['maps_embed_url']))
                    <div class="col-12">
                        <label class="form-label fw-bold text-muted">Preview Peta</label>
                        <div style="border-radius:12px;overflow:hidden;border:1px solid #e5eaf0">
                            <iframe src="{{ $settings['maps_embed_url'] }}"
                                    width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- ═══════════════════════════════════════
             RIGHT COLUMN (Logo & Save)
        ═══════════════════════════════════════ --}}
        <div class="col-lg-4">

            {{-- ── LOGO ── --}}
            <div class="form-card mb-4">
                <h6 class="settings-section-title">
                    <i class="bi bi-image me-2 text-primary"></i>Logo & Branding
                </h6>

                {{-- Logo Utama --}}
                <div class="mb-4">
                    <label class="form-label">Logo Utama (Navbar)</label>
                    <div class="settings-img-preview mb-2" id="logoPreviewWrap">
                        @if(!empty($settings['logo']))
                            <img src="{{ asset('storage/'.$settings['logo']) }}" id="logoPreview" class="img-prev">
                        @else
                            <div class="settings-img-placeholder" id="logoPlaceholder">
                                <i class="bi bi-image" style="font-size:32px;color:#94a3b8"></i>
                                <span style="font-size:12px;color:#94a3b8">Belum ada logo</span>
                            </div>
                            <img id="logoPreview" class="img-prev" style="display:none">
                        @endif
                    </div>
                    <input type="file" name="logo" class="form-control form-control-sm"
                           accept="image/*" onchange="previewImg(this,'logoPreview','logoPlaceholder')">
                    <div class="form-text">SVG, PNG, JPG. Maks 2MB.</div>
                </div>

                {{-- Logo Putih --}}
                <div class="mb-4">
                    <label class="form-label">Logo Putih (Footer)</label>
                    <div class="settings-img-preview settings-img-dark mb-2" id="logoWhitePreviewWrap">
                        @if(!empty($settings['logo_white']))
                            <img src="{{ asset('storage/'.$settings['logo_white']) }}" id="logoWhitePreview" class="img-prev">
                        @else
                            <div class="settings-img-placeholder" id="logoWhitePlaceholder">
                                <i class="bi bi-image" style="font-size:32px;color:#64748b"></i>
                                <span style="font-size:12px;color:#64748b">Belum ada logo</span>
                            </div>
                            <img id="logoWhitePreview" class="img-prev" style="display:none">
                        @endif
                    </div>
                    <input type="file" name="logo_white" class="form-control form-control-sm"
                           accept="image/*" onchange="previewImg(this,'logoWhitePreview','logoWhitePlaceholder')">
                    <div class="form-text">Logo dengan warna terang untuk background gelap</div>
                </div>

                {{-- Favicon --}}
                <div class="mb-3">
                    <label class="form-label">Favicon</label>
                    <div class="settings-img-preview mb-2" id="faviconPreviewWrap">
                        @if(!empty($settings['favicon']))
                            <img src="{{ asset('storage/'.$settings['favicon']) }}" id="faviconPreview" class="img-prev" style="max-height:64px">
                        @else
                            <div class="settings-img-placeholder" id="faviconPlaceholder" style="height:80px">
                                <i class="bi bi-globe" style="font-size:28px;color:#94a3b8"></i>
                                <span style="font-size:11px;color:#94a3b8">Belum ada</span>
                            </div>
                            <img id="faviconPreview" class="img-prev" style="display:none;max-height:64px">
                        @endif
                    </div>
                    <input type="file" name="favicon" class="form-control form-control-sm"
                           accept="image/png,image/x-icon,image/svg+xml" onchange="previewImg(this,'faviconPreview','faviconPlaceholder')">
                    <div class="form-text">ICO, PNG, SVG. Maks 1MB.</div>
                </div>
            </div>

            {{-- Save Button --}}
            <button type="submit" class="btn btn-primary w-100 py-3" style="font-size:15px">
                <i class="bi bi-check-circle-fill me-2"></i>Simpan Pengaturan
            </button>
        </div>
    </div>
</form>
@endsection

@push('styles')
<style>
.settings-section-title {
    font-size: 14px;
    font-weight: 700;
    color: #374151;
    border-bottom: 1px solid #e2e8f0;
    padding-bottom: 12px;
    margin-bottom: 20px;
}
.settings-img-preview {
    background: #f8fafc;
    border: 2px dashed #e2e8f0;
    border-radius: 12px;
    padding: 16px;
    text-align: center;
    min-height: 100px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: border-color .2s;
}
.settings-img-preview:hover {
    border-color: #0055a5;
}
.settings-img-dark {
    background: #1a1a2e;
    border-color: #334155;
}
.settings-img-dark:hover {
    border-color: #3b82f6;
}
.settings-img-placeholder {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 6px;
}
.settings-img-preview .img-prev {
    max-width: 100%;
    max-height: 120px;
    border-radius: 8px;
    border: none;
    object-fit: contain;
}
</style>
@endpush

@push('scripts')
<script>
function previewImg(input, imgId, placeholderId) {
    const el = document.getElementById(imgId);
    const placeholder = placeholderId ? document.getElementById(placeholderId) : null;
    if (input.files && input.files[0]) {
        const r = new FileReader();
        r.onload = e => {
            el.src = e.target.result;
            el.style.display = 'block';
            if (placeholder) placeholder.style.display = 'none';
        };
        r.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
