<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::all();
        return view("departments.index", compact("departments"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("departments.create");
    }


    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $department = Department::find($request->id);
        return view("departments.show", compact("department"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $department_id = $request->id;
        return view("departments.edit", compact("department_id"));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Department::find($request->id)->delete();
        return redirect()->route("departments.index")->with("success","Department Deleted Successful.");
    }
}
