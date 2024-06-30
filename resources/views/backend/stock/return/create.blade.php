@extends('backend.layouts.layout')
@section('admin-title', 'Product Managment')
@section('admin_content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h4 class="m-0">Create Return</h4>
                <div>
                    <button class="btn btn-primary ml-2 formSaveButton"><i class="bx bx-save font-size-16"></i></button>
                    <a href="{{ route('admin.product.index') }}" class="btn btn-dark"><i class="bx bx-undo font-size-16"></i></a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.stock.order.return.store') }}" method="POST" id="returnForm">
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
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content p-3 text-muted">
                        <!-- First Tab -->
                        <div class="tab-pane active show" id="general" role="tabpanel">
                            <div class="row mb-4">
                                <label for="id" class="col-sm-2 col-form-label text-end font-bold fs-5">
                                    <span class="text-danger">*</span> Order Id(invoice)</label>
                                <div class="col-sm-10">
                                    <select class="form-control single-select @error('id') is-invalid @enderror"
                                        name="id">
                                        <option disabled selected>Choose...</option>
                                        @foreach ($orders as $order)
                                        <option value="{{ $order->invoice_no }}">
                                            {{ $order->invoice_no }}</option>
                                        @endforeach
                                    </select>
                                    @error('id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label for="or_order_date" class="col-sm-2 col-form-label text-end font-bold fs-5">
                                    <span class="text-danger">*</span> Order Date</label>
                                <div class="col-sm-6">
                                    <div class="input-group" id="datepicker2">
                                        <input name="or_order_date" type="text" class="form-control" placeholder="yyyy-m-d"
                                            data-date-format="yyyy-m-d" data-date-container='#datepicker2' data-provide="datepicker"
                                            data-date-autoclose="true" autocomplete="off">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div><!-- input-group -->
                                    @error('or_order_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="user_id" class="col-sm-2 col-form-label text-end font-bold fs-5"><span class="text-danger">*</span> Customer</label>
                                <div class="col-sm-10">
                                    <select class="form-control single-select @error('user_id') is-invalid @enderror"
                                        name="user_id">
                                        <option disabled selected>Choose...</option>
                                        @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">
                                            {{ $customer->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="product_id" class="col-sm-2 col-form-label text-end font-bold fs-5"><span class="text-danger">*</span> Product</label>
                                <div class="col-sm-10">
                                    <select class="form-control single-select @error('product_id') is-invalid @enderror"
                                        name="product_id">
                                        <option disabled selected>Choose...</option>
                                        @foreach ($products as $product)
                                        <option value="{{ $product->id }}">
                                            {{ $product->product_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('product_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="product_code" class="col-sm-2 col-form-label text-end font-bold fs-5">
                                    <span class="text-danger">*</span> SKU</label>
                                <div class="col-sm-10">
                                    <input name="product_code" type="text" class="form-control @error('product_code') is-invalid @enderror" placeholder="SKU"
                                    value="{{ old('product_code') }}" required>
                                    @error('product_code')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="or_return_qtn" class="col-sm-2 col-form-label text-end font-bold fs-5">
                                    <span class="text-danger">*</span> Quantity</label>
                                <div class="col-sm-10">
                                    <input name="or_return_qtn" type="number" class="form-control @error('or_return_qtn') is-invalid @enderror" placeholder="Return Quantity"
                                    value="{{ old('or_return_qtn') }}" required>
                                    @error('or_return_qtn')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="or_return_reason" class="col-sm-2 col-form-label text-end font-bold fs-5">
                                    <span class="text-danger">*</span> Return Reason</label>
                                <div class="col-sm-10">
                                    <select class="form-control single-select @error('or_return_reason') is-invalid @enderror"
                                        name="or_return_reason">
                                        <option disabled selected>Choose...</option>
                                        <option value="Dead On Arrival">Dead On Arrival</option>
                                        <option value="Order Error">Order Error</option>
                                        <option value="Other, please supply details">Other, please supply details</option>
                                        <option value="Received Wrong Item">Received Wrong Item</option>
                                    </select>
                                    @error('or_return_reason')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label for="or_return_note" class="col-sm-2 col-form-label text-end font-bold fs-5">
                                    <span class="text-danger">*</span> Comment</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="or_return_note"></textarea>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="or_return_status" class="col-sm-2 col-form-label text-end font-bold fs-5">
                                    <span class="text-danger">*</span> Return Status</label>
                                <div class="col-sm-10">
                                    <select class="form-control single-select @error('or_return_status') is-invalid @enderror"
                                        name="or_return_status">
                                        <option disabled selected>Choose...</option>
                                        <option value="Awaiting Products">Awaiting Products</option>
                                        <option value="Complete">Complete</option>
                                        <option value="Pending">Pending</option>
                                    </select>
                                    @error('or_return_status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
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
@push('backend-scripts')
    <script src="{{ asset('backend') }}/assets/libs/%40chenfengyuan/datepicker/datepicker.min.js"></script>
    <script src="{{ asset('backend') }}/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
@endpush
<script>
    $(document).ready(function () {
        $('.single-select').select2();
    });

    // button click form submit
    $('.formSaveButton').click(function () {
        $('#returnForm').submit();
    });

</script>
@endsection
