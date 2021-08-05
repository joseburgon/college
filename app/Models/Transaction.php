<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Transaction extends Model
{
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

    protected $casts = [
        'id' => 'integer',
    ];

    protected $with = ['referenceCode.student'];

    public function getUpdatedAtAttribute($value) {

        return Carbon::parse($value, 'UTC')->setTimezone('America/Bogota')->format(DATE_RFC2822);

    }

    public function getCreatedAtAttribute($value) {

        return Carbon::parse($value, 'UTC')->setTimezone('America/Bogota')->format(DATE_RFC2822);

    }

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
