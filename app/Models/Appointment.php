<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Appointment extends Model {
    protected $fillable = ['kode','nama','email','telepon','poli_id','dokter_id','tanggal','keterangan','status'];
    protected $casts = ['tanggal'=>'date'];
    public function poli() { return $this->belongsTo(Poli::class); }
    public function dokter() { return $this->belongsTo(Dokter::class); }
}
