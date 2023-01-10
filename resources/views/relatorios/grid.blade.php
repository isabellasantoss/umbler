@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Funcionários'])
    <div class="main-panel">
        <div class="content">
            <div class="container-fluid mt--7">
                <div class="row">
                    <div class="col">
                        <div class="card shadow">
                            <div class="card-header border-0">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        @if (session('msg'))
                                            <div class="alert alert-info" role="alert">
                                                {{ session('msg') }}
                                            </div>
                                        @endif
                                        <h3 class="mb-0">@lang('labels.relatorios')</h3>
                                    </div>

                                </div>
                            </div>
                            @can('visualizar-relatorios')

                            <div class="col-12">
                            </div>
                            <div class="container " style="margin-block: 40px;">
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="card">
                                            <div class="card-body p-3">
                                                <div class="row">
                                                    <div class="col-8">
                                                        <div class="numbers">
                                                            <p class="text-sm mb-0 text-uppercase font-weight-bold">
                                                                @lang('labels.funcionarios')</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-4 text-end">
                                                        <div
                                                            class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                                            <a href="{{route('funcionarios.export')}}"><i class="fa fa-download text-lg opacity-10"
                                                                aria-hidden="true"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="card">
                                            <div class="card-body p-3">
                                                <div class="row">
                                                    <div class="col-8">
                                                        <div class="numbers">
                                                            <p class="text-sm mb-0 text-uppercase font-weight-bold">
                                                                @lang('labels.filiais')</p>
                                                        </div>
                                                    </div>

                                                    <div class="col-4 text-end">
                                                        <div
                                                            class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                                            <a href="{{route('empresas.export')}}"><i class="fa fa-download text-lg opacity-10"
                                                                aria-hidden="true"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="card">
                                            <div class="card-body p-3">
                                                <div class="row">
                                                    <div class="col-8">
                                                        <div class="numbers">
                                                            <p class="text-sm mb-0 text-uppercase font-weight-bold">@lang('labels.boletos')
                                                            </p>

                                                        </div>
                                                    </div>
                                                    <div class="col-4 text-end">
                                                        <div
                                                            class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                                            <a href=""><i class="fa fa-download text-lg opacity-10"
                                                                aria-hidden="true"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container " style="margin-block: 40px;">
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="card">
                                            <div class="card-body p-3">
                                                <div class="row">
                                                    <div class="col-8">
                                                        <div class="numbers">
                                                            <p class="text-sm mb-0 text-uppercase font-weight-bold">
                                                                @lang('labels.demonstrativos')</p>
                                                        </div>
                                                    </div>

                                                    <div class="col-4 text-end">
                                                        <div
                                                            class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                                            <a href="{{route('log.funcionarios.index')}}"><i class="fa fa-user text-lg opacity-10"
                                                                aria-hidden="true"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="card">
                                            <div class="card-body p-3">
                                                <div class="row">
                                                    <div class="col-8">
                                                        <div class="numbers">
                                                            <p class="text-sm mb-0 text-uppercase font-weight-bold">@lang('labels.cartao')
                                                            </p>

                                                        </div>
                                                    </div>
                                                    <div class="col-4 text-end">
                                                        <div
                                                            class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                                            <a href=""><i class="fa fa-download text-lg opacity-10"
                                                                aria-hidden="true"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endcan
                            
                            @can('visualizar-relatorios-admin')
                            <div class="container " style="margin-block: 40px;">
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="card">
                                            <div class="card-body p-3">
                                                <div class="row">
                                                    <div class="col-8">
                                                        <div class="numbers">
                                                            <p class="text-sm mb-0 text-uppercase font-weight-bold">
                                                                @lang('labels.convencoes')</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-4 text-end">
                                                        <div
                                                            class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                                            <a href="{{route('convencoes.export')}}"><i class="fa fa-download text-lg opacity-10"
                                                                aria-hidden="true"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="card">
                                            <div class="card-body p-3">
                                                <div class="row">
                                                    <div class="col-8">
                                                        <div class="numbers">
                                                            <p class="text-sm mb-0 text-uppercase font-weight-bold">
                                                                @lang('labels.demonstrativos')</p>
                                                        </div>
                                                    </div>

                                                    <div class="col-4 text-end">
                                                        <div
                                                            class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                                            <a href="{{route('log.funcionarios.index')}}"><i class="fa fa-user text-lg opacity-10"
                                                                aria-hidden="true"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="card">
                                            <div class="card-body p-3">
                                                <div class="row">
                                                    <div class="col-8">
                                                        <div class="numbers">
                                                            <p class="text-sm mb-0 text-uppercase font-weight-bold">@lang('labels.cartao')
                                                            </p>

                                                        </div>
                                                    </div>
                                                    <div class="col-4 text-end">
                                                        <div
                                                            class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                                            <a href=""><i class="fa fa-download text-lg opacity-10"
                                                                aria-hidden="true"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
