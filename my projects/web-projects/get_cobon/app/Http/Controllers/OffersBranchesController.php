<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\branch_offers;

class OffersBranchesController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @param vendorId
     * @return \Illuminate\Http\Response
     */

    public function index($offerId) {
        return branch_offers::join('branches', 'branch_offers.branch_id', 'branches.id')
        ->where('branch_offers.offer_id', $offerId)->select('branches.*')->get();
     }

     public function update(Request $request, $offerId) {
        $arr = [];
        foreach($request->all() as $branch) {
            array_push($arr, ['branch_id' => $branch['id'], 'offer_id' => $offerId]);
        }

        
       $res = branch_offers::where('offer_id', $offerId)->delete();
       if(!count($arr))
        return $res;
        // return $arr;
        return branch_offers::insert($arr)? '1':'0';
     }
}
