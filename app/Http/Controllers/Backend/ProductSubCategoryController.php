<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;

class ProductSubCategoryController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function index()
    {
        $data = array();
        $data['categories'] = ProductCategory::where('pc_status', 1)->get();
        $data['subCategories'] = ProductSubCategory::with('procategory')->where('psc_status', 1)->orderBy('psc_name', 'ASC')->get();
        return view('backend.produtSubCategory.index', $data);
    }

    public function insert(Request $request)
    {
        $validateData = $request->validate([
            'psc_name' => 'required|unique:sub_categories,psc_name|max:255',
            'id' => 'required',
        ]);

        $data = array();
        $data['id'] = $request->id;
        $data['psc_name'] = $request->psc_name;
        $data['psc_slug'] = uniqid();
        $data['psc_url'] = Str::slug($request->psc_url, '-');
        $data['psc_orderby'] = $request->psc_orderby;
        $data['psc_remarks'] = $request->psc_remarks;
        $data['psc_creator'] = Auth::user()->id;

        // Image Upload
        if ($request->hasFile('psc_image')) {
            $image = $request->file('psc_image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('media/ProductSubCategory/' . $image_name);
            $data['psc_image'] = 'media/ProductSubCategory/' . $image_name;
        }
        $data['created_at'] = Carbon::now();

        $proCategory = ProductSubCategory::insert($data);

        if ($proCategory) {
            $notification = array(
                'message' => 'Sub Category Added Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Sub Category Added Failed!',
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
            'psc_name' => 'required',
            'id' => 'required',
        ]);

        $data = array();
        $data['id'] = $request->id;
        $data['psc_name'] = $request->psc_name;
        $data['psc_url'] = $request->psc_url;
        $data['psc_orderby'] = $request->psc_orderby;
        $data['psc_remarks'] = $request->psc_remarks;
        $data['psc_editor'] = Auth::user()->id;

        // Image Upload
        if ($request->hasFile('psc_image')) {
            if (File::exists($request->old_image)) {
                File::delete($request->old_image);
            }
            $image = $request->file('psc_image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('media/ProductSubCategory/' . $image_name);
            $data['psc_image'] = 'media/ProductSubCategory/' . $image_name;
        }
        $data['updated_at'] = Carbon::now();

        $proCategory = ProductSubCategory::where('psc_slug', $slug)->update($data);

        if ($proCategory) {
            $notification = array(
                'message' => 'Sub Category Added Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Sub Category Added Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function softdelete($slug)
    {
        $active = ProductSubCategory::where('psc_slug', $slug)->update(['psc_status' => 0]);
        if ($active) {
            $notification = array(
                'message' => 'Sub Category Delete Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Sub Category Delete Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function restore($slug)
    {
        $active = ProductSubCategory::where('psc_slug', $slug)->update(['psc_status' => 1]);
        if ($active) {
            $notification = array(
                'message' => 'Sub Category Restore Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Sub Category Restore Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function delete($slug)
    {
        // Get Single Product Sub Category
        $category = ProductSubCategory::where('psc_slug', $slug)->firstOrFail();
        // Product Sub-Category Images Delete
        if (File::exists($category->psc_image)) {
            File::delete($category->psc_image);
        }
        $delete  = ProductCategory::where('psc_slug', $slug)->delete();
        if ($delete) {
            $notification = array(
                'message' => 'Sub Category Delete Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Sub Category Delete Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function active($slug)
    {
        $active = ProductSubCategory::where('psc_slug', $slug)->update(['psc_active' => 1]);
        if ($active) {
            $notification = array(
                'message' => 'Sub-Category Status Updated!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Sub-Category Update Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function deactive($slug)
    {
        $deactive = ProductSubCategory::where('psc_slug', $slug)->update(['psc_active' => 0]);
        if ($deactive) {
            $notification = array(
                'message' => 'Sub-Category Status Updated!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Sub-Category Update Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }
}
