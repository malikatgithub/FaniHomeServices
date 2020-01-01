<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;



class Captain extends Authenticatable implements JWTSubject
{
    use SoftDeletes;

    protected $fillable = [
        'reg_no','name','bod','relegion','gender','nationality','phone','phone2','password','address','edu_level',
        'service_id','state_id','id_num','district_id','pic','note',
    ];

    public function service(){
        return $this->belongsTo('App\Service');
    }


    public function state(){
        return $this->belongsTo('App\States');
    }


    public function district(){
        return $this->belongsTo('App\District');
    }


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

}



