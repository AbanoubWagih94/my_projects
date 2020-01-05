<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Terminal;

class TerminalController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(formResponse(200, Terminal::paginate(10)));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(formResponse(200, Terminal::where('id', $id)->with('travel')->first()));
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
            $terminal = Terminal::where('id', $id)->first()->update($data);
            return response()->json(formResponse(200, $terminal));
        }
    } 
}
