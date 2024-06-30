@extends('backend.layouts.layout')
@section('admin-title', 'Banner Managment')
@section('admin_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4><b>All Banner</b>
                        <button data-bs-toggle="modal" data-bs-target="#addBannerModal" class="btn btn-sm btn-primary"
                            style="float: right"><i class="bx bx-plus-medical"></i> Add New</button>
                        <a id="bannerDeleteButton" href="#" class="btn btn-sm btn-danger"
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
                                <th>Publish</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($banners as $key => $row)
                                <tr>
                                    <td>
                                        <div class="form-check font-size-16">
                                            <input name="ids[]" class="form-check-input" value="{{ $row->id }}"
                                                type="checkbox">
                                            <label class="form-check-label" for="transactionCheck02"></label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        @if (File::exists($row->banner_image))
                                            <img class="rounded" style="width: 100px; max-height: 80px;"
                                                src="{{ asset($row->banner_image) }}" alt="">
                                        @else
                                            <img class="rounded" width="100px"
                                                src="{{ asset('backend/assets/images/default_image.png') }}" alt="">
                                        @endif
                                    </td>
                                    <td>{{ $row->banner_title }}</td>
                                    <td class="text-center">
                                        @if ($row->banner_publish == 1)
                                            <span class="badge badge-lg bg-success">Published</span>
                                        @else
                                            <span class="badge bg-warning">Unpublished</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($row->banner_status)
                                            <a href="{{ route('admin.banner.deactive', $row->banner_slug) }}"
                                                class="btn btn-success waves-effect waves-light btn-sm">
                                                <i class="bx bx-like font-size-16 align-middle me-2"></i> Active
                                            </a>
                                        @else
                                            <a href="{{ route('admin.banner.active', $row->banner_slug) }}"
                                                class="btn btn-danger waves-effect waves-light btn-sm">
                                                <i class="bx bx-dislike font-size-16 align-middle me-2"></i> Inactive
                                            </a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <button data-bs-toggle="modal" data-bs-target="#editBannerModal{{ $row->id }}"
                                            class="btn btn-sm btn-primary"> <i class="bx bxs-pencil"></i></button>
                                        <a id="delete" class="btn btn-sm btn-danger"
                                            href="{{ route('admin.banner.destroy', $row->banner_slug) }}">
                                            <i class="bx bxs-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                                <!-- Banner Edit Modal -->
                                <div class="modal fade" id="editBannerModal{{ $row->id }}" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" role="dialog"
                                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Banner Information</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('admin.banner.update', $row->banner_slug) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="old_image" value="{{ $row->banner_image }}">
                                                <div class="modal-body">
                                                    <div class="form-group mb-2">
                                                        <label for="">Title</label>
                                                        <input
                                                            class="form-control @error('banner_title') is-invalid @enderror"
                                                            type="text" name="banner_title"
                                                            placeholder="Enter Banner Title"
                                                            value="{{ $row->banner_title }}">
                                                        @error('banner_title')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label for="">Mid Title</label>
                                                        <input
                                                            class="form-control @error('banner_mid_title') is-invalid @enderror"
                                                            type="text" name="banner_mid_title"
                                                            placeholder="Enter Banner Mid Title"
                                                            value="{{ $row->banner_mid_title }}">
                                                        @error('banner_mid_title')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label for="">Sub Title</label>
                                                        <input
                                                            class="form-control @error('banner_sub_title') is-invalid @enderror"
                                                            type="text" name="banner_sub_title"
                                                            placeholder="Enter Banner Sub Title"
                                                            value="{{ $row->banner_sub_title }}">
                                                        @error('banner_sub_title')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label for="">Button Name</label>
                                                        <input
                                                            class="form-control @error('banner_button') is-invalid @enderror"
                                                            type="text" name="banner_button"
                                                            placeholder="Enter Button Name"
                                                            value="{{ $row->banner_button }}">
                                                        @error('banner_button')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label for="">Order By</label>
                                                        <input class="form-control" type="number" name="banner_sorting"
                                                            placeholder="Order By Id" value="{{ $row->banner_sorting }}">
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label for="">URL</label>
                                                        <input class="form-control" type="text" name="banner_url"
                                                            placeholder="www.example.com" value="{{ $row->banner_url }}">
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label for="">Publish</label>
                                                        <select class="form-control" name="banner_publish">
                                                            <option value="1"
                                                                {{ $row->banner_publish == 1 ? 'selected' : '' }}>
                                                                published</option>
                                                            <option value="0"
                                                                {{ $row->banner_publish == 0 ? 'selected' : '' }}>
                                                                Unpublish</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label for="">Image</label>
                                                        <input id="input_image"
                                                            class="form-control  @error('banner_image') is-invalid @enderror"
                                                            type="file" name="banner_image">
                                                        @if (File::exists($row->banner_image))
                                                            <img id="input_image_preview" class="rounded me-2 my-2"
                                                                width="100px" src="{{ asset($row->banner_image) }}"
                                                                alt="">
                                                        @else
                                                            <img id="input_image_preview" class="rounded me-2 my-2"
                                                                width="100px"
                                                                src="{{ asset('backend/assets/images/default_image.png') }}"
                                                                alt="">
                                                        @endif
                                                        @error('banner_image')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update Banner</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Banner Edit End Modal -->
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <!-- Banner Create Modal -->
    <div class="modal fade" id="addBannerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Banner Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.banner.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label for="">Title</label>
                            <input class="form-control @error('banner_title') is-invalid @enderror" type="text"
                                name="banner_title" placeholder="Enter Banner Title" value="{{ old('banner_title') }}">
                            @error('banner_title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Mid Title</label>
                            <input class="form-control @error('banner_mid_title') is-invalid @enderror" type="text"
                                name="banner_mid_title" placeholder="Enter Banner Mid Title"
                                value="{{ old('banner_mid_title') }}">
                            @error('banner_mid_title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Sub Title</label>
                            <input class="form-control @error('banner_sub_title') is-invalid @enderror" type="text"
                                name="banner_sub_title" placeholder="Enter Banner Sub Title"
                                value="{{ old('banner_sub_title') }}">
                            @error('banner_sub_title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Button Name</label>
                            <input class="form-control @error('banner_button') is-invalid @enderror" type="text"
                                name="banner_button" placeholder="Enter Button Name" value="{{ old('banner_button') }}">
                            @error('banner_button')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Order By</label>
                            <input class="form-control" type="number" name="banner_sorting" placeholder="Order By Id"
                                value="{{ old('banner_sorting') }}">
                        </div>
                        <div class="form-group mb-2">
                            <label for="">URL</label>
                            <input class="form-control" type="text" name="banner_url" placeholder="www.example.com"
                                value="{{ old('banner_url') }}">
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Image</label>
                            <input id="input_image" class="form-control  @error('banner_image') is-invalid @enderror"
                                type="file" name="banner_image">
                            <img id="input_image_preview" class="rounded me-2 my-2" width="100px"
                                src="{{ asset('backend/assets/images/default_image.png') }}" alt="">
                            @error('banner_image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Banner</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Banner Create End Modal -->
@endsection

@push('backend-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#bannerDeleteButton').click(function(e) {
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
                                url: "banner/multi-delete",
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
