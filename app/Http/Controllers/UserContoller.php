<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserContoller extends Controller
{
     public function showLoginForm() {
        return view('users.login');
    }


    public function showRegisterForm() {
        return view('users.register');
    }


    public function profile() {
        return view('users.profile',['page_name' => 'البروفايل']);
    }

    public function settings() {
        return view('users.settings',['page_name' => 'الإعدادات']);
    }

    public function changePassword() {
        return view('users.changePassword',['page_name' => 'تعديل كلمة السر']);
    }

    public function logout(Request $request) {
        Auth::guard('user')->logout();
        $request->session()->invalidate();
        return redirect()->route('home');
    }
}
