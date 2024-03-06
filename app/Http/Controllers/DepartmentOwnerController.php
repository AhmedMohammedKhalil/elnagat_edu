<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Level;
use App\Models\Teacher;
use App\Models\Classroom;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentOwnerController extends Controller
{

    public function departments(Request $request) {
        $departments = Department::where('owner_id',auth()->user()->id)->get();
        return view("department_owner.departments", compact("departments"));
    }

    public function teachers(Request $request) {
        $teachers = Teacher::where('department_id',$request->id)->get();
        return view("department_owner.teachers", compact("teachers"));
    }

    public function levels(Request $request) {
        $levels = Level::where('teacher_id',$request->id)->get();
        return view("department_owner.levels", compact("levels"));
    }


    public function classrooms(Request $request) {
        $classrooms = Classroom::where('level_id',$request->id)->get();
        return view("department_owner.classrooms", compact("classrooms"));
    }
}
