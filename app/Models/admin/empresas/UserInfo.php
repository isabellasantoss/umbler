<?php

namespace App\Models\admin\empresas;

use App\Models\admin\empresas\CCT;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User;

class UserInfo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = 
    [
        'cct',
        'cnpj',
        'razao_social',
        'nome_fantasia',
        'atividade',
        'emails',
        'cep',
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'estado',
        'cidade',
        'user_id',
    ];

    const SEXOS = ['Masculino', 'Feminino', 'Prefiro não informar'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function convencao() {
        return $this->belongsTo(CCT::class, 'cct');
    }

    public function empresa() {
        return $this->belongsTo(UserInfo::class, 'empresa_id');
    }
    

}