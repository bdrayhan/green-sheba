@extends('backend.layouts.layout')
@section('admin-title', 'Blog Category Managment')
@section('admin_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4><b>All Blog Category</b>
                        <button data-bs-toggle="modal" data-bs-target="#addBlogCategoryModal" class="btn btn-sm btn-primary"
                            style="float: right"><i class="bx bx-plus-medical"></i> Add Category</button>
                        <a id="blogCatDeleteButton" href="#" class="btn btn-sm btn-danger"
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
                                <th>Category Name</th>
                                <th>Category Url</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($blog_categories as $row)
                                <tr>
                                    <td>
                                        <div class="form-check font-size-16">
                                            <input name="ids[]" class="form-check-input" value="{{ $row->bc_id }}"
                                                type="checkbox">
                                            <label class="form-check-label" for="transactionCheck02"></label>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $row->bc_name }}
                                    </td>
                                    <td>
                                        {{ $row->bc_url }}
                                    </td>
                                    <td class="text-center">
                                        @if ($row->bc_active == 1)
                                            <a href="{{ route('admin.blog.category.deactive', $row->bc_slug) }}"
                                                class="btn btn-success waves-effect waves-light btn-sm">
                                                <i class="bx bx-like font-size-16 align-middle me-2"></i> Active
                                            </a>
                                        @else
                                            <a href="{{ route('admin.blog.category.active', $row->bc_slug) }}"
                                                class="btn btn-danger waves-effect waves-light btn-sm">
                                                <i class="bx bx-dislike font-size-16 align-middle me-2"></i> Inactive
                                            </a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#editBlogCategoryModal{{ $row->bc_id }}"> <i
                                                class="bx bxs-pencil"></i></button>
                                        <a id="delete" class="btn btn-sm btn-danger"
                                            href="{{ route('admin.blog.category.soft.delete', $row->bc_slug) }}">
                                            <i class="bx bxs-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>

                                <!-- Blog Category Edit Modal -->
                                <div class="modal fade" id="editBlogCategoryModal{{ $row->bc_id }}"
                                    data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
                                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Blog Category Information
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('admin.blog.category.update', $row->bc_slug) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-group mb-2">
                                                        <label for="name">Category Name</label>
                                                        <input class="form-control @error('bc_name') is-invalid @enderror"
                                                            type="text" name="bc_name" placeholder="Enter Category Name"
                                                            value="{{ $row->bc_name }}" required>
                                                        @error('bc_name')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label for="name">Category Url</label>
                                                        <input class="form-control @error('bc_url') is-invalid @enderror"
                                                            type="text" name="bc_url" placeholder="Enter Category Url"
                                                            value="{{ $row->bc_url }}" required>
                                                        @error('bc_url')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label for="name">Category Order Id</label>
                                                        <input
                                                            class="form-control @error('bc_orderby') is-invalid @enderror"
                                                            type="number" name="bc_orderby" placeholder="Enter Order Id"
                                                            value="{{ $row->bc_orderby }}">
                                                        @error('bc_orderby')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label for="name">Category Remarks</label>
                                                        <input class="form-control @error('bc_remark') is-invalid @enderror"
                                                            type="text" name="bc_remark"
                                                            placeholder="Enter Category Remarks"
                                                            value="{{ $row->bc_remark }}">
                                                        @error('bc_remark')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="bx bx-save w-2"></i> Update Category
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Blog Category Edit End Modal -->
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <!-- Blog Category Create Modal -->
    <div class="modal fade" id="addBlogCategoryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Blog Category Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.blog.category.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label for="name">Category Name</label>
                            <input class="form-control @error('bc_name') is-invalid @enderror" type="text"
                                name="bc_name" placeholder="Enter Category Name" value="{{ old('bc_name') }}" required>
                            @error('bc_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="name">Category Url</label>
                            <input class="form-control @error('bc_url') is-invalid @enderror" type="text"
                                name="bc_url" placeholder="Enter Category Url" value="{{ old('bc_url') }}" required>
                            @error('bc_url')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="name">Category Order Id</label>
                            <input class="form-control @error('bc_orderby') is-invalid @enderror" type="number"
                                name="bc_orderby" placeholder="Enter Order Id" value="{{ old('bc_orderby') }}">
                            @error('bc_orderby')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="name">Category Remarks</label>
                            <input class="form-control @error('bc_remark') is-invalid @enderror" type="text"
                                name="bc_remark" placeholder="Enter Category Remarks" value="{{ old('bc_remark') }}">
                            @error('bc_remark')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bx bx-save w-2"></i> Save Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Blog Category Create End Modal -->
@endsection

@push('backend-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#blogCatDeleteButton').click(function(e) {
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
                                url: "blog-category/multi-delete",
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
