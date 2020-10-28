<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellOrderItem extends Model
{
    use HasFactory;
    public static $snakeAttributes = false;

    protected $fillable = [
        'sell_order_id',
        'device_id',
        'device_model_id',
        'network_carrier_id',
        'model_quote_id',
        'promoCode',
    ];

    public function sellOrder(){
        return $this->belongsTo(SellOrder::class, 'sell_order_id');
    }

    public function selectedDeviceModel(){
        return $this->belongsTo(DeviceModel::class, 'device_model_id');
    }

    public function selectedNetworkCarrier(){
        return $this->belongsTo(NetworkCarrier::class, 'network_carrier_id');
    }

    public function selectedQuote(){
        return $this->belongsTo(ModelQuote::class, 'model_quote_id');
    }
}
