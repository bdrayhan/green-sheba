@php
    $setting = App\Models\BasicSetting::firstOrFail();
    $contact = App\Models\ContactInfo::firstOrFail();
@endphp
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- Custom Style -->
    <link rel="stylesheet" href="{{ asset('invoice') }}/style.css">

    <title>Order Invoice</title>
</head>

<body>
<div class="my-5 page" size="A4">
    <div class="p-4">
        <section class="store-user">
            <div class="col-12">
                <div class="row bb pb-2">
                    <div class="col-4 border py-2">
                        <div class="logo">
                            <img style="height: 40px;"
                                 src="{{ asset($setting->basic_logo) }}" alt="" class="img-fluid mb-1">
                        </div>
                        <p><b>Help Line: </b> <span>{{ $contact->ci_phone1 }}</span></p>
                        <p><b>Office:</b> {{ $contact->ci_address1 }} <br> Dhaka, Bangladesh</p>
                    </div>
                    <div class="col-4 border py-2">
                        <h4 class="text-uppercase">Customer Info</h4>
                        <p><b>Name:</b> <span>{{ $order->shipping->shipping_name }}</span></p>
                        <p><b>Mobile:</b> <span> {{ $order->shipping->shipping_phone }}</span></p>
                        <p><b>Address: </b> {{ $order->shipping->shipping_address }}, <br> Dhaka, Bangladesh</p>
                        </p>
                    </div>
                    <div class="col-4 border py-2">
                        <div class="top-left">
                            <h4 class="text-uppercase">Order Details</h4>
                            <div class="position-relative">
                                <p><b>Invoice No: </b> <span>{{ $order->invoice_no }}</span></p>
                                <p><b>Order Date:</b> <span>{{ date('d-m-Y', strtotime($order->order_date)) }}</span></p>
                                <p><b>Payment Method:</b> <span>{{ Str::of($order->payment_type)->replace($order->payment_type, 'COD') }}</span></p>
                                <p><b>Courier: </b> <span>{{ $order->courier->courier_name ?? 'Not Assign' }}</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
            $data = array($order->orderDetails);
        ?>
        <section class="product-area border">
            <table class="table">
                <thead>
                <tr>
                    <td>Products</td>
                    <td>Size</td>
                    <td>Color</td>
                    <td>SKU</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Total</td>
                </tr>
                </thead>
                <tbody>
                @forelse ($order->orderDetails as $detail)
                    <tr>
                        <td>
                            <div class="media">
                                <div class="media-body">
                                    <p class="mt-0 title">{{ $detail->product_name }}</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            @if(!empty($detail->size->size_name))
                                {{ $detail->size->size_name }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            @if(!empty($detail->color->color_name))
                                {{ $detail->color->color_name }}</td>
                            @else
                                N/A
                            @endif
                        <td>{{ $detail->product_code }}</td>
                        <td>{{ number_format(productUnitPrice($detail->product_id)) }} tk</td>
                        <td>{{ $detail->product_quantity }}</td>
                        <td>{{ number_format(productSubtotal($detail->product_id, $detail->product_quantity)) }} tk</td>
                    </tr>
                @empty
                @endforelse
                </tbody>
            </table>
        </section>

        <section class="balance-info">
            <div class="row d-flex justify-content-between">
                <div class="col-7 pl-0">
                    <p class="border py-2 pl-2 font-weight-bold text-secondary">NOTE : <span class="text-dark">{{ $order->store_notes }}</span></p>
                    <p class="my-2"><b>Order Received By:</b> <span>{{ $order->assign->name }}</span></p>
                    <p>Authority Invoice &copy; {{ $setting->basic_title }} | <a target="_blank" href="https://{{ $setting->basic_url }}">{{ $setting->basic_url }}</a></p>
                </div>

                <div class="col-4 border">
                    <table class="table">
                        <tr>
                            <td>Total Amount:</td>
                            <td>{{ number_format(orderSubtotal($order->id)) }} tk</td>
                        </tr>

                        <tr>
                            <td>Delivery Charge:</td>
                            <td>{{ number_format($order->shipping_charge) }} tk</td>
                        </tr>
                        <tr>
                            <td>Advance:</td>
                            <td>{{ number_format(orderPayAmount($order->id)) }} tk</td>
                        </tr>
                        <tfoot class="text-dark">
                        <tr>
                            <td>Due Amount:</td>
                            <td>{{ number_format(totalOrderDue($order->id)) }} tk</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </section>

        <div class="row text-center printbutton my-4">
            <div class="col-12">
                <button class="btn btn-outline-primary btn-md" onclick="window.print()">
                    <i class="fas fa-print"></i> Print Invoice
                </button>
            </div>
        </div>

    </div>


</div>
</body>

</html>
