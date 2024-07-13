<?php

namespace App\Http\Controllers\Backend\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\Admin\OrderTrait;
use App\Models\Courier;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStatus;
use App\Models\Product;

class OrderController extends Controller
{
    use OrderTrait;
    public function view($slug)
    {
        $order = Order::with('shipping', 'courier', 'orderDetails', 'assign')->where('order_slug', $slug)->firstOrFail();
        $orderStatus = OrderStatus::whereIn('id', [5, 6, 8, 10, 11, 12])->pluck('id')->toArray();
        return view('partner.order.view', compact('order', 'orderStatus'));
    }
}
