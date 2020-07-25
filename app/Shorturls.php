<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class shorturls extends Model
{
    //
    protected $fillable = [
        'longurl', 'shorturl', 'date','counter'
    ];

}
