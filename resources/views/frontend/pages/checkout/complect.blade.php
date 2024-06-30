@extends('frontend.layouts.app')
@section('frontend-title', 'Order Complect')
@section('web.content')
    {{-- @dd($data) --}}
    <!--start breadcrumb-->
    <section class="py-3 border-bottom border-top d-none d-md-flex bg-light">
        <div class="container">
            <div class="page-breadcrumb d-flex align-items-center">
                <h3 class="breadcrumb-title pe-3">Checkout</h3>
                <div class="ms-auto">
                    <nav aria-label="breadcrumb">
                        <ol class="p-0 mb-0 breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('web.home') }}"><i class="bx bx-home-alt"></i>
                                    Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Order Complete</li>
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
            <div class="py-3 card mt-sm-3">
                <div class="text-center card-body">
                    <h2 class="pb-3 h4">Thank you for your order!</h2>
                    <p class="mb-2 fs-sm">
                        {{ $basicSetting->thanks_notes  }}
                    </p>
                    </p>
                    <a class="mt-3 btn btn-light rounded-0 me-3" href="{{ route('web.home') }}">Go back shopping</a>
                </div>
            </div>
        </div>
    </section>
    <!--end shop cart-->
@endsection
