<?php

namespace App\Http\Livewire\Review;

use App\Models\Classroom;
use App\Models\Week;
use App\Models\Level;
use App\Models\Teacher;
use Livewire\Component;
use App\Models\Department;
use Illuminate\Support\Carbon;
use App\Models\Review as ModelsReview;
use App\Models\Teacher as ModelsTeacher;

class Review extends Component
{

    public $school_id,$school,$department,$department_id,$teachers,$teacher_id,$levels ,
            $level_id,$classrooms,$classroom_id,$method,$review,
            $week,$week_id,$tasks,$lessons,$weekly_plan,$result,$date,$notes;

    public function mount($method,int $week_id = 0,?int $review_id) {
        Carbon::setLocale('ar');
        $this->method = $method;
        $this->department = auth()->user()->department;
        $this->school = $this->department->school;
        $this->department_id = $this->department->id;
        $this->updatedDepartmentID();

        if($this->method == 'add') {
            $this->week = $week_id > 0 ? Week::find( $week_id ) : null;
            $this->week_id = $this->week->id;
            $this->tasks = $this->lessons = $this->weekly_plan = $this->result = 0;
            $this->date = Carbon::Now();
        }


        //$this->school_id = (isset($school_id) && $school_id != null) ? $school_id : $this->school_id;
        if($this->method == 'edit') {
            $this->review = ModelsReview::whereId($review_id)->first();
            $this->department_id = $this->review->teacher->department_id;
            $this->updatedDepartmentID();
            $this->teacher_id = $this->review->teacher->id;
            $this->updatedTeacherID();
            $this->level_id = $this->review->classroom->level_id;
            $this->classrooms = Classroom::where('level_id',$this->level_id)->get();
            //$this->updatedLevelID();
            $this->classroom_id = $this->review->classroom_id;
            $this->week = $this->review->week;
            $this->week_id = $this->week->id;
            $this->tasks = $this->review->tasks;
            $this->lessons = $this->review->lessons;
            $this->weekly_plan = $this->review->weekly_plan;
            $this->date = $this->review->date;
            $this->result = $this->review->result;
            $this->notes = $this->review->notes;
        }
    }

    protected $rules = [
        'teacher_id' => ['required','gt:0'],
        'classroom_id' => ['required','gt:0'],
        'week_id' => ['required'],
        'tasks' => ['required','numeric'],
        'lessons' => ['required','numeric'],
        'weekly_plan' => ['required','numeric'],
        'date' => ['required','date'],
        'notes' => ['nullable','string'],
        'result' => ['required'],
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
        'numeric' => 'لابد ان يكون الحقل ارقام فقط',
    ];


    public function updatedDepartmentID() {
        $this->teachers = Teacher::where('department_id', $this->department_id)->get();
        $this->levels = null;
        $this->classrooms = null;
        $this->lessons = 0;
        $this->tasks = 0;
        $this->weekly_plan = 0;
        $this->result = 0;
    }

    public function updatedTeacherID() {
        $this->levels = Level::where('teacher_id', $this->teacher_id)->get();
        $this->classrooms = null;
        $this->lessons = 0;
        $this->tasks = 0;
        $this->weekly_plan = 0;
        $this->result = 0;
    }

    public function updatedLevelID() {
        $this->classrooms = Classroom::where('level_id', $this->level_id)->get();
        $ids = [];
        foreach ($this->classrooms as $classroom) {
            if(ModelsReview::where('classroom_id',$classroom->id)->where('week_id',$this->week_id)->first()) {
                $ids[] = $classroom->id;
            }
        }
        $this->classrooms = Classroom::where('level_id', $this->level_id)->whereNotIn('id',$ids)->get();
        $this->lessons = 0;
        $this->tasks = 0;
        $this->weekly_plan = 0;
        $this->result = 0;
    }

    public function calculateResult() {
        $result = 0;
        if($this->tasks > 0) {
            $result += 1;
        }

        if($this->lessons > 0) {
            $result += 1;
        }

        if($this->weekly_plan > 0) {
            $result += 1;
        }


        $result = $result / 3;
        $this->result = $result > 1 ? 100 : $result * 100 ;
        $this->result = round($this->result);
    }

    public function updatedTasks() {
        $this->calculateResult();
    }

    public function updatedLessons() {
        $this->calculateResult();

    }

    public function updatedWeeklyPlan() {
        $this->calculateResult();
    }


    public function add() {
        $this->date = Carbon::Now();
        $validatedData = $this->validate();
        ModelsReview::create($validatedData);
        session()->flash('message', "Teacher Added successful.");
        return redirect()->route('reviews.index');
    }


    public function edit() {
        $validatedData = $this->validate();
        $this->review->update($validatedData);
        session()->flash('message', "Teacher Updated successful.");
        return redirect()->route('reviews.index');
    }

    public function render()
    {
        return view('livewire.review.review');
    }
}
