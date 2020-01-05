<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;

class AdminMediaController extends Controller
{
    public function index(){

        $photos = Photo::all();
        return view('admin.media.index', compact('photos'));
    }

    public function create(){
        return view('admin.media.create');
    }

    public function store(Request $request){
        $request->validate([
            'file'=>'required'
        ]);

        if($request->hasFile('file')){
            $file = $request->file;
            $file->move('images', $file->getClientOriginalName());
            Photo::create(['file'=>$file->getClientOriginalName()]);
        }
        return redirect('admin/media/');
    }

    public function destroy($id){
        
        $photo = Photo::find($id);
        if(file_exists(public_path().$photo->file)){
            unlink(public_path().$photo->file);
        }
        $photo->delete();
        return redirect('admin/media/');
    }

    public function mediaDelete(Request $request)
    {

        if(isset($request->delete_single)){
            Photo::destroy($request->photo_id);
            return redirect()->back();
        }
        else {

            $photos = Photo::findOrFail($request->checkBoxArray);

            foreach ($photos as $photo){
                $photo->delete();
            }

            return redirect()->back();
        }
    }
}
