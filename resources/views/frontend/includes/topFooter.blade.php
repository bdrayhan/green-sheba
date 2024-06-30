@php
    $footerContact = App\Models\ContactInfo::firstOrFail();
    $supportLinks = App\Models\Page::where('page_status', 1)->get();
    $footerCategories = App\Models\ProductCategory::where('pc_active', 1)
        ->where('pc_status', 1)
        ->limit(7)
        ->get();
@endphp
<footer>
    <section class="py-5 border-top bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-4">
                <!-- Contact Info Start -->
                <div class="col">
                    <div class="footer-section1">
                        <h5 class="mb-4 text-uppercase fw-bold">Contact Info</h5>
                        <div class="mb-3 address">
                            <h6 class="mb-0 text-uppercase fw-bold">Address</h6>
                            <p class="mb-0">{{ $footerContact->ci_address1 }}</p>
                        </div>
                        <div class="mb-3 phone">
                            <h6 class="mb-0 text-uppercase fw-bold">Phone</h6>
                            <p class="mb-0">Mobile : +880-{{ $footerContact->ci_phone1 }}</p>
                        </div>
                        <div class="mb-3 email">
                            <h6 class="mb-0 text-uppercase fw-bold">Email</h6>
                            <p class="mb-0">{{ $footerContact->ci_email1 }}</p>
                        </div>
                        <div class="mb-3 working-days">
                            <h6 class="mb-0 text-uppercase fw-bold">WORKING DAYS</h6>
                            <p class="mb-0">{{ $footerContact->ci_working_info }}</p>
                        </div>
                    </div>
                </div>
                <!-- Category Start -->
                <div class="col">
                    <div class="footer-section2">
                        <h5 class="mb-4 text-uppercase fw-bold">Categories</h5>
                        <ul class="list-unstyled">
                            @forelse ($footerCategories as $category)
                                <li class="mb-1">
                                    <a style="font-size: 18px;"
                                        href="{{ route('web.single.category', $category->pc_url) }}"><i
                                            class='bx bx-chevron-right'></i>
                                        {{ $category->pc_name }}</a>
                                </li>
                            @empty
                            @endforelse
                        </ul>
                    </div>
                </div>
                <!-- Tag Start -->
                <!-- Category Start -->
                <div class="col">
                    <div class="footer-section2">
                        <h5 class="mb-4 text-uppercase fw-bold">Support Link</h5>
                        <ul class="list-unstyled">
                            @forelse ($supportLinks as $page)
                                <li class="mb-1">
                                    <a style="font-size: 18px;"
                                        href="{{ route('web.page.single', $page->page_url) }}"><i
                                            class='bx bx-chevron-right'></i>
                                        {{ $page->page_name }}
                                    </a>
                                </li>
                            @empty
                            @endforelse
                        </ul>
                    </div>
                </div>
                <!-- Subscriber Start -->
                <div class="col">
                    <div class="footer-section4">
                        <h5 class="mb-4 text-uppercase fw-bold">Affiliation</h5>
                        <div class="mt-3 download-app">
                            <div class="gap-2 d-flex align-items-center">
                                <a href="javascript:;">
                                    <img src="{{ asset('frontend') }}/assets/images/icons/apple-store.png"
                                        class="" width="140" alt="" />
                                </a>
                                <a href="javascript:;">
                                    <img src="{{ asset('frontend') }}/assets/images/icons/play-store.png" class=""
                                        width="140" alt="" />
                                </a>
                            </div>
                        </div>
                        <div class="mt-3 download-app">
                            <h6 class="mb-3 text-uppercase fw-bold">MemberShip</h6>
                            <div class="gap-2 d-flex align-items-center">
                                <a href="javascript:;">
                                    <img src="https://e-cab.net/public/web/img/logo.png" class="" width="140"
                                        alt="" />
                                </a>
                            </div>
                        </div>
                        <div class="mt-3 download-app">
                            <h6 class="mb-3 text-uppercase fw-bold">DBID Number</h6>
                            <div class="gap-2 d-flex align-items-center">
                                <a href="javascript:;">
                                    <img src="{{ asset('frontend') }}/assets/images/icons/apple-store.png"
                                        class="" width="140" alt="" />
                                </a>
                                <a href="javascript:;">
                                    <img src="{{ asset('frontend') }}/assets/images/icons/play-store.png"
                                        class="" width="140" alt="" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </section>
    <!-- CopyRight Start -->
    <section class="bottom-0 py-3 text-center footer-strip border-top positon-absolute">
        <div class="container">
            <div class="gap-3 d-flex flex-column flex-lg-row align-items-center justify-content-between">
                <p class="mb-0">Copyright © {{ date('Y') }}. All right reserved.</p>
                <div class="payment-icon">
                    <div class="row row-cols-auto g-2 justify-content-end">
                        <div class="col">
                            <img src="{{ asset('frontend') }}/assets/images/icons/visa.png" alt="" />
                        </div>
                        <div class="col">
                            <img src="{{ asset('frontend') }}/assets/images/icons/paypal.png" alt="" />
                        </div>
                        <div class="col">
                            <img src="{{ asset('frontend') }}/assets/images/icons/mastercard.png" alt="" />
                        </div>
                        <div class="col">
                            <img src="{{ asset('frontend') }}/assets/images/icons/american-express.png"
                                alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</footer>
