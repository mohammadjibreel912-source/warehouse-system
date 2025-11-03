<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            color: #212529;
            min-height: 100vh;
        }
        .navbar {
            border-radius: 0.75rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }
        .hero {
            padding: 5rem 1rem;
            text-align: center;
        }
        .hero h1 {
            font-weight: 600;
            margin-bottom: 1rem;
        }
        .hero p {
            color: #6c757d;
            font-size: 1.1rem;
        }
        footer {
            text-align: center;
            padding: 1.5rem 0;
            color: #6c757d;
        }
    </style>
</head>

<body>

    <div class="container py-4">
        @if (Route::has('login'))
            <nav class="navbar navbar-expand-lg bg-white shadow-sm px-4 py-3 mb-4">
                <div class="container-fluid">
                    <a class="navbar-brand fw-semibold text-primary" href="#">
                        {{ config('app.name', 'Laravel') }}
                    </a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                        <ul class="navbar-nav align-items-center">
                            @auth
                                @php
                                    $user = Auth::user();
                                    $role = $user->role;

                                    $roleDashboard = match($role) {
                                        'admin' => ['url' => url('/admin/dashboard'), 'label' => 'Admin Dashboard'],
                                        'warehouse_manager' => ['url' => url('/warehouse'), 'label' => 'Warehouse Manager'],
                                        'sales' => ['url' => url('/sales'), 'label' => 'Sales Dashboard'],
                                        'purchases' => ['url' => url('/purchases'), 'label' => 'Purchases Dashboard'],
                                        'accountant' => ['url' => url('/accounting'), 'label' => 'Accounting Panel'],
                                        default => ['url' => url('/dashboard'), 'label' => 'User Dashboard'],
                                    };
                                @endphp

                                <li class="nav-item">
                                    <a class="btn btn-primary me-2" href="{{ $roleDashboard['url'] }}">
                                        {{ $roleDashboard['label'] }}
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-secondary">Log out</button>
                                    </form>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="btn btn-primary me-2" href="{{ route('login') }}">Log in</a>
                                </li>

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="btn btn-outline-secondary" href="{{ route('register') }}">Register</a>
                                    </li>
                                @endif
                            @endauth
                        </ul>
                    </div>
                </div>
            </nav>
        @endif

        <!-- Hero Section -->
        <section class="hero bg-white rounded-4 shadow-sm">
            <h1>Welcome to {{ config('app.name', 'Laravel') }}</h1>
            <p class="lead">
        Efficiently manage your inventory, track stock movements, and keep every item accounted for with precision.
        The Warehouse system helps you stay organized, improve workflow, and ensure your operations run smoothly every day.
            </p>
        </section>

        <!-- Footer -->
        <footer class="mt-5">
            <small>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.</small>
        </footer>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
