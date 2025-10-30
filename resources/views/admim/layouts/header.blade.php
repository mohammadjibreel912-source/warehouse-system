<div class="layout-navbar shadow-sm bg-navbar-theme">
  <nav class="navbar navbar-expand-xl align-items-center">
    <div class="container-fluid">

      <!-- Sidebar toggle for mobile -->
      <div class="layout-menu-toggle navbar-nav d-xl-none me-3">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
          <i class="bx bx-menu bx-sm"></i>
        </a>
      </div>

      <!-- Right side -->
      <ul class="navbar-nav ms-auto align-items-center">

        <!-- Notifications -->
        <li class="nav-item dropdown me-3">
          <a class="nav-link dropdown-toggle position-relative" href="#" id="notificationDropdown"
             data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bx bx-bell bx-sm"></i>
            @if(isset($unreadCount) && $unreadCount > 0)
              <span class="badge bg-danger rounded-pill position-absolute top-0 start-100 translate-middle">{{ $unreadCount }}</span>
            @endif
          </a>
          <ul class="dropdown-menu dropdown-menu-end p-2" aria-labelledby="notificationDropdown" style="width: 300px;">
            @forelse($unreadNotifications ?? [] as $notification)
              <li class="dropdown-item d-flex justify-content-between align-items-start">
                <div>
                  <div class="fw-bold">{{ $notification->type }}</div>
                  <small class="text-truncate d-block" style="max-width: 200px;">{{ $notification->message }}</small>
                  <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                </div>
                <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST">
                  @csrf
                  <button class="btn btn-sm btn-outline-success ms-2">✓</button>
                </form>
              </li>
              <li><hr class="dropdown-divider"></li>
            @empty
              <li class="dropdown-item text-center text-muted">No unread notifications</li>
            @endforelse
            <li class="text-center">
              <a href="{{ route('notifications.index') }}" class="text-primary text-decoration-none">View All</a>
            </li>
          </ul>
        </li>

        <!-- User Dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown"
             data-bs-toggle="dropdown" aria-expanded="false">
            <img src="{{ auth()->user()->profile_image ?? asset('admin/assets/img/avatars/1.png') }}"
                 alt="Avatar" class="rounded-circle me-2" width="32" height="32">
            <span class="fw-medium">{{ auth()->user()->name ?? 'User' }}</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
            <li>
              <a class="dropdown-item" href="{{ route('users.edit', auth()->user()->id ?? 1) }}">
                <i class="bx bx-user me-2"></i> Edit Profile
              </a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="dropdown-item">
                  <i class="bx bx-log-out me-2"></i> Logout
                </button>
              </form>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</div>
