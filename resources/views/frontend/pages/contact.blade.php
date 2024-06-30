@extends('frontend.layouts.app')
@section('frontend-title', 'Contact Us')
@section('web.content')
    <!--start breadcrumb-->
    <section class="py-3 border-bottom border-top d-none d-md-flex bg-light">
        <div class="container">
            <div class="page-breadcrumb d-flex align-items-center">
                <h3 class="breadcrumb-title pe-3">Contact Us</h3>
                <div class="ms-auto">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('web.home') }}"><i class="bx bx-home-alt"></i>
                                    Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
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
            <h3 class="d-none">Google Map</h3>
            <div class="contact-map p-3 bg-light rounded-0 shadow-none">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2582.512033868398!2d90.37306633773052!3d23.73940657179627!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x9d3f2cba778ac190!2sDigital%20Hub%20Solutions%20LTD!5e0!3m2!1sen!2sbd!4v1675095577242!5m2!1sen!2sbd"
                    class="w-100" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </section>
    <section class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-10">
                    <div class="p-3 bg-light">
                        <form method="POST" action="{{ route('web.contact.store') }}">
                            @csrf
                            <div class="form-body">
                                <h6 class="mb-0 text-uppercase">Drop us a line</h6>
                                <div class="my-3 border-bottom"></div>
                                <div class="mb-3">
                                    <label class="form-label">Enter Your Name</label>
                                    <input name="user_name" type="text"
                                        class="form-control @error('user_name') is-invalid @enderror"
                                        value="{{ old('user_name') }}" />
                                    @error('user_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Enter Email</label>
                                    <input type="email" name="user_email"
                                        class="form-control @error('user_email') is-invalid @enderror"
                                        value="{{ old('user_email') }}" />
                                    @error('user_email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Phone Number</label>
                                    <input type="phone" name="user_phone"
                                        class="form-control @error('user_phone') is-invalid @enderror"
                                        value="{{ old('user_phone') }}" />
                                    @error('user_phone')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Message</label>
                                    <textarea name="user_message" class="form-control @error('user_message') is-invalid @enderror" rows="4"
                                        cols="4" value="{{ old('user_message') }}"></textarea>
                                    @error('user_message')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-dark btn-ecomm">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                {{-- <div class="col-lg-4">
                    <div class="p-3 bg-light">
                        <div class="address mb-3">
                            <h6 class="mb-0 text-uppercase">Address</h6>
                            <p class="mb-0 font-12">123 Street Name, City, Australia</p>
                        </div>
                        <div class="phone mb-3">
                            <h6 class="mb-0 text-uppercase">Phone</h6>
                            <p class="mb-0 font-13">Toll Free (123) 472-796</p>
                            <p class="mb-0 font-13">Mobile : +91-9910XXXX</p>
                        </div>
                        <div class="email mb-3">
                            <h6 class="mb-0 text-uppercase">Email</h6>
                            <p class="mb-0 font-13">mail@example.com</p>
                        </div>
                        <div class="working-days mb-3">
                            <h6 class="mb-0 text-uppercase">WORKING DAYS</h6>
                            <p class="mb-0 font-13">Mon - FRI / 9:30 AM - 6:30 PM</p>
                        </div>
                    </div>
                </div> --}}
            </div>
            <!--end row-->
        </div>
    </section>
    <!--end start page content-->
@endsection
