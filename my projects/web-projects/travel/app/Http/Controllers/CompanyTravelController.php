<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Company;
use App\Travel;

class CompanyTravelController extends Controller
{
    /**
     * Validate the request have valid travel data
     * 
     * @param mixed $data
     * @return Validator
     */
     private function validateRequest($data){
         return Validator::make($data, [
             'group_number' => 'numeric|required',
             'program_number' => 'numeric|required',
             'pligrims_number' => 'numeric|required',
             'package_type' => 'numeric|required',
         ]);
     }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($comp_id)
    {
        return response()->json(
            formResponse(200, Company::where('id', $comp_id)->first()
            ->travels()->paginate(10)));
    }

    /**
     * Display the specified resource.
     *numiric|
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($comp_id, $travel_id)
    {
    
        return response()->json(
            formResponse(200, Company::where('id', $comp_id)->first()
            ->travels()->with(
                'travelAreas', 'travelAreas.area', 
                'travelAreas.sightSeeings', 
                'travelAreas.sightSeeings.sightSeeing', 'terminals','pligrim')
            ->where('id', $travel_id)->first()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $comp_id)
    {
        $data = $request->all();
        $validator = $this->validateRequest($data);

        if($validator->fails()){
            return response()->json(formResponse(400, $validator->errors()));
        }else{
            $company = Company::where('id', $comp_id)->first();
            $travel = $company->travels();
            $data['auto_number'] = $company->slogan.'_'.($travel->count()+1);
            $travel = $travel->create($data);
                 
            return response()->json(formResponse(200, $travel));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($comp_id, $travel_id)
    {
        $travel = Travel::destroy($travel_id);
        return response()->json(formResponse(200, $travel));
    }
}
