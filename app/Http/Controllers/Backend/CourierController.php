<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Courier;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CourierController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function index()
    {
        $couriers = Courier::where('courier_status', 1)->orderBy('courier_name', 'ASC')->get();
        return view('backend.courier.index', compact('couriers'));
    }

    public function create()
    {
        //
    }


    public function insert(Request $request)
    {
        $validateData = $request->validate([
            'courier_name' => 'required|unique:couriers,courier_name|max:255',
            'courier_charge' => 'required'
        ]);

        $data = array();
        $data['courier_name'] = $request->courier_name;
        $data['courier_charge'] = $request->courier_charge;
        $data['courier_city'] = $request->courier_city;
        $data['courier_zone'] = $request->courier_zone;
        $data['courier_slug'] = uniqid();
        $data['courier_orderby'] = $request->courier_sorting;
        $data['courier_creator'] = Auth::user()->id;
        $data['created_at'] = Carbon::now();
        $courier = Courier::insert($data);

        if ($courier) {
            $notification = array(
                'message' => 'Courier Added Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Courier Added Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function update(Request $request, $slug)
    {

        $request->validate([
            'courier_name' => 'required|unique:couriers,courier_slug,' . $slug . ',courier_name',
            'courier_charge' => 'required'
        ]);

        $data = array();
        $data['courier_name'] = $request->courier_name;
        $data['courier_charge'] = $request->courier_charge;
        $data['courier_city'] = $request->courier_city;
        $data['courier_zone'] = $request->courier_zone;
        $data['courier_orderby'] = $request->courier_orderby;
        $data['courier_editor'] = Auth::user()->id;
        $data['updated_at'] = Carbon::now();

        $courier = Courier::where('courier_slug', $slug)->update($data);

        if ($courier) {
            $notification = array(
                'message' => 'Courier Update Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Courier Update Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function softdelete($slug)
    {
        $courier = Courier::where('courier_slug', $slug)->update(['courier_status' => 0]);
        if ($courier) {
            $notification = array(
                'message' => 'Courier Delete Successfully',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Courier Update Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function restore($slug)
    {
        $restore = Courier::where('courier_slug', $slug)->update(['courier_status' => 1]);
        if ($restore) {
            $notification = array(
                'message' => 'Courier Restore Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Courier Restore Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function delete($slug)
    {
        $courier = Courier::where('courier_slug', $slug)->delete();
        if ($courier) {
            $notification = array(
                'message' => 'Courier Delete Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Courier Delete Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function active($slug)
    {
        $courier = Courier::where('courier_slug', $slug)->update(['courier_active' => 1]);
        if ($courier) {
            $notification = array(
                'message' => 'Courier Status Active!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Courier Update Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function deactive($slug)
    {
        $courier = Courier::where('courier_slug', $slug)->update(['courier_active' => 0]);
        if ($courier) {
            $notification = array(
                'message' => 'Courier Status Inactive!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Courier Update Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }
}
