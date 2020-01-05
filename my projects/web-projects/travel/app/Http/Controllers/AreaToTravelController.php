<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Travel;
use App\TravelSightSeeing;

class AreaToTravelController extends Controller
{
    /**
     * Validate the request have valid travelArea data
     * 
     * @param mixed $data
     * @return Validator
     */
     private function validateRequest($data){
         return Validator::make($data, [
              'area_id' => 'numeric:required',
              'check_in' => 'date:required',
              'check_out' => 'date:required',
              'hotel' => 'required|min:10',
              'hotel_location' => 'required|min:10',
              'dbl_rooms' => 'numeric:required',
              'trbl_rooms' => 'numeric:required',
              'quad_rooms' => 'numeric:required',
              'nights' => 'numeric:required',
         ]);
     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $travel_id)
    {
        $data = $request->all();
        $validator = $this->validateRequest($data);

        if($validator->fails()){
            return response()->json(formResponse(400, $validator->errors()));
        }else{
            $travel = Travel::where('id', $travel_id)->first();
            $travelArea = $travel->travelAreas();
            
            if($travelArea->count() >= 2 
            || 
            $travelArea->where('area_id', $data['area_id'])->count() > 0){
                return response()->json(formResponse(400, 'Bad Request'));
            }

            $travelArea = $travelArea->create($data);
            $sightSeeings = [];

            foreach ($data['sight_seeings'] as $sightSeeing) {
                array_push($sightSeeings, new TravelSightSeeing($sightSeeing));
            }

            if($data['sight_seeings'])
                $travelArea->sightSeeings()->saveMany($sightSeeings);
            
            return response()->json(formResponse(200, $travelArea));
        }
    }
}
