<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Offer;
use App\OfferImages;

class OffersController extends Controller
{
    /**
     * Validate incomming request
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response (on fail)
    */
    private function isValid($request, $update = false)
    {
        $validator = Validator::make($request->all(), [
            "title" => "required",
            "end_date" => "required|date|after:start_date",
            "included" => "required|max:500",
            "excluded" => "required|max:500",
            "offer_terms" => "required|max:500",
            "main_price" => "digits_between:1,6",
            "offer_price" => "digits_between:1,6",
            "vendor_id" => "required",
            "images" => "required"
        ]);

        return $validator;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Offer::with('images')->get(); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (($validator = $this->isValid($request))->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $images = [];
        
        foreach($request->all()['images'] as $image) {
            array_push($images, new OfferImages(['path'=>$image]));
        }
        
        $offer = Offer::create($request->all());
        $offer->images()->saveMany($images);
        $offer->images = $images;
        return $offer;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Offer::find($id)->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        unset($data['images']);
        return Offer::where('id', $id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Offer::destroy($id);
    }
}
