<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Division;
use App\Models\Electrician;
use App\Models\ElectricianCategory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

class ElectricianController extends Controller
{

    public function admin_electrician(){
        return view('backend.electrician.all');
    }
    public function category_index(){
        return view('backend.electrician.category');
    }
    public function category_insert(Request $request){
        $this->validate($request,[

        ],[

        ]);

        $slug='C'.uniqid('11');
        $creator=Auth::user()->id;
        $cat_insert=ElectricianCategory::insert([
            'name'=>$request->category_name,
            'remarks'=>$request->category_remarks,
            'slug'=>$slug,
        ]);
        if($cat_insert){
            Session::flash('success','Successfully! add Category');
            return redirect('admin/electrician/category');
        }else{
            Session::flash('error','Opps! failed try again');
            return redirect('admin/electrician/category');
        }
    }

    public function index(){
        $divisions=Division::orderBy('id' , 'DESC')->get();
        return view('frontend.pages.electrician.home',compact('divisions'));
    }

    public function insert(Request $request){
        $this->validate($request,[
            'first_name'=>'required',
            'phone'=>'required|max:20|unique:electricians,phone',
            'email'=>'required|unique:electricians,email',
            'date_of_birth'=>'required',
            'nid_number'=>'required|unique:electricians,nid_number',
            'category'=>'required',
            'division'=>'required',
        ],[
            'first_name.required'=>'Please enter First Name',
            'phone.required'=>"please enter phone number",
            'email.required'=>"Please enter email",
            'date_of_birth.required'=>"Please enter date of birth",
            'nid_number.required'=>"Please enter Nid Number",
            'category.required'=>"Please Select Electrician Category",
            'division.required'=>"Please Select address",
        ]);

        $slug='E'.uniqid('11');
        $insert=Electrician::insert([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'date_of_birth'=>$request->date_of_birth,
            'nid_number'=>$request->nid_number,
            'electrician_category'=>$request->category,
            'division_id'=>$request->division,
            'district_id'=>$request->district,
            'upazila_id'=>$request->upazila,
            // 'address1'=>$request->division.','.$request->district. ','.$request->upazila,
            'address2'=>$request->address1,
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
 
    public function profile($slug){
        $data=Electrician::where('status',1)->where('slug',$slug)->firstOrFail();
        return view('frontend.pages.electrician.profile',compact('data'));
    }

    public function customer(){
        return view('frontend.pages.customer.dashboard');
    }

    public function search(){
        return view('frontend.pages.electrician.search');
    }

    // public function search(Request $request){
    //     $search = $request->search;

    //     $electrician = Electrician::where(function($query) use ($search){
    //         $query->where('address2','like',"%$search%")
    //         ->orWhere('address1','like',"%$search%");
    //     })

    //     ->get();
    //     return view('frontend.pages.electrician.home',compact('electrician','search'));

    // }
}
