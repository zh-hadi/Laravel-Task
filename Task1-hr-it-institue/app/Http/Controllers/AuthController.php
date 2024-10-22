<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login():View
    {
        if(Auth::check()){
            return redirect()->route('home');
        }

        return view('auth.login');
    }

    public function loginPost()
    {
        $credintail  = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);


        $login = Auth::attempt($credintail);

        if($login){
            return redirect()->route('home');
        }else{
            return redirect()->back()->withErrors(['error' => 'Invalid credentials']);
        }
    }

    public function register():View
    {
        if(Auth::check()){
            return redirect()->route('home');
        }

        return view('auth.register');
    }

    public function registerPost()
    {
        $attributes  = request()->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'address' => ['required', 'string'],
            'password' => ['required', 'confirmed']
        ]);

        $attributes['password'] = Hash::make(request()->password);

        
        $user = User::create($attributes);

        Auth::login($user);

        return redirect()->route('home');
    }


    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect()->route('login');
    }
}
