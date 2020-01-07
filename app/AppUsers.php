<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppUsers extends Model
{   
    use SoftDeletes;
    
    protected $fillable = [
        'name','email','phone','pic'
    ];

}
