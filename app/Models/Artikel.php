<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Artikel extends Model
{
    use LogsActivity;
    protected $fillable = [
        'judul', 'slug', 'kategori_id', 'dokter_id',
        'thumbnail', 'galeri', 'ringkasan', 'konten', 'views',
        'is_published', 'published_at'
    ];
    protected $casts = [
        'is_published' => 'boolean', 
        'published_at' => 'datetime',
        'galeri' => 'array'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    // Relasi lama (untuk kompatibilitas URL slug & single badge)
    public function kategori() { return $this->belongsTo(KategoriArtikel::class, 'kategori_id'); }

    // Relasi baru: many-to-many
    public function kategoris() {
        return $this->belongsToMany(KategoriArtikel::class, 'artikel_kategori', 'artikel_id', 'kategori_artikel_id');
    }

    public function dokter() { return $this->belongsTo(Dokter::class); }
}
