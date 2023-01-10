@extends('auth.layouts.app')

@section('content')
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div
                        class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                        <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center"
                            style="background-image: url('/assets/img/background.jpg');background-size: 100%;background-repeat: no-repeat;">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-5 col-lg-5 col-md-7 d-flex flex-column">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-start">
                                    <!--FORM VALIDATE-->
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <h1 class="font-weight-bolder">@lang('labels.vamos-comecar')</h1>
                                    <hr
                                        style=" background-image: linear-gradient(to right, #F45F99, #E4BB3C, #8BD799);     opacity: 1;   height: 10px; ">
                                    </hr>
                                    <p class="mb-0">@lang('labels.dados-usuario')</p>
                                </div>
                                <div class="card-body">
                                    <form role="form" method="POST"
                                        action="{{ route('enterprise.create.step.three.post') }}">
                                        @csrf
                                        @method('post')
                                        <div class="flex flex-col mb-3">
                                            <input type="text" name="cpf" onkeypress="return apenasNumeros();"
                                                maxlength="14" onkeydown="javascript: fMasc( this, mCPF );" class="form-control form-control-lg" required
                                                placeholder="@lang('labels.cpf')" id="cpf" aria-label="cpf">
                                        </div>

                                        <div class="flex flex-col mb-3">
                                            <input type="text" name="name" required
                                                class="form-control form-control-lg" placeholder="@lang('labels.name')"
                                                id="name" aria-label="name">
                                        </div>

                                        <div class="flex flex-col mb-3">
                                            <input type="email" name="email" class="form-control form-control-lg"
                                                placeholder="@lang('labels.email')" required id="email" aria-label="email">
                                        </div>

                                        <div class="flex flex-col mb-3">
                                            <input type="text" placeholder="@lang('labels.cargo')" class="form-control form-control-lg"
                                                name="cargo" required aria-label="cargo">
                                        </div>

                                        <div class="flex flex-col mb-3">
                                            <input type="date" name="data_nascimento" id="data_nascimento"
                                                class="form-control form-control-lg" aria-label="data_nascimento">
                                            <label for="data_nascimento">@lang('labels.data_nascimento')</label>
                                        </div>

                                        <div class="flex flex-col mb-3">
                                            <p>@lang('labels.sexo')</p>
                                            @foreach ($sexos as $sexo)                                                
                                            <div>
                                                <input type="radio" name="sexo" id="sexo" value="{{ $sexo }}">
                                                <label for="sexo">{{ $sexo }}</label>
                                            </div>
                                            @endforeach
                                        </div>

                                        <div class="flex flex-col mb-3">
                                            <p class="mb-3">@lang('labels.senha-acesso')</p>
                                            <span>@lang('labels.alert-senha-acesso')</span>
                                        </div>

                                        <div class="flex flex-col mb-3">
                                            <input type="password" name="password" id="password"
                                                class="form-control form-control-lg" required placeholder="Senha"
                                                aria-label="password">
                                        </div>

                                        <div class="flex flex-col mb-3">
                                            <input type="password" name="confirm_password" id="confirm_password"
                                                class="form-control form-control-lg"
                                                onkeyup="validarConfirmacaoDeSenha(this.value)" required
                                                placeholder="Confirmar senha" aria-label="confirm_password">
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" disabled
                                                class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0"
                                                id="register-btn">@lang('labels.send')</button>
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
