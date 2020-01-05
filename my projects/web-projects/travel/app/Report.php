<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'time', 'date', 'details','user_id','travel_id'
    ];

}
