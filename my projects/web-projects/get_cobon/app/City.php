<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'location', 'country_id'];
    protected $dates = ['deleted_at'];

    public function branches() {
        return $this->hasMany('App\Branch');
    }

    public function country() {
        return $this->belongsTo('App\Country');
    }
}
