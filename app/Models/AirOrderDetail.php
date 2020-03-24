<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class AirOrderDetail extends Model
{

    protected $table = 'air_order_details';

    public function order()
    {
        return $this->belongsTo(Air::class);
    }
}