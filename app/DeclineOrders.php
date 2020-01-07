<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeclineOrders extends Model
{
    use softDeletes;
    protected $fillable = [
        'location' ,
        'order_id' , 
    ];
}

