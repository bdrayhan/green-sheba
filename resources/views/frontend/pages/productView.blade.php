@extends('frontend.layouts.app')
@section('frontend-title', $product->product_name)
@section('web.content')
    <!--start breadcrumb-->
    <section class="py-3 border-bottom border-top d-none d-md-flex bg-light">
        <div class="container">
            <div class="page-breadcrumb">
                <div class="ms-auto">
                    <nav aria-label="breadcrumb">
                        <ol class="p-0 mb-0 breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('web.home') }}"><i class="bx bx-home-alt"></i> Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $product->product_name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!--end breadcrumb-->
    <!--start product detail-->
    <section class="py-4">
        <div class="container">
            <div class="product-detail-card">
                <div class="product-detail-body">
                    <div class="row g-0">
                        <div class="col-12 col-lg-5">
                            <div class="image-zoom-section">
                                <div class="p-3 mb-3 border product-gallery owl-carousel owl-theme"
                                    data-slider-id="{{ $product->id }}">
                                    <div class="item">
                                        <img src="{{ asset($product->product_thumbnail) }}" class="img-fluid"
                                            alt="">
                                    </div>
                                    @forelse ($product->gallery as $image)
                                        <div class="item">
                                            <img src="{{ asset($image->pg_image) }}" class="img-fluid" alt="">
                                        </div>
                                    @empty
                                    @endforelse
                                </div>
                                <div class="owl-thumbs d-flex justify-content-center"
                                    data-slider-id="{{ $product->id }}">
                                    <button class="owl-thumb-item">
                                        <img src="{{ asset($product->product_thumbnail) }}" class="" alt="">
                                    </button>
                                    <!-- Gallery Image -->
                                    @forelse ($product->gallery as $image)
                                        <button class="owl-thumb-item">
                                            <img src="{{ asset($image->pg_image) }}" class="" alt="">
                                        </button>
                                    @empty
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-7">
                            <div class="p-3 product-info-section">
                                <h3 class="mt-3 mb-0 mt-lg-0">{{ Str::title($product->product_name) }}</h3>
                                <div class="gap-2 mt-3 d-flex align-items-center">
                                    @if ($product->product_stock_status == 1)
                                    <!-- Product Quantity Start -->
                                        @if ($product->product_quantity >= 1)
                                            @if ($product->product_discount_price != null)
                                                <h5 class="mb-0 text-decoration-line-through text-light-3">
                                                    ৳{{ $product->product_regular_price }}</h5>
                                                <h4 class="mb-0">৳{{ $product->product_discount_price }}</h4>
                                            @else
                                                <h4 class="mb-0">৳{{ $product->product_regular_price }}</h4>
                                            @endif
                                        @else
                                            <!-- Product Back-Order Start -->
                                            @if ($product->product_back_order == 1)
                                                @if ($product->product_discount_price != null)
                                                    <h5 class="mb-0 text-decoration-line-through text-light-3">
                                                        ৳{{ $product->product_regular_price }}</h5>
                                                    <h4 class="mb-0">৳{{ $product->product_discount_price }}</h4>
                                                @else
                                                    <h4 class="mb-0">৳{{ $product->product_regular_price }}</h4>
                                                @endif
                                            @else
                                            <h4 class="mb-0 text-danger">Out Of Stock</h4>
                                            @endif
                                            <!-- Product Back-Order End -->
                                        @endif
                                        <!-- Product Quantity End -->
                                    @else
                                        <h4 class="mb-0 text-danger">Out Of Stock</h4>
                                    @endif
                                </div>
                                <div class="mt-3">
                                    <h6>Discription :</h6>
                                    <p class="mb-0">{{ $product->product_short_details }}</p>
                                </div>
                                <dl class="mt-3 row">
                                    <dt class="col-sm-3">Product Sku</dt>
                                    <dd class="col-sm-9">#{{ $product->product_code }}</dd>
                                    <dt class="col-sm-3">Delivery</dt>
                                    <dd class="col-sm-9"><strong>{{ Str::upper($product->delivery_location ); }}</strong></dd>
                                </dl>
                                <form id="cartOrderForm" method="POST">
                                    @csrf
                                    <input class="product_id" type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="product_url" value="{{ $product->product_url }}">
                                    <input type="hidden" name="product_name" value="{{ $product->product_name }}">
                                    <input type="hidden" name="product_image" value="{{ $product->product_thumbnail }}">
                                    <input type="hidden" name="product_code" value="{{ $product->product_code }}">
                                    <input type="hidden" name="product_price"
                                        value="{{ $product->product_discount_price == null ? $product->product_regular_price : $product->product_discount_price }}">
                                    <div class="mt-3 row row-cols-auto align-items-center">
                                        <div class="col" style="width: 100px">
                                            <label class="form-label">Quantity</label>
                                            <input type="number" class="form-control form-control-sm rounded" value="1" name="product_quantity">
                                        </div>
                                        @if (count($product->size) > 0)
                                            <div class="col">
                                                <label class="form-label">Size</label>
                                                <select name="product_size" class="form-select form-select-sm"
                                                    {{ !($product->product_stock_status == 1) ? 'disabled' : '' }}>
                                                    @forelse ($product->size as $size)
                                                        <option value="{{ $size->id }}">
                                                            {{ $size->size_name }}</option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>
                                        @endif
                                        @if (count($product->color) > 0)
                                            <div class="col">
                                                <label class="form-label">Colors</label>
                                                <select class="form-select form-select-sm" name="product_color"
                                                    id=""
                                                    {{ !($product->product_stock_status == 1) ? 'disabled' : '' }}>
                                                    @forelse ($product->color as $color)
                                                        <option value="{{ $color->id }}">
                                                            {{ $color->color_name }}</option>
                                                    @empty
                                                    <option label="Empty"></option>
                                                    @endforelse
                                                </select>
                                            </div>
                                        @endif
                                    </div>
                                    <!--end row-->
                                    <div class="gap-2 mt-3 d-flex">
                                        @if ($product->product_stock_status == 1)
                                            @if ($product->product_quantity >= 1)
                                                <button class="btn btn-dark btn-ecomm addtoCartButton">
                                                    <i class="bx bxs-cart-add"></i>Add to Cart
                                                </button>
                                                <button class="btn btn-warning btn-ecomm orderNowButton"><i class="bx bx-cart-alt"></i>Order Now</button>
                                            @else
                                            <!-- Product Back-Order Start -->
                                            @if ($product->product_back_order == 1)
                                            <button class="btn btn-dark btn-ecomm addtoCartButton">
                                                <i class="bx bxs-cart-add"></i>Add to Cart
                                            </button>
                                            <button class="btn btn-warning btn-ecomm orderNowButton"><i class="bx bx-cart-alt"></i>Order Now</button>
                                            @else
                                            <span class="px-5 py-2 border bg-light text-dark  rounded">Out Of Stock</span>
                                            @endif
                                            <!-- Product Back-Order End -->
                                            @endif
                                        @else
                                            <span class="px-5 py-2 border bg-light text-dark  rounded">Out Of Stock</span>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </div>
        </div>
    </section>
    <!--end product detail-->
    <!--start product more info-->
    <section class="py-4">
        <div class="container">
            <div class="product-more-info">
                <ul class="mb-0 nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#discription">
                            <div class="d-flex align-items-center">
                                <div class="tab-title text-uppercase fw-500">Description</div>
                            </div>
                        </a>
                    </li>
                </ul>
                <div class="pt-3 tab-content">
                    <div class="tab-pane fade show active" id="discription">
                        {!! $product->product_details !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--end product more info-->

    <!--start similar products-->
    {{-- @if (count($relatedProducts) > 0)
        <section class="py-4">
            <div class="container">
                <div class="separator pb-4">
                    <div class="line"></div>
                    <h5 class="mb-0 fw-bold separator-title">SIMILAR PRODUCTS</h5>
                    <div class="line"></div>
                </div>
                <div class="product-grid">
                    <div class="new-arrivals owl-carousel owl-theme position-relative">
                        @foreach ($relatedProducts as $product)
                            <div class="item">
                                <div class="card">
                                    <div class="overflow-hidden position-relative">
                                        <div class="bottom-0 quick-view position-absolute start-0 end-0">
                                            <a href="javascript:;">Order Now</a>
                                        </div>
                                        <a href="{{ route('web.product.view', $product->product_url) }}">
                                            <img src="{{ asset($product->product_thumbnail) }}" class="img-fluid"
                                                alt="{{ $product->product_name }}">
                                        </a>
                                    </div>
                                    <div class="px-0 card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="">
                                                <p class="mb-1 product-short-name">{{ $product->category->pc_name }}
                                                </p>
                                                <h6 class="mb-0 fw-bold product-short-title">
                                                    {{ $product->product_name }}</h6>
                                            </div>
                                            <div class="icon-wishlist">
                                                <a data-id="{{ $product->product_id }}" class="wishlistButton"
                                                    href="javascript:;"><i class="bx bx-heart"></i></a>
                                            </div>
                                        </div>
                                        <div
                                            class="gap-2 mt-2 product-price d-flex align-items-center justify-content-start">
                                            @if ($product->product_stock_status == 1 || $product->product_quantity < 1)
                                                @if ($product->product_discount_price != null)
                                                    <div
                                                        class="h6 fw-light fw-bold text-secondary text-decoration-line-through">
                                                        ৳{{ $product->product_regular_price }}
                                                    </div>
                                                    <div class="h6 fw-bold">
                                                        ৳{{ $product->product_discount_price }}
                                                    </div>
                                                @else
                                                    <div class="h6 fw-bold">৳{{ $product->product_regular_price }}
                                                    </div>
                                                @endif
                                            @else
                                                <div class="h6 fw-bold text-danger">Out Of Stock</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif --}}
    <!--end similar products-->

@endsection

