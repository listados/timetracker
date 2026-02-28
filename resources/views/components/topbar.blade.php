<header class="nxl-header">
    <div class="header-wrapper">
        <div class="header-left d-flex align-items-center gap-4">
            {{-- Mobile toggle --}}
            <a href="javascript:void(0);" class="nxl-head-mobile-toggler" id="mobile-collapse">
                <div class="hamburger hamburger--arrowturn">
                    <div class="hamburger-box">
                        <div class="hamburger-inner"></div>
                    </div>
                </div>
            </a>

            {{-- Sidebar mini/expand toggle --}}
            <div class="nxl-navigation-toggle">
                <a href="javascript:void(0);" id="menu-mini-button">
                    <i class="feather-align-left"></i>
                </a>
                <a href="javascript:void(0);" id="menu-expend-button" style="display: none">
                    <i class="feather-arrow-right"></i>
                </a>
            </div>
        </div>

        <div class="header-right ms-auto">
            <div class="d-flex align-items-center">
                {{-- User dropdown --}}
                <div class="dropdown nxl-h-item">
                    <a href="javascript:void(0);"
                       class="nxl-head-link me-0 d-flex align-items-center gap-2"
                       data-bs-toggle="dropdown"
                       role="button"
                       data-bs-auto-close="outside">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=4680ff&color=fff&size=40&rounded=true"
                             alt="{{ Auth::user()->name }}"
                             class="img-fluid user-avtar me-0" />
                        <span class="d-none d-md-block fw-semibold">{{ Auth::user()->name }}</span>
                        <i class="feather-chevron-down d-none d-md-block"></i>
                    </a>

                    <div class="dropdown-menu dropdown-menu-end nxl-h-dropdown nxl-user-dropdown">
                        <div class="dropdown-header">
                            <div class="d-flex align-items-center gap-3">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=4680ff&color=fff&size=60&rounded=true"
                                     alt="{{ Auth::user()->name }}"
                                     class="img-fluid user-avtar" />
                                <div>
                                    <h6 class="text-dark mb-0">{{ Auth::user()->name }}</h6>
                                    <span class="fs-12 fw-medium text-muted">{{ Auth::user()->email }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="dropdown-divider"></div>

                        <a href="{{ route('profile.edit') }}" class="dropdown-item">
                            <i class="feather-user me-2"></i>
                            <span>{{ __('Meu Perfil') }}</span>
                        </a>

                        <div class="dropdown-divider"></div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="feather-log-out me-2"></i>
                                <span>{{ __('Sair') }}</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
