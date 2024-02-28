<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\School;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schools = School::all();
        return view("teachers.index", compact("schools"));
    }


    public function teachers(Request $request)
    {
        $schoo_id = $request->id;
        $departments = Department::where('school_id',$request->id)->get();
        return view("teachers.all-teachers", compact("departments","school_id"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $school_id = $request->id;
        return view("teachers.create", compact("school_id"));
    }


    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $teacher = teacher::find($request->id);
        return view("teachers.show", compact("teacher"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {

        $teacher_id = $request->id;
        return view("teachers.edit", compact("teacher_id"));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Teacher::find($request->id)->delete();
        return redirect()->route("teachers.index")->with("success","Teacher Deleted Successful.");
    }
}
