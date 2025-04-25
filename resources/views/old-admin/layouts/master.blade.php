<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="Balimmo Properties Admin Panel">
	<meta name="author" content="Balimmo Properties">

  <title>Balimmo - System Admin Management</title>

  <!-- Fonts -->
  {{-- <link rel="preconnect" href="https://fonts.googleapis.com"> --}}
  {{-- <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> --}}
  {{-- <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet"> --}}

  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&family=Geist+Mono:wght@100..900&display=swap" rel="stylesheet">
  <!-- End fonts -->
  
  <!-- CSRF Token -->
  <meta name="_token" content="{{ csrf_token() }}">
  
  <link rel="shortcut icon" href="{{ asset('/admin//favicon.ico') }}">
  
  
  <!-- plugin css -->
  <link href="{{ asset('/admin/assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('/admin/assets/fonts/feather-font/css/iconfont.css') }}" rel="stylesheet" />
  <link href="{{ asset('/admin/assets/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" />
  <!-- end plugin css -->

  @stack('plugin-styles')

  <!-- common css -->
  <link href="{{ asset('/admin/css/app.css') }}" rel="stylesheet" />
  <!-- end common css -->

  @stack('style')
</head>
<body data-base-url="{{url('/')}}">

  <script src="{{ asset('/admin/assets/js/spinner.js') }}"></script>

  <div class="main-wrapper" id="app">
    @include('admin.layouts.sidebar')
    <div class="page-wrapper">
      @include('admin.layouts.header')
      <div class="page-content">
        @yield('content')
      </div>
      @include('admin.layouts.footer')
    </div>
  </div>

    <!-- base js -->
    <script src="{{ asset('/admin/js/app.js') }}"></script>
    <script src="{{ asset('/admin/assets/plugins/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('/admin/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <!-- end base js -->

    <!-- plugin js -->
    @stack('plugin-scripts')
    <!-- end plugin js -->

    <!-- common js -->
    <script src="{{ asset('/admin/assets/js/template.js') }}"></script>
    <!-- end common js -->

    @stack('custom-scripts')
</body>
</html>