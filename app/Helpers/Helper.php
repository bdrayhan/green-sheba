<?php

use App\Models\BasicSetting;
use App\Models\ContactInfo;
use App\Models\Courier;
use App\Models\MenuBar;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStatus;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\SocialSetting;
use App\Models\User;
use Illuminate\Support\Carbon;

function appSetting(): array
{
    $data = array();
    $data['basic_setting'] = BasicSetting::first();
    $data['basic_contact'] = ContactInfo::first();
    $data['basic_social'] = SocialSetting::first();
    return $data;
}

function headerMenu()
{
    return MenuBar::where('menu_status', 1)->orderBy('menu_order', 'ASC')->get();
}

function getAllProduct()
{
    return Product::where('product_active', 1)->where('product_status', 1)->orderBy('id', 'DESC')->get();
}

function getAllCourier()
{
    return Courier::where('courier_status', 1)->withCount('orders')->get();
}

function productUnitPrice($product_id)
{
    $product = Product::where('id', $product_id)->first();
    if ($product->product_discount_price === NULL) {
        return $product->product_regular_price;
    } else {
        return $product->product_discount_price;
    }
}

function productSubtotal($product_id, $product_quantity): float|int
{
    $product = Product::where('id', $product_id)->first();
    if ($product->product_discount_price === NULL) {
        return $product->product_regular_price * $product_quantity;
    } else {
        return $product->product_discount_price * $product_quantity;
    }
}

function orderSubtotal($order_id): float|int
{
    $total = 0;
    $order_details = OrderDetail::where('order_id', $order_id)->get();
    foreach ($order_details as $order_detail) {
        $total += $order_detail->single_price * $order_detail->product_quantity;
    }
    return $total;
}
class Helper{

function orderComtotal($order_id): float|int
{
    $total = 0;
    $com_details = OrderDetail::where('order_id', $order_id)->get();
    foreach ($com_details as $com_detail) {
        $total += $com_detail->product_commission * $com_detail->product_quantity;
    }
    return $total;
}

}

function orderPayAmount($order_id)
{
    $order_details = OrderDetail::where('order_id', $order_id)->first();
    return $order_details->order->paying_amount;
}

function totalOrderAmount($order_id)
{
    $total = 0;
    $order_details = OrderDetail::where('order_id', $order_id)->get();
    foreach ($order_details as $order_detail) {
        $total += $order_detail->single_price * $order_detail->product_quantity;
    }
    $total += $order_detail->order->shipping_charge;
    $total -= $order_detail->order->advance_amount;
    return $total;
}

function totalOrderQuantity($order_id)
{
    $total = 0;
    $order_details = OrderDetail::where('order_id', $order_id)->get();
    foreach ($order_details as $order_detail) {
        $total += $order_detail->product_quantity;
    }
    return $total;
}

function totalOrderDue($order_id)
{
    $total = 0;
    $order_details = OrderDetail::where('order_id', $order_id)->get();
    foreach ($order_details as $order_detail) {
        $total += $order_detail->single_price * $order_detail->product_quantity;
    }
    $total += $order_detail->order->shipping_charge;
    $total -= $order_detail->order->paying_amount;
    return $total;
}


// Order Page Status List
function orderPageStatus()
{
    return OrderStatus::whereIn('id', [1, 2, 3, 4, 5])->get();
}

// Invoice Page Status List
function invoicePageStatus()
{
    return OrderStatus::whereIn('id', [5, 6, 7])->get();
}

// Delivery Page Status List
function deliveryPageStatus()
{
    return OrderStatus::whereIn('id', [8, 9, 10, 11])->get();
}


// <----------------- ORDER PAGE STATUS UPDATE LIST -------------------->

function pendingOrderStatus()
{
    return OrderStatus::whereIn('id', [2, 3, 4, 5])->get();
}

function processingOrderStatus()
{
    return OrderStatus::whereIn('id', [1, 3, 4, 5])->get();
}

function holdingOrderStatus()
{
    return OrderStatus::whereIn('id', [1, 2, 4, 5])->get();
}

function canceledOrderStatus()
{
    return OrderStatus::whereIn('id', [6, 7, 8])->get();
}

function completeOrderStatus()
{
    return OrderStatus::whereIn('id', [1, 2, 3, 4, 6])->get();
}

function pendingInvoiceOrderStatus()
{
    return OrderStatus::whereIn('id', [7, 4, 6])->get();
}

function invoiceOrderStatus()
{
    return OrderStatus::whereIn('id', [5, 7, 4, 8])->get();
}

function stockOutOrderStatus()
{
    return OrderStatus::whereIn('id', [5, 6, 4, 8])->get();
}

function deliveryOrderStatus()
{
    return OrderStatus::whereIn('id', [9, 11])->get();
}
function deliveredOrderStatus()
{
    return OrderStatus::whereIn('id', [9, 11])->get();
}



// TOTAL APP FEATURE LIST
function totalProduct()
{
    return Product::count();
}

function totalProductCategory()
{
    return ProductCategory::count();
}

function totalOrder()
{
    return Order::count();
}

function totalPending()
{
    return Order::where('order_status', 1)->count();
}
function totalProcessing()
{
    return Order::where('order_status', 2)->count();
}
function totalHolding()
{
    return Order::where('order_status', 3)->count();
}
function totalCancel()
{
    return Order::where('order_status', 4)->count();
}
function totalStockOut()
{
    return Order::where('order_status', 7)->count();
}
function totalInvoice()
{
    return Order::where('order_status', 6)->count();
}

function totalDelivered()
{
    return Order::where('order_status', 11)->count();
}
function totalDelivery()
{
    return Order::where('order_status', 8)->count();
}
function totalLost()
{
    return Order::where('order_status', 9)->count();
}
function totalUser()
{
    return User::count();
}

function stockOutProduct()
{
    return Product::where('product_quantity', '<=', 0)->get();
}

// <----------------- TODAY ORDER  ----------------->
function todayOrder()
{
    return Order::whereDate('created_at', Carbon::today())->count();
}
function todayStatusOrder()
{
    return OrderStatus::get();
}

function uniqueInvoice(): string
{
    $lastOrder = Order::latest('id')->first();
    if ($lastOrder) {
        $orderID = random_int(100, 999) . $lastOrder->id + 1;
    } else {
        $orderID = random_int(100, 999) . 1;
    }
    $code = BasicSetting::first()->invoice_code;
    return $code . '-' . $orderID;
}
