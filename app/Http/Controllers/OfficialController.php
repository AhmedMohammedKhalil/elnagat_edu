<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfficialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $officials = User::Where('role','official')->get();
        return view("officials.index", compact("officials"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("officials.create");
    }


    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $official = User::find($request->id);
        return view("officials.show", compact("official"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $user_id = $request->id;
        return view("officials.edit", compact("user_id"));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        User::find($request->id)->delete();
        return redirect()->route("officials.index")->with("success","Official Deleted Successful.");
    }
}
