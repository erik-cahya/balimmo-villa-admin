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
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M13 8V4q0-.425.288-.712T14 3h6q.425 0 .713.288T21 4v4q0 .425-.288.713T20 9h-6q-.425 0-.712-.288T13 8M3 12V4q0-.425.288-.712T4 3h6q.425 0 .713.288T11 4v8q0 .425-.288.713T10 13H4q-.425 0-.712-.288T3 12m10 8v-8q0-.425.288-.712T14 11h6q.425 0 .713.288T21 12v8q0 .425-.288.713T20 21h-6q-.425 0-.712-.288T13 20M3 20v-4q0-.425.288-.712T4 15h6q.425 0 .713.288T11 16v4q0 .425-.288.713T10 21H4q-.425 0-.712-.288T3 20m2-9h4V5H5zm10 8h4v-6h-4zm0-12h4V5h-4zM5 19h4v-2H5zm4-2" />
                        </svg>
                    </span>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>

            @role('master|agent')
                <li class="menu-title">Listing</li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('properties.*') ? 'active' : '' }}" href="{{ route('properties.index') }}">
                        <span class="nav-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M19 10c-1.1 0-2 .9-2 2h-1V3L3 8v13h18v-9c0-1.1-.9-2-2-2M5 9.37l9-3.46V12H9v7H5zM19 19h-3v-3h-2v3h-3v-5h8z" />
                            </svg>
                        </span>
                        <span class="nav-text">Villas</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('land.*') ? 'active' : '' }}" href="{{ route('land.index') }}">
                        <span class="nav-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                    <path d="M3 3v16a2 2 0 0 0 2 2h16" />
                                    <path d="M7 11.207a.5.5 0 0 1 .146-.353l2-2a.5.5 0 0 1 .708 0l3.292 3.292a.5.5 0 0 0 .708 0l4.292-4.292a.5.5 0 0 1 .854.353V16a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1z" />
                                </g>
                            </svg>
                        </span>
                        <span class="nav-text">Lands</span>
                    </a>
                </li>
            @endrole

            @role('master|agent')
                <li class="menu-title">Customer Management</li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('leads.*') ? 'active' : '' }}" href="{{ route('leads.index') }}">
                        <span class="nav-icon">                            
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18 18.72a9.1 9.1 0 0 0 3.741-.479q.01-.12.01-.241a3 3 0 0 0-4.692-2.478m.94 3.197l.001.031q0 .337-.037.666A11.94 11.94 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6 6 0 0 1 6 18.719m12 0a5.97 5.97 0 0 0-.941-3.197m0 0A6 6 0 0 0 12 12.75a6 6 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72a9 9 0 0 0 3.74.477m.94-3.197a5.97 5.97 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0a3 3 0 0 1 6 0m6 3a2.25 2.25 0 1 1-4.5 0a2.25 2.25 0 0 1 4.5 0m-13.5 0a2.25 2.25 0 1 1-4.5 0a2.25 2.25 0 0 1 4.5 0" />
                            </svg>
                        </span>
                        <span class="nav-text">Leads</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('prospects.*') ? 'active' : '' }}" href="{{ route('prospects.index') }}">
                        <span class="nav-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                <path fill="currentColor" d="m17 21l1.8 1.77c.5.5 1.2.1 1.2-.49V18l2.8-3.4A1 1 0 0 0 22 13h-7c-.8 0-1.3 1-.8 1.6L17 18zm-2-1H2v-3c0-2.7 5.3-4 8-4c.6 0 1.3.1 2.1.2c-.2.6-.1 1.3.1 1.9c-.7-.1-1.5-.2-2.2-.2c-3 0-6.1 1.5-6.1 2.1v1.1h10.6l.5.6zM10 4C7.8 4 6 5.8 6 8s1.8 4 4 4s4-1.8 4-4s-1.8-4-4-4m0 6c-1.1 0-2-.9-2-2s.9-2 2-2s2 .9 2 2s-.9 2-2 2" />
                            </svg>
                        </span>
                        <span class="nav-text">Prospects</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('clients.*') ? 'active' : '' }}" href="{{ route('clients.index') }}">
                        <span class="nav-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                <g fill="none" fill-rule="evenodd">
                                    <path d="m12.594 23.258l-.012.002l-.071.035l-.02.004l-.014-.004l-.071-.036q-.016-.004-.024.006l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.016-.018m.264-.113l-.014.002l-.184.093l-.01.01l-.003.011l.018.43l.005.012l.008.008l.201.092q.019.005.029-.008l.004-.014l-.034-.614q-.005-.019-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.003-.011l.018-.43l-.003-.012l-.01-.01z" />
                                    <path fill="currentColor" d="M6 7a5 5 0 1 1 10 0A5 5 0 0 1 6 7m5-3a3 3 0 1 0 0 6a3 3 0 0 0 0-6M4.413 17.601c-.323.41-.413.72-.413.899c0 .118.035.232.205.384c.197.176.55.37 1.11.543c1.12.346 2.756.521 4.706.563a1 1 0 1 1-.042 2c-1.997-.043-3.86-.221-5.254-.652c-.696-.216-1.354-.517-1.852-.962C2.347 19.906 2 19.274 2 18.5c0-.787.358-1.523.844-2.139c.494-.625 1.177-1.2 1.978-1.69C6.425 13.695 8.605 13 11 13q.671 0 1.316.07a1 1 0 0 1-.211 1.989Q11.564 15 11 15c-2.023 0-3.843.59-5.136 1.379c-.647.394-1.135.822-1.45 1.222Zm16.8-3.567a2.5 2.5 0 0 0-3.536 0l-3.418 3.417a1.5 1.5 0 0 0-.424.849l-.33 2.308a1 1 0 0 0 1.133 1.133l2.308-.33a1.5 1.5 0 0 0 .849-.424l3.417-3.418a2.5 2.5 0 0 0 0-3.535Zm-2.122 1.414a.5.5 0 0 1 .707.707l-3.3 3.3l-.825.118l.118-.825z" />
                                </g>
                            </svg>
                        </span>
                        <span class="nav-text">Clients</span>
                    </a>
                </li>
            @endrole

            @role('')
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
            @endrole

            @role('')
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
            @endrole

            @role('')
                <li class="menu-title">Personal</li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}" href="{{ route('profile.index') }}">
                        <span class="nav-icon">
                            <i class="ri-group-line"></i>
                        </span>
                        <span class="nav-text">My Profile</span>
                    </a>
                </li>
            @endrole

            @role('master')
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
