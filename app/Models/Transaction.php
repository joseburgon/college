<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'merchant_id',
        'state_pol',
        'risk',
        'response_code_pol',
        'reference_sale',
        'sign',
        'extra1',
        'extra2',
        'payment_method',
        'payment_method_type',
        'value',
        'tax',
        'additional_value',
        'transaction_date',
        'currency',
        'email_buyer',
    ];
}
