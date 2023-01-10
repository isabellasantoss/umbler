<?php

namespace App\Http\Controllers\admin\empresas\movimentacao;

use App\Exports\DependentesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Models\admin\movimentacao\Dependente;
use App\Models\admin\movimentacao\Funcionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DependentesController extends Controller
{
    public function index()
    {
        $search = request('search');

        if ($search) {
            $dependentes = Dependente::where('user_id', Auth::user()->id)
                ->where('name', 'like', '%' . $search . '%')
                ->orWhere('cpf', 'like', '%' . $search . '%')
                ->orWhere('rg', 'like', '%' . $search . '%')
                ->orWhere('funcionario_id', Dependente::capturarFuncionario($search))
                ->orWhere('empresa_id', Dependente::capturarEmpresa($search))
                ->orWhere('tipo_dependente', 'like', '%' . $search . '%')
                ->paginate(3);
        } else {
            $dependentes = Dependente::where('user_id', Auth::user()->id)->paginate(3);
        }

        return view('movimentacao.dependentes.grid', ['dependentes' => $dependentes]);
    }

    public function create()
    {
        return view('movimentacao.dependentes.form', [
            'funcionarios' => Funcionario::where('user_id', Auth::user()->id)->get(),
            'relacionamentos' => Dependente::RELACIONAMENTOS,
            'sexos' => Dependente::SEXOS,
            'grau_titulos' => Dependente::GRAU_TITULO,
            'grau_status' => Dependente::GRAU_STATUS
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'data_nascimento' => 'required',
                'sexo' => 'required',
                'funcionario_id' => 'required',
                'user_id' => 'required',
                'tipo_dependente' => 'required',
                'grau_titulo' => 'required',
                'grau_status' => 'required',
                'cpf' => 'required',
                'rg' => 'required',
                'celular' => 'required',
                'telefone' => 'required',
            ],

            [
                'name.required' => 'O campo de nome não foi preenchido.',
                'data_nascimento.required' => 'O campo de data de nascimento não foi preenchido.',
                'sexo.required' => 'O campo de sexo não foi preenchido.',
                'funcionario_id.required' => 'O campo de funcionário não foi preenchido.',
                'user_id.required' => 'O campo de usuário não foi preenchido.',
                'tipo_dependente.required' => 'O campo de relação com funcionário não foi preenchido.',
                'grau_titulo.required' => 'Os campos de escolaridade não foram preenchidos corretamente.',
                'grau_status.required' => 'Os campos de escolaridade não foram preenchidos corretamente.',
                'cpf.required' => 'O campo de cpf não foi preenchido.',
                'rg.required' => 'O campo de rg não foi preenchido.',
                'celular.required' => 'O campo de celular não foi preenchido.',
                'telefone.required' => 'O campo de telefone não foi preenchido.',
            ]
        );

        if (!in_array($request->tipo_dependente, Dependente::RELACIONAMENTOS)) {
            return redirect(route('dependentes.index'))->with('msg', 'Relacionamento inválido.');
        }

        if (!in_array($request->sexo, Dependente::SEXOS)) {
            return redirect(route('dependentes.index'))->with('msg', 'Verifique melhor o preenchimento do sexo do dependente.');
        }

        if ($request->tipo_dependente == 'Filhos' && Dependente::calcularIdade($request->data_nascimento) >= 20) {
            return redirect(route('dependentes.index'))->with('msg', 'Apenas filhos menores de 20 anos podem ser cadastrados.');
        }

        try {

            $dados = $request->all();

            $funcionario = Funcionario::findOrFail($dados['funcionario_id']);

            $dados['empresa_id'] = $funcionario->empresa_id;
            $dados['cpf'] = preg_replace("/[^0-9]/", "", $request->cpf);
            $dados['rg'] = preg_replace("/[^0-9]/", "", $request->rg);

            Dependente::create($dados);
            return redirect(route('dependentes.index'))->with('msg', 'Dependente cadastrado com sucesso.');

        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect(route('dependentes.index'))->with('msg', 'Houve um erro inesperado.');
        }
    }

    public function show($id)
    {
        return view('movimentacao.dependentes.form-view', ['dependente' => Dependente::findOrFail(base64_decode($id)), 'funcionarios' => Funcionario::where('user_id', Auth::user()->id)->get()]);
    }

    public function edit($id)
    {
        return view('movimentacao.dependentes.form-edit', [
            'dependente' => Dependente::findOrFail(base64_decode($id)),
            'funcionarios' => Funcionario::where('user_id', Auth::user()->id)->get(),
            'relacionamentos' => Dependente::RELACIONAMENTOS,
            'sexos' => Dependente::SEXOS,
            'grau_titulos' => Dependente::GRAU_TITULO,
            'grau_status' => Dependente::GRAU_STATUS
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required',
                'data_nascimento' => 'required',
                'sexo' => 'required',
                'funcionario_id' => 'required',
                'user_id' => 'required',
                'tipo_dependente' => 'required',
                'grau_titulo' => 'required',
                'grau_status' => 'required',
                'cpf' => 'required',
                'rg' => 'required',
                'celular' => 'required',
                'telefone' => 'required',
            ],

            [
                'name.required' => 'O campo de nome não foi preenchido.',
                'data_nascimento.required' => 'O campo de data de nascimento não foi preenchido.',
                'sexo.required' => 'O campo de sexo não foi preenchido.',
                'funcionario_id.required' => 'O campo de funcionário não foi preenchido.',
                'user_id.required' => 'O campo de usuário não foi preenchido.',
                'tipo_dependente.required' => 'O campo de relação com funcionário não foi preenchido.',
                'grau_titulo.required' => 'Os campos de escolaridade não foram preenchidos corretamente.',
                'grau_status.required' => 'Os campos de escolaridade não foram preenchidos corretamente.',
                'cpf.required' => 'O campo de cpf não foi preenchido.',
                'rg.required' => 'O campo de rg não foi preenchido.',
                'celular.required' => 'O campo de celular não foi preenchido.',
                'telefone.required' => 'O campo de telefone não foi preenchido.',
            ]
        );

        if (!in_array($request->tipo_dependente, Dependente::RELACIONAMENTOS)) {
            return redirect(route('dependentes.index'))->with('msg', 'Relacionamento inválido.');
        }

        if (!in_array($request->sexo, Dependente::SEXOS)) {
            return redirect(route('funcionarios.index'))->with('msg', 'Verifique melhor o preenchimento do sexo do dependente.');
        }

        if ($request->tipo_dependente == 'Filhos' && Dependente::calc_idade($request->data_nascimento) >= 20) {
            return redirect(route('dependentes.index'))->with('msg', 'Apenas filhos menores de 20 anos podem ser cadastrados.');
        }

        try {

            $dados = $request->all();

            $funcionario = Funcionario::findOrFail($dados['funcionario_id']);

            $dados['empresa_id'] = $funcionario->empresa_id;
            $dados['cpf'] = preg_replace("/[^0-9]/", "", $request->cpf);
            $dados['rg'] = preg_replace("/[^0-9]/", "", $request->rg);

            Dependente::findOrFail($id)->update($dados);
            return redirect(route('dependentes.index'))->with('msg', 'Dependente atualizado com sucesso.');

        } catch (\Throwable $th) {
            return redirect(route('dependentes.index'))->with('msg', 'Houve um erro inesperado.');
        }
    }

    public function destroy($id)
    {
        try {
            Dependente::findOrFail(base64_decode($id))->delete();
            return redirect(route('dependentes.index'))->with('msg', 'Dependente excluído com sucesso.');
        } catch (\Throwable $th) {
            return redirect(route('dependentes.index'))->with('msg', 'Houve um erro inesperado.');
        }

    }

    public function export()
    {
        return Excel::download(new DependentesExport, 'dependentes.xlsx');
    }

}