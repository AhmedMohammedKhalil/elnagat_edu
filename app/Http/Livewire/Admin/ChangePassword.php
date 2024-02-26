<?php

namespace App\Http\Livewire\Admin;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ChangePassword extends Component
{
    public $password='', $confirm_password='',$admin_id='';


    public function mount() {
        $this->admin_id = Auth::guard('admin')->user()->id;
    }


    protected $rules = [

        'password' => ['required', 'string', 'min:8'],
        'confirm_password' => ['required', 'string', 'min:8','same:password'],
    ];

    protected $messages = [
        'required' => 'ممنوع ترك الحقل فارغاَ',
        'min' => 'لابد ان يكون الحقل مكون على الاقل من 8 خانات',
        'same' => 'لابد ان يكون الباسورد متطابق',
    ];


    public function edit() {

        $validatedata = $this->validate();
        $data =['password' => Hash::make($this->password)];
        Admin::whereId($this->admin_id)->update($data);
        session()->flash('message', "Your Profile Updated.");
        return redirect()->route('admin.profile');
    }

    public function render()
    {
        return view('livewire.admin.change-password');
    }
}
