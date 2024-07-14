@extends('backend.layouts.layout')
@section('admin-title', 'Order')
@section('admin_content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Order</h4>

            <div class="page-title-right">
{{--                <button class="smsSendButton btn btn-success btn-soft waves-effect waves-light">--}}
{{--                    <i class="bx bx-mail-send font-size-16 align-middle"></i>--}}
{{--                </button>--}}
{{--                @if (in_array($order->order_status, $orderStatus, true))--}}
{{--                    <a target="_blank" href="{{ route('admin.order.invoice.print',$order->order_slug) }}" class="btn btn-info waves-effect waves-light">--}}
{{--                        <i class="bx bx-receipt font-size-16 align-middle"></i>--}}
{{--                    </a>--}}
{{--                @endif--}}
                <a target="_blank" href="{{ route('admin.order.invoice.print',$order->order_slug) }}" class="btn btn-info waves-effect waves-light">
                    <i class="bx bx-receipt font-size-16 align-middle"></i>
                </a>
                @if (!($order->order_status === 9 || $order->order_status === 10 || $order->order_status === 11))
                <a href="{{ route('admin.order.show', $order->order_slug) }}" class="btn btn-primary waves-effect waves-light">
                    <i class="bx bx-edit-alt font-size-16 align-middle"></i>
                </a>
                @endif
{{--                <a href="#" class="btn btn-dark btn-soft waves-effect waves-light">--}}
{{--                    <i class="bx bxs-share font-size-16 align-middle"></i>--}}
{{--                </a>--}}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="card border border-secondary border-soft border-opacity-50">
            <div class="card-header d-flex justify-content-between">
                <p class="text-muted m-0">
                    <i class="bx bxs-calendar fs-5 align-middle text-primary me-2 bg-info rounded px-1 py-1 text-white"></i>
                    Complete  Date
                </p>
                <span class="my-auto">{{ $order->complected_date ?: 'No Complete' }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border border-secondary border-soft border-opacity-50">
            <div class="card-header d-flex justify-content-between">
                <p class="text-muted m-0">
                    <i class="bx bxs-calendar fs-5 align-middle text-primary me-2 bg-info rounded px-1 py-1 text-white"></i>
                    Invoice Date
                </p>
                <span class="my-auto">{{ $order->invoice_date ?: 'No Invoice' }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border border-secondary border-soft border-opacity-50">
            <div class="card-header d-flex justify-content-between">
                <p class="text-muted m-0">
                    <i class="bx bxs-calendar fs-5 align-middle text-primary me-2 bg-info rounded px-1 py-1 text-white"></i>
                    Delivery Date
                </p>
                <span class="my-auto">{{ $order->delivery_date ?: 'No Delivery' }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border border-secondary border-soft border-opacity-50">
            <div class="card-header d-flex justify-content-between">
                <p class="text-muted m-0">
                    <i class="bx bxs-calendar fs-5 align-middle text-primary me-2 bg-info rounded px-1 py-1 text-white"></i>
                    Collected Date
                </p>
                <span class="my-auto">{{ $order->collected_date ?: 'No Collected' }}</span>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card border">
            <div class="card-header d-flex justify-self-auto border border-secondary border-soft border-bottom-0 border-opacity-50">
                <i class="bx bxs-cart text-dark fs-4"></i>
                <h5 class="mx-2">Order Details</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered border-secondary border-soft mb-0 border-opacity-50">
                        <thead>
                            <tr>
                                <th>
                                    <p class="text-muted m-0">
                                        <i
                                            class="bx bxs-cart fs-5 align-middle text-primary me-3 bg-primary rounded px-2 py-1 text-white"></i>
                                        <a target="_blank" href="{{ route('web.home') }}">{{ appSetting()['basic_setting']->basic_company }}</a>
                                    </p>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <p class="text-muted m-0">
                                        <i
                                            class="bx bxs-calendar fs-5 align-middle text-primary me-3 bg-primary rounded px-2 py-1 text-white"></i>
                                        {{ $order->order_date }}</p>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <p class="text-muted m-0">
                                        <i
                                            class="bx bxs-credit-card fs-5 align-middle text-primary me-3 bg-primary rounded px-2 py-1 text-white"></i>
                                        {{ $order->payment_type === 'cash_on_delivery' ? 'Cash On Delivery' : 'Mobile Banking' }}</p>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <p class="text-muted m-0">
                                        <i
                                            class="bx bxs-truck fs-5 align-middle text-primary me-3 bg-primary rounded px-2 py-1 text-white"></i>
                                        {{ $order->shipping->shipping_area === 'outside-dhaka' ? 'Delivery Outside Dhaka' : 'Delivery Inside Dhaka' }}</p>
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border">
            <div class="card-header d-flex justify-self-auto border border-secondary border-soft border-bottom-0 border-opacity-50">
                <i class="bx bxs-user-detail text-dark fs-4"></i>
                <h5 class="mx-2">Customer Details</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered border-secondary border-soft mb-0 border-opacity-50">

                        <thead>
                            <tr>
                                <th>
                                    <p class="text-muted m-0">
                                        <i class="bx bxs-user fs-5 align-middle text-primary me-3 bg-primary rounded px-2 py-1 text-white"></i>
                                        {{  $order->shipping->shipping_name }}</p>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <p class="text-muted m-0">
                                        <i class="bx bxs-phone fs-5 align-middle text-primary me-3 bg-primary rounded px-2 py-1 text-white"></i>
                                            {{  $order->shipping->shipping_phone }}</p>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <p class="text-muted m-0">
                                        <i class="bx bxs-envelope fs-5 align-middle text-primary me-3 bg-primary rounded px-2 py-1 text-white"></i>
                                            {{  $order->shipping->shipping_email }}</p>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <p class="text-muted m-0">
                                        <i class="bx bxs-navigation fs-5 align-middle text-primary me-3 bg-primary rounded px-2 py-1 text-white"></i>
                                            {{  $order->shipping->shipping_address }}</p>
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border">
            <div class="card-header d-flex justify-self-auto border border-secondary border-soft border-bottom-0 border-opacity-50">
                <i class="bx bxs-cog text-dark fs-4"></i>
                <h5 class="mx-2">Options</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered border-secondary border-soft mb-0 border-opacity-50">
                        <thead>
                            <tr>
                                <th>
                                    <div class="d-flex justify-content-between">
                                        <p class="m-0">Invoice</p>
                                        <p class="m-0">{{ $order->invoice_no }}</p>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <div class="d-flex justify-content-between">
                                        <p class="m-0">Order Assign</p>
                                        <p class="m-0">{{ $order->assign->name }}</p>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <div class="d-flex justify-content-between">
                                        <p class="m-0">Courier</p>
                                        <p class="m-0">{{ $order->courier_id ? $order->courier->courier_name : 'Not Assign' }}</p>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <div class="d-flex justify-content-between">
                                        <p class="m-0">Status</p>
                                        <p class="m-0 text-success">{{ $order->status->os_name }}</p>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card border border-secondary border-soft border-opacity-50">
            <div class="card-header d-flex justify-self-auto">
                <i class="bx bxs-info-circle text-dark fs-4"></i>
                <h5 class="mx-2">Product Information</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-responsive wrap table-bordered border-secondary border-soft border-opacity-50">
                        <thead>
                            <tr>
                                <th width="50%">Product</th>
                                <th width="10%">SKU</th>
                                <th width="10%" class="text-end">Quantity</th>
                                <th width="10%" class="text-end">Unit Price</th>
                                <th width="10%" class="text-end">Discount Price</th>
                                <th width="10%" class="text-end">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderDetails as $detail)
                            <tr>
                                <th class="d-flex justify-content-between">
                                    <span>{{ $detail->product_name }}</span>
                                    @if ($detail->product_color)
                                        <span>Color: {{ $detail->color->color_name }}</span>
                                    @endif
                                    @if ($detail->product_size)
                                    <span>Size: {{ $detail->size->size_name }}</span>
                                    @endif
                                </th>
                                <td >{{$detail->product_code ?? 'Not Available'}}</td>
                                <td class="text-end">{{ $detail->product_quantity }}</td>
                                <td class="text-end">৳{{ $singlePrice = productUnitPrice($detail->product_id) }}</td>
                                <td class="text-end">
                                    <div class="input-group">
                                        <div class="input-group-text" id="btnGroupAddon">
                                            <select class="form-select" aria-label="Default select example">
                                                <option selected value="1">Amount %</option>
                                                <option value="2">Amount ৳</option>
                                                
                                            </select>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Enter Discount Amount" aria-label="Input group example" aria-describedby="btnGroupAddon">
                                    </div>

                                </td>
                                <td class="text-end">৳{{ $detail->product_quantity *  $singlePrice }}</td>
                            </tr>
                            @endforeach
                            <tr class="text-end">
                                <td colspan="4">Sub-Total</td>
                                <td>৳ discount</td>
                                <td>৳{{ orderSubtotal($order->id) }}</td>
                            </tr>
                            <tr class="text-end">
                                <td colspan="4"> {{ $order->shipping->shipping_area === 'outside-dhaka' ? 'Delivery Outside Dhaka' : 'Delivery Inside Dhaka' }}</td>
                                <td>৳ discount</td>
                                <td>৳{{ $order->shipping_charge }}</td>
                            </tr>
                            @if ($order->paying_amount)
                                <tr class="text-end">
                                    <td colspan="4">Advance Paying</td>
                                    <td>৳ discount</td>
                                    <td>৳{{ $order->paying_amount }}</td>
                                </tr>
                            @endif
                            <tr class="text-end">
                                <td colspan="4">Due Amount</td>
                                <td>৳ discount</td>
                                <td>৳{{ totalOrderDue($order->id) }}</td>
                            </tr>
                            <tr class="text-end">
                                <td colspan="4">Discount</td>
                                <td>
                                    <div class="input-group">
                                        <div class="input-group-text" id="btnGroupAddon">
                                            <select class="form-select" aria-label="Default select example">
                                                <option selected>Amount %</option>
                                                <option value="1">Amount ৳</option>
                                                
                                            </select>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Enter Discount Amount" aria-label="Input group example" aria-describedby="btnGroupAddon">
                                    </div>
                                </td>
                                <td>৳ discount</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card border border-secondary border-soft border-opacity-50">
            <div class="card-header d-flex justify-self-auto">
                <i class="bx bx-message text-dark fs-4"></i>
                <h5 class="mx-2">Customer Comment</h5>
            </div>
            <div class="card-body">
                {{ $order->order_notes }}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card border border-secondary border-soft border-opacity-50">
            <div class="card-header d-flex justify-self-auto">
                <i class="bx bx-message text-dark fs-4"></i>
                <h5 class="mx-2">Return Reason</h5>
            </div>
            <div class="card-body">
                {{ $order->returnOrder }}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card border border-secondary border-soft border-opacity-50">
            <div class="card-header d-flex justify-self-auto">
                <i class="bx bx-message text-dark fs-4"></i>
                <h5 class="mx-2">Store Comment</h5>
            </div>
            <div class="card-body">
                {{ $order->store_notes }}
            </div>
        </div>
    </div>
</div>
<form action="{{ route('admin.sent.message') }}" id="submitForm" method="POST">
    @csrf
    <input name="customer_name" type="hidden" value="{{ $order->shipping->shipping_name }}">
    <input name="invoice_number" type="hidden" value="{{ $order->invoice_no }}">
</form>
@endsection
@push('backend-scripts')
<script>
    // button click form submit
    $('.smsSendButton').click(function () {
        $('#submitForm').submit();
    });
</script>
@endpush
