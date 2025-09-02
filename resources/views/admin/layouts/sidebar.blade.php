<!-- Sidebar Overlay for Mobile -->
<div id="sidebarOverlay" class="position-fixed top-0 start-0 w-100 h-100 bg-dark bg-opacity-50" style="z-index: 999; display: none;"></div>

<!-- Sidebar -->
<aside id="sidebar" class="sidebar">
    <!-- Sidebar Header -->
    <div class="sidebar-header">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
            <img src="{{ asset('assets/logo.png') }}" alt="Shozy App Logo" class="sidebar-logo me-2">
            {{-- <span>Shozy App</span> --}}
        </a>
    </div>

    <!-- Sidebar Navigation -->
    <nav class="sidebar-nav">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt me-3"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            {{-- <li class="nav-item">
                <a href="{{ route('admin.color-showcase') }}" class="nav-link {{ request()->routeIs('admin.color-showcase') ? 'active' : '' }}">
                    <i class="fas fa-palette me-3"></i>
                    <span>Color Showcase</span>
                </a>
            </li> --}}

            <li class="nav-item">
                <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                    <i class="fas fa-users me-3"></i>
                    <span>Vendors</span>
                </a>
            </li>

                        <li class="nav-item">
                <a href="{{ route('admin.customers.index') }}" class="nav-link {{ request()->routeIs('admin.customers*') ? 'active' : '' }}">
                    <i class="fas fa-user-friends me-3"></i>
                    <span>Customers</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="{{ route('admin.shipping.index') }}" class="nav-link {{ request()->routeIs('admin.shipping*') ? 'active' : '' }}">
                    <i class="fas fa-shipping-fast me-3"></i>
                    <span>Shipping</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="{{ route('admin.technicians.index') }}" class="nav-link {{ request()->routeIs('admin.technicians*') ? 'active' : '' }}">
                    <i class="fas fa-tools me-3"></i>
                    <span>Technicians</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.deliveries.index') }}" class="nav-link {{ request()->routeIs('admin.deliveries*') ? 'active' : '' }}">
                    <i class="fas fa-truck me-3"></i>
                    <span>Delivery Panel</span>
                </a>
            </li>


            <li class="nav-item">
                <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products*') ? 'active' : '' }}">
                    <i class="fas fa-box me-3"></i>
                    <span>Products</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories*') ? 'active' : '' }}">
                    <i class="fas fa-folder me-3"></i>
                    <span>Categories</span>
                </a>
            </li>

        
            {{-- <li class="nav-item">
                <a href="{{ route('admin.attributes.index') }}" class="nav-link {{ request()->routeIs('admin.attributes*') ? 'active' : '' }}">
                    <i class="fas fa-tags me-3"></i>
                    <span>Attributes</span>
                </a>
            </li> --}}

            {{--             <li class="nav-item">
                <a href="{{ route('admin.vendors.index') }}" class="nav-link {{ request()->routeIs('admin.vendors*') ? 'active' : '' }}">
                    <i class="fas fa-store me-3"></i>
                    <span>Vendors</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.technicians.index') }}" class="nav-link {{ request()->routeIs('admin.technicians*') ? 'active' : '' }}">
                    <i class="fas fa-tools me-3"></i>
                    <span>Technicians</span>
                </a>
            </li> --}}

            {{-- <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-user-shield me-3"></i>
                    <span>Roles & Permissions</span>
                </a>
            </li> --}}

            <li class="nav-item">
                <a href="{{ route('admin.orders.index') }}" class="nav-link {{ request()->routeIs('admin.orders*') ? 'active' : '' }}">
                    <i class="fas fa-shopping-cart me-3"></i>
                    <span>Orders</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.coupons.index') }}" class="nav-link {{ request()->routeIs('admin.coupons*') ? 'active' : '' }}">
                    <i class="fas fa-ticket-alt me-3"></i>
                    <span>Coupon Codes</span>
                </a>
            </li>

            {{-- <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-tools me-3"></i>
                    <span>Services</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-truck me-3"></i>
                    <span>Delivery</span>
                </a>
            </li> --}}

            {{-- <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-chart-bar me-3"></i>
                    <span>Analytics</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-cog me-3"></i>
                    <span>Settings</span>
                </a>
            </li> --}}
        </ul>
    </nav>
</aside>
