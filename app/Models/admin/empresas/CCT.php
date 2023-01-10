<?php

namespace App\Models\admin\empresas;

use App\Models\admin\UserInfo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CCT extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'cct',
        'sind_patronal',
        'sind_laboral',
        'abrang'
    ];

    public function usuario() {
        return $this->belongsTo(UserInfo::class, 'cct');
    }
    public function empresa() {
        return $this->belongsTo(UserInfo::class, 'empresa_id');
    }
}
