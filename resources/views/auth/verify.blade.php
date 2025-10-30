@extends('layouts.app')

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
                            <span class="app-brand-text demo text-body fw-bolder">InventoryPro&deg;</span>
                        </a>
                    </div>
                    <!-- /Logo -->

                    <h4 class="mb-2 text-center">{{ __('Verify Your Email Address 📧') }}</h4>

                    @if (session('resent'))
                        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <p class="text-muted text-center mt-4">
                        {{ __('Before proceeding, please check your email for a verification link.') }}
                    </p>

                    <p class="text-muted text-center">
                        {{ __('If you did not receive the email, you can request another one below.') }}
                    </p>

                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <div class="d-grid mt-3">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Click here to request another') }}
                            </button>
                        </div>
                    </form>

                    <p class="text-center mt-4 mb-0">
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
