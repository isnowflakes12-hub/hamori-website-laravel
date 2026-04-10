<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Karir extends Model {
    protected $fillable = [
        'posisi','departemen','kategori','lokasi','kuota',
        'tipe','deskripsi','persyaratan','batas_lamaran','is_active'
    ];
    protected $casts = ['is_active'=>'boolean','batas_lamaran'=>'date'];

    public function lamarans() {
        return $this->hasMany(LamaranKarir::class);
    }
}
