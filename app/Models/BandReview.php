<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BandReview extends Model
{
    use HasFactory;

    protected $table="band_reviews";
    protected $fillable = [
        'band_id',
        'review_id',
    ];
    public function band() {
        return $this->belongsTo(Band::class);
    }

    public function review() {
        return $this->belongsTo(Review::class);
    }
}
