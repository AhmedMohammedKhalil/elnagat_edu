<?php

namespace App\Http\Livewire\Level;

use App\Models\Teacher;
use App\Models\Level as ModelsLevel;
use Livewire\Component;

class Level extends Component
{
    public $name, $teacher_id,$teacher,$levels,$stages;

    public function mount($teacher_id)
    {
        $this->teacher_id = $teacher_id;
        $this->levels=Teacher::find($this->teacher_id)->levels;
        $this->stages=["الابتدائية","المتوسطة","الثانوية"];
        foreach ($this->levels as $level) {
            unset( $this->stages[array_search($level->name ,$this->stages)]); 
        }
        $this->name=reset($this->stages);
    }

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

    protected $rules = [
        'name' => ['required', 'string', 'max:50'],
        'teacher_id' => ['required']
    ];

    public function add()
    {
        $validatedData = $this->validate();
        ModelsLevel::create($validatedData);
            session()->flash('message', "Level Added successful.");
        return redirect()->route('levels.index',['id'=>$this->teacher_id]);
    }

    public function render()
    {
        return view('livewire.level.level');
    }
}
