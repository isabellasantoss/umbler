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
                                        <h3 class="mb-0">@lang('labels.convencoes_cadastrar')</h3>
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
                                                <input type="text" name="cct" class="form-control form-control-lg"
                                                    placeholder="@lang('labels.CCT')" id="cct" required
                                                    aria-label="cct">
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="celular">@lang('labels.sind_patronal')</label>
                                                <input type="text" name="sind_patronal"
                                                    class="form-control form-control-lg" placeholder="@lang('labels.sind_patronal')"
                                                    id="sind_patronal" required aria-label="sind_patronal">
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="celular">@lang('labels.sind_laboral')</label>
                                                <input type="text" name="sind_laboral"
                                                    class="form-control form-control-lg" placeholder="@lang('labels.sind_laboral')"
                                                    id="sind_laboral" required aria-label="sind_laboral">
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="flex flex-col">
                                                <label for="abrangencia">@lang('labels.abrangencia')</label>
                                                <select name="abrang" id="estado_emissor_rg" class="form-control">
                                                    <option selected>@lang('labels.option-padrao')</option>
                                                    <option value="AC">Acre</option>
                                                    <option value="AL">Alagoas</option>
                                                    <option value="AP">Amapá</option>
                                                    <option value="AM">Amazonas</option>
                                                    <option value="BA">Bahia</option>
                                                    <option value="CE">Ceará</option>
                                                    <option value="DF">Distrito Federal</option>
                                                    <option value="ES">Espírito Santo</option>
                                                    <option value="GO">Goiás</option>
                                                    <option value="MA">Maranhão</option>
                                                    <option value="MT">Mato Grosso</option>
                                                    <option value="MS">Mato Grosso do Sul</option>
                                                    <option value="MG">Minas Gerais</option>
                                                    <option value="PA">Pará</option>
                                                    <option value="PB">Paraíba</option>
                                                    <option value="PR">Paraná</option>
                                                    <option value="PE">Pernambuco</option>
                                                    <option value="PI">Piauí</option>
                                                    <option value="RJ">Rio de Janeiro</option>
                                                    <option value="RN">Rio Grande do Norte</option>
                                                    <option value="RS">Rio Grande do Sul</option>
                                                    <option value="RO">Rondônia</option>
                                                    <option value="RR">Roraima</option>
                                                    <option value="SC">Santa Catarina</option>
                                                    <option value="SP">São Paulo</option>
                                                    <option value="SE">Sergipe</option>
                                                    <option value="TO">Tocantins</option>
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
