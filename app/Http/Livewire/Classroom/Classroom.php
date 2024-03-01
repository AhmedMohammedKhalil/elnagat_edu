<?php

namespace App\Http\Livewire\Classroom;

use Livewire\Component;
use App\Models\Classroom as ModelsClassroom;



class Classroom extends Component
{
    public $name,$level_id,$method,$classroom;

    public function mount($method,?int $classroom_id) {
        $this->method = $method; 
        if($this->method == 'edit') {
            $this->classroom = ModelsClassroom::whereId($classroom_id)->first();
            $this->level_id = $this->classroom->level_id;
            $this->name = $this->classroom->name;
        }
    }

    protected $rules = [
        'name' => ['required', 'string', 'max:50'],
        'level_id' => ['required']
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
        ModelsClassroom::create($validatedData);
        session()->flash('message', "Classroom Added successful.");
        return redirect()->route('classrooms.index',["id"=>$this->level_id ]);
    }


    public function edit() {
        $validatedData = $this->validate();
        $this->classroom->update($validatedData);
        session()->flash('message', "Classroom Updated successful.");
        return redirect()->route('classrooms.index',['id'=>$this->level_id]);
    }
    public function render()
    {
        return view('livewire.classroom.classroom');
    }
}
