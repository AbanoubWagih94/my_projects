<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TravelSightSeeing extends Model
{
    protected $fillable = [
        'travel_area_id', 'sight_seeing_id', 'date', 'time',
    ];

    protected $hidden = ['travel_area_id', 'sight_seeing_id'];

    public function sightSeeing()
    {
        return $this->belongsTo('App\SightSeeing');
    }

    public function travelArea()
    {
        return $this->belongsTo('App\TravelArea');
    }
}
