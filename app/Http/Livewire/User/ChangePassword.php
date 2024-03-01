<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ChangePassword extends Component
{
    public $password='', $confirm_password='',$user_id='';


    public function mount() {
        $this->user_id = auth()->user()->id;
    }


    protected $rules = [

        'password' => ['required', 'string', 'min:4'],
        'confirm_password' => ['required', 'string', 'min:4','same:password'],
    ];

    protected $messages = [
        'required' => 'ممنوع ترك الحقل فارغاَ',
        'min' => 'لابد ان يكون الحقل مكون على الاقل من 4 خانات',
        'same' => 'لابد ان يكون الباسورد متطابق',
    ];

    public function edit() {

        $validatedata = $this->validate();
        $data =['password' => Hash::make($this->password)];

        User::whereId($this->user_id)->update($data);
        session()->flash('message', "Your Profile Updated.");
        return redirect()->route('profile');
    }

    public function render()
    {
        return view('livewire.user.change-password');
    }
}
