<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'user_id', 'travel_id', 'time', 'date', 'details', 'priority', 
    ];

    public function travel(){
        return $this->belongsTo('App\Travel');
    }
    
    public function user(){
        return $this->belongsTo('App\User');
    }
}
