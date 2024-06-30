@extends('backend.layouts.layout')
@section('admin-title', 'Product Category Managment')
@section('admin_content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body border-bottom">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 card-title flex-grow-1">Category List</h5>
                        <div class="flex-shrink-0">
                            <a href="{{ route('admin.product.category.export') }}" class="btn btn-success">
                                <i class="fas fa-file-excel align-baseline ms-1"> Export</i>
                            </a>
                            <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#categoryImport">
                                <i class="fas fa-file-excel align-baseline ms-1"> Import</i>
                            </button>
                            <a id="categoryDeleteButton" href="#" class="btn btn-danger"><i
                                    class="bx bx-trash"></i></a>

                        </div>
                    </div>
                </div>
                <div class="card-body px-2">
                    <table id="datatable" class="table table-bordered dt-responsive wrap table-check w-100 table-check">
                        <thead>
                            <tr class="text-primary">
                                <th width="5%">
                                    <div class="form-check font-size-16 align-middle">
                                        <input class="form-check-input" type="checkbox" id="checkAll">
                                        <label class="form-check-label" for="checkAll"></label>
                                    </div>
                                </th>
                                <th width="5%">Image</th>
                                <th width="20%">Name</th>
                                <th width="10%">Url</th>
                                <th width="10%">Feature</th>
                                <th width="10%">Order</th>
                                <th width="15%" class="text-center text-dark">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $key => $row)
                                <tr>
                                    <td>
                                        <div class="form-check font-size-16">
                                            <input name="ids[]" class="form-check-input" value="{{ $row->id }}"
                                                type="checkbox">
                                            <label class="form-check-label" for="transactionCheck02"></label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        @if (File::exists($row->pc_image))
                                            <img class="rounded" width="50px" src="{{ asset($row->pc_image) }}"
                                                alt="">
                                        @else
                                            <img class="rounded" width="70px"
                                                src="{{ asset('backend/assets/images/default_image.png') }}" alt="">
                                        @endif
                                    </td>
                                    <td>{{ $row->pc_name }}

                                        @forelse ($row->children as $children)
                                            > {{ $children->pc_name }}
                                        @empty
                                        @endforelse
                                    </td>
                                    <td>{{ $row->pc_url }}</td>

                                    <td class="text-center">
                                        <a href="{{ route('admin.product.category.feature', $row->pc_slug) }}"
                                            class="btn btn-{{ $row->pc_feature == 1 ? 'success' : 'danger' }} waves-effect waves-light btn-sm">
                                            <i
                                                class="bx bx-{{ $row->pc_feature == 1 ? 'like' : 'dislike' }} font-size-16 align-middle me-2"></i>
                                            {{ $row->pc_feature == 1 ? 'On' : 'Off ' }}
                                        </a>
                                    </td>
                                    <td class="text-center">{{ $row->pc_orderby ? $row->pc_orderby : 'null' }}</td>

                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button type="button"
                                                class="btn btn-sm btn-primary waves-effect dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i
                                                    class="bx bx-grid-alt
                                                font-size-15 align-middle me-2"></i>
                                                Manage
                                                <i class="mdi mdi-chevron-down"></i>
                                            </button>
                                            <div class="dropdown-menu" style="">
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.product.category.edit', $row->pc_slug) }}">
                                                    <i class="bx bx-edit align-middle me-2"></i> Edit
                                                </a>
                                                <a id="delete" class="dropdown-item"
                                                    href="{{ route('admin.product.category.delete', $row->pc_slug) }}">
                                                    <i class="bx bx-trash-alt align-middle me-2"></i> Delete
                                                </a>
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.product.category.status', $row->pc_slug) }}">
                                                    <i
                                                        class="bx bx-{{ $row->pc_active == 1 ? 'dislike' : 'like' }} align-middle me-2"></i>
                                                    {{ $row->pc_active == 1 ? 'Disable' : 'Enable' }}
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
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-secondary bg-gradient rounded text-white">
                    <h5 style="margin-bottom: 0px;">Category Create</h5>
                </div>
                <div class="card-body p-5">
                    <form action="{{ route('admin.product.category.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label for="">Parent</label>
                                <select class="form-control" name="parent_id">
                                    <option value="0">Select Parent</option>
                                    @foreach ($categories as $key => $category)
                                        <option value="{{ $category->id }}">{{ $category->pc_name }}
                                            @forelse ($category->children as $children)
                                                > {{ $children->pc_name }}
                                            @empty
                                            @endforelse
                                        </option>
                                    @endforeach
                                </select>
                                @error('pc_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group my-3">
                                <label for="">Name</label>
                                <input class="form-control @error('pc_name') is-invalid @enderror" type="text"
                                    name="pc_name" placeholder="Category Name" value="{{ old('pc_name') }}">
                                @error('pc_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Order By</label>
                                <input class="form-control" type="number" name="pc_orderby" placeholder="Order Id"
                                    value="{{ old('pc_orderby') }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Url</label>
                                <input class="form-control  @error('pc_url') is-invalid @enderror" type="text"
                                    name="pc_url" placeholder="Enter Your Url" value="{{ old('pc_url') }}">
                                @error('pc_url')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Remarks</label>
                                <textarea class="form-control" name="pc_remarks" placeholder="Enter Your Remarks">{{ old('pc_remarks') }}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Image</label>
                                <input id="input_image" class="form-control" type="file" name="pc_image">
                                <img id="input_image_preview" class="rounded me-2 my-2" width="100px"
                                    src="{{ asset('backend/assets/images/default_image.png') }}" alt="">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary px-5 fs-5"><i class="bx bx-save"></i>
                                Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->

    </div> <!-- end row -->
    <!-- Category Create End Modal -->
    <!-- Color Edit Modal -->
    <div class="modal fade" id="categoryImport" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Import Excel File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.product.category.import.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label for="">File</label>
                            <input id="question_file" class="form-control" type="file" name="category_file"
                                placeholder="Category File" required
                                accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms.excel">
                            @error('excel_file')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Brand Edit End Modal -->
@endsection

@push('backend-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#categoryDeleteButton').click(function(e) {
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
                                url: "product-category/multi-delete",
                                data: {
                                    ids: ids,
                                    _token: $('meta[name="csrf-token"]').attr("content"),
                                },
                                success: function(data) {
                                    if (data.status === "success") {
                                        Swal.fire({
                                            icon: "success",
                                            title: data.message,
                                            showConfirmButton: false,
                                            // timer: 4000,
                                        });
                                        setTimeout(function() {
                                            location.reload();
                                        }, 1000);
                                    }

                                    if (data.status === "error") {
                                        Swal.fire({
                                            icon: "error",
                                            title: data.message,
                                            showConfirmButton: false,
                                            timer: 1500,
                                        });
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
