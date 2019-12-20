<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Captain extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'reg_no','name','bod','relegion','gender','nationality','phone','phone2','address','edu_level',
        'service_id','pic','note',
    ];

    public function service(){
        return $this->belongsTo('App\Service');
    }

}



