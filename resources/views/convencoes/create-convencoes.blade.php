@extends('layouts.app')

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
                                    <h1 class="font-weight-bolder">@lang('labels.convencoes_cadastrar')</h1>
                                    <hr
                                        style=" background-image: linear-gradient(to right, #F45F99, #E4BB3C, #8BD799);     opacity: 1;   height: 10px; ">
                                    </hr>
                                </div>
                                <div class="card-body">
                                    <form role="form" method="POST"
                                        action="{{ route('cct.store') }}">
                                        @csrf
                                        @method('post')
                                        <div class="flex flex-col mb-3">

                                            <div class="flex flex-col mb-3">
                                                <input type="text" name="cct" class="form-control form-control-lg"
                                                    placeholder="@lang('labels.CCT')" id="cct"
                                                    required aria-label="cct">
                                            </div>

                                            <div class="flex flex-col mb-3">
                                                <input type="text" name="sind_patronal" class="form-control form-control-lg"
                                                    placeholder="@lang('labels.sind_patronal')" id="sind_patronal"
                                                    required aria-label="sind_patronal">
                                            </div>

                                            <div class="flex flex-col mb-3">
                                                <input type="text" name="sind_laboral" class="form-control form-control-lg"
                                                    placeholder="@lang('labels.sind_laboral')" id="sind_laboral"
                                                    required aria-label="sind_laboral">
                                            </div>

                                            <div class="flex flex-col mb-3">
                                                <input type="text" name="abrang" class="form-control form-control-lg"
                                                    placeholder="@lang('labels.abrangencia')" id="abrang"
                                                    required aria-label="abrang">
                                            </div>

                                            <div class="text-center">
                                                <button type="submit"
                                                    class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">@lang('labels.send')</button>
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
