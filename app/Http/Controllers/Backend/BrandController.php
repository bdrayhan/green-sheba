<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class BrandController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function index()
    {
        $brands = Brand::where('brand_status', 1)->orderBy('brand_orderby', 'ASC')->get();
        return view('backend.brand.index', compact('brands'));
    }

    public function create()
    {
        //
    }

    public function insert(Request $request)
    {
        $validateData = $request->validate([
            'brand_name' => 'required|unique:brands,brand_name|max:255',
            'brand_image' => 'required|mimes:png,jpg'
        ]);

        if ($request->brand_feature == 1) {
            $feature = 1;
        } else {
            $feature = 0;
        }
        $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['brand_slug'] = uniqid();
        $data['brand_orderby'] = $request->brand_orderby;
        $data['brand_remarks'] = $request->brand_remarks;
        $data['brand_feature'] = $feature;
        $data['brand_url'] = Str::slug($request->brand_url, '-');
        $data['brand_creator'] = Auth::user()->id;
        // Brand Image Upload
        if ($request->hasFile('brand_image')) {
            $image = $request->file('brand_image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('media/brand/' . $image_name);
            $data['brand_image'] = 'media/brand/' . $image_name;
        }
        $data['created_at'] = Carbon::now();

        $brand = Brand::insert($data);

        if ($brand) {
            $notification = array(
                'message' => 'Brand Added Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Brand Added Failed!',
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
            'brand_name' => 'required|unique:brands,brand_slug,' . $slug . ',brand_name',
        ]);
        if ($request->brand_feature == 1) {
            $feature = 1;
        } else {
            $feature = 0;
        }
        $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['brand_orderby'] = $request->brand_orderby;
        $data['brand_remarks'] = $request->brand_remarks;
        $data['brand_feature'] = $feature;
        $data['brand_url'] = Str::slug($request->brand_url, '-');
        $data['brand_editor'] = Auth::user()->id;

        // Image Upload
        if ($request->hasFile('brand_image')) {
            if (File::exists($request->old_image)) {
                File::delete($request->old_image);
            }
            $image = $request->file('brand_image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('media/brand/' . $image_name);
            $data['brand_image'] = 'media/brand/' . $image_name;
        }
        $data['updated_at'] = Carbon::now();

        $brand = Brand::where('brand_slug', $slug)->update($data);

        if ($brand) {
            $notification = array(
                'message' => 'Brand Update Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Brand Update Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function softdelete($slug)
    {
        $softDelete = Brand::where('brand_slug', $slug)->update(['brand_status' => 0]);

        if ($softDelete) {
            $notification = array(
                'message' => 'Brand Delete Successfully',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Brand Update Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function restore($slug)
    {
        $restore = Brand::where('brand_slug', $slug)->update(['brand_status' => 1]);
        if ($restore) {
            $notification = array(
                'message' => 'Brand Restore Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Brand Restore Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function delete($slug)
    {
        // Get Single Brand Data
        $brand = Brand::where('brand_slug', $slug)->firstOrFail();
        // Brand Images Delete
        if (File::exists($brand->brand_image)) {
            File::delete($brand->brand_image);
        }
        // Brand Delete
        $delete = Brand::where('brand_slug', $slug)->delete();

        if ($delete) {
            $notification = array(
                'message' => 'Brand Delete Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Brand Delete Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function active($slug)
    {
        $brand = Brand::where('brand_slug', $slug)->update(['brand_active' => 1]);
        if ($brand) {
            $notification = array(
                'message' => 'Brand Status Updated!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Brand Update Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function deactive($slug)
    {
        $brand = Brand::where('brand_slug', $slug)->update(['brand_active' => 0]);
        if ($brand) {
            $notification = array(
                'message' => 'Brand Status Updated!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Brand Update Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function mulipleDelete(Request $request)
    {
        if ($request->ids) {
            foreach ($request->ids as $id) {
                $brand = Brand::where('id', $id)->firstOrFail();
                // brand Image Delete
                if (File::exists($brand->brand_image)) {
                    File::delete($brand->brand_image);
                }
                // brand Delete
                Brand::where('id', $brand->id)->delete();
                $response['status'] = 'success';
                $response['message'] = 'Successfully Delete brand';
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Unsuccessful to Delete brand';
        }
        return response()->json($response, 201);
    }
}
