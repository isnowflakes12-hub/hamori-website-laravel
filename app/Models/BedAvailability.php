<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BedAvailability extends Model
{
    use HasFactory;

    protected $fillable = [
        'kelas',
        'nama_ruangan',
        'kapasitas',
        'terisi',
        'urutan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the number of available beds.
     */
    public function getTersediaAttribute()
    {
        return max(0, $this->kapasitas - $this->terisi);
    }
}
