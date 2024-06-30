@extends('frontend.layouts.app')
@section('frontend-title', 'Categories')
@section('web.content')
    <!-- ABOUT-US CONTENT Start -->
    <!--start breadcrumb-->
    <section class="py-3 border-bottom border-top d-none d-md-flex bg-light">
        <div class="container">
            <div class="page-breadcrumb d-flex align-items-center">
                <h3 class="breadcrumb-title pe-3">All Category</h3>
                <div class="ms-auto">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('web.home') }}"><i class="bx bx-home-alt"></i>
                                    Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">All Category</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!--end breadcrumb-->
    <!-- Start Category Show -->
    <section class="py-4">
        <div class="container">
            <div class="row row-cols-2 row-cols-lg-6 g-3">
                @foreach($categories as $category)
                    <a href="{{ route('web.single.category', $category->pc_url) }}">
                        <div class="col">
                            <div class="text-center">
                                <div class="text-dark pb-2 border border-1 border-dark p-3">
                                    <img class="img-thumbnail rounded-circle" src="{{ $category->pc_image }}" alt="" style="">
                                </div>
                                <span class="fw-bold font-14 link-dark">{{ $category->pc_name }}</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            <!-- end row -->
        </div>
    </section>
    <!-- End Category Show -->
<!-- end shop categories-->
@endsection
