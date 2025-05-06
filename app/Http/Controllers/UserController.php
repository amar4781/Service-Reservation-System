<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register()
    {
        return view('website.register');
    }

    public function registerPost(Request $request)
    {
        $request->validate([
            "name"=>"required",
            "email"=>"required",
            "password"=>"required"
        ]);

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        return redirect()->route('website.login')->with('success', 'Register successfully');
    }

    public function login()
    {
        return view('website.login');
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            "email"=>"required",
            "password"=>"required"
        ]);

        $credetials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credetials)) {
            return redirect()->route('website.home')->with('success', 'Login Success');
        }

        return back()->with('error', 'Error Email or Password');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('website.login');
    }
}
