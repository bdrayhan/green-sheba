<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;

class MediaController extends Controller
{

    public function index()
    {
        $media = Media::where('media_status', 1)->orderby('id', 'DESC')->get();
        return view('backend.media.index', compact('media'));
    }

    public function create()
    {
        //
    }

    public function insert(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:png,jpg',
        ]);

        $image = $request->file('file');
        if (isset($image)) {

            $mediamanager = public_path('/media/mediamanager/');

            if (!is_dir($mediamanager)){
                File::makeDirectory($mediamanager,0777,true);
            }

            $imageName = uniqid() . '.jpg';
            $original = $mediamanager.$imageName;

            Image::make($image)->save($original);

            $media = new Media();
            $media->media_title = $imageName;
            $media->media_url = asset('media/mediamanager/'.$imageName);
            $media->media_creator = Auth::id();
            $media->media_slug = uniqid();
            $result = $media->save();

            if ($result) {
                $response['status'] = 'success';
                $response['message'] = 'Successful to upload image';
                $response['url'] = $imageName;

            } else {
                $response['status'] = 'failed';
                $response['message'] = 'Unsuccessful to upload image';
            }

        }else {
            $response['status'] = 'failed';
            $response['message'] = 'Unsuccessful to upload image';
        }
        return response()->json($response, 201);
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
        //
    }

    public function delete($slug)
    {
        // Get Single Media Data
        $media = Media::where('media_slug', $slug)->firstOrFail();
        // Media Images Delete
        if (File::exists('media/mediamanager/' . $media->media_title)) {
            File::delete('media/mediamanager/' . $media->media_title);
        }
        // Media Delete
        $delete = Media::where('media_slug', $slug)->delete();

        if ($delete) {
            $notification = array(
                'message' => 'Media Delete Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Media Delete Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
            return redirect()->back()->with($notification);
        }
    }


    public function multiDelete(Request $request)
    {
        if($request->ids){
            foreach ($request->ids as $id) {
                $media = Media::where('id',$id)->firstOrFail();
                // Media Images Delete
                if (File::exists('media/mediamanager/' . $media->media_title)) {
                    File::delete('media/mediamanager/' . $media->media_title);
                }
                Media::where('id',$id)->delete();
                $response['status'] = 'success';
                $response['message'] = 'Successfully Delete Product';
            }
        }else {
            $response['status'] = 'failed';
            $response['message'] = 'Unsuccessful to Delete Product';
        }
        return response()->json($response, 201);

    }
}
