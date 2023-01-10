@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Convenções'])
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
                                        <h3 class="mb-0">@lang('labels.cartao')</h3>
                                        <form action="{{ route('cartoes.index') }}" method="GET">
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
                                        <a href="{{ route('cartoes.export') }}" class="btn btn-warning m-r-5" >@lang('labels.exportar')</a>

                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                            </div>

                            <div class="table-responsive">
                                <table id="tabela" class="table table-striped table-hover text-center">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">@lang('labels.funcionario')</th>
                                            <th scope="col">@lang('labels.empresa')</th>
                                            <th scope="col">@lang('labels.numero_cartao')</th>
                                            <th scope="col">@lang('labels.ativo')</th>
                                            <th scope="col">@lang('labels.acoes')</th>

                                        </tr>
                                    </thead>
                                    @foreach ($cartoes as $cartao)
                                        <tbody>
                                            <td>{{ $cartao->name }}</td>
                                            <td>{{ $cartao->empresa->razao_social }}</td>
                                            <td>{{ $cartao->numeracao_cartao }}</td>
                                            @if (isset($cartao->ativo))
                                                <td>Sim</td>
                                            @else
                                                <td>Não</td>
                                            @endif
                                            <td>
                                                <a
                                                    href="{{ route('cartoes.edit', ['id' => base64_encode($cartao->id)]) }}"><button
                                                        type="button" class="btn btn-primary"><i
                                                            class="bi bi-pencil"></i></button></a>
                                            </td>
                                        </tbody>
                                    @endforeach
                                </table>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @if (isset($cartao))
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
                  
                </div>
            </div>
        </div>
    @endif
@endsection
