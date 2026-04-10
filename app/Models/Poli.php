<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    protected $fillable = ['nama', 'slug', 'deskripsi', 'ikon', 'is_active'];
    protected $casts = ['is_active' => 'boolean'];
    public function dokters() { return $this->hasMany(Dokter::class); }
}
