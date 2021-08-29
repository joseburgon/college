<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseLife extends Model
{
    protected $table = 'courses_life';

    protected $guarded = [];

    protected $dates = [
        'activation',
    ];

    protected $casts = [
        'id' => 'integer',
        'thinkific_id' => 'string',
        'immediate' => 'boolean',
        'duration' => 'integer',
        'details' => 'array',
    ];

    public function scopeThinkific($query, $thinkificId)
    {
        return $query->where('thinkific_id', $thinkificId);
    }

    public function scopeCourse($query, $courseid)
    {
        return $query->where('course_id', $courseid);
    }
}
