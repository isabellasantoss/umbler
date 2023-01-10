@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])


@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Editar funcionário: ' . $funcionario->name])
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
                                        <h3 class="mb-0">{{ $funcionario->name }}</h3>
                                    </div>
                                    <div class="col-12 text-right">
                                        {{-- <a href="{{ route('usuario.create') }}" class="btn btn-sm btn-primary">Adicionar usuário</a> --}}
                                    </div>
                                </div>
                            </div>

                            <form action="{{ route('funcionarios.update', ['id' => base64_encode($funcionario->id)]) }}"
                                method="post">
                                @csrf
                                @method('PUT')
                                <div class="container">
                                    <div class="row mb-3">
                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="cpf">@lang('labels.cpf')</label>
                                                <input type="text" value="{{ $funcionario->cpf }}" required
                                                    name="cpf" maxlength="14" onkeydown="javascript: fMasc( this, mCPF );"
                                                    class="form-control" placeholder="@lang('labels.mask_cpf')" id="cpf"
                                                    aria-label="cpf">
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="matricula">@lang('labels.matricula_func')</label>
                                                <input type="text" value="{{ $funcionario->matricula }}"
                                                    onkeypress="return apenasNumeros();" required name="matricula"
                                                    class="form-control" placeholder="@lang('labels.matricula_func')" id="matricula"
                                                    aria-label="matricula">
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="name">@lang('labels.name')</label>
                                                <input type="text" value="{{ $funcionario->name }}" required
                                                    name="name" class="form-control" placeholder="@lang('labels.name')"
                                                    id="name" aria-label="name">
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="data_nascimento">@lang('labels.data_nascimento')</label>
                                                <input type="date" min="1950-12-31" max="2007-12-31"
                                                    value="{{ $funcionario->data_nascimento }}" required
                                                    name="data_nascimento" class="form-control"
                                                    placeholder="@lang('labels.data_nascimento')" id="data_nascimento" aria-label="name">
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="data_admissao">@lang('labels.data_admissao')</label>
                                                <input type="date" onchange="validacao_datas(this, 'data_nascimento')"
                                                    value="{{ $funcionario->data_admissao }}" required name="data_admissao"
                                                    class="form-control" placeholder="@lang('labels.mask_data')" id="data_admissao"
                                                    aria-label="name">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="nome_mae">@lang('labels.nome_mae')</label>
                                                <input type="text" value="{{ $funcionario->nome_mae }}" required
                                                    name="nome_mae" class="form-control" placeholder="@lang('labels.nome_mae')"
                                                    id="nome_mae" aria-label="name">
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="naturalidade">@lang('labels.naturalidade')</label>
                                                <input type="text" value="{{ $funcionario->naturalidade }}" required
                                                    name="naturalidade" class="form-control"
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
                                                        <option @if($funcionario->sexo == $sexo) selected @endif value="{{ $sexo }}">{{ $sexo }}</option>
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
                                                        <option  @if($funcionario->estado_civil == $estado_civil) selected @endif value="{{ $estado_civil }}">{{ $estado_civil }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="nacionalidade">@lang('labels.nacionalidade')</label>
                                                <input type="text" value="{{ $funcionario->nacionalidade }}" required
                                                    name="nacionalidade" class="form-control"
                                                    placeholder="@lang('labels.nacionalidade')" id="nacionalidade"
                                                    aria-label="nacionalidade">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="rg">@lang('labels.rg')</label>
                                                <input type="text" onkeypress="return apenasNumeros();" maxlength="15"
                                                    required name="rg" value="{{ $funcionario->rg }}"
                                                    class="form-control" placeholder="@lang('labels.rg')" id="rg" maxlength="12" onkeyup="Rg(this.value, this.id)"
                                                    aria-label="matricula">
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="data_emissao_rg">@lang('labels.data_emissao_rg')</label>
                                                <input type="date" onchange="validacao_datas(this, 'data_nascimento')"
                                                    required name="data_emissao_rg" class="form-control"
                                                    value="{{ $funcionario->data_emissao_rg }}"
                                                    placeholder="@lang('labels.data_emissao_rg')" id="data_emissao_rg"
                                                    aria-label="matricula">
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="orgao_emissor_rg">@lang('labels.orgao_emissor_rg')</label>
                                                <input type="text" style="text-transform: uppercase;" required
                                                    name="orgao_emissor_rg" placeholder="@lang('labels.orgao_emissor_rg')"
                                                    value="{{ $funcionario->orgao_emissor_rg }}" class="form-control"
                                                    id="orgao_emissor_rg" aria-label="matricula">
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="estado_emissor_rg">@lang('labels.estado_emissor_rg')</label>
                                                <select name="estado_emissor_rg" id="estado_emissor_rg"
                                                    class="form-control">
                                                    <option selected>@lang('labels.option-padrao')</option>
                                                    <option @if ($funcionario->estado_emissor_rg == 'AC') selected @endif
                                                        value="AC">Acre</option>
                                                    <option @if ($funcionario->estado_emissor_rg == 'AL') selected @endif
                                                        value="AL">Alagoas</option>
                                                    <option @if ($funcionario->estado_emissor_rg == 'AP') selected @endif
                                                        value="AP">Amapá</option>
                                                    <option @if ($funcionario->estado_emissor_rg == 'AM') selected @endif
                                                        value="AM">Amazonas</option>
                                                    <option @if ($funcionario->estado_emissor_rg == 'BA') selected @endif
                                                        value="BA">Bahia</option>
                                                    <option @if ($funcionario->estado_emissor_rg == 'CE') selected @endif
                                                        value="CE">Ceará</option>
                                                    <option @if ($funcionario->estado_emissor_rg == 'DF') selected @endif
                                                        value="DF">Distrito Federal</option>
                                                    <option @if ($funcionario->estado_emissor_rg == 'ES') selected @endif
                                                        value="ES">Espírito Santo</option>
                                                    <option @if ($funcionario->estado_emissor_rg == 'GO') selected @endif
                                                        value="GO">Goiás</option>
                                                    <option @if ($funcionario->estado_emissor_rg == 'MA') selected @endif
                                                        value="MA">Maranhão</option>
                                                    <option @if ($funcionario->estado_emissor_rg == 'MT') selected @endif
                                                        value="MT">Mato Grosso</option>
                                                    <option @if ($funcionario->estado_emissor_rg == 'MS') selected @endif
                                                        value="MS">Mato Grosso do Sul</option>
                                                    <option @if ($funcionario->estado_emissor_rg == 'MG') selected @endif
                                                        value="MG">Minas Gerais</option>
                                                    <option @if ($funcionario->estado_emissor_rg == 'PA') selected @endif
                                                        value="PA">Pará</option>
                                                    <option @if ($funcionario->estado_emissor_rg == 'PB') selected @endif
                                                        value="PB">Paraíba</option>
                                                    <option @if ($funcionario->estado_emissor_rg == 'PR') selected @endif
                                                        value="PR">Paraná</option>
                                                    <option @if ($funcionario->estado_emissor_rg == 'PE') selected @endif
                                                        value="PE">Pernambuco</option>
                                                    <option @if ($funcionario->estado_emissor_rg == 'PI') selected @endif
                                                        value="PI">Piauí</option>
                                                    <option @if ($funcionario->estado_emissor_rg == 'RJ') selected @endif
                                                        value="RJ">Rio de Janeiro</option>
                                                    <option @if ($funcionario->estado_emissor_rg == 'RN') selected @endif
                                                        value="RN">Rio Grande do Norte</option>
                                                    <option @if ($funcionario->estado_emissor_rg == 'RS') selected @endif
                                                        value="RS">Rio Grande do Sul</option>
                                                    <option @if ($funcionario->estado_emissor_rg == 'RO') selected @endif
                                                        value="RO">Rondônia</option>
                                                    <option @if ($funcionario->estado_emissor_rg == 'RR') selected @endif
                                                        value="RR">Roraima</option>
                                                    <option @if ($funcionario->estado_emissor_rg == 'SC') selected @endif
                                                        value="SC">Santa Catarina</option>
                                                    <option @if ($funcionario->estado_emissor_rg == 'SP') selected @endif
                                                        value="SP">São Paulo</option>
                                                    <option @if ($funcionario->estado_emissor_rg == 'SE') selected @endif
                                                        value="SE">Sergipe</option>
                                                    <option @if ($funcionario->estado_emissor_rg == 'TO') selected @endif
                                                        value="TO">Tocantins</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="data_casamento">@lang('labels.data_casamento')</label>
                                                <input type="date" onchange="validacao_datas(this, 'data_nascimento')"
                                                    value="{{ $funcionario->data_casamento }}" name="data_casamento"
                                                    class="form-control" placeholder="@lang('labels.data_casamento')"
                                                    id="data_casamento" aria-label="data_casamento">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="cep">@lang('labels.cep')</label>
                                                <input type="text" value="{{ $funcionario->cep }}" required
                                                    name="cep" onkeyup="ViaCep('cep')" id="cep"
                                                    onkeypress="return apenasNumeros();" maxlength="8"
                                                    class="form-control form-control-lg" placeholder="CEP"
                                                    aria-label="cep">
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="logradouro">@lang('labels.logradouro')</label>
                                                <input type="text" value="{{ $funcionario->logradouro }}" required
                                                    name="logradouro" id="logradouro"
                                                    class="form-control form-control-lg" placeholder="Logradouro"
                                                    aria-label="logradouro">
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="numero">@lang('labels.numero')</label>
                                                <input type="text" value="{{ $funcionario->numero }}"
                                                    onkeypress="return apenasNumeros();" required id="numero"
                                                    name="numero" class="form-control form-control-lg"
                                                    placeholder="@lang('labels.numero')" aria-label="numero">
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="complemento">@lang('labels.complemento')</label>
                                                <input type="text" value="{{ $funcionario->complemento }}"
                                                    name="complemento" class="form-control form-control-lg"
                                                    placeholder="@lang('labels.complemento')" aria-label="complemento">
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="bairro">@lang('labels.bairro')</label>
                                                <input type="text" value="{{ $funcionario->bairro }}" required
                                                    name="bairro" class="form-control form-control-lg"
                                                    placeholder="@lang('labels.bairro')" id="bairro" aria-label="bairro">
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="estado">@lang('labels.estado')</label>
                                                <input type="text" value="{{ $funcionario->estado }}" required
                                                    name="estado" class="form-control form-control-lg"
                                                    placeholder="@lang('labels.estado')" id="estado" aria-label="estado">
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="cidade">@lang('labels.cidade')</label>
                                                <input type="text" value="{{ $funcionario->cidade }}" required
                                                    name="cidade" class="form-control form-control-lg"
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
                                                        <option @if ($funcionario->empresa_id == $empresa->id) selected @endif
                                                            value="{{ $empresa->id }}">{{ $empresa->nome_fantasia }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="telefone">@lang('labels.telefone')</label>
                                                <input type="text" value="{{ $funcionario->telefone }}"
                                                    name="telefone" onkeypress="mask(this, mphone);"
                                                    class="form-control form-control-lg" placeholder="@lang('labels.telefone')"
                                                    id="telefone" aria-label="telefone">
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="celular">@lang('labels.celular')</label>
                                                <input type="text" required name="celular"
                                                    onkeypress="mask(this, mphone);" value="{{ $funcionario->celular }}"
                                                    class="form-control form-control-lg" placeholder="@lang('labels.celular')"
                                                    id="celular" aria-label="celular">
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="email">@lang('labels.email')</label>
                                                <input type="text" value="{{ $funcionario->email }}" required
                                                    name="email" class="form-control form-control-lg"
                                                    placeholder="@lang('labels.email')" id="email" aria-label="email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3 mt-4">
                                        <div class="col-2">
                                            <div class="flex flex-col">
                                                <button type="submit" id="send"
                                                    class="btn btn-success form-control">@lang('labels.edit')</button>
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
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
