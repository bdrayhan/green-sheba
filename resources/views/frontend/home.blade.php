@extends('frontend.layouts.app')
@section('frontend-title', 'Home')
@section('web.content')
<!--start slider section-->
@if (count($banners) > 0)
@include('frontend.includes.slider')
@endif
<!--end slider section-->
<div class="page-wrapper">
    <div class="page-content">
        <!-- Start Category Show -->
{{--        <section class="py-4">--}}
{{--            <div class="container">--}}
{{--                <div class="row row-cols-3 row-cols-lg-6 g-4">--}}
{{--                    @foreach ($headerCategory as $feature)--}}
{{--                        <a href="{{ route('web.single.category', $feature->category->pc_url) }}">--}}
{{--                            <div class="col">--}}
{{--                                <div class="text-center border rounded-3 p-3 bg-white">--}}
{{--                                    <div class="font-50 text-dark">--}}
{{--                                        <img class="rounded" width="80-px" src="{{ $feature->category->pc_image }}" alt="">--}}
{{--                                    </div>--}}
{{--                                    <span class="fw-bold link-dark">{{ $feature->category->pc_name }}</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--                <!-- end row -->--}}
{{--            </div>--}}
{{--        </section>--}}
        <section class="py-4">
            <div class="container">
                <div class="row row-cols-2 row-cols-lg-6 g-3">
                    @foreach($headerCategory as $feature)
                        <a href="{{ route('web.single.category', $feature->category->pc_url) }}">
                            <div class="col">
                                <div class="text-center">
                                    <div class="text-dark pb-2 border border-1 border-dark p-3">
                                        <img class="img-thumbnail rounded-circle" src="{{ $feature->category->pc_image }}" alt="{{ $feature->category->pc_name }}">
                                    </div>
                                    <span class="fw-bold font-14 link-dark">{{ $feature->category->pc_name }}</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
                <!-- end row -->
            </div>
        </section>
        <!-- End Category Show -->

        <!--start information-->
        @if (count($serviceAds) > 0)
        <section class="py-4">
            <div class="container">
                <div class="row row-cols-1 row-cols-lg-3 g-4">
                    @foreach ($serviceAds as $ads)
                    <div class="col">
                        <div class="p-3 border d-flex align-items-center justify-content-center">
                            <div class="fs-1 text-content"><i class='{{ $ads->sa_icon }}'></i>
                            </div>
                            <div class="info-box-content ps-3">
                                <h6 class="mb-0 fw-bold">{{ $ads->sa_title }}</h6>
                                <p class="mb-0">{{ $ads->sa_sub_title }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!--end row-->
            </div>
        </section>
        @endif
        <!--end information-->

        <!--start pramotion-->
        @if (count($staticHeader) > 0)
        <section class="py-4">
            <div class="container">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3 g-4">
                    @foreach ($staticHeader as $headerBanner)
                    <div class="col">
                        <div class="bg-opacity-25 shadow-none card rounded-0 bg-info">
                            <div class="row g-0 align-items-center">
                                <div class="col">
                                    <img src="{{ asset($headerBanner->sb_image) }}" class="img-fluid" alt="" />
                                </div>
                                <div class="col">
                                    <div class="card-body">
                                        <h5 class="card-title text-uppercase fw-bold">
                                            {{ $headerBanner->sb_title }}</h5>
                                        <p class="card-text text-uppercase">{{ $headerBanner->sb_sub_title }}
                                        </p>
                                        <a href="{{ $headerBanner->sb_button_url }}"
                                            class="btn btn-outline-dark btn-ecomm">SHOP
                                            NOW</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!--end row-->
            </div>
        </section>
        @endif
        <!--end promotion-->
        <!--start Advertise banners-->
        @if (count($staticFooter) > 0)
        <section class="py-4 bg-dark">
            <div class="container">
                <div class="add-banner">
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-4 g-4">
                        @foreach ($staticFooter as $footerBanner)
                        <div class="col d-flex">
                            <div class="border-0 shadow-none card rounded-0 w-100">
                                <img src="{{ asset($footerBanner->sb_image) }}" class="img-fluid" alt="...">
                                <div class="text-center card-body">
                                    <h5 class="card-title">{{ $footerBanner->sb_title }}</h5>
                                    <p class="card-text">{{ $footerBanner->sb_sub_title }}</p>
                                    <a href="{{ $footerBanner->sb_button_url }}" class="btn btn-dark btn-ecomm">SHOP
                                        NOW</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!--end row-->
                </div>
            </div>
        </section>
        @endif
        <!--end Advertise banners-->

        <!--start Category Wise-->
        @foreach ($categories as $category)
        <section class="py-4">
            <div class="container">
                <div class="separator pb-4">
                    <div class="line"></div>
                    <h5 class="mb-0 fw-bold separator-title"><a class="text-dark" href="{{ route('web.single.category', $category->pc_url) }}">{{ $category->pc_name }}</a></h5>
                    <div class="line"></div>
                </div>
                <div class="product-grid">
                    <div class="new-arrivals owl-carousel owl-theme position-relative">
                        @foreach ($category->products as $key => $product)
                            @if($key < 10)
                            <form action="{{ route('web.checkout.quick.order') }}" method="POST">
                                @csrf
                                <input id="product_id" type="hidden" name="product_id" value="{{ $product->id }}">
                                <input id="product_name" type="hidden" name="product_name" value="{{ $product->product_name }}">
                                <input id="product_url" type="hidden" name="product_url" value="{{ $product->product_url }}">
                                <input id="product_image" type="hidden" name="product_image" value="{{ $product->product_thumbnail }}">
                                <input id="product_code" type="hidden" name="product_code" value="{{ $product->product_code }}">
                                <input id="product_commission" type="hidden" name="product_commission" value="{{ $product->product_commission }}">
                                <input id="product_price" type="hidden" name="product_price"
                                    value="{{ $product->product_discount_price == null ? $product->product_regular_price : $product->product_discount_price }}">
                                <input id="product_quantity" type="hidden" name="product_quantity" value="1">
                                <div class="item">
                                    <div class="card">
                                        <div class="overflow-hidden position-relative">
                                            <a href="{{ route('web.product.view', $product->product_url) }}">
                                                <img src="{{ asset($product->product_thumbnail) }}" class="img-fluid product-image"
                                                    alt="{{ $product->product_name }}">
                                            </a>
                                        </div>
                                        <div class="px-0 card-body">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="max-lines">
                                                    <a href="{{ route('web.product.view', $product->product_url) }}"
                                                        class="mb-0 fw-bold product-short-title link-dark">
                                                        {{ Str::limit($product->product_name, 22, '..') }}</a>
                                                </div>
                                            </div>

                                            <div class="gap-2 mt-2 product-price d-flex align-items-center justify-content-start">
                                                @if ($product->product_stock_status == 1)
                                                @if ($product->product_quantity != null)
                                                @if ($product->product_discount_price != null)
                                                <div class="h6 fw-light fw-bold text-secondary text-decoration-line-through">
                                                    ৳{{ $product->product_regular_price }}
                                                </div>
                                                <div class="h6 fw-bold">৳{{ $product->product_discount_price }}
                                                </div>
                                                @else
                                                <div class="h6 fw-bold">৳{{ $product->product_regular_price }}
                                                </div>
                                                @endif
                                                @else
                                                @if ($product->product_back_order == 1)
                                                @if ($product->product_discount_price != null)
                                                <div class="h6 fw-light fw-bold text-secondary text-decoration-line-through">
                                                    ৳{{ $product->product_regular_price }}
                                                </div>
                                                <div class="h6 fw-bold">৳{{ $product->product_discount_price }}
                                                </div>
                                                @else
                                                <div class="h6 fw-bold">৳{{ $product->product_regular_price }}
                                                </div>
                                                @endif
                                                @else
                                                <div class="h6 fw-bold text-danger">Out Of Stock</div>
                                                @endif
                                                @endif
                                                @else
                                                <div class="h6 fw-bold text-danger">Out Of Stock</div>
                                                @endif
                                            </div>
                                            @if ((count($product->color) > 0 ) || count($product->size) > 0)
                                            @if ($product->product_stock_status == 1)
                                            @if ($product->product_quantity >= 1)
                                            <a href="{{ route('web.product.view', $product->product_url) }}"
                                                class="btn btn-warning btn-ecomm w-100"><i class="bx bx-cart-alt"></i>Order Now</a>
                                            @else
                                            <!-- Product Back-Order Start -->
                                            @if ($product->product_back_order == 1)
                                            <a href="{{ route('web.product.view', $product->product_url) }}"
                                                class="btn btn-warning btn-ecomm w-100"><i class="bx bx-cart-alt"></i>Order Now</a>
                                            @else
                                            <span class="btn btn-light btn-ecomm w-100">Out Of Stock</span>
                                            @endif
                                            <!-- Product Back-Order End -->
                                            @endif
                                            @else
                                            <span class="btn btn-light btn-ecomm w-100">Out Of Stock</span>
                                            @endif
                                            @else
                                            @if ($product->product_stock_status == 1)
                                            @if ($product->product_quantity >= 1)
                                            <button class="btn btn-warning btn-ecomm w-100" type="submit"><i
                                                    class="bx bx-cart-alt"></i>Order
                                                Now</button>
                                            @else
                                            <!-- Product Back-Order Start -->
                                            @if ($product->product_back_order == 1)
                                            <button class="btn btn-warning btn-ecomm w-100" type="submit"><i
                                                    class="bx bx-cart-alt"></i>Order
                                                Now</button>
                                            @else
                                            <span class="btn btn-light btn-ecomm w-100">Out Of Stock</span>
                                            @endif
                                            <!-- Product Back-Order End -->
                                            @endif
                                            @else
                                            <span class="btn btn-light btn-ecomm w-100">Out Of Stock</span>
                                            @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </form>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        @endforeach
        <!--end Category Wise-->
    </div>
</div>
</div>

@endsection
