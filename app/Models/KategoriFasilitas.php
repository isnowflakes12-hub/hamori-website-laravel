<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class KategoriFasilitas extends Model
{
    protected $table = 'kategori_fasilitas';
    protected $fillable = ['nama', 'slug', 'deskripsi', 'urutan', 'is_active'];
    protected $casts = ['is_active' => 'boolean'];

    public function fasilitas()
    {
        return $this->hasMany(Fasilitas::class, 'kategori_id');
    }
}
