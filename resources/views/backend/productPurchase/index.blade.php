@extends('backend.layouts.layout')
@section('admin-title', 'Purchases Management')
@section('admin_content')
    @push('custom-style')
        <link href="{{ asset('backend') }}/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    @endpush

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border">
                    <h4>
                        <b>Purchases Product</b>
                        <a class="btn btn-sm btn-primary float-end " href="{{ route('admin.stock.create') }}"><i class="bx bx-plus me-2"></i> Purchase</a>
                    </h4>
                </div>
                <div class="px-2 card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr class="bg-opacity-25 bg-dark">
                                <th>Id</th>
                                <th>Date</th>
                                <th>Memo Number</th>
                                <th>Product Name</th>
                                <th class="text-center">Supplier Name</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($purchases as $key => $row)
                                <tr>
                                    <td width="5%">
                                        {{ $key + 1 }}
                                    </td>
                                    <td width="10%">
                                        {{ $row->pp_date }}
                                    </td>
                                    <td width="10%">
                                        {{ $row->pp_memo_no }}
                                    </td>
                                    <td>
                                        {{ $row->product->product_name }}
                                    </td>
                                    <td width="10%" class="text-center">
                                        {{ $row->supplier->supplier_name }}
                                    </td>
                                    <td width="10%" class="text-center">
                                        {{ $row->pp_quantity }}
                                    </td>
                                    <td width="10%" class="text-center">
                                        <a id="delete" href="{{ route('admin.stock.purchase.delete', $row->pp_slug) }}"
                                            class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
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
