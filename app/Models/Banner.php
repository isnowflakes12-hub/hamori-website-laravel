<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Banner extends Model
{
    use LogsActivity;
    protected $fillable = ['judul', 'gambar', 'gambar_mobile', 'link', 'urutan', 'is_active'];
    protected $casts = ['is_active' => 'boolean'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
