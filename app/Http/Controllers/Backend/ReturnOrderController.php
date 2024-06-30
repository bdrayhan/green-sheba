<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\ReturnOrder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ReturnOrderController extends Controller
{
    public function index()
    {
        $today = date('d-m-Y');
        $lastWeek = Carbon::today()->subDays(7)->format('d-m-Y');
        $returnOrders = Order::whereBetween('return_date', [$lastWeek, $today])->where('order_status', 9)->get();
        return view('backend.stock.return.index', compact('returnOrders'));
    }
    public function create()
    {
        $products = Product::all();
        $customers = User::role('Customer')->orderBy('name', "ASC")->get();
        $orders = Order::whereIn('order_status', [8,11])->get();
        return view('backend.stock.return.create',[
            'products' => $products,
            'customers' => $customers,
            'orders' => $orders,
        ]);
    }
    public function store(Request $request)
    {
        return $request->all();

    }

    public function allReturnOrder()
    {
        return view('backend.order.return.index');
    }

    public function allCourierOrder($id)
    {
        $orders = Order::with('courier', 'assign')->where('courier_id', $id)->whereIn('order_status', [8,9,10,11,12])->get();
        return view('backend.order.return.index', compact('orders'));
    }

    public function returnCourierOrderShow($id){
        $order = Order::where('id', $id)->with('shipping', 'orderDetails')->first();
        return view('backend.order.return.show', compact('order'));
    }

    public function returnCourierOrder(Request $request)
    {
        // return $request->all();
        // // validation
        $request->validate([
            'or_return_note' => 'required',
        ]);

        $order = Order::where('id', $request->order_id)->with('shipping', 'orderDetails')->first();
        $orderReturn = new ReturnOrder();
        $orderReturn->order_id = $request->order_id;
        $orderReturn->courier_id = $order->courier_id;
        if ($order->user_id) {
            $orderReturn->user_id = $order->user_id;
        }
        $orderReturn->customer_name = $order->shipping->shipping_name;
        $orderReturn->customer_phone = $order->shipping->shipping_phone;
        $orderReturn->customer_address = $order->shipping->shipping_address;
        $orderReturn->or_return_note = $request->or_return_note;
        $orderReturn->or_return_date = date('Y-m-d', strtotime(Carbon::now()));
        $orderReturn->or_slug = uniqid();
        $orderReturn->or_return_status = 1;
        $orderReturn->save();
        $order->order_status = 10;
        $order->return_date = date('Y-m-d', strtotime(Carbon::now()));
        foreach ($order->orderDetails as  $detail) {
            $product = Product::where('id', $detail->product_id)->first();
            $product->product_quantity = $product->product_quantity + $detail->product_quantity;
            $product->return_count = $product->return_count + $detail->product_quantity;
            $product->save();
        }
        $order->save();

        if ($order) {
            $notification = array(
                'message' => 'Return Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'Return Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);
    }

    public function courierOrderReturn($id)
    {
        $order = Order::where('id', $id)->first();
        return view('backend.order.return.show', compact('order'));
    }
}
