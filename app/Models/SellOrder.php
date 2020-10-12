<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'model_quote_id',
        'name',
        'email',
        'address',
        'city',
        'province',
        'postalCode',
        'phone',
        'onlyShippingLabel',
        'paymentMethod',
        'paymentEmail',
    ];
}
