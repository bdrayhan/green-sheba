<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Courier;
use App\Models\Order;
use App\Models\OrderStatus;
use PDF;

class InvoiceController extends Controller
{
    // All Invoice Show
    public function index()
    {
        $orders = Order::with('shipping', 'courier')->where('order_status', 4)->paginate(12);
        $couriers = Courier::where('courier_status', 1)->where('courier_active', 1)->get();
        return view('backend.order.invoiced.index', compact('orders', 'couriers'));
    }

    // Single Invoice Show
    public function show($slug)
    {

        $order = Order::with('shipping', 'courier', 'user', 'orderDetails')->where('order_slug', $slug)->firstOrFail();
        return view('backend.order.invoiced.show', compact('order', ));
    }

    //  Single Invoice Print  Processing
    public function print($slug)
    {
        $order = Order::with('shipping', 'courier', 'user', 'orderDetails')->where('order_slug', $slug)->firstOrFail();
        return view('backend.order.invoiced.print', compact('order'));
    }

}
