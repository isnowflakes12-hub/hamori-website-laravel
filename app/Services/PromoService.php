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
        unset($data['benefit_text']);
        return Promo::create($data);
    }

    public function update(Promo $promo, array $data): void
    {
        if (!empty($data['is_featured']) && !$promo->is_featured) {
            $this->assertCanFeature();
        }
        $data['benefit'] = $this->parseBenefit($data['benefit_text'] ?? '');
        unset($data['benefit_text']);
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
}
