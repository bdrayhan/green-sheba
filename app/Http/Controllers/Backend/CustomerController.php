<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:Super Admin|Admin']);
    }

    public function index()
    {
        $customers = User::role('Customer')->orderBy('name', "ASC")->get();
        return view('backend.customer.index', compact('customers'));
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'password' => 'required',
        ]);

        $data = array();
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $data['slug'] = uniqid();
        $data['creator'] = Auth::user()->id;

        // Image Upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('media/user/' . $image_name);
            $data['image'] = 'media/user/' . $image_name;
        }
        $user = User::create($data);
        // Assign To Role
        $user->assignRole('Customer');

        if ($user) {
            $notification = array(
                'message' => 'Customer Added Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'Customer Added Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);
    }

    public function update(Request $request, $slug)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,slug,' . $slug . ',email',
            'phone' => 'required|unique:users,slug,' . $slug . ',phone',
        ]);

        // Get Single User Data
        $user = User::where('id', $request->user_id)->firstOrFail();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->editor = Auth::user()->id;

        // Image Update
        if ($request->hasFile('image')) {
            if (File::exists($request->old_image)) {
                File::delete($request->old_image);
            }
            $image = $request->file('image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('media/user/' . $image_name);
            $user->image = 'media/user/' . $image_name;
        }
        // Password Update
        if ($request->password) {
            $user->password = Hash::make($request->password);
        } else {
            $user->password = $user->password;
        }
        $user->update();
        if ($user) {
            $notification = array(
                'message' => 'Customer Updated Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'Customer Updated Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);
    }

    public function destroy($slug)
    {
        // Get Single User Data
        $user = User::where('slug', $slug)->firstOrFail();
        // User Images Delete
        if (File::exists($user->image)) {
            File::delete($user->image);
        }
        $delete  = $user->delete();

        if ($delete) {
            $notification = array(
                'message' => 'Customer Delete Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'Customer Delete Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);
    }

    public function active($slug)
    {
        $user = User::where('slug', $slug)->update(['status' => 1]);
        if ($user) {
            $notification = array(
                'message' => 'Customer Status Active!',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'Customer Status Update Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);
    }

    public function deactive($slug)
    {
        $user = User::where('slug', $slug)->update(['status' => 0]);
        if ($user) {
            $notification = array(
                'message' => 'Customer Status Inactive!',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'Customer Status Update Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);
    }

    public function mulipleDelete(Request $request)
    {
        if ($request->ids) {
            foreach ($request->ids as $id) {
                $user = User::where('id', $id)->firstOrFail();
                // User Image Delete
                if (File::exists($user->image)) {
                    File::delete($user->image);
                }
                // User Delete
                User::where('id', $user->id)->delete();
                $response['status'] = 'success';
                $response['message'] = 'Successfully Delete Customer';
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Unsuccessful to Delete Customer';
        }
        return response()->json($response, 201);
    }
}
