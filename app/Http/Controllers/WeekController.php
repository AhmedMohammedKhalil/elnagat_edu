<?php

namespace App\Http\Controllers;

use App\Models\Week;
use Illuminate\Http\Request;

class WeekController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $weeks = Week::all();
        return view("weeks.index", compact("weeks"));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view("weeks.create");
    }


    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $week = Week::find($request->id);
        return view("weeks.show", compact("week"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {

        $week_id = $request->id;
        return view("weeks.edit", compact("week_id"));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Week::find($request->id)->delete();
        return redirect()->route("weeks.index")->with("success","week Deleted Successful.");
    }
}
