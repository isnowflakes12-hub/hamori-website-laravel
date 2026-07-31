<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Karir extends Model {
    use LogsActivity;
    protected $fillable = [
        'posisi','departemen','kategori','lokasi','kuota',
        'tipe','deskripsi','persyaratan','batas_lamaran','is_active'
    ];
    protected $casts = ['is_active'=>'boolean','batas_lamaran'=>'date'];

    public function lamarans() {
        return $this->hasMany(LamaranKarir::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
