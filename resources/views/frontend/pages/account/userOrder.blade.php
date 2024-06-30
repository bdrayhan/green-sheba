@extends('frontend.layouts.app')
@section('frontend-title', 'Home')
@section('web.content')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--start breadcrumb-->
            <section class="py-3 border-bottom border-top d-none d-md-flex bg-light">
                <div class="container">
                    <div class="page-breadcrumb d-flex align-items-center">
                        <h3 class="breadcrumb-title pe-3">My Orders</h3>
                        <div class="ms-auto">
                            <nav aria-label="breadcrumb">
                                <ol class="p-0 mb-0 breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('web.home') }}"><i
                                                class="bx bx-home-alt"></i>
                                            Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('web.user.account') }}">Account</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">My Orders</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </section>
            <!--end breadcrumb-->
            <!--start shop cart-->
            <section class="py-4">
                <div class="container">
                    <h3 class="d-none">Account</h3>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                @include('frontend.pages.account.profilebar')
                                <div class="col-lg-8">
                                    <div class="mb-0 shadow-none card">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th>Order</th>
                                                            <th>Date</th>
                                                            <th>Status</th>
                                                            <th>Total</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($userOrder as $order)
                                                            <tr>
                                                                <td>#{{ $order->invoice_no }}</td>
                                                                <td>{{ date('d-F-Y', strtotime($order->order_date)) }}</td>
                                                                <td>
                                                                    @if ($order->order_status == 0)
                                                                        <div class="badge rounded-pill bg-warning w-100">
                                                                            {{ $order->status($order->order_status) }}
                                                                        </div>
                                                                    @elseif ($order->order_status == 1)
                                                                        <div class="badge rounded-pill bg-warning w-100">
                                                                            {{ $order->status($order->order_status) }}
                                                                        </div>
                                                                    @elseif (
                                                                        $order->order_status == 2 ||
                                                                            $order->order_status == 4 ||
                                                                            $order->order_status == 5 ||
                                                                            $order->order_status == 6 ||
                                                                            $order->order_status == 7)
                                                                        <div class="badge rounded-pill bg-warning w-100">
                                                                            Processing
                                                                        </div>
                                                                    @elseif ($order->order_status == 3)
                                                                        <div class="badge rounded-pill bg-danger w-100">
                                                                            Failed
                                                                        </div>
                                                                    @elseif ($order->order_status == 8)
                                                                        <div class="badge rounded-pill bg-success w-100">
                                                                            {{ $order->status($order->order_status) }}
                                                                        </div>
                                                                    @elseif ($order->order_status == 9)
                                                                        <div class="badge rounded-pill bg-secondary w-100">
                                                                            {{ $order->status($order->order_status) }}
                                                                        </div>
                                                                    @else
                                                                        <div class="badge rounded-pill bg-dark w-100">
                                                                            Contact Support
                                                                        </div>
                                                                    @endif
                                                                </td>
                                                                <td>${{ $order->order_total }} for
                                                                    {{ count($order->orderDetails) }} item</td>
                                                                <td>
                                                                    @if ($order->order_status !== 3)
                                                                        <div class="gap-2 d-flex">
                                                                            @if (
                                                                                $order->order_status === 6 ||
                                                                                    $order->order_status === 8 ||
                                                                                    $order->order_status === 9 ||
                                                                                    $order->order_status === 10)
                                                                                <a href="{{ route('web.user.order.pdf', $order->order_slug) }}"
                                                                                    class="btn btn-dark btn-sm rounded-0">PDF</a>
                                                                            @endif
                                                                            @if (!($order->order_status === 8 || $order->order_status === 9 || $order->order_status === 10))
                                                                                <a id="delete"
                                                                                    href="{{ route('web.user.order.cancel', $order->order_slug) }}"
                                                                                    class="btn btn-dark btn-sm rounded-0">Cancel</a>
                                                                            @endif
                                                                        </div>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="5" class="text-center">
                                                                    <h3>No Order Found</h3>
                                                                </td>
                                                            </tr>
                                                        @endforelse
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end row-->
                        </div>
                    </div>
                </div>
            </section>
            <!--end shop cart-->
        </div>
    </div>
    <!--end page wrapper -->
@endsection
