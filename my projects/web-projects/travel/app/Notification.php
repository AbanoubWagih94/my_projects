<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['user_id', 'end_point', 'details'];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
