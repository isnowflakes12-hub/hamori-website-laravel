<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Kontak extends Model {
    protected $fillable = ['nama','email','telepon','subjek','pesan','is_read'];
    protected $casts = ['is_read'=>'boolean'];
}
