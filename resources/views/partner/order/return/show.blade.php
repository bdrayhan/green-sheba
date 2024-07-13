@extends('backend.layouts.layout')
@section('admin-title', 'Order Details')
@section('admin_content')
<div class="card">
    <div class="card-header">
        <h5><b>Order Details</b>
            <a href="{{ route('admin.order.all.page') }}" class="btn btn-sm btn-primary" style="float: right">
                <i class="bx bx-arrow-back"></i> Back
            </a>
        </h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Customer Information <h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="formrow-inputName" class="form-label">Name</label>
                            <p class="fw-bolder">{{ $order->shipping->shipping_name }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="formrow-inputName" class="form-label">Phone</label>
                            <p class="fw-bolder">{{ $order->shipping->shipping_phone }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="formrow-inputName" class="form-label">Email</label>
                            <p class="fw-bolder">{{ $order->shipping->shipping_email }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="formrow-inputName" class="form-label">Address</label>
                            <p class="fw-bolder">{{ $order->shipping->shipping_address }}</p>
                        </div>

                        <div class="mb-3">
                            <label for="formrow-email-input" class="form-label">Order Notes</label>
                            <textarea required disabled name="" id=""
                                class="form-control">{{ $order->shipping->shipping_note }}</textarea>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> Product Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-5 table-responsive">
                            <table class="table mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Color</th>
                                        <th>Size</th>
                                        <th>Quantity</th>
                                        <th>Unit</th>
                                        <th>Total</th>
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
                                            <p>{{ $detail->product_quantity }}</p>
                                        </td>
                                        <td>৳{{ number_format(productUnitPrice($detail->product_id)) }} </td>
                                        <td>৳{{ number_format(productSubtotal($detail->product_id, $detail->product_quantity)) }}
                                        </td>
                                        <td>
                                            <a id="delete" href="#" class="btn btn-sm btn-warning">
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
                            @if ($order->order_status == 10)
                                <p>Return Date: {{ $order->return_date }}</p>
                                <h3 class="display-5 text-center text-danger">Return</h3>
                            @else
                            <form action="{{ route('admin.courier.order.return') }}" method="POST">
                                @csrf
                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                <div class="col-md-12 p-0 m-auto">
                                    <textarea class="form-control" name="or_return_note" cols="20" rows="5"
                                        placeholder="Return Notes"></textarea>
                                        @error('or_return_note')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                </div>
                                <div class="col-md-12 mt-4 text-center">
                                    <button type="submit" class="btn btn-lg btn-primary">Return</button>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <script src="{{ asset('frontend') }}/assets/js/jquery.min.js"></script> --}}
@endsection
