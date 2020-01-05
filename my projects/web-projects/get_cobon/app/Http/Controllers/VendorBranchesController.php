<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Branch;

class VendorBranchesController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @param vendorId
     * @return \Illuminate\Http\Response
     */

     public function index($vendorId) {
        return Branch::withTrashed()->with('images')->where('vendor_id', $vendorId)->get();
     }
}
