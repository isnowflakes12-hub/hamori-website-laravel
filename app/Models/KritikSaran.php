<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class KritikSaran extends Model {
    protected $fillable = [
        'nama', 'email', 'telepon', 'kategori', 'pesan', 'rating', 'is_read', 
        'status', 'is_featured', 'approved_at'
    ];
    protected $casts = [
        'is_read' => 'boolean',
        'is_featured' => 'boolean',
        'approved_at' => 'datetime',
    ];

    /* ── Scopes ── */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeNotExpired($query)
    {
        // 3 months (tri wulan)
        return $query->where('approved_at', '>=', now()->subMonths(3));
    }
}
