@php
    
    use Illuminate\Support\Facades\Auth;
    
@endphp
@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])


@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Adicionar funcionário'])
    <div class="main-panel">
        <div class="content">
            <div class="container-fluid mt--7">
                <div class="row">
                    <div class="col">
                        <div class="card shadow">
                            <div class="card-header border-0">
                                <!--FORM VALIDATE-->
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h3 class="mb-0">@lang('labels.cadastrar_funcionario')</h3>
                                    </div>
                                    <div class="col-12 text-right">
                                        {{-- <a href="{{ route('usuario.create') }}" class="btn btn-sm btn-primary">Adicionar usuário</a> --}}
                                    </div>
                                </div>
                            </div>

                            <form action="{{ route('funcionarios.store') }}" method="post">
                                @csrf
                                <input id="user_id" name="user_id" type="hidden" value="{{ Auth::user()->id }}">
                                @php
                                    
                                @endphp
                                <input id="numero_cartao" name="numero_cartao" type="hidden" value="{{ Auth::user()->id }}">
                                <div class="container">
                                    <div class="row mb-3">
                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="cpf">@lang('labels.cpf')</label>
                                                <input type="text" required name="cpf" maxlength="14"
                                                    onkeydown="javascript: fMasc( this, mCPF );" class="form-control"
                                                    placeholder="@lang('labels.mask_cpf')" id="cpf" aria-label="cpf">
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="matricula">@lang('labels.matricula_func')</label>
                                                <input type="text" onkeypress="return apenasNumeros();" required
                                                    name="matricula" class="form-control" placeholder="@lang('labels.matricula_func')"
                                                    id="matricula" aria-label="matricula">
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="name">@lang('labels.name')</label>
                                                <input type="text" required name="name" class="form-control"
                                                    placeholder="@lang('labels.name')" id="name" aria-label="name">
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="data_nascimento">@lang('labels.data_nascimento')</label>
                                                <input type="date" min="1950-12-31" max="2007-12-31" required
                                                    name="data_nascimento" class="form-control"
                                                    placeholder="@lang('labels.data_nascimento')" id="data_nascimento" aria-label="name">
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="data_admissao">@lang('labels.data_admissao')</label>
                                                <input onchange="validacao_datas(this, 'data_nascimento')" type="date"
                                                    required name="data_admissao" class="form-control"
                                                    placeholder="@lang('labels.mask_data')" id="data_admissao" aria-label="name">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="nome_mae">@lang('labels.nome_mae')</label>
                                                <input type="text" required name="nome_mae" class="form-control"
                                                    placeholder="@lang('labels.nome_mae')" id="nome_mae" aria-label="name">
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="naturalidade">@lang('labels.naturalidade')</label>
                                                <input type="text" required name="naturalidade" class="form-control"
                                                    placeholder="@lang('labels.naturalidade')" id="naturalidade"
                                                    aria-label="matricula">
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="sexo">@lang('labels.sexo')</label>
                                                <select name="sexo" id="sexo" class="form-control">
                                                    <option selected>@lang('labels.option-padrao')</option>
                                                    @foreach ($sexos as $sexo)
                                                        <option value="{{ $sexo }}">{{ $sexo }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="estado_civil">@lang('labels.estado_civil')</label>
                                                <select name="estado_civil" onchange="dataCasamento()" id="estado_civil"
                                                    class="form-control">
                                                    <option selected>@lang('labels.option-padrao')</option>
                                                    @foreach ($estados_civis as $estado_civil)
                                                        <option value="{{ $estado_civil }}">{{ $estado_civil }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="nacionalidade">@lang('labels.nacionalidade')</label>
                                                <input type="text" required name="nacionalidade" class="form-control"
                                                    placeholder="@lang('labels.nacionalidade')" id="nacionalidade"
                                                    aria-label="matricula">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="rg">@lang('labels.rg')</label>
                                                <input type="text" onkeypress="return apenasNumeros();" maxlength="15"
                                                    required name="rg" class="form-control"
                                                    placeholder="@lang('labels.rg')" id="rg" maxlength="12" onkeyup="Rg(this.value, this.id)"
                                                    aria-label="matricula">
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="data_emissao_rg">@lang('labels.data_emissao_rg')</label>
                                                <input type="date" onchange="validacao_datas(this, 'data_nascimento')"
                                                    required name="data_emissao_rg" class="form-control"
                                                    placeholder="@lang('labels.data_emissao_rg')" id="data_emissao_rg"
                                                    aria-label="matricula">
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="orgao_emissor_rg">@lang('labels.orgao_emissor_rg')</label>
                                                <input type="text" style="text-transform: uppercase;" required
                                                    name="orgao_emissor_rg" placeholder="@lang('labels.orgao_emissor_rg')"
                                                    class="form-control" id="orgao_emissor_rg" aria-label="matricula">
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="estado_emissor_rg">@lang('labels.estado_emissor_rg')</label>
                                                <select name="estado_emissor_rg" id="estado_emissor_rg"
                                                    class="form-control">
                                                    <option selected>@lang('labels.option-padrao')</option>
                                                    <option value="AC">Acre</option>
                                                    <option value="AL">Alagoas</option>
                                                    <option value="AP">Amapá</option>
                                                    <option value="AM">Amazonas</option>
                                                    <option value="BA">Bahia</option>
                                                    <option value="CE">Ceará</option>
                                                    <option value="DF">Distrito Federal</option>
                                                    <option value="ES">Espírito Santo</option>
                                                    <option value="GO">Goiás</option>
                                                    <option value="MA">Maranhão</option>
                                                    <option value="MT">Mato Grosso</option>
                                                    <option value="MS">Mato Grosso do Sul</option>
                                                    <option value="MG">Minas Gerais</option>
                                                    <option value="PA">Pará</option>
                                                    <option value="PB">Paraíba</option>
                                                    <option value="PR">Paraná</option>
                                                    <option value="PE">Pernambuco</option>
                                                    <option value="PI">Piauí</option>
                                                    <option value="RJ">Rio de Janeiro</option>
                                                    <option value="RN">Rio Grande do Norte</option>
                                                    <option value="RS">Rio Grande do Sul</option>
                                                    <option value="RO">Rondônia</option>
                                                    <option value="RR">Roraima</option>
                                                    <option value="SC">Santa Catarina</option>
                                                    <option value="SP">São Paulo</option>
                                                    <option value="SE">Sergipe</option>
                                                    <option value="TO">Tocantins</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="data_casamento">@lang('labels.data_casamento')</label>
                                                <input type="date" onchange="validacao_datas(this, 'data_nascimento')"
                                                    name="data_casamento" class="form-control"
                                                    placeholder="@lang('labels.data_casamento')" id="data_casamento"
                                                    aria-label="data_casamento">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="cep">@lang('labels.cep')</label>
                                                <input type="text" required name="cep" onkeyup="ViaCep('cep')"
                                                    id="cep" onkeypress="return apenasNumeros();" maxlength="8"
                                                    class="form-control" placeholder="CEP" aria-label="cep">
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="logradouro">@lang('labels.logradouro')</label>
                                                <input type="text" required name="logradouro" id="logradouro"
                                                    class="form-control" placeholder="Logradouro"
                                                    aria-label="logradouro">
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="numero">@lang('labels.numero')</label>
                                                <input type="text" required onkeypress="return apenasNumeros();"
                                                    id="numero" name="numero" class="form-control"
                                                    placeholder="@lang('labels.numero')" aria-label="numero">
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="complemento">@lang('labels.complemento')</label>
                                                <input type="text" name="complemento" class="form-control"
                                                    placeholder="@lang('labels.complemento')" aria-label="complemento">
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="bairro">@lang('labels.bairro')</label>
                                                <input type="text" required name="bairro" class="form-control"
                                                    placeholder="@lang('labels.bairro')" id="bairro" aria-label="bairro">
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="estado">@lang('labels.estado')</label>
                                                <input type="text" required name="estado" class="form-control"
                                                    placeholder="@lang('labels.estado')" id="estado" aria-label="estado">
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="cidade">@lang('labels.cidade')</label>
                                                <input type="text" required name="cidade" class="form-control"
                                                    placeholder="@lang('labels.cidade')" id="cidade" aria-label="cidade">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="empresa_id">@lang('labels.empresa')</label>
                                                <select name="empresa_id" id="empresa_id" class="form-control">
                                                    <option selected>@lang('labels.option-padrao')</option>
                                                    @foreach ($empresas as $empresa)
                                                        <option value="{{ $empresa->id }}">{{ $empresa->nome_fantasia }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="telefone">@lang('labels.telefone')</label>
                                                <input type="text" name="telefone" onkeypress="mask(this, mphone);"
                                                    class="form-control" placeholder="@lang('labels.telefone')" id="telefone"
                                                    aria-label="telefone">
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="celular">@lang('labels.celular')</label>
                                                <input type="text" required name="celular"
                                                    onkeypress="mask(this, mphone);" class="form-control"
                                                    placeholder="@lang('labels.celular')" id="celular" aria-label="celular">
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="email">@lang('labels.email')</label>
                                                <input type="text" required name="email" class="form-control"
                                                    placeholder="@lang('labels.email')" id="email" aria-label="email">
                                            </div>
                                        </div>

                                        <div class="row mb-3 mt-4">
                                            <div class="col-2">
                                                <div class="flex flex-col">
                                                    <button type="submit" id="send"
                                                        class="btn btn-success form-control">@lang('labels.send')</button>
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <div class="flex flex-col">
                                                    <a href="{{ url()->previous() }}"><button type="button"
                                                            class="btn btn-warning form-control">@lang('labels.back')</button></a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                </div>

                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="/js/mask/dataCasamento.js"></script>
    @endsection
