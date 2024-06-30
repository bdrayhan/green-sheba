@extends('backend.layouts.layout')
@section('admin-title', 'Permission Manager')
@section('admin_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit <b class="text-primary">{{ $role->name }}</b> Permission
                        <a href="{{ route('admin.permission.index') }}" class="btn btn-sm btn-primary" style="float: right"><i
                                class="bx bx-left-arrow-alt"></i> Back</a>
                    </h4>
                </div>

                <div class="card-body px-2">
                    <form action="{{ route('admin.permission.update', $role->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @php
                            $groups = $permissions->unique('group');
                        @endphp
                        <div class="card-header bg-white">
                            <button id="toggleCheckbox" class="btn btn-sm btn-primary"> Select All</button>
                        </div>
                        <div class="modal-body">
                            <div class="row mb-4 p-4">
                                @foreach ($groups as $group)
                                    <div class="card">
                                        <div class="card-header py-0">
                                            <h4 class="text-danger">{{ $group->group }} Permissions :</h4>
                                        </div>
                                        <hr>
                                        <div class="card-body">
                                            <div class="row">
                                                @foreach ($permissions->where('group', $group->group)->all() as $k => $permission)
                                                    <div class="col-sm-3 col-md-4 col-lg-2">
                                                        <div class="form-check form-switch form-switch-md form-check-primary mb-3"
                                                            dir="ltr">
                                                            <input
                                                                {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}
                                                                value="{{ $permission->name }}" name="role_permission[]"
                                                                type="checkbox" class="form-check-input" id="">
                                                            <label class="form-check-label text-capitalize"
                                                                for="">{{ $permission->name }}</label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">
                                <i class="bx bx-sync w-2"></i> Update Permission</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection
