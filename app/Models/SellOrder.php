<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellOrder extends Model
{
    use HasFactory;

    //Status constants
    const STATUSES_MAIL = [
        "PROCESSING" => "Processing",
        "SHIPPING_LABEL_SENT" => "Shipping Label Sent",
        "PHONE_RECEIVED" => "Phone Received",
        "PAYMENT_MADE" => "Payment Made",
        "CLOSED" => "Closed",
    ];

    const STATUSES_SELF_DROP =[
        "PROCESSING" => "Processing",
        "PHONE_RECEIVED" => "Phone Received",
        "CLOSED" => "Closed",
    ];


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
        'netTotal',
        'status'
    ];

    public function items(){
        return $this->hasMany(SellOrderItem::class);
    }

    public function drop_location(){
        return $this->belongsTo(DropLocation::class);
    }
}
