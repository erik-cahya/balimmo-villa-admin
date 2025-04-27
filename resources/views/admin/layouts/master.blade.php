<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="utf-8" />
     <title>Analytics | Lahomes - Real Estate Management Admin Template</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta name="description" content="A fully responsive premium admin dashboard template, Real Estate Management Admin Template" />
     <meta name="author" content="Techzaa" />
     <meta http-equiv="X-UA-Compatible" content="IE=edge" />

     <!-- App favicon -->
     <link rel="shortcut icon" href="{{ asset('admin') }}/assets/images/favicon.ico">

     <!-- Vendor css (Require in all Page) -->
     <link href="{{ asset('admin') }}/assets/css/vendor.min.css" rel="stylesheet" type="text/css" />
     <!-- Icons css (Require in all Page) -->
     <link href="{{ asset('admin') }}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
     <!-- App css (Require in all Page) -->
     <link href="{{ asset('admin') }}/assets/css/app.css" rel="stylesheet" type="text/css" />
     <!-- Theme Config js (Require in all Page) -->
     <script src="{{ asset('admin') }}/assets/js/config.min.js"></script>

     @stack('style')
</head>

<body>

     <div class="wrapper">

          <!-- ========== Topbar Start ========== -->
          @include('admin.layouts.header')
          @include('admin.layouts.sidebar')

          <!-- Start right Content here -->
          <div class="page-content">
                @yield('content')
                @include('admin.layouts.footer')
          </div>
     </div>


     <!-- Vendor Javascript (Require in all Page) -->
     <script src="{{ asset('admin') }}/assets/js/vendor.js"></script>

     <!-- App Javascript (Require in all Page) -->
     <script src="{{ asset('admin') }}/assets/js/app.js"></script>

     @stack('scripts')


    

</body>

</html>