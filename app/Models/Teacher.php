<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table="teachers";
    protected $fillable = [
        'department_id',
        'name'
    ];

    protected $appends = ['lessons','weekly_plan','tasks','notes'];


    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }

    public function levels() {
        return $this->hasMany(Level::class);
    }

    public function getLessonsAttribute(){
        $sum = 0;
        foreach($this->reviews as $review){
            $sum += $review->lessons;
        }
        return $sum;
    }

    public function getWeeklyPlanAttribute(){
        $sum = 0;
        foreach($this->reviews as $review){
            $sum += $review->weekly_plan;
        }
        return $sum;
    }

    public function getTasksAttribute(){
        $sum = 0;
        foreach($this->reviews as $review){
            $sum += $review->tasks;
        }
        return $sum;
    }

    public function getNotesAttribute(){
        $notes = null;
        foreach($this->reviews as $review){
            if($review->notes){
                $notes .= $review->classroom->name." - ".$review->notes."<br>";
            }
        }
        return $notes;
    }
}
