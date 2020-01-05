<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Storage;
use App\Travel;
use App\Pligrim;
use App\User;

class PligrimController extends Controller
{

    private function handleError($error)
    {
        throw new Exception($error);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $travel_id)
    {
        $file = $request->file('file');
        
        if ($file->extension() != 'pdf') {
            $this->handleError('Invalid file type');
        }

        $url = $file->store('pdf');

        $pligrim = new Pligrim(['url'=>$url]);
        Travel::where('id', $travel_id)->first()->pligrim()->save($pligrim);

        return response()->json(formResponse(200, true));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if(!$request->has('secret')){
            $this->handleError('Unauthorized access');
        }
        $token = $request->secret;
        if(!User::where('token', $token)->count()){
            $this->handleError('Unauthorized access');
        }
        $file = Pligrim::findOrFail($id);
        $path = storage_path('app').'/'.$file->url;
        
        return response()->file($path);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $travel_id, $id)
    {
        $file = $request->file('file');
        
        if ($file->extension() != 'pdf') {
            $this->handleError('Invalid file type');
        }

        $url = $file->store('pdf');

        Travel::where('id', $travel_id)->first()->pligrim()->update(['url'=>$url]);

        return response()->json(formResponse(200, true));
    }
}
