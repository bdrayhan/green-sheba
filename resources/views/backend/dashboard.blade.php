@extends('backend.layouts.layout')
@section('admin-title', 'Dashboard')
@section('admin_content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Dashboard</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

        <div class="row">
            <div class="col-xl-12">
                <div class="row">
                    @role('Super Admin|Admin')
                        <div class="col-md-3">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium">Total Revenue</p>
                                            <h4 class="mb-0">00</h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                <span class="avatar-title">
                                                    <i class="bx bx-money font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endrole
                    @role('Super Admin|Admin|Manager')
                        <div class="col-md-3">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium">Total Orders</p>
                                            <h4 class="mb-0">{{ totalOrder() }}</h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                <span class="avatar-title">
                                                    <i class="bx bx-package font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium">Total Delivered</p>
                                            <h4 class="mb-0">{{ totalDelivered() }}</h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center ">
                                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="bx bx-archive-in font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endrole
                    @role('Super Admin|Admin')
                        <div class="col-md-3">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium">Total Users</p>
                                            <h4 class="mb-0">{{ totalUser() }}</h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="bx bx-user font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endrole
                </div>
                <!-- end row -->
            </div>
        </div>
    {{-- Today Order --}}
    @role('Super Admin|Admin|Manager')
        <div class="row">
            @role('Super Admin|Admin')
            <!-- Today Order -->
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Today Report</h4>
                        <div class="tab-content mt-4">
                            <div class="tab-pane active" id="transactions-all-tab" role="tabpanel">
                                <div class="table-responsive" data-simplebar="init" style="max-height: 500px;">
                                    <div class="simplebar-wrapper" style="margin: 0px;">
                                        <div class="simplebar-height-auto-observer-wrapper">
                                            <div class="simplebar-height-auto-observer"></div>
                                        </div>
                                        <div class="simplebar-mask">
                                            <div class="simplebar-offset" style="right: -17px; bottom: 0px;">
                                                <div class="simplebar-content-wrapper"
                                                    style="height: auto; overflow: hidden scroll;">
                                                    <div class="simplebar-content" style="padding: 0px;">
                                                        <table class="table align-middle table-nowrap">
                                                            <tbody>
                                                                @foreach (todayStatusOrder() as $status)
                                                                    @php
                                                                            $order = App\Models\Order::where('order_status', $status->id)->whereDate('created_at', Carbon\Carbon::today())->count();
                                                                    @endphp
                                                                    <tr>
                                                                        <td style="width: 50px;">
                                                                            <div class="font-size-22 text-dark">
                                                                                <i class="bx bx-shopping-bag"></i>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div>
                                                                                <h5 class="font-size-14 mb-1">{{ $status->os_name }}</h5>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="text-end">
                                                                                <h5 class="font-size-14 text-muted mb-0">
                                                                                    {{ $order }}
                                                                                </h5>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="simplebar-placeholder" style="width: auto; height: 473px;"></div>
                                    </div>
                                    <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                        <div class="simplebar-scrollbar"
                                            style="transform: translate3d(0px, 0px, 0px); display: none;"></div>
                                    </div>
                                    <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                        <div class="simplebar-scrollbar"
                                            style="height: 230px; transform: translate3d(0px, 0px, 0px); display: block;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endrole
            @role('Super Admin|Admin|Manager')
            <!-- Month Order -->
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Month Report</h4>
                        <div class="tab-content mt-4">
                            <div class="tab-pane active" id="transactions-all-tab" role="tabpanel">
                                <div class="table-responsive" data-simplebar="init" style="max-height: 500px;">
                                    <div class="simplebar-wrapper" style="margin: 0px;">
                                        <div class="simplebar-height-auto-observer-wrapper">
                                            <div class="simplebar-height-auto-observer"></div>
                                        </div>
                                        <div class="simplebar-mask">
                                            <div class="simplebar-offset" style="right: -17px; bottom: 0px;">
                                                <div class="simplebar-content-wrapper"
                                                    style="height: auto; overflow: hidden scroll;">
                                                    <div class="simplebar-content" style="padding: 0px;">
                                                        <table class="table align-middle table-nowrap">
                                                            <tbody>
                                                                @foreach (todayStatusOrder() as $status)
                                                                    @php
                                                                            $order = App\Models\Order::where('order_status', $status->id)->whereMonth('created_at', Carbon\Carbon::now()->month)->count();
                                                                    @endphp
                                                                    <tr>
                                                                        <td style="width: 50px;">
                                                                            <div class="font-size-22 text-dark">
                                                                                <i class="bx bx-shopping-bag"></i>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div>
                                                                                <h5 class="font-size-14 mb-1">{{ $status->os_name }}</h5>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="text-end">
                                                                                <h5 class="font-size-14 text-muted mb-0">
                                                                                    {{ $order }}
                                                                                </h5>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="simplebar-placeholder" style="width: auto; height: 473px;"></div>
                                    </div>
                                    <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                        <div class="simplebar-scrollbar"
                                            style="transform: translate3d(0px, 0px, 0px); display: none;"></div>
                                    </div>
                                    <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                        <div class="simplebar-scrollbar"
                                            style="height: 230px; transform: translate3d(0px, 0px, 0px); display: block;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- StoOut Product -->
            @endrole
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Stock Out Product</h4>
                        <div class="tab-content mt-4">
                            <div class="tab-pane active" id="transactions-all-tab" role="tabpanel">
                                <div class="table-responsive" data-simplebar="init" style="max-height: 500px;">
                                    <div class="simplebar-wrapper" style="margin: 0px;">
                                        <div class="simplebar-height-auto-observer-wrapper">
                                            <div class="simplebar-height-auto-observer"></div>
                                        </div>
                                        <div class="simplebar-mask">
                                            <div class="simplebar-offset" style="right: -17px; bottom: 0px;">
                                                <div class="simplebar-content-wrapper"
                                                    style="height: auto; overflow: hidden scroll;">
                                                    <div class="simplebar-content" style="padding: 0px;">
                                                        <table class="table align-middle table-nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <td>
                                                                        <div>
                                                                            <h5 class="font-size-14 mb-1"><b>Product Name</b>
                                                                            </h5>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="text-end">
                                                                            <h5 class="font-size-14 mb-1">
                                                                                <b>Code</b>
                                                                            </h5>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @forelse (stockOutProduct() as $product)
                                                                    <tr>
                                                                        <td>
                                                                            <div>
                                                                                <h5 class="font-size-14 mb-1"> {{ $product->product_name }} </h5>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="text-end">
                                                                                <h5 class="font-size-14 text-muted mb-0"> {{ $product->product_code }}</h5>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @empty
                                                                    <tr class="text-center">
                                                                        <td>
                                                                            <div>
                                                                                <h5 class="font-size-14 mb-1">
                                                                                    No data available in table </h5>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endforelse
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="simplebar-placeholder" style="width: auto; height: 473px;"></div>
                                    </div>
                                    <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                        <div class="simplebar-scrollbar"
                                            style="transform: translate3d(0px, 0px, 0px); display: none;"></div>
                                    </div>
                                    <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                        <div class="simplebar-scrollbar"
                                            style="height: 230px; transform: translate3d(0px, 0px, 0px); display: block;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endrole
    <!-- end row -->
@endsection
