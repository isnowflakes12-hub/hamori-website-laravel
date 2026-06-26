<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    protected $table = 'fasilitass';
    protected $fillable = ['nama', 'slug', 'kategori_id', 'deskripsi', 'konten', 'gambar', 'galeri', 'is_active'];
    protected $casts = [
        'is_active' => 'boolean',
        'galeri'    => 'array',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriFasilitas::class, 'kategori_id');
    }
}
