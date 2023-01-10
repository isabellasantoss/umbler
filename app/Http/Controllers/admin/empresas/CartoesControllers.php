<?php

namespace App\Http\Controllers\admin\empresas;

use App\Exports\CartoesExport;
use App\Http\Controllers\Controller;
use App\Models\admin\empresas\UserInfo;
use App\Models\admin\empresas\Cartoes;
use App\Models\admin\movimentacao\Funcionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class CartoesControllers extends Controller
{
    public function index()
    {
        return view('cartoes.grid', ['cartoes' => Funcionario::where('user_id', Auth::user()->id)->get()]);
    }

    public function edit($id)
    {
        return view('cartoes.form-edit', ['cartoes' => Funcionario::findOrFail(base64_decode($id)), 'empresas' => UserInfo::where('user_id', Auth::user()->id)->get()]);
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'user_id' => 'required|max:20',
                'empresa_id' => 'required|max:20',
                'numeracao' => 'required|max:20',
                'ativo' => 'required',
            ],

            [
                'user_id.required' => 'O campo de usuário não foi preenchido.',
                'empresa_id.required' => 'O campo de empresa não foi preenchido.',
                'numeracao.required' => 'O campo de numeração não foi preenchido.',
                'ativo.required' => 'O campo de atividade não foi preenchido.',
            ]
        );

        try
        {
            Funcionario::findOrFail(base64_decode($id))->update($request->all());
            return redirect(route('cartoes.index'))->with('msg', 'Convenção atualizado com sucesso.');
        } 
        
        catch (\Throwable $th) 
        {
            return redirect(route('cartoes.index'))->with('msg', 'Houve um erro inesperado.');
        }

    }

    public function export()
    {
        $date = date('d-m-Y');
        return Excel::download(new CartoesExport, 'Relatório Geral - Cartões' . '-' . $date . '-' . '.xlsx');
    }

}