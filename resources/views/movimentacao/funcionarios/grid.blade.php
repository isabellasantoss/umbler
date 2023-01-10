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
                                        <h3 class="mb-0">Lista de funcionários</h3>
                                        <form action="{{ route('funcionarios.index') }}" method="GET">
                                            <div class="row mb-3 mt-4">
                                                <div class="col-4">
                                                    <div class="input-group">
                                                        <input type="text" id="search" name="search" class="form-control"
                                                            placeholder="Pesquise aqui...">
                                                        <button type="submit" class="input-group-text text-body"><i class="fas fa-search"
                                                                aria-hidden="true"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                    <div class="adicionar">
                                        <a href="{{ route('funcionarios.create') }}" class="btn btn-primary m-r-5" >@lang('labels.novo_registro')</a>

                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                            </div>

                            <div class="table-responsive">
                                <table id="tabela" class="table table-striped table-hover text-center">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">@lang('labels.empresa')</th>
                                            <th scope="col">@lang('labels.name')</th>
                                            <th scope="col">@lang('labels.cpf')</th>
                                            <th scope="col">@lang('labels.rg')</th>
                                            <th scope="col">@lang('labels.n_matricula')</th>
                                            <th scope="col">@lang('labels.email')</th>
                                            <th scope="col">@lang('labels.acoes')</th>
                                        </tr>
                                    </thead>
                                    @foreach ($funcionarios as $funcionario)
                                        <tbody>
                                            <td>{{ $funcionario->empresa->nome_fantasia }}</td>
                                            <td>{{ $funcionario->name }}</td>
                                            <td>{{ $funcionario->cpf }}</td>
                                            <td>{{ $funcionario->rg }}</td>
                                            <td>{{ $funcionario->matricula }}</td>
                                            <td>{{ $funcionario->email }}</td>
                                            <td>
                                                <a
                                                    href="{{ route('funcionarios.show', ['id' => base64_encode($funcionario->id)]) }}">
                                                    <button type="button" class="btn btn-success"><i
                                                            class="bi bi-eye"></i></button></a>
                                                <a
                                                    href="{{ route('funcionarios.edit', ['id' => base64_encode($funcionario->id)]) }}"><button
                                                        type="button" class="btn btn-primary"><i
                                                            class="bi bi-pencil"></i></button></a>

                                                {{-- <a
                                                    href="{{ route('funcionarios.export', ['id' => base64_encode($funcionario->id)]) }}">
                                                    <button type="button" class="btn btn-warning"><i
                                                            class="bi bi-download "></i>
                                                    </button></a> --}}

                                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                                    data-target="#exampleModal">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td>
                                        </tbody>
                                    @endforeach
                                </table>
                            </div>


                        </div>
                    </div>
                </div>
                
                <div class="mt-3 col-12 centered">
                    {{ $funcionarios->links() }}
                </div>

            </div>
        </div>
    </div>


    @if (isset($funcionario))
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">@lang('labels.ops')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @lang('labels.alert-delete')
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('funcionarios.destroy', ['id' => base64_encode($funcionario->id)]) }}"
                            method="post">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">@lang('labels.cancel')</button>
                            <button type="submit" class="btn btn-primary">@lang('labels.delete')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
