<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name', 'email', 'phones', 'slogan'
    ];

    public function travels(){
        return $this->hasMany('App\Travel');
    }

    public function users(){
        return $this->hasMany('App\User');
    }

    public function setSloganAttribute($value){
        $names = explode(' ', $value);
        $slogan = ''; 
        $c = count($names);
        for ($i = 0; $i < $c-1; $i++) {
            $slogan .= $names[$i][0] . '_';
        }
        $slogan .= $names[$c-1][0];

        $this->attributes['slogan'] = $slogan;
        
    }
}
