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
        $departments = auth()->user()->owner ? auth()->user()->owner->departments : "";
        return view("teachers.index", compact("departments"));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view("teachers.create");
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
