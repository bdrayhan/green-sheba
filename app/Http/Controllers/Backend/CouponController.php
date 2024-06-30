<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CouponController extends Controller
{

    public function index()
    {
        $coupons = Coupon::where('coupon_status', 1)->get();
        return view('backend.coupon.index', compact('coupons'));
    }

    public function create()
    {
        //
    }

    public function insert(Request $request)
    {
        $request->validate([
            'coupon_name' => 'required',
            'coupon_discount' => 'required',
        ]);

        $coupon = Coupon::create([
            'coupon_name' => Str::upper($request->coupon_name),
            'coupon_slug' => uniqid(),
            'coupon_creator' => Auth::id(),
            'coupon_discount' => $request->coupon_discount,
        ]);
        if ($coupon) {
            $notification = array(
                'message' => 'Coupon Added Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'Coupon Added Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $slug)
    {
        $request->validate([
            'coupon_name' => 'required',
            'coupon_discount' => 'required',
        ]);

        $coupon = Coupon::where('coupon_slug', $slug)->update([
            'coupon_name' => Str::upper($request->coupon_name),
            'coupon_editor' => Auth::id(),
            'coupon_discount' => $request->coupon_discount,
        ]);
        if ($coupon) {
            $notification = array(
                'message' => 'Coupon Updated Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'Coupon Updated Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);
    }

    public function delete($slug)
    {
        $coupon = Coupon::where('coupon_slug', $slug)->delete();
        if ($coupon) {
            $notification = array(
                'message' => 'Coupon Deleted Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'Coupon Deleted Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);
    }

    public function active($slug)
    {
        $coupon = Coupon::where('coupon_slug', $slug)->update(['coupon_active' => 1]);
        if ($coupon) {
            $notification = array(
                'message' => 'Coupon Status Active!',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'Coupon Status Update Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);
    }

    public function deactive($slug)
    {
        $coupon = Coupon::where('coupon_slug', $slug)->update(['coupon_active' => 0]);
        if ($coupon) {
            $notification = array(
                'message' => 'Coupon Status Inactive!',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'Coupon Status Update Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);
    }

    public function mulipleDelete(Request $request)
    {
        if ($request->ids) {
            foreach ($request->ids as $id) {
                // City Delete
                Coupon::where('id', $id)->delete();
                $response['status'] = 'success';
                $response['message'] = 'Successfully Delete Coupon';
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Unsuccessful to Delete Coupon';
        }
        return response()->json($response, 201);
    }
}
