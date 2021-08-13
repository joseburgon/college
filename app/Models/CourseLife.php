<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseLife extends Model
{
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
}
