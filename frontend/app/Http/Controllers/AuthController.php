<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        // ✅ DATA ADMIN DUMMY
        if (
            $request->email === 'admin@portal.com' &&
            $request->password === 'admin123'
        ) {
            Session::put('is_login', true);
            Session::put('user', [
                'name' => 'Super Admin',
                'email' => 'admin@portal.com',
            ]);

            return redirect('/');
        }

        return back()->with('error', 'Email atau password salah');
    }

    public function logout(Request $request)
    {
        Session::flush();
        return redirect('/login');
    }
}
