<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    public function index(){
        return view('auth.register');
    }

    public function insert(Request $request){
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['required', 'numeric', 'digits:10'],
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => '0' . $request->phone,
            'slug' => uniqid(),
        ]);
        $user->assignRole('Customer');
        event(new Registered($user));

        Auth::login($user);
        return redirect('/');
    }

    public function updateProfile(Request $request){
        $id = Auth::user()->id;
        if (Auth::check()) {
            User::where('id', $id)->update(
                [
                    'city' => $request->city,
                    'post_code' => $request->post_code,
                    'country' => $request->country,
                    'address' => $request->address,
                ]
            );
            return redirect()->back()->with('success', 'Information Updated');
        }
    }



}
