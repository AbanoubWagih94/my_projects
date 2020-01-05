<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    protected $fillable = [
        'company_id', 'group_number', 'auto_number', 
        'program_number', 'pligrims_number',
        'package_type', 'type',
        'transport_type', 'payment_method'
    ];

    public function tasks(){
        return $this->hasMany('App\Task');
    }

    public function company(){
        return $this->belongsTo('App\Company');
    }

    public function travelAreas(){
        return $this->hasMany('App\TravelArea');
    }

    public function terminals(){
        return $this->hasMany('App\Terminal');
    }
    
    public function pligrim(){
        return $this->hasOne('App\Pligrim');
    }
}
