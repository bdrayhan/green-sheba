<div class="header-wrapper">
    <div class="top-menu">
        <div class="container">
            <nav class="navbar navbar-expand">
                <div class="shiping-title d-none d-sm-flex">Welcome to our {{ $basicSetting->basic_company }} store!
                </div>
                <ul class="navbar-nav ms-auto d-none d-lg-flex">
                    @forelse ($navigation as $nav)
                        <li class="nav-item"><a class="nav-link"
                                href="{{ route('web.page.single', $nav->page_url) }}">{{ $nav->page_name }}</a>
                        </li>
                    @empty
                    @endforelse
                </ul>
                <ul class="navbar-nav social-link ms-lg-2 ms-auto">
                    @if (!empty($socialSetting->sm_facebook))
                        <li class="nav-item">
                            <a target="_blank" class="nav-link"
                                href="https://facebook.com/{{ $socialSetting->sm_facebook }}"><i
                                    class='bx bxl-facebook'></i></a>
                        </li>
                    @endif
                    @if (!empty($socialSetting->sm_twitter))
                        <li class="nav-item">
                            <a target="_blank" class="nav-link"
                                href="https://twitter.com/{{ $socialSetting->sm_twitter }}"><i
                                    class='bx bxl-twitter'></i></a>
                        </li>
                    @endif
                    @if (!empty($socialSetting->sm_linkedin))
                        <li class="nav-item">
                            <a target="_blank" class="nav-link"
                                href="https://linkedin.com/{{ $socialSetting->sm_linkedin }}"><i
                                    class='bx bxl-linkedin'></i></a>
                        </li>
                    @endif
                    @if (!empty($socialSetting->sm_instagram))
                        <li class="nav-item">
                            <a target="_blank" class="nav-link"
                                href="https://www.instagram.com/{{ $socialSetting->sm_instagram }}"><i
                                    class='bx bxl-instagram'></i></a>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>

    <div class="header-content bg-warning">
        <div class="container">
            <div class="row align-items-center gx-4">
                <div class="col-auto">
                    <div class="gap-3 d-flex align-items-center">
                        <div class="mobile-toggle-menu d-inline d-xl-none" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasNavbar">
                            <i class="bx bx-menu"></i>
                        </div>
                        <div class="logo">
                            <a href="{{ route('web.home') }}">
                                <img src="{{ asset(appSetting()['basic_setting']->basic_logo) }}" class="logo-icon"
                                    alt="logo" />
                            </a>
                        </div>
                    </div>
                </div>
                <div class="order-4 col-12 col-xl order-xl-0">
                    <form action="{{ route('web.search') }}" method="POST">
                        @csrf
                        <div class="pb-3 input-group flex-nowrap pb-xl-0">
                            <input name="search" type="text" class="border form-control w-100 border-dark border-3"
                                placeholder="Search for Products" required value="{{ $searchTerm ?? '' }}">
                            <button class="btn btn-dark btn-ecomm border-3" type="submit">Search</button>
                        </div>
                    </form>
                </div>
                <div class="col-auto d-none d-xl-flex">
                    <div class="gap-3 d-flex align-items-center">
                        <div class="fs-1 text-content"><i class='bx bx-headphone'></i></div>
                        <div class="">
                            <p class="mb-0 text-content">CALL US NOW</p>
                            <h5 class="mb-0">+88{{ $contactInfo->ci_phone1 ?? '00000000000' }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-auto ms-auto">
                    <div class="top-cart-icons">
                        <nav class="navbar navbar-expand">
                            <ul class="navbar-nav">
                                @auth
                                    <li class="nav-item"><a href="{{ route('web.user.account') }}"
                                            class="nav-link cart-link"><i class='bx bx-user'></i></a>
                                    </li>
                                @endauth
                                @guest
                                    <li class="nav-item"><a href="{{ route('login') }}" class="nav-link cart-link"><i
                                                class='bx bx-user'></i></a>
                                    </li>
                                @endguest
                                @guest
                                    <li class="nav-item"><a href="{{ route('web.customer.account')}}" class="nav-link cart-link"><i class="fas fa-plus-circle"></i></a>
                                    </li>
                                @endguest
                                <li class="nav-item dropdown dropdown-large">
                                    <a href="#"
                                        class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative cart-link"
                                        data-bs-toggle="dropdown">
                                        <span class="alert-count">{{ Cart::getContent()->count() }}</span>
                                        <i class='bx bx-shopping-bag'></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a href="{{ route('web.checkout.details') }}">
                                            <div class="cart-header">
                                                <p class="mb-0 cart-header-title"> {{ Cart::getContent()->count() }}
                                                    ITEMS</p>
                                                <p class="mb-0 cart-header-clear ms-auto">VIEW CART</p>
                                            </div>
                                        </a>
                                        <div class="cart-list">
                                            @forelse (Cart::getContent() as $data)
                                                <a class="dropdown-item" href="">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1">
                                                            <h6 class="cart-product-title">
                                                                {{ Str::limit($data->name, 25, '...') }}</h6>
                                                            <p class="cart-product-price">{{ $data->quantity }} X
                                                                ৳ {{ $data->price }}</p>
                                                        </div>
                                                        <div class="position-relative">
                                                            <div onclick="removeItem({{ $data->id }})"
                                                                class="cart-product-cancel position-absolute">
                                                                <i class='bx bx-x'></i>
                                                            </div>
                                                            <div class="cart-product">
                                                                <img src="{{ asset($data->attributes->image) }}"
                                                                    class="" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            @empty
                                                <h5 class="mt-5 text-center"> <i class="bx bxs-cart-alt fs-5"></i>
                                                    Cart
                                                    Empty</h5>
                                            @endforelse

                                        </div>
                                        <a href="javascript:;">
                                            <div class="text-center cart-footer d-flex align-items-center">
                                                <h5 class="mb-0">TOTAL</h5>
                                                <h5 class="mb-0 ms-auto cart-total">৳
                                                    {{ Cart::getSubTotal() === 0 ? '0.00' : Cart::getSubTotal() }}</h5>
                                            </div>
                                        </a>
                                        <div class="p-3 d-grid border-top"> <a
                                                href="{{ route('web.checkout.details') }}"
                                                class="btn btn-dark btn-ecomm">CHECKOUT</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>

    <div class="primary-menu">
        <nav class="container p-0 mb-0 navbar navbar-expand-xl w-100 navbar-dark">
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar">
                <div class="offcanvas-header">
                    <div class="offcanvas-logo">
                        <img src="{{ asset('frontend') }}/assets/images/logo-icon.png" width="100"
                            alt="">
                    </div>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body primary-menu">
                    <ul class="gap-1 navbar-nav justify-content-start flex-grow-1">
                        @foreach (headerMenu() as $menu)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url($menu->menu_link) }}">{{ $menu->menu_name }}</a>
                            </li>
                        @endforeach
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="{{ route('web.contact.form') }}">
                                Contact
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="{{route('web.electrician.home')}}">
                                Electrician
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="{{route('partner.registration.index')}}">
                                Partner
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>
<script>
    function removeItem(id) {
        $.ajax({
            url: "/remove-to-cart/" + id,
            type: "GET",
            success: function(data) {
                location.reload();
            }
        });
    }
</script>
