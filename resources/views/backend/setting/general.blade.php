@extends('backend.layouts.layout')
@section('admin-title', 'General Setting')
@section('admin_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4><b>General Setting</b></h4>
                </div>
                <div class="card-body px-2">
                    <form action="{{ route('admin.setting.general.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $setting->id }}">
                        <input type="hidden" name="old_basic_logo" value="{{ $setting->basic_logo }}">
                        <input type="hidden" name="old_basic_flogo" value="{{ $setting->basic_flogo }}">
                        <input type="hidden" name="old_basic_favicon" value="{{ $setting->basic_favicon }}">
                        <div class="modal-body">
                            <div class="row  align-items-center p-3">
                                <div class="col-md-4 pb-3">
                                    <div class="form-group mb-2">
                                        <label class="form-label">Website Name</label>
                                        <input class="form-control @error('basic_company') is-invalid @enderror"
                                            type="text" name="basic_company" placeholder="Enter Company Name"
                                            value="{{ $setting->basic_company }}">
                                        @error('basic_company')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 pb-3">
                                    <div class="form-group mb-2">
                                        <label class="form-label">Website Url</label>
                                        <input class="form-control @error('basic_url') is-invalid @enderror" type="text"
                                            name="basic_url" placeholder="example.com" value="{{ $setting->basic_url }}">
                                        @error('basic_url')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 pb-3">
                                    <div class="form-group mb-2">
                                        <label class="form-label">Invoice Code</label>
                                        <input class="form-control @error('invoice_code') is-invalid @enderror" type="text"
                                            name="invoice_code" placeholder="DEMO-" value="{{ $setting->invoice_code }}">
                                        @error('basic_url')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 pb-3">
                                    <div class="form-group mb-2">
                                        <label class="form-label">Website Title</label>
                                        <input class="form-control @error('basic_title') is-invalid @enderror"
                                            type="text" name="basic_title" placeholder="Enter Title"
                                            value="{{ $setting->basic_title }}">
                                        @error('basic_title')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 text-center">
                                    <div class="form-group mb-2">
                                        <label class="form-label" style="float: left;">Logo</label>
                                        <input id="input_image" class="form-control" type="file" name="basic_logo">
                                        @if (File::exists($setting->basic_logo))
                                            <img id="input_image_preview" class="mt-3" width="100px" height="100px"
                                                src="{{ asset($setting->basic_logo) }}" alt="">
                                        @else
                                            <img id="input_image_preview" class="mt-3" width="100px" height="100px"
                                                src="{{ asset('backend/assets/images/default_image.png') }}"
                                                alt="">
                                        @endif
                                        @error('basic_logo')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 text-center">
                                    <div class="form-group mb-2">
                                        <label class="form-label" style="float: left;">Footer Logo</label>
                                        <input id="input_image_2" class="form-control" type="file" name="basic_flogo">
                                        @if (File::exists($setting->basic_flogo))
                                            <img id="input_image_preview_2" class="mt-3" width="100px" height="100px"
                                                src="{{ asset($setting->basic_flogo) }}" alt="">
                                        @else
                                            <img id="input_image_preview_2" class="mt-3" width="100px" height="100px"
                                                src="{{ asset('backend/assets/images/default_image.png') }}"
                                                alt="">
                                        @endif

                                        @error('basic_flogo')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 text-center">
                                    <div class="form-group mb-2">
                                        <label class="form-label" style="float: left;">Favicon</label>
                                        <input id="input_image_3" class="form-control" type="file" name="basic_favicon">
                                        @if (File::exists($setting->basic_favicon))
                                            <img id="input_image_preview_3" class="mt-3" width="100px" height="100px"
                                                src="{{ asset($setting->basic_favicon) }}" alt="">
                                        @else
                                            <img id="input_image_preview_3" class="mt-3" width="100px" height="100px"
                                                src="{{ asset('backend/assets/images/default_image.png') }}"
                                                alt="">
                                        @endif
                                        @error('basic_favicon')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12 text-center mt-3">
                                    <div class="form-group mb-2">
                                        <label class="form-label" style="float: left;">Invoice Additional Message</label>
                                        <textarea class="form-control" name="invoice_additional" id="invoice_additional" rows="5">{{ $setting->invoice_additional }}</textarea>
                                        @error('invoice_additional')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer p-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="bx bx-save w-2"></i> Setting Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection
