<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>@yield('title')</title>

    {{-- Style --}}
    @stack('prepend-style')
    @include('includes.style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.css"/>
    @stack('addon-style')
  </head>

  <body>
    {{-- Page Dashboard --}}
    <div class="page-dashboard">
      <div class="d-flex" id="wrapper" data-aos="fade-right">
        {{-- Sidebar --}}
        @include('includes.admin.sidebar')
        {{-- Page Content --}}
        <div id="page-content-wrapper">
          {{-- Navbar --}}
          @include('includes.admin.navbar')
          {{-- Content --}}
          @yield('content')
        </div>
      </div>
    </div>

    {{-- Script --}}
    @stack('prepend-script')
    @include('includes.script')
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.js"></script>
    <script>
      $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
      });
    </script>
    @stack('addon-script')
  </body>
</html>
