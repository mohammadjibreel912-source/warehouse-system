@extends('auth.layout')

@section('content')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner py-4">
      <!-- Reset Password -->
      <div class="card">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center mb-3">
            <a href="{{ url('/') }}" class="app-brand-link gap-2">
              <span class="app-brand-logo demo">
                <!-- يمكنك الاحتفاظ بشعارك SVG هنا -->
              </span>
              <span class="app-brand-text demo text-body fw-bolder">Explore360&deg;</span>
            </a>
          </div>
          <!-- /Logo -->

          <h4 class="mb-2">Reset Password 🔒</h4>
          <p class="mb-4">Enter your new password below</p>

          <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <!-- Email -->
            <div class="mb-3">
              <label for="email" class="form-label">Email Address</label>
              <input
                type="email"
                id="email"
                name="email"
                class="form-control @error('email') is-invalid @enderror"
                value="{{ $email ?? old('email') }}"
                required
                autocomplete="email"
                autofocus
              >
              @error('email')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
              @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
              <label for="password" class="form-label">New Password</label>
              <input
                type="password"
                id="password"
                name="password"
                class="form-control @error('password') is-invalid @enderror"
                required
                autocomplete="new-password"
              >
              @error('password')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
              @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">
              <label for="password-confirm" class="form-label">Confirm Password</label>
              <input
                type="password"
                id="password-confirm"
                name="password_confirmation"
                class="form-control"
                required
                autocomplete="new-password"
              >
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary d-grid w-100">Reset Password</button>
          </form>

          <div class="text-center mt-3">
            <a href="{{ route('login') }}" class="d-flex align-items-center justify-content-center">
              <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
              Back to login
            </a>
          </div>
        </div>
      </div>
      <!-- /Reset Password -->
    </div>
  </div>
</div>
@endsection
