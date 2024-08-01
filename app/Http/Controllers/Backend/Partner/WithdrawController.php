<?php

namespace App\Http\Controllers\Backend\Partner;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Models\Withdraw;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class WithdrawController extends Controller
{
    public function request_commission(){
        $req_com=Withdraw::where('status',1)->orderBy('created_at','ASC')->get();
        return view('backend.partner.commission.request.index',compact('req_com'));
    }
    public function request_view($slug){
        $data=Withdraw::where('status',1)->where('slug',$slug)->firstOrFail();
        return view('backend.partner.commission.request.view',compact('data'));
    }

    public function status(Request $request){

        $id = $request->id;
        $slug='W'.uniqid('11');
        $update=Withdraw::where('status',1)->where('id',$id)->update([
            'balance'=>$request->new_balance,
            'status'=>0,
            'slug'=>$slug,
        ]);

        if ($update) {
            Session::flash('success', 'Payment Successfully.');
            return redirect('admin/partner/commission/request');
        } else {
            Session::flash('error', 'please try again.');
            return redirect()->back();
        }

    }

    public function insert(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'account_name'=>'required',
            'account_number'=>'required',
            'amount'=>'required',
        ],[
            'name.required'=>'Please enter Name',
            'account_name.required'=>'Please enter Name',
            'account_number.required'=>'Please enter Name',
            'amount.required'=>'Please enter Name',
        ]);

        $user_id=Auth::user()->id;
        $slug='E'.uniqid('11');
        $insert=Withdraw::insert([
            'name'=>$request->name,
            'account_name'=>$request->account_name,
            'account_number'=>$request->account_number,
            'amount'=>$request->amount,
            'balance'=>$request->balance,
            'description'=>$request->description,
            'slug'=>$slug,
            'user_id'=>$user_id,
            'created_at'=>Carbon::now()->toDateTimeString(),
        ]);

        if($insert){
            Session::flash('success','Successfully! Request');
            return redirect('partner/commission');
        }else{
            Session::flash('error','');
            return redirect('partner/commission');
        }
    }

    public function commission(){
        $total_com=Withdraw::where('status',1)->orderBy('user_id','DESC')->get();
        return view('backend.partner.commission.index',compact('total_com'));
    }
}
