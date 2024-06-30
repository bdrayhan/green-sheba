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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class CourierZoneController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function index()
    {
        $zones = CourierZone::with('courier', 'city')->where('zone_status', 1)->orderBy('zone_name', 'ASC')->get();
        $couriers = Courier::where('courier_status', 1)->where('courier_active', 1)->orderBy('courier_name', 'ASC')->get();
        return view('backend.courier.zone_all', compact('zones', 'couriers'));
    }


    public function getCity($id)
    {
        $courierCities = CourierCity::where('id', $id)->where('cc_status', 1)->get();
        if ($courierCities->count() >= 1) {
            foreach ($courierCities as $city) {
                $cities[] = City::where('id', $city->id)->get();
            }
            return Response::json([
                'cities' => $cities
            ]);
        }else{
            return Response::json([
                'cities' => 0
            ]);
        }
    }

    public function create()
    {
        //
    }

    public function insert(Request $request)
    {
        $validateData = $request->validate([
            'id' => 'required',
            'id' => 'required|max:255',
            'zone_name' => 'required|max:255',
        ]);

        $data = array();
        $data['id'] = $request->id;
        $data['id'] = $request->id;
        $data['zone_name'] = $request->zone_name;
        $data['zone_slug'] = uniqid();
        $data['zone_orderby'] = $request->zone_sorting;
        $data['zone_creator'] = Auth::user()->id;
        $data['created_at'] = Carbon::now();
        $zone = CourierZone::insert($data);

        if ($zone) {
            $notification = array(
                'message' => 'Zone Added Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Zone Added Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
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
        $validateData = $request->validate([
            'id' => 'required',
            'id' => 'required',
            'zone_name' => 'required|max:255',
        ]);

        $data = array();
        $data['id'] = $request->id;
        $data['id'] = $request->id;
        $data['zone_name'] = $request->zone_name;
        $data['zone_orderby'] = $request->zone_sorting;
        $data['updated_at'] = Carbon::now();
        $zone = CourierZone::where('zone_slug', $slug)->update($data);

        if ($zone) {
            $notification = array(
                'message' => 'Zone Update Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Zone Update Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function softdelete($slug)
    {
        $softDelete = CourierZone::where('zone_slug', $slug)->update(['zone_status' => 0]);
        if ($softDelete) {
            $notification = array(
                'message' => 'Courier Zone Delete Successfully',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Courier Zone Update Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function restore($slug)
    {
        $restore = CourierZone::where('zone_slug', $slug)->update(['zone_status' => 1]);
        if ($restore) {
            $notification = array(
                'message' => 'Courier Zone Restore Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Courier Zone Restore Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function delete($slug)
    {
        $delete = CourierZone::where('zone_slug', $slug)->delete();
        if ($delete) {
            $notification = array(
                'message' => 'Zone Delete Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Zone Delete Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function active($slug)
    {
        $zone = CourierZone::where('zone_slug', $slug)->update(['zone_active' => 1]);

        if ($zone) {
            $notification = array(
                'message' => 'Zone Status Active!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Zone Update Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function deactive($slug)
    {
        $zone = CourierZone::where('zone_slug', $slug)->update(['zone_active' => 0]);

        if ($zone) {
            $notification = array(
                'message' => 'Zone Status Inactive!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Zone Update Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }
}
