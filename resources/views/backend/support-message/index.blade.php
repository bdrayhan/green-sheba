@extends('backend.layouts.layout')
@section('admin-title', 'Support Message Managment')
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
                                <th>Contact Name</th>
                                <th>Phone Number</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($supportMessage as $key => $row)
                                <tr class="{{ $row->support_seen === 1 ? 'bg-dark bg-opacity-10' : '' }}">
                                    <td>
                                        {{ $row->support_name }}
                                    </td>
                                    <td>
                                        {{ $row->support_phone }}
                                    </td>
                                    <td>
                                        {{ $row->support_email }}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.support.message.show', $row->support_slug) }}"
                                            class="btn btn-sm btn-primary"> <i class="fas fa-eye"></i></a>
                                        <a id="delete" class="btn btn-sm btn-danger"
                                            href="{{ route('admin.support.message.delete', $row->support_slug) }}">
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
