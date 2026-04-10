<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    protected $fillable = [
        'judul', 'slug', 'kategori_id', 'dokter_id',
        'thumbnail', 'ringkasan', 'konten', 'views',
        'is_published', 'published_at'
    ];
    protected $casts = ['is_published' => 'boolean', 'published_at' => 'datetime'];

    public function kategori() { return $this->belongsTo(KategoriArtikel::class, 'kategori_id'); }
    public function dokter() { return $this->belongsTo(Dokter::class); }
}
