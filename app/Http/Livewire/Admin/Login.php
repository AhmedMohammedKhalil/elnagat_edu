<?php

namespace App\Http\Livewire\Admin;

use App\Models\Admin;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
class Login extends Component
{


    public $email;
    public $password;

    protected $rules = [
        'email'   => 'required|email|exists:admins,email',
        'password' => 'required|min:8'
    ];

    protected $messages = [
        'required' => 'ممنوع ترك الحقل فارغاَ',
        'min' => 'لابد ان يكون الحقل مكون على الاقل من 8 خانات',
        'email' => 'هذا الإيميل غير صحيح',
        'exists' => 'هذا الايميل غير مسجل فى الموقع',

    ];

    public function login(){
        $validatedData = $this->validate();
        if(Auth::guard('admin')->attempt($validatedData)){

            session()->flash('message', "تم دخولك ينجاح");
            return redirect()->route('home');
        }else{
            session()->flash('error', 'هناك خطا فى الايميل او الباسورد');
        }
    }
    public function render()
    {
        return view('livewire.admin.login');
    }
}
