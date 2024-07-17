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
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    
    public function index(){
        $id=Auth::user()->id;
        $orders=Order::where('user_id', $id)->orderBy('id','DESC')->get();
        return view('partner.order.index',compact('orders'));

    }
    public function view($slug){
        $id=Auth::user()->id;
        $order=Order::where('user_id',$id)->where('order_slug',$slug)->firstOrFail();
        return view('partner.order.view',compact('order'));
    }
}
