<?php

namespace App\Http\Livewire\School;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use App\Models\School as ModelsSchool;

class School extends Component
{

    public $name, $owner, $sub_admin_id,$method,$school,$official_id, $username, $email, $password, $confirm_password, $role, $gender,$user;

    public function mount($method,?int $school_id) {
        $this->method = $method;
        $this->official_id = auth()->user()->id;
        $this->gender = 'ذكر';
        $this->role = 'sub_admin';
        if($this->method == 'edit') {
            $this->school = ModelsSchool::whereId($school_id)->first();
            $this->sub_admin_id = $this->school->sub_admin_id;
            $this->name = $this->school->name;
            $this->owner = $this->school->owner;
            $this->user = User::whereId($this->sub_admin_id)->first();
            $this->email = $this->user->email;
            $this->username = $this->user->name;
            $this->gender = $this->user->gender;

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

    public function add() {
        $validatedData = $this->validate(
            array_merge(
                $this->rules,
                [
                    'email'   => ['required','email',"unique:users,email"],
                    'password' => ['required', 'string', 'min:4'],
                    'confirm_password' => ['required', 'string', 'min:4','same:password'],
                ],
        ));
        $data_user = [
            'name' => $this->username,
            'email' => $this->email,
            'role' => $this->role,
            'gender' => $this->gender,
            'password' => Hash::make($this->password)
        ];
        $user = User::create($data_user);
        $this->sub_admin_id = $user->id;
        $data_school = [
            'name' => $this->name,
            'owner' => $this->owner,
            'official_id' => $this->official_id,
            'sub_admin_id'=> $this->sub_admin_id,
        ];
        ModelsSchool::create($data_school);
        session()->flash('message', "School and Sub Admin Added successful.");
        return redirect()->route('schools.index');
    }


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
        session()->flash('message', "School and Sub Admin Updated successful.");
        return redirect()->route('schools.index');
    }

    public function render()
    {
        return view('livewire.school.school');
    }
}
