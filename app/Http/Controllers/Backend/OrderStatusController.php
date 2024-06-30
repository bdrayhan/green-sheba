<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\OrderStatus;
use Illuminate\Http\Request;

class OrderStatusController extends Controller
{
    public function index()
    {
        $orderStatuses = OrderStatus::all();
        return view('backend.order_status.index',[
            'orderStatuses' => $orderStatuses
        ]);
    }
}
