@extends('backend.layouts.layout')
@section('admin-title', 'Brand Managment')
@section('admin_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4><b>All Brand</b>
                        <button data-bs-toggle="modal" data-bs-target="#addBrandModal" class="btn btn-sm btn-primary"
                            style="float: right"><i class="bx bx-plus-medical"></i> Add New</button>
                        <a id="brandDeleteButton" href="#" class="btn btn-sm btn-danger"
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
                                <th> Name</th>
                                <th>Feature</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $key => $row)
                                <tr>
                                    <td>
                                        <div class="form-check font-size-16">
                                            <input name="ids[]" class="form-check-input" value="{{ $row->id }}"
                                                type="checkbox">
                                            <label class="form-check-label" for="transactionCheck02"></label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        @if (File::exists($row->brand_image))
                                            <img class="rounded" style="width: 80px;" src="{{ asset($row->brand_image) }}"
                                                alt="">
                                        @else
                                            <img class="rounded" width="80px"
                                                src="{{ asset('backend/assets/images/default_image.png') }}" alt="">
                                        @endif
                                    </td>
                                    <td>{{ $row->brand_name }}</td>
                                    <td class="text-center">
                                        @if ($row->brand_feature == 1)
                                            <span class="badge badge-lg bg-success">Active</span>
                                        @else
                                            <span class="badge bg-warning">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($row->brand_active == 1)
                                            <a href="{{ route('admin.brand.deactive', $row->brand_slug) }}"
                                                class="btn btn-success waves-effect waves-light btn-sm">
                                                <i class="bx bx-like font-size-16 align-middle me-2"></i> Active
                                            </a>
                                        @else
                                            <a href="{{ route('admin.brand.active', $row->brand_slug) }}"
                                                class="btn btn-danger waves-effect waves-light btn-sm">
                                                <i class="bx bx-dislike font-size-16 align-middle me-2"></i> Inactive
                                            </a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <button data-bs-toggle="modal" data-bs-target="#editBrandModal{{ $row->id }}"
                                            class="btn btn-sm btn-primary"> <i class="bx bxs-pencil"></i></button>
                                        <a id="delete" class="btn btn-sm btn-danger"
                                            href="{{ route('admin.brand.softdelete', $row->brand_slug) }}">
                                            <i class="bx bxs-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                                <!-- Brand Edit Modal -->
                                <div class="modal fade" id="editBrandModal{{ $row->id }}" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" role="dialog"
                                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Brand Edit Information</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('admin.brand.update', $row->brand_slug) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @method('PUT')
                                                @csrf
                                                <input type="hidden" name="old_image" value="{{ $row->brand_image }}">
                                                <div class="modal-body">
                                                    <div class="form-group mb-2">
                                                        <label for="">Name</label>
                                                        <input
                                                            class="form-control @error('brand_name') is-invalid @enderror"
                                                            type="text" name="brand_name" placeholder="Enter Brand Name"
                                                            value="{{ $row->brand_name }}">
                                                        @error('brand_name')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label for="">Order By</label>
                                                        <input class="form-control" type="number" name="brand_orderby"
                                                            placeholder="Order By Id" value="{{ $row->brand_orderby }}">
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label for="">Image(330*88)</label>
                                                        <input id="input_image"
                                                            class="form-control  @error('brand_image') is-invalid @enderror"
                                                            type="file" name="brand_image">
                                                        @if (File::exists($row->brand_image))
                                                            <img id="input_image_preview" class="rounded me-2 my-2"
                                                                width="100px" src="{{ asset($row->brand_image) }}"
                                                                alt="">
                                                        @else
                                                            <img id="input_image_preview" class="rounded me-2 my-2"
                                                                width="100px"
                                                                src="{{ asset('backend/assets/images/default_image.png') }}"
                                                                alt="">
                                                        @endif
                                                        @error('brand_image')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label for="">URL</label>
                                                        <input class="form-control" type="text" name="brand_url"
                                                            placeholder="www.example.com/url"
                                                            value="{{ $row->brand_url }}">
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="">Remarks</label>
                                                        <textarea class="form-control" name="brand_remarks" placeholder="Enter Your Remarks">{{ $row->brand_remarks }}</textarea>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <div class="form-check form-switch form-switch-md mb-3"
                                                            dir="ltr">
                                                            <input name="brand_feature" class="form-check-input"
                                                                type="checkbox" id="SwitchCheckSizemd" value="1"
                                                                {{ $row->brand_feature == 1 ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="SwitchCheckSizemd">Feature</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
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
    </div> <!-- end row -->

    <!-- Brand Create Modal -->
    <div class="modal fade" id="addBrandModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Brand Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.brand.insert') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label for="">Name</label>
                            <input class="form-control @error('brand_name') is-invalid @enderror" type="text"
                                name="brand_name" placeholder="Enter Brand Name" value="{{ old('brand_name') }}">
                            @error('brand_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Order By</label>
                            <input class="form-control" type="number" name="brand_orderby" placeholder="Order Id"
                                value="{{ old('brand_orderby') }}">
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Image(330*88)</label>
                            <input id="input_image" class="form-control  @error('brand_image') is-invalid @enderror"
                                type="file" name="brand_image">
                            <img id="input_image_preview" class="rounded me-2 my-2" width="100px"
                                src="{{ asset('backend/assets/images/default_image.png') }}" alt="">
                            @error('brand_image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="">URL</label>
                            <input class="form-control" type="text" name="brand_url"
                                placeholder="www.example.com/url" value="{{ old('brand_url') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Remarks</label>
                            <textarea class="form-control" name="brand_remarks" placeholder="Enter Your Remarks">{{ old('brand_remarks') }}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                                <input name="brand_feature" class="form-check-input" type="checkbox"
                                    id="SwitchCheckSizemd" value="1">
                                <label class="form-check-label" for="SwitchCheckSizemd">Feature</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Brand Create End Modal -->
@endsection


@push('backend-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#brandDeleteButton').click(function(e) {
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
                                url: "brand/multi-delete",
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
