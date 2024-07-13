@extends('backend.layouts.layout')
@section('admin-title', 'All Courier Order')
@section('admin_content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">All Courier</h4>
                <div class="page-title-right">
                    <ol class="m-0 breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Return Order</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Order Short Section -->
    <div class="row">
        @foreach (getAllCourier() as $courier)
            <div class="col-md-2">
                <a href="{{ route('admin.courier.order.show', $courier->id) }}">
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-muted fw-medium">{{ $courier->courier_name }}</p>
                                    <h4 class="mb-0 text-dark">{{ $courier->orders_count }}</h4>
                                </div>
                                <div class="flex-shrink-0 align-self-center">
                                    <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                        <span class="avatar-title">
                                            <i class="bx bx-bus font-size-24"></i>
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
                        <button id="markOrderDelete" type="button" class="btn btn-sm btn-danger">
                            <i class="mdi mdi-delete-sweep fs-5"></i>
                        </button>
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
                                        {{ $order->courier->courier_name }}
                                    </td>
                                    <td>
                                        {{ date('d-F-Y', strtotime($order->order_date)) }}
                                    </td>

                                    <td class="text-center">
                                        <p>{{ $order->status->os_name }}</p>
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
                                                <a id="delete" class="dropdown-item" href="{{ route('admin.order.delete', $order->order_slug) }}">
                                                    <i class="bx bx-trash-alt align-middle me-2"></i> Delete
                                                </a>
                                            </div>
                                        </div>
                                        <a href="{{ route('admin.courier.order.return.show', $order->id) }}" class="btn btn-sm btn-dark">
                                            <i class="bx bx-history font-size-15 align-middle me-1"></i>
                                                Return
                                        </a>
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

@push('backend-scripts')
<script>
    // Mark Order Delete
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
                            if (data.status == "success") {
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
