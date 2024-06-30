<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProductColor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductColorController extends Controller
{

    public function index()
    {
        $colors = ProductColor::where('color_status', 1)->orderby('color_name', 'ASC')->get();
        return view('backend.product_color.index', compact('colors'));
    }

    public function insert(Request $request)
    {
        $request->validate([
            'color_name' => 'required|unique:colors,color_name',
        ]);
        $color = ProductColor::create([
            'color_name' => $request->color_name,
            'color_code' => $request->color_code,
            'color_url' => Str::slug($request->color_name, '-'),
            'color_slug' => uniqid(),
            'color_orderby' => $request->color_orderby,
            'color_creator' => Auth::user()->id,
        ]);

        if ($color) {
            $notification = array(
                'message' => 'Product Color Insert!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Product Color Insert Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function update(Request $request, $slug)
    {
        // return $request->all();
        $request->validate([
            'color_name' => 'required|unique:colors,color_slug,' . $slug . ',color_name',
        ]);

        $color = ProductColor::where('color_slug', $slug)->update([
            'color_name' => $request->color_name,
            'color_code' => $request->color_code,
            'color_url' => Str::slug($request->color_name, '-'),
            'color_orderby' => $request->color_orderby,
            'color_editor' => Auth::user()->id,
        ]);

        if ($color) {
            $notification = array(
                'message' => 'Product Color Update!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Product Color Update Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function softdelete($slug)
    {
        $softdelete = ProductColor::where('color_slug', $slug)->update(['color_status' => 0]);
        if ($softdelete) {
            $notification = array(
                'message' => 'Product Color Deleted',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'Product Color Delete Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);
    }

    public function restore($slug)
    {
        $restore = ProductColor::where('color_slug', $slug)->update(['color_status' => 1]);
        if ($restore) {
            $notification = array(
                'message' => 'Product Color Restore',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Product Color Restore Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function delete($slug)
    {
        $delete = ProductColor::where('color_slug', $slug)->delete();
        if (!$delete) {
            abort(404);
        } else {
            $notification = array(
                'message' => 'Product Color Deleted',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function active($slug)
    {
        $active = ProductColor::where('color_slug', $slug)->update(['color_active' => 1]);
        if ($active) {
            $notification = array(
                'message' => 'Color Status Updated!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Color Update Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function deactive($slug)
    {
        $deactive = ProductColor::where('color_slug', $slug)->update(['color_active' => 0]);
        if ($deactive) {
            $notification = array(
                'message' => 'Color Status Updated!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Color Update Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function mulipleDelete(Request $request)
    {
        if ($request->ids) {
            foreach ($request->ids as $id) {
                ProductColor::where('id', $id)->delete();
                $response['status'] = 'success';
                $response['message'] = 'Successfully Delete color';
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Unsuccessful to Delete color';
        }
        return response()->json($response, 201);
    }
}
