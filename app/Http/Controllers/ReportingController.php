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


    public function getCountsReviews($departments,$week) {

        foreach ($departments as $key => $department) {
            $count = 0;
            $result = 0;
            $sum1 = 0;
            $sum2 = 0;
            $sum3 = 0;

            foreach($department->teachers as $teacher){
                $sum4 = 0;
                if($week) {
                    $reviews = Review::where('teacher_id',$teacher->id)->where('week_id', $week->id)->get();
                } else {
                    $reviews = $teacher->reviews;
                }
                foreach($reviews as $review){

                    $sum1 += $review->tasks;
                    $sum2 += $review->lessons;
                    $sum3 += $review->weekly_plan;
                    $sum4 += (int) $review->result;
                }
                if(count($reviews) > 0){
                    $count++;
                    $result += $sum4 / count($reviews);
                }
            }
            if($count > 0)
                $result = round($result / $count);


            if(count($department->teachers) == 0) {
                $result = 0;
            }

            $department = array_merge($department->toArray(),[
                'lessons_count' => $sum2,
                'weekly_plan_count'=> $sum3,
                'tasks_count'=> $sum1,
                'result_count' => $result,
            ]);

            $departments[$key] = array_merge($departments[$key]->toArray(),$department);

        }
        return $departments;
    }

    public function getReviewsTeachers($teachers,$week) {
        $lessons = 0;
        $tasks = 0;
        $weekly_plan = 0;

        foreach ($teachers as $key => $teacher){
            $teacher_lessons = 0;
            $teacher_tasks = 0;
            $teacher_weekly_plan = 0;
            $teacher_notes = null;
            $ids[] =$teacher->id;
            if($week) {
                $reviews = Review::where('teacher_id',$teacher->id)->where('week_id', $week->id)->get();
            } else {
                $reviews = $teacher->reviews;
            }
            foreach ($reviews as $review)
            {
                $lessons += $review->lessons;
                $tasks += $review->tasks;
                $weekly_plan += $review->weekly_plan;
                $teacher_lessons += $review->lessons;
                $teacher_tasks += $review->tasks;
                $teacher_weekly_plan += $review->weekly_plan;
                if($review->notes != null)
                    $teacher_notes .= $review->classroom->name." - ".$review->notes."<br>";
            }
            $teacher->lessons = $teacher_lessons;
            $teacher->tasks = $teacher_tasks;
            $teacher->weekly_plan = $teacher_weekly_plan;
            $teacher->notes = $teacher_notes;

            $teacher = array_merge($teacher->toArray(),[
                'lessons_count' => $teacher_lessons,
                'weekly_plan_count'=> $teacher_weekly_plan,
                'tasks_count'=> $teacher_tasks,
                'notes' => $teacher_notes,
            ]);

            $teachers[$key] = array_merge($teachers[$key]->toArray(),$teacher);
        }
        return [$teachers,$lessons,$tasks,$weekly_plan,$ids];
    }
    public function getSchoolReportData(Request $request)
    {

        $departments = ModelsDepartment::where('school_id', $request->school_id)->get();
        $departments_count=$departments->count();
        $week = Week::whereId($request->week_id)->first();
        $week_name = $week ? $week->week_index : 'الكل';
        $departments = $this->getCountsReviews($departments,$week);
        $school = School::where('id', $request->school_id)->first();
        return view("reports.showSchoolreport",compact('week','week_name','school','departments_count','departments'));
    }

    public function departmentReport(Request $request)
    {
        return view("reports.departmentreport");
    }

    public function getDepartmentReportData(Request $request)
    {
        //$teachers=ModelsDepartment::where('id',$request->department_id)->teachers();
        $department = ModelsDepartment::find($request->department_id);
        $week = Week::whereId($request->week_id)->first();
        $week_name = $week ? $week->week_index : 'الكل';
        $array = $this->getReviewsTeachers($department->teachers,$week);

        $teachers = $array[0];
        $lessons = $array[1];
        $tasks = $array[2];
        $weekly_plan = $array[3];
        $ids = $array[4];

        //$reviews = Review::whereIn('teacher_id',$ids)->where('week_id', $request->week_id)->get();
        $school=$department->school;

        //$subadmin_name=$department->school->sub_admin->name;
        return view("reports.showdepartmentreport",compact('week','week_name','department','teachers','lessons','tasks','weekly_plan','school'));
    }

    //official----------------------------------------------------------------------------------
    public function officialSchoolReport()
    {
       $id = auth()->user()->owner->id;
       return redirect()->route('reports.official.school.data',['school_id'=>$id]);
    }

    public function getOfficialSchoolReportData(Request $request)
    {


        $departments = ModelsDepartment::where('school_id', $request->school_id)->get();
        $departments_count=$departments->count();
        $week = Week::whereId($request->week_id)->first();
        $week_name = $week ? $week->week_index : 'الكل';
        $departments = $this->getCountsReviews($departments,$week);
        $school = School::whereId($request->school_id)->first();


        return view("reports.showofficialSchoolreport",compact('week','week_name','school','departments_count','departments'));
    }

    public function officialDepartmentReport(Request $request)
    {
        return view("reports.officialdepartmentreport");
    }


    public function getOfficialDepartmentReportData(Request $request)
    {

        $department = ModelsDepartment::find($request->department_id);
        $week= Week::find($request->week_id);
        $week = Week::whereId($request->week_id)->first();
        $week_name = $week ? $week->week_index : 'الكل';
        $array = $this->getReviewsTeachers($department->teachers,$week);

        $teachers = $array[0];
        $lessons = $array[1];
        $tasks = $array[2];
        $weekly_plan = $array[3];
        $ids = $array[4];

        //$reviews = Review::whereIn('teacher_id',$ids)->where('week_id', $request->week_id)->get();
        $school=$department->school;
        return view("reports.showofficialdepartmentreport",compact('week','week_name','department','teachers','lessons','tasks','weekly_plan','school'));
    }



    public function subAdminSchoolReport()
    {
       $id = auth()->user()->school->id;
       return redirect()->route('reports.sub_admin.school.data',['school_id'=>$id]);
    }

    public function getsubAdminSchoolReportData(Request $request)
    {
        $departments = ModelsDepartment::where('school_id', $request->school_id)->get();
        $departments_count=$departments->count();
        $week = Week::whereId($request->week_id)->first();
        $week_name = $week ? $week->week_index : 'الكل';
        $departments = $this->getCountsReviews($departments,$week);
        $school = School::whereId($request->school_id)->first();


        return view("reports.showsubadminSchoolreport",compact('week','week_name','school','departments_count','departments'));
    }

    public function subAdminDepartmentReport(Request $request)
    {
        return view("reports.subadmindepartmentreport");
    }


    public function getsubAdminDepartmentReportData(Request $request)
    {

        $department = ModelsDepartment::find($request->department_id);
        $week= Week::find($request->week_id);
        $week = Week::whereId($request->week_id)->first();
        $week_name = $week ? $week->week_index : 'الكل';
        $array = $this->getReviewsTeachers($department->teachers,$week);

        $teachers = $array[0];
        $lessons = $array[1];
        $tasks = $array[2];
        $weekly_plan = $array[3];
        $ids = $array[4];
        //$reviews = Review::whereIn('teacher_id',$ids)->where('week_id', $request->week_id)->get();
        $school=$department->school;
        return view("reports.showsubadmindepartmentreport",compact('week','week_name','department','teachers','lessons','tasks','weekly_plan','school'));
    }
}
