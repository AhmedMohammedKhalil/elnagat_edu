<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class AddEdit extends Component
{
    public $name, $email, $password, $confirm_password, $role, $gender,$method,$user;

    public function mount($method,?int $user_id) {
        $this->method = $method;
        if($this->method == 'editOfficial' || $this->method == 'editSubAdmin') {
            $this->user = User::whereId($user_id)->first();
            $this->email = $this->user->email;
            $this->name = $this->user->name;
            $this->gender = $this->user->gender;
        }
    }

    protected $rules = [
        'name' => ['required', 'string', 'max:50'],
        'role' => ['required', 'string'],
        'gender' => ['required', 'string'],

    ];

    protected $messages = [
        'required' => 'ممنوع ترك الحقل فارغاَ',
        'min' => 'لابد ان يكون الحقل مكون على الاقل من 8 خانات',
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


    public function updatedPassword() {
        $validatedData = $this->validate(
            [
                'password' => ['required', 'string', 'min:8'],
                'confirm_password' => ['required', 'string', 'min:8','same:password'],
            ],
        );
    }


    private function register() {
        $validatedData = $this->validate(
            array_merge(
                $this->rules,
                [
                    'email'   => ['required','email',"unique:users,email",
                    'password' => ['required', 'string', 'min:8'],
                    'confirm_password' => ['required', 'string', 'min:8','same:password'],
                ],
        ]));
        $data = array_merge(
            $validatedData,
            ['password' => Hash::make($this->password)]
        );
        User::create($data);
    }

    private function edit() {
        if(!$this->password || $this->password == '' || $this->password == null) {
            $validatedata = $this->validate(
                array_merge(
                    $this->rules,
                    [ 'email'   => ['required','email',"unique:users,email,".$this->user->id],
            ]));
        } else {
            $this->updatedPassword();
            $validatedata = $this->validate(
                array_merge(
                    $this->rules,
                    [
                         'email'   => ['required','email',"unique:users,email,".$this->user->id],
                         'password' => Hash::make($this->password)
                    ])
            );
        }
        User::whereId($this->user->id)->update($validatedata);
    }


    public function addOfficial(){
        $this->role = 'official';
        $this->register();
        session()->flash('message', "Officials Added successful.");
        return redirect()->route('officials.index');
    }

    public function addSubAdmin(){
        $this->role = 'sub_admin';
        $this->register();
        session()->flash('message', "Sub Admin Added successful.");
        return redirect()->route('sub_admins.index');
    }

    public function editOfficial(){
        $this->role = 'official';
        $this->edit();
        session()->flash('message', "Officials Updated successful.");
        return redirect()->route('officials.index');
    }

    public function editSubAdmin(){
        $this->role = 'sub_admin';
        $this->edit();
        session()->flash('message', "Sub Admin Updated successful.");
        return redirect()->route('sub_admins.index');
    }

    public function render()
    {
        return view('livewire.user.add-edit');
    }
}
