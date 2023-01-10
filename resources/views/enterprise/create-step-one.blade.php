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

                                    @if (session('msg'))
                                        <div class="alert alert-info" role="alert">
                                            {{ session('msg') }}
                                        </div>
                                    @endif
                                    <h1 class="font-weight-bolder">@lang('labels.vamos-comecar')</h1>
                                    <hr
                                        style=" background-image: linear-gradient(to right, #F45F99, #E4BB3C, #8BD799);     opacity: 1;   height: 10px; ">
                                    </hr>
                                    <p class="mb-0">@lang('labels.selecionar-convencao')</p>
                                </div>
                                <div class="card-body">
                                    <form role="form" method="POST"
                                        action="{{ route('enterprise.create.step.one.post') }}">
                                        @csrf
                                        @method('post')
                                        <div class="flex flex-col mb-3">

                                            <div class="flex flex-col mb-3">
                                                <select name="cct" onchange="getInfoCCT(this.value, 'table-cct')" required
                                                    class="select2 form-control form-control-lg">
                                                    <option value="" selected>@lang('labels.option-padrao')</option>
                                                    @foreach ($convencoes as $cct)
                                                        <option value="{{ $cct->id }}">{{ $cct->cct }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div id="table-cct">
                                                {{--  --}}
                                            </div>

                                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
                                            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

                                            <script>
                                                $(document).ready(function() {
                                                    $('.select2').select2();
                                                });
                                            </script>


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

    <script src="/js/cct.js"></script>
@endsection
