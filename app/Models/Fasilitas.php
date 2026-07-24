<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    protected $table = 'fasilitass';
    protected $fillable = ['nama', 'slug', 'kategori_id', 'deskripsi', 'konten', 'gambar', 'galeri', 'is_active', 'tampil_di_navbar'];
    protected $casts = [
        'is_active'        => 'boolean',
        'galeri'           => 'array',
        'tampil_di_navbar' => 'boolean',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriFasilitas::class, 'kategori_id');
    }
}
