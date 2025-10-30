<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme shadow-sm">
  <div class="app-brand demo py-3 px-3">
    <a href="{{ route('admin.dashboard') }}" class="app-brand-link d-flex align-items-center">
      <span class="app-brand-logo demo me-2">
        <!-- SVG Logo هنا -->
      </span>
      <span class="app-brand-text fw-bolder">InventoryPro&deg;</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1" style="border-left: none !important;">

    <!-- Dashboard -->
    <li class="menu-item">
      <a href="{{ route('admin.dashboard') }}" class="menu-link d-flex align-items-center">
        <i class="menu-icon tf-icons bx bx-home-circle text-primary me-2"></i>
        <div>Dashboard</div>
      </a>
    </li>

    <!-- Warehouses -->
    <li class="menu-header small text-uppercase text-muted mt-3">
      <i class="bx bx-building me-1"></i>Warehouses
    </li>
    <li class="menu-item">
      <a href="{{ route('warehouses.index') }}" class="menu-link d-flex align-items-center">
        <i class="menu-icon tf-icons bx bx-map text-success me-2"></i>
        <div>View Warehouses</div>
      </a>
    </li>

    <!-- Products -->
    <li class="menu-header small text-uppercase text-muted mt-3">
      <i class="bx bx-box me-1"></i>Products
    </li>
    <li class="menu-item">
      <a href="{{ route('products.index') }}" class="menu-link d-flex align-items-center">
        <i class="menu-icon tf-icons bx bx-grid text-warning me-2"></i>
        <div>View Products</div>
      </a>
    </li>

    <!-- Suppliers & Customers -->
    <li class="menu-header small text-uppercase text-muted mt-3">
      <i class="bx bx-briefcase me-1"></i>Suppliers & Customers
    </li>
    <li class="menu-item">
      <a href="{{ route('suppliers.index') }}" class="menu-link d-flex align-items-center">
        <i class="menu-icon tf-icons bx bx-car text-info me-2"></i>
        <div>Suppliers</div>
      </a>
    </li>
    <li class="menu-item">
      <a href="{{ route('customers.index') }}" class="menu-link d-flex align-items-center">
        <i class="menu-icon tf-icons bx bx-user-circle text-info me-2"></i>
        <div>Customers</div>
      </a>
    </li>

    <!-- Transactions -->
    <li class="menu-header small text-uppercase text-muted mt-3">
      <i class="bx bx-transfer-alt me-1"></i>Transactions
    </li>
    <li class="menu-item">
      <a href="{{ route('purchases.index') }}" class="menu-link d-flex align-items-center">
        <i class="menu-icon tf-icons bx bx-cart text-danger me-2"></i>
        <div>Purchases</div>
      </a>
    </li>
    <li class="menu-item">
      <a href="{{ route('sales.index') }}" class="menu-link d-flex align-items-center">
        <i class="menu-icon tf-icons bx bx-money text-danger me-2"></i>
        <div>Sales</div>
      </a>
    </li>

    <!-- Leases -->
    <li class="menu-header small text-uppercase text-muted mt-3">
      <i class="bx bx-file me-1"></i>Leases
    </li>
    <li class="menu-item">
      <a href="{{ route('leases.index') }}" class="menu-link d-flex align-items-center">
        <i class="menu-icon tf-icons bx bx-file text-secondary me-2"></i>
        <div>Lease Contracts</div>
      </a>
    </li>

    <!-- Settings -->
    <li class="menu-header small text-uppercase text-muted mt-3">
      <i class="bx bx-cog me-1"></i>Settings
    </li>
    <li class="menu-item">
      <a href="{{ route('users.index') }}" class="menu-link d-flex align-items-center">
        <i class="menu-icon tf-icons bx bx-user-check text-success me-2"></i>
        <div>Manage Users</div>
      </a>
    </li>
    <li class="menu-item">
      <form action="{{ route('logout') }}" method="POST" class="d-inline w-100">
        @csrf
        <button type="submit" class="menu-link btn btn-link text-start w-100 d-flex align-items-center">
          <i class="menu-icon tf-icons bx bx-log-out text-danger me-2"></i>
          <div>Logout</div>
        </button>
      </form>
    </li>
  </ul>
</aside>


