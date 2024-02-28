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

    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }
}
