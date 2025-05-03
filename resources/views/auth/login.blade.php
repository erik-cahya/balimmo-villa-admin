<!DOCTYPE html>
<html lang="en">

<head>
     <!-- Title Meta -->
     <meta charset="utf-8" />
     <title>Sign In | Lahomes - Real Estate Management Admin Template</title>
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
     <link href="{{ asset('admin') }}/assets/css/app.min.css" rel="stylesheet" type="text/css" />

     <!-- Theme Config js (Require in all Page) -->
     <script src="{{ asset('admin') }}/assets/js/config.min.js"></script>

</head>

<body class="authentication-bg">

     <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
          <div class="container">
               <div class="row justify-content-center">
                    <div class="col-xl-5">
                         <div class="card auth-card">
                              <div class="card-body px-3 py-5">
                                   <div class="mx-auto mb-4 text-center auth-logo">
                                        <a href="index.html" class="logo-dark">
                                             <img src="{{ asset('admin') }}/assets/images/logo-dark.png" height="32" alt="logo dark">
                                        </a>

                                        <a href="index.html" class="logo-light">
                                             <img src="{{ asset('admin') }}/assets/images/logo-light.png" height="28" alt="logo light">
                                        </a>
                                   </div>

                                   <h2 class="fw-bold text-uppercase text-center fs-18">Sign In</h2>
                                   <p class="text-muted text-center mt-1 mb-4">Enter your email address and password to access admin panel.</p>

                                   <div class="px-4">
                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf
                                             <div class="mb-3">
                                                  <label class="form-label" for="email">Email</label>
                                                  <input type="email" id="email" name="email" class="form-control bg-light bg-opacity-50 border-light py-2" placeholder="Enter your email" value="{{ old('email') }}" required autofocus>
                                             </div>

                                             <div class="mb-3">
                                                 <label class="form-label" for="password">Password</label>
                                                 <input type="password" id="password" name="password" class="form-control bg-light bg-opacity-50 border-light py-2" placeholder="Enter your password" required>
                                                 <a href="{{ route('password.request') }}" class="float-end text-muted text-unline-dashed ms-1">Reset password</a>
                                             </div>

                                             <div class="mb-3">
                                                  <div class="form-check">
                                                       <input type="checkbox" name="remember" class="form-check-input" id="checkbox-signin">
                                                       <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                                  </div>
                                             </div>

                                             <div class="mb-1 text-center d-grid">
                                                  <button class="btn btn-danger py-2 fw-medium" type="submit">Sign In</button>
                                             </div>
                                        </form>
                                   </div> <!-- end col -->
                              </div> <!-- end card-body -->
                         </div> <!-- end card -->

                         <p class="mb-0 text-center text-white">New here? <a href="{{ route('register') }}" class="text-reset text-unline-dashed fw-bold ms-1">Sign Up</a></p>

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
