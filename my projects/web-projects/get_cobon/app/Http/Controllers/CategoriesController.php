<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Category;

class CategoriesController extends Controller
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
        return Category::withTrashed()->get();
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
        return Category::create($request->all());
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
            return Category::where('id', $id)->update($request->all());
        } else {
            return response()->json("can't update ctegory's name", 422);
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
        return Category::destroy($id);
    }

    /**
     * Restore the specified resource back to storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        return Category::withTrashed()->where('id', $id)->restore();
    }
}
