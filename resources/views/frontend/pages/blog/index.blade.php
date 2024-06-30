@extends('frontend.layouts.app')
@section('frontend-title', 'Blog')
@section('web.content')
    <!--start breadcrumb-->
    <section class="py-3 border-bottom border-top d-none d-md-flex bg-light">
        <div class="container">
            <div class="page-breadcrumb d-flex align-items-center">
                <div class="breadcrumb-title pe-3">Blog</div>
                <div class="ms-auto">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('web.home') }}"><i class="bx bx-home-alt"></i>
                                    Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Blog</li>
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
                    <div class="blog-right-sidebar">
                        @foreach ($posts as $post)
                            <div class="card mb-4 rounded-0 border shadow-none">
                                <img src="{{ asset($post->post_feature_image) }}" class="card-img-top rounded-0"
                                    alt="">
                                <div class="card-body">
                                    <div class="list-inline"> <a href="javascript:;" class="list-inline-item"><i
                                                class='bx bx-user me-1'></i>By Admin</a>
                                        <a href="javascript:;" class="list-inline-item"><i class='bx bx-calendar me-1'></i>
                                            {{ $post->created_at->format('F j, Y') }}</a>
                                    </div>
                                    <h4 class="mt-4">{{ $post->post_title }}</h4>
                                    <p>{{ $post->post_short_details }}</p>
                                    <a href="{{ route('web.blog.single', $post->post_url) }}"
                                        class="btn btn-dark btn-ecomm">Read More <i class='bx bx-chevrons-right'></i></a>
                                </div>
                            </div>
                        @endforeach
                        <hr>
                        {{ $posts->links('pagination::bootstrap-5') }}
                    </div>
                </div>
                @include('frontend.pages.blog.post_sidebar')
            </div>
            <!--end row-->
        </div>
    </section>
    <!--end start page content-->
    </div>
    </div>
    <!--end page wrapper -->
@endsection
