@extends('backend.layouts.layout')
@section('admin-title', 'Order Management')
@section('admin_content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Order</h4>

            <div class="page-title-right">
                <ol class="m-0 breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Order</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- Order Short Section -->
@php
$total_order = App\Models\Order::all();
@endphp

<div class="row">
    @foreach (orderPageStatus() as $row)
    <div class="col-md-2">
        <a href="{{ route('admin.status.order.list',$row->id) }}">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium">{{ $row->os_name }}</p>
                            <h4 class="mb-0 text-dark">{{ count($row->order) }}</h4>
                        </div>

                        <div class="flex-shrink-0 align-self-center">
                            <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                <span class="avatar-title">
                                    <i class="bx bx-package font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    @endforeach

</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-secondary bg-soft d-flex justify-content-between rounded">
                <h5 class="my-auto">Order List</h5>
                <div>
                    @role('Super Admin|Admin')
                        @php
                        $allUser = App\Models\User::role('User')
                        ->where('status', 1)
                        ->where('online_status', 1)
                        ->get();
                        @endphp
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                Assing User <i class="mdi mdi-chevron-down"></i>
                            </button>
                            <div class="dropdown-menu" style="">
                                <div class="dropdown-header noti-title">
                                    <h5 class="font-size-13 text-muted text-truncate mn-0">Welcome
                                        {{ Auth::user()->name }}!</h5>
                                </div>

                                <!-- item-->
                                @foreach ($allUser as $user)
                                <a id="markAssign" class="dropdown-item btn-assign-user" href="#"
                                    data-id="{{ $user->id }}">{{ $user->name }}</a>
                                @endforeach
                            </div>
                        </div>
                        <button id="markOrderDelete" type="button" class="btn btn-sm btn-danger">
                            <i class="mdi mdi-delete-sweep fs-5"></i>
                        </button>
                    @endrole
                    <a href="{{ route('admin.order.create') }}" class="btn btn-sm btn-info">
                        <i class="mdi mdi-plus-thick fs-5"></i>
                    </a>
                </div>
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
                            @role('Super Admin|Admin|Manager')
                            <th>Assing To</th>
                            @endrole
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
                                        <ul class="dropdown-menu" aria-labelledby="defaultDropdown" style="">
                                            @forelse ($couriers as $courier)
                                            <li>
                                                <a class="dropdown-item orderCourier" href="#"
                                                    data-order="{{ $order->id }}"
                                                    data-courier="{{ $courier->id }}">{{ $courier->courier_name }}</a>
                                            </li>
                                            @empty
                                            <li>Not Found</li>
                                            @endforelse
                                        </ul>
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
                                            @if ($order->order_status == 1)
                                                @foreach ( pendingOrderStatus() as  $row)
                                                <li>
                                                    <a class="dropdown-item orderStatus" href="#"
                                                    data-order="{{ $order->id }}" data-courier="{{ empty($order->courier_id) ? 0 : $order->courier_id }}" data-status="{{ $row->id }}">{{ $row->os_name }}</a>
                                                </li>
                                                @endforeach
                                            @elseif($order->order_status == 2)
                                                @foreach ( processingOrderStatus() as  $row)
                                                <li>
                                                    <a class="dropdown-item orderStatus" href="#"
                                                    data-order="{{ $order->id }}" data-courier="{{ empty($order->courier_id) ? 0 : $order->courier_id }}" data-status="{{ $row->id }}">{{ $row->os_name }}</a>
                                                </li>
                                                @endforeach
                                            @elseif($order->order_status == 3)
                                                @foreach ( holdingOrderStatus() as  $row)
                                                <li>
                                                    <a class="dropdown-item orderStatus" href="#"
                                                    data-order="{{ $order->id }}" data-courier="{{ empty($order->courier_id) ? 0 : $order->courier_id }}" data-status="{{ $row->id }}">{{ $row->os_name }}</a>
                                                </li>
                                                @endforeach
                                            @elseif($order->order_status == 4)
                                                @foreach ( canceledOrderStatus() as  $row)
                                                <li>
                                                    <a class="dropdown-item orderStatus" href="#"
                                                    data-order="{{ $order->id }}" data-courier="{{ empty($order->courier_id) ? 0 : $order->courier_id }}" data-status="{{ $row->id }}">{{ $row->os_name }}</a>
                                                </li>
                                                @endforeach
                                            @elseif($order->order_status == 5)
                                                @foreach ( completeOrderStatus() as  $row)
                                                <li>
                                                    <a class="dropdown-item orderStatus" href="#"
                                                    data-order="{{ $order->id }}" data-courier="{{ empty($order->courier_id) ? 0 : $order->courier_id }}" data-status="{{ $row->id }}">{{ $row->os_name }}</a>
                                                </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </td>
                                @role('Super Admin|Admin|Manager')
                                <td class="text-center">
                                    {{ $order->assign->name }}
                                </td>
                                @endrole
                                <td class="text-center">
                                    <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary waves-effect dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bx bx-grid-alt
                                                font-size-15 align-middle me-2"></i> Manage
                                                <i class="mdi mdi-chevron-down"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('admin.order.view', $order->order_slug) }}">
                                                    <i class="bx bx-show-alt align-middle me-2"></i> Show
                                                </a>
                                                <a class="dropdown-item" href="{{ route('admin.order.show', $order->order_slug) }}">
                                                    <i class="bx bx-edit align-middle me-2"></i> Edit
                                                </a>
                                                @role('Super Admin|Admin')
                                                <a id="delete" class="dropdown-item" href="{{ route('admin.order.delete', $order->order_slug) }}">
                                                    <i class="bx bx-trash-alt align-middle me-2"></i> Delete
                                                </a>
                                                @endrole
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

            {{-- partner order list --}}
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-secondary bg-soft d-flex justify-content-between rounded">
                            <h5 class="my-auto">Partner Order List</h5>
                            {{-- <div>
                                @role('Super Admin|Admin')
                                    @php
                                    $allUser = App\Models\User::role('User')
                                    ->where('status', 1)
                                    ->where('online_status', 1)
                                    ->get();
                                    @endphp
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            Assing User <i class="mdi mdi-chevron-down"></i>
                                        </button>
                                        <div class="dropdown-menu" style="">
                                            <div class="dropdown-header noti-title">
                                                <h5 class="font-size-13 text-muted text-truncate mn-0">Welcome
                                                    {{ Auth::user()->name }}!</h5>
                                            </div>
            
                                            <!-- item-->
                                            @foreach ($allUser as $user)
                                            <a id="markAssign" class="dropdown-item btn-assign-user" href="#"
                                                data-id="{{ $user->id }}">{{ $user->name }}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                    <button id="markOrderDelete" type="button" class="btn btn-sm btn-danger">
                                        <i class="mdi mdi-delete-sweep fs-5"></i>
                                    </button>
                                @endrole
                                <a href="{{ route('admin.order.create') }}" class="btn btn-sm btn-info">
                                    <i class="mdi mdi-plus-thick fs-5"></i>
                                </a>
                            </div> --}}
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
                                        @role('Super Admin|Admin|Manager')
                                        <th>Assing To</th>
                                        @endrole
                                        {{-- @role('Super Admin|Admin|Manager')
                                        <th>Discount Amount</th>
                                        @endrole --}}
                                        <th class="text-center text-dark">Action</th>
                                    </tr>
                                </thead>
                                @php
                                    $orders=App\Models\Order::where('user_id',3)->orderBy('created_at','DESC')->get();
                                @endphp
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
                                                    <ul class="dropdown-menu" aria-labelledby="defaultDropdown" style="">
                                                        @forelse ($couriers as $courier)
                                                        <li>
                                                            <a class="dropdown-item orderCourier" href="#"
                                                                data-order="{{ $order->id }}"
                                                                data-courier="{{ $courier->id }}">{{ $courier->courier_name }}</a>
                                                        </li>
                                                        @empty
                                                        <li>Not Found</li>
                                                        @endforelse
                                                    </ul>
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
                                                        @if ($order->order_status == 1)
                                                            @foreach ( pendingOrderStatus() as  $row)
                                                            <li>
                                                                <a class="dropdown-item orderStatus" href="#"
                                                                data-order="{{ $order->id }}" data-courier="{{ empty($order->courier_id) ? 0 : $order->courier_id }}" data-status="{{ $row->id }}">{{ $row->os_name }}</a>
                                                            </li>
                                                            @endforeach
                                                         @elseif($order->order_status == 2)
                                                            @foreach ( processingOrderStatus() as  $row)
                                                            <li>
                                                                <a class="dropdown-item orderStatus" href="#"
                                                                data-order="{{ $order->id }}" data-courier="{{ empty($order->courier_id) ? 0 : $order->courier_id }}" data-status="{{ $row->id }}">{{ $row->os_name }}</a>
                                                            </li>
                                                            @endforeach
                                                        @elseif($order->order_status == 3)
                                                            @foreach ( holdingOrderStatus() as  $row)
                                                            <li>
                                                                <a class="dropdown-item orderStatus" href="#"
                                                                data-order="{{ $order->id }}" data-courier="{{ empty($order->courier_id) ? 0 : $order->courier_id }}" data-status="{{ $row->id }}">{{ $row->os_name }}</a>
                                                            </li>
                                                            @endforeach
                                                        @elseif($order->order_status == 4)
                                                            @foreach ( canceledOrderStatus() as  $row)
                                                            <li>
                                                                <a class="dropdown-item orderStatus" href="#"
                                                                data-order="{{ $order->id }}" data-courier="{{ empty($order->courier_id) ? 0 : $order->courier_id }}" data-status="{{ $row->id }}">{{ $row->os_name }}</a>
                                                            </li>
                                                            @endforeach
                                                        @elseif($order->order_status == 5)
                                                            @foreach ( completeOrderStatus() as  $row)
                                                            <li>
                                                                <a class="dropdown-item orderStatus" href="#"
                                                                data-order="{{ $order->id }}" data-courier="{{ empty($order->courier_id) ? 0 : $order->courier_id }}" data-status="{{ $row->id }}">{{ $row->os_name }}</a>
                                                            </li>
                                                            @endforeach
                                                        @endif
                                                    </ul>
                                                </div>
                                            </td>
                                            @role('Super Admin|Admin|Manager')
                                            <td class="text-center">
                                                {{ $order->assign->name }}
                                            </td>
                                            @endrole
                                            {{-- @role('Super Admin')
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <button
                                                        class="btn btn-{{ empty($order->courier_id) ? 'warning' : 'success'  }} dropdown-toggle btn-sm"
                                                        type="button" id="defaultDropdown" data-bs-toggle="dropdown"
                                                        data-bs-auto-close="true" aria-expanded="false">
                                                        @if (!empty($order->courier_id))
                                                        {{ $order->courier->courier_name }}
                                                        @else
                                                        Amount %
                                                        @endif
                                                        <i class="mdi mdi-chevron-down"></i>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="defaultDropdown" style="">
                                                        @forelse ($couriers as $courier)
                                                        <li>
                                                            <a class="dropdown-item orderCourier" href="#"
                                                                data-order="{{ $order->id }}"
                                                                data-courier="{{ $courier->id }}">{{ $courier->courier_name }}</a>
                                                        </li>
                                                        @empty
                                                        <li>Not Found</li>
                                                        @endforelse
                                                    </ul>
                                                </div>
                                            </td>
                                            @endrole --}}
                                            <td class="text-center">
                                                <div class="btn-group">
                                                        <button type="button" class="btn btn-sm btn-primary waves-effect dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="bx bx-grid-alt
                                                            font-size-15 align-middle me-2"></i> Manage
                                                            <i class="mdi mdi-chevron-down"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="{{ route('admin.order.view', $order->order_slug) }}">
                                                                <i class="bx bx-show-alt align-middle me-2"></i> Show
                                                            </a>
                                                            <a class="dropdown-item" href="{{ route('admin.order.show', $order->order_slug) }}">
                                                                <i class="bx bx-edit align-middle me-2"></i> Edit
                                                            </a>
                                                            @role('Super Admin|Admin')
                                                            <a id="delete" class="dropdown-item" href="{{ route('admin.order.delete', $order->order_slug) }}">
                                                                <i class="bx bx-trash-alt align-middle me-2"></i> Delete
                                                            </a>
                                                            @endrole
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
        </div>
    </div>
