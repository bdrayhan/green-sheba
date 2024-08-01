@extends('frontend.layouts.app')
@section('frontend-title', 'Dashboard')
@section('web.content')
    <!--start page wrapper -->

    {{-- <div class="container mt-5">
        <div class="row">
            <div class="col-md-5">
                <div class="side_menu_part shadow text-center">
                    <div class="profile_image_part">
                        <div class="profile_image">
                            <img src="{{asset('frontend')}}/assets/images/avatars/avatar-1.png" alt="">
                        </div>
                        <div class="mt-4">
                        <h5>{{Auth::user()->first_name}}</h5>
                        <p>Joined {{Auth::user()->created_at}}</p>
                        </div>
                    </div>
                    <div class="profile_dashboard_content">
                        <div class="mt-5 text-start mb-5">
                            <div id="list-example" class="list-group dashboard_content_items">
                                <a class="list-group-item list-group-item-action active" type="button" data-bs-toggle="tab" data-bs-target="#dashboard"><i class="fas fa-home me-2"></i> Dashboard</a>
                                <a class="list-group-item list-group-item-action " type="button" data-bs-toggle="tab" data-bs-target="#profile"><i class="fas fa-user-circle me-2"></i> Profile</a>
                                <a class="list-group-item list-group-item-action " type="button" data-bs-toggle="tab" data-bs-target="#address"><i class="fas fa-map-marker-alt me-2"></i> Address</a>
                                <a class="list-group-item list-group-item-action " type="button" data-bs-toggle="tab" data-bs-target="#order"><i class="fab fa-shopify me-2"></i> Order</a>
                                <a class="list-group-item list-group-item-action " type="button" data-bs-toggle="tab" data-bs-target="#wishlist"><i class="fas fa-heart me-2"></i> Wishlist</a>
                                <a class="list-group-item list-group-item-action" type="button" data-bs-toggle="tab" data-bs-target="#facilities"><i class="fas fa-trash me-2"></i> Delete Account</a>
                                <a class="list-group-item list-group-item-action waves-effect" href="{{ route('logout') }}"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt me-2"></i> Log out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            {{-- <div class="col-md-7">
                <div class="side_menu_content_part">
                    <div>
                        <div class="tab-content text-black mb-5" id="nav-tabContent">
                            @include('frontend.pages.account.includes.dashboard')
                            @include('frontend.pages.account.includes.profile')
                            @include('frontend.pages.account.includes.address')
                            @include('frontend.pages.account.includes.order')
                            @include('frontend.pages.account.includes.wishlist')
        
                        </div>
                    </div>
                </div>
            </div> --}
        </div>
    </div> --}}
    <div class="page-wrapper">
        <div class="page-content">
            <!--start breadcrumb-->
            <section class="py-3 border-bottom border-top d-none d-md-flex bg-light">
                <div class="container">
                    <div class="page-breadcrumb d-flex align-items-center">
                        <h3 class="breadcrumb-title pe-3">My Account</h3>
                        <div class="ms-auto">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0">
                                    <li class="breadcrumb-item"><a href="{{ route('web.home') }}"><i
                                                class="bx bx-home-alt"></i>
                                            Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="javascript:;">Account</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </section>
            <!--end breadcrumb-->
            <!--start shop cart-->
            <section class="py-4">
                <div class="container">
                    <h3 class="d-none">Account</h3>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                @include('frontend.pages.account.profilebar')
                                <div class="col-lg-8">
                                    <div class="card shadow-none mb-0">
                                        <div class="card-body">
                                            <p>Hello <strong>{{ Auth::user()->name }}</strong> (not
                                                <strong>{{ Auth::user()->name }}?</strong> <a href="javascript:;"
                                                    onclick="document.getElementById('logout-form').submit();">Logout</a>)
                                            </p>
                                            <p>From your account dashboard you can view your Recent Orders, manage your
                                                shipping and billing addesses and edit your password and account details</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end row-->
                        </div>
                    </div>
                </div>
            </section>
            <!--end shop cart-->
        </div>
    </div>
    <!--end page wrapper -->
@endsection
