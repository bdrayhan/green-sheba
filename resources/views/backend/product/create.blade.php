@extends('backend.layouts.layout')
@section('admin-title', 'Product Managment')
@section('admin_content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h4 class="m-0">Create Product</h4>
                <div>
                    <button class="btn btn-primary ml-2 formSaveButton"><i class="bx bx-save font-size-16"></i></button>
                    <a href="{{ route('admin.product.index') }}" class="btn btn-dark"><i class="bx bx-undo font-size-16"></i></a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.product.insert') }}"
                        method="POST" id="productForm" enctype="multipart/form-data">
                    @csrf
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-bs-toggle="tab" href="#general" role="tab"
                                aria-selected="false" tabindex="-1">
                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                <span class="d-none d-sm-block">General</span>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#data" role="tab" aria-selected="false"
                                tabindex="-1">
                                <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                <span class="d-none d-sm-block">Data</span>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#options" role="tab" aria-selected="false"
                                tabindex="-1">
                                <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                <span class="d-none d-sm-block">Options</span>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#image" role="tab" aria-selected="false"
                                tabindex="-1">
                                <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                <span class="d-none d-sm-block">Image</span>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#seo" role="tab" aria-selected="true">
                                <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                <span class="d-none d-sm-block">Seo</span>
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content p-3 text-muted">
                        <!-- First Tab -->
                        <div class="tab-pane active show" id="general" role="tabpanel">
                            <div class="row mb-4">
                                <label for="product_name" class="col-sm-2 col-form-label text-end font-bold fs-5">
                                    Product Name <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input name="product_name" type="text" class="form-control @error('product_name') is-invalid @enderror" placeholder="Product Name"
                                    value="{{ old('product_name') }}" required>
                                    @error('product_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label for="product_url" class="col-sm-2 col-form-label text-end font-bold fs-5">
                                    Product Url<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input name="product_url" type="text"
                                        class="form-control @error('product_url') is-invalid @enderror"
                                        placeholder="Product Url" value="{{ old('product_url') }}" required>
                                    @error('product_url')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label for="category_id" class="col-sm-2 col-form-label text-end font-bold fs-5">Category<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <select class="form-control select2-multiple @error('category_id') is-invalid @enderror"
                                        name="category_id[]" id="category_id" multiple data-placeholder="Choose ...">
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->pc_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="size_id" class="col-sm-2 col-form-label text-end font-bold fs-5">Size</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2-multiple @error('size_id') is-invalid @enderror"
                                        name="size_id[]" id="size_id" multiple data-placeholder="Choose ...">
                                        @foreach ($sizes as $size)
                                        <option value="{{ $size->id }}">
                                            {{ $size->size_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('size_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label for="color_id" class="col-sm-2 col-form-label text-end font-bold fs-5">Color</label>
                                <div class="col-sm-10">
                                    <select
                                        class="form-control select2-multiple @error('color_id') is-invalid @enderror"
                                        name="color_id[]" id="color_id" multiple data-placeholder="Choose ...">
                                        @foreach ($colors as $color)
                                        <option value="{{ $color->id }}">
                                            {{ $color->color_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('color_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="product_video_link" class="col-sm-2 col-form-label text-end font-bold fs-5">
                                    Video Url</label>
                                <div class="col-sm-10">
                                    <input value="{{ old('product_video_link') }}" name="product_video_link" type="text" class="form-control" placeholder="Video Url">
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label for="short_details" class="col-sm-2 col-form-label text-end font-bold fs-5">
                                    Short Details<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="product_short_details" cols="30" rows="10"></textarea>
                                    @error('short_details')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label for="product_details" class="col-sm-2 col-form-label text-end font-bold fs-5">
                                    Details<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <textarea id="pageContent" class="form-control" name="product_details"></textarea>
                                    @error('product_details')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- Second Tab -->
                        <div class="tab-pane" id="data" role="tabpanel">
                            <div class="row mb-4">
                                <label for="product_code" class="col-sm-2 col-form-label text-end font-bold fs-5">
                                    Sku<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input value="{{ old('product_code') }}" name="product_code" type="text" class="form-control" placeholder="SKU">
                                    @error('product_code')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="product_quantity" class="col-sm-2 col-form-label text-end font-bold fs-5">
                                    Quantity<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input value="{{ old('product_quantity') }}" name="product_quantity" type="number" class="form-control" placeholder="Product Quantity">
                                    @error('product_quantity')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="product_regular_price" class="col-sm-2 col-form-label text-end font-bold fs-5">
                                    Reqular Price<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input value="{{ old('product_regular_price') }}" name="product_regular_price" type="number" class="form-control" placeholder="Requler Price" required>
                                    @error('product_regular_price')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="product_discount_price" class="col-sm-2 col-form-label text-end font-bold fs-5">Discount Price</label>
                                <div class="col-sm-10">
                                    <input value="{{ old('product_discount_price') }}" name="product_discount_price" type="number" class="form-control" placeholder="Discount Price">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="product_commission" class="col-sm-2 col-form-label text-end font-bold fs-5">Commission <span class="text-danger">*</span> </label>
                                <div class="col-sm-10">
                                    <input value="{{ old('product_commission') }}" name="product_commission" type="number" class="form-control" placeholder="Product Commission">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="product_stock_status" class="col-sm-2 col-form-label text-end font-bold fs-5">Stock Status<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="product_stock_status" required>
                                        <option value="1" {{ old('product_stock_status') == 1 ? 'selected' : '' }}>
                                            In Stock</option>
                                        <option value="0" {{ old('product_stock_status') == 0 ? 'selected' : '' }}>
                                            Out of Stock</option>
                                    </select>
                                    @error('product_stock_status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="product_active" class="col-sm-2 col-form-label text-end font-bold fs-5">Active Status<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="product_active" required>
                                        <option value="1" {{ old('product_active') == 1 ? 'selected' : '' }}>
                                            Enable</option>
                                        <option value="0" {{ old('product_active') == 0 ? 'selected' : '' }}>
                                            Disabled</option>
                                    </select>
                                    @error('product_active')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- Three Tab -->
                        <div class="tab-pane" id="options" role="tabpanel">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h4>Featrured</h4>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3 form-check form-switch form-switch-lg" dir="ltr">
                                                <input name="product_featured" class="form-check-input" type="checkbox"
                                                    id="SwitchCheckFeatured" value="1">
                                                <label class="form-check-label" for="SwitchCheckFeatured">Featured</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h4>Special Offer</h4>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3 form-check form-switch form-switch-lg" dir="ltr">
                                                <input name="product_hotDeal" class="form-check-input" type="checkbox"
                                                    id="SwitchCheckHotDeal" value="1">
                                                <label class="form-check-label" for="SwitchCheckHotDeal">Special
                                                    Offer</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h4>Best Rated</h4>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3 form-check form-switch form-switch-lg" dir="ltr">
                                                <input name="product_best_rated" class="form-check-input" type="checkbox"
                                                    id="SwitchCheckBestRated" value="1">
                                                <label class="form-check-label" for="SwitchCheckBestRated">Best
                                                    Rated</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h4>Trending</h4>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3 form-check form-switch form-switch-lg" dir="ltr">
                                                <input name="product_trending" class="form-check-input" type="checkbox"
                                                    id="SwitchCheckTrending" value="1">
                                                <label class="form-check-label" for="SwitchCheckTrending">Trending</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h4>Warranty</h4>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3 form-check form-switch form-switch-lg" dir="ltr">
                                                <input name="product_warranty" class="form-check-input" type="checkbox"
                                                    id="SwitchCheckWarranty" value="1">
                                                <label class="form-check-label text-danger" for="SwitchCheckWarranty">Warranty
                                                    available?</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h4>Back Order</h4>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3 form-check form-switch form-switch-lg" dir="ltr">
                                                <input name="product_back_order" class="form-check-input" type="checkbox"
                                                    id="SwitchCheckBackOrder" value="1">
                                                <label class="form-check-label" for="SwitchCheckBackOrder">Back Order</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fore Tab -->
                        <div class="tab-pane" id="image" role="tabpanel">
                            <div class="row mb-4 d-flex align-items-center justify-content-start">
                                <div class="col-sm-3">
                                    <img id="input_image_preview" class="mt-3 img-thumbnail" alt="200x200"
                                    width="200" src="{{ asset('media/default_image.png') }}"
                                    data-holder-rendered="true">
                                </div>
                                <div class="col-sm-9">
                                    <h4 class="cart-title text-danger">(400 * 400)</h4>
                                    <input name="product_thumbnail" type="file"
                                            class="form-control @error('product_thumbnail') is-invalid @enderror"
                                            id="input_image" required>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="cart-title">Product Gallery <span class="text-danger">(400 * 400)</span></h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-4 d-flex align-items-center justify-content-start">
                                            <div class="col-sm-9">
                                                <input id="multiImageInput" multiple name="multiImage[]" type="file" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 my-4 text-center">
                                                <div class="gallery"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Five Tab -->
                        <div class="tab-pane" id="seo" role="tabpanel">
                            <div class="row mb-4">
                                <label for="product_meta_title" class="col-sm-2 col-form-label text-end font-bold fs-5"> Title</label>
                                <div class="col-sm-10">
                                    <input value="{{ old('product_meta_title') }}" name="product_meta_title" type="text" class="form-control" placeholder="Title">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="product_meta_keyword" class="col-sm-2 col-form-label text-end font-bold fs-5"> Keyword</label>
                                <div class="col-sm-10">
                                    <input value="{{ old('product_meta_keyword') }}" name="product_meta_keyword" type="text" class="form-control" placeholder="Keyword">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="product_meta_details" class="col-sm-2 col-form-label text-end font-bold fs-5"> Details</label>
                                <div class="col-sm-10">
                                    <textarea  name="product_meta_details" class="form-control" cols="30" rows="10">{{ old('product_meta_details') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>






        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
<script script script src="{{ asset('backend') }}/assets/libs/jquery/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('.single-select').select2();
    });
    $(document).ready(function () {
        $('.select2-multiple').select2();
    });

    // Multiple images preview
    $(function() {
        var imagesPreview = function(input, placeToInsertImagePreview) {
            if (input.files) {
                var filesAmount = input.files.length;
                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();
                    reader.onload = function(event) {
                        $($.parseHTML('<img class="img-thumbnail m-2" width="150" height="150">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                    }
                    reader.readAsDataURL(input.files[i]);
                }
            }
        };
        $('#multiImageInput').on('change', function() {
            $('div.gallery').html('');
            imagesPreview(this, 'div.gallery');
        });
    });

    // button click form submit
    $('.formSaveButton').click(function () {

        // Product Name Validation
        var product_name = $('input[name="product_name"]').val();
        // Product Url Validation
        var product_url = $('input[name="product_url"]').val();
        // Category Validation
        var category_id = $('select[name="category_id[]"]').val();
        // Short Details Validation
        var product_short_details = $('textarea[name="product_short_details"]').val();
        // Details Validation
        var product_details = $('textarea[name="product_details"]').val();
        // Sku Validation
        var product_code = $('input[name="product_code"]').val();
        // Quantity Validation
        var product_quantity = $('input[name="product_quantity"]').val();
        // Reqular Price Validation
        var product_regular_price = $('input[name="product_regular_price"]').val();
        // Stock Status Validation
        var product_stock_status = $('select[name="product_stock_status"]').val();
        // Active Status Validation
        var product_active = $('select[name="product_active"]').val();
        // Image Validation
        var product_thumbnail = $('input[name="product_thumbnail"]').val();
        // Gallery Image Validation
        var multiImage = $('input[name="multiImage[]"]').val();

        if (product_name == '') {
            toastr.error('Product Name is Required!');
            return false;
        }
        if (product_url == '') {
            toastr.error('Product Url is Required!');
            return false;
        }
        if (category_id == '') {
            toastr.error('Category is Required!');
            return false;
        }
        if (product_short_details == '') {
            toastr.error('Short Details is Required!');
            return false;
        }
        if (product_details == '') {
            toastr.error('Details is Required!');
            return false;
        }
        if (product_code == '') {
            toastr.error('Sku is Required!');
            return false;
        }
        if (product_quantity == '') {
            toastr.error('Quantity is Required!');
            return false;
        }
        if (product_regular_price == '') {
            toastr.error('Reqular Price is Required!');
            return false;
        }
        if (product_stock_status == '') {
            toastr.error('Stock Status is Required!');
            return false;
        }
        if (product_active == '') {
            toastr.error('Active Status is Required!');
            return false;
        }
        if (product_thumbnail == '') {
            toastr.error('Product Thumbnail is Required!');
            return false;
        }
        if (multiImage == '') {
            toastr.error('Product Gallery Image is Required!');
            return false;
        }






        $('#productForm').submit();
    });

</script>
@endsection
