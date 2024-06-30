<?php

namespace App\Http\Traits\Staff;

use App\Models\OrderStatus;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Courier;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

trait OrderTrait {

    public function getStatusProduct($status_id)
    {
        $orders = Order::where('order_status', $status_id)->with('courier', 'shipping', 'status', 'assign')->where('assign_id', Auth::user()->id)->get();
        $couriers = Courier::where('courier_status', 1)->get();
        // Order List
        if ($status_id == 1) {
            $statues = pendingOrderStatus();
            return view('staff.order.pending', compact('orders', 'statues', 'couriers', 'status_id'));
        }
        elseif ($status_id == 2) {
            $statues = processingOrderStatus();
            return view('staff.order.pending', compact('orders', 'statues', 'couriers', 'status_id'));
        }
        elseif ($status_id == 3) {
            $statues = holdingOrderStatus();
            return view('staff.order.pending', compact('orders', 'statues', 'couriers', 'status_id'));
        }
        elseif ($status_id == 4) {
            $statues = canceledOrderStatus();
            return view('staff.order.pending', compact('orders', 'statues', 'couriers', 'status_id'));
        }
        elseif ($status_id == 5) {
            $statues = completeOrderStatus();
            return view('staff.order.invoice', compact('orders', 'statues', 'couriers', 'status_id'));
        }
        elseif ($status_id == 6) {
            $statues = invoiceOrderStatus();
            return view('staff.order.invoice', compact('orders', 'statues', 'couriers', 'status_id'));
        }
        elseif ($status_id == 7) {
            $statues = stockOutOrderStatus();
            return view('staff.order.invoice', compact('orders', 'statues', 'couriers', 'status_id'));
        }
        elseif ($status_id == 8) {
            $statues = deliveryOrderStatus();
            return view('staff.order.delivery', compact('orders', 'statues', 'couriers', 'status_id'));
        }
        elseif ($status_id == 9) {
            $orders = Order::where('order_status', 9)->with('courier', 'shipping', 'status', 'assign')->where('assign_id', Auth::user()->id)->get();
            return view('staff.order.lost-order', compact('orders'));

        }
        elseif ($status_id == 10) {
            return "Return Order List.";
        }
        else {
            $statues = deliveredOrderStatus();
            return view('staff.order.delivery', compact('orders', 'statues', 'couriers', 'status_id'));
        }
    }

    // ORDER COURIER ASSIGN
    public function courierAssign(Request $request)
    {

        $order = Order::where('id', $request->order_id)->update([
            'courier_id' => $request->courier_id
        ]);
        if ($order) {
            return response()->json('Update Success', 200);
        }else {
            return response()->json('Not Found', 302);

        }
    }
    // STATUS ASSIGN TO ORDER
    public function statusAssign(Request $request)
    {
        $order = Order::where('id', $request->order_id)->firstOrFail();
        if ($request->status_id == 5) {
            $order->complected_date = date('Y-m-d');
            $order->save();
        }
        elseif ($request->status_id == 6) {
            $order->invoice_date = date('Y-m-d');
            $order->save();
        }
        elseif ($request->status_id == 9) {
            $order->delivery_date = date('Y-m-d');
            $order->save();
        }
        elseif ($request->status_id == 11) {
            foreach ($order->orderDetails as $detail) {
                Product::where('id', $detail->product_id)->decrement('product_quantity', $detail->product_quantity);
            }
            $order->delivery_date = date('Y-m-d');
            $order->save();
        }
        elseif ($request->status_id == 12) {
            $order->collected_date = date('Y-m-d');
            $order->save();
        }

        $order->order_status = $request->status_id;
        $order->update();
        if ($order) {
            return response()->json('Update Success', 200);
        }else {
            return response()->json('Not Found', 302);
        }
    }

    public function showOrder($slug): Factory|View|Application
    {
        $order = Order::with('shipping', 'courier', 'orderDetails', 'assign')->where('order_slug', $slug)->firstOrFail();
        $orderStatus = OrderStatus::whereIn('id', [5, 6, 8, 10, 11, 12])->pluck('id')->toArray();
        if ($order === null) {
            abort(404);
        }
        return view('staff.order.show', compact('order', 'orderStatus'));
    }

    public function editOrder($order_slug)
    {
        $order = Order::with('shipping', 'courier', 'orderDetails')->where('order_slug', $order_slug)->firstOrFail();
        if ($order === null) {
            abort(404);
        }
        $couriers = Courier::where('courier_active', 1)->where('courier_status', 1)->get();
        return view('staff.order.edit', compact('order', 'couriers'));
    }

