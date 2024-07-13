@extends('backend.layouts.layout')
@section('admin-title', 'Product Managment')
@section('admin_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header px-0">
                    <h4><b>Total {{ count($products) }} Product</b>

                        <a id="productDeleteButton" href="#" class="btn btn-danger"
                            style="float: right;"><i class="bx bxs-trash-alt"></i></a>
                        <a href="{{ route('admin.product.create') }}" class="btn btn-primary" style="float: right; margin-right:10px;"><i
                                class="bx bx-plus-medical"></i></a>
                    </h4>
                </div>
                <div class="card-body px-2">
                    <table id="datatable" class="table table-bordered dt-responsive table-check w-100 table-check wrap">
                        <thead class="text-primary">
                            <tr>
                                <th width="5%">
                                    <div class="form-check font-size-16 align-middle">
                                        <input class="form-check-input" type="checkbox" id="checkAll">
                                        <label class="form-check-label" for="checkAll"></label>
                                    </div>
                                </th>
                                <th class="text-center" width="5%">Image</th>
                                <th width="30%">Name</th>
                                <th width="10%">Info</th>
                                <th width="5%">SKU</th>
                                <th width="5%">Quantity</th>
                                <th width="5%">BackOrder</th>
                                <th width="5%">Active</th>
                                <th width="10%" class="text-center text-dark">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $key => $row)
                                <tr>
                                    <td class="text-center">
                                        <div class="form-check font-size-16 align-middle pt-3">
                                            <input name="ids[]" class="form-check-input" value="{{ $row->id }}"
                                                type="checkbox">
                                            <label class="form-check-label" for="transactionCheck02"></label>
                                        </div>
                                    </td>
                                    <td class="text-center" style="vertical-align: middle;">
                                        @if ($row->product_thumbnail)
                                            <img src="{{ asset($row->product_thumbnail) }}" alt="Image"
                                                class="rounded" width="50px">
                                        @else
                                            <img class="rounded" width="50px"
                                                src="{{ asset('backend/assets/images/default_image.png') }}"
                                                alt="">
                                        @endif
                                    </td>
                                    <td class="text-left fw-light" style="vertical-align: middle;">
                                        {{ Str::upper($row->product_name) }}
                                    </td>
                                    <td style="vertical-align: middle;">
                                        Price: <b>৳{{ $row->product_regular_price }}</b>
                                        @if (!$row->product_discount_price == 0)
                                        /
                                        <b>৳{{ $row->product_discount_price }}</b>
                                        @endif
                                    </td>
                                    <td class="text-left" style="vertical-align: middle;">
                                        {{ $row->product_code }}
                                    </td>
                                    <td class="text-center" style="vertical-align: middle;">
                                        <span class="badge bg-success">{{ $row->product_quantity }}</span>
                                    </td>
                                    <td style="vertical-align: middle;">
                                        @if ($row->product_back_order == 1)
                                        <b>Enable</b>
                                        @else
                                        <b>Disabled</b>
                                        @endif
                                    </td>
                                    <td style="vertical-align: middle;">
                                        @if ($row->product_active == 1)
                                        <b>Enable</b>
                                        @else
                                        <b>Disabled</b>
                                        @endif
                                    </td>
                                    <td class="text-center" width="150px" style="vertical-align: middle;">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary waves-effect dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bx bx-grid-alt
                                                font-size-15 align-middle me-2"></i> Manage
                                                <i class="mdi mdi-chevron-down"></i>
                                            </button>
                                            <div class="dropdown-menu" style="">
                                                <a class="dropdown-item" href="{{ route('admin.product.edit', $row->product_slug) }}">
                                                    <i class="bx bx-edit align-middle me-2"></i> Edit
                                                </a>
                                                <a id="delete" class="dropdown-item" href="{{ route('admin.product.delete', $row->product_slug) }}">
                                                    <i class="bx bx-trash-alt align-middle me-2"></i> Delete
                                                </a>
                                                <a href="{{ route('admin.product.status', $row->product_slug) }}"
                                                    class="dropdown-item text-{{ $row->product_active == 1 ? 'danger' : 'success' }}">
                                                    <i class="bx bx-{{ $row->product_active == 1 ? 'dislike' : 'like' }} align-middle me-2"></i> {{ $row->product_active == 1 ? 'Disable' : 'Enable' }}
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection

@push('backend-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#productDeleteButton').click(function(e) {
                e.preventDefault();
                var ids = [];
                var rows_selected = $("input[name='ids[]']")
                    .filter(":checked")
                    .map(function(index, rowId) {
                        ids[index] = rowId.value;
                    });
                if (ids.length > 0) {
                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: !0,
                        confirmButtonText: "Yes, delete it!",
                        cancelButtonText: "No, cancel!",
                    }).then(function(t) {
                        t.value ?
                            $.ajax({
                                type: "POST",
                                url: "product/multi-delete",
                                data: {
                                    ids: ids,
                                    _token: $('meta[name="csrf-token"]').attr("content"),
                                },
                                success: function(data) {
                                    Swal.fire({
                                        title: "Deleted!",
                                        text: "Your file has been deleted.",
                                        icon: "success",
                                        showConfirmButton: false,
                                        timer: 1500,
                                    }).then(function() {
                                        location.reload();
                                    });
                                },
                                error: function(data) {
                                    alert(data.responseText);
                                },
                            }) :
                            t.dismiss === Swal.DismissReason.cancel && Swal.fire({
                                title: "Cancelled",
                                text: "Your imaginary file is safe :)",
                                icon: "error"
                            })
                    })
                } else {
                    Swal.fire({
                        icon: "warning",
                        title: 'Please select at least one item',
                        showConfirmButton: 1,
                        // timer: 4000,
                    });
                }

            });
        });
    </script>
@endpush
