<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\StaticBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class StaticBannerController extends Controller
{
    public function index()
    {
        $staticBanner = StaticBanner::all();
        return view('backend.staticBanner.index', compact('staticBanner'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'sb_banner_type' => 'required',
            'sb_title' => 'required',
            'sb_sub_title' => 'required',
        ]);

        // Static Banner Image Upload
        if ($request->sb_banner_type == 'header') {
            if ($request->hasFile('header_image')) {
                $image = $request->file('header_image');
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                Image::make($image)->save('media/staticBanner/headerBanner/' . $image_name);
                $staticImage = 'media/staticBanner/headerBanner/' . $image_name;
            }
        } else {
            if ($request->hasFile('footer_image')) {
                $image = $request->file('footer_image');
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                Image::make($image)->save('media/staticBanner/footerBanner/' . $image_name);
                $staticImage = 'media/staticBanner/footerBanner/' . $image_name;
            }
        }

        $banner = new StaticBanner();
        $banner->sb_banner_type = $request->sb_banner_type;
        $banner->sb_title = $request->sb_title;
        $banner->sb_sub_title = $request->sb_sub_title;
        $banner->sb_button_url = $request->sb_button_url;
        $banner->sb_image = $staticImage;
        $banner->sb_slug = uniqid();
        $banner->sb_status = 1;
        $banner->save();

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

    public function edit($slug)
    {
        $banner = StaticBanner::where('sb_slug', $slug)->firstOrFail();
        return view('backend.staticBanner.edit', compact('banner'));
    }
    public function update(Request $request, $slug)
    {
        // return $request->all();
        $this->validate($request, [
            'sb_banner_type' => 'required',
            'sb_title' => 'required',
            'sb_sub_title' => 'required',
        ]);

        // Static Banner Image Upload
        if ($request->sb_banner_type == 'header') {
            if ($request->hasFile('header_image')) {
                if (File::exists($request->old_image)) {
                    File::delete($request->old_image);
                }
                $image = $request->file('header_image');
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                Image::make($image)->save('media/staticBanner/headerBanner/' . $image_name);
                $staticImage = 'media/staticBanner/headerBanner/' . $image_name;
            }
        } else {
            if ($request->hasFile('footer_image')) {
                if (File::exists($request->old_image)) {
                    File::delete($request->old_image);
                }
                $image = $request->file('footer_image');
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                Image::make($image)->save('media/staticBanner/footerBanner/' . $image_name);
                $staticImage = 'media/staticBanner/footerBanner/' . $image_name;
            }
        }

        $banner = StaticBanner::where('sb_slug', $slug)->update([
            'sb_banner_type' => $request->sb_banner_type,
            'sb_title' => $request->sb_title,
            'sb_sub_title' => $request->sb_sub_title,
            'sb_button_url' => $request->sb_button_url,
            'sb_image' => $staticImage ?? $request->old_image,
            'sb_status' => 1,
        ]);

        if ($banner) {
            $notification = array(
                'message' => 'Banner Update Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'Banner Update Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);
    }


    public function delete($slug)
    {
        $banner = StaticBanner::where('sb_slug', $slug)->firstOrFail();
        // Product Image Delete
        if (File::exists($banner->sb_image)) {
            File::delete($banner->sb_image);
        }
        // Product Delete
        $banner = StaticBanner::where('sb_slug', $slug)->delete();
        if ($banner) {
            $notification = array(
                'message' => 'Banner Delete Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'Banner Delete Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);
    }
}
