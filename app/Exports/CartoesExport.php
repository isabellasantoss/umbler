<?php

namespace App\Exports;

use App\Models\Cartoes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CartoesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
           [
            'Numeração cartão',
            'Ativo?',
            'Funcionário',
            'Empresa',
            'Criado em',
        ],
    ];
    }

    public function collection()
    {
        $contrato = DB::table('funcionarios')
                ->selectRaw('numeracao_cartao, cartao_ativo, funcionarios.name')
                ->join('user_infos', 'user_infos.user_id', '=', 'funcionarios.user_id')
                ->selectRaw('user_infos.razao_social')
                ->selectRaw('user_infos.created_at')
                ->where('user_infos.user_id', '=', Auth::user()->id)
                ->get();

        return $contrato;

    }
}
