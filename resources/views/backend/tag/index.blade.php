@extends('backend.layouts.layout')
@section('admin-title', 'Tag Managment')
@section('admin_content')

    <div class="row d-flex justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <h4><b>All Tag</b>
                        <button data-bs-toggle="modal" data-bs-target="#addTagModal" class="btn btn-sm btn-primary"
                            style="float: right"><i class="bx bx-plus-medical"></i> Add New</button>
                        <a id="tagDeleteButton" href="#" class="btn btn-sm btn-danger"
                            style="float: right; margin-right: 15px;"><i class=" bx bxs-trash-alt"></i>
                            Mark Delete</a>
                    </h4>
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
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tags as $row)
                                <tr>
                                    <td>
                                        <div class="form-check font-size-16">
                                            <input name="ids[]" class="form-check-input" value="{{ $row->id }}"
                                                type="checkbox">
                                            <label class="form-check-label" for="transactionCheck02"></label>
                                        </div>
                                    </td>
                                    <td>{{ $row->tag_name }}</td>
                                    <td class="text-center">
                                        <button data-bs-toggle="modal" data-bs-target="#editTagModal{{ $row->id }}"
                                            class="btn btn-sm btn-primary"><i class="bx bx-pencil"></i></button>
                                        <a id="delete" class="btn btn-sm btn-danger"
                                            href="{{ route('admin.tag.delete', $row->tag_slug) }}">
                                            <i class="bx bxs-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                                <!-- Tag Edit Modal -->
                                <div class="modal fade" id="editTagModal{{ $row->id }}" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" role="dialog"
                                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Tag Information</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('admin.tag.update', $row->tag_slug) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-group mb-2">
                                                        <label for="">Tag Name</label>
                                                        <input required
                                                            class="form-control @error('tag_name') is-invalid @enderror"
                                                            type="text" name="tag_name" placeholder="Enter Your Tag"
                                                            value="{{ $row->tag_name }}">
                                                        @error('tag_name')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mb-5">
                                                        <label for="">Order By</label>
                                                        <input class="form-control" type="number" name="tag_order"
                                                            placeholder="Order Id" value="{{ $row->tag_order }}">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary"><i
                                                            class="bx bx-save w-2"></i> Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Tag Edit End Modal -->
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <!-- Tag Create Modal -->
    <div class="modal fade" id="addTagModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tag Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.tag.insert') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label for="">Tag Name</label>
                            <input required class="form-control @error('tag_name') is-invalid @enderror" type="text"
                                name="tag_name" placeholder="Enter Tag Name" value="{{ old('tag_name') }}">
                            @error('tag_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-5">
                            <label for="">Order By</label>
                            <input class="form-control" type="number" name="tag_order" placeholder="Order By">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"><i class="bx bx-save w-2"></i> Save Tag</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- City Create End Modal -->
@endsection
@push('backend-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#tagDeleteButton').click(function(e) {
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
                                url: "tag/multi-delete",
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
