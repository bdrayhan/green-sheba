<!--start quick view product-->
<!-- Modal -->
<div class="modal fade" id="QuickViewProduct{{ $product->id }}">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-xl-down">
        <div class="border-0 modal-content rounded-0">
            <div class="modal-body">
                <button type="button" class="btn-close float-end" data-bs-dismiss="modal"></button>
                <div class="row g-0">
                    <div class="col-12 col-lg-6">
                        <div class="image-zoom-section">
                            <div class="p-3 mb-3 border product-gallery owl-carousel owl-theme"
                                data-slider-id="{{ $product->id }}">
                                <div class="item">
                                    <img src="{{ $product->product_thumbnail }}" class="img-fluid" alt="">
                                </div>
                                @forelse ($product->gallery as $gallery)
                                    <div class="item">
                                        <img src="{{ $gallery->pg_image }}" class="img-fluid" alt="">
                                    </div>
                                @empty
                                @endforelse
                            </div>

                            <div class="owl-thumbs d-flex justify-content-center"
                                data-slider-id="{{ $product->id }}">
                                <button class="owl-thumb-item">
                                    <img src="{{ $product->product_thumbnail }}" class="" alt="">
                                </button>
                                @forelse ($product->gallery as $gallery)
                                    <button class="owl-thumb-item">
                                        <img src="{{ $gallery->pg_image }}" class="" alt="">
                                    </button>
                                @empty
                                @endforelse
                            </div>
                        </div>

                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="p-3 product-info-section">
                            <h3 class="mt-3 mb-0 mt-lg-0">{{ $product->product_name }}</h3>
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
                                <dt class="col-sm-3">Product Code</dt>
                                <dd class="col-sm-9">#{{ $product->product_code }}</dd>
                                <dt class="col-sm-3">Delivery</dt>
                                <dd class="col-sm-9">{{ $product->delivery_location }}</dd>
                            </dl>
                            <form class="modalOrderForm" id="modalOrderForm" method="POST" action="{{ route('web.checkout.quick.order') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}">
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
                                    @if ($product->product_size != null)
                                        <div class="col">
                                            <label class="form-label">Size</label>
                                            <select name="product_size" class="form-select form-select-sm">
                                                @forelse (explode(',', $product->product_size) as $prosize)
                                                    <option value="{{ optional($product->size($prosize))->size_id }}">
                                                        {{ optional($product->size($prosize))->size_name }}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                    @endif
                                    @if (!empty($product->color))
                                        <div class="col">
                                            <label class="form-label">Color</label>
                                            <select class="form-select form-select-sm" name="product_color"
                                                id="">
                                                @forelse ($product->color as $color)
                                                    <option
                                                        value="{{ $color->color_id }}">
                                                        {{ $color->color_name }}
                                                    </option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                    @endif
                                </div>
                                <!--end row-->
                                <div class="gap-2 mt-3 d-flex">
                                    @if ($product->product_stock_status == 1)
                                        @if ($product->product_quantity >= 1)
                                            {{-- <button class="btn btn-dark btn-ecomm addtoCartButton">
                                                <i class="bx bxs-cart-add"></i>Add to Cart
                                            </button> --}}
                                            <button class="btn btn-warning btn-ecomm" type="submit"><i class="bx bx-rocket"></i> Order Now</button>
                                        @else
                                        <!-- Product Back-Order Start -->
                                        @if ($product->product_back_order == 1)
                                        <button class="btn btn-dark btn-ecomm addtoCartButton">
                                            <i class="bx bxs-cart-add"></i>Add to Cart
                                        </button>
                                        <button class="btn btn-warning btn-ecomm orderNowButton"><i class="bx bx-rocket"></i>Order Now</button>
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
</div>

