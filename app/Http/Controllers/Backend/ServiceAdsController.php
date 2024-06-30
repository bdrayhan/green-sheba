<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ServiceAds;
use Illuminate\Http\Request;

class ServiceAdsController extends Controller
{
    public function index()
    {
        $serviceAds = ServiceAds::all();
        return view('backend.service-ads.index', compact('serviceAds'));
    }

    public function create()
    {
        # code...
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'sa_icon' => 'required',
            'sa_title' => 'required',
            'sa_sub_title' => 'required',
        ]);

        $serviceAds = new ServiceAds();
        $serviceAds->sa_icon = $request->sa_icon;
        $serviceAds->sa_title = $request->sa_title;
        $serviceAds->sa_sub_title = $request->sa_sub_title;
        $serviceAds->sa_slug = uniqid();
        $serviceAds->save();

        if ($serviceAds) {
            $notification = array(
                'message' => 'Service Ads Added Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'Service Ads Added Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);
    }

    public function update(Request $request, $slug)
    {
        $this->validate($request, [
            'sa_icon' => 'required',
            'sa_title' => 'required',
            'sa_sub_title' => 'required',
        ]);

        $serviceAds = ServiceAds::where('sa_slug', $slug)->update([
            'sa_icon' => $request->sa_icon,
            'sa_title' => $request->sa_title,
            'sa_sub_title' => $request->sa_sub_title,
        ]);

        if ($serviceAds) {
            $notification = array(
                'message' => 'Service Ads Updated Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'Service Ads Updated Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);
    }

    public function delete($slug)
    {
        $serviceAds = ServiceAds::where('sa_slug', $slug)->delete();

        if ($serviceAds) {
            $notification = array(
                'message' => 'Service Ads Deleted Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'Service Ads Deleted Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);
    }
}
