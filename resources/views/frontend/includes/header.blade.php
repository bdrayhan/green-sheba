<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">


<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="keywords" content="shopping, ecommerce">
    <meta name="description"
        content="Bangladesh&#39;s best online shopping store with 1.5+ million products at resounding discounts in dhaka, ctg &amp; All across Bangladesh with cash on delivery (COD)">


    <meta property="og:url" content="https://www.amardeshamarponno.com/" />
    <meta property="og:type" content="website">
    <meta property="og:title" content="Online Shopping in Bangladesh: Order Now from amardeshamarponno.com" />
    <meta property="og:description"
        content="Bangladesh&#39;s best online shopping store with 1.5+ million products at resounding discounts in dhaka, ctg &amp; All across Bangladesh with cash on delivery (COD)" />
    <meta property="og:image" content="#">

    <title>
        @if (Route::currentRouteName() === 'web.home')
            {{ $basicSetting->basic_company }}
        @else
            @yield('frontend-title')
        @endif
    </title>

    <!--favicon-->
    <link rel="icon"
        href="{{ asset(appSetting()['basic_setting']->basic_favicon) ?? asset('frontend/images/favicon-32x32.png') }}"
        type="image/png" />
    <!--plugins-->
    <link href="{{ asset('frontend') }}/assets/plugins/OwlCarousel/css/owl.carousel.min.css" rel="stylesheet" />

    <link href="{{ asset('frontend') }}/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <!-- loader-->
    <link href="{{ asset('frontend') }}/assets/css/pace.min.css" rel="stylesheet" />
    <script src="{{ asset('frontend') }}/assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('frontend') }}/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Albert+Sans:wght@300;400;500;600&amp;display=swap"
        rel="stylesheet">

    <!-- Sweet Alert-->
    <link href="{{ asset('backend') }}/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

    <link href="{{ asset('frontend') }}/assets/css/app.css" rel="stylesheet">
    <link href="{{ asset('frontend') }}/assets/css/boxicons.min.css" rel="stylesheet">
    <link href="{{ asset('frontend') }}/assets/css/icons.css" rel="stylesheet">
    <link href="{{ asset('frontend') }}/assets/css/custom.css" rel="stylesheet">

    @php
        $analytics = App\Models\Analytics::firstOrFail();
    @endphp
    <!-- Website Analytics -->
    {!! $analytics->google_analytic !!}
    {!! $analytics->facebook_pixel !!}
    {!! $analytics->bing_analytic !!}
    <!-- Website Verification -->
    {!! $analytics->google_site_verification !!}
    {!! $analytics->facebook_site_verification !!}
    {!! $analytics->bing_site_verification !!}
    {!! $analytics->bing_site_verification !!}
    <!-- Custom Header Script -->
    {!! $analytics->custom_header_script !!}
</head>

<body>
