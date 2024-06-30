<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>500 Server Error</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="500" name="description" />
    <meta content="khayrulshanto" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('backend') }}/assets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="{{ asset('backend') }}/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet"
        type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('backend') }}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('backend') }}/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="account-pages my-5 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @if (Auth::check())
                        @if (Auth::user()->roles->pluck('name')[0] == 'Admin' ||
                                Auth::user()->roles->pluck('name')[0] == 'Super Admin' ||
                                Auth::user()->roles->pluck('name')[0] == 'Manager' ||
                                Auth::user()->roles->pluck('name')[0] == 'User')
                            <div class="text-center mb-5">
                                <h1 class="display-2 fw-medium">5<i
                                        class="bx bx-buoy bx-spin text-primary display-3"></i>0
                                </h1>
                                <h4 class="text-uppercase">Internal Server Error.</h4>
                            </div>
                        @else
                            <div class="text-center mb-5">
                                <h1 class="display-2 fw-medium">5<i
                                        class="bx bx-buoy bx-spin text-warning display-3"></i>0
                                </h1>
                                <h4 class="text-uppercase">Internal Server Error.</h4>
                            </div>
                        @endif
                    @else
                        <div class="text-center mb-5">
                            <h1 class="display-2 fw-medium">5<i class="bx bx-buoy bx-spin text-warning display-3"></i>0
                            </h1>
                            <h4 class="text-uppercase">Internal Server Error.</h4>
                        </div>
                    @endif
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8 col-xl-6">
                    <div>
                        <img src="{{ asset('backend') }}/assets/images/error-img.png" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('backend') }}/assets/libs/jquery/jquery.min.js"></script>
    <script src="{{ asset('backend') }}/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('backend') }}/assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="{{ asset('backend') }}/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="{{ asset('backend') }}/assets/libs/node-waves/waves.min.js"></script>
    <!-- MAIN SCRIPT -->
    <script src="{{ asset('backend') }}/assets/js/app.js"></script>

</body>

</html>
