<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'phone' => ['required', 'phone']
        ]);

        if (Auth::attempt($credentials)){
            return "وارد شد ";
        }

        return back()->withErrors([
           'phone' => 'the provided credentials do not match our records.'
        ])->onlyInput('phone');
    }
}
