@extends('frontend.layouts.app')
@section('frontend-title', 'Sing Up')
@section('web.content')
    <!--start shop cart-->
    <section class="py-0 py-lg-5" style="margin-top: 100px;">
        <div class="container">
            <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5">
                <div class="row row-cols-1 row-cols-lg-1 row-cols-xl-2">
                    <div class="col mx-auto">
                        <div class="card mb-0">
                            <div class="card-body">
                                <div class="border p-4 rounded">
                                    <div class="text-center">
                                        <h3 class="">Sign Up</h3>
                                        <p>Already have an account? <a class="text-warning" href="{{ route('login') }}">Sign
                                                in here</a>
                                        </p>
                                    </div>
                                    <div class="form-body">
                                        <form class="row g-3" method="POST" action="{{route('web.customer.account.register')}}">
                                            @csrf
                                            <div class="col-sm-6">
                                                <label for="inputFirstName" class="form-label">First Name<span
                                                        class="text-danger">*</span></label>
                                                <input name="first_name" type="text"
                                                    class="form-control @error('first_name') is-invalid @enderror"
                                                    id="inputFirstName" placeholder="First Name"
                                                    value="{{ old('first_name') }}">
                                                @error('email')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="inputLastName" class="form-label">Last Name<span
                                                        class="text-danger">*</span></label>
                                                <input name="last_name" type="text"
                                                    class="form-control @error('last_name') is-invalid @enderror"
                                                    id="inputLastName" placeholder="Last Name"
                                                    value="{{ old('last_name') }}">
                                                @error('last_name')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <label for="inputEmailAddress" class="form-label">Email Address<span
                                                        class="text-danger">*</span></label>
                                                <input name="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    id="inputEmailAddress" placeholder="example@user.com"
                                                    value="{{ old('email') }}">
                                                @error('email')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <label for="inputChoosePassword" class="form-label">Password<span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group" id="show_hide_password">
                                                    <input name="password" type="password"
                                                        class="form-control border-end-0 @error('password') is-invalid @enderror"
                                                        id="inputChoosePassword" placeholder="Enter Password"> <a
                                                        id="passwordShow" href="javascript:;"
                                                        class="input-group-text bg-transparent"><i
                                                            class='bx bx-show'></i></a>
                                                </div>
                                                @error('password')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <label for="Phone" class="form-label">Phone<span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <a href="javascript:;" class="input-group-text bg-transparent">
                                                        +880
                                                    </a>
                                                    <input name="phone" type="number" class="form-control border-end-0"
                                                        placeholder="Phone" value="{{ old('phone') }}">
                                                </div>
                                                @error('phone')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckChecked">
                                                    <label class="form-check-label" for="flexSwitchCheckChecked">I read and
                                                        agree to <a href="#" class="text-warning">Terms &
                                                            Conditions</a></label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-dark"><i
                                                            class='bx bx-user'></i>Sign up</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </section>
    <!--end shop cart-->
@endsection






{{-- ======================================================================================== --}}







{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />

                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />

                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ml-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout> --}}
