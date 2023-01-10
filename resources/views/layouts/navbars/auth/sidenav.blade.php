<style>
    body {
        margin: calc(var(--header-height)) 0 0 0;
        padding-left: calc(var(--nav-width))
    }

</style>

<body id="body-pd">

    <div class="l-navbar" id="nav-bar">
        <nav class="nav">

            <div>
                <a href="#" class="nav_logo"></a>
                <div class="nav_list">
                    <a href="{{ route('home') }}" class="nav_link">
                        <i class='bx bx-grid-alt nav_icon'></i>
                        <span class="nav_name">@lang('labels.dashboard')</span>
                    </a>
                    <div class="btn-group">
                        <a href="{{ route('empresas.index') }}" class="nav_link dropdown-toggle"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class='bx bx-briefcase nav_icon'></i>
                            <span class="nav_name">@lang('labels.empresas')</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" type="button" href="{{ route('empresas.index') }}">
                                <i class='bx bx-right-arrow-alt nav_icon'></i>
                                @lang('labels.dados_cadastrais')
                            </a>
                            {{-- <a class="dropdown-item" type="button" href="{{ route('empresas.index') }}">
                                <i class='bx bx-right-arrow-alt nav_icon'></i>
                                @lang('labels.faturas')
                            </a> --}}
                            <a class="dropdown-item" type="button" href="{{ route('contratos.index') }}">
                                <i class='bx bx-right-arrow-alt nav_icon'></i>
                                @lang('labels.consultar_contratos')
                            </a>

                        </div>
                    </div>
                    
                    @can('visualizar-convencoes')
                    <a href="{{route('convencoes.index')}}" class="nav_link">
                        <i class='bx  bx-building nav_icon'></i>
                        <span class="nav_name">@lang('labels.convencoes')</span> </a>
                    @endcan

                    
                    <div class="btn-group">
                        <a href="{{ route('funcionarios.index') }}" class="nav_link dropdown-toggle"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class='bx bx-layer nav_icon'></i>
                            <span class="nav_name">@lang('labels.movimentacao')</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" type="button" href="{{ route('funcionarios.index') }}">
                                <i class="bx bx-right-arrow-alt nav_icon"></i>
                                @lang('labels.funcionarios')
                            </a>
                            <a class="dropdown-item" type="button" href="{{ route('log.funcionarios.index') }}">
                                <i class='bx bx-right-arrow-alt nav_icon'></i>
                                @lang('labels.movimentacoes_realizadas')
                            </a>
                            <a class="dropdown-item" type="button" href="{{ route('dependentes.index') }}">
                                <i class='bx bx-right-arrow-alt nav_icon'></i>
                                @lang('labels.dependentes')
                            </a>
                        </div>
                    </div>

        
                    <a href="{{route('cartoes.index')}}" class="nav_link">
                        <i class='bx bx-card nav_icon'></i>
                        <span class="nav_name">@lang('labels.cartao')</span> </a>

                    <a href="{{route('relatorios.index')}}" class="nav_link">
                        <i class='bx bx-bar-chart-alt-2 nav_icon'></i>
                        <span class="nav_name">@lang('labels.relatorios')</span> </a>

                        
                    <a href="{{route('senha')}}" class="nav_link">
                        <i class='bx bx-key nav_icon'></i>
                        <span class="nav_name">@lang('labels.trocar_senha')</span> </a>
          
                </div>
            </div>
            <a href="{{route('logout')}}" class="nav_link">
                <i class='bx bx-log-out nav_icon'></i>
                <span class="nav_name">@lang('labels.sair')</span>
            </a>
        </nav>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function(event) {

            const showNavbar = (toggleId, navId, bodyId, headerId) => {
                const toggle = document.getElementById(toggleId),
                    nav = document.getElementById(navId),
                    bodypd = document.getElementById(bodyId),
                    headerpd = document.getElementById(headerId)

                // Validate that all variables exist
                if (toggle && nav && bodypd && headerpd) {
                    toggle.addEventListener('click', () => {
                        // show navbar
                        nav.classList.toggle('show')
                        // change icon
                        toggle.classList.toggle('bx-x')
                        // add padding to body
                        bodypd.classList.toggle('body-pd')
                        // add padding to header
                        headerpd.classList.toggle('body-pd')
                    })
                }
            }

            showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header')

            /*===== LINK ACTIVE =====*/
            const linkColor = document.querySelectorAll('.nav_link')

            function colorLink() {
                if (linkColor) {
                    linkColor.forEach(l => l.classList.remove('active'))
                    this.classList.add('active')
                }
            }
            linkColor.forEach(l => l.addEventListener('click', colorLink))

            // Your code to run since DOM is loaded and ready
        });

        $('.dropdown-toggle').dropdown();

    </script>
