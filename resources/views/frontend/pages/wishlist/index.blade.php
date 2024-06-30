@extends('frontend.layouts.app')
@section('frontend-title', 'Wishlist')
@section('web.content')
    <!--start breadcrumb-->
    <section class="py-3 border-bottom border-top d-none d-md-flex bg-light">
        <div class="container">
            <div class="page-breadcrumb d-flex align-items-center">
                <h3 class="breadcrumb-title pe-3">Wishlist</h3>
                <div class="ms-auto">
                    <nav aria-label="breadcrumb">
                        <ol class="p-0 mb-0 breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('web.home') }}"><i class="bx bx-home-alt"></i>
                                    Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!--end breadcrumb-->
    <!--start Featured product-->
    <section class="py-4">
        <div class="container">
            <div class="product-grid">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
                    @forelse ($wishlists as $wishlist)
                        <div class="col">
                            <div class="border card rounded-0">
                                <a href="{{ route('web.product.view', $wishlist->product->product_url) }}">
                                    <img src="{{ asset($wishlist->product->product_thumbnail) }}" class="card-img-top"
                                        alt="...">
                                </a>
                                <div class="card-body">
                                    <div class="product-info">
                                        <a
                                            href="{{ route('web.single.category', $wishlist->categoryUrl($wishlist->product->category_id)) }}">
                                            <p class="mb-1 product-catergory font-13">
                                                {{ $wishlist->category($wishlist->product->category_id) }}
                                            </p>
                                        </a>
                                        <a href="{{ route('web.product.view', $wishlist->product->product_url) }}">
                                            <h6 class="mb-2 product-name">{{ $wishlist->product->product_name }}</h6>
                                        </a>
                                        <div class="d-flex align-items-center">
                                            @if ($wishlist->product->product_discount_price != null)
                                                <div class="mb-1 product-price"> <span
                                                        class="me-1 text-decoration-line-through">
                                                        ৳{{ $wishlist->product->product_regular_price }}</span>
                                                    <span
                                                        class="fs-5">৳{{ $wishlist->product->product_discount_price }}</span>
                                                </div>
                                            @else
                                                <div class="h6 fw-bold">৳{{ $wishlist->product->product_regular_price }}
                                                </div>
                                                <div class="mb-1 product-price"> <span
                                                        class="me-1 text-decoration-line-through">
                                                        ৳{{ $wishlist->product->product_regular_price }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="mt-2 product-action">
                                            <div class="gap-2 d-grid">
                                                <a href="{{ route('web.product.view', $wishlist->product->product_url) }}"
                                                    class="btn btn-dark btn-ecomm"> <i class='bx bxs-cart-add'></i>Add to
                                                    Cart</a>
                                                <a href="{{ route('web.wishlist.delete', $wishlist->id) }}"
                                                    class="btn btn-light btn-ecomm"><i class='bx bx-zoom-in'></i>Remove From
                                                    List</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col">
                            <div class="border card rounded-0">
                                <div class="card-body">
                                    <div class="product-info">
                                        <a href="javascript:;">
                                            <p class="mb-1 product-catergory font-13">No Wishlist Found</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
                {{ $wishlists->links('pagination::bootstrap-5') }}
                <!--end row-->
            </div>
        </div>
    </section>
    <!--end Featured product-->
@endsection
