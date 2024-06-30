@extends('staff.layouts.layout')
@section('staff-title', 'Total Order')
@section('staff_content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Welcome {{ Auth::user()->name }}</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Order </li>
                </ol>
            </div>

        </div>
    </div>
</div>

<!-- Status Wise Order Show -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-secondary bg-soft d-flex justify-content-between">
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
                                <td>
                                    <span class="badge rounded-pill bg-success">{{ $order->courier->courier_name ?? "Not Assign" }}</span>
                                </td>
                                <td>
                                    {{ date('d-F-Y', strtotime($order->order_date)) }}

                                </td>
                                <td>
                                    <span class="badge rounded-pill bg-{{ $order->order_status == 9 || $order->order_status == 4 ? 'danger' : 'secondary' }}">{{ $order->status->os_name }}</span>
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
