@extends('frontend.layouts.app')
@section('frontend-title', 'Search - ' . $searchTerm)
@section('web.content')
    <!--start breadcrumb-->
    <section class="py-3 border-bottom border-top d-none d-md-flex bg-light">
        <div class="container">
            <div class="page-breadcrumb d-flex align-items-center">
                <h3 class="breadcrumb-title pe-3">About {{ count($products) }} results for {{ $searchTerm }}</h3>
                <div class="ms-auto">
                    <nav aria-label="breadcrumb">
                        <ol class="p-0 mb-0 breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('web.home') }}"><i class="bx bx-home-alt"></i>
                                    Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Search</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!--end breadcrumb-->
    <!--start shop area-->
    <section class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-12 col-xl-12">
                    <div class="product-wrapper">
                        <div class="product-grid">
                            <div
                                class="{{ count($products) <= 0 ? 'd-flex justify-content-center' : '' }} row row-cols-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-6 g-3 g-sm-4">
                                @forelse ($products as $product)
                                    <form action="{{ route('web.checkout.quick.order') }}" method="POST">
                                        @csrf
                                        <input id="product_id" type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input id="product_name" type="hidden" name="product_name" value="{{ $product->product_name }}">
                                        <input id="product_url" type="hidden" name="product_url" value="{{ $product->product_url }}">
                                        <input id="product_image" type="hidden" name="product_image" value="{{ $product->product_thumbnail }}">
                                        <input id="product_code" type="hidden" name="product_code" value="{{ $product->product_code }}">
                                        <input id="product_commission" type="hidden" name="product_commission" value="{{ $product->product_commission }}">
                                        <input  id="product_price" type="hidden" name="product_price"
                                        value="{{ $product->product_discount_price == null ? $product->product_regular_price : $product->product_discount_price }}">
                                        <input id="product_quantity" type="hidden" name="product_quantity" value="1">

                                        <div class="col">
                                            <div class="card">
                                                <div class="overflow-hidden position-relative">
                                                    <a href="{{ route('web.product.view', $product->product_url) }}">
                                                        <img src="{{ asset($product->product_thumbnail) }}"
                                                            class="img-fluid product-image" alt="{{ $product->product_name }}">
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

                                                    <div
                                                        class="gap-2 mt-2 product-price d-flex align-items-center justify-content-start">
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
                                                            <a href="{{ route('web.product.view', $product->product_url) }}" class="btn btn-warning btn-ecomm w-100"><i class="bx bx-cart-alt"></i>Order Now</a>
                                                            @else
                                                            <!-- Product Back-Order Start -->
                                                            @if ($product->product_back_order == 1)
                                                            <a href="{{ route('web.product.view', $product->product_url) }}" class="btn btn-warning btn-ecomm w-100"><i class="bx bx-cart-alt"></i>Order Now</a>
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
                                                            <button class="btn btn-warning btn-ecomm w-100" type="submit"><i class="bx bx-cart-alt"></i>Order
                                                                Now</button>
                                                            @else
                                                            <!-- Product Back-Order Start -->
                                                            @if ($product->product_back_order == 1)
                                                            <button class="btn btn-warning btn-ecomm w-100" type="submit"><i class="bx bx-cart-alt"></i>Order
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
                                @empty
                                    <h3>No results found.</h3>
                                @endforelse
                            </div>
                            <!--end row-->

                        </div>
                        <hr>
                        {{ $products->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </section>
    <!--end shop area-->
@endsection
