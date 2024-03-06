<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $departments = Department::all();
        foreach ($departments as $dep) {
            //$user_date = User::where('email','owner_'.$dep->id.'@alnajat.edu.kw')->first();
            if (!$dep->owner_id) {
                $data = [
                    'name' => $dep->owner,
                    'email' => 'owner_'.$dep->id.'@alnajat.edu.kw',
                    'role' => 'department-owner',
                    'password' => Hash::make('password'),
                    'gender' => 'ذكر',
                ];
                $user = User::create($data);
                $dep->update([
                    'owner_id'=> $user->id,
                ]);
            }
        }
        return view('home');
    }
}
