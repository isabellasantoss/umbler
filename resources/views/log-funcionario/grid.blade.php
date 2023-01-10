@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Log de funcionários'])
    <div class="main-panel">
        <div class="content">
            <div class="container-fluid mt--7">
                <div class="row">
                    <div class="col">
                        <div class="card shadow">
                            <div class="card-header border-0">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h3 class="mb-0">@lang('labels.log_funcionario')</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                            </div>

                            <div class="table-responsive">
                                <table id="tabela" class="table table-striped table-hover text-center">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">@lang('labels.ip')</th>
                                            <th scope="col">@lang('labels.log')</th>
                                            <th scope="col">@lang('labels.usuario')</th>
                                        </tr>
                                    </thead>
                                    @foreach ($logFuncionarios as $logFuncionario)
                                        <tbody>
                                            <td>{{ $logFuncionario->ip }}</td>
                                            <td>{{ $logFuncionario->log }}</td>
                                            <td>{{ $logFuncionario->user->name }}</td>
                                        </tbody>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-3 col-12 centered">
                    {{ $logFuncionarios->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection
