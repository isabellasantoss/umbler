@php
    
    use Illuminate\Support\Facades\Auth;
    
@endphp
@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])


@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Visualizar convenção'])
    <div class="main-panel">
        <div class="content">
            <div class="container-fluid mt--7">
                <div class="row">
                    <div class="col">
                        <div class="card shadow">
                            <div class="card-header border-0">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h3 class="mb-0">@lang('labels.convencoes_visualizar')</h3>
                                    </div>
                                    <div class="col-12 text-right">
                                        {{-- <a href="{{ route('usuario.create') }}" class="btn btn-sm btn-primary">Adicionar usuário</a> --}}
                                    </div>
                                </div>
                            </div>

                            <form action="{{ route('convencoes.store') }}" method="post">
                                @csrf
                                <input id="user_id" name="user_id" type="hidden" value="{{ Auth::user()->id }}">
                                <div class="container">
                                    <div class="row mb-3">
                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="celular">@lang('labels.CCT')</label>
                                                <input readonly type="text" name="cct" class="form-control form-control-lg"
                                                placeholder="@lang('labels.CCT')" value="{{ $convencoes->cct }}" id="cct"
                                                required aria-label="cct">
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="celular">@lang('labels.sind_patronal')</label>
                                                <input readonly type="text" name="sind_patronal" class="form-control form-control-lg"
                                                    placeholder="@lang('labels.sind_patronal')" value="{{ $convencoes->cct }}" id="sind_patronal"
                                                    required aria-label="sind_patronal">
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="celular">@lang('labels.sind_laboral')</label>
                                                <input  readonly type="text" value="{{ $convencoes->sind_laboral }}" name="sind_laboral" class="form-control form-control-lg"
                                                    placeholder="@lang('labels.sind_laboral')" id="sind_laboral"
                                                    required aria-label="sind_laboral">
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="celular">@lang('labels.abrangencia')</label>
                                                <input readonly type="text" value="{{ $convencoes->abrang }}" name="abrang" class="form-control form-control-lg"
                                                    placeholder="@lang('labels.abrangencia')" id="abrang"
                                                    required aria-label="abrang">
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
