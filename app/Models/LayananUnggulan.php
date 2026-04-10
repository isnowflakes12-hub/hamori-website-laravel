<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class LayananUnggulan extends Model
{
    protected $fillable = ['nama', 'slug', 'logo', 'deskripsi', 'konten', 'urutan', 'is_active'];
    protected $casts = ['is_active' => 'boolean'];
}
