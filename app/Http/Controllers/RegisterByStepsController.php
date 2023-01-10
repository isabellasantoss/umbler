<?php

namespace App\Http\Controllers;

use App\Models\admin\empresas\UserInfo;
use App\Models\admin\empresas\CCT;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterByStepsController extends Controller
{
    public function createStepOne(Request $request)
    {
        return view('enterprise.create-step-one', ['convencoes' => CCT::all()]);
    }

    public function postCreateStepOne(Request $request)
    {
        $request->validate(
            [
                'cct' => 'required'
            ],

            [
                'cct.required' => 'O campo de CCT não foi preenchido.'
            ]
        );

        session()->put('convention', $request->all());
        return redirect()->route('enterprise.create.step.two');
    }

    public function createStepTwo(Request $request)
    {
        if ($request->session()->exists('convention')) {
            return view('enterprise.create-step-two');
        } else {
            return redirect(route('enterprise.create.step.one'))->with('msg', 'É necessário efetuar todas etapas do cadastro.');
        }
    }

    public function postCreateStepTwo(Request $request)
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
                'atividade.required' => 'O campo atividades não foi preenchido',
                'emails.required' => 'O campo emails não foi preenchido',
                'cep.required' => 'O campo cep não foi preenchido',
                'logradouro.required' => 'O campo logradouro não foi preenchido',
                'numero.required' => 'O campo numero não foi preenchido',
                'bairro.required' => 'O campo bairro não foi preenchido',
                'estado.required' => 'O campo estado não foi preenchido',
                'cidade.required' => 'O campo cidade não foi preenchido'
            ]
        );

        $dados = $request->all();
        $dados['numero'] = preg_replace("/[^0-9]/", "", $request->numero);
        $dados['cnpj'] = preg_replace("/[^0-9]/", "", $request->cnpj);

        session()->put('enterprise', $dados);
        return redirect()->route('enterprise.create.step.three');
    }

    public function createStepThree(Request $request)
    {
        if ($request->session()->exists('enterprise')) {
            return view('enterprise.create-step-three', ['sexos' => UserInfo::SEXOS]);
        } else {
            return redirect(route('enterprise.create.step.two'))->with('msg', 'É necessário efetuar todas etapas do cadastro!');
        }
    }

    public function postCreateStepThree(Request $request)
    {

        if ($request->password == $request->confirm_password) {

            if (!in_array($request->sexo, UserInfo::SEXOS)) {
                return redirect(route('login'))->with('msg', 'Verifique melhor o preenchimento do sexo do usuário.');
            }
    
            $request->validate(
                [
                    'cpf' => 'required',
                    'name' => 'required',
                    'email' => 'required',
                    'cargo' => 'required',
                    'data_nascimento' => 'required',
                    'sexo' => 'required',
                    'password' => 'required',
                ],

                [
                    'cpf.required' => 'O campo cpf não foi preenchido',
                    'name.required' => 'O campo nome não foi preenchido',
                    'email.required' => 'O campo email não foi preenchido',
                    'cargo.required' => 'O campo cargo não foi preenchido',
                    'data_nascimento.required' => 'O campo data de nascimento não foi preenchido',
                    'sexo.required' => 'O campo sexo não foi preenchido',
                    'password.required' => 'O campo senha não foi preenchido',

                ]
            );

            try {
                session()->put('user', $request->all());
                $data = session()->all();

                $data['cpf'] = preg_replace("/[^0-9]/", "", $request->cpf);
                $data['rg'] = preg_replace("/[^0-9]/", "", $request->rg);    

                $user = User::create([
                    'name' => $data['user']['name'],
                    'email' => $data['user']['email'],
                    'password' => bcrypt($data['user']['password']),
                    'cpf' => $data['user']['cpf'],
                    'cargo' => $data['user']['cargo'],
                    'data_nascimento' => $data['user']['data_nascimento'],
                    'sexo' => $data['user']['sexo'],
                ])->assignRole('user');

                UserInfo::create([
                    'user_id' => $user->id,
                    'cct' => $data['convention']['cct'],
                    'cnpj' => $data['enterprise']['cnpj'],
                    'razao_social' => $data['enterprise']['razao_social'],
                    'nome_fantasia' => $data['enterprise']['nome_fantasia'],
                    'atividade' => $data['enterprise']['atividade'],
                    'emails' => $data['enterprise']['emails'],
                    'cep' => $data['enterprise']['cep'],
                    'logradouro' => $data['enterprise']['logradouro'],
                    'numero' => $data['enterprise']['numero'],
                    'complemento' => $data['enterprise']['complemento'],
                    'bairro' => $data['enterprise']['bairro'],
                    'estado' => $data['enterprise']['estado'],
                    'cidade' => $data['enterprise']['cidade'],
                ]);

                $request->session()->remove('convention');
                $request->session()->remove('enterprise');
                $request->session()->remove('user');

                return redirect(route('login'))->with('msg', 'Você foi cadastrado com sucesso!');
            
            } catch (\Throwable $th) {
                dd($th);
                $request->session()->remove('convention');
                $request->session()->remove('enterprise');
                $request->session()->remove('user');
                return redirect(route('login'))->with('msg', 'Houve um erro inesperado.');
            }
        }
    }
}