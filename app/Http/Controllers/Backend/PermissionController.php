<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth', 'role:Super Admin']);
    }

    public function index()
    {
        $roles = Role::with('permissions')->get();
        return view('backend.permission.index', compact('roles'));
    }

    public function edit($id)
    {
        $role = Role::where('id', $id)->firstOrFail();
        $permissions = Permission::all();
        return view('backend.permission.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, $id)
    {

        $role = Role::where('id', $id)->firstOrFail();
        $role->syncPermissions($request->role_permission);

        if ($role) {
            $notification = array(
                'message' => 'Role Permission Updated!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->route('admin.permission.index')->with($notification);
        } else {
            $notification = array(
                'message' => 'Role Permission Update Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }
}
