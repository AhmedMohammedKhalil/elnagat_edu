<?php

namespace App\Http\Controllers;

use App\Models\User;
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
}
