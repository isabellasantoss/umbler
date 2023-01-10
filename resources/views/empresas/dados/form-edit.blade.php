@php
    
    use Illuminate\Support\Facades\Auth;
    
@endphp
@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@include('layouts.navbars.auth.topnav', ['title' => 'Filial'])


@section('content')
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
                                        <h3 class="mb-0">@lang('labels.editar_filial')</b></h3>
                                    </div>
                                    <div class="col-12 text-right">
                                        {{-- <a href="{{ route('usuario.create') }}" class="btn btn-sm btn-primary">Adicionar usuário</a> --}}
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('empresas.update', ['id' => base64_encode($userinfos->id)]) }}"
                                method="post">
                                @csrf
                                @method('PUT')
                                <div class="container">
                                    <div class="row mb-3 mt-2">
                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="cnpj">@lang('labels.cnpj')</label>
                                                <input readonly type="text" value="{{ $userinfos->cnpj }}" required
                                                    name="cnpj" maxlength="11" onkeypress="return apenasNumeros();"
                                                    class="form-control" placeholder="@lang('labels.mask_cnpj')" id="cnpj"
                                                    aria-label="cnpj">
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="razao_social">@lang('labels.razao_social')</label>
                                                <input readonly type="text" value="{{ $userinfos->razao_social }}"
                                                    required name="razao_social" class="form-control"
                                                    placeholder="@lang('labels.razao_social')" id="razao_social"
                                                    aria-label="razao_social">
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="cct">@lang('labels.CCT')</label>
                                                <select name="cct" id="cct" class="form-control">
                                                    @foreach ($ccts as $cct)
                                                        <option @if ($userinfos->cct == $cct->id) selected @endif
                                                            value="{{ $cct->id }}">{{ $cct->cct }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="nome">@lang('labels.nome_fantasia')</label>
                                                <input type="text" value="{{ $userinfos->nome_fantasia }}" required
                                                    name="nome_fantasia" class="form-control"
                                                    placeholder="@lang('labels.nome_fantasia')" id="nome_fantasia"
                                                    aria-label="nome_fantasia">
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="atividade">@lang('labels.ramo_atividade')</label>
                                                <input readonly type="text" value="{{ $userinfos->atividade }}" required
                                                    name="atividade" class="form-control" placeholder="@lang('labels.ramo_atividade')"
                                                    id="atividade" aria-label="name">
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="emails">@lang('labels.emails')</label>
                                                <input type="email" value="{{ $userinfos->emails }}" required
                                                    name="emails" class="form-control" placeholder="@lang('labels.emails')"
                                                    id="emails" aria-label="name">
                                            </div>
                                        </div>
                                    </div>
                                    <br>

                                    <h4>@lang('labels.endereco')</h4>
                                    <div class="row mb-3">
                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="cep">@lang('labels.cep')</label>
                                                <input type="text" value="{{ $userinfos->cep }}" required name="cep"
                                                    onkeyup="ViaCep('cep')" id="cep"
                                                    onkeypress="return apenasNumeros();" maxlength="8"
                                                    class="form-control form-control-lg" placeholder="CEP" aria-label="cep">
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="logradouro">@lang('labels.logradouro')</label>
                                                <input type="text" value="{{ $userinfos->logradouro }}" required
                                                    name="logradouro" id="logradouro" class="form-control form-control-lg"
                                                    placeholder="Logradouro" aria-label="logradouro">
                                            </div>


                                        </div>
                                        <div class="row mb-3 mt-2">
                                            <div class="col-sm">
                                                <div class="flex flex-col">
                                                    <label for="numero">@lang('labels.numero')</label>
                                                    <input type="text" value="{{ $userinfos->numero }}" required
                                                        name="numero" id="numero"
                                                        onkeypress="return apenasNumeros();"
                                                        class="form-control form-control-lg" placeholder="numero"
                                                        aria-label="numero">
                                                </div>
                                            </div>
                                            <div class="col-sm">
                                                <div class="flex flex-col">
                                                    <label for="complemento">@lang('labels.complemento')</label>
                                                    <input type="text" value="{{ $userinfos->complemento }}"
                                                        name="complemento" class="form-control form-control-lg"
                                                        placeholder="@lang('labels.complemento')" aria-label="complemento">
                                                </div>
                                            </div>

                                            <div class="col-sm">
                                                <div class="flex flex-col">
                                                    <label for="bairro">@lang('labels.bairro')</label>
                                                    <input type="text" value="{{ $userinfos->bairro }}" required
                                                        name="bairro" class="form-control form-control-lg"
                                                        placeholder="@lang('labels.bairro')" id="bairro" aria-label="bairro">
                                                </div>
                                            </div>

                                            <div class="col-sm">
                                                <div class="flex flex-col">
                                                    <label for="estado">@lang('labels.estado')</label>
                                                    <input type="text" value="{{ $userinfos->estado }}" required
                                                        name="estado" class="form-control form-control-lg"
                                                        placeholder="@lang('labels.estado')" id="estado" aria-label="estado">
                                                </div>
                                            </div>

                                            <div class="col-sm">
                                                <div class="flex flex-col">
                                                    <label for="cidade">@lang('labels.cidade')</label>
                                                    <input type="text" value="{{ $userinfos->cidade }}" required
                                                        name="cidade" class="form-control form-control-lg"
                                                        placeholder="@lang('labels.cidade')" id="cidade" aria-label="cidade">
                                                </div>
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

                            </form>
                        </div>
                    </div>
