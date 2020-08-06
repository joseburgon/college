<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferenceCode extends Model
{
    protected $with = ['course', 'student'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'course_id',
        'student_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'code' => 'string',
        'course_id' => 'integer',
        'student_id' => 'integer',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
