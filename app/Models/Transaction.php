<?php

namespace App\Models;

use App\Events\TransactionSaved;
use Illuminate\Database\Eloquent\Model;

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
        'status',
        'status_detail',
        'transaction_amount',
    ];
    
}
