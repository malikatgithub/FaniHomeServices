<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OnlineCaptains extends Model
{
    use softDeletes;
    protected $fillable = [
        'captain_id' ,
        'name',
        'phone' ,
        'service_id' ,
        'location',
    ];
}
