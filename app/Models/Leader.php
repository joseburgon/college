<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leader extends Model
{
    protected $fillable = [
        'name',
        'active',
    ];

    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }
}
