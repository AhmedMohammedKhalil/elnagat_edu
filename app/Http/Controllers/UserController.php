<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function dashboard() {
        $page_name = 'الإحصائيات';
        $user_count = User::all()->count();
        return view('users.dashboard',compact('page_name','user_count'));
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
        auth()->logout();
        $request->session()->invalidate();
        return redirect()->route('home');
    }
}
