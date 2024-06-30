@extends('backend.layouts.layout')
@section('admin-title', 'Permission Managment')
@section('admin_content')
    @push('custom-style')
        <link href="{{ asset('backend') }}/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    @endpush

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4><b>All Role Permission</b>
                    </h4>
                </div>
                <div class="card-body px-2">
                    <table id="datatable" class="table table-bordered dt-responsive w-100">
                        <thead>
                            <tr>
                                <th width="150px">Role Name</th>
                                <th>Permission</th>
                                <th class="text-center" style="width: 100px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $key => $role)
                                <tr>
                                    <td width="150px">
                                        {{ $role->name }}
                                    </td>
                                    <td>

                                        @if (count($role->permissions) > 0)
                                            @foreach ($role->permissions->pluck('name')->slice(0, 18) as $permission)
                                                <span class="badge bg-primary mr-3">
                                                    {{ $permission }}
                                                </span>
                                            @endforeach
                                            @if (count($role->permissions) > 18)
                                                <span class="badge bg-primary mr-3">
                                                    More...
                                                </span>
                                            @endif
                                        @else
                                            <span class="badge bg-warning">
                                                No Permission Assing
                                            </span>
                                        @endif

                                    </td>
                                    <td class="text-center" style="width: 100px">
                                        <a title="Permission" href="{{ route('admin.permission.edit', $role->id) }}"
                                            class="btn btn-sm btn-primary"> <i class="bx bxs-pencil"></i></a>

                                        {{-- <a id="delete" class="btn btn-sm btn-danger" href="#">
                                            <i class="bx bxs-trash-alt"></i> </a> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection
