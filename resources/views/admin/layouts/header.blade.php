<header class="">
    <div class="topbar">
    <div class="container-fluid">
         <div class="navbar-header">
              <div class="d-flex align-items-center gap-2">
                   <!-- Menu Toggle Button -->
                   <div class="topbar-item">
                        <button type="button" class="button-toggle-menu topbar-button">
                             <i class="ri-menu-2-line fs-24"></i>
                        </button>
                   </div>

                   <!-- App Search-->
                   <form class="app-search d-none d-md-block me-auto">
                        <div class="position-relative">
                             <input type="search" class="form-control border-0" placeholder="Search..." autocomplete="off" value="">
                             <i class="ri-search-line search-widget-icon"></i>
                        </div>
                   </form>
              </div>

              <div class="d-flex align-items-center gap-1">
                   <!-- Theme Color (Light/Dark) -->
                   <span class="badge badge-soft-warning me-1 text-capitalize">{{ Auth::user()->role }} Users</span>

                   <div class="topbar-item">
                        <button type="button" class="topbar-button" id="light-dark-mode">
                             <i class="ri-moon-line fs-24 light-mode"></i>
                             <i class="ri-sun-line fs-24 dark-mode"></i>
                        </button>
                   </div>

                   <!-- Category -->
                   <div class="dropdown topbar-item d-none d-lg-flex">
                        <button type="button" class="topbar-button" data-toggle="fullscreen">
                             <i class="ri-fullscreen-line fs-24 fullscreen"></i>
                             <i class="ri-fullscreen-exit-line fs-24 quit-fullscreen"></i>
                        </button>
                   </div>

                   <!-- Theme Setting -->
                   <div class="topbar-item d-none d-md-flex">
                        <button type="button" class="topbar-button" id="theme-settings-btn" data-bs-toggle="offcanvas" data-bs-target="#theme-settings-offcanvas" aria-controls="theme-settings-offcanvas">
                             <i class="ri-settings-4-line fs-24"></i>
                        </button>
                   </div>

                   <!-- User -->
                   <div class="dropdown topbar-item">
                        <a type="button" class="topbar-button" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             <span class="d-flex align-items-center">
                                  <img class="rounded-circle" width="32" src="{{ asset('admin') }}/assets/images/users/avatar-1.jpg" alt="avatar-3">
                             </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                             <!-- item-->
                             <h6 class="dropdown-header">Welcome {{ Auth::user()->name }}!</h6>
                   
                             <a class="dropdown-item" href="pages-calendar.html">
                                  <iconify-icon icon="solar:calendar-broken" class="align-middle me-2 fs-18"></iconify-icon><span class="align-middle">My Schedules</span>
                             </a>

                             <a class="dropdown-item" href="pages-pricing.html">
                                  <iconify-icon icon="solar:wallet-broken" class="align-middle me-2 fs-18"></iconify-icon><span class="align-middle">Pricing</span>
                             </a>
                             <a class="dropdown-item" href="pages-faqs.html">
                                  <iconify-icon icon="solar:help-broken" class="align-middle me-2 fs-18"></iconify-icon><span class="align-middle">Help</span>
                             </a>
                             <a class="dropdown-item" href="auth-lock-screen.html">
                                  <iconify-icon icon="solar:lock-keyhole-broken" class="align-middle me-2 fs-18"></iconify-icon><span class="align-middle">Lock screen</span>
                             </a>

                             <div class="dropdown-divider my-1"></div>

                             <form action="{{ route('logout') }}" method="POST">
                                   @csrf
                                   <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault();this.closest('form').submit();">
                                        <iconify-icon icon="solar:logout-3-broken" class="align-middle me-2 fs-18"></iconify-icon><span class="align-middle">Logout</span>
                                   </a>
                             </form>
                        </div>
                   </div>
              </div>
         </div>
    </div></div>
</header>

