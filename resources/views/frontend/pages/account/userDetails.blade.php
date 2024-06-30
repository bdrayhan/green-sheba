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
                        <h3 class="breadcrumb-title pe-3">Account Details</h3>
                        <div class="ms-auto">
                            <nav aria-label="breadcrumb">
                                <ol class="p-0 mb-0 breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('web.home') }}"><i
                                                class="bx bx-home-alt"></i>
                                            Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('web.user.account') }}">Account</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">My Details</li>
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
                                    <div class="mb-0 border shadow-none card">
                                        <div class="card-body">
                                            <form class="row g-3" action="{{ route('web.user.details.update') }}"
                                                method="POST">
                                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                @csrf
                                                <div class="col-md-6">
                                                    <label class="form-label">First Name</label>
                                                    <input value="{{ Auth::user()->first_name }}" name="first_name"
                                                        type="text" class="form-control" placeholder="First Name">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Last Name</label>
                                                    <input value="{{ Auth::user()->last_name }}" name="last_name"
                                                        type="text" class="form-control" placeholder="Last Name">
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label">Email address</label>
                                                    <input disabled type="text" class="form-control"
                                                        value="{{ $user->email }}" placeholder="Email">
                                                </div>
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-dark btn-ecomm">Update
                                                        Information</button>
                                                </div>
                                            </form>
                                            <hr>
                                            <form class="row g-3" action="{{ route('web.user.password.change') }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                <div class="col-12">
                                                    <label class="form-label">Current Password</label>
                                                    <input required name="current_password" type="text"
                                                        class="form-control" placeholder="xxxxxxxxxxxx">
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label">New Password</label>
                                                    <input required name="new_password" type="text" class="form-control"
                                                        placeholder="*************">
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label">Confirm New Password</label>
                                                    <input required name="confirm_password" type="text"
                                                        class="form-control" placeholder="*************">
                                                </div>
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-dark btn-ecomm">Password
                                                        Changes</button>
                                                </div>
                                            </form>
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
