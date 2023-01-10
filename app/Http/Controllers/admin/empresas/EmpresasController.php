<?php

namespace App\Http\Controllers\admin\empresas;

use App\Exports\ContratosExport;
use App\Exports\EmpresasExport;
use App\Http\Controllers\Controller;
use App\Models\admin\empresas\UserInfo;
use App\Models\admin\empresas\CCT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class EmpresasController extends Controller
{
    public function index()
    {
        $search = request('search');

        if ($search) {
            $userinfos = UserInfo::where('user_id', Auth::user()->id)
                ->where('cnpj', 'like', '%' . $search . '%')
                ->orWhere('razao_social', 'like', '%' . $search . '%')
                ->orWhere('emails', 'like', '%' . $search . '%')
                ->paginate(3);
        } else {
            $userinfos = UserInfo::where('user_id', Auth::user()->id)->paginate(3);
        }

        return view('empresas.dados.grid', ['userinfos' => $userinfos]);
    }

    public function show($id)
    {
        return view('empresas.dados.form-view', [
            'userinfos' => UserInfo::findOrFail(base64_decode($id)),
            'ccts' => CCT::all()
        ]);
    }

    public function create()
    {
        return view(
            'empresas.dados.form-create',
            [
                'ccts' => CCT::all()
            ]
        );
    }

    public function edit($id)
    {
        return view(
            'empresas.dados.form-edit',
            [
                'userinfos' => UserInfo::findOrFail(base64_decode($id)),
                'ccts' => CCT::all()
            ]
        );
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'cnpj' => 'required|max:14',
                'razao_social' => 'required',
                'nome_fantasia' => 'required',
                'atividade' => 'required',
                'emails' => 'required',
                'cep' => 'required|max:8',
                'logradouro' => 'required',
                'numero' => 'required',
                'bairro' => 'required',
                'estado' => 'required',
                'cidade' => 'required'
            ],

            [
                'cnpj.required' => 'O campo CNPJ não foi preenchido',
                'razao_social.required' => 'O campo razão social não foi preenchido',
                'nome_fantasia.required' => 'O campo nome fantasia não foi preenchido',
                'emails.required' => 'O campo emails não foi preenchido',
                'cep.required' => 'O campo cep não foi preenchido',
                'logradouro.required' => 'O campo logradouro não foi preenchido',
                'numero.required' => 'O campo número não foi preenchido',
                'bairro.required' => 'O campo bairro não foi preenchido',
                'estado.required' => 'O campo estado não foi preenchido',
                'cidade.required' => 'O campo cidade não foi preenchido'
            ]
        );

        try {
            UserInfo::create([
                'user_id' => Auth::user()->id,
                'atividade' => $request->atividade,
                'cnpj' => $request->cnpj,
                'razao_social' => $request->razao_social,
                'nome fantasia' => $request->nome_fantasia,
                'cct' => $request->cct,
                'nome_fantasia' => $request->nome_fantasia,
                'emails' => $request->emails,
                'cep' => $request->cep,
                'logradouro' => $request->logradouro,
                'numero' => $request->numero,
                'complemento' => $request->complemento,
                'bairro' => $request->bairro,
                'estado' => $request->estado,
                'cidade' => $request->cidade,
            ]);

            return redirect(route('empresas.index'))->with('msg', 'Dados cadastrados com sucesso.');

        } catch (\Throwable $th) {
            return redirect(route('empresas.index'))->with('msg', 'Houve um erro inesperado.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'atividade' => 'required',
                'emails' => 'required',
                'cep' => 'required|max:8',
                'logradouro' => 'required',
                'numero' => 'required',
                'bairro' => 'required',
                'estado' => 'required',
                'cidade' => 'required'
            ],

            [
                'emails.required' => 'O campo emails não foi preenchido',
                'cep.required' => 'O campo cep não foi preenchido',
                'logradouro.required' => 'O campo logradouro não foi preenchido',
                'numero.required' => 'O campo número não foi preenchido',
                'bairro.required' => 'O campo bairro não foi preenchido',
                'estado.required' => 'O campo estado não foi preenchido',
                'cidade.required' => 'O campo cidade não foi preenchido'
            ]
        );

        try {
            UserInfo::findOrFail(base64_decode($id))->update([
                'user_id' => Auth::user()->id,
                'cct' => $request->cct,
                'nome_fantasia' => $request->nome_fantasia,
                'emails' => $request->emails,
                'cep' => $request->cep,
                'logradouro' => $request->logradouro,
                'numero' => $request->numero,
                'complemento' => $request->complemento,
                'bairro' => $request->bairro,
                'estado' => $request->estado,
                'cidade' => $request->cidade,
            ]);

            return redirect(route('empresas.index'))->with('msg', 'Dados cadastrais atualizado com sucesso.');

        } catch (\Throwable $th) {
            return redirect(route('empresas.index'))->with('msg', 'Houve um erro inesperado.');
        }
    }

    public function destroy($id)
    {
        try {
            UserInfo::findOrFail(base64_decode($id))->delete();
            return redirect(route('empresas.index'))->with('msg', 'Dados cadastrais excluídos com sucesso.');
        } catch (\Throwable $th) {
            return redirect(route('empresas.index'))->with('msg', 'Houve um erro inesperado.');
        }
    }

    public function exportEmpresas()
    {
        $date = date('d-m-Y');
        return Excel::download(new EmpresasExport, 'Relatório Geral - Empresas' . '-' . $date . '-' . '.xlsx');
    }

    public function exportContratos()
    {
        $date = date('d-m-Y');
        return Excel::download(new ContratosExport, 'Relatório Geral - Contratos' . '-' . $date . '-' . '.xlsx');
    }

    public function contratosIndex()
    {
        return view('empresas.contratos.grid', ['convencoes' => UserInfo::where('user_id', Auth::user()->id)->get()]);
    }

    public function contratosShow($id)
    {
        $cct = UserInfo::where('user_id', Auth::user()->id)->first();
        return view('empresas.contratos.form-view', [
            'convencoes' => CCT::where('id', $cct->id)->get()
        ], $id);
    }


    public function contratosEdit($id)
    {
        return view('empresas.contratos.form-edit', ['userinfos' => UserInfo::findOrFail(base64_decode($id)), 'convencao' => CCT::all()]);
    }

    public function contratosUpdate(Request $request, $id)
    {
        $request->validate(
            [
                'cct' => 'required',
            ],

            [
                'cct.required' => 'O campo não pode estar em branco'
            ]
        );

        try {


            UserInfo::findOrFail(base64_decode($id))->update($request->all());
            return redirect(route('contratos.index'))->with('msg', 'Contrato atualizado com sucesso.');
        } catch (\Throwable $th) {
            return redirect(route('contratos.index'))->with('msg', 'Houve um erro inesperado.');
        }
    }

    public function contratosCreate()
    {
        return view('empresas.contratos.form');
    }

    public function contratosStore(Request $request)
    {
        try {
            CCT::create($request->all());
            return redirect(route('empresas.contratos.index'))->with('msg', 'Contrato cadastrado com sucesso.');
        } catch (\Throwable $th) {
            return redirect(route('empresas.contratos.index'))->with('msg', 'Houve um erro inesperado.');
        }
    }

    public function contratosDestroy($id)
    {
        try {
            UserInfo::findOrFail(base64_decode($id))->delete();
            return redirect(route('movimentacao.funcionarios.index'))->with('msg', 'Funcionário excluído com sucesso.');
        } catch (\Throwable $th) {
            return redirect(route('movimentacao.funcionarios.index'))->with('msg', 'Houve um erro inesperado.');
        }
    }


}