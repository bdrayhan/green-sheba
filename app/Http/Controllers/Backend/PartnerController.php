<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image; 

class PartnerController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }
        //partner request 
    public function request_partner()
    {
        $partners = Partner::where('partner_status',0)->orderBy('partner_sorting', 'ASC')->get();
        return view('backend.partner.request.index', compact('partners'));
    }

    public function request_profile($slug){
        $data = Partner::where('partner_status',0)->where('partner_slug',$slug)->firstOrFail();
        return view('backend.partner.profile', compact('data'));
    }

    public function request_edit($slug){
        $data = Partner::where('partner_status',0)->where('partner_slug',$slug)->firstOrFail();
        return view('backend.partner.request.edit', compact('data'));
    }

    public function index()
    {
        $partners = Partner::where('partner_status',1)->orderBy('partner_sorting', 'ASC')->get();
        return view('backend.partner.index', compact('partners'));
    }
    public function profile($slug)
    {
        $data = Partner::where('partner_status',1)->where('partner_slug',$slug)->firstOrFail();
        return view('backend.partner.profile', compact('data'));
    }
    public function edit($slug)
    {
        $data = Partner::where('partner_status',1)->where('partner_slug',$slug)->firstOrFail();
        return view('backend.partner.request.edit', compact('data'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'partner_title' => 'required|max:255',
            'partner_logo' => 'required|mimes:png,jpg'
        ]);

        $data = array();
        $data['partner_title'] = $request->partner_title;
        $data['partner_slug'] = uniqid();
        $data['partner_sorting'] = $request->partner_sorting;
        $data['partner_url'] = $request->partner_url;
        $data['partner_creator'] = Auth::user()->id;

        // Image Upload
        if ($request->hasFile('partner_logo')) {
            $image = $request->file('partner_logo');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('media/partner/' . $image_name);
            $data['partner_logo'] = 'media/partner/' . $image_name;
        }

        $data['created_at'] = Carbon::now();
        $partner = Partner::insert($data);

        if ($partner) {
            $notification = array(
                'message' => 'Partner Added Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Partner Added Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $slug)
    {
        $validateData = $request->validate([
            'partner_title' => 'required|max:255',
        ]);

        $data = array();
        $data['partner_title'] = $request->partner_title;
        $data['partner_slug'] = uniqid();
        $data['partner_sorting'] = $request->partner_sorting;
        $data['partner_url'] = $request->partner_url;
        $data['partner_editor'] = Auth::user()->id;

        // Image Upload
        if ($request->hasFile('partner_logo')) {
            if (File::exists($request->old_image)) {
                File::delete($request->old_image);
            }
            $image = $request->file('partner_logo');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('media/partner/' . $image_name);
            $data['partner_logo'] = 'media/partner/' . $image_name;
        }

        $data['updated_at'] = Carbon::now();
        $partner = Partner::where('partner_slug', $slug)->update($data);

        if ($partner) {
            $notification = array(
                'message' => 'Partner Update Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Partner Update Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function destroy($slug)
    {
        // Get Single Partner Data
        $partner = Partner::where('partner_slug', $slug)->firstOrFail();

        // Partner Images Delete
        if (File::exists($partner->partner_logo)) {
            File::delete($partner->partner_logo);
        }

        $delete  = $partner->delete();

        if ($delete) {
            $notification = array(
                'message' => 'Partner Delete Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Partner Delete Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function active($slug)
    {
        $partner = Partner::where('partner_slug', $slug)->update(['partner_status' => 1]);
        if ($partner) {
            $notification = array(
                'message' => 'Partner Status Updated!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Partner Update Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function deactive($slug)
    {
        $partner = Partner::where('partner_slug', $slug)->firstOrFail();
        $partner->update(['partner_status' => 0]);
        if ($partner) {
            $notification = array(
                'message' => 'Partner Status Updated!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Partner Update Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }

    public function mulipleDelete(Request $request)
    {
        if ($request->ids) {
            foreach ($request->ids as $id) {
                $partner = Partner::where('id', $id)->firstOrFail();
                // partner$partner Image Delete
                if (File::exists($partner->partner_logo)) {
                    File::delete($partner->partner_logo);
                }
                // partner$partner Delete
                Partner::where('id', $partner->id)->delete();
                $response['status'] = 'success';
                $response['message'] = 'Successfully Delete partner';
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Unsuccessful to Delete partner';
        }
        return response()->json($response, 201);
    }
}
