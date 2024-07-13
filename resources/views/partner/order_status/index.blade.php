@extends('backend.layouts.layout')
@section('admin-title', 'Order Status Managment')
@section('admin_content')
    <div class="row d-flex justify-content-center">
        <div class="col-10 col-md-10 col-sm-10">
            <div class="card">
                <div class="card-header">
                    <h4><b>Total {{ count($orderStatuses) }} Order Status</b></h4>
                </div>
                <div class="card-body px-2">
                    <table id="datatable" class="table table-bordered dt-responsive wrap w-100 table-check">
                        <thead>
                            <tr>
                                <th style="width: 20px;">
                                    <div class="form-check font-size-16 align-middle">
                                        <input class="form-check-input" type="checkbox" id="checkAll">
                                        <label class="form-check-label" for="checkAll"></label>
                                    </div>
                                </th>
                                <th>SN</th>
                                <th>Name</th>
                                {{-- <th class="text-center">Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderStatuses as $key => $row)
                                <tr>
                                    <td>
                                        <div class="form-check font-size-16">
                                            <input name="ids[]" class="form-check-input" value="{{ $row->id }}"
                                                type="checkbox">
                                            <label class="form-check-label" for="transactionCheck02"></label>
                                        </div>
                                    </td>
                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->os_name }}</td>

                                    {{-- <td class="text-center">
                                        <button data-bs-toggle="modal"
                                            data-bs-target="#editStatusModal{{ $row->os_slug }}"
                                            class="btn btn-sm btn-primary"> <i class="bx bxs-pencil"></i></button>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection
