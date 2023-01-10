<?php

namespace App\Imports;

use App\Models\admin\Funcionario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FuncionarioImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {

        return new Funcionario([
            'cpf' => $row['cpf'],
            'matricula' => $row['matricula'],
            'name' => $row['nome'],
            'nome_mae' => $row['nome_mae'],
            'email' => $row['email'],
            'nacionalidade' => $row['nacionalidade'],
            'naturalidade' => $row['naturalidade'],
            'sexo' => $row['sexo'],
            'user_id' => Auth::user()->id,
            'data_admissao' => $row['data_admissao'],
            'data_nascimento' => $row['data_nascimento'],
            'estado_civil' =>  $row['estado_civil'],
            'rg' => $row['rg'],
            'data_emissao_rg' => $row['data_emissao_rg'],
            'orgao_emissor_rg' =>  $row['orgao_emissor_rg'],
            'estado_emissor_rg' => $row['estado_emissor_rg'],
            'data_casamento' => $row['data_casamento'],
            'cep' => $row['cep'],
            'logradouro' => $row['logradouro'],
            'numero' => $row['numero'],
            'complemento' => $row['complemento'],
            'bairro' => $row['bairro'],
            'estado' => $row['estado'],
            'cidade' => $row['cidade'],
            'telefone' => $row['telefone'],
            'celular' => $row['celular']
        ]);
    }
}
