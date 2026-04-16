<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');

    }

    public function verify(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::guard('user')->attempt($validatedData)) {

            $request->session()->regenerate();

            return redirect()->intended('/admin');
        }

        return redirect()->route('auth.login')
            ->with('pesan','Email atau Password Salah');
    }
    public function logout(){
        if(Auth::guard('user')->check()){
            Auth::guard('user')->logout();
        }

        return redirect(route('auth.login'));
    }
}
