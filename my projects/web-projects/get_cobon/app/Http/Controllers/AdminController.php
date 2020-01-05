<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use Validator;
use Hash;

class AdminController extends Controller
{
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Validate the request have valid terminal data
     *
     * @param mixed $data
     * @return Validator
     */
    private function validateRequest($data, $add = true)
    {
        $validatorRules = [
            'username' => 'required|unique:admins',
            'password' => 'required',
          ];

        if ($add) {
            $validatorRules['permission_level']  = 'required';
        }
            return Validator::make($data, $validatorRules);
    }
     
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = admin::paginate(10);
        return response()->json($result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $data = $this->request->all();
        $validator = $this->validateRequest($data);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        } else {
            $user = Admin::create($data);
            return response()->json($user);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $data = $this->request->all();
        $validator = $this->validateRequest($data, false);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        } else {
            $user = Admin::where('id', $id)->first()->update($data);
            return response()->json($user);
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
        $user = $this->request->user;
        $user = User::where('type', '>=', $user->type)->where('id', $id)->delete();
        return response()->json($user);
    }

     /**
     * login a user.
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        $admin = Admin::where('username', $this->request->username);
        if($admin->count() != 1){
            return response()->json("Not Authorized", 401);
        }else{
            $admin = $admin->first();
        }
        if (Hash::check($this->request->password, $admin->password)) {
            $admin->token = md5($admin->username.$admin->password.time());
            $admin->save();
            return response()->json($admin);
        } else {
             return response()->json("Unauthorized access", 401);
        }
    }

    /**
    *logout a user
    *@return \Illuminate\Http\Response
    */
    public function logout(){
        $admin = $this->request->admin;
        $admin->token = null;
        $admin->save();
        return response() ->json("logged out");
    }

    /**
    *reset a user password
    *@return \Illuminate\Http\Response
    */
    public function resetPassword(){
        $admin = $this->request->admin;
        $password = $this->request->password;
        $new_password = $this->request->new_password;
        if(strlen($password) >= 8 && $password === $new_password){
            $admin->password = $this->request->password;
            $admin->save();
            return response()->json(true);
        }
    }
}
