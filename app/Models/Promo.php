<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model {
    protected $fillable = [
        'judul',
        'gambar',
        'deskripsi',
        'detail',
        'syarat_ketentuan',
        'cara_mendapatkan',
        'terima_bpjs',
        'benefit',
        'link_cta',
        'is_featured',
        'is_home_featured',
        'berlaku_mulai',
        'berlaku_sampai',
        'urutan'];
    
    protected $casts = [
        'is_featured'      => 'boolean',
        'is_home_featured' => 'boolean',
        'terima_bpjs'      => 'boolean',
        'benefit'          => 'array',
        'cara_mendapatkan' => 'array',
        'berlaku_mulai'    => 'date',
        'berlaku_sampai'   => 'date',
    ];

    public function isExpired(): bool {
        return $this->berlaku_sampai && $this->berlaku_sampai->isPast();
    }
    public function isMasihAktif(): bool {
        return !$this->isExpired();
    }
    public function getStatusLabel(): string {
        if ($this->isExpired()) return 'Kedaluwarsa';
        return 'Aktif';
    }
    public function getStatusColor(): string {
        if ($this->isExpired()) return 'warning';
        return 'success';
    }

    /* ── Featured helpers ── */
    public static function canAddFeatured(): bool {
        return static::featuredCount() < static::maxFeatured();
    }
    public static function featuredCount(): int {
        return static::where('is_featured', true)->count();
    }
    public static function maxFeatured(): int { return 3; }

    /* ── Home panel helper (fallback to first featured) ── */
    public static function getHomeFeatured(): ?self {
        return static::where('is_home_featured', true)->first()
            ?? static::where('is_featured', true)->orderBy('urutan')->first()
            ?? static::orderBy('urutan')->first();
    }
}
