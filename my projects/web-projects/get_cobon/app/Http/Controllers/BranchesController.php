<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Branch;
use App\BranchImages;

class BranchesController extends Controller
{
    /**
     * Validate incomming request
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response (on fail)
    */
    private function isValid($request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "city_id" => "required",
            "vendor_id" => "required",
            "images" => "array|required"
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
        return Branch::with('images')->get();
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
        $images = [];

        foreach($request->all()['images'] as $image) {
            array_push($images, new BranchImages(['path'=>$image]));
        }

        $branch = Branch::create($request->all());
        $branch->images()->saveMany($images);
        $branch->images = $images;
        return $branch;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Branch::find($id)->firts();
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
        unset($data['images']);
        return Branch::where('id', $id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Branch::destroy($id);
    }

    /**
     * Restore the specified resource back to storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        return Branch::withTrashed()->where('id', $id)->restore();
    }
}
