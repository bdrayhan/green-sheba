<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{

    public function index()
    {
        $tags = Tag::where('tag_status', 1)->orderby('tag_name', 'ASC')->get();
        return view('backend.tag.index', compact('tags'));
    }

    public function create()
    {
        //
    }

    public function insert(Request $request)
    {
        $request->validate([
            'tag_name' => 'required|unique:tags|max:255',
        ]);
        $insert = Tag::create([
            'tag_name' => $request->tag_name,
            'tag_slug' => uniqid(),
            'tag_order' => $request->tag_order,
            'tag_creator' => now(),
        ]);
        if ($insert) {
            $notification = array(
                'message' => 'Tag Created!',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'Tag Created Failed!',
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
            'tag_name' => 'required|unique:tags,tag_slug,' . $slug . ',tag_name',
        ]);

        $update = Tag::where('tag_slug', $slug)->update([
            'tag_name' => $request->tag_name,
            'tag_order' => $request->tag_order,
            'tag_editor' => now(),
        ]);
        if ($update) {
            $notification = array(
                'message' => 'Tag Updated!',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'Tag Updated Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);
    }

    public function softdelete($slug)
    {
        //
    }

    public function restore($slug)
    {
        //
    }

    public function delete($slug)
    {
        $delete = Tag::where('tag_slug', $slug)->delete();
        if ($delete) {
            $notification = array(
                'message' => 'Tag Delete!',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'Tag Delete Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);
    }

    public function mulipleDelete(Request $request)
    {
        if ($request->ids) {
            foreach ($request->ids as $id) {
                Tag::where('id', $id)->delete();
                $response['status'] = 'success';
                $response['message'] = 'Successfully Delete Tag';
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Unsuccessful to Delete Tag';
        }
        return response()->json($response, 201);
    }
}
