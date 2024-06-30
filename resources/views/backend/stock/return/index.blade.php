@extends('backend.layouts.layout')
@section('admin-title', 'Order Return')
@section('admin_content')
    @push('custom-style')
        <link href="{{ asset('backend') }}/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{ asset('backend') }}/assets/libs/%40chenfengyuan/datepicker/datepicker.min.css">
        <link href="{{ asset('backend') }}/assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet"
            type="text/css">
    @endpush
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body border-bottom">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 card-title flex-grow-1">Return Order List</h5>
                    </div>
                </div>
                <div class="card-body border-bottom">
                    <div class="row g-3">
                        <div class="col-xxl-2 col-lg-4">
                        </div>
                        <div class="col-xxl-10 col-lg-8 d-flex justify-content-end">
                            <a href="{{ route('admin.stock.order.return.create') }}" class="btn btn-dark waves-effect btn-label waves-light" style="float: right">
                                <i class="bx bx-repeat label-icon"></i>Create</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered dt-responsive rap w-100 table-check">
                            <thead>
                                <tr>

                                    <th>
                                        <div class="form-check font-size-16">
                                            <input class="form-check-input" type="checkbox" id="checkAll">
                                            <label class="form-check-label" for="checkAll">Invoice Id</label>
                                        </div>
                                    </th>
                                    <th>Customer Info</th>
                                    <th>Total</th>
                                    <th>Courier</th>
                                    <th>Order Date</th>
                                    <th>Delivery Date</th>
                                    <th>Reasone</th>
                                    <th>Order Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @forelse ($returnOrders as $order)
                                    <form action="#" id="assingUserSubmit" method="POST">
                                        @csrf
                                        <tr>
                                            <td class="text-center" width="5%">
                                                <div class="form-check font-size-16">
                                                    <input name="ids[]" class="form-check-input" type="checkbox"
                                                        value="{{ $order->id }}">
                                                    <label class="form-check-label"> {{ $order->invoice_no }}</label>
                                                </div>
                                            </td>
                                            <td width="15%">
                                                Name: {{ $order->shipping->shipping_name }} <br>
                                                Phone: {{ $order->shipping->shipping_phone }} <br>
                                                Address: {{ $order->shipping->shipping_address }}
                                            </td>
                                            <td class="text-center" width="5%">৳ {{ $order->order_total }}</td>
                                            <td width="10%">
                                                @if (!empty($order->id))
                                                    <span
                                                        class="badge badge-pill badge-soft-success font-size-12">{{ $order->courier->courier_name }}</span>
                                                @else
                                                    <span class="badge badge-pill badge-soft-warning font-size-12">Not
                                                        Assing</span>
                                                @endif
                                            </td>
                                            <td width="10%">{{ date('d-F-Y', strtotime($order->order_date)) }}</td>
                                            <td width="10%">{{ date('d-F-Y', strtotime($order->delivery_date)) }}</td>
                                            <td width="10%" class="text-danger">{{ $order->order_comment }}</td>
                                            <td width="5%" class="text-center">
                                                @if ($order->order_status == 9)
                                                    <span class="badge badge-pill badge-soft-success font-size-15">
                                                        {{ $order->status($order->order_status) }}
                                                    </span>
                                                @else
                                                    <span class="badge badge-pill badge-soft-danger font-size-12">
                                                        Unknown
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    </form>
                                @empty
                                @endforelse --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--end card-->
        </div>
        <!--end col-->
    </div>
@endsection
{{-- @push('backend-scripts')
    <script src="{{ asset('backend') }}/assets/libs/%40chenfengyuan/datepicker/datepicker.min.js"></script>
    <script src="{{ asset('backend') }}/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
@endpush --}}
