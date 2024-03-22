<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classroom extends Model
{
    use HasFactory,SoftDeletes;


    protected $table="classrooms";
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'level_id',
    ];

    public function level() {
        return $this->belongsTo(Level::class,"level_id","id");
    }

    public function reviews() {
        return $this->hasMany(Review::class,"classroom_id","id");
    }
}
