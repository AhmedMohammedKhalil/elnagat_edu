<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table="reviews";
    protected $fillable = [
        'notes',
        'teacher_id',
        'week_id',
        'result',
        'date'
    ];

    public function teacher() {
        return $this->belongsTo(Teacher::class);
    }
    public function week() {
        return $this->belongsTo(Week::class);
    }

    public function bands()
    {
        return $this->belongsToMany(Band::class,'band_reviews','band_id','review_id')
        ->using(BandReview::class)->withPivot('id','band_id','review_id')->withTimestamps();
    }
}
