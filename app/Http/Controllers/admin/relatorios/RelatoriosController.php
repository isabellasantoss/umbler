<?php

namespace App\Http\Controllers\admin\relatorios;

use App\Http\Controllers\Controller;

class RelatoriosController extends Controller
{
    public function index()
    {
        return view('relatorios.grid');
    }
}
