<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BranchImages;

class BranchImagesController extends Controller
{
    public function update(Request $request, $branchId) {
        BranchImages::where('branch_id', $branchId)->delete();
        $images = [];
        foreach($request->all() as $image) {
            array_push($images, ['path' => $image, 'branch_id' => $branchId]);
        }
        return BranchImages::insert($images)? $images : [];
    }
}
