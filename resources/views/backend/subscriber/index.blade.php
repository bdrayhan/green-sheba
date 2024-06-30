@extends('backend.layouts.layout')
@section('admin-title', 'Subscriber Managment')
@section('admin_content')
    @push('custom-style')
        <link href="{{ asset('backend') }}/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    @endpush

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4><b>All Support Message</b></h4>
                </div>
                <div class="card-body px-2">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th class="text-center">Id</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subscribers as $key => $row)
                                <tr>
                                    <td>
                                        {{ $key + 1 }}
                                    </td>
                                    <td>
                                        {{ $row->subscribe_email }}
                                    </td>
                                    <td>
                                        {{ Carbon\Carbon::parse($row->created_at)->format('d-m-Y') }}
                                    </td>
                                    <td class="text-center">
                                        <a id="delete" class="btn btn-sm btn-danger"
                                            href="{{ route('admin.subscriber.delete', $row->id) }}">
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
