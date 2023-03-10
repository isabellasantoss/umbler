<?php

namespace App\Http\Controllers\admin\empresas\movimentacao;

use App\Exports\FuncionarioExport;
use App\Http\Controllers\Controller;
use App\Imports\FuncionarioImport;
use App\Models\admin\movimentacao\Dependente;
use App\Models\admin\movimentacao\Funcionario;
use App\Models\admin\empresas\UserInfo;
use App\Models\admin\empresas\Cartoes;
use App\Models\admin\logs\LogFuncionario;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FuncionariosController extends Controller
{
    public function index()
    {
        $search = request('search');

        if ($search) {
            $funcionarios = Funcionario::where('user_id', Auth::user()->id)
                ->where('name', 'like', '%' . $search . '%')
                ->orWhere('cpf', 'like', '%' . $search . '%')
                ->orWhere('rg', 'like', '%' . $search . '%')
                ->orWhere('empresa_id', Funcionario::capturarEmpresa($search))
                ->orWhere('cep', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('matricula', 'like', '%' . $search . '%')
                ->paginate(3);
        } else {
            $funcionarios = Funcionario::where('user_id', Auth::user()->id)->paginate(3);
        }

        return view('movimentacao.funcionarios.grid', ['funcionarios' => $funcionarios]);
    }

    public function create()
    {
        return view('movimentacao.funcionarios.form', [
            'empresas' => UserInfo::where('user_id', Auth::user()->id)->get(),
            'sexos' => Funcionario::SEXOS,
            'estados_civis' => Funcionario::ESTADOS_CIVIS,
            
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'cpf' => 'required',
                'matricula' => 'required',
                'name' => 'required',
                'nome_mae' => 'required',
                'email' => 'required',
                'nacionalidade' => 'required',
                'naturalidade' => 'required',
                'sexo' => 'required',
                'empresa_id' => 'required',
                'data_admissao' => 'required',
                'data_nascimento' => 'required',
                'estado_civil' => 'required',
                'rg' => 'required',
                'data_emissao_rg' => 'required',
                'estado_emissor_rg' => 'required',
                'telefone' => 'required',
                'celular' => 'required',
                'cep' => 'required|max:8',
                'logradouro' => 'required',
                'numero' => 'required',
                'bairro' => 'required',
                'estado' => 'required',
                'cidade' => 'required'
            ],

            [
                'cpf.required' => 'O campo cpf n??o foi preenchido.',
                'matricula.required' => 'O campo matr??cula n??o foi preenchido.',
                'name.required' => 'O campo nome n??o foi preenchido.',
                'nome_mae.required' => 'O campo nome da m??e n??o foi preenchido.',
                'email.required' => 'O campo e-mail n??o foi preenchido.',
                'nacionalidade.required' => 'O campo nacionalidade n??o foi preenchido.',
                'naturalidade.required' => 'O campo naturalidade n??o foi preenchido.',
                'sexo.required' => 'O campo sexo n??o foi preenchido.',
                'empresa_id.required' => 'O campo empresa n??o foi preenchido.',
                'data_admissao.required' => 'O campo data de admissao n??o foi preenchido.',
                'data_nascimento.required' => 'O campo data de nascimento n??o foi preenchido.',
                'estado_civil.required' => 'O campo estado civil n??o foi preenchido.',
                'rg.required' => 'O campo n??mero rg n??o foi preenchido.',
                'data_emissao_rg.required' => 'O campo data emiss??o do rg n??o foi preenchido.',
                'estado_emissor_rg.required' => 'O campo estado emissor do rg n??o foi preenchido.',
                'telefone.required' => 'O campo telefone n??o foi preenchido.',
                'celular.required' => 'O campo celular n??o foi preenchido.',
                'cep.required' => 'O campo cep n??o foi preenchido',
                'logradouro.required' => 'O campo logradouro n??o foi preenchido',
                'numero.required' => 'O campo n??mero n??o foi preenchido',
                'bairro.required' => 'O campo bairro n??o foi preenchido',
                'estado.required' => 'O campo estado n??o foi preenchido',
                'cidade.required' => 'O campo cidade n??o foi preenchido'
            ]
        );

        if ((!$request->data_casamento && $request->estado_civil == 'Casado') or ($request->data_casamento && $request->estado_civil != 'Casado')) {
            return redirect(route('funcionarios.index'))->with('msg', 'Verifique melhor as datas de relacionadas ao estado civil.');
        }

        if(!in_array($request->sexo, Funcionario::SEXOS)){
            return redirect(route('funcionarios.index'))->with('msg', 'Verifique melhor o preenchimento do sexo do funcion??rio.');
        }

        if(!in_array($request->estado_civil, Funcionario::ESTADOS_CIVIS)){
            return redirect(route('funcionarios.index'))->with('msg', 'Verifique melhor o preenchimento do estado civil do funcion??rio.');
        }

        if (($request->data_nascimento > $request->data_admissao) or (!is_null($request->data_casamento) && $request->data_nascimento > $request->data_casamento) or ($request->data_nascimento > $request->data_emissao_rg)) {
            return redirect(route('funcionarios.index'))->with('msg', 'Verifique melhor as datas de relacionadas ao nascimento, casamento e admiss??o.');
        }

        try {
            //cria????o cartao
            $randomNumber = random_int(1000000000000000, 9999999999999999);

            $dados = $request->all();
            $dados['user_id'] = Auth::user()->id;
            $dados['numero'] = preg_replace("/[^0-9]/", "", $request->numero);
            $dados['cpf'] = preg_replace("/[^0-9]/", "", $request->cpf);
            $dados['numeracao_cartao'] = $randomNumber;
            $dados['rg'] = preg_replace("/[^0-9]/", "", $request->rg);


            Funcionario::create($dados)->assignRole('user');

            LogFuncionario::create(['log' => LogFuncionario::MSG_LOG_INSERIR, 'user_id' => Auth::user()->id, 'ip' => $request->server->get('REMOTE_ADDR')]);
            return redirect(route('funcionarios.index'))->with('msg', 'Dados cadastrados com sucesso.');

        } catch (\Throwable $th) {
            dd($th);
            LogFuncionario::create(['log' => LogFuncionario::MSG_LOG_ERROR, 'user_id' => Auth::user()->id, 'ip' => $request->server->get('REMOTE_ADDR')]);
            return redirect(route('funcionarios.index'))->with('msg', 'Houve um erro inesperado.');
        }
    }

    public function show($id)
    {
        return view('movimentacao.funcionarios.form-view', [
            'funcionario' => Funcionario::findOrFail(base64_decode($id)),
            'sexos' => Funcionario::SEXOS,
            'estados_civis' => Funcionario::ESTADOS_CIVIS,
        ]);
    }

    public function edit($id)
    {
        return view('movimentacao.funcionarios.form-edit', [
            'funcionario' => Funcionario::findOrFail(base64_decode($id)), 
            'empresas' => UserInfo::where('user_id', Auth::user()->id)->get(),
            'sexos' => Funcionario::SEXOS,
            'estados_civis' => Funcionario::ESTADOS_CIVIS,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'cpf' => 'required',
                'matricula' => 'required',
                'name' => 'required',
                'nome_mae' => 'required',
                'email' => 'required',
                'nacionalidade' => 'required',
                'naturalidade' => 'required',
                'sexo' => 'required',
                'empresa_id' => 'required',
                'data_admissao' => 'required',
                'data_nascimento' => 'required',
                'estado_civil' => 'required',
                'rg' => 'required',
                'data_emissao_rg' => 'required',
                'estado_emissor_rg' => 'required',
                'telefone' => 'required',
                'celular' => 'required',
                'cep' => 'required|max:8',
                'logradouro' => 'required',
                'numero' => 'required',
                'bairro' => 'required',
                'estado' => 'required',
                'cidade' => 'required'
            ],

            [
                'cpf.required' => 'O campo cpf n??o foi preenchido.',
                'matricula.required' => 'O campo matr??cula n??o foi preenchido.',
                'name.required' => 'O campo nome n??o foi preenchido.',
                'nome_mae.required' => 'O campo nome da m??e n??o foi preenchido.',
                'email.required' => 'O campo e-mail n??o foi preenchido.',
                'nacionalidade.required' => 'O campo nacionalidade n??o foi preenchido.',
                'naturalidade.required' => 'O campo naturalidade n??o foi preenchido.',
                'sexo.required' => 'O campo sexo n??o foi preenchido.',
                'empresa_id.required' => 'O campo empresa n??o foi preenchido.',
                'data_admissao.required' => 'O campo data de admissao n??o foi preenchido.',
                'data_nascimento.required' => 'O campo data de nascimento n??o foi preenchido.',
                'estado_civil.required' => 'O campo estado civil n??o foi preenchido.',
                'rg.required' => 'O campo n??mero rg n??o foi preenchido.',
                'data_emissao_rg.required' => 'O campo data emiss??o do rg n??o foi preenchido.',
                'estado_emissor_rg.required' => 'O campo estado emissor do rg n??o foi preenchido.',
                'telefone.required' => 'O campo telefone n??o foi preenchido.',
                'celular.required' => 'O campo celular n??o foi preenchido.',
                'cep.required' => 'O campo cep n??o foi preenchido',
                'logradouro.required' => 'O campo logradouro n??o foi preenchido',
                'numero.required' => 'O campo n??mero n??o foi preenchido',
                'bairro.required' => 'O campo bairro n??o foi preenchido',
                'estado.required' => 'O campo estado n??o foi preenchido',
                'cidade.required' => 'O campo cidade n??o foi preenchido'
            ]
        );

        if ((!$request->data_casamento && $request->estado_civil == 'Casado') or ($request->data_casamento && $request->estado_civil != 'Casado')) {
            return redirect(route('funcionarios.index'))->with('msg', 'Verifique melhor as datas de relacionadas ao estado civil.');
        }

        if(!in_array($request->estado_civil, Funcionario::ESTADOS_CIVIS)){
            return redirect(route('funcionarios.index'))->with('msg', 'Verifique melhor o preenchimento do estado civil do funcion??rio.');
        }

        if(!in_array($request->sexo, Funcionario::SEXOS)){
            return redirect(route('funcionarios.index'))->with('msg', 'Verifique melhor o preenchimento do sexo do funcion??rio.');
        }

        if (($request->data_nascimento > $request->data_admissao) or (!is_null($request->data_casamento) && $request->data_nascimento > $request->data_casamento) or ($request->data_nascimento > $request->data_emissao_rg)) {
            return redirect(route('funcionarios.index'))->with('msg', 'Verifique melhor as datas de relacionadas ao nascimento, casamento e admiss??o.');
        }

        try {

            $dados = $request->all();

            $dados['numero'] = preg_replace("/[^0-9]/", "", $request->numero);
            $dados['cpf'] = preg_replace("/[^0-9]/", "", $request->cpf);
            $dados['rg'] = preg_replace("/[^0-9]/", "", $request->rg);

            Funcionario::findOrFail(base64_decode($id))->update($dados);
            LogFuncionario::create(['log' => LogFuncionario::MSG_LOG_UPDATE, 'user_id' => Auth::user()->id, 'ip' => $request->server->get('REMOTE_ADDR')]);

            return redirect(route('funcionarios.index'))->with('msg', 'Dados cadastrados com sucesso.');

        } catch (\Throwable $th) {
            LogFuncionario::create(['log' => LogFuncionario::MSG_LOG_ERROR, 'user_id' => Auth::user()->id, 'ip' => $request->server->get('REMOTE_ADDR')]);
            return redirect(route('funcionarios.index'))->with('msg', 'Houve um erro inesperado.');
        }
    }

    public function destroy($id, Request $request)
    {
        try {

            $dependentesDesteFuncionario = Dependente::where('funcionario_id', base64_decode($id))->get();

            foreach ($dependentesDesteFuncionario as $dependente) {
                $dependente->delete();
            }

            Funcionario::findOrFail(base64_decode($id))->delete();
            LogFuncionario::create(['log' => LogFuncionario::MSG_LOG_DELETE, 'user_id' => Auth::user()->id, 'ip' => $request->server->get('REMOTE_ADDR')]);
            return redirect(route('funcionarios.index'))->with('msg', 'Funcion??rio exclu??do com sucesso.');

        } catch (\Throwable $th) {
            LogFuncionario::create(['log' => LogFuncionario::MSG_LOG_ERROR, 'user_id' => Auth::user()->id, 'ip' => $request->server->get('REMOTE_ADDR')]);
            return redirect(route('funcionarios.index'))->with('msg', 'Houve um erro inesperado.');
        }
    }


    public function export()
    {
        $date = date('d-m-Y');
        return Excel::download(new FuncionarioExport, 'Relat??rio Geral - Funcion??rios' . '-' . $date . '-' . '.xlsx');
    }

    public function import(Request $request)
    {

        if ($request->hasFile('funcionarios')) {
            dd($request->hasFile);
            $data = $request->file('excel_file');
            $data->move(('path'), $data->getClientOriginalName());
            $file_url = ('storage') . $data->getClientOriginalName();
            Excel::import(new FuncionarioImport, $file_url);
            return back()->with('sucesso', 'Enviado com sucesso!');
        } else {
            return back()->with('error', "Arquivo obrigat??rio");
        }
    }
}