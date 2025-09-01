<header class="header">
    <div class="header-left">
        <button id="sidebarToggle" class="sidebar-toggle">
            <i class="fas fa-bars"></i>
        </button>
        <h1 class="page-title">@yield('page-title', 'Dashboard')</h1>
    </div>

    <div class="header-right">
        <!-- Notifications -->
        <div class="dropdown">
            <button class="btn btn-link text-decoration-none position-relative" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-bell fs-5"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    3
                </span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" style="width: 300px;">
                <li><h6 class="dropdown-header">Notifications</h6></li>
                <li><a class="dropdown-item" href="#">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                <i class="fas fa-user-plus text-white"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="mb-0 fw-semibold">New user registered</p>
                            <small class="text-muted">2 minutes ago</small>
                        </div>
                    </div>
                </a></li>
                <li><a class="dropdown-item" href="#">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-success rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                <i class="fas fa-check text-white"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="mb-0 fw-semibold">Order completed</p>
                            <small class="text-muted">1 hour ago</small>
                        </div>
                    </div>
                </a></li>
                <li><a class="dropdown-item" href="#">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-warning rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                <i class="fas fa-exclamation-triangle text-white"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="mb-0 fw-semibold">System alert</p>
                            <small class="text-muted">3 hours ago</small>
                        </div>
                    </div>
                </a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-center" href="#">View all notifications</a></li>
            </ul>
        </div>

        <!-- User Menu -->
        <div class="user-menu dropdown">
            <button class="user-button dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="user-avatar">
                    {{ substr(auth()->guard('admin')->user()->name ?? 'A', 0, 1) }}
                </div>
                <span class="d-none d-md-inline">{{ auth()->guard('admin')->user()->name ?? 'Admin' }}</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><h6 class="dropdown-header">User Menu</h6></li>
                <li><a class="dropdown-item" href="#">
                    <i class="fas fa-user me-2"></i>Profile
                </a></li>
                <li><a class="dropdown-item" href="#">
                    <i class="fas fa-cog me-2"></i>Settings
                </a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a href="{{ route('admin.logout') }}" class="dropdown-item text-danger">
                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</header>
