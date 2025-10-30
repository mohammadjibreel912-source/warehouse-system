@extends('admim.layouts.app')
@section('content')

        @include('admim.layouts.sidebar')

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">

        <!-- Dashboard Cards -->
        <div class="row g-4 mb-4">

            <!-- Total Warehouses -->
            <div class="col-md-3">
                <div class="card shadow-sm border-0 h-100 text-center hover-shadow">
                    <div class="card-body">
                        <i class="bx bx-map fs-1 text-primary mb-2"></i>
                        <h6 class="text-muted mb-1">Total Warehouses</h6>
                        <h3 class="fw-bold">{{ $totalWarehouses }}</h3>
                    </div>
                </div>
            </div>

            <!-- Total Products -->
            <div class="col-md-3">
                <div class="card shadow-sm border-0 h-100 text-center hover-shadow">
                    <div class="card-body">
                        <i class="bx bx-box fs-1 text-success mb-2"></i>
                        <h6 class="text-muted mb-1">Total Products</h6>
                        <h3 class="fw-bold">{{ $totalProducts }}</h3>
                    </div>
                </div>
            </div>

            <!-- Total Suppliers -->
            <div class="col-md-3">
                <div class="card shadow-sm border-0 h-100 text-center hover-shadow">
                    <div class="card-body">
                        <i class="bx bx-car fs-1 text-info mb-2"></i>
                        <h6 class="text-muted mb-1">Total Suppliers</h6>
                        <h3 class="fw-bold">{{ $totalSuppliers }}</h3>
                    </div>
                </div>
            </div>

            <!-- Total Customers -->
            <div class="col-md-3">
                <div class="card shadow-sm border-0 h-100 text-center hover-shadow">
                    <div class="card-body">
                        <i class="bx bx-user-circle fs-1 text-warning mb-2"></i>
                        <h6 class="text-muted mb-1">Total Customers</h6>
                        <h3 class="fw-bold">{{ $totalCustomers }}</h3>
                    </div>
                </div>
            </div>

        </div>

        <div class="row g-4 mb-4">

            <!-- Total Purchases -->
            <div class="col-md-3">
                <div class="card shadow-sm border-0 h-100 text-center hover-shadow">
                    <div class="card-body">
                        <i class="bx bx-cart fs-1 text-danger mb-2"></i>
                        <h6 class="text-muted mb-1">Total Purchases</h6>
                        <h3 class="fw-bold">{{ $totalPurchases }}</h3>
                    </div>
                </div>
            </div>

            <!-- Total Sales -->
            <div class="col-md-3">
                <div class="card shadow-sm border-0 h-100 text-center hover-shadow">
                    <div class="card-body">
                        <i class="bx bx-money fs-1 text-danger mb-2"></i>
                        <h6 class="text-muted mb-1">Total Sales</h6>
                        <h3 class="fw-bold">{{ $totalSales }}</h3>
                    </div>
                </div>
            </div>

            <!-- Total Leases -->
            <div class="col-md-3">
                <div class="card shadow-sm border-0 h-100 text-center hover-shadow">
                    <div class="card-body">
                        <i class="bx bx-file fs-1 text-secondary mb-2"></i>
                        <h6 class="text-muted mb-1">Total Leases</h6>
                        <h3 class="fw-bold">{{ $totalLeases }}</h3>
                    </div>
                </div>
            </div>

            <!-- Revenue This Month -->
            <div class="col-md-3">
                <div class="card shadow-sm border-0 h-100 text-center hover-shadow">
                    <div class="card-body">
                        <i class="bx bx-dollar fs-1 text-success mb-2"></i>
                        <h6 class="text-muted mb-1">Revenue (This Month)</h6>
                        <h3 class="fw-bold">${{ number_format($monthlyRevenue, 2) }}</h3>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>



                </div>

                <!-- Footer -->
                <footer class="content-footer footer bg-footer-theme mt-4">
                    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                        <div class="mb-2 mb-md-0">
                            © {{ date('Y') }}, made with ❤️ by
                            <a href="https://InventoryPro.com" target="_blank" class="footer-link fw-bolder">InventoryPro</a>
                        </div>
                        <div>


                        </div>
                    </div>
                </footer>
                <!-- /Footer -->

            </div>

<!-- Chart.js -->





@endsection
