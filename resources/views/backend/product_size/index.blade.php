@extends('backend.layouts.layout')
@section('admin-title', 'Size Managment')
@section('admin_content')
    <div class="row">
        <div class="col-12 col-md-8 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4><b>All Size</b></h4>
                    <a id="sizeDeleteButton" href="#" class="btn btn-sm btn-danger"
                        style="float: right; margin-right: 15px;"><i class=" bx bxs-trash-alt"></i>
                        Mark Delete</a>
                </div>
                <div class="card-body px-2">
                    <table id="datatable" class="table table-bordered dt-responsive wrap w-100 table-check">
                        <thead>
                            <tr>
                                <th style="width: 20px;">
                                    <div class="form-check font-size-16 align-middle">
                                        <input class="form-check-input" type="checkbox" id="checkAll">
                                        <label class="form-check-label" for="checkAll"></label>
                                    </div>
                                </th>
                                <th>Name</th>
                                <th>Remarks</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sizes as $key => $row)
                                <tr>
                                    <td>
                                        <div class="form-check font-size-16">
                                            <input name="ids[]" class="form-check-input" value="{{ $row->id }}"
                                                type="checkbox">
                                            <label class="form-check-label" for="transactionCheck02"></label>
                                        </div>
                                    </td>
                                    <td>{{ $row->size_name }}</td>
                                    <td>{{ $row->size_remarks }}</td>
                                    <td class="text-center">
                                        @if ($row->size_active == 1)
                                            <a href="#" class="btn btn-success waves-effect waves-light btn-sm">
                                                <i class="bx bx-like font-size-16 align-middle me-2"></i> Active
                                            </a>
                                        @else
                                            <a href="#" class="btn btn-danger waves-effect waves-light btn-sm">
                                                <i class="bx bx-dislike font-size-16 align-middle me-2"></i> Inactive
                                            </a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <button data-bs-toggle="modal" data-bs-target="#editSizeModal{{ $row->size_slug }}"
                                            class="btn btn-sm btn-primary"> <i class="bx bxs-pencil"></i></button>
                                        <a id="delete" class="btn btn-sm btn-danger"
                                            href="{{ route('admin.product.size.delete', $row->size_slug) }}">
                                            <i class="bx bxs-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                                <!-- Size Edit Modal -->
                                <div class="modal fade" id="editSizeModal{{ $row->size_slug }}" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" role="dialog"
                                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Size Edit Information</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('admin.product.size.update', $row->size_slug) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-group mb-2">
                                                        <label for="">Name</label>
                                                        <input class="form-control @error('size_name') is-invalid @enderror"
                                                            type="text" name="size_name" placeholder="Enter Size Name"
                                                            value="{{ $row->size_name }}">
                                                        @error('size_name')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label for="">Remarks</label>
                                                        <input class="form-control" type="text" name="size_remarks"
                                                            placeholder="Enter Size Remarks"
                                                            value="{{ $row->size_remarks }}">
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label for="">Order By</label>
                                                        <input class="form-control" type="number" name="size_orderby"
                                                            placeholder="Order Id" value="{{ $row->size_orderby }}">
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
                                <!-- Size Edit End Modal -->
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->

        <div class="col-12 col-md-4 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4><b>Add New Size</b> </h4>
                </div>
                <div class="card-body px-2">
                    <form action="{{ route('admin.product.size.insert') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group mb-2">
                                <label for="">Name</label>
                                <input class="form-control @error('size_name') is-invalid @enderror" type="text"
                                    name="size_name" placeholder="Enter Size Name" value="">
                                @error('size_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Remarks</label>
                                <input class="form-control" type="text" name="size_remarks"
                                    placeholder="Enter Size Remarks" value="">
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Order By</label>
                                <input class="form-control" type="number" name="size_orderby" placeholder="Order Id"
                                    value="">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"> <i class="bx bxs-save"></i> Save</button>
                        </div>
                    </form>
                    <!-- Size Create End Modal -->
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection

@push('backend-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#sizeDeleteButton').click(function(e) {
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
                                url: "product-size/multi-delete",
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
