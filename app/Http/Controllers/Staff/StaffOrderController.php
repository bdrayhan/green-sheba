<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Traits\Staff\OrderTrait;
use App\Models\Order;

class StaffOrderController extends Controller
{
    use OrderTrait;

    public function createOrder()
    {
        return view('staff.order.create');
    }

    public function print($slug){
        $order = Order::with('shipping', 'courier', 'user', 'orderDetails')->where('order_slug', $slug)->firstOrFail();
        return view('staff.order.print', compact('order'));
    }
}
