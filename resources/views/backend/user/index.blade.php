@extends('backend.layouts.layout')
@section('admin-title', 'User Management')
@section('admin_content')
    @php
        $roles = Spatie\Permission\Models\Role::whereNotIn('name', ['Super Admin'])->get();
    @endphp
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4><b>All User</b>
                        <button data-bs-toggle="modal" data-bs-target="#addUserModal" class="btn btn-sm btn-primary"
                            style="float: right"><i class="bx bx-plus-medical"></i> Add New User</button>
                    </h4>
                </div>
                <div class="card-body px-2">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th class="text-center">Online</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key => $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>
                                        @if ($user->phone)
                                            {{ $user->phone }}
                                        @else
                                            Not Available
                                        @endif
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->roles[0]->name)
                                            <span class="badge badge-pill badge-soft-success font-size-12"> {{ $user->roles[0]->name }} </span>
                                        @else
                                            <span class="badge badge-pill badge-soft-danger font-size-12">
                                                Role Not Assing
                                            </span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        @if ($user->id == Auth::id())
                                            <span class="badge badge-pill badge-soft-success font-size-12">
                                                Current User
                                            </span>
                                        @else
                                            @if ($user->online_status == 1)
                                                <a href="{{ route('admin.user.onilne.deactive', $user->slug) }}"
                                                    class="btn btn-success waves-effect waves-light btn-sm">
                                                    <i class="bx bx-like font-size-16 align-middle me-2"></i>
                                                    Order Active
                                                </a>
                                            @else
                                                <a href="{{ route('admin.user.onilne.active', $user->slug) }}"
                                                    class="btn btn-danger waves-effect waves-light btn-sm"
                                                    disabled="disabled">
                                                    <i class="bx bx-dislike font-size-16 align-middle me-2"></i>
                                                    Order Deactive
                                                </a>
                                            @endif
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        @if ($user->id == Auth::id())
                                            <span class="badge badge-pill badge-soft-success font-size-12">
                                                Current User
                                            </span>
                                        @else
                                            @if ($user->status == 1)
                                                <a href="{{ route('admin.user.deactive', $user->slug) }}"
                                                    class="btn btn-success waves-effect waves-light btn-sm">
                                                    <i class="bx bx-like font-size-16 align-middle me-2"></i>
                                                    Active
                                                </a>
                                            @else
                                                <a href="{{ route('admin.user.active', $user->slug) }}"
                                                    class="btn btn-danger waves-effect waves-light btn-sm"
                                                    disabled="disabled">
                                                    <i class="bx bx-dislike font-size-16 align-middle me-2"></i>
                                                    Inactive
                                                </a>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <button data-id="{{ $user->id }}" class="editButton btn btn-sm btn-primary">
                                            <i class="bx bxs-pencil"></i>
                                        </button>
                                        @can('user delete')
                                            <a id="delete" class="btn btn-sm btn-danger"
                                                href="{{ route('admin.user.destroy', $user->slug) }}">
                                                <i class="bx bxs-trash-alt"></i>
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <!-- User Create Modal -->
    <div class="modal fade" id="addUserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">User Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.user.store') }}" method="POST" id="userCreateFrom">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label for="userName">Name</label>
                            <input id="userName" class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                                placeholder="Enter Name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="userPhone">Phone</label>
                            <input id="userPhone" class="form-control" type="number" name="phone"
                                placeholder="Enter Phone" value="{{ old('phone') }}">
                        </div>

                        <div class="form-group mb-2">
                            <label for="userEmail">Email</label>
                            <input id="userEmail" class="form-control" type="email" name="email" placeholder="Enter Email"
                                value="{{ old('email') }}" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="userPassword">Password</label>
                            <input id="userPassword" class="form-control" type="password" name="password" placeholder="Enter Password"
                                value="{{ old('password') }}" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="userRole">Role</label>
                            <select name="user_role" id="userRole" class="form-control" required>
                                <option label="Select Role"></option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button id="saveButton" type="submit" class="btn btn-primary">Save User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- User Create End Modal -->

    <!-- User Edit Modal -->
    <div class="modal fade" id="editUserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit User Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form method="POST" id="updateUserFrom">
                    @csrf
                    @method('PUT')
                    <input id="userId" type="hidden" name="user_id">
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label for="updateUserName">Name</label>
                            <input id="updateUserName" class="form-control" type="text" name="name" placeholder="Enter Name" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="updateUserPhone">Phone</label>
                            <input id="updateUserPhone" class="form-control" type="number"
                                name="phone" placeholder="Enter Phone" >
                        </div>

                        <div class="form-group mb-2">
                            <label for="updateUserEmail">Email</label>
                            <input id="updateUserEmail" class="form-control" type="email" name="email" placeholder="Enter Email" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="updateUserRole">Role</label>
                            <select name="user_role" id="updateUserRole" class="form-control" required>
                                <option label="Select Role"></option>
                                @foreach ($roles as $role)
                                <option value="{{ $role->name }}">
                                    {{ $role->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button id="updateUserButton" type="submit" class="btn btn-primary">Update User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- User Edit End Modal -->
@endsection

@push('backend-scripts')

    <script>
        $(document).ready(function() {
            // Store Form
            $('#saveButton').click(function(e) {
                e.preventDefault();
                $('#saveButton').html('<div class="spinner-border spinner-border-sm" role="status"></div>');
                // Form Submit By Ajax
                $.ajax({
                    url: $('#userCreateFrom').attr('action'),
                    method: $('#userCreateFrom').attr('method'),
                    data: new FormData($('#userCreateFrom')[0]),
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        console.log(data);
                        $('#userCreateFrom').trigger('reset');
                        $('#addUserModal').modal('hide');
                        $('#saveButton').html('Save User');
                        toastr.success(data.message);
                        location.reload();
                    },
                    error: function(error) {
                        $('#saveButton').html('Save User');
                        $.each(error.responseJSON.errors, function(key, value) {
                            toastr.error(value);
                        });
                    }
                });
            });

            // Show User Edit Modal
            $('.editButton').click(function() {
                let id = $(this).data('id');
                $.ajax({
                    url: "{{ url('admin/user') }}/" + id + "/edit",
                    method: "GET",
                    success: function(data) {
                        console.log(data);
                        $('#userId').val(data.user.id);
                        $('#updateUserName').val(data.user.name);
                        $('#updateUserPhone').val(data.user.phone);
                        $('#updateUserEmail').val(data.user.email);
                        $('#updateUserRole').val(data.user_role);
                        $('#editUserModal').modal('show');
                    }
                });
            });

            // Update User
            $('#updateUserButton').click(function(e) {
                e.preventDefault();
                $('#updateUserButton').html('<div class="spinner-border spinner-border-sm" role="status"></div>');
                // Set Route On Action Form
                let id = $('#userId').val();
                let url = "{{ url('admin/user') }}/" + id;
                $('#updateUserFrom').attr('action', url);

                $.ajax({
                    url: $('#updateUserFrom').attr('action'),
                    method: $('#updateUserFrom').attr('method'),
                    data: new FormData($('#updateUserFrom')[0]),
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        console.log(data);
                        $('#updateUserFrom').trigger('reset');
                        $('#editUserModal').modal('hide');
                        $('#updateUserButton').html('Update User');
                        toastr.success(data.message);
                        location.reload();
                    },
                    error: function(error) {
                        $('#updateUserButton').html('Update User');
                        $.each(error.responseJSON.errors, function(key, value) {
                            toastr.error(value);
                        });
                    }
                });
            });
        });
    </script>

@endpush
