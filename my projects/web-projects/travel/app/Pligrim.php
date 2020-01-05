<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pligrim extends Model
{
    protected $fillable = ['travel_id', 'url'];

    public function travel(){
        return $this->belongsTo('App\Travel');
    }
}
