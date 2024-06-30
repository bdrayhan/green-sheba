@extends('backend.layouts.layout')
@section('admin-title', 'Supplier')
@section('admin_content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Supplier</h4>
            <div class="page-title-right">
                <button data-bs-toggle="modal" data-bs-target="#addSupplierModal"
                    class="btn btn-primary waves-effect waves-light" style="margin-right: 5px">
                    <i class="bx bx-plus-medical font-size-16 align-middle"></i>
                </button>
                <a href="#" class="btn btn-danger waves-effect waves-light">
                    <i class="bx bxs-trash font-size-16 align-middle"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-9">
        <div class="card border border-secondary border-opacity-25">
            <div class="card-header bg-blend-soft-light d-flex justify-start border border-secondary border-bottom border-opacity-25">
                <i class="bx bx-layer fs-4 me-2"></i>
                    <h5>Supplier List</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered border-secondary border-opacity-25 mb-0 wrap w-100">
                    <thead>
                        <tr class="text-primary">
                            <th width="15%">Supplier Name</th>
                            <th width="20%">Supplier Phone</th>
                            <th width="15%">Supplier Email</th>
                            <th width="30%">Address</th>
                            <th width="20%" class="text-dark text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($suppliers as $supplier)
                        <tr>
                            <td>{{ $supplier->supplier_name }}</td>
                            <td>{{ $supplier->supplier_phone }}</td>
                            <td>{{ $supplier->supplier_email }}</td>
                            <td>{{ $supplier->wireHouse_address }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-primary waves-effect dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bx bx-grid-alt
                                        font-size-15 align-middle me-2"></i> Manage
                                        <i class="mdi mdi-chevron-down"></i>
                                    </button>
                                    <div class="dropdown-menu" style="">
                                        <a data-bs-toggle="modal" data-bs-target="#editSupplierModal{{ $supplier->id }}" class="dropdown-item" href="#">
                                            <i class="bx bx-edit align-middle me-2"></i> Edit
                                        </a>
                                        <a id="delete" class="dropdown-item" href="{{ route('admin.supplier.destroy',$supplier->supplier_slug) }}">
                                            <i class="bx bx-trash-alt align-middle me-2"></i> Delete
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <!-- Supplier Edit Modal -->
                        <div class="modal fade" id="editSupplierModal{{ $supplier->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                            role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Supplier Information</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('admin.supplier.update', $supplier->supplier_slug) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="form-group mb-2">
                                                <label for="supplier_name">Name</label>
                                                <input class="form-control @error('supplier_name') is-invalid @enderror" type="text"
                                                    name="supplier_name" placeholder="Supplier Name" value="{{ $supplier->supplier_name }}">
                                                @error('supplier_name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="supplier_phone">Phone</label>
                                                <input class="form-control @error('supplier_phone') is-invalid @enderror" type="text"
                                                    name="supplier_phone" placeholder="Supplier Phone" value="{{ $supplier->supplier_phone }}">
                                                @error('supplier_phone')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="supplier_email">Email</label>
                                                <input class="form-control @error('supplier_email') is-invalid @enderror" type="email"
                                                    name="supplier_email" placeholder="Supplier Email" value="{{ $supplier->supplier_email }}">
                                                @error('supplier_email')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="wireHouse_address">Address</label>
                                                <input class="form-control @error('wireHouse_address') is-invalid @enderror" type="text"
                                                    name="wireHouse_address" placeholder="Supplier Address" value="{{ $supplier->wireHouse_address }}">
                                                @error('wireHouse_address')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                <i class="bx bx-sync font-size-16 align-middle me-1"></i> Update
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
                <div class="my-3">{{ $suppliers->links('pagination::bootstrap-5') }}</div>
            </div>
        </div>
    </div>
    <!-- Filtaring -->
    <div class="col-sm-3">
        <div class="card border border-secondary border-opacity-25">
            <div class="card-header bg-blend-soft-light d-flex justify-start">
                <i class="bx bx-filter fs-4 me-2"></i>
                    <h5>Filter</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.supplier.search') }}" method="GET">
                    <div class="mb-3">
                        <label for="supplier_phone" class="form-label">Supplier Phone</label>
                        <input value="{{ array_key_exists('supplier_phone', $_GET) ? $_GET['supplier_phone'] : '' }}" name="supplier_phone" type="text" class="form-control" placeholder="Supplier Phone">
                    </div>
                    <div class="mb-3" style="float: right;">
                        <button type="submit" class="btn btn-sm btn-primary waves-effect waves-light">
                            <i class="bx bxs-filter-alt font-size-16 align-middle me-1"></i> Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Supplier Create Modal -->
<div class="modal fade" id="addSupplierModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Supplier Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.supplier.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label for="supplier_name">Name</label>
                        <input class="form-control @error('supplier_name') is-invalid @enderror" type="text"
                            name="supplier_name" placeholder="Supplier Name" value="{{ old('supplier_name') }}">
                        @error('supplier_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="supplier_phone">Phone</label>
                        <input class="form-control @error('supplier_phone') is-invalid @enderror" type="text"
                            name="supplier_phone" placeholder="Supplier Phone" value="{{ old('supplier_phone') }}">
                        @error('supplier_phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="supplier_email">Email</label>
                        <input class="form-control @error('supplier_email') is-invalid @enderror" type="email"
                            name="supplier_email" placeholder="Supplier Email" value="{{ old('supplier_email') }}">
                        @error('supplier_email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="wireHouse_address">Address</label>
                        <input class="form-control @error('wireHouse_address') is-invalid @enderror" type="text"
                            name="wireHouse_address" placeholder="Supplier Address" value="{{ old('wireHouse_address') }}">
                        @error('wireHouse_address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">
                        <i class="bx bxs-save font-size-16 align-middle me-1"></i> Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Supplier Create End Modal -->
@endsection
