<?php

namespace App\Http\Livewire\Report;
use Livewire\Component;
use App\Models\School;

use Illuminate\Auth\Events\Validated;

class SchoolReport extends Component
{
    public $school_id,$schools;

    protected $rules = [
        'school_id' => ['required','gt:0'],
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
        
    ];

    public function getreport(){
        $this->validate();
        return redirect()->route('reports.school.data',['school_id'=>$this->school_id]);
    }
    public function render()
    {
        $this->schools = School::all();
        return view('livewire.report.school-report');
    }
}
