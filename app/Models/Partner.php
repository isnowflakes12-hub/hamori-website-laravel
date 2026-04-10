<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Partner extends Model {
    protected $fillable = ['nama','logo','kategori','website','is_active'];
    protected $casts = ['is_active'=>'boolean'];
}
