<?php

namespace App\Exports;

use App\Models\admin\Funcionario;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FuncionarioExport implements FromCollection, WithHeadings
{
    use Exportable;
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
           [
            'Matricula funcionário',
            'Nome',
            'Data Admissão',
            'Data Nascimento',
            'RG',
            'Cidade',
            'Telefone',
            'Criado em'
        ],
    ];
    }
   
    public function collection()
    {
        $contrato = DB::table('funcionarios')
                ->selectRaw('matricula, funcionarios.name, data_admissao, funcionarios.data_nascimento, rg, cidade, telefone, funcionarios.created_at')
                ->join('users', 'funcionarios.user_id', '=', 'users.id')
                ->where('users.id', '=', Auth::user()->id)
                ->get();

        return $contrato;

    }
}
