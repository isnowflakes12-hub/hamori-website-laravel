<?php
namespace App\Services;

use App\Models\Promo;

class PromoService
{
    public function getAll()
    {
        return Promo::orderBy('is_featured','desc')->orderBy('urutan')->get();
    }

    public function getFeatured()
    {
        return Promo::where('is_featured', true)->orderBy('urutan')->take(3)->get();
    }

    public function store(array $data): Promo
    {
        if (!empty($data['is_featured'])) {
            $this->assertCanFeature();
        }
        $data['benefit'] = $this->parseBenefit($data['benefit_text'] ?? '');
        $data['cara_mendapatkan'] = $this->parseSteps($data['cara_mendapatkan_text'] ?? '');
        unset($data['benefit_text'], $data['cara_mendapatkan_text']);

        // Pastikan hanya 1 promo yang is_home_featured
        if (!empty($data['is_home_featured'])) {
            Promo::where('is_home_featured', true)->update(['is_home_featured' => false]);
        }

        return Promo::create($data);
    }

    public function update(Promo $promo, array $data): void
    {
        if (!empty($data['is_featured']) && !$promo->is_featured) {
            $this->assertCanFeature();
        }
        $data['benefit'] = $this->parseBenefit($data['benefit_text'] ?? '');
        $data['cara_mendapatkan'] = $this->parseSteps($data['cara_mendapatkan_text'] ?? '');
        unset($data['benefit_text'], $data['cara_mendapatkan_text']);

        // Pastikan hanya 1 promo yang is_home_featured
        if (!empty($data['is_home_featured'])) {
            Promo::where('is_home_featured', true)->where('id', '!=', $promo->id)->update(['is_home_featured' => false]);
        }

        $promo->update($data);
    }

    public function delete(Promo $promo): void
    {
        $promo->delete();
    }

    public function toggleFeatured(Promo $promo): void
    {
        if (!$promo->is_featured) {
            $this->assertCanFeature();
        }
        $promo->update(['is_featured' => !$promo->is_featured]);
    }

    public function toggleHomeFeatured(Promo $promo): void
    {
        // Jika kita mau menyalakannya, matikan yang lain dulu karena home featured biasanya eksklusif
        if (!$promo->is_home_featured) {
            Promo::where('is_home_featured', true)->where('id', '!=', $promo->id)->update(['is_home_featured' => false]);
        }
        $promo->update(['is_home_featured' => !$promo->is_home_featured]);
    }

    private function assertCanFeature(): void
    {
        if (!Promo::canAddFeatured()) {
            $existing = Promo::where('is_featured', true)
                              ->pluck('judul')
                              ->map(fn($j) => "• $j")
                              ->implode("\n");
            throw new \RuntimeException(
                "Maksimal " . Promo::maxFeatured() . " promo unggulan.\n\nSaat ini:\n{$existing}"
            );
        }
    }

    private function parseBenefit(string $text): array
    {
        return array_values(array_filter(
            array_map('trim', explode("\n", $text))
        ));
    }

    private function parseSteps(string $text): array
    {
        return array_values(array_filter(
            array_map('trim', explode("\n", $text))
        ));
    }
}

