<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Offer;

class VendorOffersController extends Controller
{
     /**
     * Display a listing of the resource.
     * 
     * @param vendorId
     * @return \Illuminate\Http\Response
     */

    public function index($vendorId) {
        return Offer::with('images')->where('vendor_id', $vendorId)->get();
     }
}
