<?php

namespace App\Http\Livewire\Report;

use Livewire\Component;
use App\Models\Department;
use App\Models\Week;

class SubAdminDepartmentReport extends Component
{
    public $school_id,$weeks,$week_id,$departments,$department_id;

    public function mount()
    {
        $this->school_id=auth()->user()->school->id;
    }

    protected $rules = [
        'department_id' => ['required','gt:0'],
        'week_id' => ['required','gt:0'],
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
            'department_id.gt' => 'يجب ان تختار القسم',
            'week_id.gt' => 'يجب ان تختار الأسبوع',
        ];
        public function getreport(){
            $this->validate();
            return redirect()->route('reports.sub_admin.department.data',['department_id'=>$this->department_id,'week_id'=>$this->week_id]);
        }
    public function render()
    {
        $this->departments=Department::where('school_id',$this->school_id)->get();
        $this->weeks = Week::all();
        return view('livewire.report.sub-admin-department-report');
    }
}
