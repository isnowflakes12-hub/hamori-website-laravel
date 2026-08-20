<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KarirKategori extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'warna', 'warna_bg', 'icon', 'urutan', 'is_active'];
    
    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function karirs()
    {
        return $this->hasMany(Karir::class, 'kategori', 'nama');
    }
}
