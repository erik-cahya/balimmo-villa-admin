<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Title Meta -->
    <meta charset="utf-8" />
    <title>Sign In | Balimmo Properties - Real Estate</title>
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
    <link href="{{ asset('admin') }}/assets/css/app.min.css" rel="stylesheet" type="text/css" />

    <!-- Theme Config js (Require in all Page) -->
    <script src="{{ asset('admin') }}/assets/js/config.min.js"></script>

</head>

<body class="authentication-bg">

    <div class="account-pages pt-sm-5 pb-sm-5 pb-4 pt-2">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-5">
                    <div class="card auth-card">
                        <div class="card-body px-3 py-5">
                            <div class="auth-logo mx-auto mb-4 text-center">
                                <a href="index.html" class="logo-dark">
                                    <img src="{{ asset('admin') }}/assets/images/logo-dark.png" height="32" alt="logo dark">
                                </a>

                                <a href="index.html" class="logo-light">
                                    <img src="{{ asset('admin') }}/assets/images/logo-light.png" height="28" alt="logo light">
                                </a>
                            </div>

                            <h2 class="fw-bold text-uppercase fs-18 text-center">Sign In</h2>
                            <p class="text-muted mb-2 mt-1 text-center">Enter your email address and password to access admin panel.</p>

                            @error('email')
                                <div class="alert alert-danger alert-icon m-3" role="alert">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm bg-danger d-flex justify-content-center align-items-center fs-18 me-2 flex-shrink-0 rounded">
                                            <i class="bx bx-info-circle text-white"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            {{ $message }}
                                        </div>
                                    </div>
                                </div>
                            @enderror

                            <div class="px-4">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="email" id="email" name="email" class="form-control bg-light border-light bg-opacity-50 py-2" placeholder="Enter your email" value="{{ old('email') }}" required autofocus>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="password">Password</label>
                                        <input type="password" id="password" name="password" class="form-control bg-light border-light bg-opacity-50 py-2" placeholder="Enter your password" required>
                                        {{-- <a href="{{ route('password.request') }}" class="text-muted text-unline-dashed float-end ms-1">Reset password</a> --}}
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" name="remember" class="form-check-input" id="checkbox-signin">
                                            <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                        </div>
                                    </div>

                                    <div class="d-grid mb-1 text-center">
                                        <button class="btn btn-danger fw-medium py-2" type="submit">Sign In</button>
                                    </div>
                                </form>
                            </div> <!-- end col -->
                        </div> <!-- end card-body -->
                    </div> <!-- end card -->

                    {{-- <p class="mb-0 text-center text-white">New here? <a href="{{ route('register') }}" class="text-reset text-unline-dashed fw-bold ms-1">Sign Up</a></p> --}}

                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
    </div>

    <!-- Vendor Javascript (Require in all Page) -->
    <script src="{{ asset('admin') }}/assets/js/vendor.js"></script>

    <!-- App Javascript (Require in all Page) -->
    <script src="{{ asset('admin') }}/assets/js/app.js"></script>

</body>

</html>
