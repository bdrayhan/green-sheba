@extends('backend.layouts.layout')
@section('admin-title', 'Product Purchase Managment')
@section('admin_content')
    @push('custom-style')
        <link href="{{ asset('backend') }}/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    @endpush

    <div class="row d-flex justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <h4>Static Banner Information</b>
                        <a href="{{ route('admin.static.banner.index') }}" class="btn btn-sm btn-primary"
                            style="float: right"><i class="bx bx-left-arrow-alt"></i> Back</a>
                    </h4>
                </div>
                <div class="px-2 card-body">
                    <form action="{{ route('admin.static.banner.update', $banner->sb_slug) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="old_image" value="{{ $banner->sb_image }}">
                        <div class="modal-body">
                            <div class="mb-2 form-group">
                                <label for="">Banner Type</label>
                                <select class="form-control @error('sb_banner_type') is-invalid @enderror"
                                    name="sb_banner_type" id="static_banner_type">
                                    <option label="Select Banner Type"></option>
                                    <option value="header" {{ $banner->sb_banner_type == 'header' ? 'selected' : '' }}>
                                        Header Banner</option>
                                    <option value="footer" {{ $banner->sb_banner_type == 'footer' ? 'selected' : '' }}>
                                        Footer Banner</option>
                                </select>
                                @error('sb_banner_type')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-2 form-group">
                                <label for="">Title</label>
                                <input class="form-control @error('sb_title') is-invalid @enderror" type="text"
                                    name="sb_title" placeholder="Enter Title" value="{{ $banner->sb_title }}" required>
                                @error('sb_title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-2 form-group">
                                <label for="">Sub Title</label>
                                <input class="form-control @error('sb_sub_title') is-invalid @enderror" type="text"
                                    name="sb_sub_title" placeholder="Enter Sub-Title" value="{{ $banner->sb_sub_title }}"
                                    required>
                                @error('sb_sub_title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-2 form-group">
                                <label for="">Button Url</label>
                                <input class="form-control @error('sb_button_url') is-invalid @enderror" type="text"
                                    name="sb_button_url" placeholder="Enter Url" value="{{ $banner->sb_button_url }}">
                                @error('sb_button_url')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-2 form-group d-none" id="static-banner-input-header">
                                <label for="">Banner Image (208 * 208)</label>
                                <input class="form-control" type="file" name="header_image">
                            </div>
                            <div class="mb-2 form-group d-none" id="static-banner-input-footer">
                                <label for="">Banner Image (400 * 400)</label>
                                <input class="form-control" type="file" name="footer_image">
                            </div>

                            <div class="my-3 text-center form-group">
                                <img height="100px" class="rounded" src="{{ asset($banner->sb_image) }}"
                                    alt="Static Baner">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">
                                <i class="w-2 bx bx-save"></i> Update Banner</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection
