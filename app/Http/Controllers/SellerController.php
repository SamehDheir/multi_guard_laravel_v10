<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SellerController extends Controller
{
    public function seller_login_form()
    {
        return view('seller.login');
    }


    public function seller_register_form()
    {
        return view('seller.register');
    }


    public function login(Request $request)
    {
        $cheak = $request->all();
        if (Auth::guard('seller')->attempt(['email' => $cheak['email'], 'password' => $cheak['password']])) {
            return redirect()->route('seller.dashboard')->with('success', 'Login Successfuly');
        } else {
            return back()->with('error', 'Invalid Email Or Password');
        }
    }


    public function dashboard()
    {
        return view('seller.dashboard');
    }


    public function logout()
    {
        Auth::guard('seller')->logout();
        return redirect()->route('login_form')->with('logout', 'LogOut Successfuly');
    }


    public function register(Request $request)
    {
        Seller::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'Created_at' => Carbon::now(),
        ]);
        return redirect()->route('login_form')->with('register', 'Register Successfuly');
    }
}
