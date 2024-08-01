@extends('frontend.layouts.app')
@section('frontend-title', 'Shopping Details')
@section('web.content')

    <!--start breadcrumb-->
    <section class="py-3 border-bottom border-top d-none d-md-flex bg-light">
        <div class="container">
            <div class="page-breadcrumb d-flex align-items-center">
                <h3 class="breadcrumb-title pe-3">Checkout</h3>
                <div class="ms-auto">
                    <nav aria-label="breadcrumb">
                        <ol class="p-0 mb-0 breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i> Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Checkout</li>
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
                    @if (Cart::getContent()->count() > 0)
                    <div class="col-12 col-xl-8">
                        <div class="checkout-details">
                            <div class="card rounded-0">
                                <div class="card-body">
                                    <!-- Payment Method Information -->
                                    <div class="card-body">
                                        <ul class="p-3 mb-3 border nav nav-pills" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link active rounded-0" data-bs-toggle="pill"
                                                    href="#credit-card" role="tab" aria-selected="true">
                                                    <div class="d-flex align-items-center">
                                                        <div class="tab-icon"><i class='bx bx-money font-18 me-1'></i>
                                                        </div>
                                                        <div class="tab-title">Cash On Delivery</div>
                                                    </div>
                                                </a>
                                            </li>

                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link rounded-0" data-bs-toggle="pill" href="#credit-card"
                                                    role="tab" aria-selected="true">
                                                    <div class="d-flex align-items-center">
                                                        <div class="tab-icon"><i
                                                                class='bx bxs-hourglass-top font-18 me-1'></i>
                                                        </div>
                                                        <div class="tab-title">Coming Soon</div>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="pills-tabContent">
                                            <div class="tab-pane fade show active" id="credit-card" role="tabpanel">
                                                <div class="p-3 border">
                                                    <form action="{{ route('web.checkout.order.now') }}" class="row g-3"
                                                        method="POST" id="order_form">
                                                        @csrf
                                                        @auth
                                                            <input name="user_id" type="hidden" value="{{ Auth::user()->id }}">
                                                        @endauth
                                                        @if (Session::has('coupon'))
                                                            <input type="hidden" name="coupon_code"
                                                                value="{{ session()->get('coupon')['name'] }}">
                                                        @endif
                                                        <input name="payment_type" type="hidden" value="cash_on_delivery">

                                                        <h2 class="mb-0 h5">Shipping Address</h2>
                                                        <div class="my-3 border-bottom"></div>
                                                        <div class="col-md-12">
                                                            <label class="form-label">Full Name
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input id="orderName" name="full_name" type="text"
                                                                class="form-control rounded-0" placeholder="Full Name" value="{{ old('full_name') }}">
                                                                @error('full_name')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Email</label>
                                                            <input name="email" type="email"
                                                                class="form-control rounded-0" placeholder="Email" value="{{ old('email') }}">
                                                                @error('email')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Phone Number
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input id="orderPhone" name="phone" type="tel"
                                                                class="form-control rounded-0" placeholder="XXX-XXX-XXXXX" value="{{ old('phone') }}">
                                                                @error('phone')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Country
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <select name="contry" class="form-select rounded-0">
                                                                <option value="bangladesh">Bangladesh</option>
                                                            </select>
                                                            @error('contry')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Select Area
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <select id="delivery-area" name="area"
                                                                class="form-select rounded-0" required>
                                                                <option label="Area"></option>
                                                                <option value="inside-dhaka">Inside Dhaka</option>
                                                                <option value="outside-dhaka">OutSide Dhaka</option>
                                                            </select>
                                                            @error('area')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label class="form-label">Address
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <textarea id="orderAddress" name="address" class="form-control rounded-0" placeholder="Address">{{ old('address') }}</textarea>
                                                            @error('address')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label class="form-label">Note</label>
                                                            <textarea name="note" class="form-control rounded-0" placeholder="Add Your Message"></textarea>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="order-summary">
                            <div class="card rounded-0">
                                <div class="card-body">
                                    <!-- Order Summery -->
                                    <div class="bg-transparent border shadow-none card rounded-0">
                                        <div class="card-body">
                                            <p class="fs-5">Order summary</p>
                                            @forelse (Cart::getContent() as $cart)
                                                <div class="my-3 border-top"></div>
                                                <div class="d-flex align-items-center">
                                                    <a class="flex-shrink-0 d-block" href="javascript:;">
                                                        <img src="{{ asset($cart->attributes->image) }}" width="75"
                                                            alt="Product">
                                                    </a>
                                                    <div class="ps-2">
                                                        <h6 class="mb-1"><a href="javascript:;"
                                                                class="text-dark">{{ Str::limit($cart->name, 60, '...') }}</a></h6>
                                                        <div class="widget-product-meta"><span
                                                                class="me-2">৳{{ $cart->price }}</span><span
                                                                class="">x
                                                                {{ $cart->quantity }}</span>
                                                        </div>
                                                    </div>
                                                    <a href="{{ route('web.remove.to.cart', $cart->id) }}" class="ms-auto btn btn-danger btn-light rounded btn-ecomm py-3">
                                                        <i class="bx bxs-x-circle me-0"></i>
                                                    </a>
                                                </div>
                                            @empty
                                                <div class="d-flex align-items-center">Empty</div>
                                            @endforelse
                                        </div>
                                    </div>

                                    <div class="mb-0 bg-transparent border shadow-none card rounded-0">
                                        <div class="card-body">
                                            <p class="mb-2">Subtotal: <span class="float-end sub-total">৳
                                                    {{ Cart::getSubTotal() }}</span>
                                            </p>
                                            <p class="mb-2"><span class="text-warning">Shipping Charge:</span><span
                                                    class="float-end delivery-charge">৳
                                                    0.00</span>
                                            </p>
                                            <p class="mb-0">Discount:
                                                <span class="float-end">৳
                                                    @if (Session::has('coupon'))
                                                        {{ session()->get('coupon')['discount'] }}
                                                    @else
                                                        0
                                                    @endif
                                                </span>
                                            </p>
                                            <div class="my-3 border-top"></div>
                                            <h5 class="mb-0">Order Total:
                                                <span class="float-end total-amount">৳
                                                    @if (session()->has('coupon'))
                                                        {{ Session::get('coupon')['balance'] }}
                                                    @else
                                                        {{ Cart::getTotal() }}
                                                    @endif
                                                </span>
                                            </h5>
                                            <div class="my-4"></div>
                                            <div class="d-grid">
                                                <a id="orderConfirmBtn" href="javascript:;" class="btn btn-dark btn-ecomm" >Confirm Order</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="col-12 col-xl-12">
                        <div class="card">
                            <div class="card-body text-center">
                                <h2 class="h4 pb-3">There Are No Products</h2>
                                <a class="btn btn-warning mt-3 rounded" href="{{ route('web.home') }}">Choose  Your Product</a>
                            </div>
                        </div>
                    </div>
                    @endif

                </div>
                <!--end row-->
            </div>
        </div>
    </section>
    <script src="{{ asset('frontend') }}/assets/js/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#delivery-area").on("change", function() {
                var sub_total =
                    {{ Session::has('coupon') ? Session::get('coupon')['balance'] : Cart::getSubTotal() }};
                var inside_charge = 80;
                var outside_charge = 150;
                var delivery_area = $(this).val();

                if (delivery_area == "inside-dhaka") {
                    $(".delivery-charge").text("৳ 80");
                    $(".total-amount").text(("৳ " + (sub_total + inside_charge)));
                } else if (delivery_area == "outside-dhaka") {
                    $(".delivery-charge").text("৳ 150");
                    $(".total-amount").text(("৳ " + (sub_total + outside_charge)));
                } else {
                    $(".delivery-charge").text("৳ 0.00");
                    $(".total-amount").text(("৳ " + sub_total));
                }
            });
        });

        // Order Submit
        $(document).ready(function () {
            $("#orderConfirmBtn").on("click", function() {
                // Full Name Validation
                if ($("#orderName").val() == "") {
                    Swal.fire({
                        icon: "error",
                        title: "Enter Full Name",
                        showConfirmButton: !1,
                        timer: 2000
                    });
                    return false;
                }

                // Phone Validation
                if ($("#orderPhone").val().length < 11 || $("#orderPhone").val().length > 11) {
                    Swal.fire({
                        icon: "error",
                        title: "Enter Valid Phone Number",
                        showConfirmButton: !1,
                        timer: 2000
                    });
                    return false;
                }
                // Delivery Area Validation
                if ($("#delivery-area").val() === "") {
                    Swal.fire({
                        icon: "error",
                        title: "Please Select Your Area",
                        showConfirmButton: !1,
                        timer: 2000
                    });
                    return false;
                }
                // Address Validation
                if ($("#orderAddress").val() === "") {
                    Swal.fire({
                        icon: "error",
                        title: "Enter Your Address",
                        showConfirmButton: !1,
                        timer: 2000
                    });
                    return false;
                }

                $("#order_form").submit();
            });
        });
    </script>
    <!--end shop cart-->
@endsection
