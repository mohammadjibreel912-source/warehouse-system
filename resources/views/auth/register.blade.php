@extends('auth.layout')

@section('content')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
      <!-- Register Card -->
      <div class="card">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center mb-4">
            <a href="{{ url('/') }}" class="app-brand-link gap-2">
              <span class="app-brand-logo demo">
                <!--InventoryPro&deg; Logo -->
                <svg width="25" viewBox="0 0 25 42" xmlns="http://www.w3.org/2000/svg">
                  <defs>
                    <path d="M13.79,0.36 L3.39,7.44 C0.56,9.69 -0.38,12.47 0.55,15.79 ..." id="path-1"></path>
                  </defs>
                  <use fill="#696cff" xlink:href="#path-1"></use>
                </svg>
              </span>
              <span class="app-brand-text demo text-body fw-bolder">Explore360&deg;</span>
            </a>
          </div>
          <!-- /Logo -->

          <h4 class="mb-2">Adventure starts here 🚀</h4>
          <p class="mb-4">Create your account to start managing your app!</p>

          <!-- ✅ Laravel Register Form -->
          <form id="formAuthentication" class="mb-3" method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input
                id="name"
                type="text"
                class="form-control @error('name') is-invalid @enderror"
                name="name"
                value="{{ old('name') }}"
                required
                autocomplete="name"
                autofocus
                placeholder="Enter your name"
              />
              @error('name')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
              @enderror
            </div>

            <!-- Email -->
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input
                id="email"
                type="email"
                class="form-control @error('email') is-invalid @enderror"
                name="email"
                value="{{ old('email') }}"
                required
                autocomplete="email"
                placeholder="Enter your email"
              />
              @error('email')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
              @enderror
            </div>

            <!-- Password -->
            <div class="mb-3 form-password-toggle">
              <label class="form-label" for="password">Password</label>
              <div class="input-group input-group-merge">
                <input
                  id="password"
                  type="password"
                  class="form-control @error('password') is-invalid @enderror"
                  name="password"
                  required
                  autocomplete="new-password"
                  placeholder="••••••••••••"
                  aria-describedby="password"
                />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
              </div>
              @error('password')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
              @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-3 form-password-toggle">
              <label class="form-label" for="password-confirm">Confirm Password</label>
              <div class="input-group input-group-merge">
                <input
                  id="password-confirm"
                  type="password"
                  class="form-control"
                  name="password_confirmation"
                  required
                  autocomplete="new-password"
                  placeholder="••••••••••••"
                />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
              </div>
            </div>

            <!-- Terms and Conditions -->
            <div class="mb-3">
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="checkbox"
                  id="terms-conditions"
                  name="terms"
                  required
                />
                <label class="form-check-label" for="terms-conditions">
                  I agree to the <a href="#">privacy policy & terms</a>
                </label>
              </div>
            </div>

            <!-- Submit -->
            <div class="mb-3">
              <button class="btn btn-primary d-grid w-100" type="submit">{{ __('Register') }}</button>
            </div>
          </form>

          <!-- Already Registered -->
          <p class="text-center">
            <span>Already have an account?</span>
            <a href="{{ route('login') }}"><span>Sign in instead</span></a>
          </p>
        </div>
      </div>
      <!-- /Register Card -->
    </div>
  </div>
</div>
@endsection
