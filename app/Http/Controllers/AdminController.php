<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function login_form()
    {
        return view('admin.login');
    }


    public function register_form()
    {
        return view('admin.register');
    }


    public function login(Request $request)
    {
        $cheak = $request->all();
        if (Auth::guard('admin')->attempt(['email' => $cheak['email'], 'password' => $cheak['password']])) {
            return redirect()->route('admin.dashboard')->with('success', 'Login Successfuly');
            return back()->with('error', 'Invalid Email Or Password');
        }
    }


    public function dashboard()
    {
        return view('admin.dashboard');
    }


    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('login_form')->with('logout', 'LogOut Successfuly');
    }


    public function register(Request $request)
    {
        Admin::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'Created_at' => Carbon::now(),
        ]);
        return redirect()->route('login_form')->with('register', 'Register Successfuly');
    }
}
