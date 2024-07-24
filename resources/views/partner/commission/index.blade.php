@extends('backend.layouts.layout')
@section('admin-title', 'Order Management')
@section('admin_content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Commission</h4>

            <div class="page-title-right">
                <ol class="m-0 breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Commission</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- Order Short Section -->

</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-secondary bg-soft d-flex justify-content-between rounded">
                <h5 class="my-auto">Commission Product List</h5>
                <div>
                    <a href="#" class="btn btn-sm btn-info">
                        1234
                    </a>
                </div>
            </div> 

            <div class="card-body">
                <table id="datatable" class="table text-center table-bordered dt-responsive wrap w-100 table-check">
                    <thead>
                        <tr class="text-primary">
                            <th width="2%">
                                <div class="form-check font-size-15">
                                    <input class="form-check-input" type="checkbox" id="checkAll">
                                </div>
                            </th>
                            {{-- <th>Invoice</th> --}}
                            <th>Product Name</th>
                            <th>Product Amount</th>
                            {{-- <th>Product Quantity</th> --}}
                            <th>Commission</th>
                            {{-- <th>Order Status</th> --}}
                            {{-- @role('Super Admin|Admin|Manager')
                            <th>Assing To</th>
                            @endrole --}}
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
                                {{-- <td>
                                    {{ $order->invoice_no }}
                                </td> --}}
                                {{-- <td>
                                    {{ $order->shipping->shipping_name }}
                                </td> --}}
                                <td class="text-center">{{ $order->courier_id ? $order->courier->courier_name : 'Not Assign' }}</td>
                                <td class="text-center">৳ {{ number_format(orderSubtotal($order->id)) }}</td>
                                <td>
                                    {{ date('d-F-Y', strtotime($order->order_date)) }}
                                </td>
                                {{-- <td>{{ $order->status->os_name }}</td> --}}
                                {{-- @role('Super Admin|Admin|Manager')
                                <td class="text-center">
                                    {{ $order->assign->name }}
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
                                                {{-- <a class="dropdown-item" href="{{ route('backend.partner.order.details', $order->order_slug) }}">
                                                    <i class="bx bx-show-alt align-middle me-2"></i> Show
                                                </a> --}}
                                                <a id="delete" class="dropdown-item" href="{{ route('admin.order.delete', $order->order_slug) }}">
                                                    <i class="bx bx-trash-alt align-middle me-2"></i> Delete
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
