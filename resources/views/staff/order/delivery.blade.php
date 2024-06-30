@extends('staff.layouts.layout')
@section('staff-title', 'Order')
@section('staff_content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Welcome {{ Auth::user()->name }}</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Order Delivery</li>
                </ol>
            </div>

        </div>
    </div>
</div>
@include('staff.includes.status_bar')

<!-- Status Wise Order Show -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-secondary bg-soft d-flex justify-content-between rounded">
                <h5 class="my-auto">Total {{ count($orders) }} Order</h5>
            </div>

            <div class="card-body">
                <table id="datatable" class="table table-bordered dt-responsive wrap w-100 table-check">
                    <thead>
                        <tr class="text-primary">
                            <th width="2%">
                                <div class="form-check font-size-15">
                                    <input class="form-check-input" type="checkbox" id="checkAll">
                                </div>
                            </th>
                            <th>Invoice</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Courier</th>
                            <th>Order Date</th>
                            <th>Order Status</th>
                            <th class="text-center text-dark">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                        <form action="#" id="assingUserSubmit" method="POST">
                            @csrf
                            <tr>
                                <td class="text-center">
                                    <div class="form-check font-size-16">
                                        <input name="ids[]" class="form-check-input" type="checkbox"
                                            value="{{ $order->id }}">
                                    </div>
                                </td>
                                <td>
                                    {{ $order->invoice_no }}
                                </td>
                                <td>
                                    {{ $order->shipping->shipping_name }}
                                </td>
                                <td class="text-center">৳ {{ number_format(orderSubtotal($order->id)) }}</td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button
                                            class="btn btn-{{ empty($order->courier_id) ? 'warning' : 'success'  }} dropdown-toggle btn-sm"
                                            type="button" id="defaultDropdown" data-bs-toggle="dropdown"
                                            data-bs-auto-close="true" aria-expanded="false">
                                            @if (!empty($order->courier_id))
                                            {{ $order->courier->courier_name }}
                                            @else
                                            Not Assing
                                            @endif
                                            <i class="mdi mdi-chevron-down"></i>
                                        </button>
                                        {{-- <ul class="dropdown-menu" aria-labelledby="defaultDropdown" style="">
                                            @forelse ($couriers as $courier)
                                            <li>
                                                <a class="dropdown-item orderCourier" href="#"
                                                    data-order="{{ $order->id }}"
                                                    data-courier="{{ $courier->id }}">{{ $courier->courier_name }}</a>
                                            </li>
                                            @empty
                                            <li>Not Found</li>
                                            @endforelse
                                        </ul> --}}
                                    </div>
                                </td>
                                <td>
                                    {{ date('d-F-Y', strtotime($order->order_date)) }}

                                </td>
                                <td>

                                    <div class="btn-group">
                                        <button class="btn btn-secondary dropdown-toggle btn-sm" type="button"
                                            id="defaultDropdown" data-bs-toggle="dropdown" data-bs-auto-close="true"
                                            aria-expanded="false">
                                            {{ $order->status->os_name }}
                                            <i class="mdi mdi-chevron-down"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="defaultDropdown">

                                            @foreach ($statues as  $row)
                                            <li>
                                                <a class="dropdown-item orderStatus" href="#"
                                                data-order="{{ $order->id }}" data-courier="{{ empty($order->courier_id) ? 0 : $order->courier_id }}" data-status="{{ $row->id }}">{{ $row->os_name }}</a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary waves-effect dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bx bx-grid-alt
                                                font-size-15 align-middle me-2"></i> Manage
                                                <i class="mdi mdi-chevron-down"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('admin.staff.order.show', $order->order_slug) }}">
                                                    <i class="bx bx-show-alt align-middle me-2"></i> Show
                                                </a>
                                                <a class="dropdown-item" href="{{ route('admin.staff.order.edit', $order->order_slug) }}">
                                                    <i class="bx bx-edit align-middle me-2"></i> Edit
                                                </a>
                                            </div>
                                        </div>
                                </td>
                            </tr>
                        </form>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection
