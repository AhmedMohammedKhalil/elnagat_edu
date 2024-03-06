<?php

namespace App\Http\Controllers;

use App\Models\Week;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $weeks = Week::all();
        $current_week = new Week;
        foreach ($weeks as $week) {
            $result = $this->isTodayBetweenDates($week->start_date, $week->end_date);
            if ($result) {
                $current_week = $week;
                break;
            }
        }
        $reviews = $current_week != null ? $current_week->reviews : "";
        $flag = false;
        if(count($reviews) == 0) {

                foreach (auth()->user()->department->teachers as $teacher) {
                    foreach ($teacher->levels as $level) {
                        if(count($level->classrooms) > 0) {
                            $flag  = true;
                            break;
                        }
                    }
                    if($flag) {
                        break;
                    }
                }

        } else {
            $flag = true;
        }

        $count = 0;

        foreach (auth()->user()->department->teachers as $teacher) {
            foreach ($teacher->levels as $level) {
                if(count($level->classrooms) > 0) {
                    $count  += count($level->classrooms);
                }
            }
        }
        return view("reviews.index", compact("reviews","current_week","flag",'count'));
    }


    public function isTodayBetweenDates($startDate, $endDate) {
        $today = strtotime(date('Y-m-d'));
        $startDate = strtotime($startDate);
        $endDate = strtotime($endDate);
        return ($today >= $startDate && $today <= $endDate);
    }




    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $review = Review::find($request->id);
        return view("reviews.show", compact("review"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {

        $review_id = $request->id;
        return view("reviews.edit", compact("review_id"));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Review::find($request->id)->delete();
        return redirect()->route("reviews.index")->with("success","review Deleted Successful.");
    }
}
