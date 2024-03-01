<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Models\Level;

class ClassroomController extends Controller
{
    public function index(Request $request)
    {
        $level=Level::find($request->id);
        return view("classrooms.index", compact("level"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {

        $classroom_id = $request->id;
        return view("classrooms.edit", compact("classroom_id"));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Classroom::find($request->classroom_id)->delete();
        return redirect()->route("classrooms.index",["id"=>$request->id])->with("success","Teacher Deleted Successful.");
    }
}
