<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\SiteTerm;

class SiteTermsController extends Controller
{
    /**
     * Validate incomming request
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response (on fail)
    */

    private function isValid($request)
    {
        $validator = Validator::make($request->all(), [
            "description" => "required"
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
        return SiteTerm::all();
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

        return SiteTerm::create($request->all());
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
        if ($this->isValid($request)) {
            return SiteTerm::where('id', $id)->update($request->all());
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
        return SiteTerm::destroy($id);
    }
}
