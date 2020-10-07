<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_id',
        'name',
    ];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
