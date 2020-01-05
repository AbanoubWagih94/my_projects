<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use DB;
use App\Area;
use App\TravelArea;

class TravelAreaController extends Controller
{
    /**
     * Validate the request have valid travelArea data
     *
     * @param mixed $data
     * @return Validator
     */
    private function validateRequest($data)
    {
        return Validator::make($data, [
            'travel_id' => 'numeric:required',
            'area_id' => 'numeric:required',
            'check_in' => 'date|required',
            'check_out' => 'date|required',
            'hotel' => 'required|min:10',
            'hotel_location' => 'required|min:10',
            'dbl_rooms' => 'numeric:required',
            'trbl_rooms' => 'numeric:required',
            'quad_rooms' => 'numeric:required',
            'nights' => 'numeric:required',
            'sight_seeings' => 'array',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($area_id)
    {
        $travelAreas = Area::where('id', $area_id)->first()
        ->travelAreas()->with('travel')->paginate(10);

        // $data = [];
        // foreach ($travelAreas as $travelArea) {
        //     if ($travelArea['travel']['type'] == 1) {
        //         array_push($data, $travelArea);
        //     }
        // }


        return response()->json(formResponse(200, $travelAreas));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($area_id, $travel_area_id)
    {
        $travelArea = Area::where('id', $area_id)->first()
        ->travelAreas()->with('sightSeeings', 'sightSeeings.sightSeeing', 'travel')
        ->where('id', $travel_area_id)->first();
        
        return response()->json(formResponse(200, $travelArea));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $travel_area_id)
    {
        $data = $request->all();
        $validator = $this->validateRequest($data);

        if ($validator->fails()) {
            return response()->json(formResponse(400, $validator->errors()));
        } else {
            $travelArea = TravelArea::where('id', $travel_area_id)->first();
            $travelSightSeeings = $travelArea->sightSeeings;
            $sightSeeings = $data['sight_seeings'];
            
            DB::transaction(function () use ($sightSeeings, &$travelArea, $data){
                foreach ($sightSeeings as $s) {
                    unset($s['id']);
                    $travelArea->sightSeeings()->update($s);
                }

                $travelArea = $travelArea->update($data);
            }, 5);

            return response()->json(formResponse(200, $travelArea));
        }
    }
}