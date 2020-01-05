<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Terminal extends Model
{
    protected $fillable = [
        "port", "transporter_type", "flight_number", "type" ,"date", "time" 
    ];

    public function travel(){
        return $this->belongsTo('App\Travel');
    }
}
