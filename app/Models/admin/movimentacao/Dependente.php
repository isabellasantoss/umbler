<?php

namespace App\Models\admin\movimentacao;

use App\Models\admin\empresas\UserInfo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Dependente extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'data_nascimento',
        'funcionario_id',
        'sexo',
        'tipo_dependente',
        'grau_titulo',
        'grau_status',
        'cpf',
        'rg',
        'celular',
        'user_id',
        'empresa_id',
        'telefone'
    ];

    const RELACIONAMENTOS = ['Filhos', 'Pais', 'Cônjuge', 'Irmãos'];
    const SEXOS = ['Masculino', 'Feminino', 'Prefiro não informar'];

    const GRAU_TITULO = ['Fundamental', 'Médio', 'Superior'];
    const GRAU_STATUS = ['Incompleto', 'Completo'];

    public static function calcularIdade($data)
    {
        $idade = 0;
        $data_nascimento = date('Y-m-d', strtotime($data));
        list($anoNasc, $mesNasc, $diaNasc) = explode('-', $data_nascimento);

        $idade = date("Y") - $anoNasc;
        if (date("m") < $mesNasc) {
            $idade -= 1;
        } elseif ((date("m") == $mesNasc) && (date("d") <= $diaNasc)) {
            $idade -= 1;
        }

        return $idade;
    }

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class, 'funcionario_id');
    }

    public function empresa()
    {
        return $this->belongsTo(UserInfo::class, 'empresa_id');
    }

    public static function capturarFuncionario($pesquisa)
    {
        try {
            return Funcionario::where('name', 'like', '%' . $pesquisa . '%')->where('user_id', Auth::user()->id)->first()->id;
        } catch (\Throwable $th) {
            return '';
        }
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