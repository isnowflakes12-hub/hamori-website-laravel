<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class TempatTidur extends Model {
    protected $table = 'tempat_tidurs';
    protected $fillable = ['kelas','total','terisi','tersedia'];
    public function getPersentaseTerisiAttribute() {
        return $this->total > 0 ? round(($this->terisi / $this->total) * 100) : 0;
    }
}
