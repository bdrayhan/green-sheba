@extends('backend.layouts.layout')
@section('admin-title', 'Blog Managment')
@section('admin_content')
    <div class="row d-flex justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <h4><b>All Blog</b>
                        <a href="{{ route('admin.blog.index') }}" class="btn btn-sm btn-primary" style="float: right"><i
                                class="bx bx-arrow-back"></i> Back</a>
                    </h4>
                </div>
                <form action="{{ route('admin.blog.update', $post->post_slug) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="old_image" value="{{ $post->post_feature_image }}">
                    <div class="card-body px-2">
                        <div class="row flex justify-content-center">
                            <div class="col-lg-12">
                                <div class="row mb-3">
                                    <label for="horizontal-firstname-input" class="col-sm-2 col-form-label">BLog
                                        Title <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input name="post_title" type="text"
                                            class="form-control  @error('post_title') is-invalid @enderror"
                                            id="horizontal-firstname-input" placeholder="Enter Your Title"
                                            value="{{ $post->post_title }}">
                                        @error('post_title')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="horizontal-firstname-input" class="col-sm-2 col-form-label">BLog
                                        Category</label>
                                    <div class="col-sm-10">
                                        <select name="bc_id" class="form-control @error('bc_id') is-invalid @enderror">
                                            <option label="Select Category"></option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->bc_id }}"
                                                    {{ $category->bc_id == $post->bc_id ? 'selected' : '' }}>
                                                    {{ $category->bc_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('bc_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="horizontal-firstname-input" class="col-sm-2 col-form-label">BLog
                                        Url</label>
                                    <div class="col-sm-10">
                                        <input name="post_url" type="text"
                                            class="form-control  @error('post_url') is-invalid @enderror"
                                            id="horizontal-firstname-input" placeholder="Enter Your Url"
                                            value="{{ $post->post_url }}">
                                        @error('post_url')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="horizontal-firstname-input" class="col-sm-2 col-form-label">Feature
                                        Image</label>
                                    <div class="col-sm-10">
                                        <input id="input_image" name="post_feature_image" type="file"
                                            class="form-control">
                                        <img style="max-height: 90px;" class="mt-2" id="input_image_preview"
                                            src="{{ asset($post->post_feature_image) }}" alt="">
                                        @error('post_feature_image')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="horizontal-firstname-input" class="col-sm-2 col-form-label">Short
                                        Description</label>
                                    <div class="col-sm-10">
                                        <textarea name="post_short_details" id="" class="form-control">{{ $post->post_short_details }}</textarea>
                                        @error('post_short_details')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="horizontal-firstname-input" class="col-sm-2 col-form-label">
                                        Description</label>
                                    <div class="col-sm-10">
                                        <textarea id="blogEditor" name="post_details" id="" class="form-control">{{ $post->post_details }}</textarea>
                                        @error('post_details')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"> <i class="bx bx-sync fs-10"></i> Update
                                Post</button>
                        </div>
                    </div>
                </form>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection
