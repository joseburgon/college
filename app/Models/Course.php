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
        'discount_percentage',
        'thinkific_id',
        'bundle',
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
        'discount_percentage' => 'integer',
        'thinkific_id' => 'string',
        'bundle' => 'array',
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class)->withTimestamps();
    }

    public function referenceCodes()
    {
        return $this->hasMany(ReferenceCode::class);
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }

    public function getPriceWithDiscount($usdPrice = false)
    {
        $totalPrice = $usdPrice ? $this->price_usd : $this->price;

        $discount = ($this->discount_percentage / 100) * $totalPrice;

        return floatval($totalPrice - $discount);
    }
}
