<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Offer;
use App\User;
use Validator;

class UserActions extends Controller
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email'
          ];

        if ($add) {
            $validatorRules['email']  = 'required|unique:users';
            $validatorRules['password']  =  'required|min:8';
            $validatorRules['password_r']  = 'required|same:password';
        }
        
        return Validator::make($data, $validatorRules);
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
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $user = User::create($data);
            return redirect('/')->with('success', 'Account has been created successfully');
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
            return redirect()->back()->with('error', $validator->errors())->withInput();
        } else {
            $user = User::where('id', $id)->first()->update($data);
            return redirect()->back()->withInput();
        }
    }

    /**
     * login a user.
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        $data = $this->request->all();
        $attemp = \Auth::attempt(['email' => $data['email'], 'password' => $data['password']]);
        if($attemp) return redirect('/');
        
        return redirect()->back()->with('error', 'Wrong user name or password')->withInput();
    }

    /**
    *logout a user
    *@return \Illuminate\Http\Response
    */
    public function logout(){
        \Auth::logout();
        return redirect('/'); 
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

    /**
     * update the rate of the offer
     * 
     * @param int $offerId
     * @param float $rate
     * 
     * @return string $isSuccess
     */
    public function rate($offerId, $rate) {
        if(Offer::where('id', $offerId)->update([
            'voters' => \DB::raw( 'voters + 1' ),
            'vote_sum' => \DB::raw( 'vote_sum + '.$rate )
        ])) {
            return '1';
        } else {
            return '0';
        }
    }
}
