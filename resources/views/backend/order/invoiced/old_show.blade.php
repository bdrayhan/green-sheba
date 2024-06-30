@php
    $setting = App\Models\BasicSetting::firstOrFail();
    $contact = App\Models\ContactInfo::firstOrFail();
@endphp
<!DOCTYPE html>
<html class="no-js" lang="en">


<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="ThemeMarch">
    <!-- Site Title -->
    <title>Invoice</title>
    <!-- Icons Css -->
    <link href="{{ asset('backend') }}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('invoice') }}/assets/css/style.css">
</head>

<body>
    <div class="cs-container">
        <div class="cs-invoice cs-style1">
            <div class="cs-invoice_in" id="download_section">
                <div class="cs-invoice_head cs-type1 cs-mb25">
                    <div class="cs-invoice_left">
                        <div class="cs-logo cs-mb5">
                            <img style="width: 100px;" src="{{ asset($setting->basic_logo) }}" alt="Logo">
                        </div>
                        <p class="cs-invoice_date cs-primary_color cs-m0"><b class="cs-primary_color">
                            </b>{{ $contact->ci_phone1 }}</p>
                        <p class="cs-invoice_date cs-primary_color cs-m0"><b class="cs-primary_color">
                            </b>{{ $contact->ci_email1 }}</p>
                        <p class="cs-invoice_date cs-primary_color cs-m0"><b class="cs-primary_color">
                            </b>{{ $contact->ci_address1 }}</p>
                    </div>
                    <div class="cs-invoice_right cs-text_right">
                        <div class="cs-logo cs-mb5">
                            <h4 style="margin-bottom: 0px;">INVOICE</h4>
                        </div>
                        <p class="cs-invoice_number cs-primary_color cs-mb5 cs-f16"><b class="cs-primary_color">Invoice
                                No:</b> #{{ $order->invoice_no }}</p>
                        <p class="cs-invoice_date cs-primary_color cs-m0">
                            <b class="cs-primary_color">Order Date:</b>
                            {{ date('d-m-Y', strtotime($order->order_date)) }}
                        </p>
                        <p class="cs-invoice_date cs-primary_color cs-m0">
                            <b class="cs-primary_color">Payment Methord:</b>
                            {{ $order->payment_type === 'cash_on_delivery' ? 'Cash On Delivery' : '' }}
                        </p>
                    </div>
                </div>
                <div class="cs-invoice_head cs-mb10">
                    <div class="cs-invoice_left">
                        <b class="cs-primary_color">Invoice To:</b>
                        <p>
                            {{ $order->shipping->shipping_name }} <br>
                            {{ $order->shipping->shipping_phone }} <br>
                            {{ $order->shipping->shipping_address . ' , ' . Str::ucfirst($order->shipping->shipping_country) }}
                            <br>
                        </p>
                    </div>
                </div>
                <div class="cs-table cs-style1">
                    <div class="cs-round_border">
                        <div class="cs-table_responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="cs-width_3 cs-semi_bold cs-primary_color cs-focus_bg">Item</th>
                                        <th class="cs-width_3 cs-semi_bold cs-primary_color cs-focus_bg">SKU</th>
                                        <th class="cs-width_1 cs-semi_bold cs-primary_color cs-focus_bg">Qty</th>
                                        <th class="cs-width_1 cs-semi_bold cs-primary_color cs-focus_bg">Price</th>
                                        <th class="cs-width_2 cs-semi_bold cs-primary_color cs-focus_bg cs-text_right">
                                            Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($order->orderDetails as $detail)
                                        <tr>
                                            <td class="cs-width_3">{{ $detail->product_name }}</td>
                                            <td class="cs-width_3">{{ $detail->product_code }}</td>
                                            <td class="cs-width_1">{{ $detail->product_quantity }}</td>
                                            <td class="cs-width_1">৳{{ number_format(productUnitPrice($detail->product_id)) }}</td>
                                            <td class="cs-width_2 cs-text_right">৳ {{ number_format(productSubtotal($detail->product_id, $detail->product_quantity)) }}</td>
                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="cs-invoice_footer cs-border_top">
                            <div class="cs-left_footer cs-mobile_hide">
                                <p class="cs-mb0"><b class="cs-primary_color">Additional Information:</b></p>
                                <p class="cs-m0">{{ appSetting()['basic_setting']->invoice_additional }}</p>
                                                            {{ appSetting()['basic_setting']->invoice_note }}
                            </div>
                            <div class="cs-right_footer">
                                <table>
                                    <tbody>
                                        <tr class="cs-border_left">
                                            <td class="cs-width_3 cs-semi_bold cs-primary_color cs-focus_bg">Sub Total
                                            </td>
                                            <td
                                                class="cs-width_3 cs-semi_bold cs-focus_bg cs-primary_color cs-text_right">
                                                ৳{{ orderSubtotal($order->id) }}</td>
                                        </tr>
                                        <tr class="cs-border_left">
                                            <td class="cs-width_3 cs-semi_bold cs-primary_color cs-focus_bg">Shipping
                                                Cost</td>
                                            <td
                                                class="cs-width_3 cs-semi_bold cs-focus_bg cs-primary_color cs-text_right">
                                                ৳{{ $order->shipping_charge }}</td>
                                        </tr>
                                        <tr class="cs-border_left">
                                            <td class="cs-width_3 cs-semi_bold cs-primary_color cs-focus_bg">Paid
                                                Amount</td>
                                            <td
                                                class="cs-width_3 cs-semi_bold cs-focus_bg cs-primary_color cs-text_right">
                                                ৳{{ number_format(orderPayAmount($order->id)) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="cs-invoice_footer">
                        <div class="cs-left_footer cs-mobile_hide"></div>
                        <div class="cs-right_footer">
                            <table>
                                <tbody>
                                    <tr class="cs-border_none">
                                        <td class="cs-width_3 cs-border_top_0 cs-bold cs-f16 cs-primary_color">Due
                                            Amount</td>
                                        <td
                                            class="cs-width_3 cs-border_top_0 cs-bold cs-f16 cs-primary_color cs-text_right">
                                            ৳ {{ number_format(totalOrderDue($order->id)) }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="cs-note">
                    <div class="cs-note_left">
                        <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                            <path
                                d="M416 221.25V416a48 48 0 01-48 48H144a48 48 0 01-48-48V96a48 48 0 0148-48h98.75a32 32 0 0122.62 9.37l141.26 141.26a32 32 0 019.37 22.62z"
                                fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
                            <path d="M256 56v120a32 32 0 0032 32h120M176 288h160M176 368h160" fill="none"
                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="32" />
                        </svg>
                    </div>
                    <div class="cs-note_right">
                        <p class="cs-mb0"><b class="cs-primary_color cs-bold">Note:</b></p>
                        <p class="cs-m0">
                            {{ $order->order_notes }}
                        </p>
                    </div>
                </div><!-- .cs-note -->
            </div>
            <div class="cs-invoice_btns cs-hide_print">
                <a href="javascript:window.print()" class="cs-invoice_btn cs-color1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                        <path
                            d="M384 368h24a40.12 40.12 0 0040-40V168a40.12 40.12 0 00-40-40H104a40.12 40.12 0 00-40 40v160a40.12 40.12 0 0040 40h24"
                            fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
                        <rect x="128" y="240" width="256" height="208" rx="24.32"
                            ry="24.32" fill="none" stroke="currentColor" stroke-linejoin="round"
                            stroke-width="32" />
                        <path d="M384 128v-24a40.12 40.12 0 00-40-40H168a40.12 40.12 0 00-40 40v24" fill="none"
                            stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
                        <circle cx="392" cy="184" r="24" />
                    </svg>
                    <span>Print</span>
                </a>
                <a href="{{ route('admin.order.invoice.index') }}" class="cs-invoice_btn cs-color2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                        <title>Arrow Back Circle</title>
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="32" d="M249.38 336L170 256l79.38-80M181.03 256H342" />
                        <path d="M448 256c0-106-86-192-192-192S64 150 64 256s86 192 192 192 192-86 192-192z"
                            fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32" />
                    </svg>
                    <span>Back</span>
                </a>
            </div>
        </div>
    </div>
    <script src="{{ asset('invoice') }}/assets/js/jquery.min.js"></script>
    <script src="{{ asset('invoice') }}/assets/js/jspdf.min.js"></script>
    <script src="{{ asset('invoice') }}/assets/js/html2canvas.min.js"></script>
    <script src="{{ asset('invoice') }}/assets/js/main.js"></script>
</body>

</html>
