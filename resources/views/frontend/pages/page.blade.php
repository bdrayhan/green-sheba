
@extends('frontend.layouts.app')
@section('frontend-title', $page->page_name)
@section('web.content')
    <!-- ABOUT-US CONTENT Start -->
    <!--start breadcrumb-->
    <section class="py-3 border-bottom border-top d-none d-md-flex bg-light">
        <div class="container">
            <div class="page-breadcrumb d-flex align-items-center">
                <h3 class="breadcrumb-title pe-3">{{ $page->page_name }}</h3>
                <div class="ms-auto">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i> Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $page->page_name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!--end breadcrumb-->
    <section class="py-0 py-lg-4">
        <div class="container">
            <p>{!! $page->page_content !!}</p>
        </div>
    </section>
    <!-- ABOUT-US CONTENT End -->
@endsection
