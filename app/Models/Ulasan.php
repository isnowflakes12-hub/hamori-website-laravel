<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Ulasan extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nama', 'email', 'no_hp', 'rating', 'kategori',
        'ulasan', 'is_approved', 'is_featured',
        'avatar_color', 'sumber', 'approved_at',
    ];

    protected $casts = [
        'is_approved' => 'boolean',
        'is_featured' => 'boolean',
        'approved_at' => 'datetime',
        'rating'      => 'integer',
    ];

    /* ── Konstanta ── */
    const KATEGORI = [
        'umum'       => 'Umum',
        'rawat_inap' => 'Rawat Inap',
        'rawat_jalan'=> 'Rawat Jalan',
        'igd'        => 'IGD',
        'mcu'        => 'Medical Check Up',
    ];

    const AVATAR_COLORS = [
        '#1ba99d', '#292562', '#e53e3e', '#f59e0b',
        '#38a169', '#3d3890', '#d97706', '#0891b2',
    ];

    /* ── Accessor ── */
    protected function initial(): Attribute
    {
        return Attribute::make(
            get: fn () => strtoupper(
                implode('', array_map(
                    fn($w) => $w[0],
                    array_slice(explode(' ', $this->nama), 0, 2)
                ))
            )
        );
    }

    protected function kategoriLabel(): Attribute
    {
        return Attribute::make(
            get: fn () => self::KATEGORI[$this->kategori] ?? 'Umum'
        );
    }

    protected function ratingStars(): Attribute
    {
        return Attribute::make(
            get: fn () => str_repeat('★', $this->rating) . str_repeat('☆', 5 - $this->rating)
        );
    }

    /* ── Scopes ── */
    public function scopeApproved($q)   { return $q->where('is_approved', true); }
    public function scopeFeatured($q)   { return $q->where('is_featured', true); }
    public function scopeByRating($q, $r) { return $q->where('rating', $r); }

    /* ── Boot: auto assign avatar color ── */
    protected static function booted(): void
    {
        static::creating(function ($model) {
            if (!$model->avatar_color) {
                $model->avatar_color = self::AVATAR_COLORS[
                    crc32($model->nama) % count(self::AVATAR_COLORS)
                ];
            }
        });
    }
    protected function avatarColor(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value
                ?? self::AVATAR_COLORS[abs(crc32($this->nama ?? 'x')) % count(self::AVATAR_COLORS)]
        );
    }

    /* ── Helper: statistik rating ── */
    public static function statistik(): array
    {
        $total = self::approved()->count();
        if (!$total) return ['total' => 0, 'avg' => 0, 'distribution' => []];

        $avg  = self::approved()->avg('rating');
        $dist = [];
        for ($i = 5; $i >= 1; $i--) {
            $cnt = self::approved()->byRating($i)->count();
            $dist[$i] = [
                'count' => $cnt,
                'pct'   => $total > 0 ? round(($cnt / $total) * 100) : 0,
            ];
        }
        return ['total' => $total, 'avg' => round($avg, 1), 'distribution' => $dist];
    }
}