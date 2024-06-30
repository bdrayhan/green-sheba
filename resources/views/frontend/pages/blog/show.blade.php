@extends('frontend.layouts.app')
@section('frontend-title', 'Blog')
@section('web.content')
    <!--start breadcrumb-->
    <section class="py-3 border-bottom border-top d-none d-md-flex bg-light">
        <div class="container">
            <div class="page-breadcrumb d-flex align-items-center">
                <h3 class="breadcrumb-title pe-3">Single Post</h3>
                <div class="ms-auto">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('web.home') }}"><i class="bx bx-home-alt"></i>
                                    Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('web.blog.all') }}">Blog</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $post->post_title }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!--end breadcrumb-->
    <!--start page content-->
    <section class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-9">
                    <div class="blog-right-sidebar p-3">
                        <div class="card shadow-none bg-transparent">
                            <img src="{{ asset($post->post_feature_image) }}" class="img-fluid" alt="">
                            <div class="card-body p-0">
                                <div class="list-inline mt-4"> <a href="javascript:;" class="list-inline-item"><i
                                            class='bx bx-user me-1'></i>By Admin</a>
                                    <a href="javascript:;" class="list-inline-item"><i class='bx bx-calendar me-1'></i>
                                        {{ $post->created_at->format('F j, Y') }}</a>
                                </div>
                                <h4 class="mt-4">{{ $post->post_title }}</h4>
                                <p>{{ $post->post_details }}</p>
                                <div class="d-flex align-items-center gap-2 py-4 border-top border-bottom">
                                    <div class="">
                                        <h6 class="mb-0 text-uppercase">Share This Post</h6>
                                    </div>
                                    <div class="list-inline blog-sharing"> <a href="javascript:;"
                                            class="list-inline-item"><i class='bx bxl-facebook'></i></a>
                                        <a href="javascript:;" class="list-inline-item"><i class='bx bxl-twitter'></i></a>
                                        <a href="javascript:;" class="list-inline-item"><i class='bx bxl-linkedin'></i></a>
                                        <a href="javascript:;" class="list-inline-item"><i class='bx bxl-instagram'></i></a>
                                        <a href="javascript:;" class="list-inline-item"><i class='bx bxl-tumblr'></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php
                            $relatedPosts = App\Models\Post::where('post_status', 1)
                                ->where('post_active', 1)
                                ->where('bc_id', $post->bc_id)
                                ->where('post_id', '!=', $post->post_id)
                                ->orderBy('post_id', 'DESC')
                                ->limit(5)
                                ->get();
                        @endphp
                        <div class="product-grid">
                            <h5 class="text-uppercase my-4">Latest Post</h5>
                            <div class="latest-news owl-carousel owl-theme">
                                @foreach ($relatedPosts as $related)
                                    <div class="item">
                                        <div class="card rounded-0 product-card border">
                                            <div class="news-date">
                                                <div class="date-number"> {{ $post->created_at->format('j') }}</div>
                                                <div class="date-month">{{ $post->created_at->format('M') }}</div>
                                            </div>
                                            <a href="{{ route('web.blog.single', $related->post_url) }}">
                                                <img src="{{ asset($related->post_feature_image) }}"
                                                    class="card-img-top border-bottom" alt="...">
                                            </a>
                                            <div class="card-body">
                                                <div class="news-title">
                                                    <a href="{{ route('web.blog.single', $related->post_url) }}">
                                                        <h5 class="mb-3 text-capitalize">{{ $related->post_title }}</h5>
                                                    </a>
                                                </div>
                                                <p class="news-content mb-0">{{ $related->post_short_details }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @include('frontend.pages.blog.post_sidebar')
            </div>
            <!--end row-->
        </div>
    </section>
    <!--end start page content-->
@endsection
