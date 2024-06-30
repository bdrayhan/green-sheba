<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductSizeController extends Controller
{

    public function index()
    {
        $sizes = ProductSize::where('size_status', 1)->orderby('size_name', 'ASC')->get();
        return view('backend.product_size.index', compact('sizes'));
    }

    public function create()
    {
        //
    }

    public function insert(Request $request)
    {
        $request->validate([
            'size_name' => 'required|unique:sizes,size_name',
        ]);

        $insert = ProductSize::insert([
            'size_name' => $request->size_name,
            'size_remarks' => $request->size_remarks,
            'size_orderby' => $request->size_orderby,
            'size_slug' => uniqid(),
            'created_at' => Carbon::now(),
        ]);

        if ($insert) {
            $notification = array(
                'message' => 'Product Sizes Inserted!',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'Product Sizes Inserted Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);
    }

    public function show($slug)
    {
        //
    }

    public function edit($slug)
    {
        //
    }

    public function update(Request $request, $slug)
    {
        $request->validate([
            'size_name' => 'required|unique:sizes,size_slug,' . $slug . ',size_name',
        ]);

        $color = ProductSize::where('size_slug', $slug)->update([
            'size_name' => $request->size_name,
            'size_orderby' => $request->size_orderby,
        ]);

        if ($color) {
            $notification = array(
                'message' => 'Product Size Update!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Product Size Update Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function softdelete($slug)
    {
        $softdelete = ProductSize::where('size_slug', $slug)->update(['size_status' => 0]);
        if ($softdelete) {
            $notification = array(
                'message' => 'Product Size Deleted',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'Product Size Delete Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);
    }

    public function restore($slug)
    {
        $restore = ProductSize::where('size_slug', $slug)->update(['size_status' => 1]);
        if ($restore) {
            $notification = array(
                'message' => 'Product Size Restore',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Product Size Restore Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function delete($slug)
    {
        $delete = ProductSize::where('size_slug', $slug)->delete();
        if (!$delete) {
            abort(404);
        } else {
            $notification = array(
                'message' => 'Product Size Deleted',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }


    public function mulipleDelete(Request $request)
    {
        if ($request->ids) {
            foreach ($request->ids as $id) {
                ProductSize::where('id', $id)->delete();
                $response['status'] = 'success';
                $response['message'] = 'Successfully Delete Size';
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Unsuccessful to Delete Size';
        }
        return response()->json($response, 201);
    }
}
