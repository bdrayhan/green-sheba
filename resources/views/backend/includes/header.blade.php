<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="#" name="description" />
    <meta content="#" name="digital-hub solution ltd." />
    <!-- X-CSRF-TOKEN -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin | @yield('admin-title')</title>

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('backend') }}/assets/images/favicon.ico">

    @method('backend-style')

    <link href="{{ asset('backend') }}/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend') }}/assets/libs/spectrum-colorpicker2/spectrum.min.css" rel="stylesheet" type="text/css">
    <!-- Plugins css -->
    <link href="{{ asset('backend') }}/assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />
    <!-- Toster Notification -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/assets/libs/toastr/build/toastr.min.css">
    <!-- Sweet Alert-->
    <link href="{{ asset('backend') }}/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <!-- DataTables -->
    <link href="{{ asset('backend') }}/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend') }}/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css"
        rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{ asset('backend') }}/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css"
        rel="stylesheet" type="text/css" />
    <!-- DatePicker Css -->
    <link href="{{ asset('backend') }}/assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/libs/%40chenfengyuan/datepicker/datepicker.min.css">
    {{-- Text Editor --}}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <!-- ---------------------------- DEFAULT -------------------------------- -->
    <!-- Bootstrap Css -->
    <link href="{{ asset('backend') }}/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet"
        type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('backend') }}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('backend') }}/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <!-- Custom Css-->
    <link href="{{ asset('backend') }}/assets/css/custom.css" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body data-sidebar="dark" data-layout-mode="light" data-topbar="light">
    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner-chase">
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
            </div>
        </div>
    </div>
    <!-- <body data-layout="horizontal" data-topbar="dark"> -->
    <div id="layout-wrapper">
