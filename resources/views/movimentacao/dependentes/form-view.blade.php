@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])


@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => $dependente->name])
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
                                        <h3 class="mb-0">{{ $dependente->name }}</h3>
                                    </div>
                                    <div class="col-12 text-right">
                                        {{-- <a href="{{ route('usuario.create') }}" class="btn btn-sm btn-primary">Adicionar usuário</a> --}}
                                    </div>
                                </div>
                            </div>

                            <form action="" method="post">
                                @csrf
                                <input id="user_id" name="user_id" type="hidden" value="{{ Auth::user()->id }}">
                                <div class="container">
                                    <div class="row mb-3">
                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="cpf">@lang('labels.cpf')</label>
                                                <input readonly type="text" value="{{ $dependente->cpf }}" required
                                                    name="cpf" maxlength="14" onkeydown="javascript: fMasc( this, mCPF );"
                                                    class="form-control" placeholder="@lang('labels.mask_cpf')" id="cpf"
                                                    aria-label="cpf">
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="name">@lang('labels.name')</label>
                                                <input readonly type="text" value="{{ $dependente->name }}" required
                                                    name="name" class="form-control" placeholder="@lang('labels.name')"
                                                    id="name" aria-label="name">
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="data_nascimento">@lang('labels.data_nascimento')</label>
                                                <input readonly type="date" value="{{ $dependente->data_nascimento }}"
                                                    required name="data_nascimento" class="form-control"
                                                    placeholder="@lang('labels.data_nascimento')" id="data_nascimento" aria-label="name">
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="sexo">@lang('labels.sexo')</label>
                                                <select disabled name="sexo" id="sexo" class="form-control">
                                                    <option selected>@lang('labels.option-padrao')</option>
                                                    <option @if ($dependente->sexo == 'Masculino') selected @endif
                                                        value="Masculino">Masculino</option>
                                                    <option @if ($dependente->sexo == 'Feminino') selected @endif
                                                        value="Feminino">Feminino</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="rg">@lang('labels.rg')</label>
                                                <input readonly type="text" value="{{ $dependente->rg }}" required
                                                    name="rg" onkeypress="return apenasNumeros();" class="form-control"
                                                    placeholder="@lang('labels.rg')" id="rg" maxlength="12" onkeyup="Rg(this.value, this.id)" aria-label="rg">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">

                                        <div class="row mb-3">

                                            <div class="col-sm">
                                                <div class="flex flex-col">
                                                    <label for="funcionario_id">@lang('labels.funcionario')</label>
                                                    <select disabled name="funcionario_id" id="funcionario_id"
                                                        class="form-control">
                                                        <option selected>@lang('labels.option-padrao')</option>
                                                        @foreach ($funcionarios as $funcionario)
                                                            <option @if ($dependente->funcionario_id == $funcionario->id) selected @endif
                                                                value="{{ $funcionario->id }}">{{ $funcionario->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm">
                                                <div class="flex flex-col">
                                                    <label for="tipo_dependente">@lang('labels.tipo_dependente')</label>
                                                    <select disabled name="tipo_dependente" id="tipo_dependente"
                                                        class="form-control">
                                                        <option selected>@lang('labels.option-padrao')</option>
                                                        <option @if ($dependente->tipo_dependente == 'Filho') selected @endif
                                                            value="Filho">Filho</option>
                                                        <option @if ($dependente->tipo_dependente == 'Pai') selected @endif
                                                            value="Pai">Pai</option>
                                                        <option @if ($dependente->tipo_dependente == 'Mãe') selected @endif
                                                            value="Mãe">Mãe</option>
                                                        <option @if ($dependente->tipo_dependente == 'Irmão') selected @endif
                                                            value="Irmão">Irmão</option>
                                                        <option @if ($dependente->tipo_dependente == 'Cônjuge') selected @endif
                                                            value="Cônjuge">Cônjuge</option>
                                                        <option @if ($dependente->tipo_dependente == 'Outro') selected @endif
                                                            value="Outro">Outro</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm">
                                                <div class="flex flex-col">
                                                    <label for="celular">@lang('labels.celular')</label>
                                                    <input readonly type="text" value="{{ $dependente->celular }}"
                                                        required name="celular" onkeypress="mask(this, mphone);"
                                                        class="form-control form-control-lg"
                                                        placeholder="@lang('labels.celular')" id="celular"
                                                        aria-label="celular">
                                                </div>
                                            </div>

                                            <div class="col-sm mt-1">
                                                <div class="flex flex-col">
                                                    <label for="escolaridade">@lang('labels.escolaridade')</label>
                                                    <select disabled name="escolaridade" id="escolaridade"
                                                        class="form-control">
                                                        <option selected>@lang('labels.option-padrao')</option>
                                                        <option @if ($dependente->escolaridade == 'Ensino fundamental incompleto') selected @endif
                                                            value="Ensino fundamental incompleto">Ensino fundamental
                                                            incompleto</option>
                                                        <option @if ($dependente->escolaridade == 'Ensino fundamental completo') selected @endif
                                                            value="Ensino fundamental completo">Ensino fundamental completo
                                                        </option>
                                                        <option @if ($dependente->escolaridade == 'Ensino médio incompleto') selected @endif
                                                            value="Ensino médio incompleto">Ensino médio incompleto
                                                        </option>
                                                        <option @if ($dependente->escolaridade == 'Ensino médio completo') selected @endif
                                                            value="Ensino médio completo">Ensino médio completo</option>
                                                        <option @if ($dependente->escolaridade == 'Ensino superior incompleto') selected @endif
                                                            value="Ensino superior incompleto">Ensino superior incompleto
                                                        </option>
                                                        <option @if ($dependente->escolaridade == 'Ensino superior completo') selected @endif
                                                            value="Ensino superior completo">Ensino superior completo
                                                        </option>
                                                    </select>
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
