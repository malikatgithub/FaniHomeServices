<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcceptedOrders extends Model
{
    protected $fillable = [
        'location' ,
        'order_id' , 
    ];
}
