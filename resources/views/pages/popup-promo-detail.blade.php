<div class="promo-overlay" id="promoOverlay">
    <div class="promo-popup" id="promoPopup">

        <button class="promo-close" id="promoClose" aria-label="Tutup">
            <i class="bi bi-x-lg"></i>
        </button>

        <div class="promo-popup-inner">
            @php
                try {
                    $popupPromo = \App\Models\Promo::where('is_home_featured', true)
                        ->latest()
                        ->first();
                } catch(\Exception $e) {
                    $popupPromo = null;
                }
            @endphp

            @if($popupPromo)
                @if($popupPromo->gambar)
                    <img src="{{ asset('storage/'.$popupPromo->gambar) }}"
                         alt="{{ $popupPromo->judul }}"
                         width="420"
                         height="525"
                         loading="lazy"
                         class="img-fluid">
                @else
                    <img src="{{ asset('images/default-mcu.jpg') }}"
                         alt="Promo"
                         width="420"
                         height="525"
                         loading="lazy"
                         class="img-fluid">
                @endif
            @else
                <img src="{{ asset('images/default-mcu.jpg') }}"
                     alt="Medical Check Up"
                     width="420"
                     height="525"
                     loading="lazy"
                     class="img-fluid">
            @endif
        </div>

        <div class="promo-popup-footer">
            <label class="promo-dont-show-label">
                <input type="checkbox" id="promoDontShow">
                <span>Jangan tampilkan lagi hari ini</span>
            </label>
        </div>

    </div>
</div>
