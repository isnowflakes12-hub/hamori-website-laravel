{{-- ====================== POPUP ====================== --}}
<div class="promo-overlay" id="promoOverlay">
    <div class="promo-popup" id="promoPopup">

        {{-- tombol close --}}
        <button class="promo-close" id="promoClose" aria-label="Tutup">
            <i class="bi bi-x-lg"></i>
        </button>
        <div class="promo-popup-inner" style="display:block; padding:0; overflow:hidden;">
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
                 style="width:100%; height:100%; object-fit:cover; display:block;">
        @else
            <img src="{{ asset('images/default-mcu.jpg') }}" 
                 alt="Promo" 
                 style="width:100%; height:100%; object-fit:cover; display:block;">
        @endif
    @else
        <img src="{{ asset('images/default-mcu.jpg') }}" 
             alt="Medical Check Up" 
             style="width:100%; height:100%; object-fit:cover; display:block;">
    @endif
</div>
