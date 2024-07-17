<?php

namespace App\Http\Controllers\Backend\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class CommissionController extends Controller
{
    public function index(){
        $id=Auth::user()->id;
        $orders=Order::where('user_id', $id)->orderBy('id','DESC')->get();
        return view('partner.commission.index',compact('orders'));
    }
}
