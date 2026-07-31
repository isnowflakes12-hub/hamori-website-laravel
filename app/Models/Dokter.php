<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Dokter extends Model
{
    use LogsActivity;
    protected $fillable = [
        'teramedik_id', 'nama', 'foto', 'gelar_depan', 'gelar_belakang',
        'poli_id', 'spesialisasi', 'pendidikan', 'bio', 'is_active'
    ];
    protected $casts = ['is_active' => 'boolean'];

    public function poli() { return $this->belongsTo(Poli::class); }
    public function jadwal() { return $this->hasMany(JadwalDokter::class); }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    public function getNamaLengkapAttribute()
    {
        return trim("{$this->gelar_depan} {$this->nama}, {$this->gelar_belakang}");
    }
}
