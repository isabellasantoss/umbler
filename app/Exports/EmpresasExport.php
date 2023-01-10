<?php

namespace App\Exports;

use App\Models\admin\UserInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmpresasExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

      
    public function headings(): array
    {
        return [
           [
            'CNPJ',
            'Razão Social',
            'Nome Fantasia',
            'Atividade',
            'Criada em'
        ],
    ];
    }


    public function collection()
    {

        $contrato = DB::table('user_infos')
        ->selectRaw('CNPJ, razao_social, nome_fantasia, atividade, created_at')
        ->where('user_id', '=', Auth::user()->id)
        ->get();

        return $contrato;
    }

}
