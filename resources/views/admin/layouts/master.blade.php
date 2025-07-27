<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Dashboard | Balimmo Properties - Real Estate</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Balimmo Properties - Real Estate" />
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

    {{-- Sweet Alert CDN --}}
    <link href="{{ asset('admin') }}/assets/css/sweetalert2.min.css" rel="stylesheet">
    <style>
        .validation-form {
            border-color: #e96767 !important;
        }

        .validation-message {
            top: 100%;
            z-index: 5;
            max-width: 100%;
            padding: .3125rem .625rem;
            font-size: .7875rem;
            color: #fff;
            background-color: var(--bs-danger);
            border-radius: var(--bs-border-radius);
        }
    </style>

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

    {{-- <script src="{{ asset('js/sweetalert2.min.js') }}"></script> --}}
    <script src="{{ asset('admin') }}/assets/js/components/extended-sweetalert.js"></script>

    <!-- Vendor Javascript (Require in all Page) -->
    <script src="{{ asset('admin') }}/assets/js/vendor.js"></script>

    <!-- App Javascript (Require in all Page) -->
    <script src="{{ asset('admin') }}/assets/js/app.js"></script>

    {{-- <script src="{{ asset('admin/assets/js/iconify.min.js') }}"></script> --}}

    {{-- <script src="{{ asset('admin') }}/assets/js/components/form-flatepicker.js"></script> --}}

    <script>
        @if (session('flashData'))
            var flashData = @json(session('flashData'));

            Swal.fire({
                title: flashData.judul,
                text: flashData.pesan,
                icon: flashData.swalFlashIcon,
                confirmButtonText: 'OK'
            });
        @endif
    </script>

    @stack('scripts')

</body>

</html>
