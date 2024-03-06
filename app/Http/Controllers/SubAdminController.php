<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Level;
use App\Models\Teacher;
use App\Models\Classroom;
use App\Models\Department;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sub_admins = User::Where('role','sub_admin')->get();
        return view("sub_admins.index", compact("sub_admins"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("sub_admins.create");
    }


    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $sub_admin = User::find($request->id);
        return view("sub_admins.show", compact("sub_admin"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $user_id = $request->id;
        return view("sub_admins.edit", compact("user_id"));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        User::find($request->id)->delete();
        return redirect()->route("sub_admins.index")->with("success","Sub Admin Deleted Successful.");
    }



    public function schools() {
        $schools = School::where('sub_admin_id',auth()->user()->id)->get();
        return view("sub_admin.schools", compact("schools"));
    }

    public function departments(Request $request) {
        $departments = Department::where('school_id',$request->id)->get();
        return view("sub_admin.departments", compact("departments"));
    }

    public function teachers(Request $request) {
        $teachers = Teacher::where('department_id',$request->id)->get();
        return view("sub_admin.teachers", compact("teachers"));
    }

    public function levels(Request $request) {
        $levels = Level::where('teacher_id',$request->id)->get();
        return view("sub_admin.levels", compact("levels"));
    }


    public function classrooms(Request $request) {
        $classrooms = Classroom::where('level_id',$request->id)->get();
        return view("sub_admin.classrooms", compact("classrooms"));
    }
}