<!-- Right Sidebar (Theme Settings) -->
<div>
    <div class="offcanvas offcanvas-end border-0 rounded-start-4 overflow-hidden" tabindex="-1" id="theme-settings-offcanvas">
         <div class="d-flex align-items-center bg-primary p-3 offcanvas-header">
              <h5 class="text-white m-0">Theme Settings</h5>
              <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="offcanvas" aria-label="Close"></button>
         </div>

         <div class="offcanvas-body p-0">
              <div data-simplebar class="h-100">
                   <div class="p-3 settings-bar">

                        <div>
                             <h5 class="mb-3 font-16 fw-semibold">Color Scheme</h5>

                             <div class="form-check mb-2">
                                  <input class="form-check-input" type="radio" name="data-bs-theme" id="layout-color-light" value="light">
                                  <label class="form-check-label" for="layout-color-light">Light</label>
                             </div>

                             <div class="form-check mb-2">
                                  <input class="form-check-input" type="radio" name="data-bs-theme" id="layout-color-dark" value="dark">
                                  <label class="form-check-label" for="layout-color-dark">Dark</label>
                             </div>
                        </div>

                        <div>
                             <h5 class="my-3 font-16 fw-semibold">Topbar Color</h5>

                             <div class="form-check mb-2">
                                  <input class="form-check-input" type="radio" name="data-topbar-color" id="topbar-color-light" value="light">
                                  <label class="form-check-label" for="topbar-color-light">Light</label>
                             </div>
                             <div class="form-check mb-2">
                                  <input class="form-check-input" type="radio" name="data-topbar-color" id="topbar-color-dark" value="dark">
                                  <label class="form-check-label" for="topbar-color-dark">Dark</label>
                             </div>
                        </div>


                        <div>
                             <h5 class="my-3 font-16 fw-semibold">Menu Color</h5>

                             <div class="form-check mb-2">
                                  <input class="form-check-input" type="radio" name="data-menu-color" id="leftbar-color-light" value="light">
                                  <label class="form-check-label" for="leftbar-color-light">
                                       Light
                                  </label>
                             </div>

                             <div class="form-check mb-2">
                                  <input class="form-check-input" type="radio" name="data-menu-color" id="leftbar-color-dark" value="dark">
                                  <label class="form-check-label" for="leftbar-color-dark">
                                       Dark
                                  </label>
                             </div>
                        </div>

                        <div>
                             <h5 class="my-3 font-16 fw-semibold">Sidebar Size</h5>

                             <div class="form-check mb-2">
                                  <input class="form-check-input" type="radio" name="data-menu-size" id="leftbar-size-default" value="default">
                                  <label class="form-check-label" for="leftbar-size-default">
                                       Default
                                  </label>
                             </div>

                             <div class="form-check mb-2">
                                  <input class="form-check-input" type="radio" name="data-menu-size" id="leftbar-size-small" value="condensed">
                                  <label class="form-check-label" for="leftbar-size-small">
                                       Condensed
                                  </label>
                             </div>

                             <div class="form-check mb-2">
                                  <input class="form-check-input" type="radio" name="data-menu-size" id="leftbar-hidden" value="hidden">
                                  <label class="form-check-label" for="leftbar-hidden">
                                       Hidden
                                  </label>
                             </div>

                             <div class="form-check mb-2">
                                  <input class="form-check-input" type="radio" name="data-menu-size" id="leftbar-size-small-hover-active" value="sm-hover-active">
                                  <label class="form-check-label" for="leftbar-size-small-hover-active">
                                       Small Hover Active
                                  </label>
                             </div>

                             <div class="form-check mb-2">
                                  <input class="form-check-input" type="radio" name="data-menu-size" id="leftbar-size-small-hover" value="sm-hover">
                                  <label class="form-check-label" for="leftbar-size-small-hover">
                                       Small Hover
                                  </label>
                             </div>
                        </div>

                   </div>
              </div>
         </div>
         <div class="offcanvas-footer border-top p-3 text-center">
              <div class="row">
                   <div class="col">
                        <button type="button" class="btn btn-danger w-100" id="reset-layout">Reset</button>
                   </div>
              </div>
         </div>
    </div>
</div>