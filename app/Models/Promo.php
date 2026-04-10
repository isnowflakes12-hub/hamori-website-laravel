<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model {
    protected $fillable = [
        'judul','gambar','deskripsi','harga_normal','harga_promo',
        'diskon','benefit','link_wa','link_daftar',
        'berlaku_mulai','berlaku_sampai','is_active','is_featured','urutan'
    ];
    protected $casts = [
        'is_active'    => 'boolean',
        'is_featured'  => 'boolean',
        'benefit'      => 'array',
        'berlaku_mulai'  => 'date',
        'berlaku_sampai' => 'date',
    ];

    public function isExpired(): bool {
        return $this->berlaku_sampai && $this->berlaku_sampai->isPast();
    }
    public function isMasihAktif(): bool {
        return $this->is_active && !$this->isExpired();
    }
    public function getStatusLabel(): string {
        if (!$this->is_active) return 'Nonaktif';
        if ($this->isExpired()) return 'Kedaluwarsa';
        return 'Aktif';
    }
    public function getStatusColor(): string {
        if (!$this->is_active) return 'secondary';
        if ($this->isExpired()) return 'warning';
        return 'success';
    }
}
