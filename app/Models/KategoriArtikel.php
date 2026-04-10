<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class KategoriArtikel extends Model {
    protected $table = 'kategori_artikels';
    protected $fillable = ['nama', 'slug', 'deskripsi', 'warna', 'urutan', 'is_active'];
    protected $casts = ['is_active' => 'boolean'];

    public function artikels() {
        return $this->hasMany(Artikel::class, 'kategori_id');
    }
}
