<?php

namespace App\Http\Livewire\Week;

use Livewire\Component;
use App\Rules\StartDateSunday;
use Illuminate\Support\Carbon;
use App\Models\Week as ModelsWeek;
use Illuminate\Support\Facades\Hash;

class Week extends Component
{

    public $week_index, $start_date, $end_date,$method,$Week;

    public function mount($method,?int $week_id) {
        $this->method = $method;
        if($this->method == 'edit') {
            $this->Week = ModelsWeek::whereId($week_id)->first();
            $this->week_index = $this->Week->week_index;
            $this->start_date = $this->Week->start_date;
            //$this->end_date = $this->Week->end_date;

        }
    }

    protected $rules = [
        'week_index' => ['required', 'string', 'max:50'],
    ];



    protected $messages = [
        'required' => 'ممنوع ترك الحقل فارغاَ',
        'min' => 'لابد ان يكون الحقل مكون على الاقل من 4 خانات',
        'email' => 'هذا الإيميل غير صحيح',
        'name.max' => 'لابد ان يكون الحقل مكون على الاكثر من 50 خانة',
        'week_index.max' => 'لابد ان يكون الحقل مكون على الاكثر من 50 خانة',
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
            array_merge($this->rules,[
                'start_date' => ['required', 'date', new StartDateSunday],
            ])
        );
        $startDate = Carbon::parse($validatedData['start_date']);
        $endDate = $startDate->copy()->addDays(4);
        $data_week = array_merge($validatedData,[
            'end_date'=> $endDate,
        ]);
        ModelsWeek::create($data_week);
        session()->flash('message', "Week Added successful.");
        return redirect()->route('weeks.index');
    }


    public function edit() {
        $validatedData = $this->validate(
            array_merge($this->rules,[
                'start_date' => ['required', 'date', new StartDateSunday],
            ])
        );
        $startDate = Carbon::parse($validatedData['start_date']);
        $endDate = $startDate->copy()->addDays(4);
        $data_week = array_merge($validatedData,[
            'end_date'=> $endDate,
        ]);
        $this->Week->update($data_week);
        session()->flash('message', "Week Updated successful.");
        return redirect()->route('weeks.index');
    }

    public function render()
    {
        return view('livewire.week.week');
    }
}
