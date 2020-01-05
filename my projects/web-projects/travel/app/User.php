<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'company_id', 'area_id', 'type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }

    public function company(){
        return $this->belongsTo('App\Company');
    }

    public function area(){
        return $this->belongsTo('App\Area');
    }

    public function tasks(){
        return $this->hasMany('App\Task');
    }

    public function notifications(){
        return $this->hasMany('App\Notification');
    }
}
