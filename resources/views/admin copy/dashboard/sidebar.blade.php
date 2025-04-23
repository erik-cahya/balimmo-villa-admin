<nav class="sidebar">
    <div class="sidebar-header">
      <a href="#" class="sidebar-brand">
        Noble<span>UI</span>
      </a>
      <div class="sidebar-toggler not-active">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
    <div class="sidebar-body">
      <ul class="nav">
        <li class="nav-item nav-category">Main</li>
        <li class="nav-item">
          <a href="{{ url('/') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Dashboard</span>
          </a>
        </li>
        <li class="nav-item nav-category">web apps</li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#email" role="button" aria-expanded="" aria-controls="email">
            <i class="link-icon" data-feather="mail"></i>
            <span class="link-title">Email</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="email">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="{{ url('/email/inbox') }}" class="nav-link">Inbox</a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/email/read') }}" class="nav-link">Read</a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/email/compose') }}" class="nav-link">Compose</a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a href="{{ url('/apps/chat') }}" class="nav-link">
            <i class="link-icon" data-feather="message-square"></i>
            <span class="link-title">Chat</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('/apps/calendar') }}" class="nav-link">
            <i class="link-icon" data-feather="calendar"></i>
            <span class="link-title">Calendar</span>
          </a>
        </li>

        <li class="nav-item nav-category">Docs</li>
        <li class="nav-item">
          <a href="https://www.nobleui.com/laravel/documentation/docs.html" target="_blank" class="nav-link">
            <i class="link-icon" data-feather="hash"></i>
            <span class="link-title">Documentation</span>
          </a>
        </li>
      </ul>
    </div>
  </nav>
  <nav class="settings-sidebar">
    <div class="sidebar-body">
      <a href="#" class="settings-sidebar-toggler">
        <i data-feather="settings"></i>
      </a>
      <h6 class="text-muted mb-2">Sidebar:</h6>
      <div class="mb-3 pb-3 border-bottom">
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarLight" value="sidebar-light" checked>
            Light
          </label>
        </div>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarDark" value="sidebar-dark">
            Dark
          </label>
        </div>
      </div>
      <div class="theme-wrapper">
        <h6 class="text-muted mb-2">Light Version:</h6>
        <a class="theme-item active" href="https://www.nobleui.com/laravel/template/demo1/">
          <img src="{{ url('assets/images/screenshots/light.jpg') }}" alt="light version">
        </a>
        <h6 class="text-muted mb-2">Dark Version:</h6>
        <a class="theme-item" href="https://www.nobleui.com/laravel/template/demo2/">
          <img src="{{ url('assets/images/screenshots/dark.jpg') }}" alt="light version">
        </a>
      </div>
    </div>
  </nav>