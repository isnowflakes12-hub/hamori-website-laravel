<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = ['judul', 'gambar', 'gambar_mobile', 'link', 'urutan', 'is_active'];
    protected $casts = ['is_active' => 'boolean'];
}
