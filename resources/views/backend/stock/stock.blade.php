@extends('backend.layouts.layout')
@section('admin-title', 'Stock Managment')
@section('admin_content')
    @push('custom-style')
        <link href="{{ asset('backend') }}/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    @endpush

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4><b>Total {{ count($stocks) }} Product Stock</b></h4>
                </div>
                <div class="px-2 card-body">
                    <table id="datatable" class="table table-bordered dt-responsive w-100">
                        <thead>
                            <tr class="bg-opacity-25 bg-dark">
                                <th>Id</th>
                                <th>Product Name</th>
                                <th class="text-center">Purchase</th>
                                <th class="text-center">Stock</th>
{{--                                <th class="text-center">Action</th>--}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stocks as $key => $row)
                                <tr>
                                    <td width="5%">
                                        {{ $key + 1 }}
                                    </td>
                                    <td width="55%">
                                        {{ $row->product_name }}
                                    </td>
                                    <td width="10%" class="text-center">
                                        {{ $row->purchase->sum('pp_quantity') }}
                                    </td>
                                    <td width="10%" class="text-center">
                                        {{ $row->product_quantity }}
                                    </td>
{{--                                    <td width="20%" class="text-center">--}}
{{--                                        <a href="{{ route('admin.stock.create', $row->product_slug) }}"--}}
{{--                                            class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Stock--}}
{{--                                            Update</a>--}}
{{--                                    </td>--}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection
