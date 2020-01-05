<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Travel;
use App\Terminal;
use Validator;

class TravelTerminalController extends Controller
{
    /**
     * Validate the request have valid terminal data
     * 
     * @param mixed $data
     * @return Validator
     */
     private function validateRequest($data){
         return Validator::make($data, [
             'port' => 'required|min:5|max:255',
             'transporter_type' => 'required|min:1|max:255',
             'flight_number' => 'required|min:1|max:255',
             'type' => 'required|min:1|max:1',
             'date' => 'required|date',
             'time' => 'required'
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
            $response = Travel::where('id', $travel_id)->first()
            ->terminals()->save(new Terminal($request->all()));
            
            return response()->json(formResponse(200, $response));
        }
    }

}