</div>
@endsection

@push('backend-scripts')
<script>
    // Order Assign To User
    $(document).ready(function () {
        $(document).on("click", "#markAssign", function (e) {
            e.preventDefault();
            var user_id = $(this).attr("data-id");
            var ids = [];
            var rows_selected = $("input[name='ids[]']")
                .filter(":checked")
                .map(function (index, rowId) {
                    ids[index] = rowId.value;
                });
            if (ids.length > 0) {
                if (confirm("Are You Sure To Assign This User?")) {
                    $.ajax({
                        url: "{{ route('admin.order.user.assign') }}",
                        type: "GET",
                        data: {
                            ids: ids,
                            user_id: user_id,
                            _token: $('meta[name="csrf-token"]').attr("content"),
                        },
                        success: function (data) {
                            if (data.status === "success") {
                                    Swal.fire({
                                    icon: "success",
                                    title: "Courier Assign Successfully",
                                    showConfirmButton: !1,
                                    timer: 1500
                                })
                                location.reload();
                            } else {
                                alert("Assign Failed");
                            }
                            // console.log(data);
                        },
                        error: function (data) {
                            alert(data.responseText);
                        },
                    });
                }
            } else {
                Swal.fire({
                    icon: "warning",
                    title: 'Please select at least one',
                    showConfirmButton: 1,
                    // timer: 4000,
                });
            }
        });
    });

    // Mark Order Delete
    // Media Check All Delete Image
    $(document).ready(function () {
        $(document).on("click", "#markOrderDelete", function (e) {
            e.preventDefault();
            var ids = [];
            var rows_selected = $("input[name='ids[]']")
                .filter(":checked")
                .map(function (index, rowId) {
                    ids[index] = rowId.value;
                });
            if (ids.length > 0) {
                if (confirm("Are You Sure To Delete This Data?")) {
                    $.ajax({
                        url: "{{ route('admin.mark.order.delete') }}",
                        type: "GET",
                        data: {
                            ids: ids,
                            _token: $('meta[name="csrf-token"]').attr("content"),
                        },
                        success: function (data) {
                            if (data.status === "success") {
                                Swal.fire({
                                    icon: "success",
                                    title: "Order Deleted!",
                                    showConfirmButton: !1,
                                    timer: 2000
                                })
                                location.reload();
                            } else {
                                alert("Delete Failed");
                            }
                        },
                        error: function (data) {
                            alert(data.responseText);
                        },
                    });
                }
            } else {
                Swal.fire({
                    icon: "warning",
                    title: 'Please select at least one',
                    showConfirmButton: 1,
                    // timer: 4000,
                });
            }
        });
    });
</script>
@endpush
