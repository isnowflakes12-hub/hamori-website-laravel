<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class JadwalDokter extends Model
{
    protected $table = 'jadwal_dokters';
    protected $fillable = ['teramedik_dsid', 'dokter_id', 'hari', 'jam_mulai', 'jam_selesai', 'kuota'];
    public function dokter() { return $this->belongsTo(Dokter::class); }
}
