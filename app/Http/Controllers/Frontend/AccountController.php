<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function userAccount()
    {
        $user = Auth::user();
        return view('frontend.pages.account.userDashboard', compact('user'));
    }

    public function userOrder()
    {
        $id = Auth::user()->id;
        $userOrder = Order::with('shipping', 'orderDetails')->where('user_id', $id)->get();
        return view('frontend.pages.account.userOrder', compact('userOrder'));
    }

    public function userOrderPdf($slug)
    {
        $order = Order::with('shipping', 'courier', 'user', 'orderDetails')->where('order_slug', $slug)->firstOrFail();

        if (empty($order)) {
            abort(404);
        }
        return view('frontend.pages.account.print', compact('order'));
    }
    public function userOrderCancel($slug)
    {
        $order = Order::where('order_slug', $slug)->update([
            'order_status' => 3,
        ]);
        if (empty($order)) {
            abort(404);
        }
        $notification = array(
            'message' => 'Order Cancled',
            'alert-type' => 'success',
        ); // returns Notification,
        return redirect()->back()->with($notification);
    }

    public function userAddress()
    {
        $user = Auth::user();
        return view('frontend.pages.account.userAddress', compact('user'));
    }

    public function userDetails()
    {
        $user = Auth::user();
        return view('frontend.pages.account.userDetails', compact('user'));
    }

    public function userAddressdate(Request $request)
    {
        $id = Auth::user()->id;
        if (Auth::check()) {
            User::where('id', $id)->update(
                [
                    'city' => $request->city,
                    'post_code' => $request->post_code,
                    'country' => $request->country,
                    'address' => $request->address,
                ]
            );
            return redirect()->back()->with('success', 'Information Updated');
        }
    }
    public function userDetailsUpdate(Request $request)
    {
        $id = Auth::user()->id;
        User::where('id', $id)->update(
            [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'name' => $request->first_name . ' ' . $request->last_name,
            ]
        );
        $notification = array(
            'message' => 'User Details Updated',
            'alert-type' => 'success',
        ); // returns Notification,
        return redirect()->back()->with($notification);
    }

    public function userPasswordChange(Request $request)
    {
        // return $request->all();
        // Auth User Password Change
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required',
        ]);

        $id = Auth::user()->id;
        $user = User::find($id);
        $current_password = $request->current_password;
        $new_password = $request->new_password;
        $confirm_password = $request->confirm_password;
        if (Auth::attempt(['id' => $id, 'password' => $current_password])) {
            if ($new_password == $confirm_password) {
                $user->password = bcrypt($new_password);
                $user->save();
                $notification = array(
                    'message' => 'Password Changed',
                    'alert-type' => 'success',
                ); // returns Notification,
                return redirect()->back()->with($notification);
            } else {
                $notification = array(
                    'message' => 'Password Not Matched',
                    'alert-type' => 'error',
                ); // returns Notification,
                return redirect()->back()->with($notification);
            }
        } else {
            $notification = array(
                'message' => 'Old Password Not Matched',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }
}
