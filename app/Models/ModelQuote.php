<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelQuote extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_model_id',
        'device_state_id',
        'network_carrier_id',
        'quote_price',
    ];

    public function device_state(){
        return $this->belongsTo(DeviceState::class);
    }

    public function network_carrier(){
        return $this->belongsTo(NetworkCarrier::class);
    }

}
