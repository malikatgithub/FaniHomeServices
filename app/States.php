<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class States extends Model
{
    use softDeletes;

    protected $fillable = [
        'name'
    ];


}
