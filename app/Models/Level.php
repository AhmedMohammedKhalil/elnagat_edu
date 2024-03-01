<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected $table="levels";
    protected $fillable = [
        'name',
        'teacher_id',
    ];

    public function teacher() {
        return $this->belongsTo(Teacher::class);
    }
    public function classrooms() {
        return $this->hasMany(Classroom::class);
    }
}
