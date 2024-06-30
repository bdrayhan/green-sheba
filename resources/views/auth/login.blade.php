@extends('frontend.layouts.app')
@section('frontend-title', 'Login')
@section('web.content')
    <!--start shop cart-->
    <section class="" style="margin-top: 200px;">
        <div class="container">
            <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5">
                <div class="row row-cols-1 row-cols-xl-2">
                    <div class="col mx-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="border p-4 rounded">
                                    <div class="text-center">
                                        <h3 class="text-warning">Sign in</h3>
{{--                                        <p>Don't have an account yet? <a class="text-warning"--}}
{{--                                                href="{{ route('register') }}">Sign up--}}
{{--                                                here</a>--}}
{{--                                        </p>--}}
                                    </div>
                                    <div class="form-body">
                                        <form action="{{ route('login') }}" class="row g-3" method="POST">
                                            @csrf
                                            <div class="col-12">
                                                <label for="inputEmailAddress" class="form-label">Email Address</label>
                                                <input name="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    id="inputEmailAddress" placeholder="Email Address"
                                                    value="{{ old('email') }}">
                                                @error('email')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <label for="inputChoosePassword" class="form-label">Enter Password</label>
                                                <div class="input-group" id="show_hide_password">
                                                    <input name="password" type="password" class="form-control border-end-0"
                                                        id="inputChoosePassword" placeholder="Enter Password">
                                                    <a id="passwordShow" href="javascript:;"
                                                        class="input-group-text bg-transparent"><i
                                                            class='bx bx-hide'></i></a>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check form-switch">
                                                    <input name="remember" class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckChecked">
                                                    <label class="form-check-label" for="flexSwitchCheckChecked">Remember
                                                        Me</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 text-end"> <a class="text-warning"
                                                    href="#">Forgot
                                                    Password ?</a>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-dark"><i
                                                            class="bx bxs-lock-open"></i>Sign in</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <p class="text-center">©
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> DigitalHub. Crafted with <i class="mdi mdi-heart text-danger"></i>
                                by
                                Khayrul Shanto
                            </p>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </section>
@endsection
