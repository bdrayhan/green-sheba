@extends('backend.layouts.layout')
@section('admin-title', 'City Managment')
@section('admin_content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4><b>Trash City</b></h4>
                </div>
                <div class="card-body px-2">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Remarks</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cities as $row)
                                <tr>
                                    <td>{{ $row->city_name }}</td>
                                    <td>
                                        @if ($row->city_remarks)
                                            {{ $row->city_remarks }}
                                        @else
                                            <span class="text-danger">Remarks Not Available</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a title="Restore" class="btn btn-sm btn-primary"
                                            href="{{ route('admin.city.restore',$row->city_slug) }}">
                                            <i class="bx bx-shuffle"></i>
                                        </a>
                                        <a title="Permanent Delete" id="delete" class="btn btn-sm btn-danger"
                                            href="{{ route('admin.city.delete', $row->city_slug) }}">
                                            <i class="bx bxs-trash-alt"></i>
                                        </a>
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
