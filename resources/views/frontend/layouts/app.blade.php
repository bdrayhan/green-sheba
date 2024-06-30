@php
    $socialSetting = App\Models\SocialSetting::where('sm_status', 1)->firstOrFail();
    $analytics = App\Models\Analytics::where('id', 1)->firstOrFail();
    $contactInfo = App\Models\ContactInfo::where('id', 1)->firstOrFail();
    $basicSetting = App\Models\BasicSetting::where('id', 1)->firstOrFail();
    $navigation = App\Models\Page::where('page_status', 1)
        ->limit(3)
        ->get();
@endphp
@include('frontend.includes.header')
<!--wrapper-->
<div class="wrapper">
    <!--start top header wrapper-->
    @if (!(Route::currentRouteName() == 'login' || Route::currentRouteName() == 'register'))
        @include('frontend.includes.navbar')
    @endif
    <!--end top header wrapper-->

    <!--start page wrapper -->
    @yield('web.content')
    <!--end page wrapper -->
    <!--start footer section-->
    @if (!(Route::currentRouteName() == 'login' || Route::currentRouteName() == 'register'))
        @include('frontend.includes.topFooter')
    @endif
    <!--end footer section-->
    <!--Start Back To Top Button-->
    <a href="javaScript:;" class="back-to-top">
        <i class='bx bxs-up-arrow-alt'></i>
    </a>
    <!--End Back To Top Button-->
</div>
<!--end wrapper-->
@include('frontend.includes.footer')
