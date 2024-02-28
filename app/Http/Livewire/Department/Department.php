<?php

namespace App\Http\Livewire\Department;

use Livewire\Component;
use App\Models\Department as ModelsDepartment;
use App\Models\School;

class Department extends Component
{

    public $name, $owner, $school_id,$method,$department,$schools;

    public function mount($method,?int $department_id) {
        $this->method = $method;
        $this->schools = School::all();
        $school = School::Limit(1)->first();
        $this->school_id = $school->id;
        //$this->school_id = (isset($school_id) && $school_id != null) ? $school_id : $this->school_id;
        if($this->method == 'edit') {
            $this->department = ModelsDepartment::whereId($department_id)->first();
            $this->school_id = $this->department->school_id;
            $this->name = $this->department->name;
            $this->owner = $this->department->owner;
        }
    }

    protected $rules = [
        'name' => ['required', 'string', 'max:50'],
        'owner'   => 'required|string',
        'school_id' => ['required']
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
        ModelsDepartment::create($validatedData);
        session()->flash('message', "Department Added successful.");
        return redirect()->route('departments.index');
    }


    public function edit() {
        $validatedData = $this->validate();
        $this->department->update($validatedData);
        session()->flash('message', "Department Updated successful.");
        return redirect()->route('departments.index');
    }


    public function render()
    {
        return view('livewire.department.department');
    }
}
