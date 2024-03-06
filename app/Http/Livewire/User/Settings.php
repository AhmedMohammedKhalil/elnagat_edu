<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Livewire\Component;

class Settings extends Component
{
    use WithFileUploads;
    public $name='', $email='', $gender="",$user_id='';


    public function mount() {
        $this->user_id = auth()->user()->id;
        $this->name = auth()->user()->name;
        $this->email = auth()->user()->email;
        $this->gender = auth()->user()->gender;
    }

    protected $messages = [
        'required' => 'ممنوع ترك الحقل فارغاَ',
        'min' => 'لابد ان يكون الحقل مكون على الاقل من 4 خانات',
        'email' => 'هذا الإيميل غير صحيح',
        'name.max' => 'لابد ان يكون الحقل مكون على الاكثر من 50 خانة',
        'unique' => 'هذا الايميل مسجل فى الموقع',
        'same' => 'لابد ان يكون الباسورد متطابق',
        'image' => 'لابد ان يكون المف صورة',
        'mimes' => 'لابد ان يكون الصورة jpeg,jpg,png',
        'image.max' => 'يجب ان تكون الصورة اصغر من 2 ميجا',
        'regex' => 'لا بد ان يكون الحقل ارقام فقط',
        'max' => 'لابد ان يكون الحقل مكون على الاكثر من 255 خانة',
    ];


    protected $rules = [
        'name' => ['required', 'string', 'max:50'],
        'gender' => ['required'],
    ];

    public function edit() {
        $validatedata = $this->validate(
            array_merge(
                $this->rules,
                [ 'email'   => ['required','email',"unique:users,email,".$this->user_id],
        ]));
        User::whereId($this->user_id)->update($validatedata);
        session()->flash('message', "Your Profile Updated.");
        return redirect()->route('profile');
    }

    public function render()
    {
        return view('livewire.user.settings');
    }
}
