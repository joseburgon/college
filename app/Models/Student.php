<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Student extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'last_name',
        'identification',
        'email',
        'phone',
        'city',
        'state',
        'country',
        'status',
        'thinkific_user_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    protected $with = ['courses'];

    public function getUpdatedAtAttribute($value) {

        return Carbon::parse($value, 'UTC')->setTimezone('America/Bogota')->format(DATE_RFC2822);

    }

    public function getCreatedAtAttribute($value) {

        return Carbon::parse($value, 'UTC')->setTimezone('America/Bogota')->format(DATE_RFC2822);

    }

    public function scopeSearch(Builder $query, $values)
    {
        foreach (Str::of($values)->explode(' ') as $value) {
            $query->orWhere('name', 'LIKE', "%{$value}%")
                ->orWhere('last_name', 'LIKE', "%{$value}%")
                ->orWhere('email', 'LIKE', "%{$value}%")
                ->orWhere('identification', 'LIKE', "%{$value}%");
        }
    }


    public function courses()
    {
        return $this->belongsToMany(Course::class)->withTimestamps();
    }

    public function referenceCodes()
    {
        return $this->hasMany(ReferenceCode::class);
    }
}
