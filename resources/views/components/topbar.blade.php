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
                @php
                    $notifications = auth()->user()->notifications()->latest()->take(10)->get();
                    $unreadCount   = auth()->user()->unreadNotifications()->count();
                @endphp
                <div class="dropdown nxl-h-item">
                    <a class="nxl-head-link me-3" data-bs-toggle="dropdown" href="#" role="button" data-bs-auto-close="outside">
                        <i class="fa fa-bell fa-xl"></i>
                        @if($unreadCount > 0)
                            <span class="badge bg-danger nxl-h-badge">{{ $unreadCount }}</span>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-end nxl-h-dropdown nxl-notifications-menu">
                        <div class="d-flex justify-content-between align-items-center notifications-head">
                            <h6 class="fw-bold text-dark mb-0">Notificações</h6>
                            @if($unreadCount > 0)
                                <a href="javascript:void(0);"
                                   class="fs-11 text-success text-end ms-auto mark-all-read"
                                   data-url="{{ route('notifications.read-all') }}">
                                    <i class="feather-check"></i>
                                    <span>Marcar todas como lidas</span>
                                </a>
                            @endif
                        </div>

                        @forelse($notifications as $notification)
                            <div class="notifications-item {{ is_null($notification->read_at) ? 'bg-light' : '' }}"
                                 id="notification-{{ $notification->id }}">
                                <div class="notifications-desc">
                                    <a href="javascript:void(0);" class="font-body text-truncate-2-line">
                                        {{ $notification->data['message'] }}
                                    </a>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="notifications-date text-muted border-bottom border-bottom-dashed">
                                            {{ $notification->created_at->diffForHumans() }}
                                        </div>
                                        @if(is_null($notification->read_at))
                                            <div class="d-flex align-items-center float-end gap-2">
                                                <a href="javascript:void(0);"
                                                   class="d-block wd-8 ht-8 rounded-circle bg-primary mark-as-read"
                                                   data-id="{{ $notification->id }}"
                                                   data-url="{{ route('notifications.read', $notification->id) }}"
                                                   title="Marcar como lida"></a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-3 text-muted fs-13">Nenhuma notificação.</div>
                        @endforelse

                        <div class="text-center notifications-footer">
                            <span class="fs-13 text-muted">Últimas {{ $notifications->count() }} notificações</span>
                        </div>
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        document.querySelectorAll('.mark-as-read').forEach(function (el) {
                            el.addEventListener('click', function () {
                                const id   = this.dataset.id;
                                const url  = this.dataset.url;
                                const item = document.getElementById('notification-' + id);
                                fetch(url, {
                                    method: 'PATCH',
                                    headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
                                }).then(() => {
                                    item.classList.remove('bg-light');
                                    this.remove();
                                    const badge = document.querySelector('.nxl-h-badge');
                                    if (badge) {
                                        const count = parseInt(badge.textContent) - 1;
                                        count > 0 ? badge.textContent = count : badge.remove();
                                    }
                                });
                            });
                        });

                        const markAll = document.querySelector('.mark-all-read');
                        if (markAll) {
                            markAll.addEventListener('click', function () {
                                fetch(this.dataset.url, {
                                    method: 'PATCH',
                                    headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
                                }).then(() => location.reload());
                            });
                        }
                    });
                </script>
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
