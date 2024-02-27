<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schools = School::all();
        return view("schools.index", compact("schools"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("schools.create");
    }


    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $school = School::find($request->id);
        return view("schools.show", compact("school"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $school_id = $request->id;
        return view("schools.edit", compact("school_id"));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        School::find($request->id)->delete();
        return redirect()->route("schools.index")->with("success","School Deleted Successful.");
    }
}
