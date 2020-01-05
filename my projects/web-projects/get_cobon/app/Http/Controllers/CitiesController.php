<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\City;

class CitiesController extends Controller
{
     /**
     * Validate incomming request
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response (on fail)
    */

    private function isValid($request, $update = false)
    {
        if ($update) {
            if ($request->has('name')) {
                return false;
            } else {
                return true;
            }
        } else {
            $validator = Validator::make($request->all(), [
                "name" => "required|unique:cities",
                "country_id" => 'required'
            ]);
        }

        return $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return City::all();
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
        return City::create($request->all());
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
        if ($this->isValid($request, true)) {
            return City::where('id', $id)->update($request->all());
        } else {
            return response()->json("can't update city's name", 422);
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
        return City::destroy($id);
    }

    /**
     * Restore the specified resource back to storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        return City::withTrashed()->where('id', $id)->restore();
    }
}
