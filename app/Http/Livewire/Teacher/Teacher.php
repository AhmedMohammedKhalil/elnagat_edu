<?php

namespace App\Http\Livewire\Teacher;

use App\Models\Department;
use App\Models\Teacher as ModelsTeacher;
use Livewire\Component;

class Teacher extends Component
{

    public $name,$department_id,$method,$teacher,$departments;

    public function mount($method,?int $teacher_id) {
        $this->method = $method;
        $this->departments = auth()->user()->owner->departments;
        $department = Department::where("school_id",auth()->user()->owner->id)->first();
        $this->department_id = $department->id;
        //$this->school_id = (isset($school_id) && $school_id != null) ? $school_id : $this->school_id;
        if($this->method == 'edit') {
            $this->teacher = ModelsTeacher::whereId($teacher_id)->first();
            $this->department_id = $this->teacher->department_id;
            $this->name = $this->teacher->name;
        }
    }

    protected $rules = [
        'name' => ['required', 'string', 'max:50'],
        'department_id' => ['required']
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

    public function add() {
        $validatedData = $this->validate();
        ModelsTeacher::create($validatedData);
        session()->flash('message', "Teacher Added successful.");
        return redirect()->route('teachers.index');
    }


    public function edit() {
        $validatedData = $this->validate();
        $this->teacher->update($validatedData);
        session()->flash('message', "Teacher Updated successful.");
        return redirect()->route('teachers.index');
    }

    public function render()
    {
        return view('livewire.teacher.teacher');
    }
}
