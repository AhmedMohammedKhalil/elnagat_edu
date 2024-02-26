<?php

namespace App\Http\Livewire\Company;

use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ChangePassword extends Component
{
    public $password='', $confirm_password='',$company_id='';


    public function mount() {
        $this->company_id = Auth::guard('company')->user()->id;
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

        Company::whereId($this->company_id)->update($data);
        session()->flash('message', "Your Profile Updated.");
        return redirect()->route('company.profile');
    }

    public function render()
    {
        return view('livewire.company.change-password');
    }
}
