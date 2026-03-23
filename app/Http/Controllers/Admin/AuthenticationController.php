<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function login()
    {
        if(Auth::user()){
            return redirect('admin/dashboard');
        }else{
            return view('admin.auth.login');
        }

    }
    public function authenticate(Request $request) : RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $authenticated = Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
            'status' => function ($query) {
                $query->where('status', '1');
            }
        ]);

        if ($authenticated) {
            $request->session()->regenerate();

            return redirect()->intended('admin/dashboard');
        }

        return redirect()->route('admin.login')->with('error','The provided credentials do not match our records.');

        /* return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email'); */
    }
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin');
    }
}
