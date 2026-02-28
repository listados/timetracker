<nav class="nxl-navigation">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="{{ route('dashboard') }}" class="b-brand">
                <img src="{{ asset('img/timetrackink.png') }}" alt="{{ config('app.name') }}" class="logo logo-lg" style="height: 36px; width: auto; object-fit: contain;" />
                <img src="{{ asset('img/timetrackink.png') }}" alt="{{ config('app.name') }}" class="logo logo-sm" style="height: 36px; width: auto; object-fit: contain;" />
            </a>
        </div>

        <div class="navbar-content">
            <ul class="nxl-navbar">
                <li class="nxl-item nxl-caption">
                    <label>{{ __('Navegação') }}</label>
                </li>

                <li class="nxl-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-home"></i></span>
                        <span class="nxl-mtext">{{ __('Dashboard') }}</span>
                    </a>
                </li>

                {{-- Adicionar mais itens conforme as rotas forem criadas --}}
                {{--
                <li class="nxl-item {{ request()->routeIs('projects.*') ? 'active' : '' }}">
                    <a href="{{ route('projects.index') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-briefcase"></i></span>
                        <span class="nxl-mtext">{{ __('Projetos') }}</span>
                    </a>
                </li>

                <li class="nxl-item {{ request()->routeIs('activities.*') ? 'active' : '' }}">
                    <a href="{{ route('activities.index') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-clock"></i></span>
                        <span class="nxl-mtext">{{ __('Atividades') }}</span>
                    </a>
                </li>
                --}}
            </ul>
        </div>
    </div>
</nav>
