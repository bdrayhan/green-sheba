<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use App\Models\OrderStatus;
use App\Models\User;

class StaffController extends Controller
{


    public function dashboard()
    {
        $statues = OrderStatus::with('order')->get();
        return view('staff.dashboard', compact('statues'));
    }

    public function logout()
    {

        if (Auth::check()) {
            Auth::logout();
            return redirect('login');
        } else {
            return redirect()->back();
        }
    }

    public function clearCache()
    {
        Artisan::call('cache:clear');
        $notification = array(
            'message' => 'Cache Clear Successfully!',
            'alert-type' => 'success',
        ); // returns Notification,
        return redirect()->back()->with($notification);
    }

    public function userProfile()
    {
        $user = User::where('id', Auth::id())->firstOrFail();
        return view('staff.includes.profile', compact('user'));
    }

    public function totalOrder()
    {
        $orders = Order::with('courier', 'shipping', 'status', 'assign')->where('assign_id', Auth::user()->id)->get();
        return view('staff.order.total-order', compact('orders'));
    }
}
