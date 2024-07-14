@extends('backend.layouts.layout')
@section('admin-title', 'Partner Managment')
@section('admin_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4><b>All Partner</b>
                        <button data-bs-toggle="modal" data-bs-target="#addPartnerModal" class="btn btn-sm btn-primary"
                            style="float: right"><i class="bx bx-plus-medical"></i> Add New</button>
                        <a id="partnerDeleteButton" href="#" class="btn btn-sm btn-danger"
                            style="float: right; margin-right: 15px;"><i class=" bx bxs-trash-alt"></i>
                            Mark Delete</a>
                    </h4>
                </div>
                <div class="card-body px-2">
                    <table id="datatable" class="table text-center table-bordered dt-responsive wrap w-100 table-check">
                        <thead>
                            <tr>
                                <th style="width: 20px;">
                                    <div class="form-check font-size-16 align-middle">
                                        <input class="form-check-input" type="checkbox" id="checkAll">
                                        <label class="form-check-label" for="checkAll"></label>
                                    </div>
                                </th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($partners as $key => $row)
                                <tr>
                                    <td>
                                        <div class="form-check font-size-16">
                                            <input name="ids[]" class="form-check-input" value="{{ $row->id }}"
                                                type="checkbox">
                                            <label class="form-check-label" for="transactionCheck02"></label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        @if (File::exists($row->partner_logo))
                                            <img class="rounded" style="width: 80px;" src="{{ asset($row->partner_logo) }}"
                                                alt="">
                                        @else
                                            <img class="rounded" width="80px"
                                                src="{{ asset('backend/assets/images/default_image.png') }}" alt="">
                                        @endif
                                    </td>
                                    <td>{{ $row->partner_name }}</td>
                                    <td class="text-center">
                                        {{ $row->phone }}
                                    </td>
                                    <td class="text-center">
                                        {{ $row->address }}
                                    </td>
                                    <td class="text-center">
                                        @if ($row->partner_status)
                                            <a href="{{ route('admin.partner.deactive', $row->partner_slug) }}"
                                                class="btn btn-success waves-effect waves-light btn-sm">
                                                <i class="bx bx-like font-size-16 align-middle me-2"></i> Active
                                            </a>
                                        @else
                                            <a href="{{ route('admin.partner.active', $row->partner_slug) }}"
                                                class="btn btn-danger waves-effect waves-light btn-sm">
                                                <i class="bx bx-dislike font-size-16 align-middle me-2"></i> Inactive
                                            </a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-sm btn-primary"
                                            href="{{ route('admin.partner.request.profile', $row->partner_slug) }}">
                                            <i class='bx bxs-user-detail'></i> </a>
                                        <a class="btn btn-sm btn-primary"
                                            href="{{ route('admin.partner.request.edit', $row->partner_slug) }}">
                                            <i class="bx bxs-pencil"></i> </a>
                                        <a id="delete" class="btn btn-sm btn-danger"
                                            href="{{ route('admin.partner.destroy', $row->partner_slug) }}">
                                            <i class="bx bxs-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                                <!-- Partner Edit Modal -->
                                <div class="modal fade" id="editPartnerModal{{ $row->id }}" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" role="dialog"
                                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Partner Information</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('admin.partner.update', $row->partner_slug) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="old_image" value="{{ $row->partner_logo }}">
                                                <div class="modal-body">
                                                    <div class="form-group mb-2">
                                                        <label for="">Title</label>
                                                        <input
                                                            class="form-control @error('partner_title') is-invalid @enderror"
                                                            type="text" name="partner_title"
                                                            placeholder="Enter Partner Title"
                                                            value="{{ $row->partner_title }}">
                                                        @error('partner_title')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label for="">Order By</label>
                                                        <input class="form-control" type="number" name="partner_sorting"
                                                            placeholder="Order By Id" value="{{ $row->partner_sorting }}">
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label for="">URL</label>
                                                        <input class="form-control" type="text" name="partner_url"
                                                            placeholder="www.example.com"
                                                            value="{{ $row->partner_url }}">
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label for="">Image</label>
                                                        <input id="input_image"
                                                            class="form-control @error('partner_logo') is-invalid @enderror"
                                                            type="file" name="partner_logo">
                                                        @error('partner_logo')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                        @if (File::exists($row->partner_logo))
                                                            <img id="input_image_preview" class="rounded me-2 my-2"
                                                                width="100px" src="{{ asset($row->partner_logo) }}"
                                                                alt="">
                                                        @else
                                                            <img id="input_image_preview" class="rounded me-2 my-2"
                                                                width="100px"
                                                                src="{{ asset('backend/assets/images/default_image.png') }}"
                                                                alt="">
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update Partner</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Partner Edit End Modal -->
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <!-- Partner Create Modal -->
    <div class="modal fade" id="addPartnerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Partner Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.partner.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label for="">Title</label>
                            <input class="form-control @error('partner_title') is-invalid @enderror" type="text"
                                name="partner_title" placeholder="Enter Partner Title"
                                value="{{ old('partner_title') }}">
                            @error('partner_title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Order By</label>
                            <input class="form-control" type="number" name="partner_sorting" placeholder="Order By Id"
                                value="{{ old('partner_sorting') }}">
                        </div>
                        <div class="form-group mb-2">
                            <label for="">URL</label>
                            <input class="form-control" type="text" name="partner_url" placeholder="www.example.com"
                                value="{{ old('partner_url') }}">
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Image</label>
                            <input id="input_image" class="form-control @error('partner_logo') is-invalid @enderror"
                                type="file" name="partner_logo">
                            @error('partner_logo')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <img id="input_image_preview" class="rounded me-2 my-2" width="100px"
                                src="{{ asset('backend/assets/images/default_image.png') }}" alt="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Partner</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Partner Create End Modal -->
@endsection


@push('backend-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#partnerDeleteButton').click(function(e) {
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
                                url: "partner/multi-delete",
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
