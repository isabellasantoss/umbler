<?php

namespace App\Http\Controllers\admin\empresas\logs;

use App\Http\Controllers\Controller;
use App\Models\admin\logs\LogFuncionario;
use Illuminate\Support\Facades\Auth;

class LogFuncionariosController extends Controller
{
    public function index()
    {
        return view('log-funcionario.grid', ['logFuncionarios' => LogFuncionario::where('user_id', Auth::user()->id)->paginate(3)]);
    }

}