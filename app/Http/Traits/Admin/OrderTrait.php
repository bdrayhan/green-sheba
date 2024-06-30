<?php

namespace App\Http\Traits\Admin;

use App\Models\Courier;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Shipping;
use App\Models\User;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

trait OrderTrait {
    public function orderCreate(){
        $products = Product::all();
        $couriers = Courier::all();
        return view('backend.order.create',compact('products','couriers'));
    }
    public function orderProduct(Request $request){
        // Get Products
        if (isset($request['q'])) {
          $products = Product::query()->where('product_name', 'like', '%' . $request['q'] . '%')->get();
        } else {
            $products = Product::all();
        }
        $product = array();
        foreach ($products as $item) {
            $product[] = array(
                "id" => $item->id,
                "product_name" => $item->product_name,
                "product_thumbnail" => $item->product_thumbnail,
                "product_code" => $item->product_code,
                "product_price" => $item->product_discount_price ?? $item->product_regular_price,
            );
        }
        $data['data'] = $product;
        return json_encode($data);
        die();
    }

    public function orderCourier($id)
    {
        $courier = Courier::findOrFail($id);
        return response()->json($courier);
    }


    public function orderStore(Request $request)
    {

        $validator = Validator::make($request->data, [
            'shippingName' => 'required',
            'shippingPhone' => 'required',
            'shippingAddress' => 'required',
            'courierID' => 'required',
            'shippingCharge' => 'required',
            'product' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        $order = new Order();
        $order->invoice_no = uniqueInvoice();
        $order->user_id = Auth::user()->id;
        $order->assign_id = Auth::user()->id;
        $order->courier_id = $request->data['courierID'];
        $order->payment_type = 'Cash On Delivery';
        $order->paying_amount = $request->data['payAmount'];
        $order->shipping_charge = $request->data['shippingCharge'];
        $order->order_date = date('Y-m-d', strtotime(Carbon::now()));
        $order->order_month = Carbon::now()->format('F');
        $order->order_year = Carbon::now()->format('Y');
        $order->order_slug = uniqid('order', true);
        $order->order_notes = $request->data['shippingNote'];
        $order->save();

        $shipping = new Shipping();
        $shipping->order_id = $order->id;
        $shipping->shipping_name = $request->data['shippingName'];
        $shipping->shipping_phone = $request->data['shippingPhone'];
        $shipping->shipping_email = $request->data['shippingEmail'];
        $shipping->shipping_address = $request->data['shippingAddress'];
        $shipping->shipping_note = $request->data['shippingNote'];
        $shipping->save();

        foreach ($request->data['product'] as $detail) {
            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $detail['productID'];
            $orderDetail->product_name = $detail['productName'];
            $orderDetail->product_code = $detail['productCode'];
            $orderDetail->single_price = $detail['productPrice'];
            $orderDetail->product_quantity = $detail['productQuantity'];
            $orderDetail->total_price =$detail['productPrice'] * $detail['productQuantity'];
            $orderDetail->save();
        }

        return response()->json(['success' => 'Order Created Successfully']);
    }
}
