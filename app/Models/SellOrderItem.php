<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellOrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_id',
        'device_model_id',
        'network_carrier_id',
        'model_quote_id',
        'promoCode',
    ];
}
