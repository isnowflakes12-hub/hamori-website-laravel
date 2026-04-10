<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class LamaranKarir extends Model {
    protected $fillable = ['karir_id','nama','email','telepon','cv','cover_letter','status','catatan'];
    public function karir() { return $this->belongsTo(Karir::class); }

    public function getStatusLabelAttribute(): string {
        return match($this->status ?? 'pending') {
            'pending'    => 'Menunggu',
            'review'     => 'Sedang Direview',
            'shortlist'  => 'Shortlist',
            'interview'  => 'Interview',
            'diterima'   => 'Diterima',
            'ditolak'    => 'Tidak Lolos',
            default      => 'Menunggu',
        };
    }
    public function getStatusColorAttribute(): string {
        return match($this->status ?? 'pending') {
            'pending'   => 'warning',
            'review'    => 'info',
            'shortlist' => 'primary',
            'interview' => 'purple',
            'diterima'  => 'success',
            'ditolak'   => 'danger',
            default     => 'secondary',
        };
    }
}
