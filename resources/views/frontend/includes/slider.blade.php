<section class="slider-section mb-4">
    <div class="first-slider p-0">
        <div class="banner-slider owl-carousel owl-theme">
            @forelse ($banners as $banner)
                <div class="item">
                    <div class="position-relative">
                        <div class="position-absolute top-50 slider-content translate-middle">
                            <!-- <h3 class="h3 fw-bold d-none d-md-block">{{ $banner->banner_mid_title }}</h3>
                            <h1 class="h1 fw-bold">{{ $banner->banner_title }}</h1>
                            <p class="fw-bold text-dark d-none d-md-block"><i>{{ $banner->banner_sub_title }}</i></p>
                            <div class=""><a class="btn btn-dark btn-ecomm px-4"
                                    href="{{ $banner->banner_url }}">Shop
                                    Now</a>
                            </div> -->
                        </div>
                        <a href="{{ $banner->banner_url }}">
                            <img src="{{ asset($banner->banner_image) }}" class="img-fluid" alt="...">
                        </a>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </div>
</section>
