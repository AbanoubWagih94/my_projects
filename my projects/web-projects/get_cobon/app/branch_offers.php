<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class branch_offers extends Model
{
    protected $fillable = ['branch_id', 'offer_id'];

    public function branches() {
        return $this->belongsTo('App\Branch');
    }

    public function offeres() {
        return $this->belongsTo('App\Offer');
    }
}
