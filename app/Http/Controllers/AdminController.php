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

    public function editSchool(Request $request)
    {
        $school_id = $request->id;
        return view("admin.school_edit", compact("school_id"));
    }

    public function departments(Request $request) {
        $departments = Department::where('school_id',$request->id)->get();
        return view("admin.departments", compact("departments"));
    }

    public function editDepartment(Request $request)
    {
        $department_id = $request->id;
        return view("admin.department_edit", compact("department_id"));
    }

    public function teachers(Request $request) {
        $teachers = Teacher::where('department_id',$request->id)->get();
        return view("admin.teachers", compact("teachers"));
    }

    public function editTeacher(Request $request)
    {
        $teacher_id = $request->id;
        return view("admin.teacher_edit", compact("teacher_id"));
    }

    public function deleteTeacher(Request $request)
    {
        $teacher = Teacher::find($request->id);
        $deprtment_id = $teacher->department_id;
        foreach ($teacher->levels as $level) {
            foreach ($level->classrooms as $classroom) {
                foreach ($classroom->reviews as $review) {
                    $review->delete();
                }
                $classroom->delete();
            }
            $level->delete();
        }
        $teacher->delete();
        return redirect()->route('admin.teachers',['id'=> $deprtment_id]);
    }


    public function levels(Request $request) {
        $levels = Level::where('teacher_id',$request->id)->get();
        return view("admin.levels", compact("levels"));
    }


    public function classrooms(Request $request) {
        $classrooms = Classroom::where('level_id',$request->id)->get();
        return view("admin.classrooms", compact("classrooms"));
    }

    public function editClassroom(Request $request)
    {
        $classroom_id = $request->id;
        return view("admin.classroom_edit", compact("classroom_id"));
    }

}
