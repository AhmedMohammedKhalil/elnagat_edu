<?php

namespace App\Http\Livewire\School;

use App\Models\School as ModelsSchool;
use App\Models\User;
use Livewire\Component;

class School extends Component
{

    public $name, $owner, $sub_admin_id,$method,$school,$sub_admins;

    public function mount($method,?int $school_id) {
        $this->method = $method;
        //$this->school_id = (isset($school_id) && $school_id != null) ? $school_id : $this->school_id;
        if($this->method == 'edit') {
            $this->school = ModelsSchool::whereId($school_id)->first();
            $this->sub_admin_id = $this->school->sub_admin_id;
            $this->name = $this->school->name;
            $this->owner = $this->school->owner;
        }
    }

    protected $rules = [
        'name' => ['required', 'string', 'max:50'],
        'owner'   => 'required|string',
        'sub_admin_id' => ['required']
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
        ModelsSchool::create($validatedData);
        session()->flash('message', "School Added successful.");
        return redirect()->route('schools.index');
    }


    public function edit() {
        $validatedData = $this->validate();
        $this->school->update($validatedData);
        session()->flash('message', "School Updated successful.");
        return redirect()->route('schools.index');
    }

    public function render()
    {
        $sub_admins = User::where('role', 'sub_admin')->get();
        $ids = [];
        foreach ($sub_admins as $admin){
            if(!ModelsSchool::where('sub_admin_id', $admin->id)->first()) {
                $ids[] = $admin->id;
            }
        }
        $this->sub_admins = User::whereIn('id', $ids)->get();

        return view('livewire.school.school');
    }
}
