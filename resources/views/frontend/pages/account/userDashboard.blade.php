@extends('frontend.layouts.app')
@section('frontend-title', 'Home')
@section('web.content')
    <!--start page wrapper -->
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
