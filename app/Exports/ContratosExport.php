<?php

namespace App\Exports;

use App\Models\admin\UserInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ContratosExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

  
    public function headings(): array
    {
        return [
           [
            'Empresa',
            'Convenção',
            'Sindicato Patronal',
            'Sindicato Laboral',
            'Abrangência',
            'Criado em',
        ],
    ];
    }

    public function collection()
    {
        $contrato = DB::table('user_infos')
                ->selectRaw('razao_social')
                ->join('c_c_t_s', 'c_c_t_s.id', '=', 'user_infos.cct')
                ->selectRaw('c_c_t_s.sind_patronal')
                ->selectRaw('c_c_t_s.sind_laboral' )
                ->selectRaw('c_c_t_s.cct' )
                ->selectRaw('abrang')
                ->selectRaw('user_infos.created_at')
                ->where('user_infos.user_id', '=', Auth::user()->id)
                ->get();

        return $contrato;

    }


}
