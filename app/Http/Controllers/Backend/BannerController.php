<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class BannerController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function index()
    {
        $banners = Banner::orderBy('banner_sorting', 'ASC')->get();
        return view('backend.banner.index', compact('banners'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'banner_title' => 'required|max:255',
            'banner_image' => 'required|mimes:png,jpg'
        ]);

        $data = array();
        $data['banner_title'] = $request->banner_title;
        $data['banner_slug'] = uniqid();
        $data['banner_mid_title'] = $request->banner_mid_title;
        $data['banner_sub_title'] = $request->banner_sub_title;
        $data['banner_button'] = $request->banner_button;
        $data['banner_sorting'] = $request->banner_sorting;
        $data['banner_url'] = $request->banner_url;
        $data['banner_creator'] = Auth::user()->id;

        // Image Upload
        if ($request->hasFile('banner_image')) {
            $image = $request->file('banner_image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('media/banner/' . $image_name);
            $data['banner_image'] = 'media/banner/' . $image_name;
        }

        $data['created_at'] = Carbon::now();
        $banner = Banner::insert($data);

        if ($banner) {
            $notification = array(
                'message' => 'Banner Added Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'Banner Added Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);
    }

    public function update(Request $request, $slug)
    {
        $validateData = $request->validate([
            'banner_title' => 'required|max:255',
        ]);

        $data = array();
        $data['banner_title'] = $request->banner_title;
        $data['banner_mid_title'] = $request->banner_mid_title;
        $data['banner_sub_title'] = $request->banner_sub_title;
        $data['banner_button'] = $request->banner_button;
        $data['banner_sorting'] = $request->banner_sorting;
        $data['banner_publish'] = $request->banner_publish;
        $data['banner_url'] = $request->banner_url;
        $data['banner_editor'] = Auth::user()->id;

        // Banner Image Upload
        if ($request->hasFile('banner_image')) {
            if (File::exists($request->old_image)) {
                File::delete($request->old_image);
            }
            $image = $request->file('banner_image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('media/banner/' . $image_name);
            $data['banner_image'] = 'media/banner/' . $image_name;
        } else {
            $data['banner_image'] = $request->old_image;
        }


        $data['updated_at'] = Carbon::now();
        $banner = Banner::where('banner_slug', $slug)->update($data);

        if ($banner) {
            $notification = array(
                'message' => 'Banner Update Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Banner Update Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function destroy($slug)
    {
        // Get Single Banner Data
        $banner = Banner::where('banner_slug', $slug)->firstOrFail();

        // Banner Images Delete
        if (File::exists($banner->banner_image)) {
            File::delete($banner->banner_image);
        }
        $delete  = $banner->delete();

        if ($delete) {
            $notification = array(
                'message' => 'Banner Delete Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Banner Delete Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function active($slug)
    {
        $banner = Banner::where('banner_slug', $slug)->update(['banner_status' => 1]);
        if ($banner) {
            $notification = array(
                'message' => 'Banner Status Updated!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Banner Update Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function deactive($slug)
    {
        $banner = Banner::where('banner_slug', $slug)->update(['banner_status' => 0]);
        if ($banner) {
            $notification = array(
                'message' => 'Banner Status Updated!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Banner Update Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function mulipleDelete(Request $request)
    {
        if ($request->ids) {
            foreach ($request->ids as $id) {
                $banner = Banner::where('id', $id)->firstOrFail();
                // Banner Image Delete
                if (File::exists($banner->banner_image)) {
                    File::delete($banner->banner_image);
                }
                // Banner Delete
                Banner::where('id', $banner->id)->delete();
                $response['status'] = 'success';
                $response['message'] = 'Successfully Delete Banner';
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Unsuccessful to Delete Banner';
        }
        return response()->json($response, 201);
    }
}
