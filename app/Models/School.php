<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $table="schools";

    protected $fillable = [
        'owner',
        'sub_admin_id',
        'offecial_id',
        'name'
    ];

    public function sub_admin() {
        return $this->belongsTo(User::class,'sub_admin_id','id');
    }

    public function departments() {
        return $this->hasMany(Department::class);
    }
}
