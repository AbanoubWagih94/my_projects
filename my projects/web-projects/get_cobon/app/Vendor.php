<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends Model
{
    use SoftDeletes;
 
    protected $fillable = ['name', 'description', 'category_id', 'logo'];
    protected $dates = ['deleted_at'];    

    public function branches() {
        return $this->hasMany('App\Branch');
    }

    public function category() {
        return $this->belongsTo('App\Category');
    }
}
