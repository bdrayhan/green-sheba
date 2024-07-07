<div class="tab-pane fade" id="order" role="tabpanel">
    <form action="#">
        {{-- <div class="customer_profile">
            <div class="row profile_details">
                <div class="col-md-12">
                    <div class="table-responsive-sm">
                        <table  id="alltableinfo"
                        class="table table-bordered table-striped table-hover dt-responsive nowrap custom_table">
                        <thead class="table-secondary">
                            <tr>
                                <th>Order ID</th>
                                <th>Order Date</th>
                                <th>Total Amount</th>
                                <th>Order Status</th>
                                <th>Payment Status</th>
                                <th>Purchased Date</th>
                                <th>Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td>sfgf</td>
                                    <td>dfg</td>
                                    <td>dfgdf</td>
                                    <td>gfdg</td>
                                    <td>dghd</td>
                                    <td>dgye</td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn-sm btn customer_order_table_btn" type="button">Manage</button>
                                            <button type="button"
                                                class="btn btn-sm btn-secondary dropdown-toggle dropdown-toggle-split waves-effect btn-label waves-light card_btn"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="mdi mdi-chevron-down"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="#">View</a>
                                                <a class="dropdown-item"
                                                    href="#">Edit</a>
                                                <a class="dropdown-item" href="#" id="softDelete" title="delete"
                                                    data-bs-toggle="modal" data-bs-target="#softDelModal"
                                                    data-id="#">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>tdgfd</td>
                                    <td>tdgfd</td>
                                    <td>tdgfd</td>
                                    <td>tdgfd</td>
                                    <td>tdgfd</td>
                                    <td>tdgfd</td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn-sm btn customer_order_table_btn" type="button">Manage</button>
                                            <button type="button"
                                                class="btn btn-sm btn-secondary dropdown-toggle order_table_border dropdown-toggle-split waves-effect btn-label waves-light card_btn"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="mdi mdi-chevron-down"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="#">View</a>
                                                <a class="dropdown-item"
                                                    href="#">Edit</a>
                                                <a class="dropdown-item" href="#" id="softDelete" title="delete"
                                                    data-bs-toggle="modal" data-bs-target="#softDelModal"
                                                    data-id="#">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div> --}}
        {{-- <div class="col-lg-8">
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
        </div> --}}
    </form>
</div>