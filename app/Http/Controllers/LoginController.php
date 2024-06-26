<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index',[
            'title' => 'Login'
        ]);
    }

    public function authenticate(Request $request) {

        $credentials = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|min:8|max:255'
        ]);

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->with('loginError',"Your email or password is incorrect, please try again.");
    }

    public function logout(Request $request) {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect("/login");
    }


}