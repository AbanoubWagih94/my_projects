<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = [
        'name',
    ];

    public function travelAreas(){
        return $this->hasMany('App\TravelArea');
    }

    public function users(){
        return $this->hasMany('App\User');
    }
}
 