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

    protected $appends = ['lessons','weeky_plan','tasks','notes'];


    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }

    public function levels() {
        return $this->hasMany(Level::class);
    }
}
