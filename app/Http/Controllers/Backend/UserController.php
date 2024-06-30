<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use Exception;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:Super Admin|Admin']);
    }

    public function index()
    {
        $users = User::role(['Admin', 'Manager', 'User'])->get();
        return view('backend.user.index', compact('users'));
    }

    public function store(UserCreateRequest $request)
    {
        try {
            $data = array();
            $data['name'] = $request->name;
            $data['phone'] = $request->phone;
            $data['email'] = $request->email;
            $data['password'] = Hash::make($request->password);
            $data['slug'] = uniqid();
            $data['creator'] = Auth::user()->id;

            $user = User::create($data);
            $user->assignRole($request->user_role);
            return response()->json([
                'status' => 'success',
                'message' => "User Create Successfully!",
            ]);
        } catch ( Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function edit($id)
    {
        $user = User::where('id', $id)->firstOrFail();
        $user_role = $user->getRoleNames()->first();
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'user_role' => $user_role,
        ]);
    }

    public function update(UserUpdateRequest $request, $id)
    {
        try {
            $user = User::where('id', $id)->firstOrFail();
            $data = array();
            $data['name'] = $request->name;
            $data['phone'] = $request->phone;
            $data['email'] = $request->email;
            $data['editor'] = Auth::user()->id;

            $user->update($data);
            $user->assignRole($request->user_role);
            return response()->json([
                'status' => 'success',
                'message' => "User Update Successfully!",
            ]);
        } catch ( Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }

    }

    public function destroy($slug)
    {
        // Get Single User Data
        $user = User::where('slug', $slug)->firstOrFail();
        // User Images Delete
        if (File::exists($user->image)) {
            File::delete($user->image);
        }
        // Check User Has Order
        if ($user->orders->count() > 0) {
            $notification = array(
                'message' => 'User Has Order!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
        $delete  = $user->delete();

        if ($delete) {
            $notification = array(
                'message' => 'User Delete Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'User Delete Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function active($slug)
    {
        $user = User::where('slug', $slug)->update(['status' => 1]);
        if ($user) {
            $notification = array(
                'message' => 'User Status Active!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'User Status Update Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function deactive($slug)
    {
        $user = User::where('slug', $slug)->update(['status' => 0]);
        if ($user) {
            $notification = array(
                'message' => 'User Status Inactive!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'User Status Update Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function onlineActive($slug)
    {
        $user = User::where('slug', $slug)->update(['online_status' => 1]);
        if ($user) {
            $notification = array(
                'message' => 'User Status Active!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'User Status Update Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function onlineDeactive($slug)
    {
        $user = User::where('slug', $slug)->update(['online_status' => 0]);
        if ($user) {
            $notification = array(
                'message' => 'User Online Status Inactive!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'User Online Status Update Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }
}
