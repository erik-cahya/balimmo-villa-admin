<div class="main-nav">
    <!-- Sidebar Logo -->
    <div class="logo-box">
        <a href="index.html" class="logo-dark">
            <img src="{{ asset('admin') }}/assets/images/logo-sm.png" class="logo-sm" alt="logo sm">
            <img src="{{ asset('admin') }}/assets/images/logo-dark.png" class="logo-lg" alt="logo dark">
        </a>

        <a href="index.html" class="logo-light">
            <img src="{{ asset('admin') }}/assets/images/logo-sm.png" class="logo-sm" alt="logo sm">
            <img src="{{ asset('admin') }}/assets/images/logo-light.png" class="logo-lg" alt="logo light">
        </a>
    </div>

    <!-- Menu Toggle Button (sm-hover) -->
    <button type="button" class="button-sm-hover" aria-label="Show Full Sidebar">
        <i class="ri-menu-2-line fs-24 button-sm-hover-icon"></i>
    </button>

    <div class="scrollbar" data-simplebar>

        <ul class="navbar-nav" id="navbar-nav">

            <li class="menu-title">Menu</li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard.*') ? 'active' : '' }}" href="{{ route('dashboard.index') }}">
                    <span class="nav-icon">
                        <i class="ri-dashboard-2-line"></i>
                    </span>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>

            <li class="menu-title">Management App</li>

            <li class="nav-item">
                <a class="nav-link menu-arrow {{ request()->routeIs('properties.*') ? 'active' : '' }}" href="#sidebarProperty" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarProperty">
                    <span class="nav-icon">
                        <i class="ri-community-line"></i>
                    </span>
                    <span class="nav-text"> Properties </span>
                </a>
                <div class="{{ request()->routeIs('properties.*') ? 'show' : '' }} collapse" id="sidebarProperty">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="{{ route('properties.index') }}">Properties List</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="{{ route('properties.create') }}">Create Properties Listing</a>
                        </li>

                        @if (Auth::user()->role === 'Master')
                            <li class="sub-nav-item">
                                <a class="sub-nav-link" href="{{ route('features.index') }}">Feature & Amenities</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </li>

            @if (Auth::user()->role === 'Master')
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('agent.*') ? 'active' : '' }}" href="{{ route('agent.index') }}">
                        <span class="nav-icon">
                            <i class="ri-group-line"></i>
                        </span>
                        <span class="nav-text">Agent</span>
                    </a>
                </li>
            @endif

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('leads.*') ? 'active' : '' }}" href="{{ route('leads.index') }}">
                    <span class="nav-icon">
                        <i class="ri-user-shared-2-line"></i>
                    </span>
                    <span class="nav-text">Leads</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}" href="{{ route('profile.index') }}">
                    <span class="nav-icon">
                        <i class="ri-group-line"></i>
                    </span>
                    <span class="nav-text">My Profile</span>
                </a>
            </li>

        </ul>
    </div>
</div>
