<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ElectricianController extends Controller
{
    public function index(){
        return view('frontend.pages.electrician.home');
    }

    public function registration(){
        return view('frontend.pages.electrician.register');
    }

    public function profile(){
        return view('frontend.pages.electrician.profile');
    }

    public function customer(){
        return view('frontend.pages.customer.dashboard');
    }
}
