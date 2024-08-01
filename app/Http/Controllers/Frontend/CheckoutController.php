<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
use App\Models\BasicSetting;
use Illuminate\Http\Request;
use App\Models\OrderDetail;
use App\Models\Shipping;
use App\Models\Coupon;
use App\Models\OrderStatus;
use App\Models\Courier;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Cart;

class CheckoutController extends Controller
{
    public function checkoutCart()
    {
        $cartItems = Cart::getContent();
        return view('frontend.pages.checkout.cart', compact('cartItems'));
    }

    public function checkoutDetails()
    {
        return view('frontend.pages.checkout.details');
    }

    // Coupon Funtion
    public function addCoupon(Request $request)
    {
        $coupon = $request->coupon;
        $check = Coupon::where('coupon_name', $coupon)->where('coupon_active', 1)->firstOrFail();
        if ($check) {
            Session::put('coupon', [
                'name' => $check->coupon_name,
                'discount' => $check->coupon_discount,
                'balance' => Cart::getSubTotal() - $check->coupon_discount,
            ]);
            $notification = array(
                'message' => 'Coupon Applied Successfully',
                'alert-type' => 'success',
            );
        } else {
            $notification = array(
                'message' => 'Invalid Coupon',
                'alert-type' => 'error',
            );
        }
        return redirect()->back()->with($notification);
    }

    public function removeCoupon()
    {
        session()->forget('coupon');
        $notification = array(
            'message' => 'Coupon Removed Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    } 
    // Coupon Function End

    public function orderNow(Request $request)
    {
        // $order_details = OrderDetail::where('order_id', $order_id)->get();

        // Auto User Assign To Order
        $assignUser = User::role(['User'])->where('online_status', 1)->inRandomOrder()->first();
        if (!$assignUser) {
            $assignUser = User::findOrFail(1);
        }
        // ORDER FUNCTION
        $data = array(); 
        if (Auth::check()) {
            $data['user_id'] = auth()->user()->id;
        } else {
            $data['guest_id'] = uniqid();
        }
        $data['payment_type'] = $request->payment_type;
        $data['assign_id'] = $assignUser->id;
        $data['invoice_no'] = uniqueInvoice();
        if (Session::has('coupon')) {
            $data['coupon_amount'] = Session::get('coupon')['discount'];
        }
        $data['order_subtotal'] = Cart::getSubTotal();
        $data['shipping_charge'] = $request->area === 'inside-dhaka' ? 80 : 150;
        if ($request->coupon_code) {
            if ($request->area === 'inside-dhaka') {
                $data['order_total'] = session()->get('coupon')['balance'] + 80;
            } else {
                $data['order_total'] = session()->get('coupon')['balance'] + 150;
            }
        } else {
            if ($request->area === 'inside-dhaka') {
                $data['order_total'] = Cart::getSubTotal() + 80;
            } else {
                $data['order_total'] = Cart::getSubTotal() + 150;
            }
        }

        $data['order_status'] = 1;
        $data['order_date'] = date('Y-m-d', strtotime(Carbon::now()));
        $data['order_month'] = Carbon::now()->format('F');
        $data['order_year'] = Carbon::now()->format('Y');
        $data['order_slug'] = uniqid('order', true);
        $data['order_notes'] = $request->note;
        $data['created_at'] = Carbon::now();
        $order = Order::insertGetId($data);

        // SHIPPING FUNCTION
        $shipping = array();
        $shipping['order_id'] = $order;
        $shipping['shipping_name'] = $request->full_name;
        $shipping['shipping_email'] = $request->email;
        $shipping['shipping_phone'] = $request->phone;
        $shipping['shipping_address'] = $request->address;
        $shipping['shipping_country'] = $request->contry;
        $shipping['shipping_area'] = $request->area;
        $shipping['shipping_note'] = $request->note;
        $shipping['created_at'] = Carbon::now();
        $id = Shipping::insertGetId($shipping);

        $contents = Cart::getContent();
        // $product_com=Product::where('id')->firstOrFail();
        $details = array();
        foreach ($contents as $row) {
            $details['order_id'] = $order;
            $details['user_id'] = auth()->user()->id;
            $details['product_id'] = $row->id;
            $details['product_name'] = $row->name;
            $details['product_code'] = $row->attributes->product_code;
            $details['product_color'] = $row->attributes->color;
            $details['product_size'] = $row->attributes->size;
            $details['product_quantity'] = $row->quantity;
            $details['single_price'] = $row->price;
            $details['product_commission'] = $row->attributes->product_commission;
            $details['total_price'] = $row->price * $row->quantity;
            OrderDetail::create($details);
        }

        // Auth User Check
        if (!Auth::check()) {
            // Create Customer
            $customer = array();
            $customer['name'] = $request->full_name;
            $customer['phone'] = $request->phone;
            $customer['email'] = $request->email ?? uniqid() . '@gmail.com';
            $customer['password'] = Hash::make('12345678');
            $customer['slug'] = uniqid();
            $customer['created_at'] = Carbon::now();
            $user = User::create($customer);
            // Assign To Role
            $user->assignRole('Customer');
        }

        // Destroy All Session Data
        Cart::clear();

        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        $notification = array(
            'message' => 'Order Process Successfully Done!',
            'alert-type' => 'success',
        ); // returns Notification,
        $basicSetting = BasicSetting::firstOrFail();
        $invoiceCode = $data['invoice_no'];
        return view('frontend.pages.checkout.complect', compact('basicSetting', 'invoiceCode'))->with($notification);
    }

    public function quickOrder(Request $request)
    {
        Cart::add([
            'id' => $request->product_id,
            'name' => $request->product_name,
            'quantity' => $request->product_quantity,
            'price' => $request->product_price,
            'product_commission' => $request->product_commission,
            'attributes' => array(
                'image' => $request->product_image,
                'url' => $request->product_url,
                'color' => $request->product_color,
                'size' => $request->product_size,
                'product_code' => $request->product_code,
            )
        ]);
        $notification = array(
            'message' => 'Product Added To Cart',
            'alert-type' => 'success',
        );
        return redirect()->route('web.checkout.details')->with($notification);
    }

    public function checkoutPayment()
    {
        return view('frontend.pages.checkout.payment');
    }

    public function checkoutReview()
    {
        return view('frontend.pages.checkout.review');
    }

    public function checkoutComplect(Request $request)
    {
        if ($request->isMethod('post')) {
            return view('frontend.pages.checkout.complect');
        }else {
            return redirect()->route('web.home');
        }
    }
}
