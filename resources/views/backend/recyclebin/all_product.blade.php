@extends('backend.layouts.layout')
@section('admin-title', 'Product Managment')
@section('admin_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4><b>Total {{ count($products) }} Product</b>
                        <a href="{{ route('admin.product.create') }}" class="btn btn-sm btn-primary" style="float: right"><i
                                class="bx bx-plus-medical"></i> Add New</a>
                    </h4>
                </div>
                <div class="card-body px-2">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th style="overflow: auto; max-width: 420px;">Name</th>
                                <th style="overflow: auto; max-width: 200px;">Info</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th width="150px" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $key => $row)
                                <tr>
                                    <td>
                                        <a href="#" target="_blank" class="text-reset d-block">
                                            <div class="d-flex align-items-center">
                                                @if (File::exists($row->product_thumbnail))
                                                    <img src="{{ asset($row->product_thumbnail) }}" alt="Image"
                                                        class="rounded" width="70px">
                                                @else
                                                    <img class="rounded" width="70px"
                                                        src="{{ asset('backend/assets/images/default_image.png') }}"
                                                        alt="">
                                                @endif
                                                <span class="flex-grow-1 minw-0" style="margin-left: 5px">
                                                    <div class=" text-truncate-2 fs-12">
                                                        {{ $row->product_name }}
                                                    </div>
                                                </span>
                                            </div>
                                        </a>
                                    </td>
                                    <td>
                                        Delivery: <b> {{ $row->delivery_location }}</b> <br>
                                        Qty: <b>{{ $row->product_quantity }}</b> <br>
                                        Min-Qty: <b>{{ $row->min_quantity }}</b> <br>
                                        Price: <b>${{ $row->product_regular_price }}</b> /
                                        <b>${{ $row->product_discount_price }}</b>
                                    </td>
                                    <td><span class="badge bg-primary">{{ optional($row->category)->pc_name }}</span></td>
                                    <td>
                                        @if (File::exists(optional($row->brand)->brand_image))
                                            <img src="{{ asset(optional($row->brand)->brand_image) }}" alt="Image"
                                                class="rounded" width="70px">
                                        @else
                                            {{ optional($row->brand)->brand_name }}
                                        @endif
                                    </td>
                                    <td class="text-center" width="150px">
                                        <a title="Restore" class="btn btn-sm btn-primary"
                                            href="{{ route('admin.product.restore', $row->product_slug) }}">
                                            <i class="bx bx-shuffle"></i>
                                        </a>
                                        <a title="Permanent Delete" id="delete" class="btn btn-sm btn-danger"
                                            href="{{ route('admin.product.delete', $row->product_slug) }}">
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
