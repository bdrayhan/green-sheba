<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Traits\Admin\OrderTrait;
use App\Models\Courier;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStatus;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use OrderTrait;
    public function view($slug)
    {
        $order = Order::with('shipping', 'courier', 'orderDetails', 'assign')->where('order_slug', $slug)->firstOrFail();
        $orderStatus = OrderStatus::whereIn('id', [5, 6, 8, 10, 11, 12])->pluck('id')->toArray();
        return view('backend.order.view', compact('order', 'orderStatus'));
    }

    public function edit($slug)
    {
        $order = Order::with('shipping', 'courier', 'orderDetails')->where('order_slug', $slug)->firstOrFail();
        if (empty($order)) {
            abort(404); 
        }
        $couries = Courier::where('courier_active', 1)->where('courier_status', 1)->get();
        return view('backend.order.single', compact('order', 'couries'));
    }

    public function orderUpdate(Request $request, $slug)
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
        return redirect()->route('admin.status.order.list', $order->order_status)->with($notification);
    }

    public function orderDelete($slug)
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

    // Status Wise Get All Order
    public function getStatusOrder($status_id)
    {
        $orders = Order::with('shipping', 'courier')->where('order_status', $status_id)->orderBy('created_at', 'DESC')->get();
        $couriers = Courier::where('courier_status', 1)->where('courier_active', 1)->get();
        if ($status_id == 1 || $status_id == 2 || $status_id == 3 || $status_id == 4 || $status_id == 5) {
            return view('backend.order.index', compact('orders', 'couriers'));
        }elseif ($status_id == 6 || $status_id == 7) {
            return view('backend.order.invoiced.index', compact('orders', 'couriers'));
        }else {
            return view('backend.order.delivery', compact('orders', 'couriers'));
        }
    }

    public function invoicePage()
    {
        $orders = Order::with('shipping', 'courier')->where('order_status', 6)->orderBy('created_at', 'DESC')->get();
        $couriers = Courier::where('courier_status', 1)->where('courier_active', 1)->get();
        return view('backend.order.invoiced.index', compact('orders', 'couriers'));
    }

    public function pendingInvoicePage()
    {
        $orders = Order::with('shipping', 'courier')->where('order_status', 5)->orderBy('created_at', 'DESC')->get();
        $couriers = Courier::where('courier_status', 1)->where('courier_active', 1)->get();
        return view('backend.order.invoiced.index', compact('orders', 'couriers'));
    }
    public function deliveryPage()
    {
        $orders = Order::with('shipping', 'courier')->where('order_status', 8)->orderBy('created_at', 'DESC')->get();
        $couriers = Courier::where('courier_status', 1)->where('courier_active', 1)->get();
        return view('backend.order.delivery', compact('orders', 'couriers'));
    }

    // USER ASSIGN FUNCTION

    public function userAssign(Request $request)
    {
        $user_id = $request->user_id;
        if ($request->ids) {
            foreach ($request->ids as $id) {
                Order::where('id', $id)->update([
                    'assign_id' => $user_id
                ]);
            }
            $response['status'] = 'success';
            $response['message'] = 'User Assign To Order';
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'User Assign Failed';
        }
        return response()->json($response, 201);
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
    // ORDER COURIER ASSIGN
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

    public function markOrderDelete(Request $request)
    {
        $ids = $request->ids;
        foreach ($ids as $id) {
            $order = Order::where('id', $id)->first();
            foreach ($order->orderDetails as $detail) {
                $detail->delete();
            }
            $order->shipping->delete();
            $order->delete();
        }
        return response()->json([
            'status' => 'success',
        ], 200);
    }
}
