<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Week extends Model
{
    use HasFactory;

    protected $table="weeks";
    protected $fillable = [
        'start_date',
        'end_date',
        'week_index', 
    ];

    public function reviews() {
        return $this->hasMany(Review::class);
    }
}
