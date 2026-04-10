<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $fillable = [
        'nama', 'foto', 'gelar_depan', 'gelar_belakang',
        'poli_id', 'spesialisasi', 'pendidikan', 'bio', 'is_active'
    ];
    protected $casts = ['is_active' => 'boolean'];

    public function poli() { return $this->belongsTo(Poli::class); }
    public function jadwal() { return $this->hasMany(JadwalDokter::class); }

    public function getNamaLengkapAttribute()
    {
        return trim("{$this->gelar_depan} {$this->nama}, {$this->gelar_belakang}");
    }
}
