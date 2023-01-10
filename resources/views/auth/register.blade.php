@extends('auth.layouts.app')

@section('content')
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div
                        class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                        <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center"
                            style="background-image: url('assets/img/background.jpg');background-size: 100%;background-repeat: no-repeat;">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-5 col-lg-5 col-md-7 d-flex flex-column">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-start">
                                    <h1 class="font-weight-bolder">@lang('labels.vamos-comecar')</h1>
                                    <hr
                                        style=" background-image: linear-gradient(to right, #F45F99, #E4BB3C, #8BD799);     opacity: 1;   height: 10px; ">
                                    </hr>
                                    <p class="mb-0">@lang('labels.dados-empresa')</p>
                                </div>
                                <div class="card-body">
                                    <form role="form" method="POST">
                                        @csrf
                                        @method('post')
                                        <div class="flex flex-col mb-3">
                                            <input type="text" name="cnpj" onkeyup="CNPJ_Fetch('cnpj')" onkeypress="return apenasNumeros();" maxlength="14" class="form-control form-control-lg"
                                                placeholder="CNPJ*" id="cnpj" aria-label="cnpj">
                                        </div>

                                        <div class="flex flex-col mb-3">
                                            <input type="text" name="razao_social" class="form-control form-control-lg"
                                                placeholder="Razão Social*" id="razao_social" aria-label="razao_social">
                                        </div>

                                        <div class="flex flex-col mb-3">
                                            <input type="text" name="nome_fantasia" class="form-control form-control-lg"
                                                placeholder="Nome fantasia*" id="nome_fantasia" aria-label="nome_fantasia">
                                        </div>

                                        <div class="flex flex-col mb-3">
                                            <input type="text" name="emails" class="form-control form-control-lg"
                                                placeholder="@lang('labels.emails')" id="emails" aria-label="emails">
                                        </div>

                                        <p class="mb-4 text-sm mx-auto">@lang('labels.alert-emails-empresa')</p>


                                        <p class="mb-3">@lang('labels.endereco-comercial')</p>

                                        <div class="flex flex-col mb-3">
                                            <input type="text" name="cep"  onkeyup="ViaCep('cep')" id="cep" onkeypress="return apenasNumeros();" maxlength="8" class="form-control form-control-lg"
                                                placeholder="@lang('labels.cep')" aria-label="cep">
                                        </div>

                                        <div class="row">
                                            <div class="flex flex-col mb-3 col-sm">
                                                <input type="text" name="logradouro" id="logradouro" class="form-control form-control-lg"
                                                    placeholder="@lang('labels.logradouro')" aria-label="logradouro">
                                            </div>

                                            <div class="flex flex-col mb-3 col-sm">
                                                <input type="text" id="numero" name="numero" class="form-control form-control-lg"
                                                    placeholder="@lang('labels.numero')" aria-label="numero">
                                            </div>
                                        </div>

                                        <div class="flex flex-col mb-3">
                                            <input type="text" name="complemento" class="form-control form-control-lg"
                                                placeholder="@lang('labels.complemento')" aria-label="complemento">
                                        </div>

                                        <div class="flex flex-col mb-3">
                                            <input type="text" name="bairro" class="form-control form-control-lg"
                                                placeholder="Bairro*" id="bairro" aria-label="bairro">
                                        </div>

                                        <div class="flex flex-col mb-3">
                                            <input type="text" name="estado" class="form-control form-control-lg"
                                                placeholder="Estado*" id="estado" aria-label="estado">
                                        </div>

                                        <div class="flex flex-col mb-1">
                                            <input type="text" name="cidade" class="form-control form-control-lg"
                                                placeholder="Cidade*" id="cidade" aria-label="cidade">
                                        </div>

                                        <div class="text-center">
                                            <button type="submit"
                                                class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">@lang('labels.continuar')</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
