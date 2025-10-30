@extends('auth.layout')
@section('content')
    <!-- Content -->
   <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Login -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center mb-4">
                <a href="{{ url('/') }}" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo">
                    <!--InventoryPro&deg; SVG Logo -->
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

              <h4 class="mb-2">Welcome Back 👋</h4>
              <p class="mb-4">Please sign in to your account</p>

              <!-- ✅ Laravel Login Form -->
              <form id="formAuthentication" class="mb-3" method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="form-control @error('email') is-invalid @enderror"
                    placeholder="Enter your email"
                    required
                    autofocus
                  />
                  @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>

                <!-- Password -->
                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Password</label>
                    @if (Route::has('password.request'))
                      <a href="{{ route('password.request') }}">
                        <small>Forgot Password?</small>
                      </a>
                    @endif
                  </div>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control @error('password') is-invalid @enderror"
                      name="password"
                      required
                      autocomplete="current-password"
                      placeholder="••••••••••••"
                      aria-describedby="password"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                  @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>

                <!-- Remember Me -->
                <div class="mb-3">
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      name="remember"
                      id="remember"
                      {{ old('remember') ? 'checked' : '' }}
                    />
                    <label class="form-check-label" for="remember">Remember Me</label>
                  </div>
                </div>

                <!-- Submit -->
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit">{{ __('Login') }}</button>
                </div>
              </form>

              <!-- Register -->
              <p class="text-center">
                <span>New to our platform?</span>
                @if (Route::has('register'))
                  <a href="{{ route('register') }}"><span>Create an account</span></a>
                @endif
              </p>
            </div>
          </div>
          <!-- /Login -->
        </div>
      </div>
    </div>
    <!-- / Content -->

@endsection
