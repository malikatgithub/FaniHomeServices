<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orders extends Model
{
    use softDeletes;
    protected $fillable = [

        'location' ,
        'order_id' ,
        'user_id' ,
        'user_name',
        'phone',
        'service_list',
        'status',

    ];

    public function user(){
        return $this->belongsTo('App\AppUsers');
    }
}
