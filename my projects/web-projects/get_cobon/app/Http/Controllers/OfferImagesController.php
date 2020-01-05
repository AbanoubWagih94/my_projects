<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OfferImages;

class OfferImagesController extends Controller
{
    public function update(Request $request, $offerId) {
        OfferImages::where('offer_id', $offerId)->delete();
        $images = [];
        foreach($request->all() as $image) {
            array_push($images, ['path' => $image, 'offer_id' => $offerId]);
        }
        return OfferImages::insert($images)? $images : [];
    }
}
