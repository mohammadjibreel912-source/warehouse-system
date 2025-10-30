<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title', 'Pacific Travel Agency')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/core.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/theme-default.css') }}">
    <!-- Add other CSS files -->
</head>
<body>

    {{-- Layout wrapper --}}
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">

        {{-- Sidebar --}}
        @include('admim.layouts.sidebar')

        {{-- Layout page --}}
        <div class="layout-page">

          {{-- Header / Navbar --}}
          @include('admim.layouts.header')

          {{-- Content wrapper --}}
          <div class="content-wrapper">
            <main class="container-xxl flex-grow-1 container-p-y">
                @yield('content')
            </main>

            {{-- Footer --}}
            @include('admim.layouts.footer')
          </div>
          {{-- / Content wrapper --}}
        </div>
        {{-- / Layout page --}}
      </div>
      {{-- / Layout container --}}
    </div>
    {{-- / Layout wrapper --}}

    <!-- JS -->
    <script src="{{ asset('admin/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/js/bootstrap.js') }}"></script>
    <!-- Add other JS files -->

</body>
</html>
