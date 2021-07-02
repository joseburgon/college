<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    protected $fillable = [
        'name',
        'type',
        'city',
        'country',
        'active',
    ];

    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'type' => 'string',
        'city' => 'string',
        'country' => 'string',
        'active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function leaders()
    {
        return $this->belongsToMany(Leader::class);
    }
}
