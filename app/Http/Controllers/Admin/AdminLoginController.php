<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public  function index()
    {
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Auth::guard('admin')->user()->role === 2) {
                return redirect()->route('admin.dashboard');
            }
            Auth::guard('admin')->logout();
            return redirect()->route('admin.login')->with('error', 'Access Denied. Admins Only.');
        }

        return redirect()->route('admin.login')->with('error', 'Invalid Email or Password.');
    }
}
