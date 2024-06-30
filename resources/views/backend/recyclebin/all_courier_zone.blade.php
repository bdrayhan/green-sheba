@extends('backend.layouts.layout')
@section('admin-title', 'Courier Managment')
@section('admin_content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4><b>Trash Courier Zone</b></h4>
                </div>
                <div class="card-body px-2">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th>Courier Name</th>
                                <th>City Name</th>
                                <th>Zone Name</th>
                                <th>Remarks</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courierZone as $row)
                                <tr>
                                    <td>{{ $row->courier->courier_name }}</td>
                                    <td>{{ $row->city->city_name }}</td>
                                    <td>{{ $row->zone_name }}</td>
                                    <td>
                                        <span class="text-danger">Remarks Not Available</span>
                                    </td>
                                    <td class="text-center">
                                        <a title="Restore" class="btn btn-sm btn-primary"
                                            href="{{ route('admin.courier.zone.restore',$row->zone_slug) }}">
                                            <i class="bx bx-shuffle"></i>
                                        </a>
                                        {{-- <a title="Permanent Delete" id="delete" class="btn btn-sm btn-danger"
                                            href="{{ route('admin.courier.delete', $row->courier_slug) }}">
                                            <i class="bx bxs-trash-alt"></i>
                                        </a> --}}
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
