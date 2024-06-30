
@extends('backend.layouts.layout')
@section('admin-title', 'Order Details')
@section('admin_content')
    <div class="card">
        <div class="card-header">
            <h5><b>Order Details</b>
                <a href="{{ route('admin.staff.status.order',1) }}" class="btn btn-sm btn-primary" style="float: right">
                    <i class="bx bx-arrow-back"></i> Back
                </a>
            </h5>
        </div>
        <div class="card-body">
            <form id="orderUpdateForm" action="{{ route('admin.staff.order.update', $order->order_slug) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Customer Information </h4>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="formrow-email-input" class="form-label">Customer
                                        Name</label>
                                    <input name="shipping_name" type="text" class="form-control"
                                           value="{{ $order->shipping->shipping_name }}" placeholder="Customer Name"
                                           required>
                                    @error('shipping_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="formrow-password-input" class="form-label">Customer
                                        Phone</label>
                                    <input name="shipping_phone" type="text" class="form-control"
                                           placeholder="Customer Phone" value="{{ $order->shipping->shipping_phone }}"
                                           required>
                                    @error('shipping_phone')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="formrow-password-input" class="form-label">Customer
                                        Email</label>
                                    <input name="shipping_email" type="email" class="form-control"
                                           placeholder="Customer Email" value="{{ $order->shipping->shipping_email }}"
                                           required>
                                </div>
                                <div class="mb-3">
                                    <label for="formrow-email-input" class="form-label">Shipping Address</label>
                                    <textarea required name="shipping_address" id="" class="form-control">{{ $order->shipping->shipping_address }}</textarea>
                                    @error('shipping_address')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="formrow-email-input" class="form-label">Customer Notes</label>
                                    <textarea required disabled name="" id="" class="form-control">{{ $order->shipping->shipping_note }}</textarea>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"> Product Information
                                    <a class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                       data-bs-target="#AddOrderProduct" style="float: right;" href="#"
                                       style="float: right;"><i class="bx bx-plus-medical"></i> Add Product</a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="mb-2 table-responsive">
                                    <table class="table mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Code</th>
                                                <th>Name</th>
                                                <th>Color</th>
                                                <th>Size</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @forelse ($order->orderDetails as $key => $detail)
                                            <tr>
                                                <th scope="row">{{ $detail->product_code }}</th>
                                                <td><a href="#">{{ Str::limit($detail->product_name, 20, '...') }}</a></td>
                                                <td>
                                                    {{ !$detail->product_color ? 'No Color' : $detail->color->color_name }}
                                                </td>
                                                <td>
                                                    {{ !$detail->product_size ? 'No Size' : $detail->size->size_name }}
                                                </td>
                                                <td width="25%">
                                                    <div class="row d-flex">
                                                        <div class="col-md-6">
                                                            <input type="number" name="order_quantity"
                                                                   class="form-control orderQuantity{{ $detail->id }}"
                                                                   value="{{ $detail->product_quantity }}">
                                                        </div>
                                                        <div class="col-md-3 text-center">
                                                            <button type="button" value="{{ $detail->id }}"
                                                                    class="btn btn-sm btn-success orderQuantityButton">
                                                                <i class="bx bx-sync text-white"
                                                                   style="font-size: 20px;"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>৳{{ number_format(productUnitPrice($detail->product_id)) }} </td>
                                                <td>
                                                    <a id="delete"
                                                       href="{{ route('admin.staff.order.product.delete', $detail->id) }}"
                                                       class="btn btn-sm btn-danger">
                                                        <i class="bx bx-trash-alt"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{--                                        <div class="mb-3">--}}
                                        {{--                                            <label class="text-right col-sm-4 control-label col-form-label">Payment--}}
                                        {{--                                                Methord</label>--}}
                                        {{--                                            <div class="col-sm-8">--}}
                                        {{--                                                <p class="fw-semibold">{{ $order->payment_type === 'cash_on_delivery' ? 'Cash On Delivery' : 'Mobile Banking' }}</p>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                        <div class="mb-3">
                                            <label class="text-right col-sm-4 control-label col-form-label" for="store_note">Comment </label>
                                            <textarea name="store_note" class="form-control" id="store_note">{{ $order->store_notes }}</textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label class="text-right col-sm-4 control-label col-form-label">Order
                                                Status</label>
                                            <div class="col-sm-8">
                                                <span class="badge badge-pill badge-soft-secondary font-size-12">
                                                    {{ $order->status->os_name }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="formrow-email-input" class="form-label">Select Courier <span
                                                    class="text-danger">*</span> </label>
                                            <select class="form-control" name="courier_id" id="" required>
                                                <option label="Select Courier"></option>
                                                @forelse ($couriers as $courier)
                                                    <option value="{{ $courier->id }}"
                                                        {{ $courier->id == $order->courier_id ? 'selected' : '' }}>
                                                        {{ $courier->courier_name }}
                                                    </option>
                                                @empty
                                                    <option value="">Not Found
                                                    </option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-2 form-group row">
                                            <label class="text-right col-sm-4 control-label col-form-label">Sub
                                                Total</label>
                                            <div class="col-sm-8">

                                                <input disabled type="text" class="form-control" style="cursor: not-allowed;" value="{{ number_format(orderSubtotal($order->id)) }}">
                                            </div>
                                        </div>

                                        <div class="mb-2 form-group row">
                                            <label for="shipping_charge"
                                                   class="text-right col-sm-4 control-label col-form-label">Shipping Charge</label>
                                            <div class="col-sm-8">
                                                <input disabled type="text" class="form-control" style="cursor: not-allowed;" value="{{ $order->shipping_charge }}">
                                            </div>
                                        </div>

                                        {{-- <div class="mb-2 form-group row">
                                            <label for="fname"
                                                class="text-right col-sm-4 control-label col-form-label">Coupon</label>
                                            <div class="col-sm-8">
                                                <input id="orderCoupon" disabled type="text" class="form-control" style="cursor: not-allowed;" value="{{ $order->coupon_amount ? $order->coupon_amount : 0 }}">
                                            </div>
                                        </div> --}}
                                        <div class="mb-2 form-group row">
                                            <label for="paying_amount"
                                                   class="text-right col-sm-4 control-label col-form-label text-danger">Advance
                                                Pay</label>
                                            <div class="col-sm-8">
                                                <input min="0" id="paying_amount" type="number"
                                                       name="paying_amount" class="form-control" placeholder="0"
                                                       value="{{ $order->paying_amount }}">
                                            </div>
                                        </div>
                                        <div class="mb-5 form-group row">
                                            <label for="fname"
                                                   class="text-right col-sm-4 control-label col-form-label">Due Amount</label>
                                            <div class="col-sm-8">
                                                <input id="total-due-amount" disabled type="text" class="form-control"
                                                       style="cursor: not-allowed;" value="{{ number_format(totalOrderDue($order->id)) }}">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-success waves-effect btn-label waves-light"
                                                style="margin-left: 130px;"><i class="bx bx-check-double label-icon"></i>
                                            Update
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Add Order Product Modal -->
    <div class="modal fade" id="AddOrderProduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Order Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.staff.order.add.order.item') }}" method="POST">
                    @csrf
                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label for="product_id">Select Product <span class="text-danger">*</span></label>
                            <select class="form-control selectOrderProduct" name="product_id" id="product_id">
                                <option>Select Product</option>
                                @foreach (getAllProduct() as $product)
                                    <option value="{{ $product->id }}">
                                        {{ $product->product_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('product_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="color_id">Product Color <span class="text-danger">*</span></label>
                            <select class="form-control selectOrderColor" name="color_id" id="productColorShow">
                                <option>Select Color</option>
                            </select>
                            @error('color_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="size_id">Product Size<span class="text-danger">*</span></label>
                            <select class="form-control" name="size_id" id="productSizeShow">
                                <option>Select Size</option>
                            </select>
                            @error('size_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="quantity">Product Quantity<span class="text-danger">*</span></label>
                            <input id="quantity" type="text" class="form-control" name="quantity">
                            @error('quantity')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                            <i class="bx bx-save font-size-16 align-middle me-2"></i> Add
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Add Order Product End Modal -->
    <script src="{{ asset('frontend') }}/assets/js/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.single-select').select2();
        });

        $(document).ready(function () {
            $('.selectOrderProduct').on('change', function () {
                var product_id = $(this).val();

                if (product_id) {
                    $.ajax({
                        url: "{{ url('staff/order/add-order-item') }}/" + product_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            // Color Show
                            $('#productColorShow').empty();
                            $.each(data.colors, function (key, value) {
                                $('#productColorShow').append('<option value="' + value.id + '">' + value.color_name + '</option>');
                            });
                            // Size Show
                            $('#productSizeShow').empty();
                            $.each(data.sizes, function (key, value) {
                                $('#productSizeShow').append('<option value="' + value.id + '">' + value.size_name + '</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });
        });

        // Pay Amount Option Work
        $(document).ready(function() {
            $('#paying_amount').on('change', function() {
                var payAmount = parseInt($('#paying_amount').val());
                var totalDue =  parseInt({{ totalOrderDue($order->id) }});
                if ($(this).val() != "") {
                    if (payAmount > totalDue) {
                        Swal.fire({
                            icon: "warning",
                            title: "Paying amount is greater than due amount",
                            showConfirmButton: !1,
                            timer: 2000,
                        });
                        $('#paying_amount').val(parseInt({{ $order->paying_amount }}));
                        $('#total-due-amount').val(totalDue);
                        return false;
                    }else{
                        totalDue = totalDue - payAmount;
                        $('#total-due-amount').val(totalDue);
                    }
                }else{
                    $('#paying_amount').val(parseInt({{ $order->paying_amount }}));
                    $('#total-due-amount').val(totalDue);
                    return false;
                }

            });
        });

        // Quantity Update
        $(document).ready(function() {
            $(".orderQuantityButton").on("click", function(e) {
                var detail_id = $(this).val();
                var quantity = $('.orderQuantity' + detail_id).val();

                if (!quantity) {
                    Swal.fire({
                        icon: "warning",
                        title: "Quantity is required",
                        showConfirmButton: !1,
                        timer: 2000,
                    });
                    return false;
                }
                $.ajax({
                    type: "post",
                    url: "{{ route('admin.staff.order.product.quantity.update') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "detail_id": detail_id,
                        "quantity": quantity,
                    },
                    dataType: "json",
                    success: function(response) {
                        Swal.fire({
                            icon: "success",
                            title: response.message,
                            showConfirmButton: !1,
                            timer: 2000,
                        });
                        location.reload();
                    }
                });
            });
        });

    </script>
@endsection













































{{--@extends('staff.layouts.layout')--}}
{{--@section('staff-title', 'Order Edit')--}}
{{--@section('staff_content')--}}
{{--    <div class="card">--}}
{{--        <div class="card-header">--}}
{{--            <h5><b>Order Details</b>--}}
{{--                <a href="{{ route('admin.staff.status.order',1) }}" class="btn btn-sm btn-primary" style="float: right">--}}
{{--                    <i class="bx bx-arrow-back"></i> Back--}}
{{--                </a>--}}
{{--            </h5>--}}
{{--        </div>--}}
{{--        <div class="card-body">--}}
{{--            <form id="orderUpdateForm" action="{{ route('admin.staff.order.update', $order->order_slug) }}" method="POST">--}}
{{--                @csrf--}}
{{--                @method('PUT')--}}
{{--                <div class="row">--}}
{{--                    <div class="col-md-4">--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-header">--}}
{{--                                <h4 class="card-title">Customer Information <h4>--}}
{{--                            </div>--}}
{{--                            <div class="card-body">--}}
{{--                                <div class="mb-3">--}}
{{--                                    <label for="formrow-email-input" class="form-label">Customer--}}
{{--                                        Name</label>--}}
{{--                                    <input name="shipping_name" type="text" class="form-control"--}}
{{--                                        value="{{ $order->shipping->shipping_name }}" placeholder="Customer Name"--}}
{{--                                        required>--}}
{{--                                        @error('shipping_name')--}}
{{--                                            <span class="text-danger">{{ $message }}</span>--}}
{{--                                        @enderror--}}
{{--                                </div>--}}
{{--                                <div class="mb-3">--}}
{{--                                    <label for="formrow-password-input" class="form-label">Customer--}}
{{--                                        Phone</label>--}}
{{--                                    <input name="shipping_phone" type="text" class="form-control"--}}
{{--                                        placeholder="Customer Phone" value="{{ $order->shipping->shipping_phone }}"--}}
{{--                                        required>--}}
{{--                                        @error('shipping_phone')--}}
{{--                                            <span class="text-danger">{{ $message }}</span>--}}
{{--                                        @enderror--}}
{{--                                </div>--}}
{{--                                <div class="mb-3">--}}
{{--                                    <label for="formrow-password-input" class="form-label">Customer--}}
{{--                                        Email</label>--}}
{{--                                    <input name="shipping_email" type="email" class="form-control"--}}
{{--                                        placeholder="Customer Email" value="{{ $order->shipping->shipping_email }}"--}}
{{--                                        required>--}}
{{--                                </div>--}}
{{--                                <div class="mb-3">--}}
{{--                                    <label for="formrow-email-input" class="form-label">Shipping Address</label>--}}
{{--                                    <textarea required name="shipping_address" id="" class="form-control">{{ $order->shipping->shipping_address }}</textarea>--}}
{{--                                    @error('shipping_address')--}}
{{--                                        <span class="text-danger">{{ $message }}</span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}

{{--                                <div class="mb-3">--}}
{{--                                    <label for="formrow-email-input" class="form-label">Order Notes</label>--}}
{{--                                    <textarea required disabled name="" id="" class="form-control">{{ $order->shipping->shipping_note }}</textarea>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <!-- end card body -->--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="col-md-8">--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-header">--}}
{{--                                <h4 class="card-title"> Product Information--}}
{{--                                    <a class="btn btn-sm btn-primary" data-bs-toggle="modal"--}}
{{--                                        data-bs-target="#AddOrderProduct" style="float: right;" href="#"--}}
{{--                                        style="float: right;"><i class="bx bx-plus-medical"></i> Add Product</a>--}}
{{--                                </h4>--}}
{{--                            </div>--}}
{{--                            <div class="card-body">--}}
{{--                                <div class="mb-5 table-responsive">--}}
{{--                                    <table class="table mb-0">--}}
{{--                                        <thead class="table-light">--}}
{{--                                            <tr>--}}
{{--                                                <th>Code</th>--}}
{{--                                                <th>Name</th>--}}
{{--                                                <th>Color</th>--}}
{{--                                                <th>Size</th>--}}
{{--                                                <th>Quantity</th>--}}
{{--                                                <th>Price</th>--}}
{{--                                                <th>Action</th>--}}
{{--                                            </tr>--}}
{{--                                        </thead>--}}
{{--                                        <tbody>--}}
{{--                                            @forelse ($order->orderDetails as $key => $detail)--}}
{{--                                                <tr>--}}
{{--                                                    <th scope="row">{{ $detail->product_code }}</th>--}}
{{--                                                    <td><a href="#">{{ Str::limit($detail->product_name, 20, '...') }}</a></td>--}}
{{--                                                    <td>--}}
{{--                                                        {{ !$detail->product_color ? 'No Color' : $detail->color->color_name }}--}}
{{--                                                    </td>--}}
{{--                                                    <td>--}}
{{--                                                        {{ !$detail->product_size ? 'No Size' : $detail->size->size_name }}--}}
{{--                                                    </td>--}}
{{--                                                    <td width="25%">--}}
{{--                                                        <div class="row d-flex">--}}
{{--                                                            <div class="col-md-6">--}}
{{--                                                                <input type="number" name="order_quantity"--}}
{{--                                                                    class="form-control orderQuantity{{ $detail->id }}"--}}
{{--                                                                    value="{{ $detail->product_quantity }}">--}}
{{--                                                            </div>--}}
{{--                                                            <div class="col-md-3 text-center">--}}
{{--                                                                <button type="button" value="{{ $detail->id }}"--}}
{{--                                                                    class="btn btn-sm btn-success orderQuantityButton">--}}
{{--                                                                    <i class="bx bx-sync text-white"--}}
{{--                                                                        style="font-size: 20px;"></i>--}}
{{--                                                                </button>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </td>--}}
{{--                                                    <td>৳{{ number_format(productUnitPrice($detail->product_id)) }} </td>--}}
{{--                                                    <td>--}}
{{--                                                        <a id="delete"--}}
{{--                                                            href="{{ route('admin.staff.order.product.delete', $detail->id) }}"--}}
{{--                                                            class="btn btn-sm btn-danger">--}}
{{--                                                            <i class="bx bx-trash-alt"></i>--}}
{{--                                                        </a>--}}
{{--                                                    </td>--}}
{{--                                                </tr>--}}
{{--                                            @empty--}}
{{--                                            @endforelse--}}
{{--                                        </tbody>--}}
{{--                                    </table>--}}
{{--                                </div>--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        <div class="mb-3">--}}
{{--                                            <label class="text-right col-sm-4 control-label col-form-label">Payment--}}
{{--                                                Methord</label>--}}
{{--                                            <div class="col-sm-8">--}}
{{--                                                <p class="fw-semibold">{{ $order->payment_type == 'cash_on_delivery' ? 'Cash On Delivery' : 'Mobile Banking' }}</p>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="mb-3">--}}
{{--                                            <label class="text-right col-sm-4 control-label col-form-label">Order--}}
{{--                                                Status</label>--}}
{{--                                            <div class="col-sm-8">--}}
{{--                                                <span class="badge badge-pill badge-soft-secondary font-size-12">--}}
{{--                                                    {{ $order->status->os_name }}--}}
{{--                                                </span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="mb-3">--}}
{{--                                            <label for="formrow-email-input" class="form-label">Select Couries <span--}}
{{--                                                    class="text-danger">*</span> </label>--}}
{{--                                            <select class="form-control" name="courier_id" id="" required>--}}
{{--                                                <option label="Select Couries"></option>--}}
{{--                                                @forelse ($couriers as $courier)--}}
{{--                                                    <option value="{{ $courier->id }}"--}}
{{--                                                        {{ $courier->id == $order->courier_id ? 'selected' : '' }}>--}}
{{--                                                        {{ $courier->courier_name }}--}}
{{--                                                    </option>--}}
{{--                                                @empty--}}
{{--                                                    <option value="">Not Found--}}
{{--                                                    </option>--}}
{{--                                                @endforelse--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        <div class="mb-2 form-group row">--}}
{{--                                            <label class="text-right col-sm-4 control-label col-form-label">Sub--}}
{{--                                                Total</label>--}}
{{--                                            <div class="col-sm-8">--}}

{{--                                                    <input disabled type="text" class="form-control" style="cursor: not-allowed;" value="{{ number_format(orderSubtotal($order->id)) }}">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="mb-2 form-group row">--}}
{{--                                            <label for="fname"--}}
{{--                                                class="text-right col-sm-4 control-label col-form-label">Shipping Charge</label>--}}
{{--                                            <div class="col-sm-8">--}}
{{--                                                    <input disabled type="text" class="form-control" style="cursor: not-allowed;" value="{{ $order->shipping_charge }}">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="mb-2 form-group row">--}}
{{--                                            <label for="paying_amount"--}}
{{--                                                class="text-right col-sm-4 control-label col-form-label text-danger">Advance--}}
{{--                                                Pay</label>--}}
{{--                                            <div class="col-sm-8">--}}
{{--                                                <input min="0" id="paying_amount" type="number"--}}
{{--                                                    name="paying_amount" class="form-control" placeholder="0"--}}
{{--                                                    value="{{ $order->paying_amount }}">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="mb-5 form-group row">--}}
{{--                                            <label for="fname"--}}
{{--                                                class="text-right col-sm-4 control-label col-form-label">Due Amount</label>--}}
{{--                                            <div class="col-sm-8">--}}
{{--                                                    <input id="total-due-amount" disabled type="text" class="form-control"--}}
{{--                                                    style="cursor: not-allowed;" value="{{ number_format(totalOrderDue($order->id)) }}">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <button type="submit" class="btn btn-success waves-effect btn-label waves-light"--}}
{{--                                            style="margin-left: 130px;"><i class="bx bx-check-double label-icon"></i>--}}
{{--                                            Update--}}
{{--                                        </button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!-- Add Order Product Modal -->--}}
{{--    <div class="modal fade" id="AddOrderProduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"--}}
{{--        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">--}}
{{--        <div class="modal-dialog modal-dialog-centered" role="document">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <h5 class="modal-title" id="staticBackdropLabel">Add Order Product</h5>--}}
{{--                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--                </div>--}}
{{--                <form action="{{ route('admin.staff.order.add.order.item') }}" method="POST">--}}
{{--                    @csrf--}}
{{--                    <input type="hidden" name="order_id" value="{{ $order->id }}">--}}
{{--                    <div class="modal-body">--}}
{{--                        <div class="form-group mb-2">--}}
{{--                            <label for="product_id">Select Product <span class="text-danger">*</span></label>--}}
{{--                            <select class="form-control selectOrderProduct" name="product_id" id="product_id">--}}
{{--                                <option>Select Product</option>--}}
{{--                                @foreach (getAllProduct() as $product)--}}
{{--                                    <option value="{{ $product->id }}">--}}
{{--                                        {{ $product->product_name }}--}}
{{--                                    </option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                            @error('product_id')--}}
{{--                                <div class="invalid-feedback">--}}
{{--                                    {{ $message }}--}}
{{--                                </div>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
{{--                        <div class="form-group mb-2">--}}
{{--                            <label for="color_id">Product Color <span class="text-danger">*</span></label>--}}
{{--                            <select class="form-control selectOrderColor" name="color_id" id="productColorShow">--}}
{{--                                <option disabled selected>Select Color</option>--}}
{{--                            </select>--}}
{{--                            @error('color_id')--}}
{{--                                <div class="invalid-feedback">--}}
{{--                                    {{ $message }}--}}
{{--                                </div>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
{{--                        <div class="form-group mb-2">--}}
{{--                            <label for="size_id">Product Size<span class="text-danger">*</span></label>--}}
{{--                            <select class="form-control" name="size_id" id="productSizeShow">--}}
{{--                                <option disabled selected>Select Size</option>--}}
{{--                            </select>--}}
{{--                            @error('size_id')--}}
{{--                                <div class="invalid-feedback">--}}
{{--                                    {{ $message }}--}}
{{--                                </div>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
{{--                        <div class="form-group mb-2">--}}
{{--                            <label for="quantity">Product Quantity<span class="text-danger">*</span></label>--}}
{{--                            <input id="quantity" type="text" class="form-control" name="quantity">--}}
{{--                            @error('quantity')--}}
{{--                                <div class="invalid-feedback">--}}
{{--                                    {{ $message }}--}}
{{--                                </div>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="modal-footer">--}}
{{--                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>--}}
{{--                        <button type="submit" class="btn btn-primary waves-effect waves-light">--}}
{{--                            <i class="bx bx-save font-size-16 align-middle me-2"></i> Add--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!-- Add Order Product End Modal -->--}}
{{--    <script src="{{ asset('frontend') }}/assets/js/jquery.min.js"></script>--}}
{{--    <script>--}}
{{--        $(document).ready(function() {--}}
{{--            $('.single-select').select2();--}}
{{--        });--}}

{{--        $(document).ready(function () {--}}
{{--            $('.selectOrderProduct').on('change', function () {--}}
{{--                var product_id = $(this).val();--}}

{{--                if (product_id) {--}}
{{--                    $.ajax({--}}
{{--                        url: "{{ url('staff/order/add-order-item') }}/" + product_id,--}}
{{--                        type: "GET",--}}
{{--                        dataType: "json",--}}
{{--                        success: function (data) {--}}
{{--                            // Color Show--}}
{{--                            $('#productColorShow').empty();--}}
{{--                            $.each(data.colors, function (key, value) {--}}
{{--                                $('#productColorShow').append('<option value="' + value.id + '">' + value.color_name + '</option>');--}}
{{--                            });--}}
{{--                            // Size Show--}}
{{--                            $('#productSizeShow').empty();--}}
{{--                            $.each(data.sizes, function (key, value) {--}}
{{--                                $('#productSizeShow').append('<option value="' + value.id + '">' + value.size_name + '</option>');--}}
{{--                            });--}}
{{--                        },--}}
{{--                    });--}}
{{--                } else {--}}
{{--                    alert('danger');--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}

{{--        // Pay Amout Option Work--}}
{{--        $(document).ready(function() {--}}
{{--            $('#paying_amount').on('change', function() {--}}
{{--                var payAmount = parseInt($('#paying_amount').val());--}}
{{--                var totalDue =  parseInt({{ totalOrderDue($order->id) }});--}}
{{--                if ($(this).val() != "") {--}}
{{--                    if (payAmount > totalDue) {--}}
{{--                        Swal.fire({--}}
{{--                            icon: "warning",--}}
{{--                            title: "Paying amount is greater than due amount",--}}
{{--                            showConfirmButton: !1,--}}
{{--                            timer: 2000,--}}
{{--                        });--}}
{{--                        $('#paying_amount').val(parseInt({{ $order->paying_amount }}));--}}
{{--                        $('#total-due-amount').val(totalDue);--}}
{{--                        return false;--}}
{{--                    }else{--}}
{{--                        totalDue = totalDue - payAmount;--}}
{{--                        $('#total-due-amount').val(totalDue);--}}
{{--                    }--}}
{{--                }else{--}}
{{--                    $('#paying_amount').val(parseInt({{ $order->paying_amount }}));--}}
{{--                    $('#total-due-amount').val(totalDue);--}}
{{--                    return false;--}}
{{--                }--}}

{{--            });--}}
{{--        });--}}

{{--        // Quantity Update--}}
{{--        $(document).ready(function() {--}}
{{--            $(".orderQuantityButton").on("click", function(e) {--}}
{{--                var detail_id = $(this).val();--}}
{{--                var quantity = $('.orderQuantity' + detail_id).val();--}}

{{--                if (!quantity) {--}}
{{--                    Swal.fire({--}}
{{--                        icon: "warning",--}}
{{--                        title: "Quantity is required",--}}
{{--                        showConfirmButton: !1,--}}
{{--                        timer: 2000,--}}
{{--                    });--}}
{{--                    return false;--}}
{{--                }--}}
{{--                $.ajax({--}}
{{--                    type: "post",--}}
{{--                    url: "{{ route('admin.staff.order.product.quantity.update') }}",--}}
{{--                    data: {--}}
{{--                        "_token": "{{ csrf_token() }}",--}}
{{--                        "detail_id": detail_id,--}}
{{--                        "quantity": quantity,--}}
{{--                    },--}}
{{--                    dataType: "json",--}}
{{--                    success: function(response) {--}}
{{--                        Swal.fire({--}}
{{--                            icon: "success",--}}
{{--                            title: response.message,--}}
{{--                            showConfirmButton: !1,--}}
{{--                            timer: 2000,--}}
{{--                        });--}}
{{--                        location.reload();--}}
{{--                    }--}}
{{--                });--}}
{{--            });--}}
{{--        });--}}

{{--    </script>--}}
{{--@endsection--}}
