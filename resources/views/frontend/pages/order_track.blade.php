@extends('frontend.layouts.app')
@section('frontend-title', 'Order Track')
@section('web.content')
    <!--start breadcrumb-->
    <section class="py-3 border-bottom border-top d-none d-md-flex bg-light">
        <div class="container">
            <div class="page-breadcrumb d-flex align-items-center">
                <h3 class="breadcrumb-title pe-3">Tracking</h3>
                <div class="ms-auto">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('web.home') }}"><i class="bx bx-home-alt"></i>
                                    Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('web.our.store') }}">Shop</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Order Tracking</li>
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
            <h6 class="mb-0">Order ID: OD45345345435</h6>
            <hr>
            <div class="row row-cols-1 row-cols-lg-4 rounded-4 gx-3 m-0 border">
                <div class="col p-4 text-center border-end">
                    <h6 class="mb-1">Estimated Delivery time:</h6>
                    <p class="mb-0">24 Apr 2021</p>
                </div>
                <div class="col p-4 text-center border-end">
                    <h6 class="mb-1">Shipping BY:</h6>
                    <p class="mb-0">BLUEDART | +91-9910XXXX</p>
                </div>
                <div class="col p-4 text-center border-end">
                    <h6 class="mb-1">Status:</h6>
                    <p class="mb-0">Picked by the courier</p>
                </div>
                <div class="col p-4 text-center">
                    <h6 class="mb-1">Tracking #:</h6>
                    <p class="mb-0">BD045903594059</p>
                </div>
            </div>
            <!--end row-->
            <div class="mt-3"></div>
            <div class="checkout-payment">
                <div class="card bg-transparent rounded-0 shadow-none">
                    <div class="card-body">
                        <div class="steps steps-light">
                            <a class="step-item active" href="javascript:;">
                                <div class="step-progress"><span class="step-count"><i class='bx bx-check'></i></span>
                                </div>
                                <div class="step-label">Order confirmed</div>
                            </a>
                            <a class="step-item active" href="javascript:;">
                                <div class="step-progress"><span class="step-count"><i class='bx bx-user-circle'></i></span>
                                </div>
                                <div class="step-label">Picked by courier</div>
                            </a>
                            <a class="step-item" href="javascript:;">
                                <div class="step-progress"><span class="step-count"><i class='bx bx-car'></i></span>
                                </div>
                                <div class="step-label">On the way</div>
                            </a>
                            <a class="step-item" href="javascript:;">
                                <div class="step-progress"><span class="step-count"><i class='bx bx-planet'></i></span>
                                </div>
                                <div class="step-label">Ready for pickup</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--end shop cart-->
@endsection
