<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Courier;
use App\Models\CourierCity;
use App\Models\CourierZone;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CourierCityController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function index()
    {
        $courierCity = CourierCity::with('city')->where('cc_status', 1)->get();
        $couriers = Courier::where('courier_active', 1)->get();
        $cities = City::where('city_status', 1)->get();
        return view('backend.courier.city_all', compact('couriers', 'courierCity', 'cities'));
    }

    public function insert(Request $request)
    {
        $validateData = $request->validate([
            'id' => 'required',
            'id' => 'required',
        ]);

        $data = array();
        $data['id'] = $request->id;
        $data['id'] = $request->id;
        $data['cc_slug'] = uniqid();
        $data['cc_orderby'] = $request->cc_orderby;
        $data['cc_creator'] = Auth::user()->id;
        $data['created_at'] = Carbon::now();
        $city = CourierCity::insert($data);

        if ($city) {
            $notification = array(
                'message' => 'Courier City Added Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Courier City Added Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function update(Request $request, $slug)
    {
        $validateData = $request->validate([
            'id' => 'required',
            'id' => 'required|unique:courier_cities,cc_slug,' . $slug . ',id',
        ]);

        $data = array();
        $data['id'] = $request->id;
        $data['id'] = $request->id;
        $data['cc_orderby'] = $request->cc_orderby;
        $data['updated_at'] = Carbon::now();
        $city = CourierCity::where('cc_slug', $slug)->update($data);

        if ($city) {
            $notification = array(
                'message' => 'City Update Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'City Update Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function delete($slug)
    {
        $city = CourierCity::where('city_slug', $slug)->firstOrFail();
        if ($city->zones) {
            foreach ($city->zones as $zone) {
                $city = CourierZone::find($zone->id)->delete();
            }
        }
        $city->delete();

        if ($city) {
            $notification = array(
                'message' => 'City Delete Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'City Delete Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function softdelete($slug)
    {
        $couriercity = CourierCity::where('cc_slug', $slug)->update(['cc_status' => 0]);
        if ($couriercity) {
            $notification = array(
                'message' => 'Courier City Delete Successfully',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Courier City Update Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function restore($slug)
    {
        $restore = CourierCity::where('cc_slug', $slug)->update(['cc_status' => 1]);
        if ($restore) {
            $notification = array(
                'message' => 'Courier City Restore Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Courier City Restore Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function active($slug)
    {
        $city = CourierCity::where('cc_slug', $slug)->update(['cc_active' => 1]);

        if ($city) {
            $notification = array(
                'message' => 'City Status Active!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'City Update Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function deactive($slug)
    {
        $city = CourierCity::where('cc_slug', $slug)->update(['cc_active' => 0]);

        if ($city) {
            $notification = array(
                'message' => 'City Status Inactive!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'City Update Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }
}
