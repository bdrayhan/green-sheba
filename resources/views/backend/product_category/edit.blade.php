@extends('backend.layouts.layout')
@section('admin-title', 'Category Managment')
@section('admin_content')

    <div class="card">
        <div class="card-body">

            <h4 class="card-title">Product Category Information
                <a href="{{ route('admin.product.category.index') }}" class="btn btn-info btn-sm" style="float: right;">All
                    Category</a>
            </h4>
            <p class="card-title-desc">Fill all information below and update</p>

            <form action="{{ route('admin.product.category.update', $category->pc_slug) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input class="form-control" type="hidden" name="old_image" value="{{ $category->pc_image }}">

                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="">Name <span class="text-danger">*</span></label>
                            <input class="form-control @error('pc_name') is-invalid @enderror" type="text"
                                name="pc_name" placeholder="Category Name" value="{{ $category->pc_name }}">
                            @error('pc_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">

                        </div>
                        <div class="mb-3">
                            <label for="">Url</label>
                            <input class="form-control" type="text" name="pc_url"
                                placeholder="Enter Your Url" value="{{ $category->pc_url }}">
                            @error('pc_url')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="">Image</label>
                            <input id="input_image" class="form-control" type="file" name="pc_image">
                            @if (File::exists($category->pc_image))
                                <img id="input_image_preview" class="rounded me-2 my-2" width="100px" height="100px"
                                    src="{{ asset($category->pc_image) }}" alt="">
                            @else
                                <img id="input_image_preview" class="rounded me-2 my-2" width="100px" height="100px"
                                    src="{{ asset('backend/assets/images/default_image.png') }}" alt="">
                            @endif
                        </div>

                    </div>

                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="">Order By</label>
                            <input class="form-control" type="number" name="pc_orderby" placeholder="Order Id"
                                value="{{ $category->pc_orderby }}">
                            @error('pc_orderby')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="">Remarks</label>
                            <textarea class="form-control" name="pc_remarks" placeholder="Enter Your Remarks">{{ $category->pc_remarks }}</textarea>
                            @error('pc_remarks')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </div>

                <div class="d-flex flex-wrap gap-2">
                    <button type="submit" class="btn btn-primary waves-effect waves-light"><i class="bx bx-sync"></i> Update</button>
                </div>
            </form>

        </div>
    </div>
@endsection
