@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])


@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Conveção'])
    <div class="main-panel">
        <div class="content">
            <div class="container-fluid mt--7">
                <div class="row">
                    <div class="col">
                        <div class="card shadow">
                            <div class="card-header border-0">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h3 class="mb-0">{{ $convencoes }}</h3>
                                    </div>
                                    <div class="col-12 text-right">
                                        {{-- <a href="{{ route('usuario.create') }}" class="btn btn-sm btn-primary">Adicionar usuário</a> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="container">
                                <div class="row mb-3">
                                    <div class="col-sm">
                                        <div class="flex flex-col">
                                            <label for="cpf">@lang('labels.cpf')</label>
                                            <input type="text" readonly value="{{ $convencoes->cct }}" required name="cpf"
                                                maxlength="14" onkeydown="javascript: fMasc( this, mCPF );" class="form-control"
                                                placeholder="@lang('labels.mask_cpf')" id="cpf" aria-label="cpf">
                                        </div>
                                    </div>

                                    <div class="col-sm">
                                        <div class="flex flex-col">
                                            <label for="matricula">@lang('labels.matricula_func')</label>
                                            <input type="text" readonly value="{{ $convencoes->sind_patronal }}"
                                                onkeypress="return apenasNumeros();" required name="matricula"
                                                class="form-control" placeholder="@lang('labels.matricula_func')"
                                                id="matricula" aria-label="matricula">
                                        </div>
                                    </div>

                                    <div class="col-sm">
                                        <div class="flex flex-col">
                                            <label for="name">@lang('labels.name')</label>
                                            <input type="text" readonly value="{{ $convencoes->sind_laboral }}" required
                                                name="name" class="form-control" placeholder="@lang('labels.name')"
                                                id="name" aria-label="name">
                                        </div>
                                    </div>

                                    <div class="col-sm">
                                        <div class="flex flex-col">
                                            <label for="data_admissao">@lang('labels.data_admissao')</label>
                                            <input type="date" readonly value="{{ $convencoes->abrang }}" required
                                                name="data_admissao" class="form-control"
                                                placeholder="@lang('labels.mask_data')" id="data_admissao"
                                                aria-label="name">
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection