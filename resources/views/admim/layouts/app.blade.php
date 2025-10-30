<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default">
<head>
  <meta charset="utf-8" />
  <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <title>@yield('title', 'Dashboard - InventoryPro')</title>

  <!-- CSS & Fonts -->
  <link rel="icon" type="image/x-icon" href="{{ asset('admin/assets/img/favicon/favicon.ico') }}" />
  <link rel="stylesheet" href="{{ asset('admin/assets/vendor/fonts/boxicons.css') }}" />
  <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/core.css') }}" />
  <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/theme-default.css') }}" />
  <link rel="stylesheet" href="{{ asset('admin/assets/css/demo.css') }}" />
  <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />



</head>

<body class="layout-navbar-fixed">
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

      {{-- Sidebar --}}
      @include('admim.layouts.sidebar')

      <!-- Layout page -->
      <div class="layout-page">

        {{-- Header --}}
        @include('admim.layouts.header')

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <div class="container-xxl flex-grow-1 container-p-y">
            @yield('content')
          </div>

          {{-- Footer --}}
          @include('admim.layouts.footer')
        </div>
        <!-- / Content wrapper -->

      </div>
      <!-- / Layout page -->
    </div>
  </div>


</body>
</html>
