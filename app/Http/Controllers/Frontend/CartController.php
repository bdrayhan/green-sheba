<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Cart;

class CartController extends Controller
{
    public function cartTest(Request $request)
    {
        return Cart::getContent();
    }

    public function productAddToCart(Request $request)
    {
       // Add to Cart
        $add = Cart::add([
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
                'product_commission' => $request->product_commission,
            )
        ]);
        if ($add) {
            $notification = array(
                'message' => 'Cart Add Successfully',
                'alert-type' => 'success',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);
    }

    public function productUpdateToCart(Request $request)
    {
        $product_id = $request->product_id;

        $update = Cart::update(
            $product_id,
            [
                'quantity' => array(
                    'relative' => false,
                    'value' => $request->product_quantity,
                    'product_commission' => $request->product_commission,
                ),
                'attributes' => array(
                    'image' => $request->product_image,
                    'size' => $request->product_size,
                    'color' => $request->product_color,
                    'product_commission' => $request->product_commission,
                ),
                'product_commission' => $request->product_commission,
            ]
        );
        if ($update) {
            $notification = array(
                'message' => 'Cart Update Successfully',
                'alert-type' => 'success',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);
    }

    public function removeToCart($id)
    {
        // cart count
        $cart = Cart::getContent()->count();
        if ($cart == 1) {
            $cart = Cart::remove($id);
            $notification = array(
                'message' => 'Cart Remove Successfully',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $cart = Cart::remove($id);
            $notification = array(
                'message' => 'Cart Remove Successfully',
                'alert-type' => 'success',
            ); // returns Notification,
        }

        return redirect()->back()->with($notification);
    }
    public function allRemoveToCart()
    {
        $cart = Cart::clear();
        if ($cart) {
            $notification = array(
                'message' => 'All Cart Remove Successfully',
                'alert-type' => 'success',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);
    }
}
