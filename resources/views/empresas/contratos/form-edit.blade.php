@php
    
    use Illuminate\Support\Facades\Auth;
    
@endphp
@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])


@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Editar contratos'])
    <div class="main-panel">
        <div class="content">
            <div class="container-fluid mt--7">
                <div class="row">
                    <div class="col">
                        <div class="card shadow">
                            <div class="card-header border-0">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h3 class="mb-0">@lang('labels.editar_contrato'): {{$userinfos->nome_fantasia}}</h3>
                                    </div>
                                    <div class="col-12 text-right">
                                        {{-- <a href="{{ route('usuario.create') }}" class="btn btn-sm btn-primary">Adicionar usuário</a> --}}
                                    </div>
                                </div>
                            </div>

                            <form action="{{ route('contratos.update', ['id' => base64_encode($userinfos->id)]) }}) }}" method="post">
                                @csrf
                                @method('PUT')
                                <input id="user_id" name="user_id" type="hidden" value="{{ Auth::user()->id }}">
                                
                                <div class="container">
                                    <div class="row mb-3">
                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                        <label for="cct">@lang('labels.CCT')</label>
                                        <select name="cct" id="cct" class="form-control">
                                            <option  value="" selected>@lang('labels.option-padrao')</option>
                                            @foreach ($convencao as $cct)
                                                <option value="{{ $cct->id }}">{{ $cct->cct }}
                                                </option>
                                            @endforeach
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
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
