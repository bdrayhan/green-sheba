@extends('frontend.layouts.app')
@section('frontend-title', 'Shopping Cart')
@section('web.content')
    <!--start breadcrumb-->
    <section class="py-3 border-bottom border-top d-none d-md-flex bg-light">
        <div class="container">
            <div class="page-breadcrumb d-flex align-items-center">
                <h3 class="breadcrumb-title pe-3">Shop Cart</h3>
                <div class="ms-auto">
                    <nav aria-label="breadcrumb">
                        <ol class="p-0 mb-0 breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i> Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="javascript:;">Shop</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Shop Cart</li>
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
            <div class="shop-cart">
                <div class="row">
                    <div class="col-12 col-xl-8">
                        <div class="p-3 mb-3 shop-cart-list">
                            @forelse ($cartItems as $item)
                                @php
                                    $product = App\Models\Product::where('product_id', $item->id)->firstOrFail();
                                @endphp
                                <!-- Form Start -->
                                <form action="{{ route('web.product.update.to.cart') }}" method="POST">
                                    <input type="hidden" name="product_id" value="{{ $item->id }}">
                                    <input type="hidden" name="product_image" value="{{ $item->attributes->image }}">
                                    @csrf
                                    <div class="row align-items-center g-3">
                                        <div class="col-12 col-lg-4">
                                            <div class="gap-3 d-lg-flex align-items-center">
                                                <div class="text-center cart-img text-lg-start">
                                                    @if ($item->attributes->image == null)
                                                        <img src="{{ asset('media/product_no_image.png') }}" width="130"
                                                            alt="">
                                                    @else
                                                        <img src="{{ asset($item->attributes->image) }}" width="130"
                                                            alt="">
                                                    @endif
                                                </div>
                                                <div class="text-center cart-detail text-lg-start">
                                                    <h6 class="mb-2">{{ Str::limit($item->name, 40, '...') }}</h6>
                                                    <h5 class="mb-0">৳ {{ $item->price }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Quantity -->
                                        <div class="col-12 col-lg-1">
                                            <div class="text-center cart-action">
                                                <input name="product_quantity" id="pro_quantity" type="number"
                                                    class="form-control rounded-0" value="{{ $item->quantity }}"
                                                    min="1">
                                            </div>
                                        </div>
                                        <!-- Product Size -->
                                        @if (!empty($product->product_size))
                                            <div class="col-12 col-lg-2">
                                                <div class="text-center cart-action">
                                                    <select name="product_size" class="form-select form-select-sm">
                                                        @forelse (explode(',', $product->product_size) as $prosize)
                                                            <option value="{{ $product->size($prosize)->size_id }}"
                                                                {{ $item->attributes->size == $product->size($prosize)->size_name ? 'selected' : '' }}>
                                                                {{ $product->size($prosize)->size_name }}</option>
                                                        @empty
                                                        @endforelse
                                                    </select>
                                                </div>
                                            </div>
                                        @endif
                                        @if (!empty($product->product_color))
                                            <!-- Product Color -->
                                            <div class="col-12 col-lg-2">
                                                <div class="text-center cart-action">
                                                    <select id="pro_color" class="form-select form-select-sm"
                                                        name="product_color" id="">
                                                        @forelse (explode(',', $product->product_color) as $procolor)
                                                            <option value="{{ $product->colors($procolor)->color_id }}"
                                                                {{ $item->attributes->color == $product->colors($procolor)->color_name ? 'selected' : '' }}>
                                                                {{ $product->colors($procolor)->color_name }}</option>
                                                        @empty
                                                        @endforelse
                                                    </select>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-12 col-lg-1">
                                            <div class="text-center">
                                                <div class="d-flex justify-content-center justify-content-lg-end"
                                                    style="height: 40px">
                                                    <button type="submit" class="btn btn-light rounded-0 btn-ecomm">
                                                        <i class='bx bx-sync me-0'></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-2">
                                            <div class="text-center">
                                                <div class="d-flex justify-content-center justify-content-lg-end"
                                                    style="height: 40px">
                                                    <a href="{{ route('web.remove.to.cart', $item->id) }}"
                                                        class="btn btn-danger btn-light rounded-0 btn-ecomm">
                                                        <i class='bx bxs-x-circle me-0'></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <!-- Form End -->
                                <hr>

                            @empty
                                <div class="mb-5 row align-items-center g-3">
                                    <div class="col-12"></div>
                                    <div class="text-center">
                                        <h3 class="mb-0"><i class="bx bxs-cart fs-2"></i> No Item Found</h3>
                                    </div>
                                </div>
                            @endforelse
                            <div class="gap-2 d-lg-flex align-items-center">
                                <a href="{{ route('web.home') }}" class="btn btn-dark btn-ecomm"><i
                                        class='bx bx-shopping-bag'></i>
                                    Continue Shoping</a>
                                <a href="{{ route('web.all.remove.to.cart') }}" class="btn btn-white btn-ecomm ms-auto"><i
                                        class='bx bx-x-circle'></i>
                                    Clear Cart</a>
                            </div>

                        </div>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="p-3 checkout-form bg-light">
                            <form action="{{ route('web.cart.add.coupon') }}" method="POST">
                                @csrf
                                <div class="bg-transparent border shadow-none card rounded-0">
                                    <div class="card-body">
                                        <p class="fs-5">Apply Discount Code</p>
                                        @if (session()->has('coupon'))
                                            <h3>{{ session()->get('coupon')['name'] }}
                                                <a style="float: right;" href="{{ route('web.cart.remove.coupon') }}"
                                                    class="m-auto rounded btn btn-sm btn-danger">
                                                    X
                                                </a>
                                            </h3>
                                        @else
                                            <div class="input-group">
                                                <input name="coupon" type="text" class="form-control rounded-0"
                                                    placeholder="Enter discount code">
                                                <button class="btn btn-dark btn-ecomm" type="submit">Apply</button>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </form>
                            <div class="mb-0 bg-transparent border shadow-none card rounded-0">
                                <div class="card-body">
                                    <p class="mb-2">Subtotal: <span class="float-end">৳
                                            {{ Cart::getSubTotal() }}</span>
                                    </p>
                                    <p class="mb-0">Discount:
                                        <span class="float-end">৳
                                            @if (Session::has('coupon'))
                                                {{ Session::get('coupon')['discount'] }}
                                            @else
                                                0
                                            @endif
                                        </span>
                                    </p>
                                    <div class="my-3 border-top"></div>
                                    <h5 class="mb-0">Order Total:
                                        <span class="float-end">৳
                                            @if (Session::has('coupon'))
                                                {{ Session::get('coupon')['balance'] }}
                                            @else
                                                {{ Cart::getTotal() }}
                                            @endif
                                        </span>
                                    </h5>
                                    <div class="my-4"></div>
                                    <div class="d-grid">
                                        <a href="{{ route('web.checkout.details') }}"
                                            class="btn btn-dark btn-ecomm">Proceed to
                                            Checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </section>
    <!--end shop cart-->
@endsection
