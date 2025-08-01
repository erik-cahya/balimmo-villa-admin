<div class="main-nav">
    <!-- Sidebar Logo -->
    <div class="logo-box">
        <a href="" class="logo-dark">
            <img src="{{ asset('admin') }}/assets/images/logo-sm.png" class="logo-sm" alt="logo sm">
            <img src="{{ asset('admin') }}/assets/images/logo-dark.png" class="logo-lg" alt="logo dark">
        </a>

        <a href="" class="logo-light">
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

            @role('Master|agent')
                <li class="menu-title">Listing</li>

                <li class="nav-item">
                    <!-- <a class="sub-nav-link" href="{{ route('properties.index') }}">Data Listing</a> -->
                    <a class="nav-link {{ request()->routeIs('properties.index') ? 'active' : '' }}" href="{{ route('properties.index') }}">
                        <span class="nav-icon">
                            <i class="ri-community-line"></i>
                        </span>
                        <span class="nav-text">Villas</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('land.index') ? 'active' : '' }}" href="{{ route('land.index') }}">
                        <span class="nav-icon">
                            <iconify-icon icon="icon-park-solid:local-pin" class="fs-18 align-middle"></iconify-icon>
                        </span>
                        <span class="nav-text">Lands</span>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link menu-arrow {{ request()->routeIs('properties.*') ? 'active' : '' }}" href="#sidebarProperty" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarProperty">
                        <span class="nav-icon">
                            <i class="ri-community-line"></i>
                        </span>
                        <span class="nav-text"> Data Listing </span>
                    </a>
                    <div class="{{ request()->routeIs('properties.*') ? 'show' : '' }} collapse" id="sidebarProperty">
                        <ul class="nav sub-navbar-nav">
                            <li class="sub-nav-item">
                                <a class="sub-nav-link" href="{{ route('properties.index') }}">Data Listing</a>
                            </li>
                            <li class="sub-nav-item">
                                <a class="sub-nav-link" href="{{ route('properties.create') }}">Create Properties Listing</a>
                            </li>
                            <li class="sub-nav-item">
                                <a class="sub-nav-link" href="{{ route('land.create') }}">Create Land Listing</a>
                            </li>

                        </ul>
                    </div>
                </li> -->
            @endrole

            @role('Master|agent')
                <li class="menu-title">Customer Management</li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('leads.*') ? 'active' : '' }}" href="{{ route('leads.index') }}">
                        <span class="nav-icon">
                            <i class="ri-user-shared-2-line"></i>
                        </span>
                        <span class="nav-text">Leads</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('prospects.*') ? 'active' : '' }}" href="{{ route('prospects.index') }}">
                        <span class="nav-icon">
                            <iconify-icon icon="la:user-tie" class="fs-18 align-middle"></iconify-icon>
                        </span>
                        <span class="nav-text">Prospects</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('clients.*') ? 'active' : '' }}" href="{{ route('clients.index') }}">
                        <span class="nav-icon">
                            <iconify-icon icon="la:user-check" class="fs-18 align-middle"></iconify-icon>
                        </span>
                        <span class="nav-text">Clients</span>
                    </a>
                </li>
            @endrole

            <!-- @role('Master|agent')
                <li class="menu-title">Document Management</li>

                <li class="nav-item">
                    <a class="nav-link menu-arrow {{ request()->routeIs('visit.*') ? 'active' : '' }}" href="#sidebarVisit" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarVisit">
                        <span class="nav-icon">
                            <iconify-icon icon="carbon:document" class="fs-18 align-middle"></iconify-icon>
                        </span>
                        <span class="nav-text"> Visit </span>
                    </a>
                    <div class="{{ request()->routeIs('visit.*') ? 'show' : '' }} collapse" id="sidebarVisit">
                        <ul class="nav sub-navbar-nav">
                            <li class="sub-nav-item">
                                <a class="sub-nav-link" href="{{ route('visit.index') }}">List Document Visit</a>
                            </li>
                            <li class="sub-nav-item">
                                <a class="sub-nav-link" href="{{ route('visit.create') }}">Create Visit </a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-arrow {{ request()->routeIs('offer-purchase.*') ? 'active' : '' }}" href="#offerToPurchase" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="offerToPurchase">
                        <span class="nav-icon">
                            <iconify-icon icon="carbon:document" class="fs-18 align-middle"></iconify-icon>
                        </span>
                        <span class="nav-text"> Offer To Purchase </span>
                    </a>
                    <div class="{{ request()->routeIs('offer-purchase.*') ? 'show' : '' }} collapse" id="offerToPurchase">
                        <ul class="nav sub-navbar-nav">
                            <li class="sub-nav-item">
                                <a class="sub-nav-link" href="{{ route('offer-purchase.index') }}">List Offer to Purchase</a>
                            </li>
                            <li class="sub-nav-item">
                                <a class="sub-nav-link" href="{{ route('offer-purchase.create') }}">Create Offer to Purchase </a>
                            </li>

                        </ul>
                    </div>
                </li>
            @endrole -->

            <!-- @role('Master')
                <li class="menu-title">User Management</li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('agent.*') ? 'active' : '' }}" href="{{ route('agent.index') }}">
                        <span class="nav-icon">
                            <i class="ri-group-line"></i>
                        </span>
                        <span class="nav-text">Agent</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('notary.*') ? 'active' : '' }}" href="{{ route('notary.index') }}">
                        <span class="nav-icon">
                            <i class="ri-group-line"></i>
                        </span>
                        <span class="nav-text">Notary</span>
                    </a>
                </li>
            @endrole -->

            <!-- <li class="menu-title">Personal</li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}" href="{{ route('profile.index') }}">
                    <span class="nav-icon">
                        <i class="ri-group-line"></i>
                    </span>
                    <span class="nav-text">My Profile</span>
                </a>
            </li> -->

            @role('Master')
                <!-- <li class="menu-title">Setting</li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('localization.*') ? 'active' : '' }}" href="{{ route('localization.index') }}">
                        <span class="nav-icon">
                            <iconify-icon icon="icon-park-solid:local-pin" class="fs-18 align-middle"></iconify-icon>
                        </span>
                        <span class="nav-text">Localization Management</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('features.*') ? 'active' : '' }}" href="{{ route('features.index') }}">
                        <span class="nav-icon">
                            <iconify-icon icon="mynaui:air-conditioner-solid" class="fs-18 align-middle"></iconify-icon>
                        </span>
                        <span class="nav-text">Features & Ammenities</span>
                    </a>
                </li> -->
                <li class="menu-title">Setting</li>
                <li class="nav-item">
                    <a class="nav-link menu-arrow {{ request()->routeIs('data-management.*') ? 'active' : '' }}" href="#dataManagement" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="dataManagement">
                        <span class="nav-icon">
                            <iconify-icon icon="carbon:document" class="fs-18 align-middle"></iconify-icon>
                        </span>
                        <span class="nav-text"> Data management </span>
                    </a>
                    <div class="{{ request()->routeIs('data-management.*') ? 'show' : '' }} collapse" id="dataManagement">
                        <ul class="nav sub-navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('agent.*') ? 'active' : '' }}" href="{{ route('agent.index') }}">
                                    <span class="nav-icon">
                                        <i class="ri-group-line"></i>
                                    </span>
                                    <span class="nav-text">Agent</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('notary.*') ? 'active' : '' }}" href="{{ route('notary.index') }}">
                                    <span class="nav-icon">
                                        <i class="ri-group-line"></i>
                                    </span>
                                    <span class="nav-text">Notary</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('localization.*') ? 'active' : '' }}" href="{{ route('localization.index') }}">
                                    <span class="nav-icon">
                                        <iconify-icon icon="icon-park-solid:local-pin" class="fs-18 align-middle"></iconify-icon>
                                    </span>
                                    <span class="nav-text">Localization Management</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('features.*') ? 'active' : '' }}" href="{{ route('features.index') }}">
                                    <span class="nav-icon">
                                        <iconify-icon icon="mynaui:air-conditioner-solid" class="fs-18 align-middle"></iconify-icon>
                                    </span>
                                    <span class="nav-text">Features & Ammenities</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
            @endrole

            @role('notary')
                <li class="menu-title">NOTARY MENU</li>
            @endrole
        </ul>
    </div>
</div>
