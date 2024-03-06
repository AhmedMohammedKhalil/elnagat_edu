<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use App\Models\School as ModelsSchool;

class School extends Component
{

    public $name, $owner, $sub_admin_id,$method,$school,$official_id, $username, $email, $password, $confirm_password, $role, $gender,$user;

    public function mount($method,?int $school_id) {
        $this->method = $method;

        if($this->method == 'edit') {
            $this->school = ModelsSchool::whereId($school_id)->first();
            $this->sub_admin_id = $this->school->sub_admin_id;
            $this->name = $this->school->name;
            $this->owner = $this->school->owner;
            $this->official_id = $this->school->official_id;
            $this->user = User::whereId($this->sub_admin_id)->first();
            $this->email = $this->user->email;
            $this->username = $this->user->name;
            $this->gender = $this->user->gender;
            $this->gender = 'ذكر';
            $this->role = 'sub_admin';

        }
    }

    protected $rules = [
        'name' => ['required', 'string', 'max:50'],
        'username' => ['required', 'string', 'max:50'],
        'owner'   => 'required|string',
        'role' => ['required', 'string'],
        'gender' => ['required', 'string'],
    ];


    public function updatedPassword() {
        $validatedData = $this->validate(
            [
                'password' => ['required', 'string', 'min:4'],
                'confirm_password' => ['required', 'string', 'min:4','same:password'],
            ],
        );
    }

    public function updatedConfirmPassword() {
        $validatedData = $this->validate(
            [
                'password' => ['required', 'string', 'min:4'],
                'confirm_password' => ['required', 'string', 'min:4','same:password'],
            ],
        );
    }

    protected $messages = [
        'required' => 'ممنوع ترك الحقل فارغاَ',
        'min' => 'لابد ان يكون الحقل مكون على الاقل من 4 خانات',
        'email' => 'هذا الإيميل غير صحيح',
        'name.max' => 'لابد ان يكون الحقل مكون على الاكثر من 50 خانة',
        'username.max' => 'لابد ان يكون الحقل مكون على الاكثر من 50 خانة',
        'unique' => 'هذا الايميل مسجل فى الموقع',
        'same' => 'لابد ان يكون الباسورد متطابق',
        'image' => 'لابد ان يكون المف صورة',
        'mimes' => 'لابد ان يكون الصورة jpeg,jpg,png',
        'image.max' => 'يجب ان تكون الصورة اصغر من 2 ميجا',
        'regex' => 'لا بد ان يكون الحقل ارقام فقط',
        'max' => 'لابد ان يكون الحقل مكون على الاكثر من 255 خانة',
    ];




    public function edit() {
        $data = [];
        if(!$this->password || $this->password == '' || $this->password == null) {
            $validateData = $this->validate(
                array_merge(
                    $this->rules,
                    [ 'email'   => ['required','email',"unique:users,email,".$this->user->id],
            ]));
            $data = [
                'name' => $this->username,
                'email' => $this->email,
                'gender'=> $this->gender
            ];
        } else {
            $this->updatedPassword();
            $validateData = $this->validate(
                array_merge(
                    $this->rules,
                    [
                         'email'   => ['required','email',"unique:users,email,".$this->user->id],
                    ])
            );
            $data = [
                'name' => $this->username,
                'email' => $this->email,
                'gender'=> $this->gender,
                'password' => Hash::make($this->password)
            ];
        }
        User::whereId($this->user->id)->update($data);

        $data_school = [
            'name' => $this->name,
            'owner' => $this->owner,
        ];
        $this->school->update($data_school);
        session()->flash('message', "School Updated successful.");
        return redirect()->route('admin.schools');
    }

    public function render()
    {
        return view('livewire.admin.school');
    }
}
