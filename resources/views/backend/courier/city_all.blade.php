@extends('backend.layouts.layout')
@section('admin-title', 'Courier City Managment')
@section('admin_content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4><b>All Courier City</b>
                        <button data-bs-toggle="modal" data-bs-target="#addCityModal" class="btn btn-sm btn-primary"
                            style="float: right"><i class="bx bx-plus-medical"></i> Add Courier City</button>
                    </h4>
                </div>
                <div class="card-body px-2">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th>Courier Name</th>
                                <th>City Name</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courierCity as $row)
                                <tr>
                                    <td>{{ $row->courier->courier_name }}</td>
                                    <td>{{ $row->city->city_name }}</td>
                                    <td class="text-center">
                                        @if ($row->cc_active == 1)
                                            <a href="{{ route('admin.courier.city.deactive', $row->cc_slug) }}"
                                                class="btn btn-success waves-effect waves-light btn-sm">
                                                <i class="bx bx-like font-size-16 align-middle me-2"></i> Active
                                            </a>
                                        @else
                                            <a href="{{ route('admin.courier.city.active', $row->cc_slug) }}"
                                                class="btn btn-danger waves-effect waves-light btn-sm">
                                                <i class="bx bx-dislike font-size-16 align-middle me-2"></i> Inactive
                                            </a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <button data-bs-toggle="modal" data-bs-target="#editCityModal{{ $row->id }}"
                                            class="btn btn-sm btn-primary"><i class="bx bx-pencil"></i></button>
                                        <a id="delete" class="btn btn-sm btn-danger"
                                            href="{{ route('admin.courier.city.soft.delete', $row->cc_slug) }}">
                                            <i class="bx bxs-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                                <!-- Courier City Edit Modal -->
                                <div class="modal fade" id="editCityModal{{ $row->id }}" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" role="dialog"
                                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">City Information</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('admin.courier.city.update', $row->cc_slug) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-group mb-2">
                                                        <label class="form-label">Courier Name</label>
                                                        <select class="form-control" name="id" id="">
                                                            <option label="Select Your Courier"></option>
                                                            @foreach ($couriers as $courier)
                                                                <option value="{{ $courier->id }}"
                                                                    {{ $courier->id == $row->id ? 'selected' : '' }}>
                                                                    {{ $courier->courier_name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('id')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label for="">City Name</label>
                                                        <select class="form-control" name="id" id="">
                                                            <option label="Select Your Courier City"></option>
                                                            @foreach ($cities as $city)
                                                                <option {{ $row->id == $city->id ? 'selected' : '' }}  value="{{ $city->id }}">{{ $city->city_name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('id')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mb-5">
                                                        <label for="">Order By</label>
                                                        <input class="form-control" type="number" name="cc_orderby"
                                                            placeholder="Order By Id" value="{{ $row->cc_orderby }}">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary"><i
                                                            class="bx bx-save w-2"></i>
                                                        Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Courier City Edit End Modal -->
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <!-- Courier City Create Modal -->
    <div class="modal fade" id="addCityModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Courier City Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.courier.city.insert') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label class="form-label">Courier Name</label>
                            <select class="form-control" name="id">
                                <option label="Select Your Courier"></option>
                                @foreach ($couriers as $courier)
                                    <option value="{{ $courier->id }}">{{ $courier->courier_name }}</option>
                                @endforeach
                            </select>
                            @error('courier_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="">City Name</label>
                            <select class="form-control" name="id" id="">
                                <option label="Select Your Courier City"></option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->city_name }}</option>
                                @endforeach
                            </select>
                            @error('id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-5">
                            <label for="">Order By</label>
                            <input class="form-control" type="number" name="cc_orderby" placeholder="Order By Id">
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
    <!-- Courier City Create End Modal -->
@endsection
