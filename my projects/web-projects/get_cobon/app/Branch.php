<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name', 'city_id',
        'voters', 'vote_sum',
        'vendor_id', 'location',
        'phone_number'
    ];

    protected $dates = ['deleted_at'];

    public function vendor()
    {
        return $this->belongsTo('App\Vendor');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function branch_offers()
    {
        return $this->hasMany('App\branch_offers');
    }

    public function images() {
        return $this->hasMany('App\BranchImages');
    }
}
