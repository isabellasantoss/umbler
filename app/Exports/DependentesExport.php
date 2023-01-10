<?php

namespace App\Exports;

use App\Models\admin\Dependente;
use Maatwebsite\Excel\Concerns\FromCollection;

class DependentesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Dependente::all();
    }
}
