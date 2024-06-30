@extends('backend.layouts.layout')
@section('admin-title', 'Courier Zone Managment')
@section('admin_content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4><b>All Zone</b>
                        <button data-bs-toggle="modal" data-bs-target="#addZoneModal" class="btn btn-sm btn-primary"
                            style="float: right"><i class="bx bx-plus-medical"></i> Add New Zone</button>
                    </h4>
                </div>
                <div class="card-body px-2">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th>Courier Name</th>
                                <th>City Name</th>
                                <th>Zone Name</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($zones as $row)
                                <tr>
                                    <td>
                                        {{ $row->courier->courier_name }}
                                    </td>
                                    <td>
                                        {{ $row->city->city_name }}
                                    </td>
                                    <td>{{ $row->zone_name }}</td>
                                    <td class="text-center">
                                        @if ($row->zone_active == 1)
                                            <a href="{{ route('admin.courier.zone.deactive', $row->zone_slug) }}"
                                                class="btn btn-success waves-effect waves-light btn-sm">
                                                <i class="bx bx-like font-size-16 align-middle me-2"></i> Active
                                            </a>
                                        @else
                                            <a href="{{ route('admin.courier.zone.active', $row->zone_slug) }}"
                                                class="btn btn-danger waves-effect waves-light btn-sm">
                                                <i class="bx bx-dislike font-size-16 align-middle me-2"></i> Inactive
                                            </a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <button data-bs-toggle="modal" data-bs-target="#editZoneModal{{ $row->id }}"
                                            class="btn btn-sm btn-primary"><i class="bx bx-pencil"></i></button>
                                        <a id="delete" class="btn btn-sm btn-danger"
                                            href="{{ route('admin.courier.zone.soft.delete', $row->zone_slug) }}">
                                            <i class="bx bxs-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                                <!-- Courier Zone Edit Modal -->
                                <div class="modal fade" id="editZoneModal{{ $row->id }}" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" role="dialog"
                                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Zone Information</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('admin.courier.zone.update', $row->zone_slug) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-group mb-2">
                                                        <label class="form-label">Courier Name</label>
                                                        <select class="form-control courier" name="id">
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
                                                        <label for="">Courier City Name</label>
                                                        <select class="form-control" name="id" id="city">
                                                            <option value="{{ $row->id }}">{{ $row->city->city_name }}</option>
                                                        </select>
                                                        @error('id')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Zone Name</label>
                                                        <input class="form-control" type="text" name="zone_name"
                                                            placeholder="Enter Zone Name" value="{{ $row->zone_name }}">
                                                    </div>
                                                    <div class="form-group mb-5">
                                                        <label for="">Order By</label>
                                                        <input class="form-control" type="number" name="zone_sorting"
                                                            placeholder="Order By Id" value="{{ $row->zone_sorting }}">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="bx bx-save w-2"></i> Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Courier Zone Edit End Modal -->
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <!-- Courier Zone Create Modal -->
    <div class="modal fade" id="addZoneModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Courier Zone Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.courier.zone.insert') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label class="form-label">Courier Name</label>
                            <select class="form-control courier" name="id">
                                <option label="Select Your Courier"></option>
                                @foreach ($couriers as $courier)
                                    <option value="{{ $courier->id }}">{{ $courier->courier_name }}</option>
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
                            <select class="form-control city" name="id" id="city">
                                <option label="Select City"></option>
                            </select>
                            @error('id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Zone Name</label>
                            <input class="form-control" type="text" name="zone_name" placeholder="Enter Zone Name">
                        </div>
                        <div class="form-group mb-5">
                            <label for="">Order By</label>
                            <input class="form-control" type="number" name="zone_sorting" placeholder="Order By Id">
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
    <!-- Courier Zone Create End Modal -->
@endsection
