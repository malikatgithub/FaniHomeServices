<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TempOrder extends Model
{
    use SoftDeletes;

    protected $fillable = [

        'location' ,
        'user_id' ,
        'user_name',
        'phone',
        'service_list',

    ];
}
