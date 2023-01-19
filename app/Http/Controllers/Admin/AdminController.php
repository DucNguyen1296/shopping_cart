<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    //
    public function index()
    {
        return view('admin.admin_login');
    }

    public function admin_dashboard()
    {
        if (Auth::check() && Gate::allows('isAdmin')) {
            return view('admin.admin_dashboard');
        } else {
            return redirect('/trang-chu');
        }
    }

    public function dashboard(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $remember = $request->input('remember');
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);



        if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
            if (Gate::allows('isAdmin')) { {
                    $request->session()->regenerate();
                    return redirect('/admin-dashboard');
                }
            } else {
                return redirect('/trang-chu');
            }
        } else {
            return back();
        }
    }

    public function logout(Request $request)
    {
        if (Gate::allows('isAdmin')) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/admin-login');
        }
    }
}
