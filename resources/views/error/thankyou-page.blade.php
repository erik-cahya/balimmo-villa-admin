<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Title Meta -->
    <meta charset="utf-8" />
    <title>Thankyou | Balimmo Properties</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully responsive premium admin dashboard template, Real Estate Management Admin Template" />
    <meta name="author" content="Techzaa" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Vendor css (Require in all Page) -->
    <link href="{{ asset('admin') }}/assets/css/vendor.min.css" rel="stylesheet" type="text/css" />

    <!-- Icons css (Require in all Page) -->
    <link href="{{ asset('admin') }}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />

    <!-- App css (Require in all Page) -->
    <link href="{{ asset('admin') }}/assets/css/app.min.css" rel="stylesheet" type="text/css" />

    <!-- Theme Config js (Require in all Page) -->
    <script src="assets/js/config.min.js"></script>
</head>

<body class="authentication-bg">

    <div class="account-pages pt-sm-5 pb-sm-5 pb-4 pt-2">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <div class="card auth-card">
                        <div class="card-body p-0">
                            <div class="row align-items-center g-0">
                                <div class="col">
                                    <div class="p-4">
                                        <div class="mx-auto mb-4 text-center">
                                            <div class="auth-logo mx-auto text-center">
                                                <a href="index.html" class="logo-dark">
                                                    <img src="{{ asset('admin') }}/assets/images/logo-dark.png" height="32" alt="logo dark">
                                                </a>

                                                <a href="index.html" class="logo-light">
                                                    <img src="{{ asset('admin') }}/assets/images/logo-light.png" height="28" alt="logo light">
                                                </a>
                                            </div>

                                            {{-- <img src="{{ asset('admin') }}/assets/images/404.svg" alt="auth" height="250" class="mb-3 mt-5" /> --}}

                                            <h3 class="text-dark p-4">Thankyou</h3>

                                            <h2 class="fs-22 lh-base">Thankyou!!</h2>
                                            <p class="text-muted mb-4 mt-1">Please check your email to get suitable villa recommendations from us. <br> If you don't get the email, please check your spam folder.</p>

                                            <div class="text-center">
                                                <a href="{{ route('landing-page.index') }}" class="btn btn-danger">Back to Home</a>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->

                        </div> <!-- end card-body -->
                    </div> <!-- end card -->

                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
    </div>

    <!-- Vendor Javascript (Require in all Page) -->
    <script src="assets/js/vendor.js"></script>

    <!-- App Javascript (Require in all Page) -->
    <script src="assets/js/app.js"></script>

</body>

</html>
