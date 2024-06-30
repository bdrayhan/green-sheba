@extends('backend.layouts.layout')
@section('admin-title', 'User Report')
@section('admin_content')
    @php
        $allUsers = App\Models\User::all();
    @endphp
    <div class="row d-flex justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <form action="{{ route('admin.user.report.date') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-daterange input-group" id="datepicker6" data-date-format="dd-mm-yyyy"
                                    data-date-autoclose="true" data-provide="datepicker" data-date-container="#datepicker6">
                                    <input type="text" class="form-control" name="startDate" placeholder="Start Date"
                                        value="{{ $startDate ? $startDate : '' }}">
                                    <input type="text" class="form-control" name="endDate" placeholder="End Date"
                                        value="{{ $endDate ? $endDate : '' }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <select class="form-control" name="user_id">
                                    <option label="Select User"></option>
                                    @foreach ($allUsers as $user)
                                        <option value="{{ $user->id }}"
                                            {{ $user->id == $users[0]->id ? 'selected' : '' }}>
                                            {{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body px-2">
                    <table id="datatable" class="table table-bordered dt-responsive wrap w-100">
                        <thead>
                            <tr>
                                <th width="15%">Date</th>
                                <th width="15%">User</th>
                                <th width="5%">Total</th>
                                <th width="5%">Pending</th>
                                <th width="5%">Processing</th>
                                <th width="5%">Holding</th>
                                <th width="5%">Complect</th>
                                <th width="5%">Canceled</th>
                                <th width="5%">Invoiced</th>
                                <th width="5%">Stock Out</th>
                                <th width="5%">Return</th>
                                <th width="5%">Lost</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                @php
                                    $totalOrders = App\Models\Order::where('assign_id', $user->id)
                                        ->whereBetween('order_date', [$startDate, $endDate])
                                        ->count();
                                    $pendingOrders = App\Models\Order::where('assign_id', $user->id)
                                        ->where('order_status', 0)
                                        ->whereBetween('order_date', [$startDate, $endDate])
                                        ->count();
                                    $processingOrders = App\Models\Order::where('assign_id', $user->id)
                                        ->where('order_status', 1)
                                        ->whereBetween('order_date', [$startDate, $endDate])
                                        ->count();
                                    $holdingOrders = App\Models\Order::where('assign_id', $user->id)
                                        ->where('order_status', 2)
                                        ->whereBetween('order_date', [$startDate, $endDate])
                                        ->count();
                                    $canceledOrder = App\Models\Order::where('assign_id', $user->id)
                                        ->where('order_status', 3)
                                        ->whereBetween('order_date', [$startDate, $endDate])
                                        ->count();
                                    $complectOrders = App\Models\Order::where('assign_id', $user->id)
                                        ->where('order_status', 4)
                                        ->whereBetween('order_date', [$startDate, $endDate])
                                        ->count();

                                    $invoiceOrders = App\Models\Order::where('assign_id', $user->id)
                                        ->where('order_status', 6)
                                        ->whereBetween('order_date', [$startDate, $endDate])
                                        ->count();
                                    $stockOutOrders = App\Models\Order::where('assign_id', $user->id)
                                        ->where('order_status', 7)
                                        ->whereBetween('order_date', [$startDate, $endDate])
                                        ->count();
                                    $returnOrders = App\Models\Order::where('assign_id', $user->id)
                                        ->where('order_status', 9)
                                        ->whereBetween('order_date', [$startDate, $endDate])
                                        ->count();
                                    $lostOrders = App\Models\Order::where('assign_id', $user->id)
                                        ->where('order_status', 10)
                                        ->whereBetween('order_date', [$startDate, $endDate])
                                        ->count();
                                @endphp
                                <tr>
                                    <td>
                                        @if (!empty($today))
                                            {{ $today }}
                                        @else
                                            {{ $startDate }} to {{ $endDate }}
                                        @endif
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td class="text-center">{{ $totalOrders }}</td>
                                    <td class="text-center">{{ $pendingOrders }}</td>
                                    <td class="text-center">{{ $processingOrders }}</td>
                                    <td class="text-center">{{ $holdingOrders }}</td>
                                    <td class="text-center">{{ $complectOrders }}</td>
                                    <td class="text-center">{{ $canceledOrder }}</td>
                                    <td class="text-center">{{ $invoiceOrders }}</td>
                                    <td class="text-center">{{ $stockOutOrders }}</td>
                                    <td class="text-center">{{ $returnOrders }}</td>
                                    <td class="text-center">{{ $lostOrders }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection
@push('backend-style')
    <link href="{{ asset('backend') }}/assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('backend') }}/assets/libs/spectrum-colorpicker2/spectrum.min.css" rel="stylesheet"
        type="text/css">
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/libs/%40chenfengyuan/datepicker/datepicker.min.css">
@endpush

@push('backend-scripts')
    <script src="{{ asset('backend') }}/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('backend') }}/assets/libs/%40chenfengyuan/datepicker/datepicker.min.js"></script>
    <!-- form advanced init -->
    <script src="assets/js/pages/form-advanced.init.js"></script>
@endpush
