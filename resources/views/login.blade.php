<!DOCTYPE html>
<html lang="en">

<head>

    <title>Car Auction | Login</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/logo.jpg">
    <!-- preloader css -->
    <link rel="stylesheet" href="assets/css/preloader.min.css" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

</head>
<!--All Vertical Pages-->

<body>
    <div class="auth-page">
        <div class="container-fluid p-0">
            <div class="row g-0">
                <div class="col-xxl-3 col-lg-4 col-md-5">
                    <div class="auth-full-page-content d-flex p-sm-5 p-4">
                        <div class="w-100">
                            <div class="d-flex flex-column h-100">
                                <div class="mb-4 mb-md-5 text-center">
                                    <a href="index.php" class="d-block auth-logo">
                                     <span
                                            class="logo-txt">Car Auction</span>
                                    </a>
                                </div>
                                <div class="auth-content my-auto">
                                    <div class="text-center">
                                        <h5 class="mb-0">Welcome Back !</h5>
                                        <p class="text-muted mt-2">Sign in to continue</p>
                                    </div>
                                    <form class="custom-form mt-4 pt-2" action="{{ route('loginpost') }}"
                                        method="post">
                                        @csrf
                                        {{-- has-error --}}
                                        <div class="mb-3 ">
                                            <label class="form-label" for="email">Email</label>
                                            <input type="text" class="form-control" id="email"
                                                placeholder="Enter Email" name="email">

                                        </div>
                                        {{-- has-error --}}
                                        <div class="mb-3 ">
                                            <div class="d-flex align-items-start">
                                                <div class="flex-grow-1">
                                                    <label class="form-label" for="password">Password</label>
                                                </div>
                                            </div>

                                            <div class="input-group auth-pass-inputgroup">
                                                <input type="password" class="form-control" placeholder="Enter password"
                                                    name="password" aria-label="Password"
                                                    aria-describedby="password-addon">
                                                <button class="btn btn-light ms-0" type="button" id="password-addon"><i
                                                        class="mdi mdi-eye-outline"></i></button>

                                            </div>


                                        </div>
                                        
                                        <div class="mb-3">
                                            <ul style="list-style: none;">
                                                @php
                                                    foreach ($errors->all() as $message) {
                                                        echo '<li>' . $message . '</li>';
                                                    }
                                                @endphp
                                            </ul>
                                            @if (Session::has('error'))
                                                <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">
                                                    {{ Session::get('error') }}</p>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <button class="btn btn-primary w-100 waves-effect waves-light"
                                                type="submit">Log In</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="mt-4 mt-md-5 text-center">
                                    <p class="mb-0">©
                                        <script>
                                            document.write(new Date().getFullYear())
                                        </script> Car auction <i
                                            class="mdi mdi-heart text-primary"></i>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end auth full page content -->
                </div>
                <!-- end col -->
                <div class="col-xxl-9 col-lg-8 col-md-7">
                    <div class="auth-bg pt-md-5 p-4 d-flex">
                        <div class="bg-overlay bg-primary"></div>
                        <ul class="bg-bubbles">
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                        <!-- end bubble effect -->
                        
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container fluid -->
    </div>
    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <!-- pace js -->
    <script src="assets/libs/pace-js/pace.min.js"></script>
    <!-- password addon init -->
    <script src="assets/js/pages/pass-addon.init.js"></script>

</body>

</html>
