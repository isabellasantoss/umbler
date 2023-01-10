@php
    
    use Illuminate\Support\Facades\Auth;
    
@endphp
@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])


@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Adicionar convenção'])
    <div class="main-panel">
        <div class="content">
            <div class="container-fluid mt--7">
                <div class="row">
                    <div class="col">
                        <div class="card shadow">
                            <div class="card-header border-0">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h3 class="mb-0">Editar cartão</b></h3>
                                    </div>
                                    <div class="col-12 text-right">
                                    </div>
                                </div>
                            </div>

                            <form action="{{ route('cartoes.update',  ['id' => base64_encode($cartoes->id)]) }}" method="post">
                                @csrf
                                @method('PUT')

                                <input id="user_id" name="user_id" type="hidden" value="{{ Auth::user()->id }}">
                                <div class="container">
                                    <div class="row mb-3">
                                       
                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="empresa_id">@lang('labels.empresa')</label>
                                                <select name="empresa_id" id="empresa_id" class="form-control">
                                                    <option selected>@lang('labels.option-padrao')</option>
                                                    @foreach ($empresas as $empresa)
                                                        <option @if($cartoes->empresa_id == $empresa->id) selected @endif value="{{ $empresa->id }}">{{ $empresa->nome_fantasia }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="ativo">Ativo?</label>
                                                    <select name="ativo" id="ativo"
                                                    class="form-control">
                                                        <option value="" selected>@lang('labels.option-padrao')</option>
                                                        <option value="sim">Sim</option>
                                                        <option value="nao">Não</option>
                                                    </select>
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="send">@lang('labels.send')</label>
                                                <button type="submit" id="send"
                                                    class="btn btn-success form-control form-control-lg"><i
                                                        class="bi bi-sd-card"></i></button>
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
