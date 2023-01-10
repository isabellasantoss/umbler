@extends('auth.layouts.app')

@section('content')
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-start">
                                    @if (session('msg'))
                                        <div class="alert alert-info" role="alert">
                                            {{ session('msg') }}
                                        </div>
                                    @endif
                                    <h1 class="font-weight-bolder">@lang('labels.bem-vindo')</h1>
                                    <hr
                                        style=" background-image: linear-gradient(to right, #F45F99, #E4BB3C, #8BD799);     opacity: 1;   height: 10px; ">
                                    </hr>
                                    <p class="mb-0">@lang('labels.realizar-login')</p>
                                </div>
                                <div class="card-body">
                                    <form role="form" method="POST" action="{{ route('login.perform') }}">
                                        @csrf
                                        @method('post')
                                        <div class="flex flex-col mb-3">
                                            <input type="email" name="email" class="form-control form-control-lg"
                                                value="{{ old('email') }}" placeholder="Digite seu email"
                                                aria-label="Email">
                                            @error('email')
                                                <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                            @enderror
                                        </div>
                                        <div class="flex flex-col mb-3">
                                            <input type="password" name="password" class="form-control form-control-lg"
                                                placeholder="Digite sua senha"value="">
                                            @error('password')
                                                <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                            @enderror
                                        </div>
                                        <div class="text-center">
                                            <button type="submit"
                                                class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">@lang('labels.login')</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-1 text-sm mx-auto">
                                        <a href="{{ route('reset.password') }}"
                                            class="text-primary text-gradient font-weight-bold">@lang('labels.esqueceu-a-senha-?')</a>
                                    </p>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-sm mx-auto">
                                        @lang('labels.first-login')
                                        <a href="{{ route('enterprise.create.step.one') }}"
                                            class="text-primary text-gradient font-weight-bold">@lang('labels.cadastre-se')</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                            <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden"
                                style="background-image: url('assets/img/background.jpg');background-size: cover;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
