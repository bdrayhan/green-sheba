<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function index()
    {
        $blogs = Post::where("post_status", 1)->with('postcat')->get();
        $categories = BlogCategory::orderBy("bc_name", "ASC")->get();
        return view('backend.blog.index', compact('blogs', 'categories'));
    }

    public function create()
    {
        //
    }

    public function insert(Request $request)
    {
        $validateData = $request->validate([
            'post_title' => 'required|unique:posts,post_title|max:255',
            'bc_id' => 'required',
            'post_url' => 'required',
            'post_short_details' => 'required',
            'post_feature_image' => 'required|mimes:png,jpg'
        ]);

        $data = array();
        $data['post_title'] = $request->post_title;
        $data['bc_id'] = $request->bc_id;
        $data['id'] = $request->id;
        $data['post_short_details'] = $request->post_short_details;
        $data['post_details'] = $request->post_details;
        $data['post_url'] = Str::slug($request->post_url, '-');
        $data['post_slug'] = uniqid();

        // Blog Image Upload
        if ($request->hasFile('post_feature_image')) {
            $image = $request->file('post_feature_image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('media/blog/' . $image_name);
            $data['post_feature_image'] = 'media/blog/' . $image_name;
        }
        $data['created_at'] = Carbon::now();

        $insert = Post::insert($data);

        if ($insert) {
            $notification = array(
                'message' => 'Post Added Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Post Added Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function show($slug)
    {
        //
    }

    public function edit($slug)
    {
        $post = Post::where("post_slug", $slug)->with('postcat')->firstOrFail();
        $categories = BlogCategory::orderBy("bc_name", "ASC")->get();
        return view('backend.blog.edit', compact('post', 'categories'));
    }

    public function update(Request $request, $slug)
    {
        $validateData = $request->validate([
            'post_title' => 'required|unique:posts,post_slug,' . $slug . ',post_title',
            'bc_id' => 'required',
            'post_url' => 'required',
            'post_short_details' => 'required',
        ]);

        $data = array();
        $data['post_title'] = $request->post_title;
        $data['bc_id'] = $request->bc_id;
        $data['post_short_details'] = $request->post_short_details;
        $data['post_details'] = $request->post_details;
        $data['post_url'] = Str::slug($request->post_url, '-');

        // Blog Image Upload
        if ($request->hasFile('post_feature_image')) {
            if (File::exists($request->old_image)) {
                File::delete($request->old_image);
            }
            $image = $request->file('post_feature_image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('media/blog/' . $image_name);
            $data['post_feature_image'] = 'media/blog/' . $image_name;
        }
        $data['updated_at'] = Carbon::now();
        $update = Post::where('post_slug', $slug)->update($data);
        if ($update) {
            $notification = array(
                'message' => 'Post Updated Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->route('admin.blog.index')->with($notification);
        } else {
            $notification = array(
                'message' => 'Post Updated Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->route('admin.blog.index')->with($notification);
        }
    }

    public function softdelete($slug)
    {
        $softdelete = Post::where('post_slug', $slug)->update(['post_status' => 0]);
        if ($softdelete) {
            $notification = array(
                'message' => 'Post Delete Successfully',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Post Delete Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function delete($slug)
    {
        //
    }

    public function active($slug)
    {
        $post = Post::where('post_slug', $slug)->update(['post_active' => 1]);
        if ($post) {
            $notification = array(
                'message' => 'Post Status Updated!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Post Update Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function deactive($slug)
    {
        $post = Post::where('post_slug', $slug)->update(['post_active' => 0]);
        if ($post) {
            $notification = array(
                'message' => 'Post Status Updated!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Post Update Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function mulipleDelete(Request $request)
    {
        if ($request->ids) {
            foreach ($request->ids as $id) {
                $post = Post::where('post_id', $id)->firstOrFail();
                // post Image Delete
                if (File::exists($post->post_feature_image)) {
                    File::delete($post->post_feature_image);
                }
                // post Delete
                Post::where('post_id', $post->post_id)->delete();
                $response['status'] = 'success';
                $response['message'] = 'Successfully Delete Post';
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Unsuccessful to Delete Post';
        }
        return response()->json($response, 201);
    }
}
