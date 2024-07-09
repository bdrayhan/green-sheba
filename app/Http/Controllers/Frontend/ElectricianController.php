<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Division;
use App\Models\Electrician;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ElectricianController extends Controller
{
    public function index(){
        $divisions=Division::orderBy('id' , 'DESC')->get();
        return view('frontend.pages.electrician.home',compact('divisions'));
    }

    public function insert(Request $request){
        // $this->validate($request,[

        // ]);

        $slug='E'.uniqid('11');
        $insert=Electrician::insert([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'date_of_birth'=>$request->date_of_birth,
            'nid_number'=>$request->nid_number,
            'electrician_category'=>$request->category,
            'address'=>$request->address,
            'fb_account'=>$request->fb_account,
            'slug'=>$slug,
        ]);

        if($insert){
            Session::flash('success','Successfully! add electrician');
            return redirect('electrician/registration');
        }else{
            Session::flash('success','Successfully! add electrician');
            return redirect('electrician/registration');
        }
    }


    public function registration(){
        $divisions=Division::orderBy('id' , 'DESC')->get();
        return view('frontend.pages.electrician.register',compact('divisions'));
    }

    public function profile(){
        return view('frontend.pages.electrician.profile');
    }

    public function customer(){
        return view('frontend.pages.customer.dashboard');
    }
}
