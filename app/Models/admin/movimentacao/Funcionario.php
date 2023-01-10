<?php

namespace App\Models\admin\movimentacao;

use App\Models\admin\empresas\Cartoes;
use App\Models\admin\empresas\UserInfo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Funcionario extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'cpf',
        'matricula',
        'name',
        'nome_mae',
        'email',
        'nacionalidade',
        'naturalidade',
        'sexo',
        'data_admissao',
        'data_nascimento',
        'estado_civil',
        'rg',
        'data_emissao_rg',
        'orgao_emissor_rg',
        'estado_emissor_rg',
        'data_casamento',
        'cep',
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'estado',
        'cidade',
        'telefone',
        'celular',
        'user_id',
        'empresa_id',
        'numeracao_cartao',
    ];


    const SEXOS = ['Masculino', 'Feminino', 'Prefiro não informar'];
    const ESTADOS_CIVIS = ['Solteiro', 'Casado', 'Divorciado', 'Viúvo', 'União estável'];

    public function empresa() {
        return $this->belongsTo(UserInfo::class, 'empresa_id');
    }

    
    public static function capturarEmpresa($pesquisa)
    {
        try {
            return UserInfo::where('nome_fantasia', 'like', '%' . $pesquisa . '%')->where('user_id', Auth::user()->id)->first()->id;
        } catch (\Throwable $th) {
            return '';
        }
    }
}