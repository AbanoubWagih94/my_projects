<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SightSeeing extends Model
{
    protected $fillable = [
        'name',
    ];

    public function sightSeeings()
    {
        return $this->hasMany('App\TravelSightSeeing');
    }
}
