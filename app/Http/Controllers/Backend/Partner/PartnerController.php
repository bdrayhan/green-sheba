<?php

namespace App\Http\Controllers\Backend\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductColor;
use App\Models\ProductGallery;
use App\Models\ProductSize;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Partner;
use App\Models\User;
use Exception;

class PartnerController extends Controller
{

    public function registration_index(){
        return view('partner.registration');
    }


    //partner registration
    public function registration(Request $request){

        DB::transaction(function () use ($request) {

            $request->validate([
                // 'phone'=>'required|unique:partners,phone',
                // 'email'=>'required',
                // 'nid'=>'required|unique:partners,nid',
            ]);

            $slug='P'.uniqid(11);
            $insert=Partner::insert([
                'partner_name'=>$request->name,
                'phone'=>$request->phone,
                'email'=>$request->email,
                'date_of_birth'=>$request->date_of_birth,
                'nid'=>$request->nid_number,
                'address'=>$request->address,
                'partner_slug'=>$slug,
            ]);

            try {
                $data = array();
                $data['name'] = $request->name;
                $data['phone'] = $request->phone;
                $data['email'] = $request->email;
                $data['password'] = Hash::make('12345678');
                $data['slug'] = uniqid();
                // $data['creator'] = Auth::user()->id;
    
                $user = User::create($data);
                $user->assignRole('Manager');
                // return response()->json([
                //     'status' => 'success',
                //     'message' => "User Create Successfully!",
                // ]);
            } catch ( Exception $e) {
                // return response()->json([
                //     'status' => 'error',
                //     'message' => $e->getMessage(),
                // ]);
            }

            if($insert){
                Session::flash('success','Successfully! Registration Partner');
                return redirect()->back();
            }else{
                Session::flash('error','Opps! failed Please try again');
                return redirect()->back();
            }
        });
    }

    public function profile(){
        $data=User::where('status',1)->firstOrFail();
        return view('partner.profile.index',compact('data'));
    }
}
