@extends('backend.layouts.layout')
@section('admin-title', 'Static Banner Managment')
@section('admin_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4><b>All Static Banner</b>
                        @if (count($staticBanner) >= 7)
                            <button disabled class="btn btn-sm btn-primary" style="float: right"><i
                                    class="bx bx-plus-medical"></i>
                                Create Banner</button>
                        @else
                            <button data-bs-toggle="modal" data-bs-target="#addStaticBanner" class="btn btn-sm btn-primary"
                                style="float: right"><i class="bx bx-plus-medical"></i> Create Banner</button>
                        @endif
                    </h4>
                </div>
                <div class="px-2 card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Sub Title</th>
                                <th>Banner Type</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($staticBanner as $key => $banner)
                                <tr>
                                    <td width="20%">
                                        <img height="75px" class="rounded" src="{{ asset($banner->sb_image) }}"
                                            alt="banner Image">
                                    </td>
                                    <td>
                                        {{ $banner->sb_title }}
                                    </td>
                                    <td>{{ $banner->sb_sub_title }}</td>
                                    <td>{{ $banner->sb_banner_type }}</td>
                                    <td class="text-center">
                                        <a class="btn btn-sm btn-primary"
                                            href="{{ route('admin.static.banner.edit', $banner->sb_slug) }}">
                                            <i class="bx bxs-pencil"></i>
                                        </a>
                                        <a id="delete" class="btn btn-sm btn-danger"
                                            href="{{ route('admin.static.banner.delete', $banner->sb_slug) }}">
                                            <i class="bx bxs-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <!-- Static Banner Create Modal -->
    <div class="modal fade" id="addStaticBanner" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Static Banner Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.static.banner.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-2 form-group">
                            <label for="">Banner Type</label>
                            <select class="form-control @error('sb_banner_type') is-invalid @enderror" name="sb_banner_type"
                                id="static_banner_type">
                                <option label="Select Banner Type"></option>
                                <option value="header">Header Banner</option>
                                <option value="footer">Footer Banner</option>
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
                                name="sb_title" placeholder="Enter Title" value="{{ old('sb_title') }}" required>
                            @error('sb_title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-2 form-group">
                            <label for="">Sub Title</label>
                            <input class="form-control @error('sb_sub_title') is-invalid @enderror" type="text"
                                name="sb_sub_title" placeholder="Enter Sub-Title" value="{{ old('sb_sub_title') }}"
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
                                name="sb_button_url" placeholder="Enter Url" value="{{ old('sb_button_url') }}">
                            @error('sb_button_url')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-2 form-group d-none" id="static-banner-input-header">
                            <label for="">Banner Image (208 * 208)</label>
                            <input class="form-control" type="file" name="header_image">
                            @error('header_image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-2 form-group d-none" id="static-banner-input-footer">
                            <label for="">Banner Image (400 * 400)</label>
                            <input class="form-control" type="file" name="footer_image">

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Banner</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Static Banner Create End Modal -->
@endsection
