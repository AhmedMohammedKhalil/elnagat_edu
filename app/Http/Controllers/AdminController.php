<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Department;
use App\Models\Level;
use App\Models\User;
use App\Models\School;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function schools() {
        $schools = School::all();
        return view("admin.schools", compact("schools"));
    }

    public function departments(Request $request) {
        $departments = Department::where('school_id',$request->id)->get();
        return view("admin.departments", compact("departments"));
    }

    public function teachers(Request $request) {
        $teachers = Teacher::where('department_id',$request->id)->get();
        return view("admin.teachers", compact("teachers"));
    }

    public function levels(Request $request) {
        $levels = Level::where('teacher_id',$request->id)->get();
        return view("admin.levels", compact("levels"));
    }


    public function classrooms(Request $request) {
        $classrooms = Classroom::where('level_id',$request->id)->get();
        return view("admin.classrooms", compact("classrooms"));
    }
}
