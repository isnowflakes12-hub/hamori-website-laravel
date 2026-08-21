<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Karir extends Model {
    use LogsActivity;
    protected $fillable = [
        'posisi','slug','departemen','kategori','lokasi','kuota',
        'tipe','deskripsi','persyaratan','batas_lamaran','is_active'
    ];
    protected $casts = ['is_active'=>'boolean','batas_lamaran'=>'date'];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($karir) {
            if (empty($karir->slug)) {
                $baseSlug = \Illuminate\Support\Str::slug($karir->posisi);
                $slug = $baseSlug;
                $count = 1;
                while (static::where('slug', $slug)->where('id', '!=', $karir->id ?? 0)->exists()) {
                    $slug = $baseSlug . '-' . $count++;
                }
                $karir->slug = $slug;
            }
        });
    }

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
