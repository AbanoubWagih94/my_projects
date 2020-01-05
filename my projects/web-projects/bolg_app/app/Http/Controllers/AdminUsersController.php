<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Role;
use Illuminate\Http\Request;
use App\User;
class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin/users/index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'id')->all();
        return view('admin/users/create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|max:6',
            'role_id' => 'required',
            'is_active' => 'required',
            'photo_id' => 'required'
        ]);


        $input = $request->all();
        if($request->hasFile('photo_id')) {
            $file = $request->photo_id;
            $name = $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create([
                'file' => $name
            ]);

            $input['photo_id'] = $photo->id;
        }

        User::create($input);

        return redirect('admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::pluck('name', 'id')->all();
        return view('admin/users/edit', compact('user', 'roles'));
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
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role_id' => 'required',
            'password' => 'required',
            'is_active' => 'required',
        ]);
        $input = $request->all();

        if($request->hasFile('photo_id')){
            $file = $request->photo_id;
            $name = $file->getClientOriginalName();
            $file->move('images', $name);

            $photo = Photo::Create(['file'=>$name]);
            $input['photo_id'] = $photo->id;
        }
        $user = User::find($id);
        $user->update($input);

        return redirect('admin/users/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if(file_exists(public_path().$user->photo->file)){
            unlink(public_path().$user->photo->file);
        }
        //User::destroy($id);
        $user->delete();
        return redirect('admin/users');
    }
}
