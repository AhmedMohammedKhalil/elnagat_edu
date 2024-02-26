<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function showLoginForm() {
        return view('companies.login');
    }

    public function dashboard() {
        //change
        $page_name = 'الإحصائيات';
        $user_count = User::all()->count();
        return view('admins.dashboard',compact('page_name','user_count'));
    }

    public function profile() {
        return view('companies.profile',['page_name' => 'البروفايل']);
    }

    public function settings() {
        return view('companies.settings',['page_name' => 'الإعدادات']);
    }

    public function changePassword() {
        return view('companies.changePassword',['page_name' => 'تغيير كلمة السر']);
    }

    public function logout(Request $request) {
        Auth::guard('company')->logout();
        $request->session()->invalidate();
        return redirect()->route('home');
    }
}
