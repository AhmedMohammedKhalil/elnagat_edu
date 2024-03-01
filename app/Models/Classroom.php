<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;


    protected $table="classrooms";
    protected $fillable = [
        'name',
        'level_id',
    ];

    public function teachers() {
        return $this->hasMany(Teacher::class);
    }
}
