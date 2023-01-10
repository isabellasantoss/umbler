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
                                        <h3 class="mb-0">@lang('labels.trocar_senha')</h3>
                                        <form role="form" method="POST" action="{{ route('senha.perform') }}">
                                            @csrf
    
                                            <div class="row mb-3 mt-4">
                                                <div class="col-4">
                                                    
                                            <div class="flex flex-col mb-3">
                                                <input type="password" name="password" class="form-control form-control-lg" placeholder="@lang('labels.senha')" aria-label="Password" >
                                                @error('password') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                            </div>
                                            <div class="flex flex-col mb-3">
                                                <input type="password" name="confirm-password" class="form-control form-control-lg" placeholder="@lang('labels.confirmar-senha')" aria-label="Password"  >
                                                @error('confirm-password') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                            </div>
                                                <div class="flex flex-col">
                                                    <button type="submit" id="send"
                                                        class="btn btn-success form-control">@lang('labels.edit')</button>
                                                </div>
                                        </form>
                                    </div>
                                    </div>
                                    <div class="adicionar">
                                        {{-- <a href="{{ route('cartoes.export') }}" class="btn btn-warning m-r-5" >@lang('labels.exportar')</a> --}}

                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
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