    public function updateOrder(Request $request, $slug)
    {

        $request->validate([
            'courier_id' => 'required',
            'shipping_name' => 'required',
            'shipping_phone' => 'required|regex:/(01)[0-9]{9}/',
            'shipping_address' => 'required',
        ]);

        $order = Order::where('order_slug', $slug)->firstOrFail();

        // Shipping Info Update
        $order->shipping->shipping_name = $request->shipping_name;
        $order->shipping->shipping_phone = $request->shipping_phone;
        $order->shipping->shipping_email = $request->shipping_email;
        $order->shipping->shipping_address = $request->shipping_address;
        $order->shipping->save();

        // Courier Info Update
        if (empty($request->courier_id)) {
            $notification = array(
                'message' => 'Select First Courier!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }else {
            $order->courier_id = $request->courier_id;
        }

        // Advance Payment amount
        if ($request->paying_amount > totalOrderAmount($order->id)) {
            $notification = array(
                'message' => 'Valid Paying Amount!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }else{
            if (empty($request->paying_amount)) {
                $order->paying_amount = 0;
            }else {
                $order->paying_amount = $request->paying_amount;
            }
        }
        $order->store_notes = $request->store_note;
        $order->save();

        if ($order) {
            $notification = array(
                'message' => 'Order Update Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'Order Update Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);
    }

    public function deleteOrder($slug)
    {
        $order = Order::where('order_slug', $slug)->firstOrFail();
        if ($order) {
            foreach ($order->orderDetails as $detail) {
                $detail->delete();
            }
            $order->shipping->delete();
            $order->delete();

            $notification = array(
                'message' => 'Order Delete Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'Order Delete Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);
    }

    public function productDelete($detail_id)
    {
        $detail = OrderDetail::findOrFail($detail_id);
        $allProducts = OrderDetail::where('order_id', $detail->order_id)->count();
        if ($allProducts > 1) {
            $order = Order::where('id', $detail->order_id)->firstOrFail();
            $order_subtotal = $order->order_subtotal;
            $shipping_charge = $order->shipping_charge;

            if (!empty($order->coupon_amount)) {
                $order_total = $order_subtotal + $shipping_charge - $order->coupon_amount;
            } else {
                $order_total = $order_subtotal + $shipping_charge;
            }

            Order::where('id', $detail->order_id)->update([
                'order_subtotal' => $order_subtotal - $detail->total_price,
                // 'paying_amount' => 0,
                'order_total' => $order_total - $detail->total_price,
            ]);

            $detail->delete();
            $notification = array(
                'message' => 'Product Deleted!',
                'alert-type' => 'success',
            ); // returns Notification,

        } else {
            $notification = array(
                'message' => 'must one product have!',
                'alert-type' => 'error',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);
    }

    public function productQuantityUpdate(Request $request)
    {
        if ($request->ajax()) {
            $detail_id = $request->detail_id;
            $quantity = $request->quantity;
            OrderDetail::where('id', $detail_id)->update([
                'product_quantity' => $quantity
            ]);

            return response()->json([
                'message' => 'Quantity Updated'
            ]);
        }
    }

    // AJAX
    public function getProductColorSize($id){

        $product = Product::where('id', $id)->firstOrFail();
        $colors = $product->color;
        $sizes = $product->size;
        return response()->json([
            'colors' => $colors,
            'sizes' => $sizes
        ]);
    }

    public function addOrderItem(Request $request)
    {
        $request->validate([
            'order_id' => 'required|numeric',
            'product_id' => 'required|numeric',
            'quantity' => 'required|numeric',
        ]);

        $product = Product::where('id', $request->product_id)->firstOrFail();
        $detail = new OrderDetail();
        $detail->order_id = $request->order_id;
        $detail->product_id = $request->product_id;
        $detail->product_quantity = $request->quantity;
        $detail->product_color = $request->color_id;
        $detail->product_size = $request->size_id;
        $detail->product_code = $product->product_code;
        $detail->product_name = $product->product_name;
        if (empty($product->product_discount_price)) {
            $price = $product->product_regular_price;
        }else {
            $price = $product->product_discount_price;
        }
        $detail->single_price = $price;
        $detail->total_price = $price * $request->quantity;
        $detail->save();

        if ($detail) {
            $notification = array(
                'message' => 'Product Added!',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'Added Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);
    }
}
