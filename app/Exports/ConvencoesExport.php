<?php

namespace App\Exports;

use App\Models\CCT;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ConvencoesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
           [
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
        $contrato = DB::table('c_c_t_s')
                ->selectRaw('c_c_t_s.cct' )
                ->selectRaw('c_c_t_s.sind_patronal')
                ->selectRaw('c_c_t_s.sind_laboral' )
                ->selectRaw('abrang')
                ->selectRaw('c_c_t_s.created_at' )
                ->get();

        return $contrato;

    }

}
