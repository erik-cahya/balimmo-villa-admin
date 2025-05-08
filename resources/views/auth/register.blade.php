<!DOCTYPE html>
<html lang="en">

<head>
     <!-- Title Meta -->
     <meta charset="utf-8" />
     <title>Sign Up | Lahomes - Real Estate Management Admin Template</title>
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

     <style> .border-red{border-color: #d03f3f} </style>

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

                                   <h2 class="fw-bold text-uppercase text-center fs-18">Free Account</h2>
                                   <p class="text-muted text-center mt-1 mb-4">New to our platform? Sign up now! It only takes a minute.</p>

                                   <div class="px-4">
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf
                                             <div class="mb-3">
                                                  <label class="form-label" for="name">Name</label>
                                                  <input type="text" id="name" name="name" value="{{ old('name') }}"  class="form-control bg-light bg-opacity-50 border-light py-2" placeholder="Enter your name">
                                             </div>

                                             <div class="mb-3">
                                                  <label class="form-label" for="initial_name">Initial Name</label>
                                                  <input type="text" id="initial_name" name="initial_name" value="{{ old('initial_name') }}"  class="form-control bg-light bg-opacity-50 border-light py-2" placeholder="Enter your name">
                                             </div>

                                            @error('name')
                                                <div class="invalid-tooltip d-block position-static mt-1">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                             <div class="mb-3">
                                                  <label class="form-label" for="email">Email</label>
                                                  <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control bg-light bg-opacity-50 border-light py-2" placeholder="Enter your email">
                                             </div>

                                             @error('email')
                                                <div class="invalid-tooltip d-block position-static mt-1">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                             <div class="mb-3">
                                                  <label class="form-label" for="password">Password</label>
                                                  <input type="password" id="password" name="password" autocomplete="new-password" class="form-control bg-light bg-opacity-50 border-light py-2" placeholder="Enter your password">
                                             </div>
                                             @error('password')
                                                <div class="invalid-tooltip d-block position-static mt-1">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                             <div class="mb-3">
                                                  <label class="form-label" for="password_confirmation">Password Confirmation</label>
                                                  <input type="password" id="password_confirmation" name="password_confirmation" autocomplete="new-password" class="form-control bg-light bg-opacity-50 border-light py-2" placeholder="Enter your password">
                                             </div>

                                             @error('password_confirmation')
                                                <div class="invalid-tooltip d-block position-static mt-1">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                            <div class="mb-3">
                                                  <label class="form-label" for="password_confirmation">Select Role</label>
                                                  <select name="role" id="role" class="form-control" required>
                                                       <option value="" selected>Select Role User</option>
                                                       <option value="master">Master</option>
                                                       <option value="agent">Agent</option>
                                                  </select>

                                            </div>

                                             <div class="mb-1 text-center d-grid">
                                                  <button class="btn btn-danger py-2" type="submit">Create Account</button>
                                             </div>
                                        </form>

                                   </div> <!-- end col -->
                              </div> <!-- end card-body -->
                         </div> <!-- end card -->

                         <p class="mb-0 text-center text-white">I already have an account <a href="{{ route('login') }}" class="text-reset text-unline-dashed fw-bold ms-1">Sign In</a></p>
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
