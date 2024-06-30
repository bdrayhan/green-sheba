<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SupportMessage;
use Illuminate\Http\Request;

class SupportMessageController extends Controller
{
    public function index()
    {
        $supportMessage = SupportMessage::orderby('id', 'DESC')->get();
        return view('backend.support-message.index', compact('supportMessage'));
    }

    public function show($slug)
    {
        $support = SupportMessage::where('support_slug', $slug)->update([
            'support_seen' => 1,
        ]);
        if (!$support) {
            abort(404);
        }
        $supportInfo = SupportMessage::where('support_slug', $slug)->firstOrFail();

        return view('backend.support-message.show', compact('supportInfo'));
    }

    public function delete($slug)
    {
        $support = SupportMessage::where('support_slug', $slug)->delete();

        if ($support) {
            $notification = array(
                'message' => 'Support Message Deleted Successfully!',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'Support Message Delete Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);
    }
}
