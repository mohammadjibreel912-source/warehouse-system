@extends('admim.layouts.app')

@section('content')
<style>
    /* لإعطاء مساحة كافية أسفل الهيدر */
    .content-wrapper {
        overflow-x: hidden;
    }

    /* تنسيق الكروت */
    .card {
        border-radius: 0.75rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        transition: all 0.25s ease-in-out;
        background: #fff;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
    }

    .card-body i {
        display: block;
    }

    /* تصحيح التباعد بين الصفوف */
    .row {
        margin-bottom: 1rem;
    }

    /* جعل التصميم متجاوب */
    @media (max-width: 768px) {
        .col-md-3 {
            flex: 0 0 50%;
            max-width: 50%;
        }
    }

    @media (max-width: 576px) {
        .col-md-3 {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }
</style>

<div class="">
    <div class="container-xxl flex-grow-1 container-p-y">

        <!-- Dashboard Cards Row 1 -->
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="bx bx-map fs-1 text-primary mb-2"></i>
                        <h6 class="text-muted mb-1">Total Warehouses</h6>
                        <h3 class="fw-bold">{{ $totalWarehouses }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <i class="bx bx-box fs-1 text-success mb-2"></i>
                        <h6 class="text-muted mb-1">Total Products</h6>
                        <h3 class="fw-bold">{{ $totalProducts }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <i class="bx bx-car fs-1 text-info mb-2"></i>
                        <h6 class="text-muted mb-1">Total Suppliers</h6>
                        <h3 class="fw-bold">{{ $totalSuppliers }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <i class="bx bx-user-circle fs-1 text-warning mb-2"></i>
                        <h6 class="text-muted mb-1">Total Customers</h6>
                        <h3 class="fw-bold">{{ $totalCustomers }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dashboard Cards Row 2 -->
        <div class="row g-4 mb-4">
            <div class="col-md-3 col-sm-6">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <i class="bx bx-cart fs-1 text-danger mb-2"></i>
                        <h6 class="text-muted mb-1">Total Purchases</h6>
                        <h3 class="fw-bold">{{ $totalPurchases }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <i class="bx bx-money fs-1 text-danger mb-2"></i>
                        <h6 class="text-muted mb-1">Total Sales</h6>
                        <h3 class="fw-bold">{{ $totalSales }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <i class="bx bx-file fs-1 text-secondary mb-2"></i>
                        <h6 class="text-muted mb-1">Total Leases</h6>
                        <h3 class="fw-bold">{{ $totalLeases }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="card text-center h-100">
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


<!-- /Footer -->

@endsection
