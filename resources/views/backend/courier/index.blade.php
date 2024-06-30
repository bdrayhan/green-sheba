@extends('backend.layouts.layout')
@section('admin-title', 'Courier Managment')
@section('admin_content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4><b>All Courier</b>
                        <button data-bs-toggle="modal" data-bs-target="#addCourierModal" class="btn btn-sm btn-primary"
                            style="float: right"><i class="bx bx-plus-medical"></i> Add New Courier</button>
                    </h4>
                </div>
                <div class="card-body px-2">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th>Courier Name</th>
                                <th>City Available</th>
                                <th>Zone Available</th>
                                <th>Courier Charge</th>
                                {{-- <th class="text-center">Status</th> --}}
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($couriers as $row)
                                <tr>
                                    <td>
                                        {{ $row->courier_name }}
                                    </td>
                                    <td>
                                        @if ($row->courier_city == 1)
                                            <span class="badge bg-success">Available</span>
                                        @else
                                            <span class="badge bg-danger">Unavailable</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($row->courier_zone == 1)
                                            <span class="badge bg-success">Available</span>
                                        @else
                                            <span class="badge bg-danger">Unavailable</span>
                                        @endif
                                    </td>
                                    <td>৳ {{ $row->courier_charge }}</td>
                                    <td class="text-center">
                                        @if ($row->courier_active == 1)
                                            <a href="{{ route('admin.courier.deactive', $row->courier_slug) }}"
                                                class="btn btn-success waves-effect waves-light btn-sm">
                                                <i class="bx bx-like font-size-16 align-middle me-2"></i> Active
                                            </a>
                                        @else
                                            <a href="{{ route('admin.courier.active', $row->courier_slug) }}"
                                                class="btn btn-danger waves-effect waves-light btn-sm">
                                                <i class="bx bx-dislike font-size-16 align-middle me-2"></i> Inactive
                                            </a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <button data-bs-toggle="modal" data-bs-target="#editCourierModal{{ $row->id }}"
                                            class="btn btn-sm btn-primary"><i class="bx bx-pencil"></i></button>
                                        <a id="delete" class="btn btn-sm btn-danger"
                                            href="{{ route('admin.courier.soft.delete', $row->courier_slug) }}">
                                            <i class="bx bxs-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                                <!-- Courier Edit Modal -->
                                <div class="modal fade" id="editCourierModal{{ $row->id }}" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" role="dialog"
                                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Courier Information</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('admin.courier.update', $row->courier_slug) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="old_name" value="{{ $row->courier_name }}">
                                                <div class="modal-body">
                                                    <div class="form-group mb-2">
                                                        <label class="form-label">Courier Name</label>
                                                        <input required type="text" name="courier_name"
                                                            class="form-control @error('courier_name') is-invalid @enderror"
                                                            placeholder="Enter Your Courier Name"
                                                            value="{{ $row->courier_name }}">
                                                        @error('courier_name')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label for="">Courier Charge</label>
                                                        <input required
                                                            class="form-control @error('courier_charge') is-invalid @enderror"
                                                            type="number" name="courier_charge"
                                                            placeholder="Enter Your Charge"
                                                            value="{{ $row->courier_charge }}">
                                                        @error('courier_charge')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mb-5">
                                                        <label for="">Order By</label>
                                                        <input class="form-control" type="number" name="courier_orderby"
                                                            placeholder="Order By Id" value="{{ $row->courier_orderby }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row text-center">
                                                            <div class="col-md-6">
                                                                <label class="form-label">Courier City</label>
                                                                <select class="form-control" name="courier_city"
                                                                    id="">
                                                                    <option value="1"
                                                                        {{ $row->courier_city == 1 ? 'selected' : '' }}>
                                                                        Available</option>
                                                                    <option value="0"
                                                                        {{ $row->courier_city == 0 ? 'selected' : '' }}>
                                                                        Unavailable</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Courier Zone</label>
                                                                <select class="form-control" name="courier_zone"
                                                                    id="">
                                                                    <option value="1"
                                                                        {{ $row->courier_zone == 1 ? 'selected' : '' }}>
                                                                        Available</option>
                                                                    <option value="0"
                                                                        {{ $row->courier_zone == 0 ? 'selected' : '' }}>
                                                                        Unavailable</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary"><i
                                                            class="bx bx-save"></i>
                                                        Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Courier Edit End Modal -->
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <!-- Courier Create Modal -->
    <div class="modal fade" id="addCourierModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Courier Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.courier.insert') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label class="form-label">Courier Name</label>
                            <input required type="text" name="courier_name"
                                class="form-control @error('courier_name') is-invalid @enderror"
                                placeholder="Enter Your Courier Name">
                            @error('courier_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Courier Charge</label>
                            <input required class="form-control @error('courier_charge') is-invalid @enderror"
                                type="number" name="courier_charge" placeholder="Enter Your Charge"
                                value="{{ old('courier_charge') }}">
                            @error('courier_charge')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-5">
                            <label for="">Order By</label>
                            <input class="form-control" type="number" name="courier_orderby" placeholder="Order By Id">
                        </div>
                        <div class="form-group">
                            <div class="row text-center">
                                <div class="col-md-6">
                                    <label class="form-label">Courier City</label>
                                    <select class="form-control" name="courier_city" id="">
                                        <option label="Select Status"></option>
                                        <option value="1">Available</option>
                                        <option value="0">Unavailable</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Courier Zone</label>
                                    <select class="form-control" name="courier_zone" id="">
                                        <option label="Select Status"></option>
                                        <option value="1">Available</option>
                                        <option value="0">Unavailable</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"><i class="bx bx-save w-2"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Courier Create End Modal -->
@endsection
{{--
@push('custom-script')
<script src="{{ asset('backend') }}/assets/libs/select2/js/select2.min.js"></script>
@endpush --}}
