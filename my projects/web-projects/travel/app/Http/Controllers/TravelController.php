<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Travel;

class TravelController extends Controller
{
    /**
     * Validate the request have valid travel data
     * 
     * @param mixed $data
     * @return Validator
     */
     private function validateRequest($data){
         return Validator::make($data, [
             'company_id' => 'numeric|required',
             'group_number' => 'numeric|required',
             'auto_number' => 'required',
             'program_number' => 'numeric|required',
             'pligrims_number' => 'numeric|required',
             'package_type' => 'numeric|required',
             'type' => 'numeric|required',
         ]);
     }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(formResponse(200, Travel::where('type','!=','-1')->paginate(10)));
    }

    /**
     * Display the specified resource.
     *numiric|
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(
            formResponse(200, 
            Travel::with('travelAreas', 'terminals',
            'travelAreas.area', 'travelAreas.sightSeeings', 
            'travelAreas.sightSeeings.sightSeeing', 'pligrim')
            ->where('id', $id)->first()));
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
            $travel = Travel::where('id', $id)->first()->update($data);
            return response()->json(formResponse(200, $travel));
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
        $travel = Travel::where('id', $id)->update(['type' => -1]);
        return response()->json(formResponse(200, true));
    }
}
