<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageHandler extends Controller
{
    /**
     * Takes care of images upload
     * @param Illuminate\Http\Request $request
     * 
     * @return Illuminate\Http\Response
     */
    public function upload(Request $request) {
        $path = $request->file('file')->store('');
        return response()->json(["path"=>$path]);
    }

    /**
     * Returns a list of all available images
     * 
     * @return string[] $arr
     */
    public function imageList() {
        $arr = [];
        $files = \File::allFiles('images');
        foreach ($files as $file)
        {
             array_push($arr, (string)$file);
        }
    
        return $arr;
    }
}
