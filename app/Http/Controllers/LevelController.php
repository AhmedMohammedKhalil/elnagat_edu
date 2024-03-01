<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Teacher;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function index(Request $request)
    {
        $teacher=Teacher::find($request->id);
        return view("levels.index", compact("teacher"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("levels.create");
    }


    /**
     * Display the specified resource.
     */
   
    /**
     * Show the form for editing the specified resource.
     */
  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Level::find($request->level_id)->delete();
        return redirect()->route("levels.index",["id"=>$request->id])->with("success","Level Deleted Successful.");
    }
}
