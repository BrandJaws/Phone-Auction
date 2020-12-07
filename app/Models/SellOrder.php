<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        // 'model_quote_id',
        'selfDropToLocation',
        'drop_location_id',
        'firstName',
        'lastName',
        'email',
        'address',
        'city',
        'province',
        'postalCode',
        'phone',
        'onlyShippingLabel',
        'paymentMethod',
        'paymentEmail',
        'promoCode',
        'netTotal'
    ];

    public function items(){
        return $this->hasMany(SellOrderItem::class);
    }

    public function drop_location(){
        return $this->belongsTo(DropLocation::class);
    }
}
