<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\SightSeeing;

class SightSeeingController extends Controller
{
    /**
     * Validate the request have valid sightSeeing data
     * 
     * @param mixed $data
     * @return Validator
     */
     private function validateRequest($data){
         return Validator::make($data, [
             'name' => 'required|min:5|max:50',
         ]);
     }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(formResponse(200, SightSeeing::all()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = $this->validateRequest($data);

        if($validator->fails()){
            return response()->json(formResponse(400, $validator->errors()));
        }else{
            $sightSeeing = SightSeeing::create($data);
            return response()->json(formResponse(200, $sightSeeing));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(formResponse(200, SightSeeing::where('id', $id)->first()));
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
        $validator = $this->validateRequest($data);

        if($validator->fails()){
            return response()->json(formResponse(400, $validator->errors()));
        }else{
            $sightSeeing = SightSeeing::where('id', $id)->first()->update($data);
            return response()->json(formResponse(200, $sightSeeing));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sightSeeing = SightSeeing::destroy($id);
        return response()->json(formResponse(200, $sightSeeing));
    }
}
