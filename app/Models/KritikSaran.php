<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class KritikSaran extends Model {
    protected $fillable = ['nama','email','telepon','kategori','pesan','rating','is_read'];
    protected $casts = ['is_read'=>'boolean'];
}
