<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Balance extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'invoice_id','captain_id','name','reg_no','balance','service_id','phone','note'
    ];

    public function service(){
        return $this->belongsTo('App\Service');
    }



    public function captain(){
        return $this->belongsTo('App\Captain');
    }

    
}
