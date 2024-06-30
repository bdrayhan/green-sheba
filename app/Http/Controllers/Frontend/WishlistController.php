<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::with('product')->where('user_id', Auth::id())->paginate(8);
        // return $wishlists;
        return view('frontend.pages.wishlist.index', compact('wishlists'));
    }

    public function insert(Request $request)
    {
        // $data = $request->id;
        if ($request->ajax()) {
            $product_id = $request->id;
            if (Auth::check()) {
                $user_id = Auth::id();
                if (Wishlist::where('product_id', $product_id)->where('user_id', $user_id)->exists()) {
                    return response()->json(['error' => 'Already Added']);
                } else {
                    $wishlist = Wishlist::create([
                        'product_id' => $product_id,
                        'user_id' => $user_id,
                        'wishlist_date' => Carbon::now()->format('d-m-Y'),
                    ]);
                    return response()->json(['success' => 'Added to Wishlist']);
                }
            } else {
                return response()->json(['error' => 'Login First']);
            }


            // return response()->json($wishlist);
        }
    }

    public function delete($id)
    {
        $user_id = Auth::id();
        $delete = Wishlist::where('id', $id)->where('user_id', $user_id)->delete();
        if ($delete) {
            $notification = array(
                'message' => 'Product Remove Form Wishlist!',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => ' Fail To Remove!',
                'alert-type' => 'error',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);
    }
}
