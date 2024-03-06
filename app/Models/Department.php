<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table="departments";
    protected $fillable = [
        'owner',
        'school_id',
        'name',
        'owner_id',
    ];

    public function school() {
        return $this->belongsTo(School::class);
    }

    public function teachers() {
        return $this->hasMany(Teacher::class);
    }

    public function department_owner() {
        return $this->belongsTo(User::class,'owner_id');
    }

}
