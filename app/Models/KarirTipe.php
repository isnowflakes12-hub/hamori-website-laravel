<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KarirTipe extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'slug', 'warna', 'is_active'];
    
    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function karirs()
    {
        return $this->hasMany(Karir::class, 'tipe', 'slug');
    }
}
