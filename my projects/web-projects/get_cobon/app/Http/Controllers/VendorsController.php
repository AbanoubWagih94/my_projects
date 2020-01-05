<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Vendor;

class VendorsController extends Controller
{
    /**
     * Validate incomming request
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response (on fail)
    */

    private function isValid($request, $update = false)
    {
        if ($update) {
            $validator = Validator::make($request->all(), [
                "name" => "required",
                "description" => "required",
                "category_id" => "required"
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                "name" => "required|unique:vendors",
                "description" => "required",
                "category_id" => "required"
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
        return Vendor::withTrashed()->get();
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

        return Vendor::create($request->all());
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
            return Vendor::where('id', $id)->update($request->all());
        } else {
            return response()->json("can't update vendor's name", 422);
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
        return Vendor::destroy($id);
    }

    /**
     * Restore the specified resource back to storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        return Vendor::withTrashed()->where('id', $id)->restore();
    }
}
