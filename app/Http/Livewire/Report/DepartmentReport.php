<?php

namespace App\Http\Livewire\Report;
use App\Models\Department;
use Livewire\Component;
use App\Models\School;
use App\Models\Week;


class DepartmentReport extends Component
{
    public $schools,$school_id,$weeks,$week_id,$departments,$department_id;

    public function mount()
    {
        
    }

    protected $rules = [
        'school_id' => ['required','gt:0'],
        'department_id' => ['required','gt:0'],
        'week_id' => ['required','gt:0']
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
        'school_id.gt' => 'يجب ان تختار المدرسة',
        'department_id.gt' => 'يجب ان تختار القسم',
        'week_id.gt' => 'يجب ان تختار الأسبوع',
    ];

    public function updatedSchoolId(){
        $this->departments=Department::where('school_id',$this->school_id)->get();
    }
    public function getreport(){
        $this->validate();
        return redirect()->route('reports.department.data',['week_id'=>$this->week_id ,'department_id'=>$this->department_id]);
    }
    public function render()
    {
        $this->schools = School::all();
        $this->weeks = Week::all();
        return view('livewire.report.department-report');
    }
}
