@extends('auth.layout')

@section('content')
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <!-- Card -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center mb-4">
                        <a href="{{ url('/') }}" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo">
                                <svg width="25" viewBox="0 0 25 42" xmlns="http://www.w3.org/2000/svg">
                                    <defs>
                                        <path
                                            d="M13.79,0.36 L3.39,7.44 C0.56,9.69 -0.38,12.47 0.55,15.79 ..."
                                            id="path-1"
                                        ></path>
                                    </defs>
                                    <use fill="#696cff" xlink:href="#path-1"></use>
                                </svg>
                            </span>
                            <span class="app-brand-text demo text-body fw-bolder">Explore360&deg;</span>
                        </a>
                    </div>
                    <!-- /Logo -->

                    <h4 class="mb-2 text-center">{{ __('Forgot your password? 🔒') }}</h4>
                    <p class="mb-4 text-center text-muted">Enter your email and we’ll send you a link to reset your password.</p>

                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <input
                                id="email"
                                type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autocomplete="email"
                                autofocus
                                placeholder="Enter your email"
                            >

                            @error('email')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary d-grid w-100">
                                {{ __('Send Password Reset Link') }}
                            </button>
                        </div>
                    </form>

                    <p class="text-center mt-3">
                        <a href="{{ route('login') }}" class="text-decoration-none">
                            <i class="bx bx-chevron-left"></i> {{ __('Back to login') }}
                        </a>
                    </p>
                </div>
            </div>
            <!-- /Card -->
        </div>
    </div>
</div>
@endsection
