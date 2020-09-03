<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Transaction extends Model
{
    public $allowedSorts = ['status', 'external_reference'];

    protected $fillable = [
        'coupon_amount',
        'currency_id',
        'external_reference',
        'description',
        'id',
        'net_amount',
        'operation_type',
        'payment_method_id',
        'payment_type_id',
        'paypal_order',
        'status',
        'status_detail',
        'transaction_amount',
        'type',
    ];

    protected $with = ['referenceCode'];

    public function scopeId(Builder $query, $value)
    {
        $query->where('id', 'LIKE', "%{$value}%");
    }

    public function scopeStatus(Builder $query, $value)
    {
        $query->where('status', $value);
    }

    public function scopeReference(Builder $query, $value)
    {
        $query->where('external_reference', $value);
    }

    public function scopeSearch(Builder $query, $values)
    {
        foreach (Str::of($values)->explode(' ') as $value) {
            $query->orWhere('id', 'LIKE', "%{$value}%")
                ->orWhere('external_reference', 'LIKE', "%{$value}%");
        }
    }

    public function scopeYear(Builder $query, $value)
    {
        $query->whereYear('created_at', $value);
    }

    public function scopeMonth(Builder $query, $value)
    {
        $query->whereMonth('created_at', $value);
    }

    public function referenceCode()
    {
        return $this->belongsTo( ReferenceCode::class, 'external_reference', 'id');
    }

}
