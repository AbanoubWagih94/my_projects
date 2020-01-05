<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Hash;
use App\User;

class UserController extends Controller
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
           'name' => 'required|min:5|max:255',
           'email' => 'required|email',
           'phone' => 'required|regex:/^[0-9]{11}$/',
           'type' => 'required|min:1|max:1',
          ];

        if ($add) {		
            $validatorRules['password'] = 'required|min:8|max:20';
            $validatorRules['name'] = 'required|min:8|max:255|unique:users';
            $validatorRules['email'] = 'required|email|unique:users';
        }
            return Validator::make($data, $validatorRules);
    }
     
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $user = $this->request->user;
        $result = User::where('type', '>=', $user->type);
        if ($this->request->has('company')) {
            $result = $result->where('company_id', $this->request->company)->get();
        } 
        elseif ($this->request->has('area')) {
            $result = $result->where('area_id', $this->request->area)->get();
        }else{
            $result = $result->paginate(10);
        }

        return response()->json(formResponse(200, $result));
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
            return response()->json(formResponse(400, $validator->errors()));
        } else {
            $user = User::create($data);
            return response()->json(formResponse(200, $user));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
        $user = $this->request->user;
        $user = User::where('type', '>=', $user->type)->where('id', $id)->first();
        return response()->json(formResponse(200, $user));
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
        $user = $this->request->user;
        $data = $this->request->all();
        $validator = $this->validateRequest($data, false);

        if ($validator->fails()) {
            return response()->json(formResponse(400, $validator->errors()));
        } else {
            $user = User::where('id', $id)->first()->update($data);
            return response()->json(formResponse(200, $user));
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
        return response()->json(formResponse(200, $user));
    }

     /**
     * login a user.
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        $user = User::where('email', $this->request->email);
        if($user->count() != 1){
            return response()->json(formResponse(401, "Not Authorized"));
        }else{
            $user = $user->first();
        }
        if (Hash::check($this->request->password, $user->password)) {
            $user->token = md5($user->email.$user->password.time());
            $user->save();
            return response()->json(formResponse(200, $user));
        } else {
             return response()->json(formResponse(401, "Unauthorized access"));
        }
    }

    /**
    *logout a user
    *@return \Illuminate\Http\Response
    */
    public function logout(){
        $user = $this->request->user;
        $user->token = null;
        $user->save();
        return response() ->json(formResponse(200, "logged out"));
    }

    /**
    *reset a user password
    *@return \Illuminate\Http\Response
    */
    public function resetPassword(){
        $user = $this->request->user;
        $password = $this->request->password;
        $new_password = $this->request->new_password;
        if(strlen($password) >= 8 && $password === $new_password){
            $user->password = $this->request->password;
            $user->save();
            return response() ->json(formResponse(200, true));
        }
    }

}
