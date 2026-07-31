<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Poli extends Model
{
    use LogsActivity;
    protected $fillable = ['teramedik_id', 'nama', 'slug', 'deskripsi', 'ikon', 'is_active'];
    protected $casts = ['is_active' => 'boolean'];
    public function dokters() { return $this->hasMany(Dokter::class); }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
