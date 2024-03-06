<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use App\Models\School;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use App\Models\Department as ModelsDepartment;

class Department extends Component
{

    public $name, $owner,$role, $school_id,$method,$department,$owner_id,$user,$email,$username,$gender,$password,$confirm_password;

    public function mount($method,?int $department_id) {
        $this->method = $method;
        $this->role = 'department_owner';
        if($this->method == 'edit') {
            $this->department = ModelsDepartment::whereId($department_id)->first();
            $this->school_id = $this->department->school_id;
            $this->name = $this->department->name;
            //$this->owner = $this->department->owner;
            $this->owner_id = $this->department->owner_id;
            $this->user = User::whereId($this->owner_id)->first();
            $this->email = $this->user->email;
            $this->username = $this->user->name;
            $this->gender = $this->user->gender;
        }
    }

    protected $rules = [
        'name' => ['required', 'string', 'max:50'],
        'school_id' => ['required'],
        'username' => ['required', 'string', 'max:50'],
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

        $data_department = [
            'name' => $this->name,
            'owner_id' => $this->owner_id,
            'school_id' => $this->school_id
        ];
        $this->department->update($data_department);
        session()->flash('message', "Department Updated successful.");
        return redirect()->route('admin.departments',['id'=>$this->school_id]);
    }

    // public function edit() {
    //     $validatedData = $this->validate();
    //     $this->department->update($validatedData);
    //     session()->flash('message', "Department Updated successful.");
    //     return redirect()->route('departments.index');
    // }


    public function render()
    {
        return view('livewire.admin.department');
    }
}
