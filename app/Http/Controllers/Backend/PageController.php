<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function index()
    {
        $pages = Page::orderBy('id', 'ASC')->get();
        return view('backend.page.index', compact('pages'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'page_name' => 'required|unique:pages,page_name',
            'page_url' => 'required|unique:pages,page_url',
        ]);

        $data = array();
        $data['page_name'] = $request->page_name;
        $data['page_slug'] = uniqid();
        $data['page_url'] = Str::slug($request->page_url, '-');
        $data['page_content'] = $request->page_content;
        $data['page_creator'] = Auth::user()->id;

        $page = Page::create($data);
        if ($page) {
            $notification = array(
                'message' => 'Page Create Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'Page Create Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);
    }

    public function edit($slug)
    {
        $page = Page::where('page_slug', $slug)->firstOrFail();
        return view('backend.page.edit', compact('page'));
    }

    public function update(Request $request, $slug)
    {
        $validateData = $request->validate([
            'page_name' => 'required|unique:pages,page_slug,' . $slug . ',page_name',
            'page_url' => 'required|unique:pages,page_slug,' . $slug . ',page_url',
        ]);

        $data = array();
        $data['page_name'] = $request->page_name;
        $data['page_url'] = Str::slug($request->page_url, '-');
        $data['page_content'] = $request->page_content;
        $data['page_editor'] = Auth::user()->id;

        $page = Page::where('page_slug', $slug)->update($data);
        if ($page) {
            $notification = array(
                'message' => 'Page Update Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->route('admin.page.index')->with($notification);
        } else {
            $notification = array(
                'message' => 'Page Update Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function destroy($slug)
    {
        $delete = Page::where('page_slug', $slug)->delete();
        if ($delete) {
            $notification = array(
                'message' => 'Page Delete Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Page Delete Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function active($slug)
    {
        $page = Page::where('page_slug', $slug)->update(['page_status' => 1]);
        if ($page) {
            $notification = array(
                'message' => 'Page Status Active!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Page Status Update Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function deactive($slug)
    {
        $page = Page::where('page_slug', $slug)->update(['page_status' => 0]);
        if ($page) {
            $notification = array(
                'message' => 'Page Status Inactive!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Page Status Update Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }
}
