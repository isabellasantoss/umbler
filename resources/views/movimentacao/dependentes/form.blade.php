@php
    
    use Illuminate\Support\Facades\Auth;
    
@endphp
@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])


@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Adicionar dependente'])
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
                                        <h3 class="mb-0">@lang('labels.cadastrar_dependentes')</h3>
                                    </div>
                                    <div class="col-12 text-right">
                                        {{-- <a href="{{ route('usuario.create') }}" class="btn btn-sm btn-primary">Adicionar usuário</a> --}}
                                    </div>
                                </div>
                            </div>

                            <form action="{{ route('dependentes.store') }}" method="post">
                                @csrf

                                <input id="user_id" name="user_id" type="hidden" value="{{ Auth::user()->id }}">

                                <div class="container">
                                    <div class="row mb-3">
                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="cpf">@lang('labels.cpf')</label>
                                                <input onkeydown="javascript: fMasc( this, mCPF );" type="text" required
                                                    name="cpf" maxlength="14" onkeydown="javascript: fMasc( this, mCPF );"
                                                    class="form-control" placeholder="@lang('labels.mask_cpf')" id="cpf"
                                                    aria-label="cpf">
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
                                                <input type="date" min="2000-12-31" required name="data_nascimento"
                                                    class="form-control" placeholder="@lang('labels.data_nascimento')"
                                                    id="data_nascimento" aria-label="name">
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
                                                <label for="rg">@lang('labels.rg')</label>
                                                <input type="text" required name="rg" class="form-control"
                                                    onkeypress="return apenasNumeros();" maxlength="15"
                                                    placeholder="@lang('labels.rg')" id="rg" maxlength="12" onkeyup="Rg(this.value, this.id)" aria-label="rg">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="funcionario_id">@lang('labels.funcionario')</label>
                                                <select name="funcionario_id" id="funcionario_id" class="form-control">
                                                    <option selected>@lang('labels.option-padrao')</option>
                                                    @foreach ($funcionarios as $funcionario)
                                                        <option value="{{ $funcionario->id }}">{{ $funcionario->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="tipo_dependente">@lang('labels.tipo_dependente')</label>
                                                <select name="tipo_dependente" id="tipo_dependente" class="form-control">
                                                    <option selected>@lang('labels.option-padrao')</option>
                                                    @foreach ($relacionamentos as $relacionamento)
                                                        <option value="{{ $relacionamento }}">{{ $relacionamento }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="celular">@lang('labels.celular')</label>
                                                <input type="text" required name="celular"
                                                    onkeypress="mask(this, mphone);" class="form-control form-control-lg"
                                                    placeholder="@lang('labels.celular')" id="celular" aria-label="celular">
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
                                                <label for="grau_titulo">@lang('labels.grau_titulo')</label>
                                                <select name="grau_titulo" id="grau_titulo" class="form-control">
                                                    <option selected>@lang('labels.option-padrao')</option>
                                                    @foreach ($grau_titulos as $titulo)
                                                        <option value="{{ $titulo }}">{{ $titulo }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="grau_status">@lang('labels.grau_status')</label>
                                                <select name="grau_status" id="grau_status" class="form-control">
                                                    <option selected>@lang('labels.option-padrao')</option>
                                                    @foreach ($grau_status as $status)
                                                        <option value="{{ $status }}">{{ $status }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        {{-- <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="send">@lang('labels.send')</label>
                                                <button type="submit" id="send"
                                                    class="btn btn-success form-control form-control-lg"><i
                                                        class="bi bi-sd-card"></i></button>
                                            </div>
                                        </div> --}}

                                        <div class="row mb-3 mt-4">
                                            <div class="col-1">
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
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
