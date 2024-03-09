<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table="departments";
    protected $fillable = [
        'school_id',
        'name',
        'owner_id',
    ];

    protected $appends = ['lessons','weekly_plan','tasks','results'];


    public function school() {
        return $this->belongsTo(School::class);
    }

    public function teachers() {
        return $this->hasMany(Teacher::class);
    }

    public function department_owner() {
        return $this->belongsTo(User::class,'owner_id');
    }


    public function getLessonsAttribute(){
        $sum = 0;
        foreach($this->teachers as $teacher){
            $sum += $teacher->lessons;
        }
        return $sum;
    }

    public function getWeeklyPlanAttribute(){
        $sum = 0;
        foreach($this->teachers as $teacher){
            $sum += $teacher->weekly_plan;
        }
        return $sum;
    }

    public function getTasksAttribute(){
        $sum = 0;
        foreach($this->teachers as $teacher){
            $sum += $teacher->tasks;
        }
        return $sum;
    }

    public function getResultsAttribute(){
        $count = 0;
        $result = 0;
        if(count($this->teachers) > 0){

            foreach($this->teachers as $teacher){
                $sum = 0;
                foreach($teacher->reviews as $review){
                    $sum += (int) $review->result;
                }
                if(count($teacher->reviews) > 0){
                    $count++;
                    $result += $sum / count($teacher->reviews);
                }

            }
            if($count > 0)
                $result = round($result / $count);
        }
        return $result;
    }

}
