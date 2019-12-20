<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class District extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'state_id','name'
    ];

    public function state()
    {
        return $this->belongsTo('App\States');
    }
}
