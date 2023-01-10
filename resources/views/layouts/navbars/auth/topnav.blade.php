<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl
        {{ str_contains(Request::url(), 'virtual-reality') == true ? ' mt-3 mx-3 bg-primary' : '' }}" id="navbarBlur"
        data-scroll="false">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <div id="header" style="padding-left: calc(var(--nav-width) -1) !important;">
                <div class="header_toggle"> <i class='bx bx-menu nav_icon' id="header-toggle" style="font-size:40px"></i> </div>
            </div>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            {{-- <form class="ms-md-auto pe-md-3 d-flex align-items-center" action="{{ route('funcionarios.index') }}" method="GET">
                @csrf
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <div class="input-group">
                        <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                        <input type="text" name="search" class="form-control" placeholder="Pesquise aqui...">
                    </div>
                </div>
            </form> --}}
            <div class="navbar-nav  justify-content-end ms-md-auto pe-md-3 d-flex align-items-center">
            <p style="margin-bottom: 0rem">Bem vindo, <b>{{Auth::user()->name}}</b></p>
            </div>
            <ul class="navbar-nav  justify-content-end ms-md-auto pe-md-3 d-flex align-items-center">
                <li class="nav-item d-flex align-items-center">

                    <form role="form" method="post" action="{{ route('logout') }}" id="logout-form">
                        @csrf
                        
                        <a href="{{ route('logout') }}"
                            class="nav-link text-white font-weight-bold px-0" style="color:#fb6340 !important;
                            font-size: 14px;">
                            <i class="fa fa-user me-sm-1"></i>
                            <span class="d-sm-inline d-none">@lang('labels.sair')</span>
                        </a>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->
