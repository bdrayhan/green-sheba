{{-- @extends('frontend.layouts.app')
@section('frontend-title', 'Home')
@section('web.content')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--start breadcrumb-->
            <section class="py-3 border-bottom border-top d-none d-md-flex bg-light">
                <div class="container">
                    <div class="page-breadcrumb d-flex align-items-center">
                        <h3 class="breadcrumb-title pe-3">My Address</h3>
                        <div class="ms-auto">
                            <nav aria-label="breadcrumb">
                                <ol class="p-0 mb-0 breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('web.home') }}"><i
                                                class="bx bx-home-alt"></i>
                                            Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('web.user.account') }}">Account</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Address</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </section>
            <!--end breadcrumb-->
            <!--start shop cart-->
            <section class="py-4">
                <div class="container">
                    <h3 class="d-none">Account</h3>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                @include('frontend.pages.account.profilebar')
                                <div class="col-lg-8">
                                    <div class="mb-0 border shadow-none card">
                                        <div class="card-body">
                                            <h6 class="mb-4">The following addresses will be used on the checkuot page by
                                                default.</h6>
                                            <div class="row">
                                                <div class="col-12 col-lg-6">
                                                    <form class="row g-3" action="{{ route('web.user.address.update') }}"
                                                        method="POST">
                                                        @csrf
                                                        <div class="col-12">
                                                            <label class="form-label">City</label>
                                                            <input name="city" type="text" class="form-control"
                                                                placeholder="City" value="{{ $user->city }}">
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label">Postel Code</label>
                                                            <input name="post_code" type="number" class="form-control"
                                                                value="{{ $user->post_code }}" placeholder="Post Code">
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label">Country</label>
                                                            <select name="country" class="form-control">
                                                                <option label="Select Country"></option>
                                                                <option value="bangladesh"
                                                                    {{ $user->country == 'bangladesh' ? 'selected' : '' }}>
                                                                    Bangladesh</option>
                                                                <option value="india"
                                                                    {{ $user->country == 'india' ? 'selected' : '' }}>India
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label">Address</label>
                                                            <textarea name="address" class="form-control">{{ $user->address }}</textarea>
                                                        </div>
                                                        <div class="col-12">
                                                            <button type="submit" class="btn btn-dark btn-ecomm">Save
                                                                Changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                {{-- <div class="col-12 col-lg-6">
                                                    <h5 class="mb-3">Billing Addresses</h5>
                                                    <address>
                                                        Madison Riiz<br>
                                                        123 Happy Street<br>
                                                        Cape Town<br>
                                                        Western Cape<br>
                                                        8001<br>
                                                        South Africa
                                                    </address>
                                                </div> --}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end row-->
                        </div>
                    </div>
                </div>
            </section>
            <!--end shop cart-->
        </div>
    </div>
    <!--end page wrapper -->
@endsection --}}
