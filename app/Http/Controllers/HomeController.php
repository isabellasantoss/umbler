<?php

namespace App\Http\Controllers;

use App\Models\admin\movimentacao\Funcionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $countFuncionario = Funcionario::where('user_id', Auth::user()->id)->get()->count();
        return view('pages.dashboard', compact($countFuncionario));
    }

}
