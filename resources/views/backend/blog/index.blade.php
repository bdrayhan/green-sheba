@extends('backend.layouts.layout')
@section('admin-title', 'Blog Managment')
@section('admin_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4><b>All Blog</b>
                        <button data-bs-toggle="modal" data-bs-target="#addBlog" class="btn btn-sm btn-primary"
                            style="float: right"><i class="bx bx-plus-medical"></i> Add New</button>
                        <a id="postDeleteButton" href="#" class="btn btn-sm btn-danger"
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
                                <th>Image</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Short Description</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($blogs as $key => $row)
                                <tr>
                                    <td>
                                        <div class="form-check font-size-16">
                                            <input name="ids[]" class="form-check-input" value="{{ $row->post_id }}"
                                                type="checkbox">
                                            <label class="form-check-label" for="transactionCheck02"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <img class="avatar-sm" src="{{ asset($row->post_feature_image) }}" alt="">
                                    </td>
                                    <td>{{ $row->post_title }}</td>
                                    <td>{{ $row->postcat->bc_name }}</td>
                                    <td>{{ Str::limit($row->post_short_details, 85, '...') }}</td>
                                    <td class="text-center">
                                        @if ($row->post_active == 1)
                                            <a href="{{ route('admin.blog.deactive', $row->post_slug) }}"
                                                class="btn btn-success waves-effect waves-light btn-sm">
                                                <i class="bx bx-like font-size-16 align-middle me-2"></i> Active
                                            </a>
                                        @else
                                            <a href="{{ route('admin.blog.active', $row->post_slug) }}"
                                                class="btn btn-danger waves-effect waves-light btn-sm">
                                                <i class="bx bx-dislike font-size-16 align-middle me-2"></i> Inactive
                                            </a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a id="postEdit" href="{{ route('admin.blog.edit', $row->post_slug) }}"
                                            class="btn btn-sm btn-primary">
                                            <i class="bx bxs-pencil"></i></a>
                                        <a id="delete" class="btn btn-sm btn-danger"
                                            href="{{ route('admin.blog.soft.delete', $row->post_slug) }}">
                                            <i class="bx bxs-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <!-- Post Create Modal -->
    <div class="modal fade" id="addBlog" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
        Post aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Blog Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.blog.insert') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row flex justify-content-center">
                            <div class="col-lg-12">
                                <div class="row mb-3">
                                    <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">BLog
                                        Title <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input name="post_title" type="text"
                                            class="form-control  @error('post_title') is-invalid @enderror"
                                            id="horizontal-firstname-input" placeholder="Enter Your Title"
                                            value="{{ old('post_title') }}">
                                        @error('post_title')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">BLog
                                        Category</label>
                                    <div class="col-sm-9">
                                        <select name="bc_id" class="form-control @error('bc_id') is-invalid @enderror">
                                            <option label="Select Category"></option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->bc_id }}">{{ $category->bc_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('bc_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">BLog
                                        Url</label>
                                    <div class="col-sm-9">
                                        <input name="post_url" type="text"
                                            class="form-control  @error('post_url') is-invalid @enderror"
                                            id="horizontal-firstname-input" placeholder="Enter Your Url"
                                            value="{{ old('post_url') }}">
                                        @error('post_url')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Feature
                                        Image</label>
                                    <div class="col-sm-9">
                                        <input id="input_image" name="post_feature_image" type="file"
                                            class="form-control">
                                        <img style="max-height: 90px;" class="mt-2" id="input_image_preview"
                                            src="" alt="">
                                        @error('post_feature_image')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Short
                                        Description</label>
                                    <div class="col-sm-9">
                                        <textarea name="post_short_details" id="" class="form-control"></textarea>
                                        @error('post_short_details')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">
                                        Description</label>
                                    <div class="col-sm-9">
                                        <textarea id="blogEditor" name="post_details" id="" class="form-control"></textarea>
                                        @error('post_details')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"> <i class="bx bxs-save"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('backend-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#postDeleteButton').click(function(e) {
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
                                url: "blog/multi-delete",
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
