<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offer extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'end_date', 'included', 'excluded', 'description', 
        'offer_terms', 'title', 'main_price', 'offer_price', 'vendor_id'];
    protected $dates = ['deleted_at']; 

    public function branch_offers() {
        return $this->hasMany('App\branch_offers');
    }

    public function images() {
        return $this->hasMany('App\OfferImages');
    }
}
