<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'cohort',
        'tagline',
        'description',
        'price',
        'price_usd',
        'thinkific_id',
        'available_at'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'available_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'price' => 'integer',
        'price_usd' => 'integer',
        'thinkific_id' => 'string'
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class)->withTimestamps();
    }

    public function referenceCodes()
    {
        return $this->hasMany(ReferenceCode::class);
    }
}
