<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:Super Admin|Admin|Manager']);
    }


//    function sentOrderInfo(Request $request)
//    {
//        $url = "http://esms.linkhostbd.com/smsapi";
//        $data = [
//            "api_key" => env('SMS_API_KEY'),
//            "type" => "text",
//            "contacts" => "88017xxxxxxxx+88018xxxxxxxx",
//            "senderid" => "{sender id}",
//            "msg" => "{your message}",
//        ];
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, $url);
//        curl_setopt($ch, CURLOPT_POST, 1);
//        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//        $response = curl_exec($ch);
//        curl_close($ch);
//        return $response;
//    }


    public function dashboard()
    {
//        $order = DB::table('order_statuses')
//            ->join('orders', 'order_statuses.id', '=', 'orders.order_status')
//            ->select('order_statuses.*', 'orders.*')
//            ->whereMonth('orders.created_at', Carbon::now()->month)
//            ->get();
//
//        return $order;
        return view('backend.dashboard');
    }

    public function logout()
    {

        if (Auth::check()) {
            Auth::logout();
            return redirect('login');
        }
        return redirect()->back();
    }

    public function clearCache(): RedirectResponse
    {
        Artisan::call('cache:clear');
        $notification = array(
            'message' => 'Cache Clear Successfully!',
            'alert-type' => 'success',
        ); // returns Notification,
        return redirect()->back()->with($notification);
    }

    public function Optimize(): RedirectResponse
    {
        Artisan::call('optimize:clear');
        $notification = array(
            'message' => 'Website Optimize Clear!',
            'alert-type' => 'success',
        ); // returns Notification,
        return redirect()->back()->with($notification);
    }

    public function userProfile(): Factory|View|Application
    {
        $user = User::where('id', Auth::id())->firstOrFail();
        return view('backend.includes.profile', compact('user'));
    }

    public function allSubscriber(): Factory|View|Application
    {
        $subscribers = Subscriber::all();
        return view('backend.subscriber.index', compact('subscribers'));
    }
    public function subscriberDelete($id): RedirectResponse
    {
        $subscribers = Subscriber::where('id',  $id)->delete();
        $notification = array(
            'message' => 'Subscriber Delete Successfully!',
            'alert-type' => 'success',
        ); // returns Notification,
        return redirect()->back()->with($notification);
    }
}
