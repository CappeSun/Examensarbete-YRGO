<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->validate([
            'name' => 'required',
            'password' => 'required|string'
        ]);

        if (Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect('/');
        }

        return redirect('/login');
    }

    public function logout(Request $request)
    {
        Auth::logout($request);
        return redirect('/');
    }
}