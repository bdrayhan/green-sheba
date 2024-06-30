@extends('backend.layouts.layout')
@section('admin-title', 'Customer Managment')
@section('admin_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4><b>All Customer</b>
                        <button data-bs-toggle="modal" data-bs-target="#addCustomerModal" class="btn btn-sm btn-primary"
                            style="float: right"><i class="bx bx-plus-medical"></i> Add New Customer</button>
                            <a id="customerDeleteButton" href="#" class="btn btn-sm btn-danger"
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
                                <th width="8%">Image</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $key => $user)
                                <tr>
                                    <td>
                                        <div class="form-check font-size-16">
                                            <input name="ids[]" class="form-check-input" value="{{ $user->id }}"
                                                type="checkbox">
                                            <label class="form-check-label" for="transactionCheck02"></label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        @if (!empty($user->image))
                                            <img style="width: 80px;" src="{{ asset($user->image) }}" alt="">
                                        @else
                                        <img style="width: 80px;" src="{{ asset('media/profile-2.png') }}" alt="">
                                        @endif
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>
                                        @if ($user->phone)
                                            {{ $user->phone }}
                                        @else
                                            Not Available
                                        @endif
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td class="text-center">
                                        @if ($user->status == 1)
                                            <a href="{{ route('admin.user.deactive', $user->slug) }}"
                                                class="btn btn-success waves-effect waves-light btn-sm">
                                                <i class="bx bx-like font-size-16 align-middle me-2"></i>
                                                Active
                                            </a>
                                        @else
                                            <a href="{{ route('admin.user.active', $user->slug) }}"
                                                class="btn btn-danger waves-effect waves-light btn-sm" disabled="disabled">
                                                <i class="bx bx-dislike font-size-16 align-middle me-2"></i>
                                                Inactive
                                            </a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <button data-bs-toggle="modal"
                                            data-bs-target="#editCustomerModal{{ $user->id }}"
                                            class="btn btn-sm btn-primary">
                                            <i class="bx bxs-pencil"></i></button>
                                        <a id="delete" class="btn btn-sm btn-danger"
                                            href="{{ route('admin.user.destroy', $user->slug) }}">
                                            <i class="bx bxs-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>

                                <!-- Customer Edit Modal -->
                                <div class="modal fade" id="editCustomerModal{{ $user->id }}" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" role="dialog"
                                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Customer Information</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('admin.customer.update', $user->slug) }}" method="POST"
                                                enctype="multipart/form-data">
                                                <input class="form-control" type="hidden" value="{{ $user->id }}"
                                                    name="user_id">
                                                <input class="form-control" type="hidden" value="{{ $user->image }}"
                                                    name="old_image">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-group mb-2">
                                                        <label for="name">Name</label>
                                                        <input id="name" class="form-control @error('name') is-invalid @enderror"
                                                            type="text" name="name" placeholder="Enter Name"
                                                            value="{{ $user->name }}" required>
                                                        @error('name')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label for="phone">Phone</label>
                                                        <input min="11" class="form-control" type="number"
                                                            name="phone" placeholder="Enter Phone"
                                                            value="{{ $user->phone }}">
                                                    </div>

                                                    <div class="form-group mb-2">
                                                        <label for="">Email</label>
                                                        <input class="form-control" type="email" name="email"
                                                            placeholder="Enter Email" value="{{ $user->email }}" required>
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label for="">Password</label>
                                                        <input class="form-control" type="password" name="password"
                                                            placeholder="Enter Password">
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label for="">Image</label>
                                                        <input id="input_image" class="form-control" type="file"
                                                            name="image">
                                                        @if (!empty($user->image))
                                                            <img id="input_image_preview" class="rounded me-2 my-2"
                                                                width="100px" src="{{ asset($user->image) }}"
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
                                                    <button type="submit" class="btn btn-primary">Update
                                                        Customer</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Customer Edit End Modal -->
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <!-- Customer Create Modal -->
    <div class="modal fade" id="addCustomerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Customer Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.customer.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label for="name">Name</label>
                            <input id="name" class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                                placeholder="Enter Name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="phone">Phone</label>
                            <input id="phone" class="form-control" type="tel" name="phone"
                                placeholder="Enter Phone" value="{{ old('phone') }}" required>
                        </div>

                        <div class="form-group mb-2">
                            <label for="email">Email</label>
                            <input id="email" class="form-control" type="email" name="email" placeholder="Enter Email"
                                value="{{ old('email') }}" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="password">Password</label>
                            <input class="form-control" type="password" name="password" placeholder="Enter Password"
                                value="{{ old('password') }}" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Image</label>
                            <input id="input_image" class="form-control" type="file" name="image">
                            <img id="input_image_preview" class="rounded me-2 my-2" width="100px"
                                src="{{ asset('backend/assets/images/default_image.png') }}" alt="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Customer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- User Create End Modal -->
@endsection

@push('backend-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#customerDeleteButton').click(function(e) {
                // e.preventDefault();
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
                                url: "customer/multi-delete",
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
