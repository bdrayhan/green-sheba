@extends('backend.layouts.layout')
@section('admin-title', 'Main Menu Managment')
@section('admin_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4><b>All Menu</b>
                        <button data-bs-toggle="modal" data-bs-target="#addMenuModal" class="btn btn-sm btn-primary"
                            style="float: right"><i class="bx bx-plus-medical"></i> Add New</button>
                            <a id="customerDeleteButton" href="#" class="btn btn-sm btn-danger"
                            style="float: right; margin-right: 15px;"><i class=" bx bxs-trash-alt"></i>
                            Mark Delete</a>
                    </h4>
                </div>
                <div class="card-body px-2">
                    <table id="datatable" class="table table-bordered dt-responsive wrap w-100">
                        <thead>
                            <tr>
                                <th width="20%">Name</th>
                                <th width="30%">Url</th>
                                <th width="10%">Order</th>
                                <th width="20%" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($menubars as $key => $menu)
                                <tr>
                                    <td>{{ $menu->menu_name }}</td>
                                    <td>
                                        {{ $menu->menu_link }}
                                    </td>
                                    <td>{{ $menu->menu_order }}</td>
                                    <td class="text-center">
                                        <button data-bs-toggle="modal"
                                            data-bs-target="#editMenuModal{{ $menu->id }}"
                                            class="btn btn-sm btn-primary">
                                            <i class="bx bxs-pencil"></i></button>
                                        <a id="delete" class="btn btn-sm btn-danger"
                                            href="#">
                                            <i class="bx bxs-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>

                                <!-- Menu Edit Modal -->
                                <div class="modal fade" id="editMenuModal{{ $menu->id }}" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" role="dialog"
                                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Customer Information</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('admin.menu.update', $menu->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-group mb-2">
                                                        <label for="menu_name">Menu Name <span class="text-danger">*</span></label>
                                                        <input id="menu_name" class="form-control @error('menu_name') is-invalid @enderror" type="text" name="menu_name"
                                                            placeholder="Menu Name" value="{{ $menu->menu_name }}" required>
                                                        @error('menu_name')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label for="menu_link">Menu Url <span class="text-danger">*</span></label>
                                                        <input id="menu_link" class="form-control @error('menu_link') is-invalid @enderror" type="text" name="menu_link"
                                                            placeholder="Menu Url" value="{{ $menu->menu_link }}" required>
                                                        @error('menu_link')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label for="menu_order">Menu Order <span class="text-danger">*</span></label>
                                                        <input id="menu_order" class="form-control @error('menu_order') is-invalid @enderror" type="number" name="menu_order"
                                                            placeholder="Menu Order" value="{{ $menu->menu_order }}" required>
                                                        @error('menu_order')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update Menu</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Menu Edit End Modal -->
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->


    <!-- Menu Create Modal -->
    <div class="modal fade" id="addMenuModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Menu Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.menu.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label for="menu_name">Menu Name <span class="text-danger">*</span></label>
                            <input id="menu_name" class="form-control @error('menu_name') is-invalid @enderror" type="text" name="menu_name"
                                placeholder="Menu Name" value="{{ old('menu_name') }}" required>
                            @error('menu_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="menu_link">Menu Url <span class="text-danger">*</span></label>
                            <input id="menu_link" class="form-control @error('menu_link') is-invalid @enderror" type="text" name="menu_link"
                                placeholder="Menu Url" value="{{ old('menu_link') }}" required>
                            @error('menu_link')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="menu_order">Menu Order <span class="text-danger">*</span></label>
                            <input id="menu_order" class="form-control @error('menu_order') is-invalid @enderror" type="number" name="menu_order"
                                placeholder="Menu Order" value="{{ old('menu_order') }}" required>
                            @error('menu_order')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Menu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- User Create End Modal -->
@endsection
