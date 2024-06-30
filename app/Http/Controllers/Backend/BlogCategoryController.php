<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function index()
    {
        $blog_categories = BlogCategory::where('bc_status', 1)->orderBy('bc_name', 'ASC')->get();
        return view('backend.blog.category.index', compact('blog_categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bc_name' => 'required|unique:blog_categories,bc_name',
            'bc_url' => 'required|unique:blog_categories,bc_url',
        ]);

        $data = array();
        $data['bc_name'] = $request->bc_name;
        $data['bc_url'] = Str::slug($request->bc_url, '-');
        $data['bc_orderby'] = $request->bc_orderby;
        $data['bc_remark'] = $request->bc_remark;
        $data['bc_creator'] = Auth::id();
        $data['bc_slug'] = uniqid();

        $create = BlogCategory::create($data);
        if ($create) {
            $notification = array(
                'message' => 'Category Create Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Category Create Failed!',
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
        $request->validate([
            'bc_name' => 'required|unique:blog_categories,bc_slug,' . $slug . ',bc_name',
            'bc_url' => 'required|unique:blog_categories,bc_slug,' . $slug . ',bc_url',
        ]);

        $data = array();
        $data['bc_name'] = $request->bc_name;
        $data['bc_url'] = $request->bc_url;
        $data['bc_orderby'] = $request->bc_orderby;
        $data['bc_remark'] = $request->bc_remark;

        $update = BlogCategory::where('bc_slug', $slug)->update($data);
        if ($update) {
            $notification = array(
                'message' => 'Blog Category Update Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Blog Category Update Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function softdelete($slug)
    {
        $delete = BlogCategory::where('bc_slug', $slug)->update(['bc_status' => 0]);
        if ($delete) {
            $notification = array(
                'message' => 'Blog Category Delete Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Blog Category Delete Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function restore($slug)
    {
        $delete = BlogCategory::where('bc_slug', $slug)->update(['bc_status' => 1]);
        if ($delete) {
            $notification = array(
                'message' => 'Blog Category Restore Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Blog Category Restore Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function delete($slug)
    {
        return $slug;

        // $delete = BlogCategory::where('bc_slug', $slug)->delete();
        // if ($delete) {
        //     $notification = array(
        //         'message' => 'Blog Category Delete Successfully!',
        //         'alert-type' => 'success',
        //     ); // returns Notification,
        //     return redirect()->back()->with($notification);
        // } else {
        //     $notification = array(
        //         'message' => 'Blog Category Delete Failed!',
        //         'alert-type' => 'error',
        //     ); // returns Notification,
        //     return redirect()->back()->with($notification);
        // }
    }

    public function active($slug)
    {
        $status = BlogCategory::where('bc_slug', $slug)->update(['bc_active' => 1]);
        if ($status) {
            $notification = array(
                'message' => 'Blog Category Status Active!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Blog Category Status Update Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function deactive($slug)
    {
        $status = BlogCategory::where('bc_slug', $slug)->update(['bc_active' => 0]);
        if ($status) {
            $notification = array(
                'message' => 'Blog Category Status Inactive!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Blog Category Status Update Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function mulipleDelete(Request $request)
    {
        if ($request->ids) {
            foreach ($request->ids as $id) {
                $post = BlogCategory::where('bc_id', $id)->delete();
                $response['status'] = 'success';
                $response['message'] = 'Successfully Delete Blog Post';
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Unsuccessful to Delete Blog Post';
        }
        return response()->json($response, 201);
    }
}
