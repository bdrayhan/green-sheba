<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class CityController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function index()
    {
        $citys = City::where('city_status', 1)->get();
        return view('backend.city.index', compact('citys'));
    }


    public function create()
    {
        //
    }


    public function insert(Request $request)
    {
        $request->validate([
            'city_name' => 'required|unique:cities,city_name|max:255',
        ]);

        $data = array();
        $data['city_name'] = $request->city_name;
        $data['city_remarks'] = $request->city_remarks;
        $data['city_slug'] = uniqid();
        $data['city_orderby'] = $request->city_orderby;
        $data['city_creator'] = Auth::user()->id;
        $city = City::create($data);

        if ($city) {
            $notification = array(
                'message' => 'City Added Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'City Added Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }


    public function update(Request $request, $slug)
    {
        $request->validate([
            'city_name' => 'required|unique:cities,city_slug,' . $slug . ',city_name'
        ]);

        $data = array();
        $data['city_name'] = $request->city_name;
        $data['city_remarks'] = $request->city_remarks;
        $data['city_orderby'] = $request->city_orderby;
        $data['city_editor'] = Auth::user()->id;
        $city = City::where('city_slug', $slug)->update($data);

        if ($city) {
            $notification = array(
                'message' => 'City Updated Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'City Updated Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }


    public function delete($slug)
    {
        $delete = City::where('city_slug', $slug)->delete();
        if ($delete) {
            $notification = array(
                'message' => 'City Permanent Delete Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'City Permanent Delete Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function softdelete($slug)
    {
        $delete = City::where('city_slug', $slug)->update(['city_status' => 0]);
        if ($delete) {
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

    public function restore($slug)
    {
        $restore = City::where('city_slug', $slug)->update(['city_status' => 1]);
        if ($restore) {
            $notification = array(
                'message' => 'City Restore Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'City Restore Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }


    public function mulipleDelete(Request $request)
    {
        if ($request->ids) {
            foreach ($request->ids as $id) {
                // City Delete
                City::where('id', $id)->delete();
                $response['status'] = 'success';
                $response['message'] = 'Successfully Delete City';
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Unsuccessful to Delete City';
        }
        return response()->json($response, 201);
    }
}
