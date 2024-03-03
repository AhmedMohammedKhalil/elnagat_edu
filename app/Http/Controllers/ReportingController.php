<?php

namespace App\Http\Controllers;

use App\Http\Livewire\Department\Department;
use Illuminate\Http\Request;
use App\Models\School;
use App\Models\Week;
use Illuminate\Support\Carbon;

use App\Models\Department as ModelsDepartment;
use App\Models\Review;

class ReportingController extends Controller
{
    //admin
    public function schoolReport()
    {
        return view("reports.schoolreport");
    }

    public function getSchoolReportData(Request $request)
    {
        $lessons = 0;
        $tasks = 0;
        $weekly_plan = 0;
        $review_count = 0;
        $teachers_count = 0;

        $departments = ModelsDepartment::where('school_id', $request->school_id)->get();
        $departments_count=$departments->count();
        foreach ($departments as $department) {
            // Increment teachers count for each department
            $teachers_count += $department->teachers()->count();

            $teachers = $department->teachers;

            foreach ($teachers as $teacher) {
                // Increment review count for each teacher
                $reviews = $teacher->reviews;
                $review_count += $reviews->count();

                foreach ($reviews as $review) {
                    // Accumulate lessons, tasks, and weekly plan
                    $lessons += $review->lessons;
                    $tasks += $review->tasks;
                    $weekly_plan += $review->weekly_plan;
                }
            }
        }
        $school = School::where('id', $request->school_id)->first();

        return view("reports.showSchoolreport",compact('school','departments_count','teachers_count','review_count','lessons','tasks','weekly_plan'));
    }

    public function departmentReport(Request $request)
    {
        return view("reports.departmentreport");
    }

    public function getDepartmentReportData(Request $request)
    {
        //$teachers=ModelsDepartment::where('id',$request->department_id)->teachers();
        $department = ModelsDepartment::find($request->department_id);
        $week= Week::find($request->week_id);
        $teachers = $department->teachers;
        $lessons = 0;
        $tasks = 0;
        $weekly_plan = 0;

        foreach ($teachers as $teacher)
            {
                $teacher_lessons = 0;
                $teacher_tasks = 0;
                $teacher_weekly_plan = 0;
                $teacher_notes = null;
                $ids[] =$teacher->id;
                $reviews = $teacher->reviews->where('week_id', $request->week_id);
                foreach ($reviews as $review)
                {
                    $lessons += $review->lessons;
                    $tasks += $review->tasks;
                    $weekly_plan += $review->weekly_plan;
                    $teacher_lessons += $review->lessons;
                    $teacher_tasks += $review->tasks;
                    $teacher_weekly_plan += $review->weekly_plan;
                    if($review->notes != null)
                        $teacher_notes = "يوجد ملاحظات";
                }
                $teacher->lessons = $teacher_lessons;
                $teacher->tasks = $teacher_tasks;
                $teacher->weekly_plan = $teacher_weekly_plan;
                $teacher->notes = $teacher_notes;
            }

        $reviews = Review::whereIn('teacher_id',$ids)->where('week_id', $request->week_id)->get();
        $school=$department->school;

        //$subadmin_name=$department->school->sub_admin->name;
        return view("reports.showdepartmentreport",compact('week','department','teachers','reviews','lessons','tasks','weekly_plan','school'));
    }

    //official----------------------------------------------------------------------------------
    public function officialSchoolReport()
    {
       $id = auth()->user()->owner->id;
       return redirect()->route('reports.official.school.data',['school_id'=>$id]);
    }

    public function getOfficialSchoolReportData(Request $request)
    {
        $lessons = 0;
        $tasks = 0;
        $weekly_plan = 0;
        $review_count = 0;
        $teachers_count = 0;

        $departments = ModelsDepartment::where('school_id', $request->school_id)->get();
        $departments_count=$departments->count();
        foreach ($departments as $department) {
            // Increment teachers count for each department
            $teachers_count += $department->teachers()->count();

            $teachers = $department->teachers;

            foreach ($teachers as $teacher) {
                // Increment review count for each teacher
                $reviews = $teacher->reviews;
                $review_count += $reviews->count();

                foreach ($reviews as $review) {
                    // Accumulate lessons, tasks, and weekly plan
                    $lessons += $review->lessons;
                    $tasks += $review->tasks;
                    $weekly_plan += $review->weekly_plan;
                }
            }
        }
        $school = School::whereId($request->school_id)->first();


        return view("reports.showofficialSchoolreport",compact('school','departments_count','teachers_count','review_count','lessons','tasks','weekly_plan'));
    }

    public function officialDepartmentReport(Request $request)
    {
        return view("reports.officialdepartmentreport");
    }


    public function getOfficialDepartmentReportData(Request $request)
    {

        $department = ModelsDepartment::find($request->department_id);
        $week= Week::find($request->week_id);
        $teachers = $department->teachers;
        $lessons = 0;
        $tasks = 0;
        $weekly_plan = 0;
        $ids = [];
        foreach ($teachers as $teacher)
            {
                $teacher_lessons = 0;
                $teacher_tasks = 0;
                $teacher_weekly_plan = 0;
                $teacher_notes = null;
                $ids[] =$teacher->id;
                $reviews = $teacher->reviews->where('week_id', $request->week_id);
                foreach ($reviews as $review)
                {
                    $lessons += $review->lessons;
                    $tasks += $review->tasks;
                    $weekly_plan += $review->weekly_plan;
                    $teacher_lessons += $review->lessons;
                    $teacher_tasks += $review->tasks;
                    $teacher_weekly_plan += $review->weekly_plan;
                    if($review->notes != null)
                        $teacher_notes = "يوجد ملاحظات";
                }
                $teacher->lessons = $teacher_lessons;
                $teacher->tasks = $teacher_tasks;
                $teacher->weekly_plan = $teacher_weekly_plan;
                $teacher->notes = $teacher_notes;
                //$teacher->save();


            }
        $reviews = Review::whereIn('teacher_id',$ids)->where('week_id', $request->week_id)->get();
        $school=$department->school;
        return view("reports.showofficialdepartmentreport",compact('week','department','teachers','reviews','lessons','tasks','weekly_plan','school'));
    }
}
