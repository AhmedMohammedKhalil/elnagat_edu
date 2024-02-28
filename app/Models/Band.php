<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Band extends Model
{
    use HasFactory;

    protected $table="bands";
    protected $fillable = [
        'tasks',
        'lessons',
        'weekly_plan', 
    ];

    public function reviews()
    {
        return $this->belongsToMany(Review::class,'band_reviews','band_id','review_id')
        ->using(BandReview::class)->withPivot('id','band_id','review_id')->withTimestamps();
    }
}
