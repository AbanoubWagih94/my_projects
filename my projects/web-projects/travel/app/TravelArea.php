<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TravelArea extends Model
{
    protected $fillable = [
        'area_id', 'travel_id', 'check_in', 'check_out', 'hotel', 'hotel_location',
        'dbl_rooms', 'trbl_rooms', 'quad_rooms', 'nights'
    ];

    protected $hidden = ['area_id'];

    public function travel()
    {
        return $this->belongsTo('App\Travel');
    }

    public function area()
    {
        return $this->belongsTo('App\Area');
    }

    public function sightSeeings()
    {
        return $this->hasMany('App\TravelSightSeeing');
    }
}
