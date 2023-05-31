<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|max:255|email:filter',
            'password' => 'required',
        ]);
        if (Auth::attempt(['email' => $request->email,'password' => $request->password])) {
            if (auth()->user()->role == "Admin") {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('user.dashboard');
            }
        } else {
            // Go back on error (or do what you want)
            return redirect()->back()->with("error", "Wrong Credentials");
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
