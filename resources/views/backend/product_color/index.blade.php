@extends('backend.layouts.layout')
@section('admin-title', 'Color Managment')
@section('admin_content')
    <div class="row">
        <div class="col-12 col-md-8 col-sm-12">
            <div class="card">
                <div class="card-header bg-secondary bg-gradient rounded text-white d-flex justify-content-between align-items-center">
                    <h4 style="margin-bottom: 0px;">Color List</h4>
                    <a id="colorDeleteButton" href="#" class="btn btn-danger"
                        style="float: right; margin-right: 15px;"><i class=" bx bxs-trash"></i></a>
                </div>
                <div class="card-body px-2">
                    <table id="datatable" class="table table-bordered dt-responsive wrap table-check w-100  table-check">
                        <thead>
                            <tr>
                                <th style="width: 20px;">
                                    <div class="form-check font-size-16 align-middle">
                                        <input class="form-check-input" type="checkbox" id="checkAll">
                                        <label class="form-check-label" for="checkAll"></label>
                                    </div>
                                </th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Status</th>
                                <th>Order By</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($colors as $key => $row)
                                <tr>
                                    <td>
                                        <div class="form-check font-size-16">
                                            <input name="ids[]" class="form-check-input" value="{{ $row->id }}"
                                                type="checkbox">
                                            <label class="form-check-label" for="transactionCheck02"></label>
                                        </div>
                                    </td>
                                    <td>{{ $row->color_name }}</td>
                                    <td>{{ $row->color_code }}</td>

                                    <td class="text-center">
                                        @if ($row->color_active == 1)
                                            <a href="{{ route('admin.product.color.deactive', $row->color_slug) }}"
                                                class="btn btn-success waves-effect waves-light btn-sm">
                                                <i class="bx bx-like font-size-16 align-middle me-2"></i> Active
                                            </a>
                                        @else
                                            <a href="{{ route('admin.product.color.active', $row->color_slug) }}"
                                                class="btn btn-danger waves-effect waves-light btn-sm">
                                                <i class="bx bx-dislike font-size-16 align-middle me-2"></i> Inactive
                                            </a>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $row->color_orderby ?? '-----' }}</td>

                                    <td class="text-center" width="150px">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary waves-effect dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bx bx-grid-alt
                                                font-size-15 align-middle me-2"></i> Manage
                                                <i class="mdi mdi-chevron-down"></i>
                                            </button>
                                            <div class="dropdown-menu" style="">
                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#editColorModal{{ $row->color_slug }}">
                                                    <i class="bx bx-edit align-middle me-2"></i> Edit
                                                </button>
                                                <a id="delete" class="dropdown-item" href="{{ route('admin.product.color.softdelete', $row->color_slug) }}">
                                                    <i class="bx bx-trash-alt align-middle me-2"></i> Delete
                                                </a>
                                            </div>
                                        </div>
                                    </td>


                                </tr>
                                <!-- Color Edit Modal -->
                                <div class="modal fade" id="editColorModal{{ $row->color_slug }}" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" role="dialog"
                                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Color Edit Information</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('admin.product.color.update', $row->color_slug) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-group mb-2">
                                                        <label for="">Name</label>
                                                        <input
                                                            class="form-control @error('color_name') is-invalid @enderror"
                                                            type="text" name="color_name" placeholder="Enter Color Name"
                                                            value="{{ $row->color_name }}">
                                                        @error('color_name')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label for="">Color Code</label>
                                                        <input class="form-control" type="text" name="color_code"
                                                            placeholder="#000000" value="{{ $row->color_code }}">
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label for="">Order By</label>
                                                        <input class="form-control" type="number" name="color_orderby"
                                                            placeholder="Order Id" value="{{ $row->color_orderby }}">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary"><i
                                                            class="bx bx-sync"></i> Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Brand Edit End Modal -->
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->

        <div class="col-12 col-md-4 col-sm-12">
            <div class="card">
                <div class="card-header bg-secondary bg-gradient rounded text-white">
                    <h4 style="margin-bottom: 0px">Add New Color</h4>
                </div>
                <div class="card-body px-2">
                    <form action="{{ route('admin.product.color.insert') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group mb-2">
                                <label for="">Name</label>
                                <input class="form-control @error('color_name') is-invalid @enderror" type="text"
                                    name="color_name" placeholder="Enter Color Name" value="{{ old('color_name') }}">
                                @error('color_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Color Code</label>
                                <input class="form-control" type="text" name="color_code" placeholder="#000000"
                                    value="{{ old('color_code') }}">
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Order By</label>
                                <input class="form-control" type="number" name="color_orderby" placeholder="Order Id"
                                    value="{{ old('color_orderby') }}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"> <i class="bx bxs-save"></i> Save</button>
                        </div>
                    </form>
                    <!-- Color Create End Modal -->
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection

@push('backend-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#colorDeleteButton').click(function(e) {
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
                        confirmButtonClass: "btn btn-success mt-2",
                        cancelButtonClass: "btn btn-danger ms-2 mt-2",
                        buttonsStyling: 1
                    }).then(function(t) {
                        t.value ?
                            $.ajax({
                                type: "POST",
                                url: "product-color/multi-delete",
                                data: {
                                    ids: ids,
                                    _token: $('meta[name="csrf-token"]').attr("content"),
                                },
                                success: function(data) {
                                    if (data.status == "success") {
                                        window.location.reload();
                                    }
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
